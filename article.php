<?php
   include "connect.php";

   $get1 = "SELECT * FROM Articles WHERE id = $_GET[id]";
   $data1 = mysqli_query($conn, $get1);
   $result1 = mysqli_fetch_assoc($data1);

   /*if ($result1["premium"] == 1) {
        if (isset($_COOKIE['google_user'])) {
            $date = date("Y-m-d H:m:s");
            
            $sql_sub = "SELECT * FROM Subscriptions WHERE start <= '$date' AND end > '$date' AND email = '$_COOKIE[google_user]'";
            $run_sub = mysqli_query($conn, $sql_sub);   
            $res_sub = mysqli_fetch_assoc($run_sub);
            
            if (!$res_sub) {
            ?>
              <script>
                 alert("You have no running subscription to view premium articles, please subscribe to view premium articles");
                 location.href='http://localhost/smart24tv/home';
              </script>
            <?php
            }  
        } else {
        ?>
           <script>
             alert("Please login and ensure that you have subscribed to view premium articles");
             location.href='http://localhost/smart24tv/home';
           </script>
        <?php
        }
   }*/

?>



<!DOCTYPE html>
<html lang="en">
    <head>

        <base href="http://localhost/smart24tv/">

        <title>UPAVA | Article</title>
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
        <link href="css/app.min.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel='shortcut icon' type='image/x-icon' href='img/upava.png' />

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" crossorigin="anonymous"></script>
    
        <style>
            figure > img {
                width: 100% !important;
            }

        </style>
    </head>

    <body>
        <div>
            <?php include "navbar.php";?>
            
            <?php include "sidebar.php";?>
            

            <!--Main section-->
            <section id = "main">
                
                <div class = "row">
                    <div class = "col-md-12">
                        <div class = "title"> 
                            <h4><?php echo $result1["title"];?></h4>
                        </div>

                        <div class = "card" style = "padding : 20px; margin-top: 15px;">
                           <?php echo $result1["description"]; ?>
                        </div>
                        <div style = "padding : 20px; margin-top: 15px;">
                            <?php echo $result1["body"]; ?>
                        </div>

                    </div>
                </div>
            </section>

            <?php include "footer.php";?>
        </div>        
    </body>
</html>
