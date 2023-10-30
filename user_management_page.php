<?php include 'templates/header.php';

// var_dump($_COOKIE['user']);die;
if (!isset($_SESSION['user']) || $_SESSION['roles'] != 'admin') {
    header('Location: index.php'); // Redirect to the login page if not logged in
    exit();
}

$users = query("SELECT * FROM users WHERE id <> " . $_SESSION['aid']);

// var_dump($users);die;

if(isset($_GET['search'])) {
    $key = $_GET['key'];
    $users = query("SELECT * FROM users WHERE full_name LIKE '%$key%' AND id <> " . $_SESSION['aid']);
}

?>

<?php include 'templates/sidebar.php' ?>

<div class="main-section">
    <?php include 'templates/main_section_header.php' ?>

    <div class="users-information">
        <form action="" method="get" class="search-box">
            <div class="search">
                <img src="images/icons/search-icon-black.png">
                <input type="text" name="key" placeholder="Search by name">
            </div>
            <button type="submit" name="search">Search</button>
        </form>
        <div class="users-information-box">
            <table>
                <tr>
                    <th>Full Name / Role</th>
                    <th>Phone Number</th>
                    <th>Status</th>
                    <th>Email Address</th>
                    <th>Location</th>
                    <th>Actions</th>
                </tr>
                <?php if(is_string($users)) : ?>
                    <tr>
                        <td  class="table-footer" colspan="6"><?= $users ?></td>
                    </tr>
                <?php else : foreach($users as $user) : ?>
                <tr>
                    <td class="users-information-table">
                        <a href="personal_details.php?uid=<?= $user["id"] ?>"><img src="images/<?= $user["user_image"] ?>" class="profile"></a>
                        <div class="user-details">
                            <h3><?= $user["title"] . " " . explode(" ", $user["full_name"])[0] . " " . explode(" ", $user["full_name"])[1]; ?></h3>
                            <h5><?= $user["roles"] ?></h5>
                        </div>
                    </td>
                    <td>+6<?= $user["phone_number"] ?></td>
                    <td>Active</td>
                    <td><?= $user["email"] ?></td>
                    <td class="location"><?= $user["location"] ?></td>
                    <td class="action">
                        <a href="personal_details.php?uid=<?= $user["id"] ?>"><img src="images/icons/edit-icon.png"></a>
                        <a href="" class="remove-users" data-id="<?= $user["id"] ?>"><img src="images/icons/dustbin-icon.png"></a>
                        <img src="images/icons/dots-icon.png" class="popup-display">
                        <div class="popup">
                            <!-- <a href="">Change Password</a> -->
                            <!-- <a href="">Change Status</a> -->
                            <a href="device.php?uid=<?= $user["id"] ?>">View Devices</a>
                        </div>
                    </td>
                </tr>
                <?php endforeach; endif; ?>
                <!-- <tr>
                    <td class="table-footer" colspan="6">
                        <span class="order">Prev</span>
                        <span class="page">1</span>
                        <span class="page active">2</span>
                        <span class="page">3</span>
                        <span class="order">Next</span>
                    </td>
                </tr> -->
            </table>
        </div>
    </div>
</div>

<?php include 'templates/footer.php' ?>