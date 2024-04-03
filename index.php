<?php
include "partials/header.php";
?>
<div class="container">
  <header>

  </header>
  <section class="task-display">
    <aside class="status to-do">
      <div class="flex-me">
        <h3><span class="material-symbols-outlined"> list_alt </span>To Do</h3>
        <button class="add-button">
          <span class="material-symbols-outlined" id="add">
            add_circle
          </span>
        </button>
      </div>

      <hr />
      <?php
require 'database_conn.php';

$sql_query = "SELECT * FROM tasks WHERE status='todo'";
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
            <button class="delete-button" title="mark as done">
              <span class="material-symbols-outlined done-btn"> done </span>
            </button>
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
              <button class="delete-button" title="Delete task">
                <span class="material-symbols-outlined"> delete </span>
              </button>
              <button class="view-button" title="Delete task">
                <span class="material-symbols-outlined"> visibility
                </span>
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

    <aside class="status done">
      <div class="flex-me">
        <h3 class="done"><span class="material-symbols-outlined"> done </span>Done</h3>
      </div>
      <hr />
      <div class="task-card gray">
        <div class="image">
          <img src="assets/images/mountain.jpg" alt="task-image">
        </div>
        <div class="task-content">
          <div class="status-buttons">
            <h1 class="task-title"><s>Morning Routine</s></h1>
            <button class="edit-button" title="revert">
              <span class="material-symbols-outlined done-btn"> list_alt </span>
            </button>
          </div>
          <div class="task-space">
            <div class="description"><s>Wake up at 2am this morning</s></div>
          </div>
          <div class="btns-datetime">
            <p class="datetime">4:15AM</p>
            <div class="buttons">
              <button class="delete-button" title="Delete task">
                <span class="material-symbols-outlined"> delete </span>
              </button>
              <button class="view-button" title="Delete task">
                <span class="material-symbols-outlined"> visibility
                </span>
              </button>
            </div>
          </div>
        </div>

      </div>
    </aside>
  </section>
</div>

<?php

include "partials/footer.php";

?>