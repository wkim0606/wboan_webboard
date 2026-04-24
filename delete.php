<?php
require_once "db.php";
session_start();

if (!isset($_SESSION['member_no'])) {
    echo "<script>alert('로그인이 필요합니다.'); location.href='login.php';</script>";
    exit;
}

if (!isset($_GET['board_no'])) {
    echo "<script>alert('잘못된 접근입니다.'); history.back();</script>";
    exit;
}

$board_no = (int)$_GET['board_no'];

// 권한 체크 (작성자 또는 관리자)
$sql = "SELECT b.member_no, m.level_no
        FROM Board b
        JOIN Member m ON b.member_no = m.member_no
        WHERE b.board_no = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $board_no);
$stmt->execute();
$result = $stmt->get_result();
$post = $result->fetch_assoc();

if (!$post) {
    echo "<script>alert('존재하지 않는 게시글입니다.'); history.back();</script>";
    exit;
}

$login_member_no = $_SESSION['member_no'];
$login_level_no  = $_SESSION['level_no'] ?? null;

$is_owner = ($login_member_no == $post['member_no']);
$is_admin = ($login_level_no == 9);

if (!($is_owner || $is_admin)) {
    echo "<script>alert('삭제 권한이 없습니다.'); history.back();</script>";
    exit;
}

// 삭제 수행
$sql_del = "DELETE FROM Board WHERE board_no = ?";
$stmt2 = $conn->prepare($sql_del);
$stmt2->bind_param("i", $board_no);

if ($stmt2->execute()) {
    echo "<script>alert('삭제되었습니다.'); location.href='index.php';</script>";
} else {
    echo "오류: " . $stmt2->error;
}
?>

