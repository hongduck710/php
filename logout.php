<?php
    session_start();

    if( !isset($_SESSION['user_id']) && empty($_SESSION['user_id']) ){
        //isset 해당 변수가 선언되지 않았다면, 세션이 활성화 될수 없는, 초기화 되지 않은 변수가 왔을 때도 이용할 수 있도록
        echo "로그인을 해야 이용할 수 있어욧!";
        echo "<br />";
        echo "<a href='login.php'>로그인</a>";
        exit;
    }

    session_destroy();//세션이 날아가는 함수야!

    echo "로그아웃 성♡공♡";
    echo "<a href='/'>홈으로</a>";
?>