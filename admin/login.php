<!DOCTYPE html>
<html lang="en">
    <head>
        <base href="http://localhost/smart24tv/">

        <title>Aust | Login</title>
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
        <link rel='shortcut icon' type='image/x-icon' href='../img/upava.png' />

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

        <script type ="text/javascript">
          function login(e)
          {
            e.preventDefault(); 
            document.getElementById("btn-login").innerHTML = "Signing in...";
            var  name = document.getElementById("username").value;
            var password = document.getElementById("password").value;

            data = { 
              name: name,
              password: password,
              login_user: 'login_user'
            }

            url = 'admin/config.php';
            $.post(url, data, function(response) {
              document.getElementById("btn-login").innerHTML = "Sign in";

              if (response == 'true') {
                window.location.href = "admin/dashboard.php"; //editted

              } else if (response == 'fail') {
                alert('Wrong credentials');

              } else {
                alert('An error has occured'+response);
              }
            });
          }
        </script>
    </head>
    <body  style = "background-color: #e2e2e2;">
      <div class="container" style = "margin-top: 40px;">
          <div class="row">
            <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
              <div class="card card-signin my-5">
                <div class="card-body">
                  <h5 class="card-title text-center">Sign In</h5>
                    <form method = "post" onsubmit = "login(event)">
                      <div class="form-label-group">
                        <label for="username">Username:</label>
                        <input type="text" name="username" id="username" class="form-control" style = "margin-top: 10px;" placeholder="Username" required autofocus="">
                      </div>

                      <div class="form-label-group"  style = "margin-top: 20px;">
                        <label for="password">Password:</label>
                        <input type="password" name="password" id="password" class="form-control" style = "margin-top: 10px;" placeholder="Password" required>
                      </div>
                    
                      <br>
                      <button id = "btn-login" class="btn btn-md btn-primary"  style = "width: 100%;">Sign in</button>
                    </form>
                  </div>
              </div>
            </div>
          </div>
      </div>
    </body>
</html>
