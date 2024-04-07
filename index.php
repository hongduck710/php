<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>마이에스큐엘</title>
    <link rel="stylesheet" type="text/css" href="style.css">

</head>
<body>
<?php
    session_start();
    // ./config/ == config/
    require_once("./config/db_conn.php");
    

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
    $cnt= 1; //각 페이지의 게시물 번호
    
    //전체 게시물 갯수
    $sql_query = "select * from members order by idx desc";
    $result = mysqli_query($connect, $sql_query);
    $num = mysqli_num_rows($result); // 총row의 갯수를 파악

    //한 페이지 당 데이터 갯수
    $list_num = 5;

    //한 블럭 당 페이지 갯수
    $page_num = 3;

    //현재 페이지 
    $page = isset($_GET['page'])? $_GET['page'] : 1; //페이지가 없으면 첫번째 페이지가 나옴. 페이지를 눌렀다면 $_GET에 있는 페이지가 $page에 담겨라. 삼항식

    //전체 페이지 수 = 전체 데이터 / 페이지 당 데이터 갯수, ceil(올림), floor(내림), round(반올림)
    $total_page = ceil($num / $list_num);

    //전체 블럭 수 = 전체 페이지 수 / 블럭 당 페이지 수
    $total_block = ceil($total_page / $page_num);

    //현재 블럭 번호 = 현재 페이지 번호 / 블럭 당 페이지 수
    $now_block = ceil($page / $page_num);

    //블럭 당 시작 페이지 번호 = (해당 글의 블럭 번호 - 1) * 블럭 당 페이지 수 + 1
    $s_pageNum = ($now_block - 1) * $page_num + 1;

    //데이터가 0개인 경우
    if($s_pageNum == 0)
    {
        $s_pageNum = 1;
    }

    //블럭 당 마지막 페이지 번호 = 현재 블럭 번호 * 블럭 당 페이지 수
    $e_pageNum = $now_block * $page_num;

    // 마지막 번호가 전체 페이지를 넘지 않도록
    if($e_pageNum > $total_page)
    {
        $e_pageNum = $total_page;
    }

    // 시작 번호 = (현재 페이지 번호 - 1) * 페이지당 보여질 데이터 수
    $start = ($page - 1) * $list_num;

    //글번호
    $cnt = $start + 1;

    //기존 쿼리에 페이지 개념을 도입 limit
    $sql_query = "select * from members order by idx desc limit ".$start.", ".$list_num." ";
    $result = mysqli_query($connect, $sql_query);

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

    while($row=mysqli_fetch_array($result))
    {
        echo "<tr>";
        echo "<td>".$cnt."</td>";
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

        $cnt++; // $cnt = $cnt + 1;
    }

    echo "</table>";

    //페이징 프론트 작업
    echo "<p>";
    //이전 페이지
    if($page <= 1) 
    {
        echo "<a href='index.php?page=1'>이전</a>";
    } else {
        echo "<a href='index.php?page=".($page - 1)."'>이전</a>";
    }

    //페이지 번호 출력
    for($p = $s_pageNum; $p <= $e_pageNum; $p++)
    {
        echo "<a href='index.php?page=".$p."'>".$p."</a>";
    }

    //다음 페이지
    if($page >= $total_page) 
    {
        echo "<a href='index.php?page=".$total_page."'>다음</a>";
    } else {
        echo "<a href='index.php?page=".($page + 1)."'>다음</a>";
    }

    echo "</p>";


    mysqli_close($connect);

?>
</body>
</html>