<?php
    include('dbconnection.php');
    include "permissions.php";

   if(strlen($_SESSION['user_log'])==0) { 
       header('location:login.php');
   }

   $get = "SELECT * FROM Contacts";
   $data = mysqli_query($con, $get);
   $result = mysqli_fetch_assoc($data);


   if($_SERVER["REQUEST_METHOD"] == "POST"){
            $update = "UPDATE Contacts SET box = '$_POST[box]', area = '$_POST[area]',
                       district = '$_POST[district]', phone = '$_POST[phone]', whatsapp= '$_POST[whatsapp]',
                       email= '$_POST[email]'";

            $run = mysqli_query($con, $update);   
            header("Location: contact_info.php");
    }
?>



<!DOCTYPE html>
<html lang="en">
    <head>
        <title> UPAVA | Contact Information</title>
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
        <link rel='shortcut icon' type='image/x-icon' href='../img/upava.png' />

        <!-- App css -->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/core.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/components.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/icons.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/pages.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/menu.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/responsive.css" rel="stylesheet" type="text/css" />
        <script src="assets/js/modernizr.min.js"></script>
    </head>

    <body class="fixed-left">
        <div id="wrapper">

            <?php include('includes/header.php');?>

            <?php include('includes/sidebar.php');?>

            <div class="content-page">
                <div class="content">
                    <div class="container">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="page-title-box">
                                    <h4 class="page-title">Manage Contacts</h4>
                                    <ol class="breadcrumb p-0 m-0">
                                        <li>
                                            <a href="#">Contacts</a>
                                        </li>
                                        <li class="active">
                                            Manage Contacts
                                        </li>
                                    </ol>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-12">
                                <div class="page-title-box">
                                    <h4 class="page-title">Add Company Contact Information </h4>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-10 col-md-offset-1">
                                <div class="p-6">
                                    <div class="">
                                        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                                            <div class="form-group">
                                                <label class="form-label">Box number</label>
                                                <input type="text" name="box" class="form-control" value = "<?php echo $result["box"]?>" placeholder ="eg P.O.Box.." required>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label class="form-label">Area</label>
                                                <input type="text" name="area" class="form-control" value = "<?php echo $result["area"]?>" placeholder ="eg Makerere kikoni" required>
                                            </div>

                                            <div class="form-group">
                                                <label class="form-label">District</label>
                                                <input type="text" name="district" class="form-control" value = "<?php echo $result["district"]?>" placeholder ="eg Kampala, Uganda" required>
                                            </div>

                                            <div class="form-group">
                                                <label class="form-label">Phone number</label>
                                                <input type="text" name="phone" class="form-control" value = "<?php echo $result["phone"]?>" placeholder ="eg +256 777.." required>
                                            </div>

                                            <div class="form-group">
                                                <label class="form-label">Whatsapp number</label>
                                                <input type="text" name="whatsapp" class="form-control" value = "<?php echo $result["whatsapp"]?>" placeholder ="eg +256 777.." required> 
                                            </div>

                                            <div class="form-group">
                                                <label class="form-label">Email</label>
                                                <input type="email" name="email" class="form-control" value = "<?php echo $result["email"]?>" placeholder ="email.." required>
                                            </div>

                                            <div class="form-group">
                                                <button type = "submit" style = "margin-left : 0px;" class = "btn btn-primary">Save Contacts</button>
                                            </div>
                                        </form>
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












































