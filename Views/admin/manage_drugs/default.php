<?php if($drugs){?>
    <div>
        <div class="filters">
            <span class="filter active" data-filter="all">All</span>
            <span class="filter" data-filter="PAINKILLER">Pain Killers</span>
            <span class="filter" data-filter="ANTIBIOTICS">Antibiotics</span>
            <span class="filter" data-filter="INHALANTS">Inhalants</span>
            <span class="filter" data-filter="STIMULANTS">Stimulants</span>
        </div>
        <div class="drugs">
            <?php 
                foreach($drugs as $drug){
                    echo '
                    <div class="drug" data-category="'.$drug['category'].'">
                    <div class="image-wrapper"><img src="'.$drug['drug_image'].'"/></div>
                    <div class="text-wrapper">
                        <h3>'.$drug['drug_name'].'</h3>
                        <p>'.$drug['category'].'</p>
                        <div>
                            <a href="./dashboard.php?view=manage-drugs&id='.$drug['drug_id'].'" title="View Details"><img src="./Resources/images/details-icon.png" alt="details"></a>
                            <a href="./dashboard.php?view=manage-drugs&del='.$drug['drug_id'].'" title="Delete Drug" onclick="return confirm("Please confirm you want to delete this drug");"><img src="./Resources/images/delete-icon.png" alt="delete"></a>
                        </div>
                    </div>
                </div>
                    ';
                }
            ?>
        </div>
    </div>
          <?php }?>
          <a href="./dashboard.php?view=manage-drugs&action=create"><button class="button-primary">Add Drug</button></a>
          <script src="js/drugs.js"></script>
            