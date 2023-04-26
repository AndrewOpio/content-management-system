<?php
include('dbconnection.php');
include 'config.php';

if(!$_SESSION['user_log']){
	header("Location: login.php");
}

include ("permissions.php");

?>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>


        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">

        <link rel='shortcut icon' type='image/x-icon' href='../img/upava.png' />

        <!-- App title -->
        <title>UPAVA | Users</title>

        <!-- Summernote css -->
        <link href="../plugins/summernote/summernote.css" rel="stylesheet" />

        <!-- App css -->
        <link rel="stylesheet" href="http://cdn.datatables.net/1.10.2/css/jquery.dataTables.min.css">
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/core.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/components.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/icons.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/pages.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/menu.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/responsive.css" rel="stylesheet" type="text/css" />
        <script src="assets/js/modernizr.min.js"></script>

<style>
	a:hover {
 cursor:pointer;
}
.avatar {
  vertical-align: middle;
  width: 100px;
  height: 100px;
  border-radius: 50%;
}
</style>
<script type ="text/javascript">
function addUser(){
	  var fname = document.getElementById("fname").value;
      var lname = document.getElementById("lname").value;
      var email = document.getElementById("email").value;
      var user_type = document.getElementById("user_type").value;
      var profile = document.getElementById("profile").value;
      var user_name = document.getElementById("user_name").value;
      var password = document.getElementById("password").value;
      var file = document.getElementById("fileToUpload").value;
      var image = $('#fileToUpload').prop('files')[0];
 
    var form_data = new FormData();
    form_data.append("fname", fname);
    form_data.append("lname", lname);
    form_data.append("email", email);
    form_data.append("user_type", user_type);
    form_data.append("profile", profile);
    form_data.append("user_name", user_name);
    form_data.append("password", password);
    form_data.append("image", image);
    form_data.append("add_user", 'add_user');

      if(fname == '' || lname == '' || email == '' || user_type == '' || profile == '' || user_name == '' || password == '' || file == ''){
      	alert('Please enter all the fields')
      }else{
      data = form_data

      $.ajax({
        url:'config.php',
        type:"POST",
        processData: false,
        contentType: false,
        data: form_data,
        success : function( response ){
        console.log(response);
        if(response == 'upload_pass'){
        	alert('Image uploaded successfully');
        }else if(response == 'upload_fail'){
 			alert('Upload fail');
 		}else if(response == 'wrong_type'){
      alert('Please provide a valid image');
    }else if(response == 'true'){
 			alert('Record successfully added');
 			location.reload(true);
 		}else if(response == 'false'){
 			alert('Failed');
 		}else if(response == 'exists'){
 			alert('The user already exists');
 		}else{
 			alert('An error has occured');
 		}    
            },
      });
 


}	
}

function editUser(id, fname, lname, email, user_type, profile, username, password, image){
  	  var fname = document.getElementById(fname).value;
      var lname = document.getElementById(lname).value;
      var email = document.getElementById(email).value;
      var user_type = document.getElementById(user_type).value;
      var profile = document.getElementById(profile).value;
      var picture = document.getElementById(image).value;
      var user_name = document.getElementById(username).value;
      var password = document.getElementById(password).value;
      var file = $(`#${image}`).prop('files')[0];
      
      var form_data = new FormData();
      form_data.append("id", id);
      form_data.append("fname", fname);
      form_data.append("lname", lname);
      form_data.append("email", email);
      form_data.append("user_type", user_type);
      form_data.append("profile", profile);
      form_data.append("user_name", user_name);
      form_data.append("password", password);
      form_data.append("picture", picture);
      form_data.append("image", file);
      form_data.append("edit_user", "edit_user");

      if(fname == '' || lname == '' || email == '' || user_type == '' || profile == '' || user_name == '' || password == ''){
      	alert('Some fileds are empty')
      }else{

      console.log(id);
      console.log(fname); 
      console.log(lname);
     url = 'config.php';
     $.ajax({ 
        url:'config.php',
        type:"POST",
        processData: false,
        contentType: false,
        data: form_data,
        success : function( response ){
            console.log(response);
        if(response == 'upload_pass'){
            alert('Image uploaded successfully');
        }else if(response == 'upload_fail'){
            alert('Upload fail');
        }else if(response == 'wrong_type'){
      alert('Please provide a valid image');
    }else if(response == 'true'){
            alert('User updated ');
            location.reload(true);
        }else if(response == 'false'){
            alert('Failed');
        }else{
            alert('An error has occured');
        }    
            },
      });

}	
}

function deleteUser(id){

      data = {
      	id: id,
      	delete_user: 'delete_user'
      }

      console.log(id);
      console.log(lname);
     url = 'config.php';
 	$.post(url, data, function(response) {
 		if(response == 'true'){
 			alert('Record deleted successfully');
 			location.reload(true);
 		}else{
 			alert('An error has occured');
 		}
 	});

	
}

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
  <body class="fixed-left">
      <!-- Begin page -->
      <div id="wrapper">


         <?php include('includes/header.php');?>
            <!-- ========== Left Sidebar Start ========== -->
             <?php include('includes/sidebar.php');?>
            <!-- Left Sidebar End -->

            <div class="content-page">
                <!-- Start content -->
                <div class="content">
                    <div class="container">
                    <div class="row">
  <div class="col-xs-12">
    <div class="page-title-box">
        <h4 class="page-title">Manage Users</h4>
        <ol class="breadcrumb p-0 m-0">
            <li>
                <a href="#">Users </a>
            </li>
            <li class="active">
                Manage Users
            </li>
        </ol>
        <div class="clearfix"></div>
    </div>
  </div>
</div>


<br>
<div id="add_new" class="modal fade" role="dialog" >
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Add New User</h4>
      </div>
      <div class="modal-body">
         <div class="row">
           <div class="form-group col-md-6">
             <label for="fname">First name</label>
             <input id="fname" type="text" class="form-control" name="fname" autofocus required>
             </div>
            <div class="form-group col-6">
              <label for="lname">Last name</label>
              <input id="lname" type="text" class="form-control" name="lname" required>
            </div>
          </div>
            <div class="row">
           <div class="form-group col-md-6">
             <label for="name">Email</label>
             <input id="email" type="email" class="form-control" name="email" autofocus required>
             </div>
            <div class="form-group col-6">
              <label for="user_name">User name</label>
              <input id="user_name" type="text" class="form-control" name="user_name" required>
            </div>
          </div>
         <div class="row">
          <div class="form-group col-md-6">
            <label for="profile">Profile</label>
            <textarea name="profile" id="profile" cols="25" rows="5" autofocus required></textarea>
          </div>
              <div class="form-group col-md-6">
                <label for="user_type">User type</label>
                <select id = "user_type" class="form-control custom-select" name="user_type" required>
                <?php 
                $db2 = "SELECT * FROM User_groups";
                $val = $mysqli->query($db2);
                if($val){
                echo "";
                }else{
                echo($val->error);
                }
                if($val->num_rows > 0) { 
                while($here = $val->fetch_assoc()) {
                   ?>
                    <option value="<?php echo $here['id'] ?>"><?php echo $here['user_group'] ?></option>
                 <?php } 
               }?>   
                </select>
              </div>
       </div>
                <div class="row">
           <div class="form-group col-md-6">
             <label for="password">Password</label>
             <input id="password" type="email" class="form-control" name="password" autofocus required>
             </div>
              <div class="form-group col-md-6">
             <div class="form-group col-6">
                <label for="fileToUpload">Upload image</label>
                <input type="file"  name="uploadfile" value="" id="fileToUpload"/>
             </div>
              </div>
       </div>
      </div>
            <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="addUser()">Save user</button>
      </div>
     </div>
   </div>
 </div>

<?php if($add_user == 1) { ?>
<button type="button" class="btn btn-primary" style = "margin-bottom: 10px;" data-toggle = "modal" data-target = "#add_new">Add new user</button>
<?php } ?>

<table style = "margin-top: 20px;" class="table table-hover  table-striped" id = "table" border = "0">
    <thead>
      <tr class = "header">
        <th class = "text" scope="col">#</th>
        <th class = "text" scope="col">First</th>
        <th class = "text" scope="col">Last</th>
        <th class = "text" scope="col">Email</th>
        <th class = "text" scope="col">Actions</th>
      </tr>
    </thead>
    
  <?php 
    $users_query = "SELECT * FROM Users";
    $result = $mysqli->query($users_query);  
    if($result->num_rows > 0) { ?>

    <tbody>
    <tr>
    <?php  while($row = $result->fetch_assoc()) { ?>
 <div id="<?php echo $row['id']."edit"; ?>" class="modal fade" role="dialog" >
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Edit user</h4>
      </div>
      <div class="modal-body">
         <div class="row">
           <div class="form-group col-md-6">
             <label for="fname">First name</label>
             <input id="<?php echo $row['id']."fname";?>" type="text" class="form-control" name="fname" autofocus required value="<?php echo $row['fname'];?>">
             </div>
            <div class="form-group col-6">
              <label for="lname">Last name</label>
              <input id="<?php echo $row['id']."lname";?>" type="text" class="form-control" name="lname" required value="<?php echo $row['lname'];?>">
            </div> 
          </div> 
            <div class="row">
           <div class="form-group col-md-6">
             <label for="name">Email</label>
             <input id="<?php echo $row['id']."email";?>" type="email" class="form-control" name="email" autofocus required value="<?php echo $row['email'];?>">
             </div>
            <div class="form-group col-6">
              <label for="user_name">User name</label>
              <input id="<?php echo $row['id']."username";?>" type="text" class="form-control" name="user_name" required value="<?php echo $row['username'];?>">
            </div>
          </div>
         <div class="row">
          <div class="form-group col-md-6">
            <label for="profile">Profile</label>
            <textarea name="profile" id="<?php echo $row['id']."profile";?>" cols="25" rows="5" autofocus required ><?php echo $row['profile'];?></textarea>
          </div>
              <div class="form-group col-md-6">
                <label for="user_type">User type</label>
                <select id="<?php echo $row['id']."usertype";?>" class="form-control custom-select" name="user_type" required> 
                <?php 

                  $db2 = "SELECT * FROM User_groups";
                  $val = $mysqli->query($db2);
                  if($val){
                    echo "";
                  }else{
                    echo($val->error);
                  }

                if($val->num_rows > 0) { 
                  while($here = $val->fetch_assoc()) {
                  $selected = ($options == $selection) ? "selected" : ""; 
                   ?>
                    <option value="<?php echo $here['id'] ?>" <?php if($here['id']==$row['type_id']) echo 'selected="selected"'; ?>><?php echo $here['user_group'] ?></option>
                 <?php } 
               }?>  
                </select>

              </div>
       </div>
                <div class="row">
           <div class="form-group col-md-6">
             <label for="password">Password</label>
             <input id="<?php echo $row['id']."password";?>" type="email" class="form-control" name="password" autofocus required value="<?php echo $row['password'];?>">
             </div>

       </div>
       <div class="row">
                       <div class="form-group col-md-6">
      <div class="form-group col-16">
            <label for="fileToUpload">Change image</label>
            <input type="file"  name="uploadfile" value="" id="<?php echo $row['id'].'image';?>" class="form-control" />
        </div> 
              </div>
       </div>
      </div>
            <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="editUser(<?php echo $row['id'] ;?>, '<?php echo $row['id']."fname";?>', '<?php echo $row['id']."lname";?>', '<?php echo $row['id']."email";?>', '<?php echo $row['id']."usertype";?>', '<?php echo $row['id']."profile";?>', '<?php echo $row['id']."username";?>', '<?php echo $row['id']."password";?>','<?php echo $row['id'].'image';?>')">Save changes</button> 
      </div>
     </div>
   </div>
 </div>
    <div id="<?php echo $row['id']."more"; ?>" class="modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                   <h4 class="modal-title" >More details</h4>
                  </div>
     <div class="modal-body">
           <div class="row"> 
             <div class="form-group col-md-6">
                <label for="name">Picture</label><br>
                <img src="<?php echo 'profile_pictures/'.$row['picture'];?>" alt="Avatar" class="avatar">
                   <p><?php echo $row['fname'];?></p>
                </div>
          </div>
         <div class="row">
             <div class="form-group col-md-6">
                <label for="name">First name</label>
                   <p><?php echo $row['fname'];?></p>
                       </div>
                     <div class="form-group col-6">
                     <label for="lname">Last name</label>
                   <p><?php echo $row['lname'];?></p>
                     </div>
          </div>
           <div class="row">
             <div class="form-group col-md-6">
                <label for="name">Email</label>
                   <p><?php echo $row['email'];?></p>
                       </div>
                     <div class="form-group col-6">
                     <label for="lname">User name</label>
                   <p><?php echo $row['username'];?></p>
                     </div>
          </div>
           <div class="row">
             <div class="form-group col-md-6">
                <label for="name">Profile</label>
                   <p><?php echo $row['profile'];?></p>
                       </div>
                     <div class="form-group col-6">
                     <label for="lname">User type</label>
    
        <?php 
                $db2 = "SELECT * FROM User_groups";
                $val = $mysqli->query($db2);
                if($val){
                echo "";
                }else{
                echo($val->error);
                }
                if($val->num_rows > 0) { 
                while($here = $val->fetch_assoc()) {
                    if($here['id'] == $row['type_id']){
                   ?>
                <p><?php echo $here['user_group'];?></p>
                 <?php } } 
               }?>   
             </div>
          </div>
        </div>
                    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
              </div>
          </div>
      </div>


<div class="modal fade" id="<?php echo $row['id']."delete"; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content"> 
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Delete User</h5>
        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
       <p>Do you really want to delete this user ?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-danger" onclick="deleteUser(<?php echo $row['id'];?>)">Delete user</button>
      </div>
    </div>
  </div>
</div>
 

      <th scope="row">1</th>
      <td><?php echo $row["fname"];?></td>
      <td><?php echo $row["lname"];?></td>
      <td><?php echo $row["email"];?></td>
      <td><button type="button" class="btn btn-secondary" data-toggle = "modal" data-target = "#<?php echo $row['id']."more"; ?>" >More</button>
    <?php if(($edit_user) == 1) { ?>
      	<button type="button" class="btn btn-primary" data-toggle = "modal" data-target = "#<?php echo $row['id']."edit"; ?>">Edit</button>
    <?php } ?>
    <?php if(($delete_user) == 1) { ?>
		<button type="button" class="btn btn-danger" data-toggle = "modal" data-target = "#<?php echo $row['id']."delete"; ?>">Delete</button>
    <?php } ?>

      </td>
    </tr>
	<?php } ?>
  </tbody>
<?php } ?>
</table>
</div>
</div>
</div>
</div>

        <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
        <script type="text/javascript" src="http://cdn.datatables.net/1.10.2/js/jquery.dataTables.min.js"></script>

        <script>
            var resizefunc = [];
        </script>

        <script>
            $(document).ready(function(){
                $('#table').dataTable();
            });
        </script>

        <!-- jQuery  -->
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/detect.js"></script>
        <script src="assets/js/fastclick.js"></script>
        <script src="assets/js/jquery.blockUI.js"></script>
        <script src="assets/js/waves.js"></script>
        <script src="assets/js/jquery.slimscroll.js"></script>
        <script src="assets/js/jquery.scrollTo.min.js"></script>


        <!-- App js -->
        <script src="assets/js/jquery.core.js"></script>
        <script src="assets/js/jquery.app.js"></script>

    </body>