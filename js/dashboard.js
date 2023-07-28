const form = document.getElementById("profile-form");
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
const update_btn = document.getElementById("update-btn");
const edit_btn = document.getElementById("edit-btn");
const edit_group = document.getElementById("edit-group");
const cancel_btn = document.getElementById("cancel-btn");
const fieldset = document.getElementById("fieldset");
const error_container = document.getElementById("error-container");
const checkAvailabilityURL = "check_availability.php";
const profile_field = document.getElementById("profile-picture");
const profile_preview = document.getElementById("profile-preview");
console.log(edit_btn);
const fields = [
  first_name_field,
  last_name_field,
  email_field,
  phone_field,
  ssn_field,
  age_field,
  height_field,
  blood_group_field,
  weight_field,
  address_field,
  password_field,
];
const initialEmail = email_field?.value;
const initialSsn = ssn_field?.value;

if (password_view_btn) {
  password_view_btn.onclick = function (e) {
    if (password_field.type == "password") {
      password_field.type = "text";
      password_view_btn.src = "./Resources/images/open-eye.png";
    } else {
      password_field.type = "password";
      password_view_btn.src = "./Resources/images/close-eye.png";
    }
  };
}

edit_btn.addEventListener("click", function (e) {
  console.log("clicked");
  fieldset.removeAttribute("disabled");
  edit_group.classList.add("hidden");
  update_btn.classList.remove("hidden");
  cancel_btn.classList.remove("hidden");
});

update_btn.addEventListener("click", async function (e) {
  for (const field of fields) {
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
  const valid = await validate();
  console.log(valid);
  if (!valid) {
    e.preventDefault();
  }
});

profile_field.addEventListener("change", function (e) {
  const selectedfile = e.target.files;
  if (selectedfile.length > 0) {
    const [imageFile] = selectedfile;
    const allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif)$/i;
    if (allowedExtensions.exec(imageFile.name)) {
      hideErrorMessage(profile_field);
      profile_preview.src = URL.createObjectURL(imageFile);
    } else {
      showErrorMessage(
        "Only .jpeg, .jpg and .png files are allowed",
        profile_field
      );
    }
  }
});

form.addEventListener("submit", async function (e) {
  update_btn.innerHTML =
    '<img src="./Resources/images/loading-icon.svg" alt="loader icon">';
  HTMLFormElement.prototype.submit.call(form);
});

const validateEmail = async function () {
  const email = email_field.value;
  if (email == "") {
    return;
  } else if (email == initialEmail) {
    error_container.classList.add("closed");
    error_container.textContent = "";
    email_field.classList.remove("error");
    return true;
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
    email_field.classList.add("error");
    return false;
  } else {
    error_container.classList.add("closed");
    error_container.textContent = "";
    email_field.classList.remove("error");
    return true;
  }
};

const validateSSN = async function () {
  if (ssn_field) {
    const ssn = ssn_field.value;
    if (ssn == "") {
      return;
    } else if (ssn == initialSsn) {
      error_container.classList.add("closed");
      error_container.textContent = "";
      ssn_field.classList.remove("error");
      return true;
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
      ssn_field.classList.add("error");
      return false;
    } else {
      error_container.classList.add("closed");
      error_container.textContent = "";
      ssn_field.classList.remove("error");
      return true;
    }
  } else {
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

const getImageURL = async function (imageString) {
  const url = freeimage_URL + "?key=" + freeimage_key;
  const imgdata = new FormData();
  imgdata.append("source", imageString);
  const res = await fetch(url, {
    method: "POST",
    body: imgdata,
  });
  if (!res.ok) {
    return "";
  }

  const json = await res.json();
  imgURL = json.data.medium.url;
  return imgURL;
};

if (email_field) {
  email_field.onblur = validateEmail;
}

if (ssn_field) {
  ssn_field.onblur = validateSSN;
}
