const form = document.querySelector(".login form"),
  continueBtn = form.querySelector(".button input"),
  errorText = form.querySelector(".error-text");

form.onsubmit = (e) => {
  e.preventDefault();
}

continueBtn.onclick = () => {
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "php/login.php", true);
  xhr.onload = () => {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        let data = xhr.responseText;
        if (data.trim() === "Proceso Exitoso") { // Modificado para coincidir con la respuesta PHP
          // Redirige al usuario a users.php después de un inicio de sesión exitoso
          window.location.href = "users.php";
        } else {
          errorText.style.display = "block";
          errorText.textContent = data;
        }
      }
    }
  }
  let formData = new FormData(form);
  // Envía el formulario
  xhr.send(formData);
}
