$(function() {
  $("#applybtn").on('click', function() {
    $('#exampleModal2').modal('hide')
    $.blockUI({
      message: '<h1>Sending your white paper<br/>This may take a few moments...</h1>'
    });
    $.ajax({
      url: "apply.php",
      type: "POST",
      data: new FormData($('#applyform')[0]),
      processData: false,
      contentType: false,
      error: function() {
        $.unblockUI();
        swal("Oops!", "Something went wrong while sending white paper!", "error")
      },
      success: function(response) {
        $.unblockUI();
        if (response === "success") {
          swal("Cheers!", "We received your message!", "success")
        } else {
          swal("Oops!", response, "error")
        }
      }
    });
  });
});
