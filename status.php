<?php
include("partials/header.php");

require 'database_conn.php';

$date = date('Y-m-d h:i:s');

if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $sql_query = "UPDATE tasks SET done_time=CURRENT_TIMESTAMP WHERE id=$id";

    try {
        $response = mysqli_query($conn, $sql_query);

        header("Location: index.php");
    } catch (mysqli_sql_exception $e) {
        echo "<b>Unable to update todo item: " . $e->getMessage() . "<br>";
        echo "Go back and try again.</b>";
    }
    $conn = null;
    exit;
}
