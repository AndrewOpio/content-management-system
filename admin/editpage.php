<?php 
include('dbconnection.php');
error_reporting(0);
if(strlen($_SESSION['user_log'])==0)
  { 
header('location:login.php');
}
else{


$get = "SELECT * FROM Categories WHERE type = 'custom'";
$run = mysqli_query($con, $get);
    
if(isset($_POST['update']))
{
$title=$_POST['title'];
$url=$_POST['url'];
$description=$_POST['description'];
$pageid=intval($_GET['id']);

$init_type = substr($url,0,4);

if($init_type == "subm") {
    $type = "sub";
} else {
    $type = "main";
}

$id = substr($url,4);

$query=mysqli_query($con,"update Pages set title='$title',url='$id',description='$description', type = '$type' where id='$pageid'");
if($query)
{
$msg="Page updated ";
}
else{
$error="Error encountered when updating page.";    
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
        <title>UPAVA | Edit Page</title>

        <!-- Summernote css -->
        <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>

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
                                    <h4 class="page-title">Edit Page </h4>
                                    <ol class="breadcrumb p-0 m-0">
                                        <li>
                                            <a href="#"> Pages </a>
                                        </li>
                                        <li class="active">
                                            Edit Page
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

<?php
$pageid=intval($_GET['id']);
$query=mysqli_query($con,"select * from Pages where id='".$_GET['id']."' AND type='".$_GET['type']."'");

while($row=mysqli_fetch_array($query))
{
?>
                        <div class="row">
                            <div class="col-md-10 col-md-offset-1">
                                <div class="p-6">
                                    <div class="">
                                        <form name="editpage" method="post">
 <div class="form-group m-b-20">
<label for="exampleInputEmail1">Page Title</label>
<input type="text" class="form-control" id="title" value="<?php echo htmlentities($row['title']);?>" name="title" placeholder="Enter page title" required>
</div>

<div class="form-group m-b-20">
    <label>Page URL</label>
    <select  class="form-control custom-select" id="url" name="url" required>
        <?php
            if ($_GET['type'] == "main") {
                $get = "SELECT * FROM Categories WHERE type = 'custom'";
                $run = mysqli_query($con, $get);
                
                while($data = mysqli_fetch_assoc($run)) {
                    $get1 = "SELECT * FROM Pages WHERE url = '$data[id]' AND type = 'main'";
                    $run1 = mysqli_query($con, $get1);
                    $data1 = mysqli_fetch_assoc($run1);

                    $get5 = "SELECT * FROM Sub_Menus WHERE navigation = '$data[id]'";
                    $run5 = mysqli_query($con, $get5);

                    if((mysqli_num_rows($run1)==0 || $data1['url'] == $row['url']) && mysqli_num_rows($run5)==0) {
                    ?>
                       <option value="<?php echo "main".$data['id']; ?>" <?php echo $data['id'] == $row['url'] ? 'selected': '' ; ?>><?php echo $data['title']; ?></option>
                    <?php
                    }
               }

               $get2 = "SELECT * FROM Sub_Menus";
               $run2 = mysqli_query($con, $get2);

               while($data2 = mysqli_fetch_assoc($run2)) {

                    $get3 = "SELECT * FROM Pages WHERE url = '$data2[id]' AND type = 'sub'";
                    $run3 = mysqli_query($con, $get3);
                    $data3 = mysqli_fetch_assoc($run3);

                    if(mysqli_num_rows($run3)==0) {
                        $get4 = "SELECT * FROM Categories WHERE id = '$data2[navigation]'";
                        $run4 = mysqli_query($con, $get4);
                        $data4 = mysqli_fetch_assoc($run4);
                    ?>
                        <option value="<?php echo "subm".$data2['id']; ?>"><?php echo $data2['title']."  (".$data4['title'].")"; ?></option>
                    <?php
                    }
               }
    
            } else if ($_GET['type'] == "sub") {
                $get = "SELECT * FROM Sub_Menus";
                $run = mysqli_query($con, $get);
                $data = mysqli_fetch_assoc($run);

                while($data = mysqli_fetch_assoc($run)) {
                    $get2 = "SELECT * FROM Pages WHERE url = '$data[id]' AND type = 'sub'";
                    $run2 = mysqli_query($con, $get2);
                    $data2 = mysqli_fetch_assoc($run2);

                    if(mysqli_num_rows($run2)==0 || $data2['url'] == $row['url']){
                        $get3 = "SELECT * FROM Categories WHERE id = '$data[navigation]'";
                        $run3 = mysqli_query($con, $get3);
                        $data3 = mysqli_fetch_assoc($run3);
        
                    ?>
                    <option value="<?php echo "subm".$data['id']; ?>" <?php echo $data['id'] == $row['url'] ? 'selected': '' ; ?>><?php echo $data['title']."  (".$data3['title'].")"; ?></option>
                    <?php
                    }
                }


                $get4 = "SELECT * FROM Categories WHERE type = 'custom'";
                $run4 = mysqli_query($con, $get4);
 
                while($data4 = mysqli_fetch_assoc($run4)) {
 
                     $get5 = "SELECT * FROM Pages WHERE url = '$data4[id]' AND type = 'main'";
                     $run5 = mysqli_query($con, $get5);
                     $data5 = mysqli_fetch_assoc($run5);
 
                     $get6 = "SELECT * FROM Sub_Menus WHERE navigation = '$data4[id]'";
                     $run6 = mysqli_query($con, $get6);
                     $data6 = mysqli_fetch_assoc($run6);

                     if(mysqli_num_rows($run5)==0 && mysqli_num_rows($run6)==0) {
                     ?>
                         <option value="<?php echo "main".$data4['id']; ?>"><?php echo $data4['title'];?></option>
                     <?php
                     }
                }
 
           }
        ?>
    </select>
</div>

     <div class="row">
<div class="col-sm-12">
 <div class="card-box">
<h4 class="m-b-30 m-t-0 header-title"><b>Page Details</b></h4>
<textarea id="description" name="description" class="form-control ckeditor" rows="10" cols="80" required><?php echo $row['description'];?></textarea>
</div>
</div>
</div>

<?php } ?>

<button type="submit" name="update" class="btn btn-success waves-effect waves-light">Update </button>

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
        

        <script src="/plugins/ckeditor/ckeditor.js"></script>
        <script src="/plugins/ckfinder/ckfinder.js"></script>

        <!-- App js -->
        <script src="assets/js/jquery.core.js"></script>
        <script src="assets/js/jquery.app.js"></script>

        <script>
    CKEDITOR.replace('description', {
        height:300,
        filebrowserUploadUrl:"ckupload.php",
        filebrowserUploadMethod:'form'

    })
</script>



    </body>
</html>
<?php } ?>