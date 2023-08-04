<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Management</title>
    <link rel="stylesheet" href="css/mycss.css">
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

    <div class="container" id="addtask">
        <h1>Add Task</h1>
        <form action="index.php" class="task-form" method="POST" onsubmit="return subTask()">
            <div class="form-group">
                <label for="task-title">Task Title:</label>
                <input type="text" id="task-title" name="task-title" placeholder="Enter task title">
                <span id="title_success" class="success"></span>
                <span id="title_error" class="error"></span>
            </div>
            <div class="form-group">
                <label for="task-priority">Task Priority:</label>
                <select id="task-priority" name="task-priority">
                    <option value="low">Low</option>
                    <option value="medium">Medium</option>
                    <option value="high">High</option>
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
                <textarea id="task-message" name="task-message" rows="5" maxlength="1000"
                    placeholder="Write your task message (maximum 1000 characters)"></textarea>
                <span id="message_success" class="success"></span>
                <span id="message_error" class="error"></span>
            </div>
            <button type="submit">Submit</button>
        </form>
    </div>

    <div class="container view" id="viewtask">

    </div>

    <script type="text/javascript">
        viewtask();
        function subTask() {
            var title = document.getElementById("task-title").value;
            var priority = document.getElementById("task-priority").value;
            var date = document.getElementById("due-date").value;
            var message = document.getElementById("task-message").value;
            if (title == '' || priority == '' || date == '' || message == '') {
                if (title == '') {
                    document.getElementById("title_error").innerHTML = "Task Title can't be blank ❌";
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
            const myElement6 = document.getElementById('viewbtn');
            myElement6.style.backgroundColor = 'green';

            mytoggle();
        }
        function viewtask() {
            const myElement3 = document.getElementById('viewtask');
            myElement3.classList.add('view');
            const myElement4 = document.getElementById('addtask');
            myElement4.classList.remove('view');
            const myElement7 = document.getElementById('addbtn');
            myElement7.style.backgroundColor = 'green';
            const myElement8 = document.getElementById('viewbtn');
            myElement8.style.backgroundColor = '#f76707';
            mytoggle();
        }
    </script>
</body>

</html>