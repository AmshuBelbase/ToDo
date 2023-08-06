<?php
if (isset($_POST["incoming_id"])) {

    if (isset($_COOKIE["idname"]) && isset($_COOKIE["id"])) {
        $idname = $_COOKIE["idname"];
        $id = $_COOKIE["id"];
        include "connect.php";
        $id = $_POST["incoming_id"];
        $q = mysqli_query($con, "DELETE FROM todo WHERE id = '$id'");
        if ($q == true) {

        }
    }
}
?>