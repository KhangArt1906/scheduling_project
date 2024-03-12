// Lấy các phần tử HTML cần thiết
var registrationForm = document.getElementById("registrationForm");
var registrationClosed = document.getElementById("registrationClosed");
var registerBtn = document.getElementById("registerBtn");

let txt = "The registration is over, please comeback again later";
const date = new Date();

let day = date.getDate();
let month = date.getMonth() + 1;
let year = date.getFullYear();

// This arrangement can be altered based on how we want the date's format to appear.
let currentDate = `${day}-${month}-${year}`;
console.log(currentDate); // "17-6-2022"

// Lấy ngày bắt đầu và ngày kết thúc của đợt đăng ký (định dạng dd/mm/yyyy)
var startDate = `2-8-2023`;
var endDate = `2-8-2023`;

//Update theo so luong yeu cau
var availableRoom = 3;
var currentRequire = 8;

// Kiểm tra trạng thái đợt đăng ký
if (
  currentDate >= startDate &&
  currentDate <= endDate &&
  currentStatusRoom <= availableRoom
) {
  // Đợt đăng ký đang mở
  //registrationClosed.style.display = "none";
  registrationForm.style.display = "block";
} else if (currentRequire > availableRoom) {
  registrationForm.style.display = "none";
  // window.location.href =
  //   "/School Faculty Scheduling/scheduling/registration-over.php";
  window.alert("We are out of rooms,please coming soon for another time");
  window.location.href = "/School Faculty Scheduling/scheduling/index.php";
  // Đợt đăng ký đã kết thúc
  //registrationClosed.style.display = "block";
}
