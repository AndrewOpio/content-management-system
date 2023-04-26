<?php

if(!isset($_SESSION['user_log']) ) {
  session_start();
}
  $server = "localhost";
  $username = "root";
  $password = "";
  //$password = "Power333#";
  $dbname = "smart24tv";

  $db_port = 8889;

  $mysqli = new mysqli(
    $server,
    $username,
    $password,  
    $dbname
  );
	
  if ($mysqli->connect_error) {
    echo 'Errno: '.$mysqli->connect_errno;
    echo '<br>';
    echo 'Error: '.$mysqli->connect_error; 
    exit();
  }

if (isset($_POST['add_user'])) {
  $fname = $_POST['fname'];
  $lname = $_POST['lname'];
  $email = $_POST['email'];
  $profile = $_POST['profile'];
  $username = $_POST['user_name'];
  $usertype = $_POST['user_type'];
  $password = $_POST['password'];
  $encrypted_password = md5($password);

  $filename = $_FILES["image"]["name"];
  $tempname = $_FILES["image"]["tmp_name"];    
  $folder = "profile_pictures/".$filename;

  $imageFileType = strtolower(pathinfo($folder,PATHINFO_EXTENSION));

  $sql4 = "SELECT * FROM Users WHERE email = '$email'";
  $value = $mysqli->query($sql4);

  if ($value->num_rows > 0) {
    echo "exists"; 

  } else {
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
      echo "wrong_type";

    } else if (move_uploaded_file($tempname, $folder)) {
       // if (move_uploaded_file($tempname, $folder)){
      $sql1 = "INSERT INTO Users (fname, lname, email, profile, username, type_id, pasword, picture, usertype)
      VALUES ('$fname', '$lname', '$email', '$profile', '$username', '$usertype', '$encrypted_password', '$filename', 'Administrator')";
      // if (move_uploaded_file($tempname, $folder))  {
      //     echo "upload_pass";
 

      if ($mysqli->query($sql1) === TRUE) {
        echo "true";

      } else {
        echo $mysqli->error;
        
      }

      // }
    }
}


}else if(isset($_POST['edit_user'])){
    $id = $_POST['id'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $profile = $_POST['profile'];
    $username = $_POST['user_name'];
    $usertype = $_POST['user_type'];
    $password = $_POST['password'];
    $picture = $_POST['picture'];

    if ($picture != "") {
      $filename = $_FILES["image"]["name"];
      $tempname = $_FILES["image"]["tmp_name"];
      $folder = "profile_pictures/".$filename;

      $imageFileType = strtolower(pathinfo($folder,PATHINFO_EXTENSION));

      if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
        echo "wrong_type";

      } else if (move_uploaded_file($tempname, $folder)) {
        $sql3 = "UPDATE Users SET fname='$fname', lname='$lname', email='$email', profile='$profile', username='$username', type_id='$usertype', pasword='$password', picture = '$filename' WHERE id=$id";
      }

    } else {
      $sql3 = "UPDATE Users SET fname='$fname', lname='$lname', email='$email', profile='$profile', username='$username', type_id='$usertype', pasword='$password' WHERE id=$id";
    }

    if(mysqli_query($mysqli, $sql3)) {
       echo "true";

    } else {

      echo $mysqli->error;
    }
  
}else if(isset($_POST['delete_user'])){
  $id = $_POST['id'];

  $sql5 = "DELETE FROM Users WHERE id=$id";

if ($mysqli->query($sql5) === TRUE) {
  echo "true";
} else {
  echo "false";
}


} else if (isset($_POST['login_user'])) {
  $username = mysqli_real_escape_string($mysqli, $_POST['name']);
  $password = mysqli_real_escape_string($mysqli, $_POST['password']);
  $encrypted_password = md5($password);

  $sql6 = "SELECT email FROM Users WHERE username = '$username' AND pasword = '$password'";
  $result = $mysqli->query($sql6);

  if (!empty($result) && $result->num_rows > 0) {
      while($row = $result->fetch_assoc()){
        $user_email = $row['email'];
      }

      $_SESSION['user_log'] = $user_email;
      echo "true";

  } else {
    echo "fail";

  }

}else if(isset($_POST['logout'])){
  unset($_SESSION['user_log']);
  echo('true');

} else if(isset($_POST['add_post'])) {
  $title = $_POST['title'];
  $description = $_POST['description'];
  $category = $_POST['category'];
  $user_id = $_POST['user'];
  $body = $_POST['body'];
  $premium = 0;

  // $username = $_POST['user_name'];
  // $usertype = $_POST['user_type'];
  // $password = $_POST['password'];

  $slug = preg_replace("/-$/","",preg_replace('/[^a-z0-9]+/i', "-", strtolower($title)));

  $date = date("Y-m-d");
  $time = date("H:i:s");

  $filename = $_FILES["image"]["name"];
  $tempname = $_FILES["image"]["tmp_name"];    
  $folder = "posts/".$filename;

  $imageFileType = strtolower(pathinfo($folder,PATHINFO_EXTENSION));

  $sql7 = "SELECT * FROM Articles WHERE title = '$title'";
  $value = $mysqli->query($sql7);

  if ($value->num_rows > 0) {
    echo "exists"; 

  } else {
      if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
        echo "wrong_type";

      } else if (move_uploaded_file($tempname, $folder)) {
          // if (move_uploaded_file($tempname, $folder)){
          $sql8 = "INSERT INTO Articles (title, description, categoryid, date, time, image, authorid, body, premium, status, slug)
          VALUES ('$title', '$description', '$category', '$date', '$time', '$filename', '$user_id', '$body', '$premium', 0, '$slug')";
          // if (move_uploaded_file($tempname, $folder))  {
          //     echo "upload_pass";

          if ($mysqli->query($sql8) === TRUE) {
            echo "true";

          } else {
            echo $mysqli->error;
          }

          // }
      }
  }

} else if(isset($_POST['edit_post'])) {
  $id = $_POST['id'];
  $title = $_POST['title'];
  $description = $_POST['description'];
  $category = $_POST['category'];
  $body = $_POST['body'];
  $picture = $_POST['picture'];
  $premium = 0;

  $slug = preg_replace("/-$/","",preg_replace('/[^a-z0-9]+/i', "-", strtolower($title)));

  if ($picture != "") {
      $filename = $_FILES["image"]["name"];
      $tempname = $_FILES["image"]["tmp_name"];    
      $folder = "posts/".$filename;

      $imageFileType = strtolower(pathinfo($folder,PATHINFO_EXTENSION));

      if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
          echo "wrong_type";
      } else if (move_uploaded_file($tempname, $folder)) {
      // if (move_uploaded_file($tempname, $folder)){
      $sql9 = "UPDATE Articles SET title='$title', description='$description', body='$body', image='$filename',categoryid=$category, premium=$premium, slug='$slug' WHERE id=$id";
      // if (move_uploaded_file($tempname, $folder))  {
      //     echo "upload_pass";
      }
  } else {
    $sql9 = "UPDATE Articles SET title='$title', description='$description', body='$body', categoryid=$category, premium=$premium, slug='$slug' WHERE id=$id";
  }

  if ($mysqli->query($sql9) === TRUE) {
     echo "true";
  } else {
     echo $mysqli->error;
  }

} else if (isset($_POST['delete_post'])) {
  $id = $_POST['id'];

  $sql11 = "DELETE FROM Articles WHERE id=$id";

  if ($mysqli->query($sql11) === TRUE) {
    echo "true";

  } else {
    echo "false";

  }


}else if(isset($_POST['approve'])){
  $id = $_POST['id'];
  $status = $_POST['status'];

  if($status == "approve"){
      $sql12 = "UPDATE Articles SET status = 1 WHERE id=$id";
  } else {
     $sql12 = "UPDATE Articles SET status = 0 WHERE id=$id";
  }

  if ($mysqli->query($sql12) === TRUE) {
     echo "true";

  } else {
     echo $mysqli->error;

  }

}else if(isset($_POST['add_group'])){

  $user_group = $_POST['user_group'];



  $sql15 = "SELECT * FROM User_groups WHERE user_group = '$user_group'";
  $value = $mysqli->query($sql15);

  if ($value->num_rows > 0) {
    echo "exists"; 
  }else{
  $sql13 = "INSERT INTO User_groups (user_group)
  VALUES ('$user_group')";
// if (move_uploaded_file($tempname, $folder))  {
//     echo "upload_pass";

 
  if ($mysqli->query($sql13) === TRUE){
  echo "true";
  } else {
  echo $mysqli->error;
    }

}
}else if(isset($_POST['change_permission'])){
$id = $_POST['id'];
$post_view = $_POST['post_view'];
$post_edit = $_POST['post_edit'];
$post_delete = $_POST['post_delete'];
$accept = $_POST['accept'];
$post_add = $_POST['post_add'];
$all = $_POST['all'];

$view_category = $_POST['view_category'];
$add_category = $_POST['add_category'];
$edit_category = $_POST['edit_category'];
$delete_category = $_POST['delete_category'];

$user_view = $_POST['user_view'];
$user_delete = $_POST['user_delete'];
$user_edit = $_POST['user_edit'];
$user_add = $_POST['user_add'];

$page_view = $_POST['page_view'];
$page_delete = $_POST['page_delete'];
$page_edit = $_POST['page_edit'];
$page_add = $_POST['page_add'];

$dashboard = $_POST['dashboard'];

$groups = $_POST['groups'];

$add_social = $_POST['add_social'];
$edit_social = $_POST['edit_social'];
$view_social = $_POST['view_social'];
$delete_social = $_POST['delete_social'];

if($all == 1){
$sql13 = "UPDATE User_groups SET all_prev = $all, view_post = 1, edit_post = 1, delete_post = 1, approve = 1, add_post = 1, view_category = 1, add_category = 1, edit_category = 1, delete_category = 1, add_user = 1, edit_user = 1, delete_user = 1, view_user = 1, view_page = 1, edit_page = 1, delete_page = 1, add_page = 1, view_dashboard = 1, groups = 1, add_social = 1, edit_social = 1, view_social = 1, delete_social = 1 WHERE id=$id";
}else{
$sql13 = "UPDATE User_groups SET all_prev = $all, view_post = $post_view, edit_post = $post_edit, delete_post = $post_delete, approve = $accept, add_post = $post_add, view_category = $view_category, add_category = $add_category, edit_category = $edit_category, delete_category = $delete_category, add_user = $user_add, edit_user = $user_edit, delete_user = $user_delete, view_user = $user_view, view_page = $page_view, edit_page = $page_edit, delete_page = $page_delete, add_page = $page_add, view_dashboard = $dashboard, groups = $groups, add_social = $add_social, edit_social=$edit_social, view_social=$view_social, delete_social=$delete_social  WHERE id=$id";
}



if ($mysqli->query($sql13) === TRUE) {
  echo "true";
} else {
  echo $mysqli->error;
}

}else if(isset($_POST['delete_group'])){
  $id = $_POST['id'];

  $sql5 = "DELETE FROM User_groups WHERE id=$id";

if ($mysqli->query($sql5) === TRUE) {
  echo "true";
} else {
  echo "false";
}
}else if(isset($_POST['edit_group'])){
  $id = $_POST['id'];
  $name = $_POST['name'];


  $sql12 = "UPDATE User_groups SET user_group = '$name' WHERE id=$id";

  if ($mysqli->query($sql12) === TRUE) {
  echo "true";
} else {
  echo $mysqli->error;
}
}else if(isset($_POST['change_password'])){
  $email = mysqli_real_escape_string($mysqli, $_POST['email']);
  $password = mysqli_real_escape_string($mysqli, $_POST['password']);
  $encrypt = md5($password);
  $sql13 = "UPDATE Users SET pasword = '$password' WHERE email= '$email'";

  if ($mysqli->query($sql13) === TRUE) {
  echo "true";
} else {
  echo $mysqli->error;
}
}

?>