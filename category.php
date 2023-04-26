<?php
   include "connect.php";
   
   $get1 = "SELECT * FROM Categories WHERE id = $_GET[id]";
   $data1 = mysqli_query($conn, $get1);
   $result1= mysqli_fetch_assoc($data1);

   $get2 = "SELECT * FROM Articles WHERE categoryid = $_GET[id] AND status = 1";
   $data2 = mysqli_query($conn, $get2);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <base href="http://localhost/smart24tv/">

        <title>UPAVA | Category</title>
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
        <link href="app.min.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel='shortcut icon' type='image/x-icon' href='img/upava.png' />

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" crossorigin="anonymous"></script>
        <style>
            @media (min-width: 769px){
                .img-disp{
                    width: 215px;
                    height: 180px;
                    object-fit: cover;
                }
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
                       <!--2nd layout-->
                        <div>
                           <div class = "title"> 
                               <h4><?php echo $result1["title"];?></h4>
                           </div>


                           <div class = "cat_desc card"> 
                               <div class = "card-header">
                                   <p><?php echo $result1["description"];?></p>
                               </div>
                           </div>

                           <div class = "row">
                                <?php
                                    if ($data2) {
                                        while($article = mysqli_fetch_assoc($data2)){
                                ?>

                                <div class = "col-md-3" style = "padding: 0;">
                                    <div class = "card" style = "text-align:center;">
                                        <?php 
                                            if ($article["image"]) {
                                        ?>
                                            <a href= "<?php echo "article/".$article["id"]."/".$article["slug"];?>">
                                                <img class ="img-disp" width ='100%' height = '100%'  src = "<?php echo "admin/posts/".$article["image"];?>"/>
                                            </a>
                                        <?php 
                                            } else if ($article["video"]) {
                                        ?>
                                            <a href= "<?php echo "article/".$article["id"]."/".$article["slug"];?>" class="contain vid">
                                                <div class="centered">
                                                    <img width = 32 height = 32 src = "./img/play.png"/>
                                                </div>

                                                <video width = 100% height = 100%>
                                                    <source src="<?php echo $article["video"];?>" type="video/mp4">
                                                    Your browser does not support the video tag.
                                                </video>
                                            </a>
                                        <?php
                                            }  else {
                                        ?>
                                            <a href= "<?php echo "article/".$article["id"]."/".$article["slug"];?>">
                                                <img width = 100% height = 100% src = "./img/upava.png"/>
                                            </a>

                                        <?php

                                            }
                                        ?>

                                        <h6 style = "margin-left: 8px;"><b><?php echo $article["title"];?></b></h6>
                                        <!--<div class = "when" style = "margin-left: 8px;">
                                            <span class = "datetime">
                                                <img style = "margin-bottom: 2px;" width = 22 height = 22 src = "./img/calendar.png"/>
                                                <span><i><?php echo $article["date"]."   ".$article["time"];?></i></span>
                                            </span>
                                        </div>-->
                                    </div>
                                </div>
                                <?php
                                      }

                                    } else {
                                ?>
                                     <span style = "text-align: center;">This category has no content yet</span>
                                <?php
                                    }                                    
                                ?>
                            </div>
                        </div>
                        <!--end-->
                    </div>
                </div>
            </section>

            <?php include "footer.php";?>
        </div> 
    </body>
</html>
