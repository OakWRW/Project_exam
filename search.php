<!DOCTYPE html>
<html>
<head>
    <title>แสดงข้อมูลจากฐานข้อมูล</title>
    <link rel ="stylesheet" href="style.css">
</head>
<body>
    <div id="searchtitle">แสดงข้อมูลจากฐานข้อมูล</div>
    
    <div id ="searchbox"><form action="search.php" method="get">
        <label for="search_first_name">ค้นหาชื่อ:</label>
        <input type="text" name="search_first_name" id="search_first_name">
    </form></div>
    
    <div id="data-container">
        <!-- ข้อมูลจากฐานข้อมูลจะถูกแสดงที่นี่ -->
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // เมื่อหน้าเว็บโหลดเสร็จ ให้เรียกฟังก์ชัน fetchData()
            fetchData();

            // เมื่อมีการเปลี่ยนแปลงในช่องค้นหา ให้เรียกฟังก์ชัน fetchData() อีกครั้ง
            $('#search_first_name').on('input', function() {
                fetchData();
            });
        });

        function fetchData() {
            // ใช้ AJAX ในการดึงข้อมูลจากไฟล์ PHP
            $.ajax({
                url: 'fetch_data.php', // เปลี่ยนเส้นทางไปยังไฟล์ PHP ที่ดึงข้อมูล
                type: 'GET',
                data: { search_first_name: $('#search_first_name').val() }, // ส่งค่าจากช่องค้นหา first_name
                success: function(response) {
                    $('#data-container').html(response); // แสดงผลลัพธ์ในส่วนที่มี id เป็น data-container
                }
            });
        }
    </script>
</body>
</html>
