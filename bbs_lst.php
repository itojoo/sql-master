<?php

include ('db_connect.php');?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Title</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
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
        location.href = 'bbs_act.php?mod=del&uid='+uid;
    });
});
</script>
</head>
<body>
<div>
    <a href="bbs_frm.php" class="btn btn-default">새글쓰기</a> <a href="bbs_trash.php" class="btn btn-default">휴지통</a>
</div>
<?php

$page=$_GET['page'];
$search_var= $_GET['search_var'];
$search_val= $_GET['search_val'];

$page=($page)?$page:1;
//$page = ($_GET['page'])?$_GET['page']:1;

$list=10;
$block = 5;
$L_first=($page-1)*$list;
$str_link="";
$sql_where = "";
$tableF =array (
	"na" => array("이름","name like '%$search_val%'")
	, "ti" => array("제목","title like '%$search_val%'")
	, "co" => array("내용","content like '%$search_val%'")
	, "tc" => array("제목+내용","(title like '%$search_val%' or content like '%$search_val%')")
);
if ($search_val)
{
	$sql_where = " and ({$tableF[$search_var][1]})";
	$str_link	= "search_var=$search_var&search_val=$search_val";
}

$sql= "
	select 
		count(*) cnt
	from 
		board 
	WHERE 1=1
		and date_delete is NULL 
		$sql_where
	";
$result = mysqli_query($conn,$sql);
$rowCnt = 0;

if($row=mysqli_fetch_array($result))
{
	$rowCnt = $row['cnt'];						// 총 레코드 카운트
	$totalPage=ceil($rowCnt/$list);			//총 페이지
}

$sql= "
	select 
		uid, `name`, title, content, date_add, parent, step, lvl, ref
	from 
		board 
	WHERE 
		date_delete is NULL 
		$sql_where
	order by ref desc, step asc
	limit $L_first,$list
	";
	echo $sql;
$result = mysqli_query($conn,$sql);
if (!$result) {
    printf("Error: %s\n", mysqli_error($con));
    exit();
}
	$html = "
	$page / $totalPage
		<table class=\"table\">
			<tr>
				<th><input type='checkbox' name='checkall' onclick='CheckAll()'></th>
				<th>uid</th>
				<th>이름</th>
				<th>제목</th>
				<th>내용</th>
				<th>등록일</th>
				<th></th>
				<th>parent</th>
				<th>step</th>
				<th>lvl</th>
				<th>ref</th>
			</tr>
	";
	while($row=mysqli_fetch_array($result)){
		$str_re=str_repeat("&nbsp;", $row['lvl']);//class='step{$row['lvl']}'
		$html .= "
			<tr data-id='{$row['uid']}' data-step='{$row['step']}' data-lvl='{$row['lvl']}' >
				<td><input type='checkbox' name='unit[]' id='item-{$row['uid']}'></td>
				<td>{$row['uid']}</td>
				<td>{$row['name']}</td>
				<td class='title'><a href='bbs_vi.php?uid={$row['uid']}'>$str_re{$row['title']}</a></td>
				<td class='content'>{$row['content']}</td>
				<td>{$row['date_add']}</td>
				<td><button type='button' class='btn btn-default modify'>수정</button> <button type='button'class='btn btn-default delete'>삭제</button></td>
				<td>{$row['parent']}</td>
				<td>{$row['step']}</td>
				<td>{$row['lvl']}</td>
				<td>{$row['ref']}</td>
			</tr>
		";
	}
	$html .= "
		</table>
	";


	$totalPage=ceil($rowCnt/$list);			//총 페이지
	$totalBlock = ceil($totalPage/$block);	// 총 블록
	$nowBlock = ceil($page/$block);			//현재 페이지 블록 번호

	$s_page = $page - floor($block/2);		// 현제 페이지 페이징 중앙 처리 수식
	$s_page = ($s_page <= 1)?1:$s_page;		// 페이징 시작
	$e_page = $s_page + $block - 1;			// 페이징 끝
	$next_page = $e_page + 1;				// next 블럭 페이지
	if ($totalPage <= $e_page) {			// 총 페이지가 현재 블록의 마지막 페이지 번호보다 작을때
		$e_page = $totalPage;
		$next_page = $e_page;
	}
?>
<form name="" >
<select name="search_var">
<?
	foreach ($tableF as $key => $value) {
		$selected=($key==$search_var)?"selected=selected":"";
		echo "<option value='$key' $selected>{$value[0]}</option>\n";
	}
?>	
</select> 
<input type="text" name="search_val" value="<?=$search_val?>">
<input type="submit" value="검색">
</form>

<?=$html?>
<ul class="pagination">
    <li>
        <a href="<?=$PHP_SELP?>?page=<?=$s_page-1?>&<?=$str_link?>" aria-label="Previous">
            <span aria-hidden="true">&laquo;</span>
        </a>
    </li>
    <? for ($p=$s_page; $p<=$e_page; $p++) {?>
    <li>
        <? if($p == $page){	 ?>
	        <span><?=$p?></span>
		<? }else{ ?>
            <a href="<?=$PHP_SELP?>?page=<?=$p?>&<?=$str_link?>"><?=$p?></a>
        <? } ?>
    </li>
    <? } ?>
    <li>
        <a href="<?=$PHP_SELP?>?page=<?=$next_page?>&<?=$str_link?>" aria-label="Next">
            <span aria-hidden="true">&raquo;</span>
        </a>
    </li>
</ul>
</body>
</html>