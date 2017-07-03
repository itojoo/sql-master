<? include ('include/db_connect.php');?>
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
    </script>
</head>
<body>
<div>
    <a href="bbs_frm.php">새글쓰기</a> <a href="bbs_lst.php">리스트</a>
</div>
<?php
$sql= "select uid, `name`, title, content, date_add from board WHERE date_delete is not NULL";
$result = mysqli_query($conn,$sql);
if (!$result) {
    printf("Error: %s\n", mysqli_error($con));
    exit();
}
echo "<table>
        <tr>
		    <th><input type='checkbox' name='checkall' onclick='CheckAll()'></th>
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
			<td>{$row['name']}</td>
			<td>{$row['title']}</td>
			<td>{$row['content']}</td>
			<td>{$row['date_add']}</td>
			<td><button type='button' class='modify'>복원</button><button type='button'class='delete'>영구 삭제</button></td>
		<tr>
		";
}
echo "</table>";
?>
</body>
</html>