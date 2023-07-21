<?php

$user = $_SESSION['user']
?>
<div class="dashboard-sidebar" id="dashboard_sidebar">

<h3 class="dashboard-logo" id="dashboard_logo">POS</h3>

<div class="dashboard-sidebar-user">
    <img src="images/profile.jpg" id="user_img" alt="User image">
    <span><?= $user['first_name'] . $user['last_name']?></span>
</div>
<div class="dashboard-sidebar-menus">
    <ul class="dashboard-menu-list">
        <!-- class="menuActive"-->    
        <li class="liMainMenu">
            <a href="./dashboard.php" class="showHideSubMenu">
                <i class="fa fa-dashboard "></i>
                <span class="menutext">Dashboard</span>
            </a>
        </li>
        <li class="liMainMenu">
            <a href="javascript:void(0);" class="showHideSubMenu">
                <i class="fa fa-tag  showHideSubMenu"></i>
                <span class="menutext showHideSubMenu">Product</span>
                <!--right icon -->
                <i class="fa fa-angle-left icon_right showHideSubMenu"></i>
            </a>
            <ul class="subMenus" id="user"> 
                <li><a  class="subMenuLinks" href="./product-view.php"><i class="fa fa-circle"></i>View Product</a></li>
                <li><a  class="subMenuLinks" href="./product-add.php"><i class="fa fa-circle"></i>Add Product</a></li>
            </ul>
        </li>
        <!--- add barrs-->
        <li class="liMainMenu">
            <a href="javascript:void(0);" class="showHideSubMenu">
                <i class="fa fa-truck showHideSubMenu"></i>
                <span class="menutext showHideSubMenu ">Supplier</span>
                <!--right icon -->
                <i class="fa fa-angle-left icon_right showHideSubMenu"></i>
            </a>

            <ul class="subMenus" id="user"> 
                <li><a  class="subMenuLinks" href="#"><i class="fa fa-circle"></i>View Supplier</a></li>
                <li><a  class="subMenuLinks" href="#"><i class="fa fa-circle"></i>Add Supplier</a></li>
            </ul>
        </li>
        
        <li class="liMainMenu showHideSubMenu ">
            <a href="javascript:void(0);" class="showHideSubMenu ">
            <i class="fa fa-user-plus showHideSubMenu "></i>
            <span class="menutext showHideSubMenu ">User</span>
            <!--right icon -->
            <i class="fa fa-angle-left icon_right showHideSubMenu"></i>
        </a>
            <ul class="subMenus" id="user"> 
                <li><a class="subMenuLinks"  href="./user-view.php"><i class="fa fa-circle"></i>View Users</a></li>
                <li><a class="subMenuLinks"  href="./user-add.php"><i class="fa fa-circle"></i>Add Users</a></li>
            </ul>
            
        </li>

    </ul>
</div>
