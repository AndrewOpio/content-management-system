<?php 
include('dbconnection.php');
error_reporting(0);
if(strlen($_SESSION['user_log'])==0)
  { 
header('location:login.php');
}
else{
if(isset($_POST['update']))
{

$imgfile=$_FILES["image"]["name"];
// get the image extension
$extension = substr($imgfile,strlen($imgfile)-4,strlen($imgfile));
// allowed extensions
$allowed_extensions = array(".jpg","jpeg",".png",".gif",".JPG",".PNG","JPEG");

if(!in_array($extension,$allowed_extensions))
{
echo "<script>alert('Please upload either a jpg, jpeg, png or gif format');</script>";
}
else
{
//rename the image file
$imgnewfile= md5($imgfile).$extension;
// Code for move image into directory
move_uploaded_file($_FILES["image"]["tmp_name"], "../img/".$imgnewfile);



$socialid=intval($_GET['id']);
$query=mysqli_query($con,"update Socials set image='$imgnewfile' where id='$socialid'");
if($query)
{
$msg="Social link image has been updated ";
}
else{
$error="Error encountered when updating social link image.";    
} 
}
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">
        <link rel='shortcut icon' type='image/x-icon' href='../img/upava.png' />

        <!-- App title -->
        <title>UPAVA | Edit Social link</title>

        <!-- Summernote css -->
        <link href="/plugins/summernote/summernote.css" rel="stylesheet" />

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

        <!-- Begin page -->
        <div id="wrapper">

            <!-- Top Bar Start -->
           <?php include('includes/header.php');?>
            <!-- ========== Left Sidebar Start ========== -->
             <?php include('includes/sidebar.php');?>
            <!-- Left Sidebar End -->

            <div class="content-page">
                <!-- Start content -->
                <div class="content">
                    <div class="container">


                        <div class="row">
							<div class="col-xs-12">
								<div class="page-title-box">
                                    <h4 class="page-title">Update Social link Image </h4>
                                    <ol class="breadcrumb p-0 m-0">
                                        <li>
                                            <a href="#"> Social Links </a>
                                        </li>
                                           <li>
                                            <a href="#"> Edit Social Link </a>
                                        </li>
                                        <li class="active">
                                           Update Social Link Image
                                        </li>
                                    </ol>
                                    <div class="clearfix"></div>
                                </div>
							</div>
						</div>
                        <!-- end row -->

<div class="row">
<div class="col-sm-6">  
<!---Success Message--->  
<?php if($msg){ ?>
<div class="alert alert-success" role="alert">
<strong></strong> <?php echo htmlentities($msg);?>
</div>
<?php } ?>

<!---Error Message--->
<?php if($error){ ?>
<div class="alert alert-danger" role="alert">
<strong></strong> <?php echo htmlentities($error);?></div>
<?php } ?>


</div>
</div>
<form name="addsocial" method="post" enctype="multipart/form-data">
<?php
$socialid=intval($_GET['id']);
$query=mysqli_query($con,"select image,title from Socials where id='$socialid'");
while($row=mysqli_fetch_array($query))
{
?>
                        <div class="row">
                            <div class="col-md-10 col-md-offset-1">
                                <div class="p-6">
                                    <div class="">
                                        <form name="addsocial" method="post">
 <div class="form-group m-b-20">
<label for="exampleInputEmail1">Link Title</label>
<input type="text" class="form-control" id="title" value="<?php echo htmlentities($row['title']);?>" name="title"  readonly>
</div>



 <div class="row">
<div class="col-sm-12">
 <div class="card-box">
<h4 class="m-b-30 m-t-0 header-title"><b>Current Link Image</b></h4>
<img src="<?php echo htmlentities("../img/".$row['image']);?>" width="300"/>
<br />

</div>
</div>
</div>

<?php } ?>
<div class="row">
<div class="col-sm-12">
 <div class="card-box">
<h4 class="m-b-30 m-t-0 header-title"><b>New Link Image</b></h4>
<input type="file" class="form-control" id="image" name="image"  required>
</div>
</div>
</div>

<button type="submit" name="update" class="btn btn-success waves-effect waves-light">Update </button>
</form>
                                    </div>
                                </div> <!-- end p-20 -->
                            </div> <!-- end col -->
                        </div>
                        <!-- end row -->



                    </div> <!-- container -->

                </div> <!-- content -->

          

            </div>


        </div>
        <!-- END wrapper -->



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

        <!--Summernote js-->
        <script src="/plugins/summernote/summernote.min.js"></script>
        <!-- App js -->
        <script src="assets/js/jquery.core.js"></script>
        <script src="assets/js/jquery.app.js"></script>

        <!--Summernote js-->
        <script src="/plugins/summernote/summernote.min.js"></script>



    </body>
</html>
<?php } ?>
