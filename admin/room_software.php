<?php
include('./db_connect.php');


// Câu truy vấn SQL để lấy dữ liệu cho trang hiện tại
$query = "SELECT 
    room.room_id, 
    room.room_no, 
    GROUP_CONCAT(DISTINCT software.software_name) AS installed_software
FROM 
    room
LEFT JOIN 
    room_software ON room.room_id = room_software.room_id
LEFT JOIN 
    software ON room_software.software_id = software.software_id
GROUP BY 
    room.room_id, 
    room.room_no
";

$result = mysqli_query($conn, $query);

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        // echo "Room ID: " . $row['room_id'] . "<br>";
        echo "<b>Room: " . $row['room_no'] . "</b><br>";
        echo "Installed: " . ($row['installed_software'] ?: "None") . "<br>";
        echo "<hr>";
    }

   
} else {
    echo "Error in query: " . mysqli_error($conn);
}

mysqli_close($conn);
?>