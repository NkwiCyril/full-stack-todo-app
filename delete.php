<?php
require 'database_conn.php';

if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $sql_query = "DELETE FROM tasks WHERE id=$id";

    try {
        $response = mysqli_query($conn, $sql_query);
        
        header("Location: index.php");
    } catch (mysqli_sql_exception $e) {
        echo "Unable to delete todo item: " . $e->getMessage() . "<br>";
        echo "Go back and try again.";
    }
    $conn = null;
    exit;
}
