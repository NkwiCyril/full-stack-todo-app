$(document).ready(function () {
  const id = $(".delete-button").attr("id");

  $(".delete-button").on("click", function () {
    $(".alert").css("display", "flex");
    $("body").css("backdrop-filter", "brightness(50%)");
    $(".container").css("filter", "brightness(50%)");
  });

  $("#cancel").click(function () {
    $(".alert").css("display", "none");
    $("body").css("backdrop-filter", "none");
    $(".container").css("filter", "none");
  });

  $("#delete").click(function () {
    $.post(
      "delete.php",
      {
        // post task id to the delete file in order to run the necessary query
        id: id,
      },
      (response) => {
        if (response) {
          window.location.replace("index.php");
        } else {
          alert("Unable to delete task at the moment! Try again later");
        }
      }
    );
    $("body").css("backdrop-filter", "none");
    $(".container").css("filter", "none");
  });
});

 