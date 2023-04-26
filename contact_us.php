<?php
   include "connect.php";

   $get1 = "SELECT * FROM Offices";
   $data1 = mysqli_query($conn, $get1);

   if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);

    $query = "INSERT INTO Messages  (name, email, message) VALUES ( '$name', '$email',
    '$message')";

    $insert = mysqli_query($conn, $query);
    if ($insert) {
        ?>
            <script>
                alert("Message sent.");
            </script>
        <?php
        } else {
            ?>
            <script>
                alert("Failedto send message.");
            </script>
        <?php
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <base href="http://localhost/smart24tv/">

        <title>UPAVA | Contact Us</title>
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
        <link href="css/app.min.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel='shortcut icon' type='image/x-icon' href='img/logo.png' />

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" crossorigin="anonymous"></script>
    </head>

    <body>
        <div>
            <?php include "navbar.php";?>
            
            <?php include "sidebar.php";?>
            

            <!--Main section-->
            <section id = "main" style = "margin-top: 90px;">
                <div class = "row">
                    <div class = "col-md-12">
                       
                        <div class = "title"> 
                            <h4>Offices and Contacts</h4>
                        </div>
                       
                        <div class = "card" style = "padding : 20px; margin-top: 15px;">
                           <?php 
                             if (mysqli_num_rows($data1)!=0) {
                           ?>
                              
                            <div class = "card-body"> 
                                <?php 
                                  $count = 1;
                                  while($office = mysqli_fetch_assoc($data1)) { 
                                ?> 
                                   <h5><b><?php echo "Office  ".$count?></b></h5>
                                   <span>Location: <?php echo " ".$office["location"]; ?></span><br>
                                   <span>Contact: <?php echo " ".$office["contact"]; ?></span><br>
                                   <span>Email: <?php echo " ".$office["email"]; ?></span><br>
                                   <span>Address: <?php echo " ".$office["address"]; ?></span><br><hr/><br>
                                <?php $count++; } ?>
                            </div>
                            <div class = "card-footer">
                                <button data-toggle = "modal" data-target = "#membership">Send message</button>
                            </div>
                           
                           <?php } else { ?>
                              <span style = "text-align: center;">No data to show</span>

                            <?php } ?>
                            <div class="modal fade" id="membership" tabindex="-1" role="dialog">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Send message</h5>
                                    </div>
                                    <div class="modal-body">
                      
                                        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                                            <div class="form-group col-12">
                                                <label>Name</label>
                                                <input type="text" class="form-control" name = "name" placeholder = "Enter full name.." required>
                                            </div>
                                            <div class="form-group col-12">
                                                <label>Email</label>
                                                <input type="email" class="form-control" name = "email" placeholder = "Enter email.." required>
                                            </div>
                                            <div class="form-group col-12">
                                                <label>Message</label>
                                                <textarea rows = "5" name = "message" class="form-control" required></textarea>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Send</button>
                                            </div>
                                        </form>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <?php include "footer.php";?>
        </div> 
    </body>
</html>
