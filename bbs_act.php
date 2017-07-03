<?php
/**
 * Created by PhpStorm.
 * User: leejiwoo
 * Date: 2017. 6. 10.
 * Time: 오후 6:51
 */
include ('db_connect.php');

$mod = $_GET['mod'];
$uid = $_GET['uid'];
$title = $_GET['title'];
$content = $_GET['content'];
$name = $_GET['name'];
print_r($_GET);

//if() 삭제> 리스트 안나오게 


if ($mod == 'add'){
	//등록
	$sql = "
		INSERT INTO board 
			(title,content,`name`, date_add)
		VALUES 
			('$title','$content','$name', NOW())
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
	$sql = "
			UPDATE 
				board
			SET 
				date_delete = NOW()
			WHERE 
				uid = '$uid'";
}

echo mysqli_query($conn,$sql);
echo $sql;


echo ("<meta http-equiv='Refresh' content='1; URL=../bbs_lst.php'>");

//$data = $_GET[];
//echo ($data);