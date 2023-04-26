<?php

//upload.php

if(isset($_FILES['upload']['name']))
{ 

 $file = $_FILES['upload']['tmp_name'];
 $file_name = $_FILES['upload']['name']; 
 $file_name_array = explode(".", $file_name);
 $extension = end($file_name_array);
 $new_image_name = rand() . '.' . $extension;
 chmod('posts', 0777);
 $imageFileType = strtolower(pathinfo($file_name_array,PATHINFO_EXTENSION));
 $allowed_extension = array("jpg", "gif", "png", "gif", "jpeg");

 if(in_array($extension, $allowed_extension))
 {
  move_uploaded_file($file, 'posts/'.$file_name);
  $funcNum = $_GET['CKEditorFuncNum'];
  $url = 'http://localhost/smart24tv/admin/posts/'.$file_name;
  $message = ''; 

   echo "<script type='text/javascript'> window.parent.CKEDITOR.tools.callFunction($funcNum, '$url', '$message')</script>";
 }
} else {
    $funcNum = $_GET['CKEditorFuncNum'];
    $url = 'http://localhost/smart24tv/admin/posts/'.$file_name;
    $message = 'Please provide a valid image';
    echo "<script type='text/javascript'> window.parent.CKEDITOR.tools.callFunction($funcNum, '$url', '$message')</script>";
}

?>