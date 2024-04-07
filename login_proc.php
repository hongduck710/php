<?php
    session_start(); //세션을 이용하기 위해서는 반드시 최상단에 선언되어야 함! 반드시 최. 상. 단.!
  
/*
    if( !isset($_SESSION['user_id']) && empty($_SESSION['user_id']) ){
        //isset 해당 변수가 선언되지 않았다면, 세션이 활성화 될수 없는, 초기화 되지 않은 변수가 왔을 때도 이용할 수 있도록
        echo "로그인을 해야 이용할 수 있어욧!";
        echo "<br />";
        echo "<a href='login.php'>로그인</a>";
        exit;
    }
*/    
    require_once("./config/db_conn.php");


    $sql_query = "select * from members where user_id='".$_POST['user_id']."'";//수정, 삭제는 항상 조건을 붙여줘야 함!!
    $result = mysqli_query($connect, $sql_query);
    $row = mysqli_fetch_array($result);

    if( !$row['user_id'] ){
        //if문 앞에 ! 가 있으면 "~가 없으면 이라는 뜻!"
        echo "해당 아이디 없어욧!";
        exit;
    }

    $sql_query = "select * from members where user_id='".$_POST['user_id']."' AND user_pw='".md5($_POST['user_pw'])."'"; //수정, 삭제는 항상 조건을 붙여줘야 함!!
    $result = mysqli_query($connect, $sql_query);
    $row = mysqli_fetch_array($result);

    if(!$row['user_id']){
        //if문 앞에 ! 가 있으면 "~가 없으면 이라는 뜻!"
        echo "정확한 정보 없어욧!";
        exit;
    }

    //모두 정상 로그인이 진행된 상태
    $_SESSION['user_id'] = $row['user_id'];
    echo "정상 로그인 되었어요!";
    echo "<br />";
    echo "<a href='./index.php'>홈으로</a>";
?>