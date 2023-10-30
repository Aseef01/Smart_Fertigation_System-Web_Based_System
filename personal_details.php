<?php include 'templates/header.php'; 

// var_dump($_COOKIE['user']);die;
// if (!isset($_SESSION['user']) || $_SESSION['roles'] != 'admin') {
if (!isset($_SESSION['user'])) {
    if($_SESSION['roles'] != 'admin' || $_SESSION['roles'] != 'user') {
        header('Location: index.php'); // Redirect to the login page if not logged in
        exit();
    }
}

if(isset($_GET['uid'])) {
    $user = query("SELECT * FROM users WHERE id = " . $_GET['uid'])[0];
    $address = query("SELECT * FROM addresses WHERE users_id = " . $_GET['uid'])[0];

    // var_dump(!is_array($user));die;
    if(!is_array($user)) {
        header("Location: user_management_page.php");
        exit;
    }
} else {
    header("Location: user_management_page.php");
    exit;
}

if(isset($_POST['save'])) {
    $title = $_POST['title'];
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $line_1 = $_POST['line_1'];
    $line_2 = $_POST['line_2'];
    $postcode = $_POST['postcode'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $location = $line_1 . " " . $line_2 . " " . $postcode . " " . $city . " " . $state;

    // var_dump($location);die;

    updateData("UPDATE users SET title = '$title', full_name = '$full_name', email = '$email', phone_number = '$phone' WHERE id = " . $_GET['uid']);

    $addresses = query("SELECT * FROM addresses WHERE users_id = " . $_GET['uid']);

    if(is_array($addresses)) {
        // echo 'ada';die;
        updateData("UPDATE addresses SET users_id = " . $_GET['uid'] . ", line_1 = '$line_1', line_2 = '$line_2', postcode = '$postcode', city = '$city', state = '$state' WHERE users_id = " . $_GET['uid']);
    } else {
        // echo 'x ada';die;
        updateData("INSERT INTO addresses 
                    (users_id, line_1, line_2, postcode, city, state) 
                    VALUES (" . $_GET['uid'] .", '$line_1', '$line_2', '$postcode', '$city', '$state')");
    }
    updateData("UPDATE users SET location = '$location' WHERE id = " . $_GET['uid']);

    header("Location: personal_details.php?uid=" . $_GET['uid']);
    exit;
}

// var_dump($address);die;

?>
<?php include 'templates/sidebar.php' ?>
<style>
    @media (max-width: 768px) {
        .user-profile {
            overflow: auto;
            left: 0;
        }
        .user-profile form .main-information img {
            width: 130px;
        }
        .user-profile form .main-information {
            align-items: center;
            flex-direction: column;
        }
        .infomation-one, .infomation-two {
            width: 100%;
            margin: 30px 0 0;
        }
        .second-information div {
            align-items: start;
            flex-direction: column;
/*            margin: 0;*/
        }
        .second-information div input {
            margin: 15px 0 0;
            width: 93%;
        }
        .second-information .last-information input {
/*            width: 90%;*/
            margin-bottom: 30px;
/*            margin-right: 0;*/
        }
        .second-information .last-information input:last-child {
            margin-bottom: 0;
        }
        .user-profile form button {
/*            background-color: #28BB8E;*/
/*            color: #fff;*/
/*            font-weight: bold;*/
/*            border-radius: 20px;*/
            width: 100%;
/*            font-size: 1rem;*/
/*            border: none;*/
/*            box-shadow: 0 0 4px 1px rgba(0, 0, 0, 0.15);*/
/*            padding: 15px 0;*/
            position: unset;
/*            right: 30px;*/
/*            bottom: 30px;*/
        }
    }
</style>

<div class="main-section">
    <?php include 'templates/main_section_header.php' ?>

    <div class="user-profile">
        <h1>Personal Details</h1>
        <form action="" method="post">
            <div class="main-information">
                <img src="images/<?= $user['user_image'] ?>">
                <div class="infomation-one">
                    <label for="title">Title</label>
                    <select id="title" name="title">
                        <option value="Mr." <?= ($user['title'] == 'Mr.') ? 'selected' : '' ?>>Mr.</option>
                        <option value="Ms." <?= ($user['title'] == 'Ms.') ? 'selected' : '' ?>>Ms.</option>
                    </select>
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" placeholder="Enter your email" value="<?= $user['email'] ?>">
                </div>
                <div class="infomation-two">
                    <label for="full_name">Full Name</label>
                    <input type="text" id="full_name" name="full_name" placeholder="Enter your full name" value="<?= $user['full_name'] ?>">
                    <label for="phone">Phone Number</label>
                    <input type="number" id="phone" name="phone" placeholder="Enter your phone number" value="<?= $user['phone_number'] ?>">
                </div>
            </div>
            <div class="second-information">
                <h3>Site Address</h3>
                <div>
                    <label for="line_1">Line 1</label>
                    <input type="text" id="line_1" name="line_1" placeholder="Line 1" value="<?= (is_array($address)) ? $address['line_1'] : "" ?>">
                </div>
                <div>
                    <label for="line_2">Line 2</label>
                    <input type="text" id="line_2" name="line_2" placeholder="Line 2" value="<?= (is_array($address)) ? $address['line_2'] : "" ?>">
                </div>
                <div class="last-information">
                    <!-- <div> -->
                        <label for="postcode">Postcode</label>
                        <input type="text" id="postcode" name="postcode" placeholder="Postcode" value="<?= (is_array($address)) ? $address['postcode'] : "" ?>">
                    <!-- </div> -->
                    <!-- <div> -->
                        <label for="city">City</label>
                        <input type="text" id="city" name="city" placeholder="City" value="<?= (is_array($address)) ? $address['city'] : "" ?>">
                    <!-- </div> -->
                    <!-- <div> -->
                        <label for="state">State</label>
                        <input type="text" id="state" name="state" placeholder="State" value="<?= (is_array($address)) ? $address['state'] : "" ?>">
                    <!-- </div> -->
                </div>
            </div>
            <button type="submit" name="save">Save</button>
        </form>
    </div>
</div>

<?php include 'templates/footer.php' ?>