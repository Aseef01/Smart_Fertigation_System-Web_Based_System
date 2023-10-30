<header>
    <div class="main-section-left">
        <h1>Hi, <?= $_SESSION['user'] ?></h1>
        <h5>Welcome to <?= $_SESSION['roles'] ?> page</h5>
    </div>
    <div class="main-section-right">
        <!-- <img src="images/icons/bell-icon-black.png" class="notification"> -->
        <a href="personal_details.php?uid=<?= $_SESSION['aid'] ?>"><img src="images/user.png" class="profile"></a>
        <div class="user-details">
            <h3><?= $_SESSION['user'] ?></h3>
            <h5><?= $_SESSION['roles'] ?></h5>
        </div>
    </div>
    <img src="images/icons/menu-icon.png" class="menu">
</header>