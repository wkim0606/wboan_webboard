<?php
session_start();
require_once "db.php";

$id = $_POST["id"];
$passwd = hash("sha256", $_POST["passwd"]);

$sql = "SELECT * FROM Member WHERE id=? AND passwd=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $id, $passwd);
$stmt->execute();

$result = $stmt->get_result();
$user = $result->fetch_assoc();

if ($user) {
    $_SESSION["member_no"] = $user["member_no"];
    $_SESSION["name"] = $user["name"];
    $_SESSION["level_no"] = $user["level_no"];
    echo "<script>alert('로그인 성공!'); location.href='index.php';</script>";
} else {
    echo "<script>alert('아이디 또는 비밀번호 오류'); history.back();</script>";
}
?>

