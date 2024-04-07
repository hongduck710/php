<?php
    session_start();
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

    $sql_query = "select * from members where idx='".$_GET['view_no']."'";//수정, 삭제는 항상 조건을 붙여줘야 함!!
    $result = mysqli_query($connect, $sql_query);

    $row = mysqli_fetch_array($result);

    //echo "<pre>";
    //print_r($row);
    //echo "</pre>";
    //배열이기 때문에 print_r로 표시
//php선언문 사이와 html선언문 사이 공백 있으면 안됨!!!!
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>정보 보기!</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <table>
        <tr>
            <th>아이디</th>
            <td>
                <?php echo $row['user_id'];?>
            </td>
        </tr>
        <tr>
            <th>패스워드</th>
            <td>
                <?php echo $row['user_pw'];?>
            </td>
        </tr>
        <tr>
            <th>회원명</th>
            <td>
                <?php echo $row['name'];?>
            </td>
        </tr>
        <tr>
            <th>나이</th>
            <td>
                <?php echo $row['age'];?>
            </td>
        </tr>
        <tr>
            <th>성별</th>
            <td>
                <?php echo $row['gender'];?>
            </td>
        </tr>
        <tr>
            <th>사진</th>
            <td><img src="<?php echo $row['img_path'].'/'.$row['img_name'] ;?>" width="300"/></td>
        </tr>
        <tr>
            <td><a href="./index.php">목록</a></td>
            <td><a href="./edit.php?edit_no=<?php echo $_GET['view_no']; ?>">수정</a></td>
        </tr>
    </table>
</body>    
</html>