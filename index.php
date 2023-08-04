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
        <button class="options" onclick="viewtask()" id="viewbtn" style="border-bottom-right-radius: 20px;">View Tasks</button> 
    </div>

    <div class="container" id="addtask">
        <h1>Task Management</h1>
        <form class="task-form">
            <div class="form-group">
                <label for="task-title">Task Title:</label>
                <input type="text" id="task-title" name="task-title" placeholder="Enter task title" required>
            </div>
            <div class="form-group">
                <label for="task-priority">Task Priority:</label>
                <select id="task-priority" name="task-priority" required>
                    <option value="low">Low</option>
                    <option value="medium">Medium</option>
                    <option value="high">High</option>
                </select>
            </div>
             <div class="form-group">
                <label for="due-date">Due Date:</label>
                <input type="date" id="due-date" name="due-date" required> 
            </div>
            <div class="form-group">
                <label for="task-message">Task Message:</label>
                <textarea id="task-message" name="task-message" rows="5" maxlength="1000" placeholder="Write your task message (maximum 1000 characters)" required></textarea>
            </div>
            <button type="submit">Submit</button>
        </form>
    </div>

    <div class="container view" id="viewtask">
        <h1>My Task</h1>
        <form class="task-form">
            <div class="form-group">
                <label for="task-title">Task Title:</label>
                <input type="text" id="task-title" name="task-title" placeholder="Enter task title" required>
            </div>
            <div class="form-group">
                <label for="task-priority">Task Priority:</label>
                <select id="task-priority" name="task-priority" required>
                    <option value="low">Low</option>
                    <option value="medium">Medium</option>
                    <option value="high">High</option>
                </select>
            </div>
             <div class="form-group">
                <label for="due-date">Due Date:</label>
                <input type="date" id="due-date" name="due-date" required> 
            </div>
            <div class="form-group">
                <label for="task-message">Task Message:</label>
                <textarea id="task-message" name="task-message" rows="5" maxlength="1000" placeholder="Write your task message (maximum 1000 characters)" required></textarea>
            </div>
            <button type="submit">Submit</button>
        </form>
    </div>

    <script type="text/javascript">
        viewtask();
        function mytoggle(){
            const myElement = document.getElementById('myElement'); 
            myElement.classList.toggle('toggle'); 
            var val = document.getElementById('option').innerHTML;
            if (val == 'Show 🫣') {
                document.getElementById('option').innerHTML = "Hide 🙈";
            }
            else{
                document.getElementById('option').innerHTML = "Show 🫣";
            }
        }
        function addtask(){
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
        function viewtask(){
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