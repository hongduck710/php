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

    $sql_query = "select * from members where idx='".$_GET['edit_no']."'";//수정, 삭제는 항상 조건을 붙여줘야 함!!
    $result = mysqli_query($connect, $sql_query);

    $row = mysqli_fetch_array($result);

    echo "<pre>";
    print_r($row);
    echo "</pre>";
    //배열이기 때문에 print_r로 표시
//php선언문 사이와 html선언문 사이 공백 있으면 안됨!!!!
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>수정</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <form name="frm" action="./edit_proc.php" method="post" onSubmit="return CheckForm();" enctype="multipart/form-data">
        <input type="hidden" name="edit_no" value="<?php echo $_GET['edit_no'] ?>" />
        <table>
            <tr>
                <th>아이디</th>
                <td>
                    <input type="text" name="user_id" value="<?php echo $row['user_id'];?>" />
                </td>
            </tr>
            <tr>
                <th>패스워드</th>
                <td>
                    <input type="password" name="user_pw" value="<?php echo $row['user_pw'];?>" />
                </td>
            </tr>
            <tr>
                <th>회원명</th>
                <td>
                    <input type="text" name="name" value="<?php echo $row['name'];?>" />
                </td>
            </tr>
            <tr>
                <th>나이</th>
                <td>
                    <input type="text" name="age" value="<?php echo $row['age']?>" />
                </td>
            </tr>
            <tr>
                <th>성별</th>
                <td>
                    <?php
                        $checked1 = "";
                        $checked2 = "";

                        if($row['gender'] == "남")
                        {
                            $checked1 ="checked";
                            $checked2 = "";
                        } else if($row['gender'] == "여")
                        {
                            $checked1 ="";
                            $checked2 = "checked";
                        } else {
                            $checked1 = "";
                            $checked2 = "";
                        }
                    ?>
                    <label><input type="radio" name="gender" value="남" <?php echo $checked1; ?> />남</label>
                    <label><input type="radio" name="gender" value="여" <?php echo $checked2; ?> />여</label>
                </td>
            </tr>
            <tr>
                <th>사진</th>
                <td>
                    <img src="<?php echo $row['img_path'].'/'.$row['img_name'] ;?>" width="300"/>
                    <p><input type="file" name="photo" value="" /></p>
                </td>
            </tr>
            <tr>
                <td><a href="./index.php">목록</a></td>
                <td><input type="submit" value="저장" /></td>
            </tr>
        </table>
    </form>

    <script>

        function CheckForm()
        {
            if(frm.name.value == "")
            {
                frm.name.focus();  //여기서 name은 안에 있는 키를 말하는 것임! frm안에 있는 name을 찾아라!
                alert("이름을 입력해주세요!!");
                return false; //진행하지 마라!
            }
            else if (frm.age.value == "") 
            {
                frm.age.focus();
                alert("나이를 입력해주세요!!");
                return false;
            }
        }

    </script>
</body>    
</html>