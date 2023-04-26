<?php
   include "dbconnection.php";
   include "permissions.php";

   if(!isset($_SESSION['user_log'])) {
      echo "<script>window.location.href = 'index.php';</script>";

   }

   $get = "SELECT * FROM Adverts";
   $data = mysqli_query($con, $get);

   if($_SERVER["REQUEST_METHOD"] == "POST"){
       if(isset($_POST["delete"])){
            $query = "DELETE FROM Adverts WHERE id = '$_POST[delete]'";
            $execute = mysqli_query($con, $query);   

            header("Location: adverts.php");

       } else if (isset($_POST["update"])) {
            $sql = "SELECT * FROM Adverts WHERE title ='$_POST[title]'";
            $exe = mysqli_query($con, $sql);
            //$res= mysqli_fetch_assoc($exe);
    
            if (mysqli_num_rows($exe)!=0 && $_POST['title'] != $_POST['old_title']) {
            ?>
                <script>
                    alert("This title already exists.");
                </script>
            <?php
            } else {
               
                $filename = $_FILES["image"]["name"];

                if($filename) {
                    
                    $tempname = $_FILES["image"]["tmp_name"];
                    $folder = "adverts/".$filename;
            
                    $imageFileType = strtolower(pathinfo($folder,PATHINFO_EXTENSION));
            
                    if (move_uploaded_file($tempname, $folder)) {
                        $update = "UPDATE Adverts SET title = '$_POST[title]', type = '$_POST[type]',
                        media = '$folder' WHERE id = '$_POST[update]'";

                        $insert = mysqli_query($con, $update);
                        header("Location: adverts.php");
                    }
               } else {
                
                    $update = "UPDATE Adverts SET title = '$_POST[title]', type = '$_POST[type]'
                     WHERE id = '$_POST[update]'";

                    $insert = mysqli_query($con, $update);
                    header("Location: adverts.php");
               }

            }
       } else if (isset($_POST["add"])) {

            $sql = "SELECT * FROM Adverts WHERE title = $_POST[title]";
            $exe = mysqli_query($con, $sql);
            //$res= mysqli_fetch_assoc($exe);
     
            if (mysqli_num_rows($exe)!=0) {
            ?>
                <script>
                    alert("This title already exists.");
                </script>
            <?php
            } else {

                $filename = $_FILES["image"]["name"];
                $tempname = $_FILES["image"]["tmp_name"];
                $folder = "adverts/".$filename;
          
                $imageFileType = strtolower(pathinfo($folder,PATHINFO_EXTENSION));
          
                if (move_uploaded_file($tempname, $folder)) {
                    $query = "INSERT INTO Adverts  (title, type, media) VALUES ( '$_POST[title]', '$_POST[type]', '$folder')";
    
                    $insert = mysqli_query($con, $query);
                    header("Location: adverts.php");
                }
          
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
        <title>UPAVA | Adverts</title>
 
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
                                    <h4 class="page-title">Manage Adverts</h4>
                                    <ol class="breadcrumb p-0 m-0">
                                        <li>
                                            <a href="#">Articles</a>
                                        </li>
                                        <li class="active">
                                            Manage Adverts
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
                                        <h4 class="modal-title">Add New Advert</h4>
                                    </div>
                                    <div class="modal-body">
                                      <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
                                        <div class="form-group col-12">
                                            <label>Advert title</label>
                                            <input type="text" class="form-control" name = "title" placeholder = "title.." required>
                                        </div>

                                        <div class="form-group col-12">
                                            <label>Select type</label>
                                            <select  class="form-control custom-select" name="type" required>
                                                <option value="image">Image</option>
                                                <option value="video">Video</option>
                                            </select>
                                        </div>

                                        <div class="form-group col-12">
                                            <label>Select media</label>
                                            <input type="file" class="form-control" name = "image" required/>
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
                                <h5><b>Advertisements</b></h5>
                            </div>

                            <div>
                                <div class = "card-body table-responsive">
                                    <table id = "table" class="table table-striped" border = "0">
                                        <thead>
                                            <tr class = "header">
                                                <td class = "text"><b>Id</b></td>
                                                <td class = "text"><b>Title</b></td>
                                                <td class = "text"><b>Type</b></td>
                                                <td class = "text"><b>Media</b></td>
                                                <td class = "text"><b>Actions</b></td>
                                            </tr>
                                        </thead>
                                        
                                        <tbody>
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
                                                            <h4 class="modal-title">Delete this advert</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>Are you sure you want to delete this advert?</p>

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
                                                            <h4 class="modal-title">Update Advert</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
                                                                <div class="form-group col-12">
                                                                    <label>Advert title</label>
                                                                    <input type="text" class="form-control" name = "title"  value = "<?php echo $data['title'];?>" aplaceholder = "title.." required>
                                                                </div>


                                                                <div class="form-group col-12">
                                                                    <label>Select type</label>
                                                                    <select  class="form-control custom-select" name="type" required>
                                                                        <option value="image" <?php echo $data['type'] == "image" ? "selected": ""; ?>>Image</option>
                                                                        <option value="video" <?php echo $data['type'] == "video" ? "selected": ""; ?>>Video</option>
                                                                    </select>
                                                                </div>

                                                                <div class="form-group col-12">
                                                                    <label>Select media</label>
                                                                    <input type="file" class="form-control" name = "image" />
                                                                </div>

                                                                <div class="form-group col-12">
                                                                    <input type="hidden" name = "old_title" value = "<?php echo $data["title"]; ?>">
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
                                                        <div class="modal-header">
                                                            <h4 class="modal-title"><?php echo $data["title"]; ?></h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <?php if ($data["type"] == "image") {?>
                                                            <img src= "<?php echo $data["media"]; ?>" width = 100% height = 100% alt = "advertimage"/>
                                                            
                                                            <?php } else if ($data["type"] == "video"){?>
                                                                <video width = 60% height = 60% controls>
                                                                    <source src="<?php echo $data["media"];?>" type="video/mp4">
                                                                    Your browser does not support the video tag.
                                                                </video>
                                                            <?php } ?>
                                                        </div>                      
                                                    </div>
                                                </div>
                                            </div>

                                            <tr>
                                                <td><?php echo $i; ?></td>
                                                <td><?php echo $data["title"]; ?></td>
                                                <td><?php echo $data["type"]; ?></td>
                                                <?php if ($data["type"] == "image") {?>
                                                <td><img src= "<?php echo $data["media"]; ?>" width = 50 height = 50 alt = "advert image" data-toggle = "modal" data-target = "#<?php echo $data["id"]."view"; ?>" data-backdrop = "true"/></td>
                                                
                                                <?php } else if ($data["type"] == "video"){?>
                                                <td>
                                                    <video width = 50 height = 50 data-toggle = "modal" data-target = "#<?php echo $data["id"]."view"; ?>" data-backdrop = "true">
                                                        <source src="<?php echo $data["media"];?>" type="video/mp4">
                                                        Your browser does not support the video tag.
                                                    </video>
                                                </td>
                                                <?php } ?>
                                                <td class = "action">
                                                    <div style = "display : flex;">
                                                        <button type = "button" class = "btn btn-success" data-toggle = "modal" data-target = "#<?php echo $data["id"]."update"; ?>" data-backdrop = "true">
                                                            <img width =15 height = 15 src = "../img/edit.png"/>
                                                        </button>

                                                        <button type = "button" class = "btn btn-danger" style = "margin-left: 10px;" data-toggle = "modal" data-target = "#<?php echo $data["id"]."delete"; ?>" data-backdrop = "true">
                                                            <img width =15 height = 15 src = "../img/trash.png"/>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                            
                                        <?php
                                            $i++;
                                        }
                                        }
                                        ?>
                                        <tbody>
                                    </table>
                                </div>
                            </div>
                        
                            <div class = "card-footer" style = "">
                                <button type = "button" style = "margin-left : 5px;" class = "btn btn-primary" data-toggle = "modal" data-target = "#myModal" data-backdrop = "true"><span class = "add">&plus;</span>Add Advert</button>
                            </div>
                        </div>
                    </div>
                </div>
           </div>
        </div>

        <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/1.10.2/js/jquery.dataTables.min.js"></script>

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
