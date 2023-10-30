<div class="sidebar">
    <div class="sidebar-header">
        <img src="images/logo.png" class="logo">
        <!-- <img src="images/icons/menu-icon.png" class="menu"> -->
    </div>
    <h5>Menu</h5>
    <ul>
        <li class="menus">
            <a href="<?= ($_SESSION['roles'] == 'admin') ? "user_management_page.php" : "device.php?uid=" . $_SESSION['aid'] ?>">
                <img src="images/icons/dashboard-icon-black.png">
                Dashboard
            </a>
        </li>
        <li  class="menus">
            <a href="personal_details.php?uid=<?= $_SESSION['aid'] ?>">
                <img src="images/icons/user-icon-black.png">
                Personal details
            </a>
        </li>
        <li class="menus">
            <a href="logout.php">
                <img src="images/icons/logout-icon-black.png">
                Logout
            </a>
        </li>
    </ul>
</div>