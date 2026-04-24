<?php
session_start();
require_once "db.php";

if (!isset($_SESSION["member_no"])) {
    echo "<script>alert('로그인이 필요합니다.'); location.href='login.php';</script>";
    exit;
}

$member_no = $_SESSION["member_no"];
$title = $_POST["title"];
$content = $_POST["content"];

$sql = "INSERT INTO Board (member_no, title, content)
        VALUES (?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("iss", $member_no, $title, $content);

if ($stmt->execute()) {
    echo "<script>alert('게시글 등록 완료!'); location.href='index.php';</script>";
} else {
    echo "오류: " . $stmt->error;
}
?>

