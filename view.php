<?php 
require 'database_conn.php';
include("partials/header.php");
?>
<aside class="status to-do">
      <div class="flex-me">
        <h3><span class="material-symbols-outlined"> list_alt </span>To Do</h3>
        <a href="create.php"><button class="add-button">
          <span class="material-symbols-outlined" id="add">
            add_circle
          </span>
        </button></a>
      </div>
      <hr />
      <?php

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
              <button class="edit-button" title="Edit task">
                <span class="material-symbols-outlined"> border_color </span>
              </button>
              <a href="delete.php?id=<?php echo $row["id"] ?>">
              <button class="delete-button" title="Delete task">
                <span class="material-symbols-outlined"> delete </span>
              </button>
              </a>
              <a href="view.php?id=<?php echo $row["id"] ?>">
              <button class="view-button" title="Delete task">
                <span class="material-symbols-outlined"> visibility
                </span>
              </button>
              </a>
            </div>
          </div>
        </div>

      </div>
      <?php }
} else {
    echo "<em>All tasks  to be done will display here.</em>";
}?>
</aside>
<?php 
include("partials/footer.php");
?>