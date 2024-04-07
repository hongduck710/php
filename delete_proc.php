<?php

session_start();
if( !isset($_SESSION['user_id']) && empty($_SESSION['user_id']) ){
        //isset 해당 변수가 선언되지 않았다면, 세션이 활성화 될수 없는, 초기화 되지 않은 변수가 왔을 때도 이용할 수 있도록
    echo "로그인을 해야 이용할 수 있어욧!";
    echo "<br />";
    echo "<a href='login.php'>로그인</a>";
    exit;
}

require_once("./config/db_conn.php");

//print_r($_GET);
//exit;

$sql_query = "delete from members where idx='".$_GET['del_no']."' ";//from이 들어가는 경우는 select, delete일 때만이야!!!!! where라는 조건이 없으면 데이터 나 날라가!!!!
$result = mysqli_query($connect, $sql_query);

if($result)
{
    echo "정상적으로 삭제 되었어요!";
} else {
    echo "삭제에 실패했어요!ㅠㅠ";
}


echo "<a href='./index.php'>홈으로</a>";

?>