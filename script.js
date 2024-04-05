$(document).ready(function () {
  $(".delete-button").on("click", function () {
    const id = $(this).attr("id");
    bootbox.confirm(
      "Are you sure you want to delete this task?",
      function (result) {
        if (result) {
          $.post(
            "delete.php",
            {
              // post task id to the delete file in order to run the necessary query
              id: id,
            },
            (response) => {
              response
                ? setTimeout(() => {
                    window.location.replace("index.php")
                  }, 500)
                : alert("Unable to delete task at the moment!");
            }
          );
        }
      }
    );
  });
});
