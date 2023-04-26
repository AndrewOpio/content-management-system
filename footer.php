<!--footer-->
<footer>
    <div class = "row" style = "margin: auto;">
        <div class = "col-md-3 card-footer">
            <h4 style = "color: white;">Location</h4>
            <!--<img  style = "border-radius: 40px; margin-left:0px !important; margin-top: 5px;" class = "logo"  width = 80 height = 80 src = "./img/upava.png"/>-->
            <?php
                $contact = "SELECT * FROM Contacts";
                $contact_data = mysqli_query($conn, $contact);
                
                $contact_result = mysqli_fetch_assoc($contact_data);
            ?>

            <li class = "footer-item"><?php echo $contact_result["box"]; ?></li>
            <li class = "footer-item"><?php echo $contact_result["area"]; ?></li>
            <li class = "footer-item"><?php echo $contact_result["district"]; ?></li>
        </div>

        <div class = "col-md-3 card-footer">
            <h4 style = "color: white;">Others</h4>
            <li><a class = "footer-item footer-link" href = "galleries.php">Galleries</a></li>
            <li><a class = "footer-item footer-link" href = "videos.php">Videos</a></li>
            <li><a class = "footer-item footer-link" href = "tweets.php">Tweets</a></li>

            <?php
                $get = "SELECT * FROM Categories";
                $data = mysqli_query($conn, $get);
                
                while($result = mysqli_fetch_assoc($data)){
                    if($result["navbar"] == "bottom"){                                
            ?>
                        <li><a class = "footer-item footer-link" href = "<?php echo $result["type"] == "category"?
                                "category/".$result["id"]."/".$result["title"] : "page/".$result["id"]."/main/".$result["title"];?>"><?php echo $result["title"]; ?></a></li>
            <?php
                    }
                }
            ?>
        </div>

        <div class = "col-md-4 card-footer">
            <h4 style = "color: white;">Contact Us</h4>
            <li class = "footer-item"><img width = 25 height = 25 src = "./img/office.png"/><a href = "contact_us.php" class = "footer-item footer-link">Offices</a></li>
            <!--<li class = "footer-item"><img width = 25 height = 25 src = "./img/phone-call.png"/><?php echo $contact_result["phone"]; ?></li>
            <li class = "footer-item"><img width = 25 height = 25 src = "./img/whatsapp.png"/><?php echo $contact_result["whatsapp"]; ?></li>-->
            <li class = "footer-item"><img width = 25 height = 25 src = "./img/gmail.png"/><?php echo $contact_result["email"]; ?></li>
        </div>

        <div class = "col-md-2 card-footer">
            <h4 style = "color: white;">Socials media</h4>
            <?php
                $get_acc = "SELECT * FROM Socials";
                $data_acc = mysqli_query($conn, $get_acc);
                
                while($result_acc = mysqli_fetch_assoc($data_acc)){
            ?>
                    <li><a class = "footer-item footer-link" href = "<?php echo $result_acc["url"];?>"><img width = 25 height = 25 src = "<?php echo "./img/".$result_acc["image"];?>"/><?php echo $result_acc["title"]; ?></a></li>
            <?php
                }
            ?>
        </div>

    </div>
    
    <div style = "text-align: center;">
        <div style = "color: white; font-size: 15px;">
            Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | <a>UPAVA</a>
        </div>
    </div>
</footer>
