<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>로그인이라구!</title>
    <link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
    <form name="loginFrm" action="login_proc.php" method="post">
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
                <th colspan="2">
                    <input type="submit" value="로그인" />
                </th>
            </tr>
        </table>
    </form>
</body>
</html>