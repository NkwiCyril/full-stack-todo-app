<?php
include "partials/header.php";
require "database_conn.php";

if (isset($_POST["add"])) {
    if (!empty($_FILES["image-file"]) && !empty($_POST["title"]) && !empty($_POST["description"])) {
        # code...
        $title = $_POST["title"];
        $description = $_POST["description"];
        $file = $_FILES["image-file"]["name"];

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

            // sql query to insert created task
            $query = "INSERT INTO tasks (title, description,image_link) VALUES ('$title', '$description', '$new_image_name')";

            // catch any unexpected errors
            try {
                mysqli_query($conn, $query);
                // upload file
                move_uploaded_file($_FILES["image-file"]["tmp_name"], $image_upload_path);  
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

<style>

  .max-words {
    display: flex;
    justify-content: right;
  }
  .max-words p {
    font-size: 15px;
    color: black;
  }
</style>


<section class="container">
  <div class="form">
    <h1>Add Task</h1>
    <form enctype="multipart/form-data" action="create.php" method="POST">
      <label for="image">Upload image: </label>
      <input name="image-file" type="file" accept=".png, .jpg, .jpeg" onchange="handleFileSelect(event)" required />
			<div id="image-preview"></div>
      <label for="title">Title:</label>
      <input id="title" type="text" name="title" placeholder="Input task title" autocomplete="off" maxlength="50" autofocus required/>
      <div class="max-words">
        <p><span class="words-entered" >0</span>/50</p>
      </div>
      <label for="title">Description:</label>
      <textarea name="description" id="description" cols="30" rows="5" placeholder="Input task description" required ></textarea>
      <div class="max-words">
        <p><span class="words-entered-des" >0</span>/1500</p>
      </div>
      <input type="submit" value="Add Task" class="btn" name="add" >
    </form>
  </div>
</section>


<script>
  function handleFileSelect(event) {
    const file = event.target.files[0];
    const reader = new FileReader();
    reader.onload = function(e) {
      const imagePreview = document.getElementById("image-preview");
      imagePreview.innerHTML = `<img src="${e.target.result}" alt="Selected image" style="max-width: 100%; max-height: 100px;">`;
    };
    reader.readAsDataURL(file);
  }

  var numberOfWordsTitle = 0;
  var wordsEntered = $(".words-entered");
  var numberOfWords = 0;
  var wordsEnteredDes = $(".words-entered-des")

  $("#title").keydown(function(event) {
    if(event.key != "Backspace" || event.key != "Delete")
     {
      numberOfWordsTitle++;
      wordsEntered.html(numberOfWordsTitle);
    }
    if (event.key == "Backspace") {
      numberOfWordsTitle--;
      wordsEntered.html(numberOfWordsTitle)
    }
  });

  $("#description").keydown(function(event) {
    if(event.key != "Backspace" || event.key != "Delete")
     {
      numberOfWords++;
      wordsEnteredDes.html(numberOfWords);
    }
    if (event.key == "Backspace") {
      numberOfWords--;
      wordsEnteredDes.html(numberOfWords)
    }
  });

</script>

<?php
include "partials/footer.php";
?>