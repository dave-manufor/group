       <?php if($patients){?> 
        <div class="user-table-container">
          <table class="user-details-table">
              <thead>
                  <tr>
                      <th>SSN</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Phone Number</th>
                      <th>Actions</th>
                  </tr>
              </thead>
              <tbody class="user-details-table-data">
                  <?php foreach($patients as $id => $patient){?>
                      <tr>
                          <td><?php echo $patient['patient_ssn'] ?></td>
                          <td><?php echo $patient['patient_lname']." ".$patient['patient_fname'] ?></td>
                          <td><a href="mailto:<?php echo $patient['patient_email'] ?>" class="link"><?php echo $patient['patient_email'] ?></a></td>
                          <td><?php echo $patient['patient_mobile'] ?></td>
                          <td>
                              <a href="./dashboard.php?view=manage-patients&id=<?php echo $patient['patient_id']?>" title="View Details"><img src="./Resources/images/details-icon.png" alt="details"></a>
                              <a href="./dashboard.php?view=manage-patients&del=<?php echo $patient['patient_id']?>" title="Delete User" onclick="return confirm('Please confirm you want to delete this patient');"><img src="./Resources/images/delete-icon.png" alt="delete"></a>
                          </td>
                      </tr>
                  <?php }?>
              </tbody>
          </table>
          </div>
          <?php } ?>
          <a href="./dashboard.php?view=manage-patients&action=create"><button class="button-primary">Add Patient</button></a>
            