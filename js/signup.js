const form = document.querySelector(".signup form"),
  startBtn = form.querySelector(".button input"),
  errorText = form.querySelector(".error-txt");

form.onsubmit = (e) => {
  e.preventDefault();
};

startBtn.onclick = () => {
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "php/signup.php", true);
  xhr.onload = () => {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        let data = xhr.response;
        if (data.trim() === "Cadastro realizado com sucesso!") {
          errorText.textContent = "Cadastro realizado com sucesso!";
          errorText.style.color = "#03a34e";
          errorText.style.display = "block";
          setTimeout(() => {
            window.open("users.php", "_self");
          }, 1000);
        } else {
          errorText.textContent = data;
          errorText.style.display = "block";
        }
      }
    }
  };

  let formData = new FormData(form);
  xhr.send(formData);
};
