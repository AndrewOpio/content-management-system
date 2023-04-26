<?php
include('dbconnection.php');
include('permissions.php');
error_reporting(0);
if(strlen($_SESSION['user_log'])==0)
  { 
header('location:login.php');
}
else{
if(isset($_GET['id']))
{
$id=$_GET['id'];
$msg=mysqli_query($con,"delete from Pages where id='$id'");
if($msg)
{
echo "<script>alert('Page deleted');</script>";
}
}

?>
<!DOCTYPE html>
<html lang="en">
    <head>

        <title>UPAVA | Manage Pages</title>  
        <link rel='shortcut icon' type='image/x-icon' href='img/logo.png' />

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



            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="content-page">
                <!-- Start content -->
                <div class="content">
                    <div class="container">


                        <div class="row">
							<div class="col-xs-12">
								<div class="page-title-box">
                                    <h4 class="page-title">Manage Pages</h4>
                                    <ol class="breadcrumb p-0 m-0">
                                        <li>
                                            <a href="#">Pages </a>
                                        </li>
                                        <li class="active">
                                           Manage Pages
                                        </li>
                                    </ol>
                                    <div class="clearfix"></div>
                                </div>
							</div>
						</div>
                        <!-- end row -->


<div class="row">
<div class="col-sm-6">  


</div>
                                 
                                 
                                    


                                   


                                    <div class="row">
										<div class="col-md-12">

<?php if($add_page == 1) {?>											<div class="demo-box m-t-20">
<div class="m-b-10">
<a href="addpage.php">
<button id="addToTable" class="btn btn-success waves-effect waves-light">Add Page <i class="mdi mdi-plus-circle-outline" ></i></button>
</a>
 </div>
<?php } ?>

												<div class="table-responsive">
                                                    <table class="table m-0 table-colored-bordered table-bordered-primary">
                                                        <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>Title</th>
                                                                <th>Page URL</th>
                                                          
                                                                <th>Page Details</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
<?php 
$query=mysqli_query($con,"Select * from Pages");
$cnt=1;
while($row=mysqli_fetch_array($query))
{
?>
 
 <tr>
<th scope="row"><?php echo htmlentities($cnt);?></th>
<td><?php echo htmlentities($row['title']);?></td>
<td><?php echo htmlentities($row['url']);?></td>
<td><?php echo htmlentities($row['description']);?></td>

<?php if($edit_page == 1) { ?>
<td><a href="editpage.php?id=<?php echo htmlentities($row['id']);?>&type=<?php echo htmlentities($row['type']);?>"><i class="fa fa-pencil" style="color: #29b6f6;"></i></a> 
<?php } ?>
<?php if($delete_page == 1) { ?>
	&nbsp;<a href="managepage.php?id=<?php echo htmlentities($row['id']);?>"> <i class="fa fa-trash-o" style="color: #f05050"></i></a>
<?php } ?>
     </td>
</tr>
<?php
$cnt++;
 } ?>
</tbody>
                                                  
                                                    </table>
                                                </div>




											</div>

										</div>

							
									</div>
                                    <!--- end row -->


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

        <!-- App js -->
        <script src="assets/js/jquery.core.js"></script>
        <script src="assets/js/jquery.app.js"></script>

    </body>
</html>
<?php } ?>