<?php

include("partials/header.php");

require 'database_conn.php';

if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $sql_query = "UPDATE tasks SET done_time=NULL WHERE id=$id";

    try {
        $response = mysqli_query($conn, $sql_query);

        header("Location: index.php");

    } catch (mysqli_sql_exception $e) {
        echo "<b>Unable to revert todo item at the moment: " . $e->getMessage() . "<br>";
        echo "Try again later.</b>";
    }
    $conn = null;
    exit;
}
