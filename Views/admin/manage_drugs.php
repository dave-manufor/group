<?php
    require_once("./includes/drugController.php");
    $drug_id = "";
    $drug = null;
    $drugs = null;
    $update = "";
    $error = "";
    if(isset($_GET['id'])){
        $drug_id = $_GET['id'];
        if(isset($_POST['update'])){
          $name = $_POST['name'];
          $category = $_POST['category'];
          $quantity = $_POST['quantity'];
          $price = $_POST['price'];
          if(isset($_FILES['drug-image']) && $_FILES['drug-image']['name']){
              $drug_image = $_FILES['drug-image'];
            }else{
              $drug_image = null;
            }
          $res = $updateDrug(true, $drug_id, $name, $category, $quantity, $price, $drug_image);
          if($res['error']){
              echo "<script>alert('Something went wrong!\n".$res['message']."')</script>";
          }else{
            $justUpdated = true;
          }
        }
        $res = $getDrug(true, $drug_id);
        if($res['error']){
            $error = "Something went wrong<br>".$res['message'];
        }elseif(!$res['data']){
            $error = "No drug found with ID of '".$drug_id."'";
        }else{
            $drug = $res['data'];
        }
    }else{
            if(isset($_GET['del'])){
                $drug_id = $_GET['del'];
                $res = $deleteDrug(true, $drug_id);
                if($res['error']){
                    echo "<script>alert(".$res['message'].")</script>";
                }else{
                        $update = "(Drug has been deleted)";
                }
            }
            if(isset($_POST['create'])){
                $name = $_POST['name'];
                $category = $_POST['category'];
                $quantity = $_POST['quantity'];
                $price = $_POST['price'];
                if(isset($_FILES['drug-image']) && $_FILES['drug-image']['name']){
                    $drug_image = $_FILES['drug-image'];
                    }else{
                    $drug_image = null;
                    }
                    $res = $addDrug($name, $category, $quantity, $price, $drug_image);
                    if($res['error']){
                        echo "<script>alert('Something went wrong!\n".$res['message']."')</script>";
                    }else{
                        $justUpdated = true;
                        echo "<script>alert('Drug has been added')</script>";
                        echo "<script>window.location = './dashboard.php?view=manage-drugs'</script>";
                    }
            }
            $res = $getAllDrugs();
            if($res['error']){
                $error = "Something went wrong<br>".$res['message'];
            }elseif(count($res['data']) === 0){
                $error = "No drugs found";
            }else{
                $drugs = $res['data'];
            }
    }
?>
<div class="title-div">
    <h2 class="title">
        Drugs Manager <span><?php echo $update ?></span>
        <hr class="form-title-line" />
    </h2>
</div>
<div class="error-message <?php if(!$error) echo "closed"?>" id="error-container">
    <?php echo $error ?>    
</div>
<div class="content">
    <?php if(isset($_GET['id']) && $drug){
            include("./Views/admin/manage_drugs/edit_drug.php");
          }elseif(isset($_GET['action']) && $_GET['action'] == 'create'){
            include("./Views/admin/manage_drugs/add_drug.php");
          }else{
            include("./Views/admin/manage_drugs/default.php");
          } ?>
</div>




