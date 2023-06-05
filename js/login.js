const form = document.querySelector(".login form"),
  startBtn = form.querySelector(".button input"),
  errorText = form.querySelector(".error-txt");

form.onsubmit = (e) => {
  e.preventDefault();
};

startBtn.onclick = () => {
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "php/login.php", true);
  xhr.onload = () => {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        let data = xhr.response;
        if (data.trim() === "Login realizado com sucesso!") {
          window.open("users.php", "_self");
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
































// const form = document.querySelector(".signup form"),
// continueBtn = form.querySelector(".button input"),
// errorText = form.querySelector(".error-txt");

// form.onsubmit = (e)=>{
//   e.preventDefault();
// }

// continueBtn.onclick = ()=>{
//   fetch("php/signup.php", {
//     method: "POST",
//     body: new FormData(form)
//   })
//   .then(response => response.text())
//   .then(data => {
//     if(data == "sucesso"){
//       window.history.replaceState(null, null, 'chat.php');
//       window.location.href = 'chat.php';
//     }else{
//       errorText.textContent = data;
//       errorText.style.display = "block";
//     }
//   })
//   .catch(error => console.error(error));
// }


// const form = document.querySelector(".signup form"),
// continueBtn = form.querySelector(".button input"),
// errorText = form.querySelector(".error-txt");

// form.onsubmit = (e)=>{
//   e.preventDefault();
// }

// continueBtn.onclick = ()=>{
//   let xhr = new XMLHttpRequest();
//   xhr.open("POST", "php/signup.php", true);
//   xhr.onload = ()=>{
//     if(xhr.readyState === XMLHttpRequest.DONE){
//       if(xhr.status === 200){
//         let data = xhr.response;
//         if(data == "sucesso"){
//           window.history.replaceState(null, null, 'chat.php');
//           window.location.reload();
//         }else{
//           errorText.textContent = data;
//           errorText.style.display = "block";
//         }
//       }
//     }
//   } 
//   let formData = new FormData(form);
//   xhr.send(formData);
// }