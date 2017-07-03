<?php
/**
 * Created by PhpStorm.
 * User: leejiwoo
 * Date: 2017. 6. 10.
 * Time: 오전 2:53
 */
header("Content-Type: text/html; charset=UTF-8");

$db_host = "127.0.0.1";
$db_user = "root";
$db_password = "autoset";
$db_name = "firstboard";
$conn = mysqli_connect($db_host,$db_user,$db_password);
if (mysqli_connect_errno()){
    echo "Mysql 연결 오류".mysqli_connect_error();
}else{
    echo "Mysql 연결 성공~";
}
// Create database
$sql = "CREATE DATABASE firstBoard DEFAULT CHARACTER SET utf8 collate utf8_general_ci";
if(mysqli_query($conn,$sql)){
    echo "성공적으로 firstBoard 테이터베이스가 만들어졌습니다.";
}else{
    echo "데이터베이스 만들기 오류 :".mysqli_error($conn);
}

// Create 게시판 테이블
$sql_table =  "CREATE TABLE board(
    uid INT NOT NULL AUTO_INCREMENT,
    PRIMARY KEY (uid),
    title CHAR(50) COMMENT '제목',
    content CHAR(255) COMMENT '내용',
    name CHAR(30) COMMENT '작성자',
    date_add INT COMMENT '등록일',
    date_delete INT COMMENT '삭제일'
   ) default character set utf8 collate utf8_general_ci ";

$conn_2 = mysqli_connect($db_host,$db_user,$db_password,$db_name);

if (mysqli_query($conn_2,$sql_table)){
    echo "성공적으로 게시판 테이블을 만들었습니다.";
}else{
    echo "테이블 생성 오류: ".mysqli_error($conn);
}