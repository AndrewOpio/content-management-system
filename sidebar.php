<style>
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
</style>

<!--side bar-->
<aside id = "aside">
    <h4 style = "margin-left: 8px; margin-top: 10px; color: red;">LIVE STREAM</h4>
    <div class = "card">
        <iframe width="100%" height="100%" src="https://www.youtube.com/channel/UCdU_4QDQ4k_8Ry7f8IITJ0Q" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
    </div>
    
    <h4 style = "margin-top: 15px; color: red;">Latest</h4>
    <div class = "date">
        <img style = "margin-bottom: 0px;" width =25 height = 25 src = "./img/calendar.png"/>
        <span>
            <?php echo date('Y-m-d');?>
        </span>
    </div>

    <table class="table table-striped" border = "0">
    <?php
        $date = date('Y-m-d'); 

        //$date = '2021-06-02'; 

        $sql = "SELECT * FROM Articles WHERE status = 1 ORDER BY id desc";
        $run = mysqli_query($conn, $sql);

        if(mysqli_num_rows($run)==0){
    ?>
        <tr>
            <td>
            <div>
                <span style = "font-size: 13px; text-align: center;">No data to show</a></span>
            </div>
            </td>
        </tr>

    <?php
        } else {
        
        $count = 0;
        while($res = mysqli_fetch_assoc($run)){
           if($count < 10) {

    ?>
        <tr>
            <td>
            <div>
                <span style = "font-size: 13px;"><a href = "<?php echo "article/".$res["id"]."/".$res["slug"];?>"><?php echo $res["title"]; ?></a></span>
                <!--<div>
                    <img style = "margin-bottom: 0px;" width =22 height = 22 src = "./img/time.png"/>
                    <span class = "datetime"><?php echo $res["date"] . " ".$res["time"]; ?></span>
                </div>-->
            </div>
            </td>
        </tr>
    <?php
             $count++;
          }
        }
    }

    ?>
    </table>
</aside>































































































