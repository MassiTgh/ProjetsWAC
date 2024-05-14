window.onload = function () {
  let profil_pic = document.getElementById("div_profil");
  let input_file = document.getElementById("file");
  let label = document.getElementById("label_file");
  let avatar = document.getElementById("avatar");

  profil_pic.addEventListener("mouseenter", function () {
    label.style.display = "block";
    input_file.style.display = "none";
  });
  profil_pic.addEventListener("mouseleave", function () {
    label.style.display = "none";
  });
  input_file.addEventListener("change", function () {
    const choosedFile = this.files[0];
    if (choosedFile) {
      const reader = new FileReader();
      reader.addEventListener("load", function () {
        console.log(reader.result);
        avatar.setAttribute("src", reader.result);
      });
      reader.readAsDataURL(choosedFile);
    }
  });

  let submit = document.querySelector("#submit");
  submit.addEventListener("click", (event) => {
    let name = document.getElementById("name").value;
    let username = document.getElementById("username").value;
    let password = document.getElementById("password").value;
    let city = document.getElementById("city").value;
    let bio = document.getElementById("bio").value;
    let campus = document.getElementById("campus").value;
    if (username) {
      if (!username.startsWith("@")) {
        event.preventDefault();
        document.querySelector("#error_username").innerText =
          "Manque @ au debut.";
      } else {
        document.getElementById("error_username").style.display = "none";
      }
    }

    if (password) {
      if (password.length < 8 || password.length > 20) {
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
    }
  });
};
