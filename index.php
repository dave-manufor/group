<?php
  include_once("./php/registerPatient.php");


  if(isset($_POST['submit'])){
    $fname = $_POST['first-name'];
    $lname = $_POST['last-name'];
    $ssn = $_POST['ssn'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $weight = $_POST['weight'];
    $height = $_POST['height'];
    $age = $_POST['age'];
    $blood_group = $_POST['blood-group'];

    if(!$fname || !$lname || !$ssn || !$email || !$password || !$phone || !$address || !$weight || !$height || !$age || !$blood_group){
      echo '<script>alert("Kindly ensure that all fields are filled")</script>';
    }else{
      $res = $addPatient($fname, $lname, $ssn, $email, $password, $phone, $address, $weight, $height, $age, $blood_group);
      if($res){
        echo '<script>alert("Patients has successfully been registered!")</script>';
        // Direct to login page
        echo '<script type="text/javascript">document.location="./temp.php"</script>';
      }else{
        echo '<script>alert("Something went wrong. Try again")</script>';
      }
    }
  }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="./css/general.css" />
    <link rel="stylesheet" href="./css/signup.css" />
    <title>Patients Registration</title>
  </head>
  <body>
    <div class="image-section"></div>
    <div class="form-section">
      <div class="form-container">
        <div class="form-container-title-div">
          <h2 class="form-title">
            Get Started
            <hr class="form-title-line" />
          </h2>
          <button id="form-back-btn" class="hidden">
            <img src="./Resources/images/left-arrow.png" alt="left arrow" />
          </button>
        </div>
        <!-- REVERT -->
        <form action="" method="post">
          <!-- FORM TAB 1 -->
          <div class="form-tab" id="tab1">
            <div class="field half-field">
              <label for="first-name">First Name</label>
              <input type="text" id="first-name" name="first-name" placeholder="John" />
            </div>
            <div class="field half-field">
              <label for="last-name">Last Name</label>
              <input type="text" id="last-name" name="last-name" placeholder="Doe" />
            </div>
            <div class="field full-field">
              <label for="email">Email</label>
              <input
                type="email"
                id="email"
                name="email"
                placeholder="johndoe@example.com"
              />
            </div>
            <div class="field full-field">
              <label for="phone">Phone Number</label>
              <input type="text" id="phone"  name="phone" placeholder="0111461098" />
            </div>
            <div class="field full-field">
              <label for="ssn">Social Security Number</label>
              <input type="text" id="ssn" name="ssn" placeholder="A10266640" />
            </div>
            <button class="form-btn" id="continue-btn">Continue</button>
          </div>
          <!-- FORM TAB 2 -->
          <div class="form-tab hidden" id="tab2">
            <div class="field half-field">
              <label for="age">Age</label>
              <input type="number" id="age" name="age" placeholder="24" />
            </div>
            <div class="field half-field">
              <label for="height">Height (cm)</label>
              <input
                type="number"
                id="height"
                name="height"
                step="0.01"
                placeholder="156.24"
              />
            </div>
            <div class="field half-field">
              <label for="blood-group">Blood Group</label>
              <select name="blood-group" name="blood-group" id="blood-group">
                <option value="" disabled>Select a blood group</option>
                <option value="A+">A+</option>
                <option value="A-">A-</option>
                <option value="B+">B+</option>
                <option value="B-">B-</option>
                <option value="AB+">AB+</option>
                <option value="AB-">AB-</option>
                <option value="O+">O+</option>
                <option value="O-">O-</option>
              </select>
            </div>
            <div class="field half-field">
              <label for="weight">Weight (kg)</label>
              <input
                type="number"
                id="weight"
                name="weight"
                step="0.01"
                placeholder="125.38"
              />
            </div>

            <div class="field full-field">
              <label for="address">Address</label>
              <input
                type="text"
                id="address"
                name="address"
                placeholder="486 College Avenue, Fort Dodge, IA 50501"
              />
            </div>
            <div class="field full-field">
              <label for="password">Password</label>
              <div class="pass-field">
                <input type="password" id="password" name="password" />
                <img
                  id="password-view-btn"
                  src="./Resources/images/close-eye.png"
                  alt="closed-eye-icon"
                />
              </div>
            </div>
            <button class="form-btn" id="submit-btn" name="submit">Register</button>
          </div>
        </form>
      </div>
    </div>
    <script src="./js/signup.js"></script>
  </body>
</html>
