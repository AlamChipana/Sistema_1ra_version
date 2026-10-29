// Esperar a que todo el documento cargue
document.addEventListener("DOMContentLoaded", () => {
    // Seleccionar los elementos del DOM
    const body = document.querySelector("body"),
          modeToggle = body.querySelector(".mode-toggle"),
          sidebar = document.querySelector("nav"),
          sidebarToggle = body.querySelector(".sidebar-toggle");

    // Lógica para abrir y cerrar la barra lateral
    if(sidebarToggle) {
        sidebarToggle.addEventListener("click", () => {
            sidebar.classList.toggle("close");
        });
    }

    // Lógica para activar/desactivar el Modo Oscuro
    if(modeToggle) {
        modeToggle.addEventListener("click", () => {
            body.classList.toggle("dark");
        });
    }
    // --- LÓGICA DEL CARRUSEL AUTOMÁTICO PARA EL BANNER DE INICIO ---
    let currentSlide = 0;
    const totalSlides = 3; // Número de imágenes que pusimos en el slider

    function moverSlider() {
    const sliderContainer = document.querySelector(".slider-container");
    // Verificamos si el elemento existe en la pantalla actual (evita errores en otras páginas)
    if (sliderContainer) {
        currentSlide = (currentSlide + 1) % totalSlides;
        // Calculamos el porcentaje de desplazamiento horizontal (0%, -33.33%, -66.66%)
        const desplazamiento = currentSlide * (100 / totalSlides);
        sliderContainer.style.transform = `translateX(-${desplazamiento}%)`;
    }
    }
    // Ejecutar la función automáticamente cada 4000 milisegundos (4 segundos)
    setInterval(moverSlider, 4000);
});