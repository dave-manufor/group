const form = document.getElementById("register-form");
const back_btn = document.getElementById("form-back-btn");
const continue_btn = document.getElementById("continue-btn");
const register_btn = document.getElementById("submit-btn");
const password_view_btn = document.getElementById("password-view-btn");
const first_name_field = document.getElementById("first-name");
const last_name_field = document.getElementById("last-name");
const email_field = document.getElementById("email");
const phone_field = document.getElementById("phone");
const ssn_field = document.getElementById("ssn");
const age_field = document.getElementById("age");
const height_field = document.getElementById("height");
const blood_group_field = document.getElementById("blood-group");
const weight_field = document.getElementById("weight");
const address_field = document.getElementById("address");
const password_field = document.getElementById("password");
const password_field_container = document.getElementById("pass-field");
const error_container = document.getElementById("error-container");
const tab1 = document.getElementById("tab1");
const tab2 = document.getElementById("tab2");
const tab1_elements = [
  first_name_field,
  last_name_field,
  email_field,
  phone_field,
  ssn_field,
];
const tab2_elements = [
  age_field,
  height_field,
  blood_group_field,
  weight_field,
  address_field,
  password_field,
];
const checkAvailabilityURL = "check_availability.php";

continue_btn.onclick = function (e) {
  e.preventDefault();
  for (const field of tab1_elements) {
    if (field.value == "") {
      field.classList.add("error");
      field.focus();
      return;
    } else {
      field.classList.remove("error");
    }
  }

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

register_btn.addEventListener("click", async function (e) {
  for (const field of tab2_elements) {
    if (field.value == "") {
      e.preventDefault();
      if (field == password_field) {
        password_field_container.classList.add("error");
        field.focus();
      } else {
        field.classList.add("error");
        field.focus();
      }
      return;
    } else {
      field.classList.remove("error");
    }
  }

  if (!(await validate())) {
    e.preventDefault();
    back_btn.onclick();
  }
});

const validateEmail = async function () {
  const email = email_field.value;
  if (email == "") {
    return;
  }
  const formData = new FormData();
  formData.append("email", email);
  const response = await fetch(checkAvailabilityURL, {
    method: "POST",
    body: formData,
  });
  const data = await response.json();
  if (data.error) {
    error_container.classList.remove("closed");
    error_container.textContent = data.message;
    return false;
  } else {
    error_container.classList.add("closed");
    error_container.textContent = "";
    return true;
  }
};

const validateSSN = async function () {
  const ssn = ssn_field.value;
  if (ssn == "") {
    return;
  }
  const formData = new FormData();
  formData.append("ssn", ssn);
  const response = await fetch(checkAvailabilityURL, {
    method: "POST",
    body: formData,
  });
  const data = await response.json();
  console.log(data);
  if (data.error) {
    error_container.classList.remove("closed");
    error_container.textContent = data.message;
    return false;
  } else {
    error_container.classList.add("closed");
    error_container.textContent = "";
    return true;
  }
};

const validate = async function () {
  if (!(await validateEmail())) {
    return false;
  } else if (!(await validateSSN())) {
    return false;
  } else {
    return true;
  }
};

email_field.onblur = validateEmail;

ssn_field.onblur = validateSSN;

// form.addEventListener("submit", async function (e) {
//   e.preventDefault();
//   if (!(await validate())) {
//     back_btn.onclick();
//   } else {
//     form.submit();
//   }
// });
