<?php
$idname = 0;
$id = 0;
if (isset($_COOKIE["idname"]) && isset($_COOKIE["id"])) {
    include "php/connect.php";
    $idname = $_COOKIE["idname"];
    $id = $_COOKIE["id"];
    $sql = mysqli_query($con, "SELECT * from userdata WHERE ID = '$id' AND UserName = '$idname'");
    if (mysqli_num_rows($sql) > 0) {
        $data = mysqli_fetch_assoc($sql);
        $idemail = $data["Email"];
    } else {
        echo "<script>alert('Error');</script>";
    }
    $date = date("Y-m-d H:i:s");
    $update_stat = mysqli_query($con, "UPDATE `userdata` SET `timestamp`= '$date' WHERE ID = '$id' AND UserName = '$idname'");
} else {
    echo "<script>window.location.href ='login_page.php';</script>";
}

if (isset($_POST['submit'])) {
    $title = $_POST["task-title"];
    $priority = $_POST["task-priority"];
    $due = $_POST["due-date"];
    $message = $_POST["task-message"];
    if ($title == '' || $priority == '' || $due == '' || $message == '') {

    } else {
        $query = mysqli_query($con, "INSERT INTO todo(name, email, title, priority, due, message) VALUES ('$idname','$idemail','$title', '$priority', '$due', '$message')");
        if ($query) {
            $title = '';
            $priority = '';
            $due = '';
            $message = '';
            echo "<script>window.location.href ='index.php';</script>";
        } else {
            echo "<script>alert('Error 2');</script>";
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To Do</title>
    <link href="R.png?v=<?php echo rand(); ?>" rel="icon">
    <link rel="stylesheet" href="css/mycss.css">
    <link rel="stylesheet" href="css/style.css" />

</head>

<body>
    <div class="navbar_phone">
        <button class="option" onclick="mytoggle()" id="option" style="border-top-right-radius: 20px;">Hide 🙈</button>
    </div>
    <div class="navbar" id="myElement">
        <button class="options" onclick="addtask()" id="addbtn" style="border-top-right-radius: 20px;">Add Task</button>
        <button class="options" onclick="viewtask()" id="viewbtn" style="border-bottom-right-radius: 20px;">View
            Tasks</button>
    </div>
    <br>
    <br>

    <div class="container" id="addtask">
        <h1>Add Task</h1>
        <form action="index.php" class="task-form" method="POST" onsubmit="return subTask()">
            <div class="form-group">
                <label for="task-title">Task Title:</label>
                <input type="text" id="task-title" name="task-title" onkeyup="charOnly(this);"
                    placeholder="Enter task title">
                <span id="title_success" class="success"></span>
                <span id="title_error" class="error"></span>
            </div>
            <div class="form-group">
                <label for="task-priority">Task Priority:</label>
                <select id="task-priority" name="task-priority">
                    <option value="Low">Low</option>
                    <option value="Medium">Medium</option>
                    <option value="High">High</option>
                </select>
                <span id="priority_success" class="success"></span>
                <span id="priority_error" class="error"></span>
            </div>
            <div class="form-group">
                <label for="due-date">Due Date:</label>
                <input type="date" id="due-date" name="due-date">
                <span id="date_success" class="success"></span>
                <span id="date_error" class="error"></span>
            </div>
            <div class="form-group">
                <label for="task-message">Task Message:</label>
                <textarea id="task-message" name="task-message" rows="5" maxlength="10004"
                    placeholder="Write your task message (maximum 1000 characters)"
                    onkeyup="charOnly(this);"></textarea>
                <span id="message_success" class="success"></span>
                <span id="message_error" class="error"></span>
            </div>
            <input type="submit" class="submit" name="submit" value="Submit">
        </form>
    </div>

    <div class="container view" id="viewtask">
        <div class="table_container">
            <table id="Tasks">
                <tr>
                    <th>S.N</th>
                    <th>Title</th>
                    <th>Due Date</th>
                    <th>Days Left</th>
                    <th>Priority</th>
                    <th>Task Message</th>
                    <th>❌</th>
                </tr>

                <?php
                $fetch = mysqli_query($con, "SELECT * FROM todo WHERE name ='$idname' and email='$idemail' ORDER BY due ASC, priority ASC");
                if (mysqli_num_rows($fetch) > 0) {
                    $count = 0;
                    while ($row = mysqli_fetch_assoc($fetch)) {
                        $count++;
                        ?>

                        <tr>
                            <td>
                                <?php echo $count; ?>
                            </td>
                            <td>
                                <?php echo $row['title']; ?>
                            </td>

                            <td>
                                <?php echo $row['due']; ?>
                            </td>
                            <td>
                                <?php
                                $today = time();
                                $due_date = $row['due'];
                                $due_date_stamp = strtotime($due_date);
                                $date_diff = $due_date_stamp - $today;
                                $int_day = intval($date_diff / 86400);
                                if ($int_day > ($date_diff / 86400)) {
                                    echo ($int_day);
                                } else {
                                    echo ($int_day + 1);
                                }
                                ?>
                            </td>
                            <td>
                                <?php echo $row['priority']; ?>
                            </td>
                            <td>
                                <?php echo $row['message']; ?>
                            </td>
                            <td>
                                <button class="button button1" onclick="ajaxCall(<?php echo $row['id']; ?>)">
                                    Finish
                                </button>
                            </td>
                        </tr>

                        <?php
                    }
                }
                ?>



            </table>
        </div>

    </div>

    <script type="text/javascript">
        viewtask();

        function ajaxCall(input) {
            //alert("About To Delete " + input);
            let xhr1 = new XMLHttpRequest();
            xhr1.open("POST", "php/remove_task.php", true);
            xhr1.onload = () => {
                if (xhr1.readyState === XMLHttpRequest.DONE) {
                    if (xhr1.status === 200) {
                        window.location.href = 'index.php';
                    }
                }
            }
            xhr1.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr1.send("incoming_id=" + input);
        }

        function charOnly(input) {
            var regex = /[^ a-z 1234567890:/.]/gi;
            input.value = input.value.replace(regex, "");
        }
        function subTask() {
            var title = document.getElementById("task-title").value;
            var priority = document.getElementById("task-priority").value;
            var date = document.getElementById("due-date").value;
            var message = document.getElementById("task-message").value;
            if (title == '' || priority == '' || date == '' || message == '' || title.length > 1000) {
                if (title == '') {
                    document.getElementById("title_error").innerHTML = "Task Title can't be blank ❌";
                }
                else if (title.length > 1000) {
                    document.getElementById("title_error").innerHTML = "Title should have less than 1000 characetrs ❌";
                }
                else {
                    document.getElementById("title_error").innerHTML = "";
                }
                if (priority == '') {
                    document.getElementById("priority_error").innerHTML = "Task Priority can't be blank ❌";
                }
                else {
                    document.getElementById("priority_error").innerHTML = "";
                }
                if (date == '') {
                    document.getElementById("date_error").innerHTML = "Due Date can't be blank ❌";
                }
                else {
                    document.getElementById("date_error").innerHTML = "";
                }
                if (message == '') {
                    document.getElementById("message_error").innerHTML = "Task Message can't be blank ❌";
                }
                else if (message.length > 1000) {
                    document.getElementById("message_error").innerHTML = "Message should have less than 1000 characters ❌";
                }
                else {
                    document.getElementById("message_error").innerHTML = "";
                }
                return false;
            }
        }
        function mytoggle() {
            const myElement = document.getElementById('myElement');
            myElement.classList.toggle('toggle');
            var val = document.getElementById('option').innerHTML;
            if (val == 'Show 🫣') {
                document.getElementById('option').innerHTML = "Hide 🙈";
            }
            else {
                document.getElementById('option').innerHTML = "Show 🫣";
            }
        }
        function addtask() {
            const myElement1 = document.getElementById('addtask');
            myElement1.classList.add('view');
            const myElement2 = document.getElementById('viewtask');
            myElement2.classList.remove('view');
            const myElement5 = document.getElementById('addbtn');
            myElement5.style.backgroundColor = '#f76707';
            myElement5.innerHTML = 'Add Task ↘️';
            const myElement6 = document.getElementById('viewbtn');
            myElement6.style.backgroundColor = 'green';
            myElement6.innerHTML = 'View Task';
            mytoggle();
        }
        function viewtask() {
            const myElement3 = document.getElementById('viewtask');
            myElement3.classList.add('view');
            const myElement4 = document.getElementById('addtask');
            myElement4.classList.remove('view');
            const myElement7 = document.getElementById('addbtn');
            myElement7.style.backgroundColor = 'green';
            myElement7.innerHTML = 'Add Task';
            const myElement8 = document.getElementById('viewbtn');
            myElement8.style.backgroundColor = '#f76707';
            myElement8.innerHTML = 'View Task ↗️';
            mytoggle();
        }
    </script>
</body>

</html>