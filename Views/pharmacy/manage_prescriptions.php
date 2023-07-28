<?php
    require_once("./includes/prescriptionController.php");
    $prescription_id = "";
    $prescription = null;
    $prescriptions = null;
    $update = "";
    $error = "";
    if(isset($_GET['id'])){
        $prescription_id = $_GET['id'];
          $res = $handlePrescription($prescription_id);
          if($res['error']){
              echo "<script>alert('Something went wrong!\n".$res['message']."')</script>";
          }else{
            $justUpdated = true;
          }
        if($res['error']){
            $error = "Something went wrong<br>".$res['message'];
        }elseif(!$res['data']){
            $error = "No prescription found with ID of '".$prescription_id."'";
        }else{
            $prescription = $res['data'];
        }
    }
        $res = $getAllPrescriptions(true, 0);
        if($res['error']){
            $error = "Something went wrong<br>".$res['message'];
        }elseif(count($res['data']) === 0){
            $error = "No prescriptions found";
        }else{
            $prescriptions = $res['data'];
        }
?>
<div class="title-div">
    <h2 class="title">
        Prescriptions Manager <span><?php echo $update ?></span>
        <hr class="form-title-line" />
    </h2>
</div>
<div class="error-message <?php if(!$error) echo "closed"?>" id="error-container">
    <?php echo $error ?>    
</div>
<div class="content">
<?php if($prescriptions){?>
<div class="user-table-container">
          <table class="user-details-table">
              <thead>
                  <tr>
                      <th>Drug</th>
                      <th>Patient</th>
                      <th>Doctor</th>
                      <th>Status</th>
                      <th>Actions</th>
                  </tr>
              </thead>
              <tbody class="user-details-table-data">
                  <?php foreach($prescriptions as $id => $prescription){?>
                      <tr>
                          <td><?php echo $prescription['drug_name']." ".$prescription['patient_fname'] ?></td>
                          <td><?php echo $prescription['patient_lname']." ".$prescription['patient_fname']?></td>
                          <td><?php echo $prescription['doctor_lname']." ".$prescription['doctor_fname'] ?></td>
                          <td><?php echo (($prescription['drug_dispensed']) ? "Dispensed" : "Pending") ?></td>
                          <td>
                              <a href="./dashboard.php?view=manage-prescriptions&id=<?php echo $prescription['prescription_id']?>" title="View Details"><img src="./Resources/images/details-icon.png" alt="details"></a>
                          </td>
                      </tr>
                  <?php }?>
              </tbody>
          </table>
          </div>
          <?php }?>
            
</div>




