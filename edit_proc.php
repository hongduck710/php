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


//echo $_POST['edit_no'];
//exit;

$user_id = trim($_POST['user_id']);
$user_pw = trim($_POST['user_pw']);

$name = trim($_POST['name']);
$age = trim($_POST['age']);

if($_POST['gender'] == "" && empty($_POST['gender']))
{
    $gender = "선택안함";
} else {
    $gender = $_POST['gender'];
}

/*
Array
(
    [name] => 독고분녀
    [age] => 
    [gender] => 여
)
*/

//변수 초기화
$file_name = $upload_dir = "";

if( $_FILES['photo']['name'] )
{
    //파일 업로드 추가
    $upload_dir = "./uploads";
    $ext_chk = array("jpg", "jpeg", "png", "gif");

    // 파일 처리 위한 변수 선언
    $err = $_FILES['photo']['error'];
    $file_name = $_FILES['photo']['name'];
    $ext_ = explode(".", $file_name);
    $file_ext = array_pop( $ext_ );
    // $file_ext = array("산", "jpg");
    //"산.지리산.jpg" => array("산", "지리산", "jpg");

    if( !in_array($file_ext, $ext_chk) )
    {
        echo "허용되지 않는 파일이에요 ㅠㅠ <br />";
        echo "<a href='./index.php'>홈으로</a>";
        exit;
    }

    move_uploaded_file($_FILES['photo']['tmp_name'], $upload_dir."/".$file_name);
    $sql_query = " update members set user_id='".$user_id."', user_pw='".md5($user_pw)."', name='".$name."', age='".$age."', gender='".$gender."' , img_path='".$upload_dir."', img_name='".$file_name."' where idx='".$_POST['edit_no']."' "; //insert into가 하나의 명령어!
    $result = mysqli_query($connect, $sql_query);
} else {
    $sql_query = " update members set user_id='".$user_id."', user_pw='".md5($user_pw)."', name='".$name."', age='".$age."', gender='".$gender."' where idx='".$_POST['edit_no']."' "; //insert into가 하나의 명령어!
    $result = mysqli_query($connect, $sql_query);
} //공백으로 들어가면 기존에 있었던 파일까지 제거가 되므로 else 처리를 해줌


if($result)
{
    echo "정보가 정상적으로 수정 되었어요!";
} else {
    echo "정보 수정에 실패했어요!ㅠㅠ";
}


echo "<a href='./index.php'>홈으로</a>";

?>