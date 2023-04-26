<?php
include('dbconnection.php');
include 'config.php';

include 'permissions.php';
 
$email = $_SESSION['user_log'];

?>
<!DOCTYPE html>
<html lang="en">
  <head>
      <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="Coderthemes">
        <link rel='shortcut icon' type='image/x-icon' href='../img/upava.png' />

      <!-- App title -->
      <title>UPAVA | Change Password</title>

     <!-- App css -->
      <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
      <link href="assets/css/core.css" rel="stylesheet" type="text/css" />
      <link href="assets/css/components.css" rel="stylesheet" type="text/css" />
      <link href="assets/css/icons.css" rel="stylesheet" type="text/css" />
      <link href="assets/css/pages.css" rel="stylesheet" type="text/css" />
      <link href="assets/css/menu.css" rel="stylesheet" type="text/css" />
      <link href="assets/css/responsive.css" rel="stylesheet" type="text/css" />
      <script src="assets/js/modernizr.min.js"></script> 

      <script>
        function change_password(email) {
          var password = document.getElementById("password1").value;
          var password2 = document.getElementById("password2").value;
          if(password == '' || password2 == ''){
            alert('Please provide all the required fields');

          } else if(password != password2){
            alert('Your passwords do not match');

          }else{  
            document.getElementById("change-pass").innerHTML = "Updating..."; 
            data = {  
              email : email, 
              password : password, 
              change_password: 'change_password'
              }   
              url = 'config.php';
            $.post(url, data, function(response) {
              document.getElementById("change-pass").innerHTML = "Update Password";
              if(response == 'true') { 
                alert('Password changed successfully');
                //location.reload(true);
                  data = {
                  logout: 'logout'
                }

              url = 'config.php';
              $.post(url, data, function(response) {
                  if(response == 'true'){
                      window.location.href = 'login.php';
                  }else{
                      alert('An error has occured');
                  }
                }); 
                // window.location.href = 'new.php';
              }else{ 
                alert(response);
              }
            });
          
          }
        }
      </script>
  </head>
  <body class="fixed-left">
  <div id="wrapper">
  
              <?php include('includes/header.php');?>
              <!-- ========== Left Sidebar Start ========== -->
              <?php include('includes/sidebar.php');?>
              <!-- Left Sidebar End -->
                <div class="content-page">
                  <!-- Start content -->
                  <div class="content">
                      <div class="container">
  
        <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
          <div class="card card-signin my-5">
            <div class="card-body">  
              <h5 class="card-title text-center">Change password</h5>
    
                <div class="form-label-group">
                  <label for="password">New password</label>
                  <input type="password" name="password" id="password1" class="form-control" placeholder="Enter new password" required="">

                <div class="form-label-group">
                  <label for="password">Confirm password</label>
                  <input type="password" name="password" id="password2" class="form-control" placeholder="Re-enter password" required="">
        
                </div>
                <br>
                <button class="btn btn-lg btn-primary btn-block" id = "change-pass" onclick="change_password('<?php echo $email; ?>')">Update Password</button>
    
            </div>
          </div>
        </div>
  </div>
  </div>
  </div>
  </div>
  </div>

  <script>
      var resizefunc = [];
  </script>
   <!-- jQuery  -->
   <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/detect.js"></script>
        <script src="assets/js/fastclick.js"></script>
        <script src="assets/js/jquery.blockUI.js"></script>
        <script src="assets/js/waves.js"></script>
        <script src="assets/js/jquery.slimscroll.js"></script>
        <script src="assets/js/jquery.scrollTo.min.js"></script>
        <!-- App js -->
        <script src="assets/js/jquery.core.js"></script>
        <script src="assets/js/jquery.app.js"></script>


  </body>
</html>