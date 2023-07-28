<?php if($admins){?>
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
                  <?php foreach($admins as $id => $admin){?>
                      <tr>
                          <td><?php echo $admin['admin_ssn'] ?></td>
                          <td><?php echo $admin['admin_lname']." ".$admin['admin_fname'] ?></td>
                          <td><a href="mailto:<?php echo $admin['admin_email'] ?>" class="link"><?php echo $admin['admin_email'] ?></a></td>
                          <td><?php echo $admin['admin_mobile'] ?></td>
                          <td>
                              <a href="./dashboard.php?view=manage-admins&id=<?php echo $admin['admin_id']?>" title="View Details"><img src="./Resources/images/details-icon.png" alt="details"></a>
                              <a href="./dashboard.php?view=manage-admins&del=<?php echo $admin['admin_id']?>" title="Delete User" onclick="return confirm('Please confirm you want to delete this admin');"><img src="./Resources/images/delete-icon.png" alt="delete"></a>
                          </td>
                      </tr>
                  <?php }?>
              </tbody>
          </table>
          </div>
          <?php }?>
          <a href="./dashboard.php?view=manage-admins&action=create"><button class="button-primary">Add Admin</button></a>
            