<?php
include "dbconnection.php";
include 'config.php';

include 'permissions.php';

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">
        <link rel='shortcut icon' type='image/x-icon' href='../img/upava.png' />


        <!-- App title -->
        <title>UPAVA | Manage Articles</title>

        <!-- Summernote css -->
        <link href="plugins/summernote/summernote.css" rel="stylesheet" />
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>

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
        <style>
          .avatar {
            vertical-align: middle;
            width: 400px;
            height: 300px;
          }
          @media (min-width: 992px) {
            .modal-lg {
              width: 900px;
            }
          }


          .cke-contents {
              margin-top: 500px;
              margin-bottom: 50px;
          }
        </style>
        <script src="editor/ckeditor.js"></script>
        <script> 
            function show()
            {
                var data = CKEDITOR.instances.editor1.getData();
                var info = document.getElementById('editor1');
                console.log(data)
                
            }

            function add()
            {
              var title = document.getElementById("title").value;
              var description = document.getElementById("description").value;
              var user = document.getElementById("user_num").value;
              var category = document.getElementById("category").value;
              //var premium = document.getElementById("premium").value;
              var file = document.getElementById("fileToUpload").value;
          
              var image = $('#fileToUpload').prop('files')[0];
            
              var body = CKEDITOR.instances.editor.getData();
              var info = document.getElementById('editor');

          
              var form_data = new FormData();
              form_data.append("title", title);
              form_data.append("description", description);
              form_data.append("user", user);
              form_data.append("category", category);
              form_data.append("image", image);
              //form_data.append("premium", premium);
              form_data.append("body", body);
              form_data.append("add_post", 'add_post');


              if (title == '' || description == '' || category == '' || body == '' || file == '' || image == '') {
                alert('Please enter all the fields')

              } else {
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
                      alert('The post already exists');
                  }else{
                      alert('An error occured');
                  }    
                },
              });

            }   
        }

        function editPost(id, title, description, category, image, editor, premium){

            var title = document.getElementById(title).value;
            var description = document.getElementById(description).value;
            var picture = document.getElementById(image).value;
            var check = document.getElementById(image)
            var body = document.getElementById(editor).value;
            var category = document.getElementById(category).value;
            //var premium = document.getElementById(premium).value;
            // var body3 = 'CKEDITOR.instances.'+editor+'.getData()';
            


            var body = CKEDITOR.instances[editor].getData();
            // var category = document.getElementById(category).value;
            var file = $(`#${image}`).prop('files')[0];
            
            var form_data = new FormData();
            form_data.append("id", id);
            form_data.append("title", title); 
            form_data.append("description", description);
            form_data.append("picture", picture);
            form_data.append("image", file);
            form_data.append("body", body);
            form_data.append("category", category);
            //form_data.append("premium", premium);
            form_data.append("edit_post", 'edit_post');

            data = form_data
        
            $.ajax({ 
                url:'config.php',
                type:"POST",
                processData: false,
                contentType: false,
                data: form_data,
                success : function( response ){
                  
                  if(response == 'upload_pass'){
                      alert('Image uploaded successfully');

                  }else if(response == 'upload_fail'){
                      alert('Upload fail');

                  }else if(response == 'wrong_type'){
                    alert('Please provide a valid image');

                  }else if(response == 'true'){
                      alert('Post updated ');
                      location.reload(true);

                  }else if(response == 'false'){
                      alert('Failed');

                  }else{
                      alert(response);
                  }    
                },
              });
        }

        function deletePost(id){
            console.log(id);
              data = {
                id: id,
                delete_post: 'delete_post'
              }


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

        function approve(id, status){
            data = {
                id: id,
                status, status,
                approve: 'approve'
            }

            url = 'config.php';
            $.post(url, data, function(response) {
                console.log(response)
                if(response == 'true'){
                    alert('Status changed');
                    location.reload(true);
                }else{ 
                    alert('An error has occured');
                }
            });
        }
        </script>
    </head>
    <body class="fixed-left">
       <div id="wrapper">

          <?php include('includes/header.php');?>
          <?php include('includes/sidebar.php');?>

          <div class="content-page">
              <div class="content" >
                  <div class="container">
                      <div class="row">
                        <div class="col-xs-12">
                          <div class="page-title-box">
                              <h4 class="page-title">Manage Articles</h4>
                              <ol class="breadcrumb p-0 m-0">
                                  <li>
                                      <a href="#">Articles </a>
                                  </li>
                                  <li class="active">
                                      Manage Articles
                                  </li>
                              </ol>
                              <div class="clearfix"></div>
                          </div>
                        </div>
                      </div>
                      <div class="card">
                        <div>
                            <?php if($add_post == 1) { ?>
                              <div class="card-header">
                                  <button type="button" class="btn btn-primary" data-toggle = "modal" data-target = "#add_new" style = "margin-bottom: 30px;">Add new post</button>
                              </div>
                            <?php } ?>

                            <div id="add_new" class="modal fade" role="document">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Add New Post</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                <label for="title">Title(Required)</label>
                                                <input id="title" type="text" class="form-control" name="title" autofocus required>
                                              </div>
                                            </div>

                                          <div class="row">
                                              <div class="form-group col-md-6">
                                                <label for="description">Description(Required)</label>
                                                <textarea name="description" id="description" class="form-control" cols="25" rows="5" autofocus required></textarea>
                                              </div>
                                          </div>

                                          <div class="row">
                                              <div class="form-group col-md-6">
                                                <label for="user_type">Author</label>
                                    
                                                <?php 
                                                  $db = "SELECT * FROM Users WHERE email = '$email'";
                                                  $res = $mysqli->query($db);
                                                  while($row = $res->fetch_assoc()){ ?>
                                                <!--  <p id="user" value="<?php echo $row['fname'];?>"><?php echo $row['fname'];?></p> -->
                                                  <input id="user_name" name="user_name" value="<?php echo $row['fname'];?>"  type="text" class="form-control" autofocus required disabled>
                                                  <input id="user_num" name="user_num" type="hidden" value="<?php echo $row['id'];?>"  type="text" class="form-control" autofocus required disabled>
                                                <?php } ?>
                                              </div>              
                                          </div> 

                                          <div class="row">
                                              <div class="form-group col-md-6">
                                                  <label for="category">Category</label>
                                                  <select id = "category" class="form-control custom-select" name="category" required class="form-control">
                                                      <?php 
                                                        $db2 = "SELECT * FROM Categories WHERE type = 'category'";
                                                        $val = $mysqli->query($db2);
                                                        if($val){
                                                        echo "";
                                                        }else{
                                                        echo($val->error);
                                                        }
                                                        if($val->num_rows > 0) { 
                                                        while($here = $val->fetch_assoc()) {
                                                      ?>
                                                            <option value="<?php echo $here['id'] ?>"><?php echo $here['title'] ?></option>
                                                      <?php } }?>
                                                  </select>
                                              </div>              
                                          </div>   

                                          <!--<div class="row">  
                                            <div class="form-group col-6">
                                                <div class="form-check form-switch">
                                                  <input class="form-check-input" type="checkbox" id="premium">
                                                  <label class="form-check-label" for="view">Premium</label>
                                                </div>
                                            </div>
                                          </div>-->

                                          <div class="row">
                                            <div class="form-group col-6">
                                                <label for="fileToUpload">Post image</label>
                                                <input type="file"  name="uploadfile" value="" id="fileToUpload" class="form-control" />
                                            </div>         
                                          </div>   

                                          <div class="row">  
                                                <form>
                                                  <p>New editor</p>
                                                  <textarea name="editor" id="editor">&lt;p&gt;Your content goes here.&lt;/p&gt;</textarea>
                                                </form>
                                          </div>     
                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                      <button type="button" class="btn btn-primary" onclick="add()">Save post</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <script>
                          CKEDITOR.replace( 'editor', {
                              height: 300,
                              extraPlugins: 'image2',
                              filebrowserUploadMethod: 'form',
                              filebrowserUploadUrl: 'upload.php'

                          });
                        </script> 
                        <div class="card-body table-responsive">
                            <table class="table table-hover" id = "table">
                              <thead>
                                <tr>
                                  <th scope="col">Id</th>
                                  <th scope="col">Title</th> 
                                  <th scope="col">Date</th>
                                  <th scope="col">Author</th>
                                  <th scope="col">Status</th>
                                  <th scope="col">Actions</th>
                                </tr>
                              </thead>
                              <?php 
                              $articles_query = "SELECT * FROM Articles";
                              $values = $mysqli->query($articles_query);
                              if($values->num_rows > 0) { ?>
                              <tbody>
                                <tr>
                                  <?php 
                                  $i = 1;
                                  while($row = $values->fetch_assoc()) { ?>

                                  <div class="modal fade" id="<?php echo $row['id']."delete"; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <h5 class="modal-title" id="exampleModalLabel">Delete Post</h5>
                                          <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                        <p>Do you really want to delete this post ?</p>
                                        </div>
                                        <div class="modal-footer">
                                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                          <button type="button" class="btn btn-danger" onclick="deletePost(<?php echo $row['id'];?>)">Delete post</button>
                                        </div>
                                      </div>
                                    </div>
                                  </div>

                                  <div id="<?php echo $row['id'].'edit'; ?>" class="modal fade" role="document" >
                                      <div class="modal-dialog modal-lg">
                                          <div class="modal-content">
                                              <div class="modal-header">
                                                <h4 class="modal-title">Edit Post</h4>
                                              </div>
                                              <div class="modal-body">
                                                  <div class="row">
                                                    <div class="form-group col-md-6">
                                                        <label for="name">Picture</label>
                                                        <img src="<?php echo 'posts/'.$row['image'];?>" alt="Avatar" class="avatar">
                                                    </div>
                                                  </div>
                                                  <div class="row">
                                                      <div class="form-group col-md-6">
                                                        <label for="title">Title(Required)</label>
                                                        <input id="<?php echo $row['id'].'title';?>" value="<?php echo $row['title'];?>" type="text" class="form-control" name="title" autofocus required >
                                                      </div>
                                                  </div>

                                                  <div class="row">
                                                      <div class="form-group col-md-6">
                                                          <label for="description">Description(Required)</label>
                                                          <textarea name="description" id="<?php echo $row['id'].'description';?>" class="form-control" cols="25" rows="5" autofocus required><?php echo $row['description'];?></textarea>
                                                      </div>
                                                  </div>

                                                  <div class="row">
                                                      <div class="form-group col-md-6">
                                                        <label for="category">Category</label>
                                                        <select id = "<?php echo $row['id'].'category';?>" class="form-control custom-select" name="category" required class="form-control">
                                                            <?php 

                                                              $db2 = "SELECT * FROM Categories WHERE type = 'category'";
                                                              $val = $mysqli->query($db2);
                                                              if ($val) {
                                                                echo "";
                                                              } else {
                                                                echo($val->error);
                                                              }

                                                            if($val->num_rows > 0) { 
                                                              while($here = $val->fetch_assoc()) {
                                                              $selected = ($options == $selection) ? "selected" : ""; 
                                                              ?>
                                                                <option value="<?php echo $here['id'] ?>" <?php if($here['id']==$row['categoryid']) echo 'selected="selected"'; ?>><?php echo $here['title'] ?></option>
                                                            <?php } 
                                                          }?>  
                                                        </select>
                                                      </div>              
                                                  </div> 

                                                  <!--<div class="row">
                                                    <div class="form-group col-6">
                                                        <div class="form-check form-switch">
                                                          <input class="form-check-input" type="checkbox" id="<?php echo $row['id'].'premium';?>" value="<?php echo $row['premium'];?>" <?php echo $row['premium'] == 1 ? "checked" : 0?>
                                                          <label class="form-check-label" for="view">Premium</label>
                                                        </div>
                                                    </div>            
                                                  </div>-->
                                                
                                                  <div class="row">
                                                      <div class="form-group col-6">
                                                          <label for="fileToUpload">Change image</label>
                                                          <input type="file"  name="uploadfile" value="" id="<?php echo $row['id'].'image';?>" class="form-control" />
                                                      </div>         
                                                  </div>

                                                  <div class="row">  
                                                      <form>
                                                        <p>New editor</p>
                                                        <textarea name="<?php echo'editor'.$i ;?>" id="<?php echo'editor'.$i ;?>"><?php echo $row['body']; ?></textarea>
                                                      </form>
                                                  </div>
                                              </div>


                                              <script>
                                                $(":checkbox").change(function(){
                                                    $(this).val($(this).is(":checked") ? 1 : 0);
                                                });
                                              </script>

                                              <script>
                                                  CKEDITOR.replace( "<?php echo'editor'.$i ;?>", {
                                                      height: 300,
                                                      extraPlugins: 'image2',
                                                      filebrowserUploadMethod: 'form',
                                                      filebrowserUploadUrl: 'upload.php'

                                                  });
                                              </script> 
                                              <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="button" class="btn btn-primary" onclick="editPost(<?php echo $row['id'] ;?>, '<?php echo $row['id'].'title';?>','<?php echo $row['id'].'description';?>','<?php echo $row['id'].'category';?>', '<?php echo $row['id'].'image';?>','<?php echo'editor'.$i ;?>','<?php echo $row['id'].'premium';?>')">Save post</button>
                                              </div>
                                          </div>
                                      </div>
                                  </div>

                                  <td><?php echo $i; ?></td>
                                  <td><?php echo $row["title"];?></td>
                                  <td><?php echo $row["date"];?></td>
                                  <td><?php 
                                    $id =  $row["authorid"];
                                    $db = "SELECT * FROM Users WHERE id = $id";
                                    $user = $mysqli->query($db);
                                    if ($user->num_rows > 0) {
                                      while($new = $user->fetch_assoc()) 
                                      {
                                          echo($new["fname"]." ".$new["lname"]);
                                      }
                                    } else {
                                      echo "Nothing";
                                    }
                                    ?></td>
                                  
                                  <?php if(($row["status"]) == 5) { ?>
                                  <td><span class="badge rounded-pill bg-warning text-dark">Pending</span></td>
                                  <?php } else if(($row["status"]) == 1) { ?>
                                  <td><span class="badge rounded-pill bg-success">Approved</span></td>
                                  <?php }else if(($row["status"]) == 0) { ?>
                                  <td><span class="badge rounded-pill bg-danger">Rejected</span></td>
                                  <?php } ?>

                                  <td>
                                    <?php if(($row['status']) != 1 && $approve == 1) { ?>
                                      <button type="button" class="btn btn-success" onclick="approve(<?php echo $row['id'] ;?>, 'approve')">Approve</button>
                                    <?php } if(($row['status']) != 0 && $approve == 1) { ?>
                                      <button type="button" class="btn btn-secondary" onclick="approve(<?php echo $row['id'] ;?>, 'reject')">Reject</button>
                                    <?php } if($edit_post == 1) { ?>
                                        <button type="button" class="btn btn-primary" data-toggle = "modal" data-target = "#<?php echo $row['id'].'edit'; ?>">Edit</button>
                                    <?php 
                                    }
                                    if($delete_post == 1) {?>
                                      <button type="button" class="btn btn-danger" data-toggle = "modal" data-target = "#<?php echo $row['id'].'delete'; ?>">Delete</button>
                                    <?php } ?>
                                  <!--      <button type="button" a href="<?php echo "article.php?id=".$row["id"];?>" class="btn btn-success">View</button> -->
                                    <?php if($view_post == 1) { ?>
                                      <a href="<?php echo "/smart24tv/article/".$row["id"]."/".$row["slug"];?>" class="btn btn-success">View</a>
                                    <?php } ?> 
                                  </td>
                                </tr>
                                <?php $i++;
                                } ?>
                              </tbody>
                              <?php } ?>
                            </table>
                        </div>
                      </div>
                  </div>
              </div>
          </div>
       </div>

        <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/1.10.2/js/jquery.dataTables.min.js"></script>

        <script>
            var resizefunc = [];

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
        <script src="plugins/summernote/summernote.min.js"></script>

        <!-- App js -->
        <script src="assets/js/jquery.core.js"></script>
        <script src="assets/js/jquery.app.js"></script>
    </body>
</html>