<?php 
    require("./includes/drugController.php");
    require("./includes/patientController.php");
    require("./includes/pharmacyController.php");
    $patients = $getAllPatients()['data'];
    $drugs = $getAllDrugs()['data'];
    $pharmacies = $getAllPharmacies()['data'];
?>
<form action="" method="post" id="profile-form" enctype="multipart/form-data">
                <!-- FORM TAB 1 -->
                <fieldset class="profile-tab" id="fieldset" >
                    <div class="field half-field">
                        <label for="symptoms">Symptoms</label>
                        <input type="text" id="symptoms" name="symptoms" placeholder="Headache and Fever"  required/>
                    </div>
                    <div class="field half-field">
                    <label for="drug_id">Select Drug</label>
                        <select name="drug_id" name="drug_id" id="drug_id" required>
                            <option value="" selected disabled>Select a Drug</option>
                            <?php 
                                foreach($drugs as $drug){
                                    echo "<option value=".$drug['drug_id'].">".$drug['drug_name']."</option>";
                                }
                            ?>
                        </select>
                    </div>
                    <div class="field half-field">
                        <label for="frequency">Frequency (Hours)</label>
                        <input type="number" step="1" id="frequency" name="frequency" placeholder="6"  required/>
                    </div>
                    <div class="field half-field">
                    <label for="drug_id">Select Patient</label>
                        <select name="patient_id" name="patient_id" id="patient_id" required>
                            <option value="" selected disabled>Select a Patient</option>
                            <?php 
                                foreach($patients as $patient){
                                    echo "<option value=".$patient['patient_id'].">".$patient['patient_lname']." ".$patient['patient_fname']."</option>";
                                }
                            ?>

                        </select>
                    </div>
                    <div class="field half-field">
                    <label for="drug_id">Select Pharmacy</label>
                        <select name="pharmacy_id" name="pharmacy_id" id="pharmacy_id" required>
                            <option value="" selected disabled>Select a Pharmacy</option>
                            <?php 
                                foreach($pharmacies as $pharmacy){
                                    echo "<option value=".$pharmacy['pharmacy_id'].">".$pharmacy['pharmacy_name']."</option>";
                                }
                            ?>

                        </select>
                    </div>
                    
                </fieldset>
                <div class="button-group">
                <button type="submit" name="create" id="create-btn" class="button-primary">Prescribe</button>
                <a href="./dashboard.php?view=manage-prescriptions"><button id="cancel-btn" class="button-danger">Cancel</button></a>
                </div>
            </form>