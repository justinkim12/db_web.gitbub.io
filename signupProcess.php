<?php
$conn = mysqli_connect("127.0.0.1", "root", "!@#jung4609",
"nba_db");
$hashedPassword = password_hash($_POST['password'], PASSWORD_DEFAULT);
// echo $hashedPassword;
$query="select * from player_info 
        where f_name='{$_POST['firstname']}' and l_name='{$_POST['lastname']}';";

$result = mysqli_query($conn, $query);
$row = mysqli_fetch_array($result, MYSQLI_ASSOC) ;

if($row){
$sql = "
    INSERT INTO user_info
    (email, password, created,f_team_id,f_player_f_name,f_player_l_name)
    VALUES('{$_POST['email']}', '{$hashedPassword}', NOW(),'{$_POST['selectbox']}',
    '{$_POST['firstname']}','{$_POST['lastname']}'
    )";
echo $sql;
$result = mysqli_query($conn, $sql);
}
else{
    echo '선수 이름 불일치';
    $result=false;
}
if ($result === false) {
    echo "저장에 문제가 생겼습니다. 관리자에게 문의해주세요.";
    echo mysqli_error($conn);
} else {
?>
    <script>
        alert("회원가입이 완료되었습니다");
        location.href = "home.php";
    </script>
<?php
}
?>