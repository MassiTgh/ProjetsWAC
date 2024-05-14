window.onload = function () {
  let submit = document.querySelector("#submit");
  submit.addEventListener("click", (event) => {
    let username = document.getElementById("username").value;
    let password = document.getElementById("password").value;

    if (!username) {
      event.preventDefault();
      document.getElementById("error_username").innerText =
        "Veuillez remplir le champ";
      document.getElementById("error_username").style.display = "block";
    } else if (!username.includes("@") || !username.includes(".")) {
      event.preventDefault();
      document.getElementById("error_username").innerText = "Manque @ ou .";
      document.getElementById("error_username").style.display = "block";
    } else {
      document.getElementById("error_username").style.display = "none";
    }

    if (!password) {
      event.preventDefault();
      document.getElementById("error_password").innerText =
        "Veuillez remplir le champ";
      document.getElementById("error_password").style.display = "block";
    } else if (password.length < 8 || password.length > 20) {
      event.preventDefault();
      document.getElementById("error_password").innerText =
        "Please enter a password between 8 and 20 characters.";
      document.getElementById("error_password").style.display = "block";
    } else if (!password.match(/[a-z]/g)) {
      event.preventDefault();
      document.getElementById("error_password").innerText =
        "Please include at least one lowercase character.";
      document.getElementById("error_password").style.display = "block";
    } else if (!password.match(/[A-Z]/g)) {
      event.preventDefault();
      document.getElementById("error_password").innerText =
        "Please include at least one uppercase character.";
      document.getElementById("error_password").style.display = "block";
    } else if (!password.match(/[0-9]/g)) {
      event.preventDefault();
      document.getElementById("error_password").innerText =
        "Please include at least one number.";
      document.getElementById("error_password").style.display = "block";
    } else if (!password.match(/[^a-zA-Z\d]/g)) {
      event.preventDefault();
      document.getElementById("error_password").innerText =
        "Please include at least one special character.";
      document.getElementById("error_password").style.display = "block";
    } else {
      document.getElementById("error_password").style.display = "none";
    }
  });
};
