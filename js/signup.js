const back_btn = document.getElementById("form-back-btn");
const continue_btn = document.getElementById("continue-btn");
const register_btn = document.getElementById("submit-btn");
const password_view_btn = document.getElementById("password-view-btn");
const password_field = document.getElementById("password");
const tab1 = document.getElementById("tab1");
const tab2 = document.getElementById("tab2");

continue_btn.onclick = function (e) {
  e.preventDefault();
  tab1.classList.add("hidden");
  tab2.classList.remove("hidden");
  back_btn.classList.remove("hidden");
};

back_btn.onclick = function (e) {
  tab1.classList.remove("hidden");
  tab2.classList.add("hidden");
  back_btn.classList.add("hidden");
};

password_view_btn.onclick = function (e) {
  if (password_field.type == "password") {
    password_field.type = "text";
    password_view_btn.src = "./Resources/images/open-eye.png";
  } else {
    password_field.type = "password";
    password_view_btn.src = "./Resources/images/close-eye.png";
  }
};
