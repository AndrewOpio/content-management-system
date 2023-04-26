<?php
   include "dbconnection.php";
   include "permissions.php";

   if(!isset($_SESSION['user_log'])) {
      echo "<script>window.location.href = 'index.php';</script>";

   }


   $get = "SELECT * FROM Membership";
   $data = mysqli_query($con, $get);

   if($_SERVER["REQUEST_METHOD"] == "POST"){
       if(isset($_POST["delete"])){
            $query = "DELETE FROM Membership WHERE id = '$_POST[delete]'";
            $execute = mysqli_query($con, $query);   

            header("Location: membership.php");

       } else if (isset($_POST["accept"])) {
            $update = "UPDATE Membership SET status = '1', paid = 'paid' WHERE id = '$_POST[accept]'";
            $run = mysqli_query($con, $update); 
            
            if ($update) {
                ?>
                    <script>
                        alert("Member updated.");        
                    </script>
                <?php
            } else {
            ?>
                <script>
                    alert("An error occured.");        
                </script>
            <?php
            }

            header("Location: membership.php");

       } else if (isset($_POST["add"])) {

            $sql = "SELECT * FROM Membership WHERE email = '$_POST[email]'";
            $exe = mysqli_query($con, $sql);
            //$res= mysqli_fetch_assoc($exe);
                 
            if (mysqli_num_rows($exe) > 0) {
            ?>
                <script>
                    alert("This email already exists.");
                </script>
            <?php

            } else if (mysqli_num_rows($exe) == 0) {

                $paid = mysqli_real_escape_string($con, $_POST['paid']);

                if ($paid == 'on') {
                    $paid = "paid";
                 
                } else {
                    $paid = "not paid";

                }

                $query = "INSERT INTO Membership  (name, contact, email, address, paid, status) VALUES ( '$_POST[name]', '$_POST[contact]', '$_POST[email]',
                '$_POST[address]', '$paid', '1')";
        
                $insert = mysqli_query($con, $query);
                if ($insert) {
                ?>
                    <script>
                        alert("Member added.");        
                    </script>
                <?php
               } else {
                ?>
                    <script>
                        alert("An error occured.");        
                    </script>
                <?php
               }

               header("Location: membership.php");
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
        <title>UPAVA | Membership</title>
 
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

        <style>
             @media (max-width: 768px){
                .dataTables_wrapper .dt-buttons {
                    margin-left: 60px;
                    margin-top: 15px;
                    margin-bottom: 15px;
                }
            } 

            @media (min-width: 769px){
                .dataTables_wrapper .dt-buttons {
                    margin-top: 50px;
                    margin-bottom: 10px;
                    margin-left: -125px;
                }
            } 
            input[type=checkbox] {
                transform: scale(1.5);
            }
        </style>

        
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
                                    <h4 class="page-title">Manage Membership</h4>
                                    <ol class="breadcrumb p-0 m-0">
                                        <li>
                                            <a href="#">Membership</a>
                                        </li>
                                        <li class="active">
                                            Manage Membership
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
                                        <h4 class="modal-title">Add New Member</h4>
                                    </div>
                                    <div class="modal-body">

                                        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                                            <div class="form-group col-12">
                                                <label>Name</label>
                                                <input type="text" class="form-control" name = "name" placeholder = "Enter full name.." required>
                                            </div>
                                            <div class="form-group col-12">
                                                <label>Contact</label>
                                                <input type="tel" class="form-control" name = "contact" placeholder = "Enter contact.." required>
                                            </div>
                                            <div class="form-group col-12">
                                                <label>Email</label>
                                                <input type="email" class="form-control" name = "email" placeholder = "Enter email.." required>
                                            </div>
                                            <div class="form-group col-12">
                                                <label>Address</label>
                                                <input type="text" class="form-control" name = "address" placeholder = "Enter address.." required>
                                            </div>
                                            <div class="form-group col-12">
                                                <input type="checkbox"  name = "paid">
                                                <label style = "margin-left: 10px;">Check if membership payment has been made.</label>
                                            </div>
                                            <input type="hidden" name = "add" value = "add">
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Send</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class = "card">
                            <div class = "card-header" style = "">
                                <h5><b>Members</b></h5>
                            </div>
                            <div class = "card-footer" style = "">
                                <button type = "button" style = " margin-top: 10px; margin-bottom: 10px; margin-left : 5px;" class = "btn btn-primary" data-toggle = "modal" data-target = "#myModal" data-backdrop = "true"><span class = "add">&plus;</span>Add Member</button>
                            </div>
                            <div>
                                <div class = "card-body table-responsive">
                                    <table id = "table" class="table table-striped" border = "0">
                                        <thead>
                                            <tr class = "header">
                                                <td class = "text"><b>Id</b></td>
                                                <td class = "text"><b>Name</b></td>
                                                <td class = "text"><b>Email</b></td>
                                                <td class = "text"><b>Contact</b></td>
                                                <td class = "text"><b>Address</b></td>
                                                <td class = "text"><b>Payment</b></td>
                                                <td class = "text"><b>status</b></td>
                                                <td class = "text notexport"><b>Actions</b></td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        
                                        $i = 1;
                                        foreach ($data as $data) {
                                        ?>

                                            <div id="<?php echo $data["id"]."delete"; ?>" class="modal fade" role="dialog">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <!-- Modal content-->
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Delete this member</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>Are you sure you want to delete this member?</p>

                                                            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                                                                <input type = "hidden" name = "delete" value = "<?php echo $data["id"]; ?>"/>
                                                                <button class="button" style = "width: 100%;">Delete</button>
                                                            </form>
                                                        </div>                      
                                                    </div>
                                                </div>
                                            </div>


                                            <div id="<?php echo $data["id"]."accept"; ?>" class="modal fade" role="dialog">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <!-- Modal content-->
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Accept this member</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>Are you sure you want to accept this member?</p>

                                                            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                                                                <input type = "hidden" name = "accept" value = "<?php echo $data["id"]; ?>"/>
                                                                <button class="button" style = "width: 100%;">Accept</button>
                                                            </form>
                                                        </div>                      
                                                    </div>
                                                </div>
                                            </div>

                                            <tr>
                                                <td><?php echo $i; ?></td>
                                                <td><?php echo $data["name"]; ?></td>
                                                <td><?php echo $data["email"]; ?></td>
                                                <td><?php echo $data["contact"]; ?></td>
                                                <td><?php echo $data["address"]; ?></td>
                                                <td><?php echo $data["paid"]; ?></td>
                                                <td><?php echo $data["status"] == 1 ? "ACCEPTED" : "PENDING"; ?></td>

                                                <td class = "action">
                                                    <div style = "display: flex;">
                                                        <button type = "button" class = "btn btn-success" data-toggle = "modal" data-target = "#<?php echo $data["id"]."accept"; ?>" data-backdrop = "true">
                                                            <img width =15 height = 15 src = "../img/tick.png"/>
                                                        </button>

                                                        <button type = "button" class = "btn btn-danger" style = "margin-left: 5px;" data-toggle = "modal" data-target = "#<?php echo $data["id"]."delete"; ?>" data-backdrop = "true">
                                                            <img width =15 height = 15 src = "../img/trash.png"/>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php
                                            $i++;
                                        }
                                        ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>                        
                        </div>
                    </div>
                </div>
           </div>
        </div>

        <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>

        <script>
            // Replace the <textarea id="editor1"> with a CKEditor 4
            // instance, using default configuration.
            CKEDITOR.replace( 'editor1' );

            var resizefunc = [];

            $(document).ready(function(){
                $('#table').DataTable( {
                    dom:'lBfrtip',
                    buttons: [{
                    extend: 'pdfHtml5',
                    className: 'button',
                    text: 'Print PDF',
                    orientation: 'landscape',
                    pageSize: 'LEGAL',
                    exportOptions: {
                        columns: ':not(.notexport)'
                    }

                    },
                    {
                    extend: 'excel',
                    className: 'button',
                    text: 'Print Excel Sheet',
                    orientation: 'landscape',
                    pageSize: 'LEGAL',
                    exportOptions: {
                        columns: ':not(.notexport)'
                    } 
                    }],


                } );
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
