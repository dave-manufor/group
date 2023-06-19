const form = document.getElementById("login-form");
const password_view_btn = document.getElementById("password-view-btn");
const email_field = document.getElementById("email");
const password_field = document.getElementById("password");
const password_field_container = document.getElementById("pass-field");
const error_container = document.getElementById("error-container");
const authenticationURL = "./includes/Authentication/authentication.php";

password_view_btn.onclick = function (e) {
  if (password_field.type == "password") {
    password_field.type = "text";
    password_view_btn.src = "./Resources/images/open-eye.png";
  } else {
    password_field.type = "password";
    password_view_btn.src = "./Resources/images/close-eye.png";
  }
};

form.addEventListener("submit", async function (e) {
  e.preventDefault();
  const email = email_field.value;
  const pass = password_field.value;
  const formData = new FormData(form);
  formData.append("login", "");
  const res = await fetch(authenticationURL, {
    method: "post",
    body: formData,
  });
  const data = await res.json();
  if (data.error) {
    error_container.classList.remove("closed");
    error_container.innerHTML = data.message;
  } else {
    error_container.classList.add("closed");
    error_container.innerHTML = "";
    document.location = data.url;
  }
});
