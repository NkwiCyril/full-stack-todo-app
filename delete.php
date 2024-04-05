<?php
include "partials/header.php";

if (isset($_POST["id"])) {
    require 'database_conn.php';

    $id = $_POST["id"];

    // if no task id is sent
    if (empty($id)) {
        echo 0;
    } else {
        $sql_query = "DELETE FROM tasks WHERE id=$id";

        try {
            $response = mysqli_query($conn, $sql_query);

            // since response is a bool, check if execution returns 1
            if ($response) {
                echo 1;
            } else {
                echo 0;
            }
        } catch (mysqli_sql_exception $e) {
            echo "Unable to delete todo item: " . $e->getMessage() . "<br>";
            echo "Go back and try again.";
        }

        $conn = null;
        exit;
    }
}
