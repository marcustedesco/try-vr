<?php
$target_dir = "uploads/";
$uploadOk = 1;

$filecount = 0;
$files = glob($target_dir . "*");
if ($files){
 $filecount = count($files)+1;
}
echo "There were $filecount files";

//TODO
//will need to change this to accept more types
$target_file = $target_dir . $filecount . ".jpg";


$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
// if ($_FILES["fileToUpload"]["size"] > 500000) {
//     echo "Sorry, your file is too large.";
//     $uploadOk = 0;
// }
// Allow certain file formats
// if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
// && $imageFileType != "gif" ) {
//     echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
//     $uploadOk = 0;
// }
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
	// You should name it uniquely.
    // DO NOT USE $_FILES['upfile']['name'] WITHOUT ANY VALIDATION !!
    // On this example, obtain safe unique name from its binary data.
    // if (!move_uploaded_file(
    //     $_FILES['upfile']['tmp_name'],
    //     sprintf('./uploads/%s.%s',
    //         sha1_file($_FILES['upfile']['tmp_name']),
    //         $ext
    //     )
    // )) {
    //     throw new RuntimeException('Failed to move uploaded file.');
    // }

    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded as ".$target_file.".";
        // header( "Location: http://marcustedesco.com/try-vr/" );
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
?>