document.addEventListener('DOMContentLoaded', () => {
    const formPopup = document.querySelector(".form-popup");
    const signupLink = document.querySelector("#signup-link");
    const loginLink = document.querySelector("#login-link");

    // Animación entre Login y Registro
    signupLink.addEventListener("click", (e) => {
        e.preventDefault();
        formPopup.classList.add("show-signup");
    });

    loginLink.addEventListener("click", (e) => {
        e.preventDefault();
        formPopup.classList.remove("show-signup");
    });

    // Validación simple antes de enviar el formulario
    const forms = document.querySelectorAll("form");
    forms.forEach(form => {
        form.addEventListener("submit", (e) => {
            const inputs = form.querySelectorAll("input");
            let valido = true;

            inputs.forEach(input => {
                if (input.value.trim() === "") {
                    valido = false;
                    input.style.border = "2px solid red"; // Feedback visual de error
                }
            });

            if (!valido) {
                e.preventDefault(); // Evita que se envíe el formulario si hay campos vacíos
                alert("Por favor, completa todos los campos.");
            }
        });
    });
});