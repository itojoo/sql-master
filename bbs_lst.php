<?php

include ('include/db_connect.php');?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Title</title>
<link rel="stylesheet" href="css/sql.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript">
var check = false;
function CheckAll(){
    var chk = document.getElementsByName("unit[]");
    if(check == false){
        check = true;
        for(var i=0; i<chk.length;i++){
            chk[i].checked = true;     //모두 체크
        }
    }else{
        check = false;
        for(var i=0; i<chk.length;i++){
            chk[i].checked = false;     //모두 해제
        }
    }
}
function selectRow() {
    var chk = document.getElementsByName("unit[]"); // 체크박스객체를 담는다
    var len = chk.length;    //체크박스의 전체 개수
    var checkRow = '';      //체크된 체크박스의 value를 담기위한 변수
    var checkCnt = 0;        //체크된 체크박스의 개수
    var checkLast = '';      //체크된 체크박스 중 마지막 체크박스의 인덱스를 담기위한 변수
    var rowid = '';             //체크된 체크박스의 모든 value 값을 담는다
    var cnt = 0;

    for(var i=0; i<len; i++){
        if(chk[i].checked == true){
            checkCnt++;        //체크된 체크박스의 개수
            checkLast = i;     //체크된 체크박스의 인덱스
        }
    }

    for(var i=0; i<len; i++){
        if(chk[i].checked == true){  //체크가 되어있는 값 구분
            checkRow = chk[i].value;

            if(checkCnt == 1){                            //체크된 체크박스의 개수가 한 개 일때,
                rowid += "'"+checkRow+"'";        //'value'의 형태 (뒤에 ,(콤마)가 붙지않게)
            }else{                                            //체크된 체크박스의 개수가 여러 개 일때,
                if(i == checkLast){                     //체크된 체크박스 중 마지막 체크박스일 때,
                    rowid += "'"+checkRow+"'";  //'value'의 형태 (뒤에 ,(콤마)가 붙지않게)
                }else{
                    rowid += "'"+checkRow+"',";	 //'value',의 형태 (뒤에 ,(콤마)가 붙게)
                }

            }
            cnt++;
            checkRow = '';    //checkRow초기화.
        }
    }

    //alert(rowid);    //'value1', 'value2', 'value3' 의 형태로 출력된다.
}
$(function () {
    $('table .modify').on('click',function(){
        var uid = $(this).parents('tr').attr('data-id');
        location.href = 'bbs_frm.php?uid='+uid;
    });
    $('table .delete').on('click',function(){
        var uid = $(this).parents('tr').attr('data-id');
        location.href = 'include/bbs_act.php?mod=del&uid='+uid;
    });
});
</script>
</head>
<body>
<div>
    <a href="bbs_frm.php">새글쓰기</a> <a href="bbs_trash.php">휴지통</a>
</div>
<?php

$page=$_GET['page'];
$page=($page)?$page:1;

$L_step=2;
$L_first=($page-1)*$L_step;

$sql= "
	select 
		count(*)
	from 
		board 
	WHERE 
		date_delete is NULL 
	";
$result = mysqli_query($conn,$sql);
if($row=mysqli_fetch_array($result))
{
	$tCnt=$row[0]/$L_step;
}

$sql= "
	select 
		uid, `name`, title, content, date_add 
	from 
		board 
	WHERE 
		date_delete is NULL 
	limit $L_first,$L_step
	";
$result = mysqli_query($conn,$sql);
if (!$result) {
    printf("Error: %s\n", mysqli_error($con));
    exit();
}
echo "
	$page / $tCnt
	<table>
        <tr>
		    <th><input type='checkbox' name='checkall' onclick='CheckAll()'></th>
			<th>uid</th>
			<th>이름</th>
			<th>제목</th>
			<th>내용</th>
			<th>등록일</th>
			<th></th>
		<tr>
		";
	while($row=mysqli_fetch_array($result)){
		echo "
		<tr data-id='{$row['uid']}'>
		    <td><input type='checkbox' name='unit[]' id='item-{$row['uid']}'></td>
			<td>{$row['uid']}</td>
			<td>{$row['name']}</td>
			<td>{$row['title']}</td>
			<td>{$row['content']}</td>
			<td>{$row['date_add']}</td>
			<td><button type='button' class='modify'>수정</button><button type='button'class='delete'>삭제</button></td>
		<tr>
		";
	}
echo "</table>";

if (isset($_POST['uid'])){
    echo $_POST['uid'];
}
?>
</body>
</html>