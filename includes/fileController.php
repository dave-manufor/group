<?php

$upload_dir = "./uploads/";
$profiles_dir = $upload_dir."profiles/";
$drugs_dir = $upload_dir."drugs/";

// add file
$addProfileImage = function($file_name,$file) use($profiles_dir){
    if($file){
        $target_dir = $profiles_dir;
        $path = pathinfo($file['name']);
        $ext = $path['extension'];
        $tmp_name = $file['tmp_name'];
        $destination = $target_dir.$file_name.".".$ext;

        if(!file_exists($destination)){
            move_uploaded_file($tmp_name, $destination);
        }

        return $destination;
    }else{
        return "";
    }
};

// delete file
$deleteProfileImage = function($file_name) use($profiles_dir){
    $dir = $profiles_dir.$file_name.".*";
    $files = glob($dir);
    if($files){
        foreach($files as $file){
            unlink($file);
        }
        return true;
    }else{
        return false;
    }
};

// update file
$updateProfileImage = function($file_name,$file) use($profiles_dir, $deleteProfileImage){
    if($file){
        $deleteProfileImage($file_name);
        $target_dir = $profiles_dir;
        $path = pathinfo($file['name']);
        $ext = $path['extension'];
        $tmp_name = $file['tmp_name'];
        $destination = $target_dir.$file_name.".".$ext;
        move_uploaded_file($tmp_name, $destination);
        return $destination;
    }else{
        return "";
    }
};

// add file
$addDrugImage = function($file_name,$file) use($drugs_dir){
    if($file){
        $target_dir = $drugs_dir;
        $path = pathinfo($file['name']);
        $ext = $path['extension'];
        $tmp_name = $file['tmp_name'];
        $destination = $target_dir.$file_name.".".$ext;

        if(!file_exists($destination)){
            move_uploaded_file($tmp_name, $destination);
        }

        return $destination;
    }else{
        return "";
    }
};

// delete file
$deleteDrugImage =function($file_name) use($drugs_dir){
    $dir = $drugs_dir.$file_name.".*";
    $files = glob($dir);
    if($files){
        foreach($files as $file){
            unlink($file);
        }
        return true;
    }else{
        return false;
    }
};

// update file
$updateDrugImage = function($file_name,$file) use($drugs_dir, $deleteDrugImage){
    if($file){
        $deleteDrugImage($file_name);
        $target_dir = $drugs_dir;
        $path = pathinfo($file['name']);
        $ext = $path['extension'];
        $tmp_name = $file['tmp_name'];
        $destination = $target_dir.$file_name.".".$ext;
        move_uploaded_file($tmp_name, $destination);
        return $destination;
    }else{
        return "";
    }
};
?>