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
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>등록</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <form name="frm" action="./write_proc.php" method="post" onSubmit="return CheckForm();" enctype="multipart/form-data">
        <!--  파일 업로드가 있을 경우, form 태그에 enctype="multipart/form-data" 추가!!!-->
        <table>
            <tr>
                <th>아이디</th>
                <td>
                    <input type="text" name="user_id" value="" />
                </td>
            </tr>
            <tr>
                <th>패스워드</th>
                <td>
                    <input type="password" name="user_pw" value="" />
                </td>
            </tr>
            <tr>
                <th>회원명</th>
                <td>
                    <input type="text" name="name" value="" />
                </td>
            </tr>
            <tr>
                <th>나이</th>
                <td>
                    <input type="text" name="age" value="" />
                </td>
            </tr>
            <tr>
                <th>성별</th>
                <td>
                    <label><input type="radio" name="gender" value="남" />남</label>
                    <label><input type="radio" name="gender" value="여" />여</label>
                </td>
            </tr>
            <tr>
                <th>사진</th>
                <td>
                    <input type="file" name="photo" value="" />
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="submit" value="저장" />
                </td>
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
            else if (frm.user_id.value == "") 
            {
                frm.user_id.focus();
                alert("아이디를 입력해주세요!!");
                return false;
            }
            else if (frm.user_pw.value == "") 
            {
                frm.user_pw.focus();
                alert("비밀번호를 입력해주세요!!");
                return false;
            }
        }

    </script>
</body>    
</html>