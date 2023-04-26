<style>
 /* The container <div> - needed to position the dropdown content */
.dropdown {
    position: relative;
    display: inline-block;
  }
  
  /* Dropdown Content (Hidden by Default) */
  .dropdown-content {
    display: none;
    position: absolute;
    background-color: #fff;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 1;
  }
  
  /* Links inside the dropdown */
  .dropdown-content a {
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
  }
  
  /* Change color of dropdown links on hover */
  .dropdown-content a:hover {background-color: #ddd;}
  
  /* Show the dropdown menu on hover */
  .dropdown:hover .dropdown-content {display: block;}
  
</style>

<?php
   $get = "SELECT * FROM Categories";
   $data = mysqli_query($conn, $get);

   /*$get_p = "SELECT * FROM Plans";
   $p_data = mysqli_query($conn, $get_p);

   include "payment/key.php";

   if ($jwt_error) {
    ?>
      <script>
        alert("An error occurred please refresh and try again");
      </script>
    <?php 
   }
   
   
   if($_SERVER["REQUEST_METHOD"] == "POST"){

      $transientToken = $_POST['flexresponse'];

      $amount = $_POST["amount"];
      $fname = $_POST["fname"];
      $lname = $_POST["lname"];
      $email = $_POST["email"];
      $country = $_POST["country"];
      $address = $_POST["address"];
      $district = $_POST["district"];
      $phone = $_POST["phone"];
   
      include "payment/payment.php"; 

      if ($payment == "AUTHORIZED") {
         include "payment/capture.php";
         
         if ($trans == 'success') {
            $am_query = "SELECT * FROM Plans WHERE amount ='$amount'";
            $am_data = mysqli_query($conn, $am_query);            
            $am_res = mysqli_fetch_assoc($am_data);  
            
            $date = date('Y-m-d h:m:s');
            $date1 = date('Y-m-d h:m:s', strtotime($date. '+' . $am_res['days'] .'days')); 
            $plan = $am_res['name'];

            $ins_query = "INSERT INTO Subscriptions (email, plan, start, end, amount) values ('$email', '$plan' ,'$date', '$date1', '$amount')";
            $ins_run = mysqli_query($conn, $ins_query);           
            
            ?>
              <script>
                 alert("Payment successful");
              </script>
            <?php

         } else {
            ?>
            <script>
              alert("An error occurred please try again");
            </script>
          <?php
         }
         
      } else {
        ?>
        <script>
           alert("An error occurred please try again");
        </script>
      <?php
      }      
   }*/

?>


<!--main navbar-->
<nav class = "fixed-top" style = "display: flex;" id="navbar">
    <!--Upper bar-->
    <!--<div class = "upper">
        <img  style = "border-radius: 35px; margin-top: 5px; margin-bottom: 5px;" class = "logo"  width = 60 height = 60 src = "./img/upava.png"/>
        <div class="dropdown socials">
            <?php 
               if(true/*isset($_COOKIE['google_user'])*/) { 
                  //$sub_query = "SELECT * FROM Subscriptions WHERE email ='$_COOKIE[google_user]' ORDER BY start DESC";
                  //$sub_data = mysqli_query($conn, $sub_query);            
            ?>
                 <img  id = "img" width = 35 height = 35  data-toggle="dropdown" class="dropdown-toggle" style = "padding: 0px !important; border-radius : 25px; color: white;"/>
                 <div class = "status">signed in</div>
            <?php
               } else {
            ?>
                  <div style = "width: 100px;" class="g-signin2" data-onsuccess="onSignIn"></div>
            <?php
              }
            ?>
            
            <div class="dropdown-menu" style = "margin-top: 15px; padding: 20px;">
                <div style = "width: 100%;">
                    <img  id = "img" width = 60 height = 60  style = "display: block; margin: auto; border-radius : 30px;"/>
                    <h6 id = "name" class = "nme"></h6>
                    <h6 id = "email" class = "em"></h6>
                    <hr style = "background-color: #ffa64d;">
                    <h6 class = "sub"><b>Subscription status</b></h6>
                    <?php
                      $date = date("Y-m-d H:m:s");

                      $status_query = "SELECT * FROM Subscriptions WHERE start <= '$date' AND end > '$date'";
                      $status_data = mysqli_query($conn, $status_query);   
                      $status_res = mysqli_fetch_assoc($status_data);   
                      
                      if ($status_res) {
                      ?>
                          <div class = "date-tym">Start: <?php echo $status_res["start"];?></div>
                          <div class = "date-tym">End: <?php echo $status_res["end"];?></div>
                      <?php
                      } else {
                      ?>
                        <div style = "color : red; font-size: 13px; text-align: center;">No running subscriptions</div>
                      <?php
                      }
                      
                    ?>
                    <?php

                    ?>
                    <div style = "text-align: center; margin-top: 10px;">
                        <button style = "padding-left: 8px; padding-right: 8px; border: none; border-radius: 10px; margin-right: 5px; border-color: #ffa64d; background-color: #ffa64d; border-width: 1px;" data-toggle = "modal" data-target = "#history" data-backdrop = "true">History</button>
                        <button <?php echo !$status_res ? "disabled" :"";?> style = "padding-left: 8px; padding-right: 8px; border: none; border-radius: 10px; border-color: #ffa64d; background-color: #ffa64d; border-width: 1px;" data-toggle = "modal" data-target = "#subscribe" data-backdrop = "true">Subscribe</button>
                    </div>
                    <div style = "margin-top: 15px; text-align: center;">
                        <a href="#" onclick="signOut();">Sign out</a>
                    </div>
                </div>
            </div>
        </div>
    </div>-->    
    <!--lower bar-->
    <nav class = "navbar navbar-expand-sm lower" style = "width: 100%;">
        <img  style = "border-radius: 35px; margin-top: 5px; margin-bottom: 5px;" class = "logo"  width = 60 height = 60 src = "./img/upava.png"/>

        <div class = "navbar-header">
            <button class = "navbar-toggler ham-burger" type = "button" data-toggle= "collapse" data-target = "#menu">
                <img width = 30 height = 30 src = "./img/menu.png"/>
            </button>

            <button class = "mobi" onclick = "displayMain()">Main</button>
            <button class = "mobi" onclick = "displayAside()">Latest</button>
        </div>


        <div class = "collapse navbar-collapse"id = "menu">
            <ul class = "navbar-nav">
                <div>
                  <li class = "nav-item">
                      <a href = "home" class = "nav-link  link-text">HOME</a>
                  </li>
                </div>

            <?php
                while($result = mysqli_fetch_assoc($data)){
                    $get_menu = "SELECT * FROM Sub_Menus WHERE navigation = '$result[id]'";
                    $menu_data = mysqli_query($conn, $get_menu);
               
                    if(mysqli_num_rows($menu_data)!=0 && $result["navbar"] == "top"){                                
            ?>         
                        <div class="dropdown">
                          <li class = "nav-item">
                              <a href = "#"
                                 class = "nav-link  link-text"><?php echo $result["title"]; ?>
                              </a>
                          </li>
                          <div class="dropdown-content">
                            <?php
                              while($nav_data = mysqli_fetch_assoc($menu_data)) {
                            ?>
                                 <a href="<?php echo "page/".$nav_data["id"]."/sub/".$nav_data["title"];?>"><?php echo $nav_data["title"]; ?></a>
                            <?php
                              }
                            ?>
                          </div>
                        </div>
            <?php
                    } else if (mysqli_num_rows($menu_data)==0 && $result["navbar"] == "top") {
            ?>
                        <div>
                          <li class = "nav-item">
                              <a href = "<?php echo $result["type"] == "category"?
                                  "category/".$result["id"]."/".$result["title"] : "page/".$result["id"]."/main/".$result["title"];?>"
                                  class = "nav-link  link-text"><?php echo $result["title"]; ?>
                              </a>
                          </li>
                        </div>
            <?php
                    }
                }
            ?>
            </ul>
        </div>

    </nav>
</nav>

<!--<div id="subscribe" class="modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content"style = "padding :20px;">
            <iframe name=”ddc-iframe” height="10" width="10" style="display: none;">
            </iframe>
            <form id="ddc-form" target=”ddc-iframe” method="POST" action="">
                <input id = "access" type="hidden" name="JWT" value=""/>
            </form>

            <form id = "form" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                <h6><b>Subscription plan</b></h6>
                <hr>
                <div class="row">
                  <div class="form-group col-md-12">
                      <label>Select plan</label>
                      <select  class="form-control" name="amount" required>

                      <?php
                          while($p_res = mysqli_fetch_assoc($p_data)){
                      ?>         
                            <option value="<?php echo $p_res["amount"];?>"><?php echo $p_res["name"];?>(<?php echo $p_res["amount"];?> UGX)</option>
                      <?php
                          }
                      ?>
                      </select>
                  </div>
                </div>
            
                <h6 style = "margin-top : 5px;"><b>Billing information</b></h6>
                <hr>
                <div class="row">
                  <div class="form-group col-md-6">
                    <label for="expMonth">First Name</label>
                    <input type="text"  id="fname" class="form-control" name = "fname" placeholder = "enter first name.." required>
                  </div>

                  <div class="form-group col-md-6">
                    <label for="cVV">Last Name</label>
                    <input type="text"  id="lname"  class="form-control" name = "lname" placeholder = "enter last name.." required>
                  </div>
                </div>


                <div class="row">
                  <div class="form-group col-md-12">
                    <label for="cardNum">Email</label>
                    <input type="email"  id="email"  class="form-control" name = "email" placeholder = "enter email.." required>
                  </div>
                </div>


                <div class="row">
                  <div class="form-group col-md-6">
                    <label for="expMonth">Country</label>
                    <input type="text"  id="country" class="form-control" name = "country" placeholder = "enter country.." required>
                  </div>

                  <div class="form-group col-md-6">
                    <label for="cVV">District</label>
                    <input type="text" id="district"  class="form-control" name = "district" placeholder = "enter district.." required>
                  </div>
                </div>

                <div class="row">
                  <div class="form-group col-md-12">
                    <label for="cardNum">Address</label>
                    <input type="text" id="address"  class="form-control" name = "address" placeholder = "enter address.." required>
                  </div>
                </div>

                <div class="row">
                  <div class="form-group col-md-12">
                    <label for="cardNum">Contact</label>
                    <input type="phone" id="contact"  class="form-control" name = "phone" placeholder = "enter contact.." required>
                  </div>
                </div>

                <div class="row" style = "height: 30px; margin-top : 20px;">
                  <div class="form-group col-md-12">
                    <img src = "payment/images/img.png" style = "height: 30px; float: right;"/>
                    <h6 style = "margin-top : 5px;"><b>Credit/Debit Card</b></h6>
                  </div>
                </div>
                <hr>
                <div class="row">
                  <div class="form-group col-md-12">
                    <label for="cardNum">Card Number</label>
                    <img id = "card" src = "" style = "height: 25px;"/>
                    <div id = 'number-container' class="form-control"></div>
                  </div>
                </div>

                <div class="row">
                  <div class="form-group col-md-6">
                    <label for="expMonth">Expiry Date</label>
                    <input type="text" autocomplete = "off"  id="expDate" oninput = "expiryDate()" style = "border-style: solid; border-width: 0.5px; border-color: #e2e2e2; background-color: #fff; width: 100%" class="form-control" name = "month" placeholder = "MM/YY"  maxlength = "5" size = "5">
                  </div>

                  <div class="form-group col-md-6">
                    <label for="cVV">CVV</label>
                    <div id = 'securityCode-container' class="form-control"></div>
                  </div>
                </div>
                
                <input type="hidden" id="flexresponse" name="flexresponse">

                <div class="row">
                  <div class="form-group col-md-12">
                    <button id = 'payButton' type = "submit" style = "width: 100%;" class="btn">Pay now</button>
                  </div>
                </div>
            </form>
        </div>
    </div>
</div>

<div id="history" class="modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style = "padding :20px;">
           <div class="modal-header">
               <h5 class="modal-title" >Subscription history</h5>
           </div>

           <?php
                //if($sub_res){
                //    while($sub_res = mysqli_fetch_assoc($sub_data)){
            ?>         
                      <div style = "margin-top: 10px;">
                          <span style = "font-size: 15px;">Plan : <?php //echo $sub_res["plan"];?></span><br>
                          <span style = "font-size: 15px;">Start : <?php //echo $sub_res["start"];?></span><br>
                          <span style = "font-size: 15px;">End : <?php //echo $sub_res["end"];?></span><br>
                          <span style = "font-size: 15px;">Amount paid : <?php //echo $sub_res["amount"];?> UGX</span>
                          <hr>
                      </div>
            <?php
               //     }

            //    } else {
            ?>
                     <h6 style = "text-align: center;">No subscription history</h6>
            <?php
           //     }

            ?>
        </div>
    </div>
</div>-->

<script src="https://flex.cybersource.com/cybersource/assets/microform/0.11/flex-microform.min.js"></script>

<script>

    function displayMain(){
        document.getElementById("main").style.display = "block";
        document.getElementById("aside").style.display = "none";
    }

    function displayAside(){
      document.getElementById("aside").style.setProperty('display', 'block', 'important');
        document.getElementById("main").style.display = "none";
    }

</script>


