<?php if($pharmacies){?>
<div class="user-table-container">
          <table class="user-details-table">
              <thead>
                  <tr>
                      <th>No.</th>
                      <th>Name</th>
                      <th>Address</th>
                      <th>Hours</th>
                      <th>Actions</th>
                  </tr>
              </thead>
              <tbody class="user-details-table-data">
                  <?php $counter = 1;
                    foreach($pharmacies as $id => $pharmacy){?>
                      <tr>
                          <td><?php echo $counter++ ?></td>
                          <td><?php echo $pharmacy['pharmacy_name']?></td>
                          <td><?php echo $pharmacy['pharmacy_street'].", ".$pharmacy['pharmacy_city'].", ".$pharmacy['pharmacy_state'].", ".$pharmacy['pharmacy_country'] ?></td>
                          <td><?php echo date("g:ia", strtotime($pharmacy['opening_time']))." - ".date("g:ia", strtotime($pharmacy['closing_time'])) ?></td>
                          <td>
                              <a href="./dashboard.php?view=manage-pharmacies&id=<?php echo $pharmacy['pharmacy_id']?>" title="View Details"><img src="./Resources/images/details-icon.png" alt="details"></a>
                              <a href="./dashboard.php?view=manage-pharmacies&del=<?php echo $pharmacy['pharmacy_id']?>" title="Delete Pharmacy" onclick="return confirm('Please confirm you want to delete this pharmacy');"><img src="./Resources/images/delete-icon.png" alt="delete"></a>
                          </td>
                      </tr>
                  <?php }?>
              </tbody>
          </table> 
                  </div>
                  <?php }?>
                  <a href="./dashboard.php?view=manage-pharmacies&action=create"><button class="button-primary">Add Pharmacy</button></a>