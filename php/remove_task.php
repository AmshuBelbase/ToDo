<?php
if (isset($_POST["incoming_id"])) {
    include "connect.php";
    $id = $_POST["incoming_id"];
    $q = mysqli_query($con, "DELETE FROM todo WHERE id = '$id'");
    if ($q == true) {

        $output = "<tr>
            <th>S.N</th>
            <th>Title</th>
            <th>Due Date</th>
            <th>Remaining Days</th>
            <th>Priority</th>
            <th>Task Message</th>
            <th>❌</th>
        </tr>";

        $fetch = mysqli_query($con, "SELECT * FROM todo WHERE name ='$idname' and email='$idemail'");
        if (mysqli_num_rows($fetch) > 0) {
            $count = 0;
            while ($row = mysqli_fetch_assoc($fetch)) {
                $count++;
                $today = time();
                $due_date = $row['due'];
                $due_date_stamp = strtotime($due_date);
                $date_diff = $due_date_stamp - $today;
                $int_day = intval($date_diff / 86400);
                if ($int_day < ($date_diff / 86400)) {
                    $int_day += 1;
                }
                $output .= '<tr>
                <td>
                    ' . $count . '
                </td>
                <td>
                    ' . $row["title"] . '
                </td>

                <td>
                    ' . $row["due"] . '
                </td>
                <td> 
                    ' . $int_day . '
                </td>
                <td>
                    ' . $row["priority"] . '
                </td>
                <td>
                    ' . $row["message"] . '
                </td>
                <td>
                    <button class="button button1" onclick="ajaxCall(' . $row["id"] . ')">
                        Remove
                    </button>
                </td>
            </tr>';


            }
        }
        ?>
        <?php
        echo $output;
    }
}

?>