<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>마이에스큐엘</title>
    <link rel="stylesheet" type="text/css" href="style.css">

</head>
<body>
<?php

    // ./config/ == config/
    require_once("lib.php");

    require_once("a.php");
    require_once("b.php");
    echo b\car\car();
    //동일한 함수를 이용해야 하는 상황이 있다면 네임스페이스 이용!
    
    $libs = paging("members", 1); //테이블명이 members 였으므로

    /*
    $rand = rand(1, 100); //1에서 100까지 임의의 숫자를 담아줌!!!!

    $name = "등장인물 ".$rand."번";
    $age = "35";
    $gender = "여";

    $sql_query = "insert into members (name, age, gender, regdate) values ('$name', '$age', '$gender', now() )";
    //ex) 2024-04-04 02:44:11 분은 i로 표시함.!! 

    $result = mysqli_query($connect, $sql_query);


    if($result)
    {
        echo "DB가 정상적으로 추가되었어요!";
    } else {
        echo "DB 추가에 실패했어요!";
    }

    form -> JS(var check) -> (mysql) CRUD
    index -> list (R)
    delete -> D : list->삭제->js(confirm)->delete_proc.php (process)
    create -> write.php (C) -> form -> 등록->js(check)->write_proc.php (process) 언더바proc =  mysql을 처리하는 곳!!
    update -> update.php (U) -> list->수정->edit.php(form)->js(check)->edit_proc.php (process)

    */
    //print_r($_POST);


    echo "<a href='write.php'>등록</a>";
    
    if(isset($_SESSION['user_id']) && $_SESSION['user_id']){
        //isset 해당 변수가 선언되지 않았다면, 세션이 활성화 될수 없는, 초기화 되지 않은 변수가 왔을 때도 이용할 수 있도록

        echo "<a href='logout.php'>로그아웃</a>";
    } else {
        echo "<a href='login.php'>로그인</a>";
    }

    echo "<table>";

    echo "<tr>";
    echo "<th>번호</th>";
    echo "<th>이름</th>";
    echo "<th>나이</th>";
    echo "<th>성별</th>";
    echo "<th>등록일</th>";
    echo "<th>삭제</th>";
    echo "</tr>";

    while($row=mysqli_fetch_array($libs['result']))
    {
        echo "<tr>";
        echo "<td>".$libs['cnt']."</td>";
        echo "<td>";
        echo "<a href='./view.php?view_no=".$row['idx']."'>";
        echo $row['name'];
        echo "</a>";
        echo "</td>";
        echo "<td>".$row['age']."</td>";
        echo "<td>".$row['gender']."</td>";
        echo "<td>".$row['regdate']."</td>";

        echo "<td>";
        //echo "<form name='frmd' action='" .$_SERVER['PHP_SELF']. "' method='get'>";
        //echo "<input type='submit' value='삭제' />";
        //echo "<input type='text' name='del_no' value='" .$row['idx']. "' />";
        //echo "</form>";
        echo "<a href='./delete_proc.php?del_no=".$row['idx']."'>삭제</a>";
        echo "</td>";

        echo "</tr>";

        $libs['cnt']++; // $cnt = $cnt + 1;
    }

    echo "</table>";

    pagination($libs);


    mysqli_close($connect);

?>
</body>
</html>