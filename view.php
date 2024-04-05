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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/6.0.0/bootbox.min.js" integrity="sha512-oVbWSv2O4y1UzvExJMHaHcaib4wsBMS5tEP3/YkMP6GmkwRJAa79Jwsv+Y/w7w2Vb/98/Xhvck10LyJweB8Jsw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js" integrity="sha512-2rNj2KJ+D8s1ceNasTIex6z4HWyOnEYLVC3FigGOmyQCZc2eBXKgOxQmo3oKLHyfcj53uz4QMsRCWNbLd32Q1g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <title>Task Manager</title>
</head>
<body>

<div class="container">
  <header>

  </header>
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

<script src="script.js"></script>

<?php
include "partials/footer.php";
?>