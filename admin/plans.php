<?php
   session_start(); 
   include "connect.php";
   include "permissions.php";
   if(strlen($_SESSION['user_log'])==0) { 
      header('location:login.php');
   }

   $get = "SELECT * FROM Plans";
   $data = mysqli_query($conn, $get);

   if($_SERVER["REQUEST_METHOD"] == "POST"){
       if(isset($_POST["delete"])){
            $query = "DELETE FROM Plans WHERE id = '$_POST[delete]'";
            $execute = mysqli_query($conn, $query);   

            header("Location: plans.php");

       } else if (isset($_POST["update"])) {
            $update = "UPDATE Plans SET name = '$_POST[name]', days = '$_POST[days]',
                       amount = '$_POST[amount]' WHERE id = '$_POST[update]'";

            $run = mysqli_query($conn, $update);   
            header("Location: plans.php");

       } else if (isset($_POST["add"])) {

            $sql = "SELECT * FROM Plans WHERE name = $_POST[name] OR days = $_POST[days] OR amount = $_POST[amount]";
            $exe = mysqli_query($conn, $sql);
            $res= mysqli_fetch_assoc($exe);
     
            if ($res) {
            ?>
                <script>
                    alert("Duplicate information entered.");
                </script>
            <?php
            } else {
                $query = "INSERT INTO Plans  (name, days, amount) VALUES ( '$_POST[name]', '$_POST[days]', '$_POST[amount]')";

                $insert = mysqli_query($conn, $query);
                header("Location: plans.php");
            }
       }
    }
?>



<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Payment plans</title>
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
        <link href="css/app.min.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" type="text/css" href="css/style.css">

        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>

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

        <!-- Top Bar Start -->
        <?php include('includes/header.php');?>
        <!-- ========== Left Sidebar Start ========== -->
        <?php include('includes/sidebar.php');?>
        <!-- Left Sidebar End -->
<?php if($view_category == 1){ ?>
        <div id="myModal" class="modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Add New Payment Plan</h4>
                    </div>

                    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                        <div class="form-group col-md-12">
                            <label>Plan name</label>
                            <input type="text" class="form-control" name = "name" placeholder = "name.." required>
                        </div>


                        <div class="form-group col-md-12">
                            <label>Number of days</label>
                            <input type="text" class="form-control" name = "days" placeholder = "days.." required>
                        </div>

                        <div class="form-group col-md-12">
                            <label>Amount</label>
                            <input type="text" class="form-control" name = "amount" placeholder = "amount.." required>
                        </div>

                        <div class="form-group col-md-12">
                            <input type="hidden" name = "add" value = "add">
                            <button type="submit" class="button" style = "width: 100%;">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class = "card" style = "margin-left : 235px;   margin-top: 80px;">
            <div class = "card-header" style = "">
                <h5><b>Payment Plans</b></h5>
            </div>

            <div>
                <div class = "card-body table-responsive">
                    <table id = "table" class="table table-striped" border = "0">
                    <tr class = "header">
                            <td class = "text"><b>Id</b></td>
                            <td class = "text"><b>Name</b></td>
                            <td class = "text"><b>Days</b></td>
                            <td class = "text"><b>Amount</b></td>
                            <td class = "text" colspan ="2"><b>Actions</b></td>
                        </tr>

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
                                            <h4 class="modal-title">Delete this plan</h4>
                                        </div>
                                        <div class="modal-body">
                                            <p>Are you sure you want to delete this plan?</p>

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
                                            <h4 class="modal-title">Update Plan</h4>
                                        </div>

                                        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                                            <div class="form-group col-md-12">
                                                <label>Plan name</label>
                                                <input type="text" class="form-control" name = "name" placeholder = "name.." value = "<?php echo $data['name'];?>" required>
                                            </div>


                                            <div class="form-group col-md-12">
                                                <label>Number of days</label>
                                                <input type="text" class="form-control" name = "days" placeholder = "days.." value = "<?php echo $data['days'];?>" required>
                                            </div>

                                            <div class="form-group col-md-12">
                                                <label>Amount</label>
                                                <input type="text" class="form-control" name = "amount" placeholder = "amount.." value = "<?php echo $data['amount'];?>" required>
                                            </div>
                                            <div class="form-group col-md-12">
                                                <input type="hidden" name = "update" value = "<?php echo $data["id"]; ?>">
                                                <button type="submit" class="button" style = "width: 100%;">Save</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $data["name"]; ?></td>
                                <td><?php echo $data["days"]; ?></td>
                                <td><?php echo $data["amount"]; ?></td>
                                <?php if($edit_category == 1){?>
                                <td class = "action">
                                    <button type = "button" class = "btn btn-success" data-toggle = "modal" data-target = "#<?php echo $data["id"]."update"; ?>" data-backdrop = "true">
                                        <img width =25 height = 25 src = "./img/edit.png"/>
                                   </button>
                                </td>
                            <?php } ?>
                            <?php if($delete_category == 1){?>
                                <td class = "action">
                                    <button type = "button" class = "btn btn-danger" data-toggle = "modal" data-target = "#<?php echo $data["id"]."delete"; ?>" data-backdrop = "true">
                                        <img width =25 height = 25 src = "./img/trash.png"/>
                                    </button>
                                </td>
                            </tr>
                        <?php } ?>
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
                    </table>
                </div>
            </div>
        
        <?php if($add_category == 1){?>
            <div class = "card-footer" style = "">
                <button type = "button" style = "margin-left : 5px;" class = "btn btn-primary" data-toggle = "modal" data-target = "#myModal" data-backdrop = "true"><span class = "add">&plus;</span>Add Plan</button>
            </div>
        <?php } ?>
        </div>


        <!-- jQuery  -->
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/detect.js"></script>
        <script src="assets/js/fastclick.js"></script>
        <script src="assets/js/jquery.blockUI.js"></script>
        <script src="assets/js/waves.js"></script>
        <script src="assets/js/jquery.slimscroll.js"></script>
        <script src="assets/js/jquery.scrollTo.min.js"></script>
        <script src="../plugins/switchery/switchery.min.js"></script>

        <!--Summernote js-->
        <script src="../plugins/summernote/summernote.min.js"></script>

        <!-- App js -->
        <script src="assets/js/jquery.core.js"></script>
        <script src="assets/js/jquery.app.js"></script>
    <?php } ?>
    </body>
</html>