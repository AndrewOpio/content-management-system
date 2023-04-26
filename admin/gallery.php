<?php
   include "dbconnection.php";
   include "permissions.php";

   if(!isset($_SESSION['user_log'])) {
      echo "<script>window.location.href = 'index.php';</script>";

   }


   $get = "SELECT * FROM Gallery";
   $data = mysqli_query($con, $get);

   if($_SERVER["REQUEST_METHOD"] == "POST"){
       if(isset($_POST["delete"])){
            $query = "DELETE FROM Gallery WHERE id = '$_POST[delete]'";
            $execute = mysqli_query($con, $query);   

            header("Location: gallery.php");

       } else if (isset($_POST["update"])) {   
            $filename = $_FILES["image"]["name"];
            $tempname = $_FILES["image"]["tmp_name"];
            $folder = "gallery/".$filename;
    
            $imageFileType = strtolower(pathinfo($folder,PATHINFO_EXTENSION));
    
            if (move_uploaded_file($tempname, $folder)) {
                $update = "UPDATE Gallery SET image = '$folder', gallery_type = '$_POST[type]' WHERE id = '$_POST[update]'";
            
            } else {
                $update = "UPDATE Gallery SET gallery_type = '$_POST[type]' WHERE id = '$_POST[update]'";

            }


            $insert = mysqli_query($con, $update);
            header("Location: gallery.php");
               
       } else if (isset($_POST["add"])) {
            $filename = $_FILES["image"]["name"];
            $tempname = $_FILES["image"]["tmp_name"];
            $folder = "gallery/".$filename;
        
            $imageFileType = strtolower(pathinfo($folder,PATHINFO_EXTENSION));
        
            if (move_uploaded_file($tempname, $folder)) {
                $query = "INSERT INTO Gallery  (image, gallery_type) VALUES ('$folder', '$_POST[type]')";

                $insert = mysqli_query($con, $query);
                header("Location: gallery.php");
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
        <title>UPAVA | Gallery</title>
 
        <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

        <!-- App css -->
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.2/css/jquery.dataTables.min.css">
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
                                    <h4 class="page-title">Manage Gallery</h4>
                                    <ol class="breadcrumb p-0 m-0">
                                        <li>
                                            <a href="#">Gallery</a>
                                        </li>
                                        <li class="active">
                                            Manage Gallery
                                        </li>
                                    </ol>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                        <div id="myModal" class="modal fade" role="dialog">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Add New Image</h4>
                                    </div>
                                    <div class="modal-body">
                                      <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
                                        <div class="form-group col-12">
                                            <label>Select image</label>
                                            <input type="file" class="form-control" name = "image" required/>
                                        </div>

                                        <div class="row">
                                            <div class="form-group col-md-12">
                                            <label for="category">Gallery Types</label>
                                            <select  class="form-control custom-select" name="type" required class="form-control">
                                                <?php 
                                                    $type_query= "SELECT * FROM Gallery_types";
                                                    $get_types = mysqli_query($con, $type_query);

                                                if(mysqli_num_rows($get_types)!=0) { 
                                                    while($type = mysqli_fetch_assoc($get_types)) {
                                                    ?>
                                                    <option value="<?php echo $type['title'] ?>"><?php echo $type['title'] ?></option>
                                                <?php } 
                                                }?>  
                                            </select>
                                            </div>              
                                        </div> 

                                        <div class="form-group col-12">
                                            <input type="hidden" name = "add" value = "add">
                                            <button type="submit" class="button" style = "width: 100%;">Save</button>
                                        </div>
                                      </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class = "card">
                            <div class = "card-header" style = "">
                                <h5><b>Gallery</b></h5>
                            </div>

                            <div>
                                <div class = "card-body table-responsive">
                                    <table id = "table" class="table table-striped" border = "0">
                                        <thead>
                                            <tr class = "header">
                                                <td class = "text"><b>Id</b></td>
                                                <td class = "text"><b>Image</b></td>
                                                <td class = "text"><b>Gallery Type</b></td>
                                                <td class = "text"><b>Actions</b></td>
                                            </tr>
                                        </thead>

                                       </tbody>
                                        <?php
                                        if($data){
                                        $i = 1;
                                        foreach ($data as $data) {
                                        ?>

                                            <div id="<?php echo $data["id"]."delete"; ?>" class="modal fade" role="dialog">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <!-- Modal content-->
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Delete this image</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>Are you sure you want to delete this image?</p>

                                                            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                                                                <input type = "hidden" name = "delete" value = "<?php echo $data["id"]; ?>"/>
                                                                <button class="button" style = "width: 100%;">Delete</button>
                                                            </form>
                                                        </div>                      
                                                    </div>
                                                </div>
                                            </div>


                                            <div id="<?php echo $data["id"]."update"; ?>" class="modal fade" role="dialog">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Update Image</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
                                                                <div class="form-group col-12">
                                                                    <label>Select image</label>
                                                                    <input type="file" class="form-control" name = "image" />
                                                                </div>

                                                                <div class="row">
                                                                    <div class="form-group col-md-12">
                                                                        <label for="category">Gallery Types</label>
                                                                        <select  class="form-control custom-select" name="type" required class="form-control">
                                                                            <?php 
                                                                                $type_query= "SELECT * FROM Gallery_types";
                                                                                $get_types = mysqli_query($con, $type_query);

                                                                            if(mysqli_num_rows($get_types)!=0) { 
                                                                                while($type = mysqli_fetch_assoc($get_types)) {
                                                                                ?>
                                                                                <option value="<?php echo $type['title'] ?>" <?php echo $type['title'] == $data['gallery_type'] ? "selected": ""; ?> ><?php echo $type['title'] ?></option>
                                                                            <?php } 
                                                                            }?>  
                                                                        </select>
                                                                    </div>              
                                                                </div> 

                                                                <div class="form-group col-12">
                                                                    <input type="hidden" name = "update" value = "<?php echo $data["id"]; ?>">
                                                                    <button type="submit" class="button" style = "width: 100%;">Save</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div id="<?php echo $data["id"]."view"; ?>" class="modal fade" role="dialog">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <!-- Modal content-->
                                                    <div class="modal-content">
                                                        <div class="modal-body">
                                                            <img src= "<?php echo $data["image"]; ?>" width = 100% height = 100% alt = "gallery image"/>
                                                        </div>                      
                                                    </div>
                                                </div>
                                            </div>

                                            <tr>
                                                <td><?php echo $i; ?></td>
                                                <td><img src= "<?php echo $data["image"]; ?>" width = 50 height = 50 alt = "advert image" data-toggle = "modal" data-target = "#<?php echo $data["id"]."view"; ?>" data-backdrop = "true"/></td>
                                                <td><?php echo $data["gallery_type"]; ?></td>

                                                <td class = "action">
                                                    <div style = "display: flex;">
                                                        <button type = "button" class = "btn btn-success" data-toggle = "modal" data-target = "#<?php echo $data["id"]."update"; ?>" data-backdrop = "true">
                                                            <img width =15 height = 15 src = "../img/edit.png"/>
                                                        </button>

                                                        <button type = "button" class = "btn btn-danger" data-toggle = "modal" style = "margin-left: 5px;" data-target = "#<?php echo $data["id"]."delete"; ?>" data-backdrop = "true">
                                                            <img width =15 height = 15 src = "../img/trash.png"/>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                            
                                        <?php
                                            $i++;
                                        }
                                        } else {
                                        ?>
                                        <tr>
                                            <td colspan ="8" style = "text-align: center;">No data to show</td>
                                        </tr>
                                        <?php            
                                        } 
                                        ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        
                            <div class = "card-footer" style = "">
                                <button type = "button" style = "margin-left : 5px;" class = "btn btn-primary" data-toggle = "modal" data-target = "#myModal" data-backdrop = "true"><span class = "add">&plus;</span>Add Image</button>
                            </div>
                        </div>
                    </div>
                </div>
           </div>
        </div>

        <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/1.10.2/js/jquery.dataTables.min.js"></script>

        <script>
            $(document).ready(function(){
                $('#table').dataTable();
            });
        </script>
        <script>
            // Replace the <textarea id="editor1"> with a CKEditor 4
            // instance, using default configuration.
            CKEDITOR.replace( 'editor1' );

            var resizefunc = [];

            $(document).ready(function(){
                $('#table').dataTable();
            });
        </script>
        <!-- jQuery  -->
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
