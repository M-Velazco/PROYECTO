function generatePassword(length) {
    var charset = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    var password = "";
    for (var i = 0; i < length; i++) {
        password += charset.charAt(Math.floor(Math.random() * charset.length));
    }
    return password;
}



function sendEmail(email, newPassword) {
    var formData = new FormData();
    formData.append("email", email);
    formData.append("newPassword", newPassword);
    

    fetch("../Restablecer_Contraseña.html", {
        method: "POST",
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert("Se ha enviado una nueva contraseña al correo electrónico proporcionado.");
        } else {
            alert("Hubo un error al enviar el correo. Por favor, inténtelo de nuevo más tarde.");
        }
    })
    .catch(error => {
        alert("Hubo un error al enviar el correo. Por favor, inténtelo de nuevo más tarde.");
        console.error(error);
    });
}

var forgotPasswordLink = document.getElementById("forgotPassword");

forgotPasswordLink.addEventListener("click", function(event) {
    event.preventDefault();

    var email = prompt("Ingrese su dirección de correo electrónico:");
    if (email) {
        var newPassword = generatePassword(10);
        sendEmail(email, newPassword);
    }
});

