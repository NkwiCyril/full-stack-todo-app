<?php
include "partials/header.php";
require "database_conn.php";

// Initialize variables
$title = $description = $status = "";

if(isset($_GET["id"])) {
    $id = $_GET["id"];

    // Fetch task details from database
    $query = "SELECT * FROM tasks WHERE id=$id";
    $result = mysqli_query($conn, $query);

    // Check if task exists
    if(mysqli_num_rows($result) > 0) {
        $task = mysqli_fetch_assoc($result);
        $title = $task["title"];
        $description = $task["description"];
    } else {
        echo "Task not found.";
        exit();
    }
}

if (isset($_POST["edit"])) {
    // Check if title and description are provided
    if(!empty($_POST["title"]) && !empty($_POST["description"])) {
        $title = $_POST["title"];
        $description = $_POST["description"];

        // Check if image file is uploaded
        if(!empty($_FILES["image-file"]["name"])) {
            $file = $_FILES["image-file"]["name"];
            $target_dir = "images/";
            $target_file = $target_dir . basename($file);
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            $new_image_name = uniqid("IMG-", true) . "." . $imageFileType;
            $image_upload_path = $target_dir . $new_image_name;

            // Check file format
            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
                echo "<b>Only JPG, JPEG and PNG files are allowed.</b>";
            } else {
                // Upload image file
                if(move_uploaded_file($_FILES["image-file"]["tmp_name"], $image_upload_path)) {
                    // Update task with new image
                    $query = "UPDATE tasks SET title='$title', description='$description', image_link='$new_image_name' WHERE id=$id";
                } else {
                    echo "<b>Failed to upload image.</b>";
                }
            }
        } else {
            // Update task without changing image
            $query = "UPDATE tasks SET title='$title', description='$description' WHERE id=$id";
        }

        // Execute query to update task
        if(mysqli_query($conn, $query)) {
            header("Location: index.php");
            exit();
        } else {
            echo "<b>Error updating task: " . mysqli_error($conn) . "</b>";
        }
    } else {
        echo "<b>Title and description are required.</b>";
    }
}

?>

<!-- Form display -->
<section class="container">
  <div class="form">
    <h1>Update Task</h1>
    <h4><?php if (!empty($task["image_link"])) {echo "(Previous image is already set. You can set a new one)";} else {echo "Set new image";}?></h4>
    <form enctype="multipart/form-data" action="edit.php?id=<?php echo $id ?>" method="POST">
      <div>
        <label for="image-file"><b>Upload Image:</b></label>
        <input type="file" name="image-file" />
      </div>
      <label for="title"><b>Title:</b></label>
      <input type="text" name="title" value="<?php echo $title ?>" autocomplete="off" autofocus required/>
      <label for="description"><b>Description:</b></label>
      <textarea name="description" id="description" cols="30" rows="5" required><?php echo $description ?></textarea>
      <input type="submit" value="Update" class="btn" name="edit">
    </form>
  </div>
</section>

<?php
include "partials/footer.php";
?>
