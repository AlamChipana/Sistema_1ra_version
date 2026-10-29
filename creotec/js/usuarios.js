// =========================================
// LÓGICA JAVASCRIPT PARA USUARIOS
// =========================================

document.addEventListener("DOMContentLoaded", function() {
    cargarTablaUsuarios();

    const formRegistrar = document.getElementById('formRegistrarUsuario');
    
    if (formRegistrar) {
        formRegistrar.addEventListener('submit', function(e) {
            e.preventDefault(); 

            let datosFormulario = new FormData(this);
            let idEditando = document.getElementById('id_editando').value;

            // Decidimos si vamos a GUARDAR uno nuevo o ACTUALIZAR uno existente
            if(idEditando === '') {
                datosFormulario.append('accion', 'registrar'); 
            } else {
                datosFormulario.append('accion', 'editar');
            }

            fetch('procesos/procesos-usuarios.php', {
                method: 'POST',
                body: datosFormulario
            })
            .then(respuesta => respuesta.json()) 
            .then(datos => {
                if (datos.estado === 'exito') {
                    Swal.fire({
                        icon: 'success',
                        title: '¡Éxito!',
                        text: datos.mensaje,
                        confirmButtonColor: '#10b981'
                    });
                    
                    // Limpiamos todo volviendo al estado original
                    document.getElementById('btnCancelarEdicion').click();
                    cargarTablaUsuarios();

                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: datos.mensaje
                    });
                }
            })
            .catch(error => {
                console.error('Error de conexión:', error);
            });
        });
    }
});
    // =========================================
// VALIDACIONES ESTRICTAS Y MENSAJES EN VIVO
// =========================================

// Función maestra para validar cualquier input
function aplicarValidacion(inputId, errorId, regexInvalido, mensajeInvalido, limiteMax) {
    const input = document.getElementById(inputId);
    const error = document.getElementById(errorId);

    if (!input || !error) return;

    // 1. Validar mientras escribe (Borra caracteres no permitidos)
    input.addEventListener('input', function() {
        if (regexInvalido.test(this.value)) {
            // Muestra el mensaje
            error.textContent = mensajeInvalido;
            error.style.display = 'block';
            
            // Borra la letra o número prohibido
            this.value = this.value.replace(regexInvalido, '');
            
            // Oculta el mensaje después de 2.5 segundos
            setTimeout(() => error.style.display = 'none', 2500);
        }
        
        // Forzar mayúsculas/minúsculas según el campo
        if(inputId === 'inputCI') this.value = this.value.toUpperCase();
        if(inputId === 'inputUsuario') this.value = this.value.toLowerCase();
    });

    // 2. Bloquear teclado al llegar al límite máximo
    input.addEventListener('keydown', function(e) {
        // Permitimos borrar y usar flechas de movimiento
        const teclasPermitidas = ['Backspace', 'Tab', 'ArrowLeft', 'ArrowRight', 'Delete'];
        
        if (this.value.length >= limiteMax && !teclasPermitidas.includes(e.key)) {
            e.preventDefault(); // Bloquea el teclado
            error.textContent = `Límite máximo de ${limiteMax} caracteres alcanzado.`;
            error.style.display = 'block';
            setTimeout(() => error.style.display = 'none', 2500);
        }
    });
}

// Ejecutamos las validaciones cuando cargue la pantalla
document.addEventListener("DOMContentLoaded", function() {
    
    // NOMBRES Y APELLIDOS: Solo letras y espacios. Máximo 50.
    const regexLetras = /[^a-zA-ZáéíóúÁÉÍÓÚñÑ\s]/g;
    aplicarValidacion('inputNombres', 'errorNombres', regexLetras, "Solo se permiten letras. No ingreses números.", 50);
    aplicarValidacion('inputApellidos', 'errorApellidos', regexLetras, "Solo se permiten letras. No ingreses números.", 50);

    // CI: Solo letras, números y guiones. Máximo 15.
    const regexCI = /[^a-zA-Z0-9\-]/g;
    aplicarValidacion('inputCI', 'errorCI', regexCI, "Solo números, letras o guiones (ej. 1234567-1G).", 15);

    // USUARIO: Solo minúsculas, números, puntos o guiones bajos. Sin espacios. Máximo 20.
    const regexUsuario = /[^a-z0-9._]/ig; 
    aplicarValidacion('inputUsuario', 'errorUsuario', regexUsuario, "Sin espacios. Solo usa letras, números, puntos o guión bajo.", 20);

});

// =========================================
// FUNCIÓN: CARGAR LA TABLA DE USUARIOS
// =========================================
function cargarTablaUsuarios() {
    let datos = new FormData();
    datos.append('accion', 'listar');

    fetch('procesos/procesos-usuarios.php', {
        method: 'POST',
        body: datos
    })
    .then(respuesta => respuesta.text()) 
    .then(html => {
        const tbody = document.getElementById('listaUsuarios');
        if(tbody) {
            tbody.innerHTML = html;
        }
    })
    .catch(error => console.error('Error cargando la tabla:', error));
}

// =========================================
// FUNCIÓN: OBTENER DATOS PARA EDITAR
// =========================================
function obtenerDatosUsuario(id) {
    let datos = new FormData();
    datos.append('accion', 'obtener');
    datos.append('id_personal', id);

    fetch('procesos/procesos-usuarios.php', {
        method: 'POST',
        body: datos
    })
    .then(respuesta => respuesta.json())
    .then(datos => {
        document.querySelector('input[name="nombres"]').value = datos.nombres;
        document.querySelector('input[name="apellidos"]').value = datos.apellidos;
        document.querySelector('input[name="ci"]').value = datos.ci;
        document.querySelector('select[name="id_area"]').value = datos.id_area;
        document.querySelector('select[name="id_tipo"]').value = datos.id_tipo;
        document.querySelector('input[name="usuario"]').value = datos.usuario;
        
        // Contraseña y nota
        document.querySelector('input[name="password"]').value = '';
        document.querySelector('input[name="password"]').removeAttribute('required');
        document.getElementById('notaPassword').style.display = 'block';

        // ID oculto
        document.getElementById('id_editando').value = datos.id_personal;

        // Botones
        let btnGuardar = document.getElementById('btnGuardarForm');
        btnGuardar.textContent = 'Actualizar Empleado';
        btnGuardar.style.backgroundColor = '#10b981'; 
        
        document.getElementById('btnCancelarEdicion').style.display = 'block';
    })
    .catch(error => console.error('Error obteniendo datos:', error));
}

// =========================================
// FUNCIÓN: CANCELAR EDICIÓN
// =========================================
document.getElementById('btnCancelarEdicion').addEventListener('click', function() {
    document.getElementById('formRegistrarUsuario').reset();
    document.getElementById('id_editando').value = '';
    
    document.querySelector('input[name="password"]').setAttribute('required', 'true');
    document.getElementById('notaPassword').style.display = 'none';
    
    let btnGuardar = document.getElementById('btnGuardarForm');
    btnGuardar.textContent = 'Registrar Empleado';
    btnGuardar.style.backgroundColor = 'var(--dark)';
    
    this.style.display = 'none'; 
});

// =========================================
// FUNCIÓN: CAMBIAR ESTADO (ACTIVAR/DESACTIVAR)
// =========================================
function cambiarEstado(id, nuevoEstado) {
    // Configuramos los textos y colores según si vamos a activar o desactivar
    let textoAlerta = nuevoEstado === 1 ? "¿Deseas reactivar este usuario para que vuelva a tener acceso?" : "¿Deseas desactivar este usuario? Ya no podrá iniciar sesión en el sistema.";
    let btnColor = nuevoEstado === 1 ? "#10b981" : "#dc3545";
    let btnTexto = nuevoEstado === 1 ? "Sí, activar" : "Sí, desactivar";

    // Mostramos la alerta de confirmación con SweetAlert
    Swal.fire({
        title: '¿Estás seguro?',
        text: textoAlerta,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: btnColor,
        cancelButtonColor: '#6c757d',
        confirmButtonText: btnTexto,
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        // Si el usuario presiona "Sí"
        if (result.isConfirmed) {
            let datos = new FormData();
            datos.append('accion', 'cambiar_estado');
            datos.append('id_personal', id);
            datos.append('nuevo_estado', nuevoEstado);

            fetch('procesos/procesos-usuarios.php', {
                method: 'POST',
                body: datos
            })
            .then(respuesta => respuesta.json())
            .then(datos => {
                if (datos.estado === 'exito') {
                    // Alerta pequeña de éxito
                    Swal.fire({
                        icon: 'success',
                        title: '¡Actualizado!',
                        text: datos.mensaje,
                        timer: 1500,
                        showConfirmButton: false
                    });
                    // Recargamos la tabla automáticamente
                    cargarTablaUsuarios();
                } else {
                    Swal.fire('Error', datos.mensaje, 'error');
                }
            })
            .catch(error => console.error('Error cambiando estado:', error));
        }
    });


}