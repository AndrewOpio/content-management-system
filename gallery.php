<?php
   include "connect.php";
   
   $type = mysqli_real_escape_string($conn, $_GET['type']);

   $gallery_query1 = "SELECT * FROM Gallery WHERE gallery_type = '$type'";
   $run_query1 = mysqli_query($conn, $gallery_query1);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <base href="http://localhost/smart24tv/">

        <title>UPAVA | Gallery</title>
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel='shortcut icon' type='image/x-icon' href='img/upava.png' />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" crossorigin="anonymous"></script>
        <style>
            @media (min-width: 769px){
                .img-disp{
                    width: 215px;
                    height: 180px;
                    object-fit: cover;
                }
            }

            @media (max-width : 768px) {
                aside{
                    display: none !important;
                    width: 100%;
                    margin-top: 150px; 
                    padding-left: 20px;
                }

                .logo {
                    margin-right: 78% !important;
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
                               <h4>UPAVA Gallery</h4>
                           </div>

                           <div class = "row">
                                <div class = "col-md-12">
                                    <div class = "card">
                                        <div class ="card-body" style = "margin: auto;">
                                            <?php
                                                if (mysqli_num_rows($run_query1)!=0) {
                                            ?>
                                            <div class = "row">
                                                <?php
                                                        while($image = mysqli_fetch_assoc($run_query1)){
                                                ?>
                                                    <div class = "col-md-3" style = "margin: auto;">
                                                        <img class ="img-disp" width ='100%' height = '100%' src = "<?php echo "admin/".$image["image"];?>" data-toggle = "modal" data-target = "#<?php echo $image["id"]."view"; ?>" data-backdrop = "true"/>
                                                        <div id="<?php echo $image["id"]."view"; ?>" class="modal fade" role="dialog">
                                                            <div class="modal-dialog modal-dialog-centered">
                                                                <!-- Modal content-->
                                                    
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <div id="<?php echo "myCarousel".$image["id"]; ?>" class="carousel slide" data-interval="false">

                                                                            <!-- Wrapper for slides -->
                                                                            <div class="carousel-inner">
                                                                            <?php
                                                                                $i = 1;
                                                                                $gallery_query2 = "SELECT * FROM Gallery";
                                                                                $run_query2 = mysqli_query($conn, $gallery_query2);  
                                                                            ?>
                                                                            
                                                                                <div class="item active">
                                                                                    <img src= "<?php echo "admin/".$image["image"]; ?>" width = 100% height = 100% alt = "gallery image"/>
                                                                                </div>
                                                                            <?php
                                                                     
                                                                                while($ext = mysqli_fetch_assoc($run_query2))
                                                                                {
                                                                                    if($ext['id'] > $image['id']) {
                                                                            ?>
                                                                                <div class="item">
                                                                                    <img src= "<?php echo "admin/".$ext["image"]; ?>" width = 100% height = 100% alt = "gallery image"/>
                                                                                </div>
                                                                            <?php
                                                                                    }
                                                                                   
                                                                                    if(mysqli_num_rows($run_query2) == $i){
                                                                                        $gallery_query3 = "SELECT * FROM Gallery WHERE id < $image[id]";
                                                                                        $run_query3 = mysqli_query($conn, $gallery_query3);  

                                                                                        while($ext1 = mysqli_fetch_assoc($run_query3))
                                                                                        {
                                                                            ?>
                                                                                <div class="item">
                                                                                    <img src= "<?php echo "admin/".$ext1["image"]; ?>" width = 100% height = 100% alt = "gallery image"/>
                                                                                </div>
                                                                                      
                                                                            <?php
                                                                                        }
                                                                                    }
                                                                                 $i++;
                                                                                }
                                                                            ?>
                                                                            </div>
                                                                            <!-- Left and right controls -->
                                                                            <a class="left carousel-control" href="#<?php echo "myCarousel".$image["id"]; ?>" data-slide="prev" style="background:none !important">
                                                                                <span class="glyphicon glyphicon-chevron-left"></span>
                                                                                <span class="sr-only">Previous</span>
                                                                            </a>
                                                                            <a class="right carousel-control" href="#<?php echo "myCarousel".$image["id"]; ?>" data-slide="next" style="background:none !important">
                                                                                <span class="glyphicon glyphicon-chevron-right"></span>
                                                                                <span class="sr-only">Next</span>
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php
                                                        }
                                                ?>
                                            </div>
                                            <?php
                                                } else {
                                            ?>
                                                <span style = "text-align: center;">This gallery has no content yet</span>
                                            <?php
                                                }                                    
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end-->
                    </div>
                </div>
            </section>

            <?php include "footer.php";?>
        </div> 
    </body>

    <script>
        $(document).ready(function() {
          $('#global-modal').modal('show');
        });
    </script>
</html>


