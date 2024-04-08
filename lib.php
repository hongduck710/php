<?php
    session_start();

    require_once("./config/db_conn.php");

    function paging($table="", $cnt=1)
    {

        global $connect, $_GET; //전역변수화!
        /*db_connect.php에 있는 $connect가 function 
        안에서동작하게 하려면 global 선언을 해줘야 함*/

        $arr = array();

        //전체 게시물 갯수
        $sql_query = "select * from ".$table." order by idx desc";
        $result = mysqli_query($connect, $sql_query);
        $num = mysqli_num_rows($result); // 총row의 갯수를 파악
    
        //한 페이지 당 데이터 갯수
        $list_num = 5;
    
        //한 블럭 당 페이지 갯수
        $page_num = 3;
    
        //현재 페이지 
        $arr['page'] = isset($_GET['page'])? $_GET['page'] : 1; //페이지가 없으면 첫번째 페이지가 나옴. 페이지를 눌렀다면 $_GET에 있는 페이지가 $page에 담겨라. 삼항식
    
        //전체 페이지 수 = 전체 데이터 / 페이지 당 데이터 갯수, ceil(올림), floor(내림), round(반올림)
        $arr['$total_page'] = ceil($num / $list_num);
    
        //전체 블럭 수 = 전체 페이지 수 / 블럭 당 페이지 수
        $total_block = ceil($arr['$total_page'] / $page_num);
    
        //현재 블럭 번호 = 현재 페이지 번호 / 블럭 당 페이지 수
        $now_block = ceil($arr['page'] / $page_num);
    
        //블럭 당 시작 페이지 번호 = (해당 글의 블럭 번호 - 1) * 블럭 당 페이지 수 + 1
        $arr['$s_pageNum'] = ($now_block - 1) * $page_num + 1;
    
        //데이터가 0개인 경우
        if($arr['$s_pageNum'] == 0)
        {
            $arr['$s_pageNum'] = 1;
        }
    
        //블럭 당 마지막 페이지 번호 = 현재 블럭 번호 * 블럭 당 페이지 수
        $arr['$e_pageNum'] = $now_block * $page_num;
    
        // 마지막 번호가 전체 페이지를 넘지 않도록
        if($arr['$e_pageNum'] > $arr['$total_page'])
        {
            $arr['$e_pageNum'] = $arr['$total_page'];
        }
    
        // 시작 번호 = (현재 페이지 번호 - 1) * 페이지당 보여질 데이터 수
        $start = ($arr['page'] - 1) * $list_num;
    
        //글번호
        $arr['cnt'] = $start + 1;
    
        //기존 쿼리에 페이지 개념을 도입 limit
        $sql_query = "select * from ".$table." order by idx desc limit ".$start.", ".$list_num." ";
        $arr['result'] = mysqli_query($connect, $sql_query);

        return $arr;
    }

    function pagination($libs=""){

        //페이징 프론트 작업
        echo "<p>";
        //이전 페이지
        if($libs['page'] <= 1) 
        {
            echo "<a href='index.php?page=1'>이전</a>";
        } else {
            echo "<a href='index.php?page=".($libs['page'] - 1)."'>이전</a>";
        }

        //페이지 번호 출력
        for($p = $libs['$s_pageNum']; $p <= $libs['$e_pageNum']; $p++)
        {
            echo "<a href='index.php?page=".$p."'>".$p."</a>";
        }

        //다음 페이지
        if($libs['page'] >= $libs['$total_page']) 
        {
            echo "<a href='index.php?page=".$libs['$total_page']."'>다음</a>";
        } else {
            echo "<a href='index.php?page=".($libs['page'] + 1)."'>다음</a>";
        }

        echo "</p>";

    }


?>