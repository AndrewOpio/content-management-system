<?php
   include "connect.php";

   include "payment/key.php";

   //$date = date('Y-m-d h:m:s');
   
   //$date1 = date('Y-m-d h:m:s', strtotime($date. '+ 1 days')); 

   //echo $date1;

   
   if($_SERVER["REQUEST_METHOD"] == "POST"){

      $transientToken = $_POST['flexresponse'];

      $fname = $_POST["fname"];
      $lname = $_POST["lname"];
      $email = $_POST["email"];
      $country = $_POST["country"];
      $district = $_POST["district"];
      $phone = $_POST["phone"];
   
      include "payment/payment.php"; 

      include "payment/capture.php"; 
   }

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <base href="http://localhost/smart24tv/">

        <title>Smart24tv | Page</title>
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
        <link href="css/app.min.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel='shortcut icon' type='image/x-icon' href='img/logo.png' />

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" crossorigin="anonymous"></script>
    </head>

    <body>    
        <div id="myModal" class="modal fade" role="dialog">
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
                              <select  class="form-control" name="navbar" required>
                                  <option value="top">Weekly (10000 UGX)</option>
                                  <option value="bottom">Monthly(20000 UGX)</option>
                                  <option value="none">Yearly(50000 UGX)</option>
                              </select>
                          </div>
                        </div>
                    
                        <h6 style = "margin-top : 5px;"><b>Billing information</b></h6>
                        <hr>
                        <div class="row">
                          <div class="form-group col-md-6">
                            <label for="expMonth">First Name</label>
                            <input type="text" autocomplete = "off"  id="fname" class="form-control" name = "fname" placeholder = "enter first name.." required>
                          </div>

                          <div class="form-group col-md-6">
                            <label for="cVV">Last Name</label>
                            <input type="text" autocomplete = "off"  id="lname"  class="form-control" name = "lname" placeholder = "enter last name.." required>
                          </div>
                        </div>


                        <div class="row">
                          <div class="form-group col-md-12">
                            <label for="cardNum">Email</label>
                            <input type="email" autocomplete = "off"  id="email"  class="form-control" name = "email" placeholder = "enter email.." required>
                          </div>
                        </div>


                        <div class="row">
                          <div class="form-group col-md-6">
                            <label for="expMonth">Country</label>
                            <input type="text" autocomplete = "off"  id="country" class="form-control" name = "country" placeholder = "enter country.." required>
                          </div>

                          <div class="form-group col-md-6">
                            <label for="cVV">District</label>
                            <input type="text" autocomplete = "off"  id="district"  class="form-control" name = "district" placeholder = "enter district.." required>
                          </div>
                        </div>

                        <div class="row">
                          <div class="form-group col-md-12">
                            <label for="cardNum">Contact</label>
                            <input type="phone" autocomplete = "off"  id="contact"  class="form-control" name = "phone" placeholder = "enter contact.." required>
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
                        <input type="hidden" id="token" name="token">

                        <div class="row">
                          <div class="form-group col-md-12">
                            <button id = 'payButton' type = "submit" style = "width: 100%;" class="btn">Pay now</button>
                          </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        <button type = "button" style = "margin-left : 5px;" class = "btn btn-primary" data-toggle = "modal" data-target = "#myModal" data-backdrop = "true"><span class = "add">&plus;</span>Add Category</button>

        <script src="https://flex.cybersource.com/cybersource/assets/microform/0.11/flex-microform.min.js"></script>

        <script>
    // JWK is set up on the server side route
    //var payButton = document.getElementById('#pay-button');
    var flexResponse = document.getElementById('flexresponse');
    var tken = document.getElementById('token');
    var card = document.getElementById('card');
    var form = document.getElementById('form');
    var payButton = document.getElementById('payButton');

    month = '';
    year = '';

    //expiry date function
    function expiryDate()
    {
      payButton.disabled = true;
      var date = document.getElementById('expDate');
      if (date.value.length == 2 && isNaN(date.value) == false) {
          month = date.value;
          date.value = month + '/';

      } else if (date.value.length == 2) {
        date.value = date.value.charAt(0);

      } else if (date.value.length == 5) {
        year = 20 + date.value.charAt(3) + date.value.charAt(4);
        payButton.disabled = false;
      }
    }



    // the capture context that was requested server-side for this transaction
    var captureContext = '<?php echo $captureContext; ?>';

    // custom styles that will be applied to each field we create using Microform
    var myStyles = { 
    'input': {    
          'font-size': '14px',    
          'font-family': 'helvetica, tahoma, calibri, sans-serif',    
          'color': '#555'  
      },  
    ':focus': { 'color': 'blue' },  
    ':disabled': { 'cursor': 'not-allowed' },  
    'valid': { 'color': '#3c763d' },  
    'invalid': { 'color': '#a94442' } 
    };

    // setup
    var flex = new Flex(captureContext);

    var microform = flex.microform({ styles: myStyles });
    var number = microform.createField('number', { placeholder: '•••• •••• •••• ••••' });
    var securityCode = microform.createField('securityCode', { placeholder: '•••' });

    number.load('#number-container');
    securityCode.load('#securityCode-container');

    number.on('change', function(data) {
      if (data.card[0].name == 'visa') {
        card.src = 'payment/images/visa.png';
      
      } else if (data.card[0].name == 'mastercard') {
        card.src = 'payment/images/mastercard.png';

      } else if (data.card[0].name == 'amex') {
        card.src = 'payment/images/amex.png';

      } else if (data.card[0].name == 'maestro') {
        card.src = 'payment/images/disc.png';

      }
    });



    jQuery(document).ready(function($) {
    $('#payButton').click(function(e){
      if (month != '' && year != '') {
          e.preventDefault();
          payButton.innerHTML = 'processing...';
          payButton.disabled = true;
          Token();
          
      } else {
        e.preventDefault();
        alert('Invalid date');
      }
    });
    });


    //Setting up payer authentication service
    function Setup()
    {
      var ajaxurl = 'payment/setup.php';

      var data = {
          tk: tken.value,
      };

      $.post(ajaxurl, data, function(response) {
          console.log(response);

          if (response != 'error') {
            var res = JSON.parse(response);
            
            document.getElementById('ddc-form').action = res.collection_url;
            document.getElementById('access').value = res.access_token;

            var ddcForm = document.querySelector('#ddc-form');
            if(ddcForm) // ddc form exists
                ddcForm.submit();

          } else {
            alert('An error occurred while authenticating card, please try again');
            payButton.innerHTML = 'Pay now';
            payButton.disabled = false;
            return;
          }
      }); 
    }


    //Enroll to payer authentication service
    function enrollmentCheck()
    {

      var ajaxurl = 'payment/enrollment_check.php';

      var data = {
          tk: tken.value,
          fname: document.getElementById('fname').value,
          lname: document.getElementById('lname').value,
          country: document.getElementById('country').innerHTML,
          email: document.getElementById('email').value,
          phone: document.getElementById('contact').value,
      };

      $.post(ajaxurl, data, function(response) {

          if (response == 'error') { 
            alert('An error occurred while authenticating card, please try again');
            payButton.innerHTML = 'Pay now';
            payButton.disabled = false;
            
          } else {

            var res = JSON.parse(response);

            if (res.stepup_url != null) {
              alert('This card is not yet supported by this payment gateway');
              payButton.innerHTML = 'Pay now';
              payButton.disabled = false;

            } else if (res.stepup_url == null) {
              form.submit();
              payButton.innerHTML = 'Pay now';
              payButton.disabled = false;
            }         
          
          }
      }); 
    }


    //Generating transient token
    function Token()
    {
    var options = {    
        expirationMonth: month,  
        expirationYear: year 
    };

    microform.createToken(options, function (err, token) {
      if (err) {
      // handle error
        alert('An error occurred, please try again');
        payButton.innerHTML = 'Pay now';
        payButton.disabled = false;
      } else {
        parseJwt(token);
        //alert(JSON.stringify(token));
        //console.log(JSON.stringify(token));
        flexResponse.value = JSON.stringify(token);
      }
    });
    }


    //Decoding transient token
    function parseJwt (tk)
    {
      var base64Url = tk.split('.')[1];
      var base64 = base64Url.replace(/-/g, '+').replace(/_/g, '/');
      var jsonPayload = decodeURIComponent(atob(base64).split('').map(function(c) {
          return '%' + ('00' + c.charCodeAt(0).toString(16)).slice(-2);
      }).join(''));

      var transient = JSON.parse(jsonPayload);
      tken.value = transient.jti;
      //console.log(transient);
      //alert(transient.jti);
      Setup();
    }
</script>

<script>
    window.addEventListener("message", (event) => {
        //{MessageType: "profile.completed", Session Id: "0_57f063fd-659a-4779-b45b-9e456fdb7935", Status: true}
        if (event.origin === "https://centinelapistag.cardinalcommerce.com") {
            let data = JSON.parse(event.data);
            //console.log('Merchant received a message:', data);
            enrollmentCheck();
        }    
    }, false);
</script

    </body>
</html>

