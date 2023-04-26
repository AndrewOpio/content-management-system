<?php
   include "connect.php";
   
   $galleries_query1 = "SELECT * FROM Gallery_types";
   $run_query1 = mysqli_query($conn, $galleries_query1);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <base href="http://localhost/smart24tv/">

        <title>UPAVA | Galleries</title>
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
        <link href="app.min.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" type="text/css" href="css/style.css">

        <link rel='shortcut icon' type='image/x-icon' href='img/upava.png' />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.slim.min.js" integrity="sha512-6ORWJX/LrnSjBzwefdNUyLCMTIsGoNP6NftMy2UAm1JBm6PRZCO1d7OHBStWpVFZLO+RerTvqX/Z9mBFfCJZ4A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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
                               <h4>UPAVA Galleries</h4>
                           </div>

                           <div class = "row">
                                <div class = "col-md-12">
                                   
                                            <?php
                                                if (mysqli_num_rows($run_query1)!=0) {
                                            ?>
                                            <div class = "row">
                                                <?php
                                                        while($gallery = mysqli_fetch_assoc($run_query1)){
                                                ?>
                                                 <div class = "card">
                                                    <div class ="card-body" style = "margin: auto;">
                                                        <a href = "<?php echo "gallery/".$gallery["title"];?>">
                                                            <img class ="img-disp" width ='100%' height = '95%' src = "<?php echo "admin/".$gallery["image"];?>" data-toggle = "modal" data-target = "#<?php echo $image["id"]."view"; ?>" data-backdrop = "true"/>
                                                        </a>
                                                        <h4 class = "name" style = "text-align: center;"><?php echo $gallery["title"];?></h4>
                                                    </div>
                                                </div>
                                                <?php
                                                        }
                                                ?>
                                            </div>
                                            <?php
                                                } else {
                                            ?>
                                                <span style = "text-align: center;">No galleries to show.</span>
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


