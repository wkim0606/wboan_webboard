<?php
require_once "db.php";

$id = $_POST["id"];
$passwd = $_POST["passwd"];
$name = $_POST["name"];
$level_no = $_POST["level_no"];

// 보안을 위해 비밀번호 해시
$hashed_pw = hash("sha256", $passwd);

$sql = "INSERT INTO Member (id, passwd, name, level_no)
        VALUES (?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("sssi", $id, $hashed_pw, $name, $level_no);

if ($stmt->execute()) {
    echo "<script>alert('회원가입 성공!'); location.href='index.php';</script>";
} else {
    echo "오류 발생: " . $stmt->error;
}
?>

