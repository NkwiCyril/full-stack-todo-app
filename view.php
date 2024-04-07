<?php
require 'database_conn.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/view.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <title>Task Manager</title>
</head>
<body>

<div class="alert" style="display: none;">
  <div class="alert-container">
    <p>Are you sure you want to delete this task?</p>
    <div class="btns">
      <button id="cancel">Cancel</button>
      <button id="delete">Delete</button>
    </div>
  </div>
</div>

<div class="container">
  <section class="task-display">
    <aside class="status to-do">

<?php
require 'database_conn.php';

$id = $_GET["id"];
$sql_query = "SELECT * FROM tasks WHERE id=$id";
$res = mysqli_query($conn, $sql_query);
?>
      <?php
if (mysqli_num_rows($res) > 0) {
    while ($row = mysqli_fetch_assoc($res)) {?>
      <div class="task-card gray">
        <div class="image">
          <img src="images/<?php echo $row["image_link"] ?>" alt="task-image">
        </div>
        <div class="task-content">
          <div class="status-buttons">
            <h1 class="task-title"><?php echo $row["title"] ?></h1>
            <a href="status.php?id=<?php echo $row["id"] ?>">
                <button class="edit-button" title="mark as done">
                  <span class="material-symbols-outlined not-started-btn"> done </span>
                </button>
              </a>
          </div>
          <div class="task-space">
            <div class="description"><?php echo $row["description"] ?></div>
          </div>
          <div class="btns-datetime">
            <p class="datetime"><?php echo $row["created_time"] ?></p>
            <div class="buttons">

						<a href="edit.php?id=<?php echo $row["id"] ?>">
							<button class="edit-button" title="Edit task">
                <span class="material-symbols-outlined"> border_color </span>
              </button>
						</a>

              <button class="delete-button" title="Delete task" id="<?php echo $row["id"] ?>" >
                <span class="material-symbols-outlined"> delete </span>
              </button>
            </div>
          </div>
        </div>

      </div>
      <?php }
} else {
    echo "<em>All tasks  to be done will display here.</em>";
}?>
    </aside>
    </section>
</div>

<?php
include "partials/footer.php";
?>