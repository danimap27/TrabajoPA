function submitForm() {
    var form = document.getElementById("loginForm");
    var errorMessage = document.getElementById("error-message");

    errorMessage.innerHTML = '';

    if (form.email.value === '' || !isValidEmail(form.email.value)) {
        errorMessage.innerHTML += '<p style="color: red; font-weight: bold">El usuario no es válido.</p>';
    }

    if (form.password.value === '') {
        errorMessage.innerHTML += '<p style="color: red; font-weight: bold">La contraseña debe rellenarse.</p>';
    }

    if (errorMessage.innerHTML === '') {
        fetch('login.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: new URLSearchParams(new FormData(form)),
        })
        .then(response => response.json())
        .then(errors => {
            errorMessage.innerHTML = errors.join('');

            if (errors.length === 0) {
                window.location.href = determineDashboardURL(); // Llama a la función para determinar la URL del dashboard
            }
        })
        .catch(error => console.error('Error:', error));
    }
}

function isValidEmail(email) {
    var pattern = /^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/i;
    return pattern.test(email);
}

function determineDashboardURL() {
    var userType = document.getElementById("loginForm").elements["type"].value;
    switch (userType) {
        case "administrador":
            return "admin_dashboard.php";
        case "cliente":
            return "cliente_dashboard.php";
        case "agente":
            return "agente_dashboard.php";
        default:
            return "unknown_dashboard.php";
    }
}
