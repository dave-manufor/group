<?php if($doctors){?>
<div class="user-table-container">
          <table class="user-details-table">
              <thead>
                  <tr>
                      <th>SSN</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Speciality</th>
                      <th>Actions</th>
                  </tr>
              </thead>
              <tbody class="user-details-table-data">
                  <?php foreach($doctors as $id => $doctor){?>
                      <tr>
                          <td><?php echo $doctor['doctor_ssn'] ?></td>
                          <td><?php echo $doctor['doctor_lname']." ".$doctor['doctor_fname'] ?></td>
                          <td><a href="mailto:<?php echo $doctor['doctor_email'] ?>" class="link"><?php echo $doctor['doctor_email'] ?></a></td>
                          <td><?php echo $doctor['speciality'] ?></td>
                          <td>
                              <a href="./dashboard.php?view=manage-doctors&id=<?php echo $doctor['doctor_id']?>" title="View Details"><img src="./Resources/images/details-icon.png" alt="details"></a>
                              <a href="./dashboard.php?view=manage-doctors&del=<?php echo $doctor['doctor_id']?>" title="Delete User" onclick="return confirm('Please confirm you want to delete this patient');"><img src="./Resources/images/delete-icon.png" alt="delete"></a>
                          </td>
                      </tr>
                  <?php }?>
              </tbody>
          </table> 
                  </div>
                  <?php } ?>
                  <a href="./dashboard.php?view=manage-doctors&action=create"><button class="button-primary">Add Doctor</button></a>