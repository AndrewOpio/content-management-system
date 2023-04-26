<script>
    function logout(){
    console.log('logout');
      data = {
        logout: 'logout'
      }
     url = 'config.php';
    $.post(url, data, function(response) {
        if(response == 'true'){
            alert('Logged out');
            window.location.href = 'login.php';
        }else{
            alert('An error has occured');
        }
    }); 
}
</script>
<style>

.navbr{position:relative;min-height:70px;margin-bottom:20px;border:1px;}
</style>
            <div class="topbar">

                <!-- LOGO -->
                <div class="topbar-left">
                    <a href="dashboard.php" class="logo"><span> UPAVA ADMIN</span><i class="mdi mdi-layers"></i></a>
                  
                </div>

                <!-- Button mobile view to collapse sidebar menu -->
                <div class="navbar navbar-default" role="navigation">
                    <div class="container">

                        <!-- Navbar-left -->
                        <ul class="nav navbar-nav navbar-left">
                            <li>
                                <button class="button-menu-mobile open-left waves-effect">
                                    <i class="mdi mdi-menu"></i>
                                </button>
                            </li>
                        </ul>

                        <!-- Right(Notification) -->
                        <ul class="nav navbar-nav navbar-right">
                          

                            <li class="dropdown user-box">
                                <a href="" class="dropdown-toggle waves-effect user-link" data-toggle="dropdown" aria-expanded="true">
                                    <img src="assets/images/user.jpg" alt="user-img" class="img-circle user-img">
                                </a>

                                <ul class="dropdown-menu dropdown-menu-right arrow-dropdown-menu arrow-menu-right user-list notify-list">
                                    
                              
                                    <li><a href="change_password.php"><i class="ti-settings m-r-5"></i> Change Password</a></li>
                           
                                    <li><a onclick="logout()"><i class="ti-power-off m-r-5"></i> Logout</a></li>
                                </ul>
                            </li>

                        </ul> <!-- end navbar-right -->

                    </div><!-- end container -->
                </div><!-- end navbar -->
            </div>