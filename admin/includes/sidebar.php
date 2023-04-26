            <?php include ("functions.php");?>
            <?php include ("function.php");?>
            <?php include ("permissions.php");?>


            <div class="left side-menu">
                <div class="sidebar-inner slimscrollleft">
 
                    <!--- Sidemenu -->
                    <div id="sidebar-menu">
                        <ul>
                        	<li class="menu-title">Navigation</li>
                            <li class="has_sub">
                                <a href="dashboard.php" class="waves-effect"><i class="mdi mdi-view-dashboard"></i> <span> Dashboard </span> </a>
                            </li>
 
                            <li class="has_sub">
                                <?php if($view_category == 1) { ?>
                                <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-folder-open-o"></i> <span> Category </span> <span class="menu-arrow"></span></a>
                                <?php } ?>
                                <ul class="list-unstyled">
                                    <?php if($add_category == 1 || $view_category == 1 || $delete_category == 1 || $edit_category == 1) { ?>
                                	<li><a href="add_category.php">Manage categories</a></li>
                                    <li><a href="add_sub_menu.php">Sub Menus</a></li>
                                <?php } ?>
                                 </ul> 
                            </li>

                            <?php if($view_post == 1 || $delete_post == 1 || $edit_post == 1 || $add_post == 1  ) { ?>
                             <li class="has_sub"> 
                                <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-newspaper-o"></i> <span> Articles </span> <span class="menu-arrow"></span></a>
                                <ul class="list-unstyled"> 
                                    <li><a href="editor.php">Manage articles</a></li>
                                    <li><a href="adverts.php">Manage adverts</a></li>
                                </ul>
                            </li>  
                            <?php } ?>
                            <?php if($view_page == 1 || $delete_page == 1 || $edit_page == 1 || $add_page == 1  ) { ?>
                            <li class="has_sub"> 
                                <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-file-code-o"></i> <span> Pages </span> <span class="menu-arrow"></span></a>
                                <ul class="list-unstyled">
                                    <?php if(($add_page) == 1) {?>
                                    <li><a href="addpage.php">Add Page</a></li>
                                <?php } ?>
                                 <?php if($view_page == 1 || $delete_page == 1 || $edit_page == 1 || $add_page == 1  ) { ?>
                                    <li><a href="managepage.php">Manage Page</a></li>
                                    <?php } ?>
                                </ul>
                            </li> 
                            <?php } ?>

                            <?php if($view_social == 1 || $delete_social == 1 || $edit_social == 1 || $add_social == 1  ) { ?>
                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-share-alt"></i> <span> Social Links </span> <span class="menu-arrow"></span></a>
                                <ul class="list-unstyled">
                                <?php if($add_social == 1) { ?>
                                    <li><a href="addsocial.php">Add link</a></li>
                                <?php } ?>
                                    <li><a href="managesocial.php">Manage link</a></li>
                                </ul>
                            </li>
                            <?php } ?>    
                            <?php if($view_social == 1 || $delete_social == 1 || $edit_social == 1 || $add_social == 1  ) { ?>
                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-image"></i> <span> Gallery </span> <span class="menu-arrow"></span></a>
                                <ul class="list-unstyled">
                                    <li><a href="gallery.php">Manage Gallery</a></li>
                                    <li><a href="gallery_types.php">Manage Gallery Types</a></li>
                                </ul>
                            </li>
                            <?php } ?>    
                            <?php if($view_user == 1 || $delete_user == 1 || $edit_user == 1 || $add_user == 1  ) { ?>
                             <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-users"></i> <span> Users </span> <span class="menu-arrow"></span></a>
                                <ul class="list-unstyled">
                                    <li><a href="users.php">Manage users</a></li>
                                <?php if($user_groups == 1){?>
                                    <li><a href="user_groups.php">User groups</a></li>
                                <?php } ?> 
                                </ul>
                            </li> 
                            <?php } ?>
                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-phone"></i> <span> Contact </span> <span class="menu-arrow"></span></a>
                                <ul class="list-unstyled">
                                    <li><a href="contact_info.php">Manage contacts</a></li>
                                    <li><a href="office_contacts.php">Office contacts</a></li>
                                    <li><a href="messages.php">Messages</a></li>
                                    <li><a href="membership.php">Membership</a></li>
                                </ul>
                            </li> 
                        </ul>
                    </div>                   
                </div>
            </div>