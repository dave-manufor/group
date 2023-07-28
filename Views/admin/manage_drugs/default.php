<?php if($drugs){?>
<div class="user-table-container">
          <table class="user-details-table">
              <thead>
                  <tr>
                      <th>#</th>
                      <th>Name</th>
                      <th>Quantity</th>
                      <th>Price</th>
                      <th>Actions</th>
                  </tr>
              </thead>
              <tbody class="user-details-table-data">
                  <?php $counter = 1;
                    foreach($drugs as $id => $drug){?>
                      <tr>
                          <td><?php echo $counter++ ?></td>
                          <td><?php echo $drug['drug_name']?></td>
                          <td><?php echo $drug['quantity'] ?></td>
                          <td><?php echo $drug['price'] ?></td>
                          <td>
                              <a href="./dashboard.php?view=manage-drugs&id=<?php echo $drug['drug_id']?>" title="View Details"><img src="./Resources/images/details-icon.png" alt="details"></a>
                              <a href="./dashboard.php?view=manage-drugs&del=<?php echo $drug['drug_id']?>" title="Delete User" onclick="return confirm('Please confirm you want to delete this drug');"><img src="./Resources/images/delete-icon.png" alt="delete"></a>
                          </td>
                      </tr>
                  <?php }?>
              </tbody>
          </table>
          </div>
          <?php }?>
          <a href="./dashboard.php?view=manage-drugs&action=create"><button class="button-primary">Add Drug</button></a>
            