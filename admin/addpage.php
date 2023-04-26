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
     
// For adding page 
if(isset($_POST['submit']))
{
$title=$_POST['title'];
$url=$_POST['url'];
$description=$_POST['description'];
$init_type = substr($url,0,4);

if($init_type == "subm") {
    $type = "sub";
} else {
    $type = "main";
}

$id = substr($url,4);

$query=mysqli_query($con,"insert into Pages(title,url,description, type) values('$title','$id','$description', '$type')");
if($query)
{
$msg="Page successfully added ";
}
else{
$error="Error encountered when adding page.";    
} 

}

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
        <title>UPAVA | Add Page</title>




        <!-- App css -->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/core.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/components.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/icons.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/pages.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/menu.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/responsive.css" rel="stylesheet" type="text/css" />
        <script src="assets/js/modernizr.min.js"></script>
        <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
 
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
                                    <h4 class="page-title">Add Page </h4>
                                    <ol class="breadcrumb p-0 m-0">
                                        <li>
                                            <a href="#">Pages</a>
                                        </li>
                                        
                                        <li class="active">
                                            Add Page
                                        </li>
                                    </ol>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->

<div class="row">
<div class="col-sm-6" style = "margin: auto;">  
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


                        <div class="row">
                            <div class="col-md-10 col-md-offset-1">
                                <div class="p-6">
                                    <div class="">
<form name="addpage" method="post" enctype="multipart/form-data">
 <div class="form-group m-b-20">
<label for="exampleInputEmail1">Page Title</label>
<input type="text" class="form-control" id="title" name="title" placeholder="Enter page title" required>
</div>

<div class="form-group m-b-20">
    <label>Page URL</label>
    <select  class="form-control custom-select" id="url" name="url" required>
        <?php
           while($data = mysqli_fetch_assoc($run))
           {
                $get1 = "SELECT * FROM Pages WHERE url = '$data[id]'";
                $run1 = mysqli_query($con, $get1);

                if(mysqli_num_rows($run1)==0)
                {
                    $get2 = "SELECT * FROM Sub_Menus WHERE navigation = '$data[id]'";
                    $run2 = mysqli_query($con, $get2);

                    if(mysqli_num_rows($run2)==0)
                    {
                ?>
                   <option value="<?php echo "main".$data['id']; ?>"><?php echo $data['title']; ?></option>
                <?php
                    } else {        
                        while($data2 = mysqli_fetch_assoc($run2))
                        {
                            $get3 = "SELECT * FROM Pages WHERE url = '$data2[id]' AND type ='sub'";
                            $run3 = mysqli_query($con, $get3);

                            if (mysqli_num_rows($run3)==0) {
                    ?>
                     <option value="<?php echo "subm".$data2['id']; ?>"><?php echo $data2['title']."  (".$data['title'].")"; ?></option>
                    <?php
                            }
                        }
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
<textarea id="description" name="description" class="form-control ckeditor" rows="10" cols="80" required></textarea>

</div>
</div>
</div>


<button type="submit" name="submit" class="btn btn-success waves-effect waves-light">Save</button>
 
                                        </form>
                                    </div>
                                </div> <!-- end p-20 -->
                            </div> <!-- end col -->
                        </div>
                        <!-- end row -->



                    </div> <!-- container -->

                </div> <!-- content -->

           

            </div>


            <!-- ============================================================== -->
            <!-- End Right content here -->
            <!-- ============================================================== -->


        </div>
        <!-- END wrapper -->



        

        <!-- jQuery  -->
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/detect.js"></script>
        <script src="assets/js/fastclick.js"></script>
        <script src="assets/js/jquery.blockUI.js"></script>
        <script src="assets/js/waves.js"></script>
        <script src="assets/js/jquery.slimscroll.js"></script>
        <script src="assets/js/jquery.scrollTo.min.js"></script>

        <script src="../plugins/ckeditor/ckeditor.js"></script>
        <script src="../plugins/ckfinder/ckfinder.js"></script>

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