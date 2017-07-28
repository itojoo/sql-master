<?php

include ('db_connect.php');

$uid=$_GET['uid'];
$re_uid=$_GET['re_uid'];
$mod="add";
$btn_str="글쓰기";
if($uid || $re_uid)
{
	$mod= ($re_uid)? "re" : "edt";
	$btn_str="수정";
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
	if($re_uid){
		$name="";
		$title = "RE_".$title;
		$content = "";
		$btn_str="답글";
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
<form action="bbs_act.php" method="post" enctype="multipart/form-data">
	<input type="hidden" name="mod" value="<?=$mod?>">
	<input type="hidden" name="uid" value="<?=$uid?>">
	<input type="hidden" name="parent" value="<?=$re_uid?>">
	<label for="name">이름 : </label><input type="text" name="name" value="<?=$name?>">
	<label for="title">제목 : </label><input type="text" name="title" value="<?=$title?>"><br>
	<textarea type="text" name="content" title="내용"><?=$content?></textarea><br>
	<input type="file" size=100 name="upload"><br>
	<input type="submit" value="<?=$btn_str?>">
</form>

</body>
</html>