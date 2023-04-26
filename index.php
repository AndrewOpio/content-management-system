<?php
   include "connect.php";
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>UPAVA | Home</title>
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
        <meta name="google-signin-client_id" content="85368409346-qrco9pjtac5i4uq8ag7vnhvlvqq7pmkp.apps.googleusercontent.com">
        <link href="css/app.min.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
        <link rel='shortcut icon' type='image/x-icon' href='img/upava.png' />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

        <script src="https://apis.google.com/js/platform.js" async defer></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" crossorigin="anonymous"></script>
    
        <style>
            @media (min-width: 769px){
                .img-disp{
                    width: 150px;
                    height: 155px;
                    object-fit: cover;
                }

                .mobile-slide {
                    display: none;
                }

                .large-screen-slide {
                    display: block;
                }
            }

            @media (max-width: 768px){
                .mobile-slide {
                    display: block;
                }

                .large-screen-slide {
                    display: none;
                }

                .logo {
                    margin-right: 78% !important;
                }
            }

            .container {
                height: 120px;
                position: relative;
                margin-bottom: 15px;
                width: 100%;
                background-image: url("img/cc.jpeg");
            }

            .center {
                margin: 0;
                position: absolute;
                top: 50%;
                left: 50%;
                -ms-transform: translate(-50%, -50%);
                transform: translate(-50%, -50%);
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
                        <div class="container">
                            <div class="center">
                                <h4 style = "color: white; text-align: center;"><b>UGANDAN COMMUNITY IN VICTORIA.</b></h4>
                            </div>
                        </div>
                    </div>
                </div>

                <div class = "row">
                    <div class = "col-md-9">
                    <?php
                       $get = "SELECT * FROM Categories";
                       $data = mysqli_query($conn, $get);

                        while ($result = mysqli_fetch_assoc($data))
                        {
                            if ($result["type"] == "category")
                            {
                                $req = "SELECT * FROM Articles WHERE categoryid = '$result[id]' AND status = 1 ORDER BY id desc";
                                $articles = mysqli_query($conn, $req);

                                if($result["display"] == "collection")
                                { 

                                    //$article_main = mysqli_query($conn, $req);
                                    if(mysqli_num_rows($articles)!=0)
                                    {   
                                        $article_main = mysqli_fetch_assoc($articles)         
                    ?>         
                                        <!--first layout-->
                                        <div>
                                            <div class = "title"> 
                                                <h4><?php echo $result["title"]; ?></h4>
                                            </div>
                                            <div class = "row">
                                                <div class= "col-md-7 padding-0">
                                                    <div class = "card">
                                                        <?php 
                                                           if ($article_main["image"]) {
                                                        ?>
                                                            <a href= "<?php echo "article/".$article_main["id"]."/".$article_main["slug"];?>">
                                                               <img width = 100% height = 100% src = "admin/posts/<?php echo $article_main["image"];?>"/>
                                                            </a>
                                                        <?php 
                                                           } else if ($article_main["video"]) {
                                                        ?>
                                                            <a href= "<?php echo "article/".$article_main["id"]."/".$article_main["slug"];?>" class="contain vid">
                                                                <div class="centered">
                                                                    <img width = 32 height = 32 src = "./img/play.png"/>
                                                                </div>

                                                                <video width = 100% height = 100%>
                                                                    <source src="<?php echo $article_main["video"];?>" type="video/mp4">
                                                                    Your browser does not support the video tag.
                                                                </video>
                                                            </a>
                                                        <?php
                                                           } else {
                                                        ?>
                                                            <a href= "<?php echo "article/".$article_main["id"]."/".$article_main["slug"];?>">   
                                                               <img width = 100% height = 100% src = "./img/upava.png"/>
                                                            </a>

                                                        <?php

                                                           }
                                                        ?>


                                                        <h5 class = "head"><b><?php echo $article_main["title"];?></b></h5>
                                                        <!--<div class = "when-main">
                                                            <span class = "datetime">
                                                                <img style = "margin-bottom: 2px;" width = 22 height = 22 src = "./img/calendar.png"/>
                                                                <span><i><?php echo $article_main["date"]." ".$article_main["time"];?></i></span>
                                                            </span>
                                                        </div>-->
                                                    </div>
                                                </div>
                                                
                                                <div class= "col-md-5 padding-0">
                                                    <?php
                                                        $id = 1;
                                                        while($article = mysqli_fetch_assoc($articles)){
                                                            if($id<5){          
                                                    ?>
                                                                <div class = "card card-margin">
                                                                    <div class = "row">
                                                                        <table cellspacing="0" cellpadding="0">
                                                                            <tr>
                                                                                <div class = "col-md-6">
                                                                                    <td style = "vertical-align: top;">
                                                                                    <?php 
                                                                                    if ($article["image"]) {
                                                                                    ?>
                                                                                        <a href= "<?php echo "article/".$article["id"]."/".$article["slug"];?>" style = "margin-left: 15px;">
                                                                                           <img width = 100 height = 100 src = "admin/posts/<?php echo $article["image"];?>" />
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
                                                                                        <a href= "<?php echo "article/".$article["id"]."/".$article["title"];?>">
                                                                                        <img width = 100% height = 100% src = "./img/upava.png"/>
                                                                                        </a>
                            
                                                                                    <?php
                                                                                        }
                                                                                    ?>
                                                                                    </td>
                                                                                </div>
                                                                                <div class = "col-md-6 padding-0">
                                                                                    <td style = "vertical-align: top;">
                                                                                        <div class = "side">
                                                                                            <h6 style = "margin-top: -5px; font-size: 15px; width: 140px;"><b><?php echo $article["title"];?></b></h6>
                                                                                            <!--<div style = "margin-left: -3px;">
                                                                                                <span class = "datetime">
                                                                                                    <img style = "margin-bottom: 2px;" width = 22 height = 22 src = "./img/calendar.png"/>
                                                                                                    <span><i><?php echo $article["date"]." ".$article["time"];?></i></span>
                                                                                                </span>
                                                                                            </div>-->
                                                                                        </div>
                                                                                    </td>
                                                                                </div>
                                                                            </tr>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                    <?php
                                                            $id++;
                                                            }
            
                                                    }
                                                    ?>
                                                </div>
                                                <div class = "wraper">
                                                    <button class = "bttn">
                                                        <a style = "color: black; width: 100%;" href = '<?php echo "category/".$result["id"]."/".$result["title"]; ?>' class = "bttn">View more... <img width = 20 height = 20 src = "./img/arr.png"/></a>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <!--end-->
                    <?php
                                    } 
                    
                                    
                                }
                                elseif ($result["display"] == "row") 
                                {
                                    if(mysqli_num_rows($articles)!=0)
                                    {
                    ?>
                                    <!--2nd layout-->
                                        <div>
                                            <div class = "title"> 
                                                <h4><?php echo $result["title"]; ?></h4>
                                            </div>

                                            <div class = "row">
                                                <?php
                                                    $id = 1;
                                                    while($article = mysqli_fetch_assoc($articles)){
                                                        if($id<5){      
                                                ?>

                                                <div class = "col-md-3" style = "padding: 0;">
                                                    <div class = "card" style = "text-align:center;">
                                                       
                                                        <?php 
                                                            if ($article["image"]) {
                                                        ?>
                                                            <a href= "<?php echo "article/".$article["id"]."/".$article["slug"];?>">
                                                                <img class ="img-disp" width = 100% height = 100% src = "admin/posts/<?php echo $article["image"];?>"/>
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
                                                    $id++;
                                                    }
                                                }
                                                ?>
                                                <div class = "wraper">
                                                    <button class = "bttn">
                                                        <a style = "color: black; width: 100%;" href = '<?php echo "category/".$result["id"]."/".$result["title"]; ?>' class = "bttn">View more... <img width = 20 height = 20 src = "./img/arr.png"/></a>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    <!--end-->
                    <?php
                                    } 
                    

                                }
                                elseif ($result["display"] == "slide")
                                {
                                    if(mysqli_num_rows($articles)!=0)
                                    {

                    ?>              
                                    <!--3rd layout-->
                                    <div>
                                        <div class="title" style = "width: 100%; margin-top: 0px;">
                                            <div class="col-md-6" style = "margin-left: -20px; margin-top: 10px;">
                                                <h4><?php echo $result["title"]; ?></h4>
                                            </div>
                                            <!--<div class="col-md-6 text-right large-screen-slide">
                                                <a class="btn arr" href="#large-screen-carousel" role="button" data-slide="prev">
                                                     <img width = 25 height = 25 src = "./img/left.png"/>
                                                </a>
                                                <a class="btn arr" href="#large-screen-carousel" role="button" data-slide="next">
                                                     <img width = 25 height = 25 src = "./img/right.png"/>
                                                </a>
                                            </div>

                                            <div class="col-md-6 text-right mobile-slide">
                                                <a class="btn arr" href="#mobile-carousel" role="button" data-slide="prev">
                                                     <img width = 25 height = 25 src = "./img/left.png"/>
                                                </a>
                                                <a class="btn arr" href="#mobile-carousel" role="button" data-slide="next">
                                                     <img width = 25 height = 25 src = "./img/right.png"/>
                                                </a>
                                            </div>-->
                                        </div>


                                        <div class="row">                                            
                                            <div class="col-12">
                                                <div id="large-screen-carousel" class="carousel slide  large-screen-slide" data-ride="carousel" data-interval = "4000">
                                                    <div class="carousel-inner">
                                                        <div class="item active">
                                                            <div class="row">

                                                            <?php
                                                                $id = 1;
                                                                while($article = mysqli_fetch_assoc($articles)){
                                                                    if ($id<=4) {          
                                                            ?>

                                                                <div class="col-sm-6 col-md-3"  style = "padding: 0;">
                                                                    <div class="card" style = "text-align:center;">
                                                                        
                                                                        <?php 
                                                                           if ($article["image"]) {
                                                                        ?>
                                                                            <a href= "<?php echo "article/".$article["id"]."/".$article["slug"];?>">
                                                                               <img class = "img-disp" width = 100% height = 100% src = "admin/posts/<?php echo $article["image"];?>"/>
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

                                                                        <div>
                                                                            <h6 class = "head"><b><?php echo $article["title"];?></b></h6>
                                                                            <!--<div class = "when-main">
                                                                                <span class = "datetime">
                                                                                    <img style = "margin-bottom: 2px;" width = 22 height = 22 src = "./img/calendar.png"/>
                                                                                    <span><?php echo $article["date"]." ".$article["time"];?></span>
                                                                                </span>
                                                                            </div>-->
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            <?php
                                                                    } else {
                                                                        break;
                                                                    }

                                                                    $id++;
                                                                }
                                                            ?>
                                                            </div>
                                                        </div>


                                                        <div class="item">
                                                            <div class="row">
                                                            <?php
                                                                $id = 1;
                                                                $req = "SELECT * FROM Articles WHERE categoryid = '$result[id]'";
                                                                $articles = mysqli_query($conn, $req);

                                                                while($article = mysqli_fetch_assoc($articles)){
                                                                    if($id>4 && $id<=8){          
                                                            ?>

                                                                <div class="col-sm-6 col-md-3" style = "padding: 0;">
                                                                    <div class="card" style = "text-align:center;">

                                                                        <?php 
                                                                           if ($article["image"]) {
                                                                        ?>
                                                                            <a href= "<?php echo "article/".$article["id"]."/".$article["slug"];?>">
                                                                               <img class = "img-disp" width = 100% height = 100% src = "admin/posts/<?php echo $article["image"];?>"/>
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


                                                                        <div>
                                                                            <h6 class = "head"><b><?php echo $article["title"];?></b></h6>
                                                                            <!--<div class = "when-main">
                                                                                <span class = "datetime">
                                                                                    <img style = "margin-bottom: 2px;" width = 22 height = 22 src = "./img/calendar.png"/>
                                                                                    <span><?php echo $article["date"]." ".$article["time"];?></span>
                                                                                </span>
                                                                            </div>-->
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            <?php
                                                                    } elseif ($id>8) {
                                                                        break;
                                                                    }
                                                                    $id++;
                                                                }
                                                            ?>

                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Left and right controls -->
                                                    <a class="left carousel-control" href="#large-screen-carousel" data-slide="prev" style="width: 40px;">
                                                        <span class="glyphicon glyphicon-chevron-left"></span>
                                                        <span class="sr-only">Previous</span>
                                                    </a>
                                                    <a class="right carousel-control" href="#large-screen-carousel" data-slide="next" style="width: 40px;">
                                                        <span class="glyphicon glyphicon-chevron-right"></span>
                                                        <span class="sr-only">Next</span>
                                                    </a>
                                                </div>


                                                <div id="mobile-carousel" class="carousel slide  mobile-slide" data-ride="carousel" data-interval = "4000">
                                                    <div class="carousel-inner">
                                                        <?php
                                                            $id = 1;
                                                            $req = "SELECT * FROM Articles WHERE categoryid = '$result[id]' AND status = 1 ORDER BY id desc";
                                                            $articles = mysqli_query($conn, $req);
                                                            while($article = mysqli_fetch_assoc($articles)){
                                                                if ($id<=4) {          
                                                        ?>
                                                            <div class="item <?php echo $id == 1 ? 'active': '';?> ">
                                                                <div class="row">
                                                                    <div class="col-sm-6 col-md-3  padding-0">
                                                                        <div class="card">
                                                                            
                                                                            <?php 
                                                                            if ($article["image"]) {
                                                                            ?>
                                                                                <a href= "<?php echo "article/".$article["id"]."/".$article["slug"];?>">
                                                                                <img class = "img-disp" width = 100% height = 100% src = "admin/posts/<?php echo $article["image"];?>"/>
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

                                                                            <div>
                                                                                <h6 class = "head"style = "margin-right: 4px;"><b><?php echo $article["title"];?></b></h6>
                                                                                <!--<div class = "when-main">
                                                                                    <span class = "datetime">
                                                                                        <img style = "margin-bottom: 2px;" width = 22 height = 22 src = "./img/calendar.png"/>
                                                                                        <span><?php echo $article["date"]." ".$article["time"];?></span>
                                                                                    </span>
                                                                                </div>-->
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        <?php
                                                                } else {
                                                                    break;
                                                                }

                                                                $id++;
                                                            }
                                                        ?>
                                                    </div>
     
                                                    <!-- Left and right controls -->
                                                    <a class="left carousel-control" href="#mobile-carousel" data-slide="prev" style="background:none !important">
                                                        <span class="glyphicon glyphicon-chevron-left"></span>
                                                        <span class="sr-only">Previous</span>
                                                    </a>
                                                    <a class="right carousel-control" href="#mobile-carousel" data-slide="next" style="background:none !important">
                                                        <span class="glyphicon glyphicon-chevron-right"></span>
                                                        <span class="sr-only">Next</span>
                                                    </a>
                                                </div>
                                                
                                                <div class = "wraper">
                                                    <button class = "bttn" style = "margin-right: 20px;">
                                                        <a style = "color: black; width: 100%;" href = '<?php echo "category/".$result["id"]."/".$result["title"]; ?>' class = "bttn">View more... <img width = 20 height = 20 src = "./img/arr.png"/></a>
                                                    </button>
                                                </div>
                                            </div>            
                                        </div>
                                    </div>
                                    <!--end-->
                    <?php
                                    } 
                                }
                            }
                        }
                    ?>

                    </div>

                    <div class="col-md-3">
                       <h3 style = "margin-top: 5px;">Adverts</h3>
                       <hr style = "background-color: black; margin-top: 0px;"/>

                       <div id="myCarousel" class="carousel slide carousel-fade" data-ride="carousel" data-interval="5000">
                            <!-- Wrapper for slides -->
                            <div class="carousel-inner">
                            <?php
                                $i = 1;
                                $ads_query = "SELECT * FROM Adverts";
                                $run_ads = mysqli_query($conn, $ads_query);
                            ?>
                            <?php
                      
                                while($ads_results = mysqli_fetch_assoc($run_ads))
                                {
                            ?>
                                <div class="item <?php echo $i == 1? 'active': ''?>">
                                    <span><?php echo $ads_results["title"]?></span><br/>

                                    <?php if($ads_results["type"] == "image") {?>
                                        <img width = 100% height = 100% src = "<?php echo './admin/'.$ads_results["media"]?>" data-toggle = "modal" data-target = "#<?php echo $ads_results["id"]."view"; ?>" data-backdrop = "true"/>
                                        <br/>
                                        <hr/>
                                    <?php } else if($ads_results["type"] == "video") {?>
                                        <video width = 80% height = 80% data-toggle = "modal" data-target = "#<?php echo $ads_results["id"]."view"; ?>" data-backdrop = "true">
                                            <source src="<?php echo './admin/'.$ads_results["media"]?>" type="video/mp4">
                                            Your browser does not support the video tag.
                                        </video><br/>
                                        <hr/>
                                    <?php } ?>
                                </div>

                                <div id="<?php echo $ads_results["id"]."view"; ?>" class="modal fade" role="dialog">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title"><?php echo $ads_results["title"]; ?></h4>
                                            </div>
                                            <div class="modal-body">
                                                <?php if ($ads_results["type"] == "image") {?>
                                                <img src= "<?php echo './admin/'.$ads_results["media"]?>" width = 100% height = 100% alt = "advertimage"/>
                                                
                                                <?php } else if ($ads_results["type"] == "video"){?>
                                                    <video width = 60% height = 60% controls>
                                                        <source src="<?php echo './admin/'.$ads_results["media"]?>" type="video/mp4">
                                                        Your browser does not support the video tag.
                                                    </video>
                                                <?php } ?>
                                            </div>                      
                                        </div>
                                    </div>
                                </div>

                            <?php
                                $i++;
                                }
                            ?>
                            </div>
                            <!-- Left and right controls -->
                            <a class="left carousel-control" href="#myCarousel" data-slide="prev" style="background:none !important">
                                <span class="glyphicon glyphicon-chevron-left"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="right carousel-control" href="#myCarousel" data-slide="next" style="background:none !important">
                                <span class="glyphicon glyphicon-chevron-right"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>


                       <?php
                        $ads_query = "SELECT * FROM Adverts";
                        $run_ads = mysqli_query($conn, $ads_query);

                            while ($ads_results = mysqli_fetch_assoc($run_ads))
                            { 
                       ?>
                            <div>
                               
                            </div>

                      <?php } ?>
                    </div>
                </div>
            </section>

            <?php include "footer.php";?>
        </div>
        
    </body>
</html>
