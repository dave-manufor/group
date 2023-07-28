<?php if($prescriptions){?>
<div class="user-table-container">
          <table class="user-details-table">
              <thead>
                  <tr>
                      <th>Patient</th>
                      <th>Symptoms</th>
                      <th>Drug</th>
                      <th>Pharmacy</th>
                      <th>Actions</th>
                  </tr>
              </thead>
              <tbody class="user-details-table-data">
                  <?php foreach($prescriptions as $id => $prescription){?>
                      <tr>
                          <td><?php echo $prescription['patient_lname']." ".$prescription['patient_fname'] ?></td>
                          <td><?php echo $prescription['symptoms']?></td>
                          <td><?php echo $prescription['drug_name'] ?></td>
                          <td><?php echo $prescription['pharmacy_name'] ?></td>
                          <td>
                              <a href="./dashboard.php?view=manage-prescriptions&id=<?php echo $prescription['prescription_id']?>" title="View Details"><img src="./Resources/images/details-icon.png" alt="details"></a>
                              <a href="./dashboard.php?view=manage-prescriptions&del=<?php echo $prescription['prescription_id']?>" title="Delete User" onclick="return confirm('Please confirm you want to delete this prescription');"><img src="./Resources/images/delete-icon.png" alt="delete"></a>
                          </td>
                      </tr>
                  <?php }?>
              </tbody>
          </table>
          </div>
          <?php }?>
          <a href="./dashboard.php?view=manage-prescriptions&action=create"><button class="button-primary">Add prescription</button></a>
            