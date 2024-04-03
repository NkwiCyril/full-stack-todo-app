<?php
require 'database_conn.php';

if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $sql_query = "UPDATE tasks SET status='todo' WHERE id=$id";

    try {
        $response = mysqli_query($conn, $sql_query);

        header("Location: index.php");

    } catch (mysqli_sql_exception $e) {
        echo "Unable to revert todo item at the moment: " . $e->getMessage() . "<br>";
        echo "Try again later.";
    }
    $conn = null;
    exit;
}
