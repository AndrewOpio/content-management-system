<?php
include('dbconnection.php');
include 'config.php';

if(!isset($_SESSION['user_log'])) {
  echo "<script>window.location.href = 'index.php';</script>";

}


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
        <title>Smart24TV | User groups</title>

        <!-- Summernote css -->
        <link href="../plugins/summernote/summernote.css" rel="stylesheet" />

        <!-- App css -->
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.2/css/jquery.dataTables.min.css">
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/core.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/components.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/icons.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/pages.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/menu.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/responsive.css" rel="stylesheet" type="text/css" />
        <script src="assets/js/modernizr.min.js"></script>
 <script>

 function addGroup(){
 var user_group = document.getElementById("user_group").value;
 	 data = {
     user_group, user_group, 
     add_group: 'add_group'
    }
    url = 'config.php';
 	$.post(url, data, function(response) {
 		console.log(response)
    if(response == 'exists'){
      alert('The user group already exists');
    }
 		else if(response == 'true'){
 			alert('Group created successfully');
 			location.reload(true);
 			// window.location.href = 'new.php';
 		}else if(response == 'failed'){
 			alert('Failed to create');
 		}else{ 
 			alert('There is an error');
 		}
 	});
 
}

function change(id, all , view_post, edit_post, remove_post, approve, post_add, view_category, add_category, edit_category, delete_category, user_view ,user_add, user_edit, user_delete, page_view, page_add, page_edit, page_delete, dashboard, groups, add_social, edit_social, view_social, delete_social){
  //posts
	var post_view = document.getElementById(view_post).value;
  var all = document.getElementById(all).value;
	var post_edit = document.getElementById(edit_post).value;
	var post_delete = document.getElementById(remove_post).value;
	var accept = document.getElementById(approve).value;
  var post_add = document.getElementById(post_add).value;
	
	//categories
  var view_category = document.getElementById(view_category).value;
  var add_category = document.getElementById(add_category).value;
  var edit_category = document.getElementById(edit_category).value;
  var delete_category = document.getElementById(delete_category).value;

  //users
  var user_view = document.getElementById(user_view).value;
  var user_add = document.getElementById(user_add).value;
  var user_edit = document.getElementById(user_edit).value;
  var user_delete = document.getElementById(user_delete).value;

  //pages
  var page_view = document.getElementById(page_view).value;
  var page_add = document.getElementById(page_add).value;
  var page_edit = document.getElementById(page_edit).value;
  var page_delete = document.getElementById(page_delete).value;
  //dashboard
  var dashboard = document.getElementById(dashboard).value;

  //groups
  var groups = document.getElementById(groups).value;

  //social links
  var add_social = document.getElementById(add_social).value;
  var edit_social = document.getElementById(edit_social).value;
  var view_social = document.getElementById(view_social).value;
  var delete_social = document.getElementById(delete_social).value;

	 data = {
	   id: id,
     all: all,
     post_view: post_view, 
     post_edit: post_edit,
     post_delete: post_delete,
     accept: accept,
     post_add: post_add,
     view_category: view_category,
     add_category: add_category,
     edit_category: edit_category,
     delete_category: delete_category,
     user_view: user_view,
     user_add: user_add,
     user_edit: user_edit,
     user_delete: user_delete,
     page_view: page_view,
     page_add: page_add,
     page_edit: page_edit,
     page_delete: page_delete,
     dashboard: dashboard,
     groups: groups,
     add_social: add_social,
     edit_social: edit_social,
     view_social: view_social,
     delete_social: delete_social,

     change_permission: 'change_permission'
    } 
    url = 'config.php';
 	$.post(url, data, function(response) {
 		console.log(response)
 		if(response == 'true'){
 			alert('Permissions changed');
 			location.reload(true);
 			// window.location.href = 'new.php';
 		}else if(response == 'failed'){
 			alert('Failed to change permissions');
 		}else{
 			alert('There is an error');
 		}
 	});
}

function deleteUser(id){
 
   data = {
     id, id, 
     delete_group: 'delete_group'
    }
    url = 'config.php';
  $.post(url, data, function(response) {
    console.log(response)
    if(response == 'true'){
      alert('Group deleted');
      location.reload(true);
      // window.location.href = 'new.php';
    }else if(response == 'failed'){
      alert('Failed to create');
    }else{ 
      alert('There is an error');
    }
  });
}
 
function edit_group(id, name){

var name = document.getElementById(name).value;

   data = {
     id, id, 
     name, name,
     edit_group: 'edit_group'
    }
    url = 'config.php';
  $.post(url, data, function(response) {
    console.log(response)
    if(response == 'true'){
      alert('Group updated');
      location.reload(true);
      // window.location.href = 'new.php';
    }else if(response == 'failed'){
      alert('Failed to edit');
    }else{ 
      alert('There is an error');
    }
  });

}

 </script>
  <body class="fixed-left">

    <div id="wrapper">
           <?php include('includes/header.php');?>
            <!-- ========== Left Sidebar Start ========== -->
             <?php include('includes/sidebar.php');?>
            <!-- Left Sidebar End -->
<?php if($user_groups == 1) { ?>
              <div class="content-page">
                <!-- Start content -->
                <div class="content">
                    <div class="container">
                    <div class="row">
  <div class="col-xs-12">
    <div class="page-title-box">
        <h4 class="page-title">Manage User Groups</h4>
        <ol class="breadcrumb p-0 m-0">
            <li>
                <a href="#">Users</a>
            </li>
            <li class="active">
                Manage Groups
            </li>
        </ol>
        <div class="clearfix"></div>
    </div>
  </div>
</div>

<button type="button" class="btn btn-primary" style = "margin-bottom: 10px;" data-toggle = "modal" data-target = "#add_new">Add user group</button>

<div id="add_new" class="modal fade" role="dialog" >
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Add User Group</h4>
      </div>
      <div class="modal-body">
         <div class="row">
           <div class="form-group col-md-12">
             <label for="user_group">User group</label>
             <input id="user_group" type="text" class="form-control" name="user_group" autofocus required>
             </div>
          </div>

      </div>
            <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="addGroup()">Save user</button>
      </div>
     </div>
   </div>
 </div>

 <table style = "margin-top: 20px;" id = "table" class="table table-hover table-striped" border = "0">
    <thead>
      <tr class = "header">
        <th class = "text" scope="col">#</th>
        <th class = "text" scope="col">User group</th>
        <th class = "text" scope="col">Actions</th>
      </tr>
    </thead>

  <?php 
    $groups_query = "SELECT * FROM User_groups";
    $val = $mysqli->query($groups_query);
    if($val->num_rows > 0) { ?>
    <tbody>
    <tr>
    <?php  while($row = $val->fetch_assoc()) { ?>
      
 <div id="<?php echo $row['id'].'edit'; ?>" class="modal fade" role="dialog" >
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Edit group</h4>
      </div>
      <div class="modal-body">
         <div class="row">
           <div class="form-group col-md-6">
             <label for="user_group">Group name</label>
             <input id="<?php echo $row['id']."user_group";?>" type="text" class="form-control" name="user_group" autofocus required value="<?php echo $row['user_group'];?>">
             </div>
          </div> 
      </div>
            <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="edit_group(<?php echo $row['id'];?>, '<?php echo $row['id'].'user_group';?>')">Save changes</button>
      </div>
     </div>
   </div>
 </div>

<div class="modal fade" role="dialog"id="<?php echo $row['id']."delete_group"; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Delete Group</h5>
        <button type="button" class="btn-close"  data-dismiss="modal" aria-label="Close"></button> 
      </div>
      <div class="modal-body">
       <p>Do you really want to delete this group ?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-danger" onclick="deleteUser(<?php echo $row['id'];?>)">Delete user</button>
      </div>
    </div> 
  </div>
</div>

<div id="<?php echo $row['id']."more"; ?>" class="modal fade" role="dialog" >
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Privileges</h4>
      </div>
      <div class="modal-body"> 
         <div class="row">
           <div class="form-group col-md-12">
             <label for="user_group">User group</label>
             <input id="user_group" type="text" class="form-control" name="user_group" value="<?php echo $row['user_group']; ?>" autofocus required disabled>
             </div>
          </div>
          <div class="row">
 <div class="form-group col-md-6">
  <div class="form-check form-switch">
  <input class="form-check-input" type="checkbox" id="<?php echo $row['id'].'all_prev';?>" value="<?php echo $row['all_prev'];?>"  <?php echo $row['all_prev'] == 1 ? "checked" : 0?>>
  <label class="form-check-label" for="view">All privileges</label>
</div>
<p>Posts</p>
<div class="form-check form-switch">
  <input class="form-check-input" type="checkbox" id="<?php echo $row['id'].'view_post';?>" value="<?php echo $row['view_post'];?>"  <?php echo $row['view_post'] == 1 ? "checked" : 0?>>
  <label class="form-check-label" for="view">View posts</label>
</div>
<div class="form-check form-switch">
  <input class="form-check-input" type="checkbox" id="<?php echo $row['id'].'edit_post';?>" value="<?php echo $row['edit_post']; ?>" <?php echo $row['edit_post'] == 1 ? "checked" : 0?>>
  <label class="form-check-label" for="view">Edit posts</label>
</div> 
<div class="form-check form-switch">
  <input class="form-check-input" type="checkbox" id="<?php echo $row['id'].'delete_post';?>" value="<?php echo $row['delete_post']; ?>" <?php echo $row['delete_post'] == 1 ? "checked" : 0?>>
  <label class="form-check-label" for="view">Delete posts</label>
</div>
<div class="form-check form-switch">
  <input class="form-check-input" type="checkbox" id="<?php echo $row['id'].'approve';?>" value="<?php echo $row['approve']; ?>" <?php echo $row['approve'] == 1 ? "checked" : 0?>>
  <label class="form-check-label" for="view">Approve</label>
</div>
<div class="form-check form-switch">
  <input class="form-check-input" type="checkbox" id="<?php echo $row['id'].'add_post';?>" value="<?php echo $row['add_post']; ?>" <?php echo $row['add_post'] == 1 ? "checked" : 0?>>
  <label class="form-check-label" for="view">Add posts</label>
</div>
<p>Categories</p>
<div class="form-check form-switch">
  <input class="form-check-input" type="checkbox" id="<?php echo $row['id'].'view_category';?>" value="<?php echo $row['view_category']; ?>" <?php echo $row['view_category'] == 1 ? "checked" : 0?>>
  <label class="form-check-label" for="view">View categories</label>
</div>
<div class="form-check form-switch">
  <input class="form-check-input" type="checkbox" id="<?php echo $row['id'].'edit_category';?>" value="<?php echo $row['edit_category']; ?>" <?php echo $row['edit_category'] == 1 ? "checked" : 0?>>
  <label class="form-check-label" for="view">Edit categories</label>
</div>
<div class="form-check form-switch">
  <input class="form-check-input" type="checkbox" id="<?php echo $row['id'].'delete_category';?>" value="<?php echo $row['delete_category']; ?>" <?php echo $row['delete_category'] == 1 ? "checked" : 0?>>
  <label class="form-check-label" for="view">Delete categories</label>
</div>
<div class="form-check form-switch">
  <input class="form-check-input" type="checkbox" id="<?php echo $row['id'].'add_category';?>" value="<?php echo $row['add_category']; ?>" <?php echo $row['add_category'] == 1 ? "checked" : 0?>>
  <label class="form-check-label" for="view">Add categories</label>
</div>
<p>Pages</p>
<div class="form-check form-switch">
  <input class="form-check-input" type="checkbox" id="<?php echo $row['id'].'add_page';?>" value="<?php echo $row['add_page']; ?>" <?php echo $row['add_page'] == 1 ? "checked" : 0?>>
  <label class="form-check-label" for="view">Add pages</label>
</div>
<div class="form-check form-switch">
  <input class="form-check-input" type="checkbox" id="<?php echo $row['id'].'view_page';?>" value="<?php echo $row['view_page']; ?>" <?php echo $row['view_page'] == 1 ? "checked" : 0?>>
  <label class="form-check-label" for="view">View pages</label>
</div>
<div class="form-check form-switch">
  <input class="form-check-input" type="checkbox" id="<?php echo $row['id'].'edit_page';?>" value="<?php echo $row['edit_page']; ?>" <?php echo $row['edit_page'] == 1 ? "checked" : 0?>>
  <label class="form-check-label" for="view">Edit pages</label>
</div>
<div class="form-check form-switch">
  <input class="form-check-input" type="checkbox" id="<?php echo $row['id'].'delete_page';?>" value="<?php echo $row['delete_page']; ?>" <?php echo $row['delete_page'] == 1 ? "checked" : 0?>>
  <label class="form-check-label" for="view">Delete pages</label>
</div>
<p>Users</p>
<div class="form-check form-switch">
  <input class="form-check-input" type="checkbox" id="<?php echo $row['id'].'add_user';?>" value="<?php echo $row['add_user']; ?>" <?php echo $row['add_user'] == 1 ? "checked" : 0?>>
  <label class="form-check-label" for="view">Add users</label>
</div>
<div class="form-check form-switch">
  <input class="form-check-input" type="checkbox" id="<?php echo $row['id'].'view_user';?>" value="<?php echo $row['view_user']; ?>" <?php echo $row['view_user'] == 1 ? "checked" : 0?>>
  <label class="form-check-label" for="view">View user</label>
</div>
<div class="form-check form-switch">
  <input class="form-check-input" type="checkbox" id="<?php echo $row['id'].'edit_user';?>" value="<?php echo $row['edit_user']; ?>" <?php echo $row['edit_user'] == 1 ? "checked" : 0?>>
  <label class="form-check-label" for="view">Edit user</label>
</div>
<div class="form-check form-switch">
  <input class="form-check-input" type="checkbox" id="<?php echo $row['id'].'delete_user';?>" value="<?php echo $row['delete_user']; ?>" <?php echo $row['delete_user'] == 1 ? "checked" : 0?>>
  <label class="form-check-label" for="view">Delete user</label>
</div>

<p>Dashboard</p>
<div class="form-check form-switch">
  <input class="form-check-input" type="checkbox" id="<?php echo $row['id'].'view_dashboard';?>" value="<?php echo $row['view_dashboard']; ?>" <?php echo $row['view_dashboard'] == 1 ? "checked" : 0?>>
  <label class="form-check-label" for="view">View dashboard</label>
</div>
<p>User groups</p>
<div class="form-check form-switch">
  <input class="form-check-input" type="checkbox" id="<?php echo $row['id'].'groups';?>" value="<?php echo $row['groups']; ?>" <?php echo $row['groups'] == 1 ? "checked" : 0?>>
  <label class="form-check-label" for="view">Access user groups</label>
</div>
<p>Social links</p>
<div class="form-check form-switch">
  <input class="form-check-input" type="checkbox" id="<?php echo $row['id'].'add_social';?>" value="<?php echo $row['add_social']; ?>" <?php echo $row['add_social'] == 1 ? "checked" : 0?>>
  <label class="form-check-label" for="view">Add social link</label>
</div>
<div class="form-check form-switch">
  <input class="form-check-input" type="checkbox" id="<?php echo $row['id'].'edit_social';?>" value="<?php echo $row['edit_social']; ?>" <?php echo $row['edit_social'] == 1 ? "checked" : 0?>>
  <label class="form-check-label" for="view">Edit social link</label>
</div>
<div class="form-check form-switch">
  <input class="form-check-input" type="checkbox" id="<?php echo $row['id'].'view_social';?>" value="<?php echo $row['view_social']; ?>" <?php echo $row['view_social'] == 1 ? "checked" : 0?>>
  <label class="form-check-label" for="view">View social link</label>
</div>
<div class="form-check form-switch">
  <input class="form-check-input" type="checkbox" id="<?php echo $row['id'].'delete_social';?>" value="<?php echo $row['delete_social']; ?>" <?php echo $row['delete_social'] == 1 ? "checked" : 0?>>
  <label class="form-check-label" for="view">Delete social link</label>
</div>
</div>

<script>

$(":checkbox").change(function(){
     $(this).val($(this).is(":checked") ? 1 : 0);
});
</script>
 
      </div>
            <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="change(<?php echo $row['id'];?>,'<?php echo $row['id'].'all_prev';?>','<?php echo $row['id'].'view_post';?>','<?php echo $row['id'].'edit_post';?>','<?php echo $row['id'].'delete_post';?>', '<?php echo $row['id'].'approve';?>', '<?php echo $row['id'].'add_post';?>', '<?php echo $row['id'].'view_category';?>','<?php echo $row['id'].'add_category';?>','<?php echo $row['id'].'edit_category';?>','<?php echo $row['id'].'delete_category';?>','<?php echo $row['id'].'view_user';?>','<?php echo $row['id'].'add_user';?>','<?php echo $row['id'].'edit_user';?>','<?php echo $row['id'].'delete_user';?>', '<?php echo $row['id'].'view_page';?>', '<?php echo $row['id'].'add_page';?>', '<?php echo $row['id'].'edit_page';?>', '<?php echo $row['id'].'delete_page';?>', '<?php echo $row['id'].'view_dashboard';?>','<?php echo $row['id'].'groups';?>','<?php echo $row['id'].'add_social';?>','<?php echo $row['id'].'edit_social';?>','<?php echo $row['id'].'edit_social';?>','<?php echo $row['id'].'delete_social';?>')">Save</button>
      </div>
     </div>
   </div>
 </div>
 


      <th scope="row">1</th>
      <td><?php echo $row["user_group"];?></td>

<!--       <?php if($row["view_post"] == 0 &&  $row["edit_post"] == 0 && $row["delete_post"] == 0) { ?>
      <td><span class="badge rounded-pill bg-danger">No privileges</span></td>
  	  <?php } else { ?>
  	  <td>
  	  <?php if($row["view_post"] == 1) { ?>
  	  <span class="badge rounded-pill bg-success">View</span>
  	  <?php }if($row["edit_post"] == 1) { ?>
  		<span class="badge rounded-pill bg-success">Edit</span>
  	  <?php } if($row["delete_post"] == 1) { ?>
  	  	<span class="badge rounded-pill bg-success">Delete</span>
  	  <?php } if($row["add_post"] == 1) { ?>
        <span class="badge rounded-pill bg-success">Add pages</span>

      <?php } } ?>
  	</td> -->
      <td><button type="button" class="btn btn-secondary" data-toggle = "modal" data-target = "#<?php echo $row['id']."more"; ?>" >Privileges</button>
      	<button type="button" class="btn btn-primary" data-toggle = "modal" data-target = "#<?php echo $row['id']."edit"; ?>">Edit</button>

		<button type="button" class="btn btn-danger" data-toggle = "modal" data-target = "#<?php echo $row['id']."delete_group";?>">Delete</button>
      </td>
    </tr>
	<?php } ?>
<?php } ?>
</tbody>
</table>
</div>
</div>
</div>
<?php } ?>
</div>

        <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/1.10.2/js/jquery.dataTables.min.js"></script>

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

        <!--Summernote js-->
        <script src="../plugins/summernote/summernote.min.js"></script>

        <!-- App js -->
        <script src="assets/js/jquery.core.js"></script>
        <script src="assets/js/jquery.app.js"></script>

        <!--Summernote js-->
        <script src="../plugins/summernote/summernote.min.js"></script>
</body>