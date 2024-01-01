function submitForm() {
    var form = document.getElementById("loginForm");
    var errorMessage = document.getElementById("error-message");

    // Limpia el contenido actual del elemento de mensaje de error
    while (errorMessage.firstChild) {
        errorMessage.removeChild(errorMessage.firstChild);
    }

    // Verifica y agrega mensajes de error según sea necesario
    if (form.email.value === '' || !isValidEmail(form.email.value)) {
        errorMessage.appendChild(document.createTextNode('El usuario no es válido.'));
    }

    if (form.password.value === '') {
        errorMessage.appendChild(document.createTextNode('La contraseña debe rellenarse.'));
    }

    if (errorMessage.childNodes.length === 0) {
        fetch('login.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: new URLSearchParams(new FormData(form)),
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                if (data.redirect) {
                    window.location.href = data.redirect;
                }
            } else {
                // Agrega mensajes de error al elemento de mensaje de error
                data.errors.forEach(error => {
                    errorMessage.appendChild(document.createTextNode(error));
                });
            }
        })
        .catch(error => console.error('Error:', error));
    }
}
