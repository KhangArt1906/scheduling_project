// change_room.js
function confirmChangeRoom() {
  var booking_id = document.getElementById("bookingID").value;
  var teacher_id = document.getElementById("customerSelect").value;
  var old_room_id = document.getElementById("oldRoom").value; // Thêm dòng này
  var new_room_id = document.getElementById("newRoom").value;

  var formData = new FormData();
  formData.append("changeRoom", true);
  formData.append("booking_id", booking_id);
  formData.append("teacher_id", teacher_id);
  formData.append("old_room_id", old_room_id);
  formData.append("new_room_id", new_room_id);

  $.ajax({
    type: "post",
    url: "./change_room.php",
    dataType: "JSON",
    data: formData,
    processData: false,
    contentType: false,
    success: function (response) {
      if (response.done) {
        alert(response.data);
        $("#changeRoomModal").modal("hide");
        location.reload();
      } else {
        alert("Error: " + response.data);
      }
    },
    error: function (xhr, ajaxOptions, thrownError) {
      console.log(xhr);
      console.log(ajaxOptions);
      console.error("Error:", thrownError);
    },
  });
}
