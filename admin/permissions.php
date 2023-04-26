<?php
  if(!isset($_SESSION['user_log'])) {
    echo "<script>window.location.href = 'index.php';</script>";

  } else {
    $email = $_SESSION['user_log'];
    
    $name=mysqli_query($con,"SELECT * FROM Users WHERE email = '$email'");

    if ($name) {
      echo "";
      
    } else {
      echo($name->error); 
    }
  }

  $priv=mysqli_query($con,"SELECT * FROM User_groups");
  if ($priv) {
    echo ""; 

  } else {
    echo($priv->error);

  }

  while ($role = mysqli_fetch_array($name)) 
  {
    $type = $role['type_id'];
  } 

  $priv=mysqli_query($con,"SELECT * FROM User_groups WHERE id = '$type'");
  if ($priv) {
    echo"";

  } else {
    echo($priv->error);
  }

  while ($here = mysqli_fetch_array($priv))
  {
    //all permissions
    $all_prev = $here['all_prev'];
    //post permissions   
    $add_post = $here['add_post'];
    $delete_post = $here['delete_post'];
    $view_post = $here['view_post'];
    $edit_post = $here['edit_post'];
    $approve = $here['approve'];
    //category permissions
    $add_category = $here['add_category'];
    $delete_category = $here['delete_category'];
    $edit_category = $here['edit_category'];
    $view_category = $here['view_category'];
    //page permissions
    $add_page = $here['add_page'];
    $delete_page = $here['delete_page'];
    $edit_page = $here['edit_page'];
    $view_page = $here['view_page'];
    //user permissions
    $add_user = $here['add_user'];
    $delete_user = $here['delete_user'];
    $edit_user = $here['edit_user'];
    $view_user = $here['view_user'];
    //dashboard
    $dashboard = $here['view_dashboard'];
    //user groups
    $user_groups =  $here['groups'];
    //socials
    $view_social = $here['view_social'];
    $add_social = $here['add_social'];
    $delete_social = $here['delete_social'];
    $edit_social = $here['edit_social'];
    $view_user = $here['view_user'];
  }
?>