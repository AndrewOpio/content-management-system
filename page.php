<?php
   include "connect.php";

   if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = mysqli_real_escape_string($conn, $_POST['email']);

        $sql = "SELECT * FROM Membership WHERE email = '$email'";
        $exe = mysqli_query($conn, $sql);
        //$res= mysqli_fetch_assoc($exe);
            
        if (mysqli_num_rows($exe) > 0) {
        ?>
            <script>
                alert("This email already exists.");

                window.location.href = "index.php";

            </script>
        <?php

        } else if (mysqli_num_rows($exe) == 0) {
            $name = mysqli_real_escape_string($conn, $_POST['name']);
            $email = mysqli_real_escape_string($conn, $_POST['email']);
            $address = mysqli_real_escape_string($conn, $_POST['address']);
            $contact = mysqli_real_escape_string($conn, $_POST['contact']);
            $paid = mysqli_real_escape_string($conn, $_POST['paid']);

            if ($paid == 'on') {
               $paid = "paid";
               
            } else {
                $paid = "not paid";

            }
            $query = "INSERT INTO Membership  (name, contact, email, address, paid, status) VALUES ( '$name', '$contact', '$email',
            '$address', '$paid', '0')";

            $insert = mysqli_query($conn, $query);
            if ($insert) {
            ?>
                <script>
                    alert("Request submitted.");

                    window.location.href = "index.php";

                </script>
            <?php
            } else {
                ?>
                <script>
                    alert("Request failed.");

                    window.location.href = "index.php";

                </script>
            <?php
            }
        }
    }

    $id = mysqli_real_escape_string($conn, $_GET['id']);
    $type = mysqli_real_escape_string($conn, $_GET['type']);

    $get1 = "SELECT * FROM Pages WHERE url = '$id' AND type ='$type'";
    $data1 = mysqli_query($conn, $get1);
    $result1 = mysqli_fetch_assoc($data1); 

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <base href="http://localhost/smart24tv/">

        <title>UPAVA | Page</title>
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
        <link href="css/app.min.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel='shortcut icon' type='image/x-icon' href='img/upava.png' />

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" crossorigin="anonymous"></script>
    </head>

    <style>
        input[type=checkbox] {
            transform: scale(1.5);
        }
    </style>
    <body>
        <div>
            <?php include "navbar.php";?>
            
            <?php include "sidebar.php";?>
            

            <!--Main section-->
            <section id = "main">
                <div class = "row">
                    <div class = "col-md-12">
                        <?php
                            if ($result1) {
                        ?>
                            <div class = "title"> 
                                <h4><?php echo $result1["title"];?></h4>
                            </div>
                        <?php
                            }                             
                        ?>
                        
                        <div class = "card" style = "padding : 20px; margin-top: 15px;">
                           <?php 
                             if ($result1) {
                           ?>
                              
                                <div class = "card-body"> <?php echo $result1["description"]; ?> </div>
                                
                                <?php
                                if (strtolower($result1['title']) == "about us") {
                                ?>
                                <div class = "card-footer">
                                    <button data-toggle = "modal" data-target = "#membership">Join UPAVA</button>
                                </div>
                                <div class="modal fade" id="membership" tabindex="-1" role="dialog">
                                    <div class="modal-dialog">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <h5 class="modal-title" id="exampleModalLabel">Membership Registration</h5>
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
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Submit</button>
                                                </div>
                                            </form>
                                        </div>
                                      </div>
                                    </div>
                                </div>
                                <?php
                                }
                             } else {
                            ?>
                              <span style = "text-align: center;">No page attached yet</span>
                            <?php
                             }                             
                           ?>
                        </div>
                    </div>
                </div>
            </section>

            <?php include "footer.php";?>
        </div> 
    </body>
</html>
