$(document).ready(function() {

    var baseURL = "http://localhost/iot-platfom-admin/";
    // var baseURL = "http://miniapi.forotify.com/";

    function fetchData() {
        $.ajax({
            url: baseURL + 'getData.php' + window.location.search,
            method: 'GET',
            dataType: 'json',
            success: function(data) {
                // let devices = data.devices;
                let inputs = data.inputs;
                let sensors = data.sensors;
                let schedules = data.schedules;
                // console.log(inputs[0].id);

                $('.all-input').html('');
                $('.all-data-sensor').html('');
                $('.all-schedule').html('');

                let inputBox = ``;
                if (typeof inputs === 'string')  {
                    inputBox = `<div class="input-card available">
                                        <span>${inputs}</span>
                                    </div>`;
                    $('.all-input').append(inputBox);
                } else {
                    inputs.forEach(function(input) {
                        inputBox = `<div class="input-card">
                            <div class="input-card-top">
                                <span class="title-input">${(input.name == "Sulam") ? "Irrigation Water" : "Irrigation Fertilizer"}</span>
                                <div class="input-card-actions">
                                    <label class="switch">
                                        <input type="checkbox" class="switch-button" data-id="${input.id}" name="${input.name}" value="${input.status}" ${(input.status == 1) ? 'checked' : ''}>
                                        <span class="slider round"></span>
                                    </label>
                                    <img src="images/icons/edit-icon.png" class="edit-input-control" data-id="${input.id}">
                                </div>
                            </div>
                            <span class="duration">Duration: ${input.duration} minutes</span>
                        </div>`;
                        
                        $('.all-input').append(inputBox);
                    });
                }

                let sensorBox = ``;
                
                if (typeof sensors === 'string')  {
                    sensorBox = `<div class="data-sensor-card available">
                        <span>${sensors}</span>
                    </div>`;
                    $('.all-data-sensor').append(sensorBox);
                } else {
                    sensors.forEach(function(sensor) {
                        sensorBox = `<div class="data-sensor-card">
                            <span class="sensor">${sensor.name}</span>
                            <div class="value-unit">
                                <span class="value ${(sensor.value == "LOW") ? "color" : ""}">${sensor.value}</span>
                                <span class="unit">${sensor.unit}</span>
                            </div>
                        </div>`;
                        
                        $('.all-data-sensor').append(sensorBox);
                    });
                }
                
                let scheduleBox = ``;

                if (typeof schedules === 'string')  {
                    scheduleBox = `<div class="hst available">
                        <span>${schedules}</span>
                    </div>`;
                    $('.all-schedule').append(scheduleBox);
                } else {
                    schedules.forEach(function(schedule) {
                        let parts = schedule.datetime.split(" ");
                        scheduleBox = `<div class="hst active">
                            <div class="hst-actions">
                                <h3>${schedule.hst}</h3>
                                <div>
                                    <img src="images/icons/dustbin-icon.png" data-id="${schedule.id}" class="remove-schedule">
                                </div>
                            </div>
                            <div class="time">
                                <span class="date"><span class="schedule-bold">Date:</span> ${parts[0]}</span>
                                <span class="masa"><span class="schedule-bold">Time:</span> ${parts[1]}.00</span>
                                <span class="type"><span class="schedule-bold">Task:</span> ${(schedule.type == "Sulam") ? "Irrigation Water" : "Irrigation Fertilizer"}</span>
                            </div>
                        </div>`;
                        
                        $('.all-schedule').append(scheduleBox);
                    });
                }

                var remove_schedules = document.querySelectorAll(".remove-schedule");

                remove_schedules.forEach(function(remove_schedule) {
                    remove_schedule.addEventListener("click", function() {
                        // console.log(remove_schedule.getAttribute("data-id"));

                        var confirmed = confirm("Are you sure you want to delete this schedule?");

                        if (confirmed) {
                            var postData = {
                                title: "remove_schedule",
                                id: remove_schedule.getAttribute("data-id"),
                            };
    
                            // Send a POST request
                            $.ajax({
                                type: "POST",
                                url: baseURL + 'postData.php',
                                data: JSON.stringify(postData), // Convert the data to JSON format
                                contentType: "application/json", // Set the content type header
                                success: function(response) {
                                    // console.log("POST request successful:", response);
                                },
                                error: function(error) {
                                    // console.error("POST request failed:", error);
                                }
                            });
                            // alert("Schedule deleted!");
                        }

                    });
                });

                var checkboxs = document.querySelectorAll(".switch-button");
                var popup_edit = document.querySelector(".popup-edit");
                var input_edit = document.querySelector(".input-edit");
                // var input_cancel = document.querySelector(".input-cancel");
                // console.log(checkboxs[0].value);

                checkboxs.forEach(function(checkbox) {
                    checkbox.addEventListener("click", function() {
                        popup_edit.classList.toggle('show');

                        let name = checkbox.name;
                        let value = checkbox.value;
                        let dataID = checkbox.getAttribute("data-id");

                        // var inputHidden = $(".switch-id");
                        // var inputHidden = $(".switch-status");

                        // inputHidden.val(value);
                        // inputHidden.attr("name", dataID);
                        document.addEventListener("click", function(event) {
                            if(!event.target.classList.contains('popup_edit') && !event.target.classList.contains('switch-button')) {
                                // popupBox.forEach(function(popup) {
                                //     popup.classList.remove('show');
                                // });
                                popup_edit.classList.remove('show');
                            }
                        });
                        input_edit.addEventListener("click", function() {
                            // console.log(checkbox.name);
                            var postData = {
                                title: "swith_button",
                                name: name,
                                id: dataID,
                                value: value
                            };

                            // Send a POST request
                            $.ajax({
                                type: "POST",
                                url: baseURL + 'postData.php',
                                data: JSON.stringify(postData), // Convert the data to JSON format
                                contentType: "application/json", // Set the content type header
                                success: function(response) {
                                    // console.log("POST request successful:", response);
                                },
                                error: function(error) {
                                    // console.error("POST request failed:", error);
                                }
                            });
                            popup_edit.classList.remove('show');
                        });
                    });
                });

                let edit_input_controls = document.querySelectorAll(".edit-input-control");
                // console.log(edit_input_controls);
                edit_input_controls.forEach(function(control) {
                    control.addEventListener("click", function() {
                        window.scrollTo({ top: 0, behavior: 'smooth' });

                        popup_create_service.style.visibility = "visible";


                        let input_id = control.getAttribute("data-id");
                        let designPopup = ``;

                        $('.popup-create-service form').html('');
                        $('.popup-title').text('Edit Valve Input');

                        inputs.forEach(function(input) {
                            if(input.id == input_id) {
                                designPopup = `<input type="hidden" name="id" value="${input.id}">
                                    <div class="popup-input">
                                        <label for="duration">Duration:</label>
                                        <input type="number" id="duration" name="duration" required value="${input.duration}">
                                    </div>
                                    <div class="popup-btn">
                                        <button type="button" name="cancel" class="popup-btn-cancel">Cancel</button>
                                        <button type="submit" name="edit_input" class="create-button">Edit Input</button>
                                    </div>`;
                            }
                        });

                        //     // console.log(inputs);

                        $('.popup-create-service form').append(designPopup);
                    });
                });


                var add_service = document.querySelectorAll(".add-service");
                var popup_create_service = document.querySelector(".popup-create-service");
                var popup_btn_cancel = document.querySelector(".popup-btn-cancel");

                add_service.forEach(function(button) {
                    button.addEventListener("click", function() {
                        window.scrollTo({ top: 0, behavior: 'smooth' });
                        popup_create_service.style.visibility = "visible";

                        let designPopup = ``;

                        $('.popup-create-service form').html('');
                        $('.popup-title').text('Create new schedule');


                        console.log(inputs);

                        designPopup = `<div class="popup-input">
                            <label for="datetime">Select Date and Time:</label>
                            <input type="datetime-local" id="datetime" name="datetime" required>
                        </div>
                        <div class="popup-input">
                            <label for="type">Select type:</label>
                            <select name="type" id="type" required>
                                ${inputs.map(element => `<option value="${element.id} ${element.name}">${(element.name == "Sulam") ? "Irrigation Water" : "Irrigation Fertilizer"}</option>`).join('')}
                            </select>
                        </div>
                        <div class="popup-btn">
                            <button type="button" name="cancel" class="popup-btn-cancel">Cancel</button>
                            <button type="submit" name="create-schedule" class="create-button">Create Schedule</button>
                        </div>`;

                        $('.popup-create-service form').append(designPopup);
                    });
                });
                
                popup_btn_cancel.addEventListener("click", function() {
                    popup_create_service.style.visibility = "hidden";
                });
            }
        });
    }

    // fetchData();
    setInterval(fetchData, 1000);

    var remove_users = document.querySelectorAll(".remove-users");

    remove_users.forEach(function(remove_user) {
        remove_user.addEventListener("click", function() {
            // console.log(remove_user.getAttribute("data-id"));

            var confirmed = confirm("Are you sure you want to delete this user?");

            if (confirmed) {
                var postData = {
                    title: "remove_user",
                    id: remove_user.getAttribute("data-id"),
                };
    
                // Send a POST request
                $.ajax({
                    type: "POST",
                    url: baseURL + 'postData.php',
                    data: JSON.stringify(postData), // Convert the data to JSON format
                    contentType: "application/json", // Set the content type header
                    success: function(response) {
                        // console.log("POST request successful:", response);
                    },
                    error: function(error) {
                        // console.error("POST request failed:", error);
                    }
                });
                // alert("Item deleted!");
            }
        });
    });

    var dots_icon = document.querySelectorAll(".popup-display");
    var popupBox = document.querySelectorAll(".popup");
    
    dots_icon.forEach(function(button) {
        button.addEventListener("click", function() {
            const popup = this.nextElementSibling;
            popup.classList.toggle('show');
        });
    });
    
    document.addEventListener("click", function(event) {
        if(!event.target.classList.contains('popup-display')) {
            popupBox.forEach(function(popup) {
                popup.classList.remove('show');
            });
        }
    });

    let menu = document.querySelector('.menu');
    let sidebar = document.querySelector('.sidebar');

    menu.addEventListener('click', function() {
        sidebar.classList.toggle('show')
    });
});