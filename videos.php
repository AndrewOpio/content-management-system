<?php
   
   include "connect.php";
   // API configuration
    $API_Key    = 'AIzaSyBUb_QUayDjaN8EYQ_vljUt5pDClGpw87I'; 
    $Channel_ID = 'UCdU_4QDQ4k_8Ry7f8IITJ0Q'; 
    $Max_Results = 20; 
 
    // Get videos from channel by YouTube Data API 
    $apiData = @file_get_contents('https://www.googleapis.com/youtube/v3/search?order=date&part=snippet&channelId='.$Channel_ID.'&maxResults='.$Max_Results.'&key='.$API_Key.''); 
    if($apiData){ 
        $videoList = json_decode($apiData); 

    }else{ 
        echo 'Invalid API key or channel ID.'; 

    }
  

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <base href="http://localhost/smart24tv/">

        <title>UPAVA | Videos</title>
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
        <link href="css/app.min.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel='shortcut icon' type='image/x-icon' href='img/upava.png' />

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" crossorigin="anonymous"></script>
        

        <style>
            @media (max-width: 768px){
                iframe {
                    width: 100%;
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
                        
                        <div class = "title"> 
                            <h4>Videos</h4>
                        </div>
                       
                           <?php
                          if(!empty($videoList->items)){ 
                            echo"<div class = 'row'>";
                                foreach($videoList->items as $item){ 
                                    // Embed video 
                                    if(isset($item->id->videoId)){ 
                                        echo ' 
                                        <div class="col-lg-3 col-md-6"> 
                                        <div class="card">
                                            <iframe width="185" height="150" src="https://www.youtube.com/embed/'.$item->id->videoId.'" frameborder="0" allowfullscreen></iframe> 
                                            <h6 style = "padding-top: 5px; padding-left: 5px; padding-right: 5px;"><b>'. $item->snippet->title .'</b></h6> 
                                            </div>
                                            
                                        </div>'; 
                                    } 
                                } 
                            }else{ 
                                echo '<p class="error">'.$apiError.'</p>'; 
                            }
                           ?>
                    </div>
                </div>
            </section>

            <?php include "footer.php";?>
        </div> 
    </body>
</html>
