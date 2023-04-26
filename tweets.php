<?php
   include "connect.php";
   
   $gallery_query1 = "SELECT * FROM Gallery";
   $run_query1 = mysqli_query($conn, $gallery_query1);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <base href="http://localhost/smart24tv/">

        <title>UPAVA | Tweets</title>
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
        <link href="app.min.css" rel="stylesheet" type="text/css">
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

            @media (max-width: 768px){
                .logo {
                    margin-right: 78% !important;
                }
            }
        </style>
    
    </head>


    <body>
        <div id="fb-root"></div>
        <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v15.0&appId=3848498428583517&autoLogAppEvents=1" nonce="jnQ8aOAC"></script>
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
                               <h4>UPAVA Tweets</h4>
                           </div>
                           <!--
                           <div class="fb-page" data-href="https://www.facebook.com/profile.php?id=100075793158426" data-tabs="timeline" data-width="500" data-height="500" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/profile.php?id=100075793158426" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/profile.php?id=100075793158426">Ugandans in Victoria</a></blockquote></div>
                           -->
                           <div class = "row" style = "margin-top: 10px;">
                                <div class = "col-md-12">
                                    <a class="twitter-timeline" href="https://twitter.com/nbstv?ref_src=twsrc%5Etfw">Tweets by nbstv</a> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
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

</html>


