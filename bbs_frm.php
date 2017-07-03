<?php

include ('include/db_connect.php');

$uid=$_GET['uid'];
$mod="add";
if($uid)
{
	$mod="edt";
	$sql= "select `name`, title, content, date_add from board where uid='$uid'";
	$result = mysqli_query($conn,$sql);
	if (!$result) {
		printf("Error: %s\n", mysqli_error($con));
		exit();
	}
	if($row=mysqli_fetch_array($result)){
		$name=$row['name'];
		$title=$row['title'];
		$content=$row['content'];
		
	}
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Title</title>
<link rel="stylesheet" type="text/css" href="https://s.pstatic.net/nm/css/w_g17062901.css">
</head>
<body>
<form action="include/db_insert.php" method="get">
	<input type="hidden" name="mod" value="<?=$mod?>">
	<input type="hidden" name="uid" value="<?=$uid?>">
    <label for="name">이름 : </label><input type="text" name="name" value="<?=$name?>">
    <label for="title">제목 : </label><input type="text" name="title" value="<?=$title?>"><br>
    <textarea type="text" name="content" title="내용"><?=$content?></textarea><br>
    <input type="submit" value="작성">
</form>

</body>
</html>