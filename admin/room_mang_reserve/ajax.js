$("#addRoom").submit(function () {
  var room_type_id = $("#room_type_id").val();
  var room_no = $("#room_no").val();

  $.ajax({
    type: "post",
    url: "ajax_room.php",
    dataType: "JSON",
    data: {
      room_type_id: room_type_id,
      room_no: room_no,
      add_room: "",
    },
    success: function (response) {
      if (response.done == true) {
        $("#addRoom").modal("hide");
        window.location.href = "room_mang.php";
      } else {
        $(".response").html(
          '<div class="alert bg-danger alert-dismissable" role="alert"><em class="fa fa-lg fa-warning">&nbsp;</em>' +
            response.data +
            "</div>"
        );
      }
    },
  });

  return false;
});

$("#roomEditFrom").submit(function () {
  var room_type_id = $("#edit_room_type").val();
  var room_no = $("#edit_room_no").val();
  var room_id = $("#edit_room_id").val();

  $.ajax({
    type: "post",
    url: "ajax_room.php",
    dataType: "JSON",
    data: {
      room_type_id: room_type_id,
      room_no: room_no,
      room_id: room_id,
      edit_room: "",
    },
    success: function (response) {
      if (response.done == true) {
        $("#editRoom").modal("hide");
        window.location.href = "room_mang.php";
      } else {
        $(".response").html(
          '<div class="alert bg-danger alert-dismissable" role="alert"><em class="fa fa-lg fa-warning">&nbsp;</em>' +
            response.data +
            "</div>"
        );
      }
    },
  });

  return false;
});

$(document).on("click", "#roomEdit", function (e) {
  e.preventDefault();

  var room_id = $(this).data("id");

  console.log(room_id);

  $.ajax({
    type: "post",
    url: "ajax_room.php",
    dataType: "JSON",
    data: {
      room_id: room_id,
      room: "",
    },
    success: function (response) {
      if (response.done == true) {
        $("#edit_room_type").val(response.room_type_id);
        $("#edit_room_no").val(response.room_no);
        $("#edit_room_id").val(room_id);
      } else {
        $(".edit_response").html(
          '<div class="alert bg-danger alert-dismissable" role="alert"><em class="fa fa-lg fa-warning">&nbsp;</em>' +
            response.data +
            "</div>"
        );
      }
    },
  });
});

function fetch_room(val) {
  $.ajax({
    type: "post",
    url: "./ajax_room.php",
    data: {
      room_type_id: val,
      room_type: "",
    },
    success: function (response) {
      $("#room_no").html(response);
    },
  });
}

function fetch_return(val) {
  $.ajax({
    type: "post",
    url: "ajax_room.php",
    data: {
      room_id: val,
      room_return: "",
    },
    success: function (response) {
      $("#return").html(response);
      //var days = document.getElementById("staying_day").innerHTML;
      $("#total_response").html(response);
    },
  });
}

function fetch_cpu(val) {
  $.ajax({
    type: "post",
    url: "./ajax_room.php",
    data: {
      room_type_id: val,
      room_type_cpu: "",
    },
    success: function (response) {
      $("#cpu").html(response);
    },
  });
}

function fetch_ram(val) {
  $.ajax({
    type: "post",
    url: "./ajax_room.php",
    data: {
      room_type_id: val,
      room_type_ram: "",
    },
    success: function (response) {
      $("#ram").html(response);
    },
  });
}

function fetch_max_person(val) {
  $.ajax({
    type: "post",
    url: "./ajax_room.php",
    data: {
      room_type_id: val,
      room_max_person: "",
    },
    success: function (response) {
      $("#max_person").html(response);
    },
  });
}

$("#booking").submit(function () {
  var room_type_id = $("#room_type").val();
  var room_type = $("#room_type :selected").text();
  var room_id = $("#room_no").val();
  var room_no = $("#room_no :selected").text();
  var check_in_date = $("#check_in_date").val();
  var check_out_date = $("#check_out_date").val();
  var time_start = $("#time_start").val();
  var time_end = $("#time_end").val();

  // Customer Details
  // var salut = $("#salut").val();
  // var first_name = $("#first_name").val();
  // var last_name = $("#last_name").val();
  // var contact_no = $("#contact_no").val();
  // var email = $("#email").val();
  var term_id = $("#term_id").val();
  var class_term_id = $("#class_term_id").val();
  var teacher_name = $("#teacher_name").val();
  var term_title = $("#term_title").val();
  var ordinal_class_term = $("#ordinal_class_term").val();
  var quantity_students = $("#quantity_students").val();
  var software_name = $("#software_name").val();
  var time_day = $("#time_day").val();
  var time_lesson = $("#time_lesson").val();
  var time_week = $("#time_week").val();
  var software_category = $("#software_category").val();
  //var department = $("#department").val();
  var total_response = document.getElementById("total_response").innerHTML;

  if (
    !room_no &&
    !teacher_name &&
    !class_term_id &&
    !term_id &&
    !quantity_students
  ) {
    $(".response").html(
      '<div class="alert bg-danger alert-dismissable" role="alert"><em class="fa fa-lg fa-warning">&nbsp;</em>Please Fill Cardinality</div>'
    );
  } else {
    $.ajax({
      type: "post",
      url: "./ajax_room.php",
      dataType: "JSON",
      data: {
        room_type_id: room_type_id,
        room_id: room_id,
        check_in: check_in_date,
        check_out: check_out_date,
        time_start: time_start,
        time_end: time_end,
        total_response: total_response,
        // salut: salut,
        // name: first_name + " " + last_name,
        // contact_no: contact_no,
        // email: email,

        term_id: term_id,
        class_term_id: class_term_id,
        ordinal_class_term: ordinal_class_term,
        teacher_name: teacher_name,
        term_title: term_title,
        quantity_students: quantity_students,
        software_name: software_name,
        time_day: time_day,
        time_lesson: time_lesson,
        time_week: time_week,
        software_category: software_category,
        // department: department,

        booking: "",
      },
      success: function (response) {
        if (response.done == true) {
          // $("#getSalut").html(salut);

          $("#getTermID").html(term_id);
          $("#getTeacherName").html(teacher_name);
          $("#getOrdinalClassTerm").html(ordinal_class_term);
          $("#getRoomType").html(room_type);
          $("#getRoomNo").html(room_no);
          $("#getCheckIn").html(check_in_date);
          $("#getCheckOut").html(check_out_date);
          $("#getTimeStart").html(time_start);
          $("#getTimeEnd").html(time_end);
          $("#getTotalResponse").html(total_response);
          $("#bookingConfirm").modal("show");
          document.getElementById("booking").reset();
        } else {
          $(".response").html(
            '<div class="alert bg-danger alert-dismissable" role="alert"><em class="fa fa-lg fa-warning">&nbsp;</em>' +
              response.data +
              "</div>"
          );
        }
      },
    });
  }

  return false;
});

$(document).on("click", "#customerDetails", function (e) {
  e.preventDefault();

  var room_id = $(this).data("id");
  // alert(room_id);
  console.log(room_id);

  $.ajax({
    type: "post",
    url: "ajax_room.php",
    dataType: "JSON",
    data: {
      room_id: room_id,
      customerDetails: "",
    },
    success: function (response) {
      if (response.done == true) {
        // $("#customer_salut").html(response.salut);
        // $("#customer_contact_no").html(response.contact_no);
        // $("#customer_email").html(response.email);
        $("#customer_term_id").html(response.term_id);
        $("#customer_class_term_id").html(response.class_term_id);
        $("#customer_teacher_name").html(response.teacher_name);
        $("#customer_term_title").html(response.term_title);
        $("#customer_ordinal_class_term").html(response.ordinal_class_term);
        $("#customer_quantity_students").html(response.quantity_students);
        $("#customer_software_name").html(response.software_name);
        $("#customer_time_day").html(response.time_day);
        $("#customer_time_lesson").html(response.time_lesson);
        $("#customer_time_week").html(response.time_week);
        $("#customer_software_category").html(response.software_category);

        // $("#customer_department").html(response.department);

        $("#remaining_response").html(response.remaining_response);
      } else {
        $(".edit_response").html(
          '<div class="alert bg-danger alert-dismissable" role="alert"><em class="fa fa-lg fa-warning">&nbsp;</em>' +
            response.data +
            "</div>"
        );
      }
    },
  });
});

$(document).on("click", "#checkInRoom", function (e) {
  e.preventDefault();

  var room_id = $(this).data("id");

  console.log(room_id);

  $.ajax({
    type: "post",
    url: "ajax_room.php",
    dataType: "JSON",
    data: {
      room_id: room_id,
      booked_room: "",
    },
    success: function (response) {
      if (response.done == true) {
        $("#room_id").val(room_id);
        $("#getCustomerName").html(response.teacher_name);
        $("#getRoomType").html(response.room_type);
        $("#getRoomNo").html(response.room_no);
        $("#getCheckIn").html(response.check_in);
        $("#getCheckOut").html(response.check_out);
        $("#getTimeStart").html(response.time_start);
        $("#getTimeEnd").html(response.time_end);
        $("#getTotalResponse").html(response.total_response + "/-");
        $("#getBookingID").val(response.booking_id);
        $("#checkIn").modal("show");
      } else {
        alert(response.data);
      }
    },
  });
});

$("#advanceReturn").submit(function () {
  var booking_id = $("#getBookingID").val();
  var advance_return = $("#advance_return").val();

  console.log(advance_return);

  $.ajax({
    type: "post",
    url: "ajax_room.php",
    dataType: "JSON",
    data: {
      booking_id: booking_id,
      advance_return: advance_return,
      check_in_room: "",
    },
    success: function (response) {
      if (response.done == true) {
        $("#checkIn").modal("hide");
        window.location.href = "room_mang.php";
      } else {
        $(".signal-response").html(
          '<div class="alert bg-danger alert-dismissable" role="alert"><em class="fa fa-lg fa-warning">&nbsp;</em>' +
            response.data +
            "</div>"
        );
      }
    },
  });

  return false;
});

$(document).on("click", "#checkOutRoom", function (e) {
  e.preventDefault();

  var room_id = $(this).data("id");

  $.ajax({
    type: "post",
    url: "ajax_room.php",
    dataType: "JSON",
    data: {
      room_id: room_id,
      booked_room: "",
    },
    success: function (response) {
      if (response.done == true) {
        $("#getCustomerName_n").html(response.teacher_name);
        $("#getRoomType_n").html(response.room_type);
        $("#getRoomNo_n").html(response.room_no);
        $("#getCheckIn_n").html(response.check_in);
        $("#getCheckOut_n").html(response.check_out);
        $("#getTimeStart_n").html(response.time_start);
        $("#getTimeEnd_n").html(response.time_end);
        $("#getTotalResponse_n").html(response.total_response + "/-");
        $("#getRemainingResponse_n").html(response.remaining_response + "/-");
        $("#getBookingId_n").val(response.booking_id);
        $("#checkOut").modal("show");
      } else {
        alert(response.data);
      }
    },
  });
});

$("#checkOutRoom_n").submit(function () {
  var booking_id = $("#getBookingId_n").val();
  var remaining_return = $("#remaining_return").val();

  console.log(booking_id);

  $.ajax({
    type: "post",
    url: "ajax_room.php",
    dataType: "JSON",
    data: {
      booking_id: booking_id,
      remaining_return: remaining_return,
      check_out_room: "",
    },
    success: function (response) {
      if (response.done == true) {
        $("#checkIn").modal("hide");
        window.location.href = "room_mang.php";
      } else {
        $(".checkout-response").html(
          '<div class="alert bg-danger alert-dismissable" role="alert"><em class="fa fa-lg fa-warning">&nbsp;</em>' +
            response.data +
            "</div>"
        );
      }
    },
  });

  return false;
});

$(document).on("click", "#complaint", function (e) {
  e.preventDefault();

  var complaint_id = $(this).data("id");
  console.log(complaint_id);
  $("#complaint_id").val(complaint_id);
});

$(document).on("click", "#change_shift", function (e) {
  e.preventDefault();

  var emp_id = $(this).data("id");
  console.log(emp_id);
  $("#getEmpId").val(emp_id);
});
