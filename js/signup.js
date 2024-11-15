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
const profile_field = document.getElementById("profile-picture");
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
  profile_field,
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

profile_field.addEventListener("change", function (e) {
  const selectedfile = e.target.files;
  if (selectedfile.length > 0) {
    const [imageFile] = selectedfile;
    const allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif)$/i;
    if (!allowedExtensions.exec(imageFile.name)) {
      showErrorMessage(
        "Only .jpeg, .jpg and .png files are allowed",
        profile_field
      );
      e.preventDefault();
    } else if (imageFile.size > 5 * 1024 * 1024) {
      showErrorMessage(
        "Only .jpeg, .jpg and .png files are allowed",
        profile_field
      );
      e.preventDefault();
    } else {
      hideErrorMessage(profile_field);
    }
  }
});

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
});

form.addEventListener("submit", async function (e) {
  e.preventDefault();
  const valid = await validate();
  if (!valid) {
    back_btn.onclick();
  } else {
    register_btn.innerHTML =
      '<img src="./Resources/images/loading-icon.svg" alt="loader icon">';
    // const imgURL = await getImageURL(profile_base64);
    // profile_url.value = await imgURL;
    HTMLFormElement.prototype.submit.call(form);
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
    showErrorMessage(data.message, email_field);
    return false;
  } else {
    hideErrorMessage(email_field);
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
  if (data.error) {
    showErrorMessage(data.message, ssn_field);
    return false;
  } else {
    hideErrorMessage(ssn_field);
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

const showErrorMessage = function (message, field = null) {
  error_container.classList.remove("closed");
  error_container.textContent = message;
  if (field) {
    field.classList.add("error");
    field.focus();
  }
};
const hideErrorMessage = function (field = null) {
  error_container.classList.add("closed");
  error_container.textContent = "";
  if (field) {
    field.classList.remove("error");
  }
};

// const getImageURL = async function (imageString) {
//   const url = freeimage_URL + "?key=" + freeimage_key;
//   const imgdata = new FormData();
//   imgdata.append("source", imageString);
//   const res = await fetch(url, {
//     method: "POST",
//     body: imgdata,
//   });
//   if (!res.ok) {
//     return "";
//   }

//   const json = await res.json();
//   imgURL = json.image.url;
//   return imgURL;
// };

email_field.onblur = validateEmail;

ssn_field.onblur = validateSSN;
