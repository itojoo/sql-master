<?php

include ('include/db_connect.php');?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Title</title>
</head>
<body>
<form action="include/db_insert.php" method="get">
    <label for="name">이름 : </label><input type="text" name="name">
    <label for="title">제목 : </label><input type="text" name="title">
    <label for="content">내용 : </label><input type="text" name="content">
    <input type="submit" value="작성">
</form>

<?php
$sql= "select `name`, title, content, date_add from board";
$result = mysqli_query($conn,$sql);
if (!$result) {
    printf("Error: %s\n", mysqli_error($con));
    exit();
}
echo "<table>";
	while($row=mysqli_fetch_array($result)){
		echo "
		<tr>
			<td>{$row['name']}</td>
			<td>{$row['title']}</td>
			<td>{$row['content']}</td>
			<td>{$row['date_add']}</td>
		<tr>
		";
	}
echo "</table>";
?>
</body>
</html>