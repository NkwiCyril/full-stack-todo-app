<?php
include "partials/header.php";
require "database_conn.php";

if (isset($_POST["add"])) {
    if (!empty($_FILES["image-file"]) && !empty($_POST["title"]) && !empty($_POST["description"])) {
        # code...
        $title = $_POST["title"];
        $description = $_POST["description"];
        $file = $_FILES["image-file"]["name"];

        // each task at the point of creation is undone (todo)
        $status = "todo";

        $target_dir = "images/";
        $target_file = $target_dir . basename($file);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // check if the file to be uploaded has correct extension
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
            echo "<b>Only JPG, JPEG and PNG files are allowed.</b>";
        } else {
            // generate unique image names for each image file
            $new_image_name = uniqid("IMG-", true) . "." . $imageFileType;
            // path the image is to be uploaded to
            $image_upload_path = $target_dir . $new_image_name;
            // upload file
            move_uploaded_file($_FILES["image-file"]["tmp_name"], $image_upload_path);

            // sql query to insert created task
            $query = "INSERT INTO tasks (title, description, status,image_link)
                      VALUES ('$title','$description','$status','$new_image_name')";

            // catch any unexpected errors
            try {
                mysqli_query($conn, $query);
                header("Location: index.php");
            } catch (mysqli_sql_exception $e) {
                echo "Unable to add task: " . $e->getMessage();
            }
        }

    } else {
        echo "All fields must be set in order to proceed.";
    }
}
?>


<section class="container">
  <div class="form">
    <h1>Add Task</h1>
    <form enctype="multipart/form-data" action="create.php" method="POST">
      Upload image: <input name="image-file" type="file" required />
      <label for="title">Title:</label>
      <input type="text" name="title" placeholder="Input task title" autocomplete="off" autofocus required/>
      <label for="title">Description:</label>
      <textarea name="description" id="description" cols="30" rows="5" placeholder="Input task description" required ></textarea>
      <input type="submit" value="Add Task" class="btn" name="add" >
    </form>
  </div>
</section>


<?php
// !empty($_POST["image-file"]) &&
include "partials/footer.php";

?>