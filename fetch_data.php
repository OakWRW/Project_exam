<?php
// fetch_data.php
include "connect.php"; // เชื่อมต่อฐานข้อมูล

$search_first_name = $_GET["search_first_name"];

$query = "SELECT * FROM exam WHERE 
              id LIKE ? OR 
              first_name LIKE ? OR 
              last_name LIKE ? OR 
              email LIKE ? OR 
              gender LIKE ? OR 
              ip_address LIKE ? OR 
              CONCAT(first_name, ' ', last_name) LIKE ?";
$stmt = mysqli_prepare($connection, $query);
$search_term = '%' . $search_first_name . '%';
mysqli_stmt_bind_param($stmt, "sssssss", $search_term, $search_term, $search_term, $search_term, $search_term, $search_term, $search_term);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

if ($result) {
    echo "<table>";
    echo "<tr>";
    echo "<th id ='id'>ID</th>";
    echo "<th id ='name'>ชื่อ</th>";
    echo "<th id ='email'>อีเมล</th>";
    echo "<th id ='gender'>เพศ</th>";
    echo "<th id ='IPA'>IP Address</th>";
    echo "</tr>";

    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row["id"] . "</td>";
        echo "<td>" . $row["first_name"] . " " . $row["last_name"] . "</td>";
        echo "<td>" . $row["email"] . "</td>";
        echo "<td>" . $row["gender"] . "</td>";
        echo "<td>" . $row["ip_address"] . "</td>";
        echo "</tr>";
    }
    
    echo "</table>";
} else {
    echo "ไม่พบข้อมูล";
}

// ปิดการเชื่อมต่อ
mysqli_stmt_close($stmt);
mysqli_close($connection);
?>
