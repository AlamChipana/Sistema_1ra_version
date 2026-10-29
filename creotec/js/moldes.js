// Archivo: js/moldes.js
document.addEventListener("DOMContentLoaded", function() {
    
    let contenidoOriginalTarjetas = "";
    const contenedorPrincipal = document.querySelector(".dash-content");

    if (contenedorPrincipal) {
        contenidoOriginalTarjetas = contenedorPrincipal.innerHTML;
        configurarBotonCargarModulo();
    }

    // --- 1. NAVEGACIÓN Y CARGA DE MÓDULOS ---
    function configurarBotonCargarModulo() {
        const botonMoldes = document.getElementById("cargar-busqueda-moldes");
        if (botonMoldes) {
            botonMoldes.addEventListener("click", function(e) {
                e.preventDefault();
                if (contenedorPrincipal) {
                    fetch("vistas/vistas-moldes.php")
                    .then(response => response.text())
                    .then(html => {
                        contenedorPrincipal.innerHTML = html;
                        configurarBotonRegresar();
                        aplicarRestriccionesFicha(); // Llamamos a las restricciones al cargar la tabla
                    })
                    .catch(error => console.error("Error al cargar el módulo:", error));
                }
            });
        }
    }

    function configurarBotonRegresar() {
        const btnRegresar = document.getElementById("btn-regresar-anaplastologia");
        if (btnRegresar) {
            btnRegresar.addEventListener("click", function() {
                if (contenedorPrincipal && contenidoOriginalTarjetas !== "") {
                    contenedorPrincipal.innerHTML = contenidoOriginalTarjetas;
                    configurarBotonCargarModulo();
                }
            });
        }
    }



   window.buscarPorCodigo = function() {
    console.log("¡Función detectada!");
    
    var input = document.getElementById('input-busqueda');
    
    if (!input) {
        // Alerta de error estilizada
        Swal.fire({
            icon: 'error',
            title: 'Error técnico',
            text: 'No se encontró la caja de texto.',
            confirmButtonColor: '#03045E'
        });
        return;
    }

    var codigo = input.value.trim();
    if (codigo === "") {
        // Alerta de advertencia estilizada con tus colores
        Swal.fire({
            icon: 'warning',
            title: 'Campo Vacío',
            text: 'Por favor, ingrese un código para buscar.',
            confirmButtonColor: '#00B4D8',
            iconColor: '#FF595E'
        });
        return;
    }

    // Guardamos los datos
    localStorage.setItem('busqueda_codigo', codigo);
    localStorage.removeItem('f_lado'); 

    // Redirección (Ajusta esto según cómo funcione tu inicio.php)
    window.location.href = 'vistas/vistas-buscar-moldes.php';
         };

    // BOTON BUSCAR
    window.buscarMolde = function () {

    // 1. Validar Contextura Física (Obligatoria)
    const lado = document.querySelector('input[name="mano_lado"]:checked')?.value;


    if (!lado) {
        mostrarNotificacion("⚠️ Debes seleccionar el lado de la mano para buscar.", true);
        return;
    }

    // ==========================================================
    // Guardar TODOS los inputs automáticamente
    // ==========================================================

    document.querySelectorAll("input").forEach(input => {

        if (!input.name) return;

        // Radios
        if (input.type === "radio") {

            if (input.checked) {
                localStorage.setItem("f_" + input.name.replace("mano_", ""), input.value);
            }

        } else {

            localStorage.setItem("f_" + input.name, input.value);

        }

    });

    // ==========================================================
    // Redireccionar
    // ==========================================================

    window.location.href = "vistas/vistas-buscar-moldes.php";

};

    window.limpiarFormulario = function() {
    if (confirm("¿Limpiar formulario?")) {
        document.getElementById("form-busqueda-moldes").reset();
        mostrarNotificacion("✅ Formulario limpio.");
    }
    };
    // --- 2. VALIDACIONES Y RESTRICCIONES CLÍNICAS ---
    function aplicarRestriccionesFicha() {
        
        // A. CÓDIGO DEL MOLDE (Solo números)
        const inputCodigo = document.querySelector('input[name="codigo_molde"]');
        if (inputCodigo) {
            inputCodigo.addEventListener('input', function() {
                this.value = this.value.replace(/[^0-9]/g, ''); // Borra todo lo que no sea 0-9
            });
        }

        // Seleccionamos los inputs de datos personales por su posición relativa 
        // (ya que en el HTML no les pusimos ID aún).
        const inputsPersonales = document.querySelectorAll('.contenedor-datos-personales .input-medida');
        if(inputsPersonales.length >= 4) {
            const inputNombre = inputsPersonales[0];
            const inputEdad = inputsPersonales[1];
            const inputCelular = inputsPersonales[2];
            
            // B. NOMBRE (Solo letras, acentos y espacios)
            inputNombre.addEventListener('input', function() {
                this.value = this.value.replace(/[^a-zA-ZáéíóúÁÉÍÓÚñÑ\s]/g, '');
            });

            // C. EDAD (Solo números, no negativos, límite 120)
            inputEdad.addEventListener('input', function() {
                this.value = this.value.replace(/[^0-9]/g, ''); // Solo números
                if (parseInt(this.value) > 120) {
                    this.value = '120'; // Tope máximo
                }
            });

            // D. CELULAR (Solo números, máximo 12)
            inputCelular.setAttribute('maxlength', '12'); // Bloquea en 12 caracteres
            inputCelular.addEventListener('input', function() {
                this.value = this.value.replace(/[^0-9]/g, '');
            });
        }

        // E. TABLA DE MEDIDAS (Palma y Dedos)
        const inputsMedidas = document.querySelectorAll('.fila-medida input[type="number"]');
        inputsMedidas.forEach(input => {
            // Prevenir teclas inválidas en inputs numéricos (- , + , e)
            input.addEventListener('keydown', function(e) {
                if (e.key === '-' || e.key === '+' || e.key === 'e' || e.key === 'E') {
                    e.preventDefault();
                }
                // Si presionan punto, lo cambiamos a coma visualmente
                // (Nota: el input type="number" requiere '.' interno para decimales, 
                // pero si el navegador del usuario está en español, forzará la coma en la interfaz)
            });

            input.addEventListener('input', function() {
                if (this.value < 0) this.value = ''; // Evita valores negativos por pegar texto
            });
        });

        // F. COLUMNA "TIPO" (Solo letras, automático a mayúsculas)
        const inputsTipo = document.querySelectorAll('.fila-medida input[type="text"]');
        inputsTipo.forEach(input => {
            input.addEventListener('input', function() {
                // Borra números/símbolos y lo pasa a mayúsculas
                this.value = this.value.replace(/[^a-zA-ZáéíóúÁÉÍÓÚñÑ\s]/g, '').toUpperCase();
            });
        });

        // G. PREVENIR QUE EL "ENTER" ENVÍE EL FORMULARIO POR ACCIDENTE
        const formBusqueda = document.getElementById("form-busqueda-moldes");
        if (formBusqueda) {
            formBusqueda.addEventListener("keydown", function(e) {
                if (e.key === "Enter" && e.target.tagName !== "BUTTON") {
                    e.preventDefault();
                }
            });
        }
    }

    window.guardarMolde = function() {

    // 1. Validaciones

    // A. Código del Molde
    const codigo = document.querySelector('input[name="codigo_molde"]').value;
    if (!codigo || codigo.trim() === "") {
        mostrarNotificacion("⚠️ El CÓDIGO del molde es obligatorio.", true);
        return;
    }

    // B. Tipo de Prótesis
    if (!document.querySelector('input[name="tipo_protesis"]:checked')) {
        mostrarNotificacion("⚠️ Selecciona el TIPO DE PRÓTESIS.", true);
        return;
    }

    // C. Tipo de Registro
    if (!document.querySelector('input[name="tipo_registro"]:checked')) {
        mostrarNotificacion("⚠️ Selecciona el TIPO DE REGISTRO (Paciente/Donante/Molde).", true);
        return;
    }

    // D. Fecha
    if (!document.querySelector('input[name="fecha"]').value) {
        mostrarNotificacion("⚠️ La FECHA es obligatoria.", true);
        return;
    }

    // E. Contextura Física
    if (
        !document.querySelector('input[name="mano_lado"]:checked') ||
        !document.querySelector('input[name="mano_longitud"]:checked') ||
        !document.querySelector('input[name="mano_grosor"]:checked') ||
        !document.querySelector('input[name="mano_textura"]:checked')
    ) {
        mostrarNotificacion("⚠️ Completa toda la CONTEXTURA FÍSICA de la mano.", true);
        return;
    }

    // Si todas las validaciones pasan
    Swal.fire({
        title: '¿Guardar Registro?',
        text: '¿Está seguro de que desea guardar este registro en el sistema?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#00B4D8',
        cancelButtonColor: '#FF595E',
        confirmButtonText: 'Sí, guardar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {

        if (!result.isConfirmed) return;

        const form = document.getElementById("form-busqueda-moldes");
        const formData = new FormData(form);
        formData.set('accion', 'guardar');

        fetch('procesos/procesos-moldes.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            if (data.trim() === "OK") {
                mostrarNotificacion("✅ ¡Guardado exitosamente!");
                // form.reset();
            } else {
                mostrarNotificacion("❌ No se pudo guardar. Revise los campos", true);
                console.error(data);
            }
        })
        .catch(error => {
            mostrarNotificacion("❌ Error de conexión.", true);
            console.error(error);
        });

    });
};

    function mostrarNotificacion(mensaje, esError = false) {
            const div = document.createElement('div');

            // Estilos con la paleta de colores Creotec
            div.style.position = 'fixed';
            div.style.top = '50%';
            div.style.left = '50%';
            div.style.transform = 'translate(-50%, -50%)';
            div.style.padding = '20px 40px';
            // Azul oscuro para éxito, Rojo para error
            div.style.backgroundColor = esError ? '#FF595E' : '#03045E'; 
            div.style.color = 'white';
            div.style.borderRadius = '12px';
            div.style.zIndex = '10000';
            div.style.boxShadow = '0 10px 25px rgba(0,0,0,0.3)';
            div.style.fontSize = '18px';
            div.style.fontWeight = 'bold';
            div.style.textAlign = 'center';
            div.style.border = '2px solid #00B4D8';

            div.innerText = mensaje;

            document.body.appendChild(div);

            // Desaparece en 2.5 segundos
            setTimeout(() => {
                div.style.opacity = '0';
                div.style.transition = 'opacity 0.5s';
                setTimeout(() => div.remove(), 500);
            }, 2500);
    }

});