<?php
/**
 * Created by PhpStorm.
 * User: leejiwoo
 * Date: 2017. 6. 10.
 * Time: 오후 6:51
 */
include ('db_connect.php');

$mod = $_POST['mod'];
$mod = ($mod)?$mod:$_GET['mod'];
$uid = $_POST['uid'];
$title = $_POST['title'];
$content = $_POST['content'];
$name = $_POST['name'];
$parent = $_POST['parent'];

print_r($_POST);

if ($mod == 'add'){
	//등록
	 $uploadfile = "./upload/".$_FILES['upload']['name'];
	 if(move_uploaded_file($_FILES['upload']['tmp_name'],"./upload/".$uploadfile)){
	  echo "파일이 업로드 되었습니다.<br />";
	  echo "<img src ={$uploadfile}> <p>";
	  echo "1. file name : {$_FILES['upload']['name']}<br />";
	  echo "2. file type : {$_FILES['upload']['type']}<br />";
	  echo "3. file size : {$_FILES['upload']['size']} byte <br />";
	  echo "4. temporary file name : {$_FILES['upload']['size']}<br />";
	 } else {
	  echo "파일 업로드 실패 !! 다시 시도해주세요.<br />";
	 }
	$sql= "select max(uid) from board ";
	$result = mysqli_query($conn,$sql);
	if (!$result) {
		printf("Error: %s\n", mysqli_error($con));
		exit();
	}
	if($row=mysqli_fetch_array($result)){
		$uid=$row[0]+1;
	}
	$sql = "
		INSERT INTO board 
			(uid, title,content,`name`, date_add, fileName, ref, parent, step,lvl)
		VALUES 
			('$uid','$title','$content','$name', NOW(),'$uploadfile','$uid','0','0','0')
		";
}else if ($mod == 're'){
	//답변
	echo "aaaa";
	
	$uploadfile = $_FILES['upload']['name'];
	if(move_uploaded_file($_FILES['upload']['tmp_name'],"./upload/".$uploadfile)){
		echo "파일이 업로드 되었습니다.<br />";
		echo "<img src ={$uploadfile}> <p>";
		echo "1. file name : {$_FILES['upload']['name']}<br />";
		echo "2. file type : {$_FILES['upload']['type']}<br />";
		echo "3. file size : {$_FILES['upload']['size']} byte <br />";
		echo "4. temporary file name : {$_FILES['upload']['size']}<br />";
	} else {
		echo "파일 업로드 실패 !! 다시 시도해주세요.<br />";
	}
	$sql= "select * from board where uid='$parent'";
	$result = mysqli_query($conn,$sql);
	if (!$result) {
		printf("Error: %s\n", mysqli_error($con));
		exit();
	}
	echo "aaaa";
	if($row=mysqli_fetch_array($result)){
		$ref=$row['ref'];
		$ref=($ref)?$ref:$parent;
		$step=$row['step']+1;
		$lvl=$row['lvl']+1;
	}
	echo "lvl : $lvl";
	$sql = "
		UPDATE board
		SET 
			STEP = STEP + 1
		WHERE ref = '$ref' -- 시조 id
		AND STEP >= '$step'   -- 부모 step
	";
	mysqli_query($conn,$sql);
	echo $sql;
	$sql = "
		INSERT INTO board 
			(title,content,`name`, date_add, fileName, ref, parent, step,lvl)
		VALUES 
			('$title','$content','$name', NOW(),'$uploadfile','$ref','$parent','$step', '$lvl')
		";
	
}else if($mod == 'edt'){
	// 수정
	$sql = "
			UPDATE 
				board
			SET 
				title = '$title'
				,content = '$content'
				,`name` = '$name'
				,date_add = NOW()
			WHERE 
				uid = '$uid'
			";
}else if($mod == 'del'){
	// 삭제
	/*
	select * from board order by ref, step;
	select * from board where ref=2 and lvl<2 and step>2 order by ref, step;  -- 첫 보존값
	select * from board where ref=2 and lvl>=2 and step>=2 and step < 5; -- 삭제 레코드
	*/
	
	$uid = $_GET['uid'];
	$sql = "
			UPDATE 
				board
			SET 
				date_delete = NOW()
			WHERE 
				uid = '$uid'
			";
}

echo mysqli_query($conn,$sql);
echo $sql;


//echo ("<meta http-equiv='Refresh' content='1; URL=../bbs_lst.php'>");

//$data = $_GET[];
//echo ($data);