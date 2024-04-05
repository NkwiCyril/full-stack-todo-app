<?php
include "partials/header.php";
require 'database_conn.php';

$sql_query = "SELECT * FROM tasks WHERE done_time is null ORDER BY id DESC";
$res = mysqli_query($conn, $sql_query);


?>
<div class="container">
  <header>

  </header>
  <section class="task-display">
    <aside class="status to-do">
      <div class="flex-me">
        <h3><span class="material-symbols-outlined"> list_alt </span>To Do (<?php echo mysqli_num_rows($res) ?>)</h3>
        <a href="create.php"><button class="add-button">
            <span class="material-symbols-outlined" id="add">
              add_circle
            </span>
          </button></a>
      </div>
      <hr />
      <?php
if (mysqli_num_rows($res) > 0) {
    while ($row = mysqli_fetch_assoc($res)) {?>
      <a href="view.php?id=<?php echo $row["id"] ?>" class="view-card" >
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
              <div class="description">
                <?php
        $des = $row["description"];
        $len = strlen($des);
        if ($len > 50) {
            $des = substr($des, 0, 50) . "<b>...</b>";
            echo $des;
        } else {
            echo $des;
        }
        ?>
              </div>
            </div>
            <div class="btns-datetime">
              <p class="datetime">Created on <?php echo $row["created_time"] ?></p>
              <div class="buttons">

                <a href="edit.php?id=<?php echo $row["id"] ?>">
                  <button class="edit-button" title="Edit task">
                    <span class="material-symbols-outlined"> border_color </span>
                  </button>
                </a>

                <a href="delete.php?id=<?php echo $row["id"] ?>">
                  <button class="delete-button" title="Delete task">
                    <span class="material-symbols-outlined"> delete </span>
                  </button>
                </a>

              </div>
            </div>
          </div>
        </div>
      </a>

      <?php }
} else {
    echo "<em>All tasks to be done will display here.</em>";
}?>
    </aside>

    <?php
    $query = "SELECT * FROM tasks WHERE done_time is not null ORDER BY id DESC";
    $respond = mysqli_query($conn, $query);
    ?>

    <aside class="status done">
      <div class="flex-me">
        <h3><span class="material-symbols-outlined"> done </span>Done (<?php echo mysqli_num_rows($respond) ?>)</h3>
        <button class="hide">
            <span class="material-symbols-outlined" id="add">
              visibility_off
            </span>
          </button>
      </div>
      <hr />

      <?php
if (mysqli_num_rows($respond) > 0) {
    while ($task = mysqli_fetch_assoc($respond)) {?>
      <div class="task-card" id="complete" >
        <div class="image">
          <img src="images/<?php echo $task["image_link"] ?>" alt="task-image">
        </div>
        <div class="task-content">
          <div class="status-buttons">
            <h1 class="task-title"><s><?php echo $task["title"] ?></s></h1>

            <a href="revert.php?id=<?php echo $task["id"] ?>">
              <button class="add-button" title="revert">
                <span class="material-symbols-outlined done-btn"> change_circle </span>
              </button>
            </a>

          </div>
          <div class="task-space">
            <div class="description"><s>
                <?php
        $des = $task["description"];
        $len = strlen($des);
        if ($len > 50) {
            $des = substr($des, 0, 50) . "<b>...</b>";
            echo $des;
        } else {
            echo $des;
        }
        ?>
              </s></div>
          </div>
          <div class="btns-datetime">
            <p class="datetime">Completed on <?php echo $task["done_time"] ?></p>
            <div class="buttons">
              <a href="delete.php?id=<?php echo $task["id"] ?>">
                <button class="delete-button" title="Delete task">
                  <span class="material-symbols-outlined"> delete </span>
                </button>
              </a>
            </div>
          </div>
        </div>
      </div>
      <?php }
} else {
    echo "<em>Completed tasks will display here.</em>";
}?>
    </aside>
  </section>
</div>

<?php
include "partials/footer.php";
?>
