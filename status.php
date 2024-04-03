<?php
include("partials/header.php");

require 'database_conn.php';

if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $sql_query = "UPDATE tasks SET status='done' WHERE id=$id";

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
