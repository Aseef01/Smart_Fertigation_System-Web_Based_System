<?php 

// include 'getData.php';
// include 'postData.php';
include 'templates/header.php';

// if (!isset($_SESSION['user']) || $_SESSION['roles'] != 'admin') {
if (!isset($_SESSION['user'])) {
    if($_SESSION['roles'] != 'admin' || $_SESSION['roles'] != 'user') {
        header('Location: index.php'); // Redirect to the login page if not logged in
        exit();
    }
}

// if(isset($_GET["uid"]) || isset($_GET["did"])) {
if(isset($_GET["uid"])) {
    $devices = query("SELECT * FROM devices WHERE users_id = " . $_GET["uid"]);
    $inputs = query("SELECT * FROM inputs WHERE devices_id = " . $devices[0]['id']);
    // var_dump($inputs);die;
} else {
    header("Location: user_management_page.php");
    exit;
}

if(isset($_GET["did"])) {
    $inputs = query("SELECT * FROM inputs WHERE devices_id = " . $_GET['did']);
}

if(isset($_POST['create-schedule'])) {

    $inputs_id = explode(" ", $_POST['type'])[0];
    $type = explode(" ", $_POST['type'])[1];
    $datetime = explode("T", $_POST['datetime'])[0] . " " . explode("T", $_POST['datetime'])[1];
    
    if(isset($_GET["did"])) {
        $devices_id = $_GET['did'];
        updateData("INSERT INTO schedules 
        (devices_id, inputs_id, datetime, duration, type) 
        VALUES ($devices_id, $inputs_id, '$datetime', 0, '$type')");
    } else {
        updateData("INSERT INTO schedules 
        (devices_id, inputs_id, datetime, duration, type) 
        VALUES (" . $devices[0]["id"] .", $inputs_id, '$datetime', 0, '$type')");
    }
}

if(isset($_POST['edit_input'])) {
    $inputs_id = $_POST['id'];
    $duration = $_POST['duration'];

    updateData("UPDATE inputs SET duration = $duration WHERE id = $inputs_id");
}

?>



<?php include 'templates/sidebar.php' ?>

<div class="main-section">
    <?php include 'templates/main_section_header.php' ?>

    <div class="device-section">
        <?php if($_SESSION['roles'] == 'admin') : ?>
        <div class="create">
            <div class="create-device">
                <img src="images/icons/add-icon-black.png">
                <h3>Create Project</h3>
            </div>
            <!-- <div class="create-input">
                <img src="images/icons/add-icon-black.png">
                <h3>Create Input</h3>
            </div> -->
        </div>
        <?php endif; ?>

        <div class="device-box">
            <h1>Choose Your Project Site</h1>
            <div class="all-device">
                <?php if(is_string($devices)) : ?>
                    <span>This user doesn't have any devices.</span>
                <?php else : foreach($devices as $device) : ?>
                    <a href="device.php?uid=<?= $_GET["uid"] ?>&did=<?= $device['id'] ?>" class="device-card"><?= explode('_', $device['name'])[1]; ?></a>
                <?php endforeach; endif; ?>
            </div>
        </div>
        <div class="service">
            <div class="input">
                <div class="input-header">
                    <h1>Input</h1>
                    <?php if($_SESSION['roles'] == 'admin') : ?>
                    <img src="images/icons/add-icon-black.png" class="add-service">
                    <?php endif; ?>
                </div>
                <?//php if(!is_array($inputs)) : ?>
                    <!-- <div class="input-card available">
                        <span>Data is not available!</span>
                    </div> -->
                <?//php else : foreach($inputs as $input) : ?>
                    <div class="all-input">
                        <!-- <div class="input-card available">
                            <span>Data is not available!</span>
                        </div> -->
                        <!-- <div class="input-card">
                            <div class="input-card-top">
                                <span class="title-input"><?//= $input['name'] ?></span>
                                <div class="input-card-actions">
                                    <label class="switch">
                                        <input type="checkbox" class="switch-button" <?//= ($input['status'] == 1) ? 'checked' : ''; ?>>
                                        <span class="slider round"></span>
                                    </label>
                                    <img src="images/icons/dots-icon.png">
                                </div>
                            </div>
                            <span class="duration">Duration: <?//= $input['duration'] ?> minutes</span>
                        </div> -->
                    </div>
                <?//php endforeach; endif; ?>
            </div>
            <div class="data-sensor">
                <h1>Data Sensor</h1>
                <div class="all-data-sensor">
                    <?//php if(!is_array($sensors)) : ?>
                        <!-- <div class="data-sensor-card available">
                            <span>Data is not available!</span>
                        </div> -->
                    <?//php else : foreach($sensors as $sensor) : ?>
                        <!-- <div class="data-sensor-card">
                            <span class="sensor"><?//= $sensor['name'] ?></span>
                            <div class="value-unit">
                                <span class="value"><?//= $sensor['value'] ?></span>
                                <span class="unit"><?//= $sensor['unit'] ?></span>
                            </div>
                        </div> -->
                    <?//php endforeach; endif; ?>
                </div>
            </div>
            <div class="schedule-box">
                <div class="schedule-header">
                    <h1>Schedule</h1>
                    <img src="images/icons/add-icon-black.png" class="add-service">
                </div>
                <div class="all-schedule">
                    <?//php for($i = 0; $i < 6; $i++) : ?>
                        <!-- <div class="hst available">
                            <span>Data is not available!</span>
                        </div> -->
                        <!-- <div class="hst active">
                            <div class="hst-actions">
                                <h3>HST-1</h3>
                                <div>
                                    <img src="images/icons/edit-icon.png">
                                    <img src="images/icons/dustbin-icon.png">
                                </div>
                            </div>
                            <div class="time">
                                <span class="date">Date: 2023-09-01</span>
                                <span class="time">Time: 13:45:21</span>
                                <span class="type">Task: Baja</span>
                            </div>
                        </div> -->
                    <?//php endfor; ?>
                </div>
                <!-- <div class="schedule-footer active"> -->
                <div class="schedule-footer">
                    <span class="order">Prev</span>
                    <span class="page">1</span>
                    <span class="page active">2</span>
                    <span class="page">3</span>
                    <span class="order">Next</span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- <div class="popup-edit show"> -->
<div class="popup-edit">
    <div class="popup-header">
        <img src="images/icons/caution-icon.png">
        <span class="note">Warning</span>
        <p>Are you sure?</p>
    </div>
    <div class="popup-footer">
        <!-- <form action="" method="get">  -->
            <!-- <input type="hidden" value="2" name="id_switch_button" class="switch-id"> -->
            <!-- <input type="hidden" value="1" name="status_switch_button" class="switch-status"> -->
            <button type="button" name="cancel" class="input-cancel">Cancel</button>
            <button type="submit" name="edit" class="input-edit">Continues edit</button>
        <!-- </form> -->
    </div>
</div>

<div class="popup-create-service">
    <div class="popup-title">Create new schedule</div>
    <form action="" method="post">
        <!-- <input type="hidden" name="id" value=""> -->
        <div class="popup-input">
            <label for="datetime">Select Date and Time:</label>
            <input type="datetime-local" id="datetime" name="datetime" required>
        </div>
        <div class="popup-input">
            <label for="type">Select type:</label>
            <select name="type" id="type" required>
                <?php
                foreach($inputs as $input) {
                    echo '<option value="' . $input['id'] . ' ' . $input['name'] . '">' . $input['name'] . '</option>';
                }
                ?>
            </select>
        </div>
        <div class="popup-btn">
            <button type="button" name="cancel" class="popup-btn-cancel">Cancel</button>
            <button type="submit" name="create-schedule" class="create-button">Create Schedule</button>
        </div>
    </form>
</div>

<?php include 'templates/footer.php' ?>