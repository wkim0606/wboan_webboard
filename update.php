<?php
require_once "db.php";
require_once "header.php";

if (!isset($_SESSION['member_no'])) {
    echo "<script>alert('로그인이 필요합니다.'); location.href='login.php';</script>";
    require_once "footer.php";
    exit;
}

if (!isset($_GET['board_no'])) {
    echo "<div class='alert alert-danger'>잘못된 접근입니다.</div>";
    require_once "footer.php";
    exit;
}

$board_no = (int)$_GET['board_no'];

$sql = "SELECT b.board_no, b.title, b.content, b.member_no,
               m.level_no
        FROM Board b
        JOIN Member m ON b.member_no = m.member_no
        WHERE b.board_no = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $board_no);
$stmt->execute();
$result = $stmt->get_result();
$post = $result->fetch_assoc();

if (!$post) {
    echo "<div class='alert alert-danger'>존재하지 않는 게시글입니다.</div>";
    require_once "footer.php";
    exit;
}

$login_member_no = $_SESSION['member_no'];
$login_level_no  = $_SESSION['level_no'] ?? null;

$is_owner = ($login_member_no == $post['member_no']);
$is_admin = ($login_level_no == 9);

if (!($is_owner || $is_admin)) {
    echo "<div class='alert alert-danger'>수정 권한이 없습니다.</div>";
    require_once "footer.php";
    exit;
}
?>

<h2 class="mb-3">게시글 수정</h2>

<form method="post" action="update_process.php">
    <input type="hidden" name="board_no" value="<?php echo $post['board_no']; ?>">

    <div class="mb-3">
      <label class="form-label">제목</label>
      <input type="text" name="title" class="form-control"
             value="<?php echo htmlspecialchars($post['title']); ?>" required>
    </div>

    <div class="mb-3">
      <label class="form-label">내용</label>
      <textarea name="content" class="form-control" rows="10" required><?php
        echo htmlspecialchars($post['content']);
      ?></textarea>
    </div>

    <button type="submit" class="btn btn-primary">저장</button>
    <a href="detail.php?board_no=<?php echo $post['board_no']; ?>" class="btn btn-secondary">취소</a>
</form>

<?php require_once "footer.php"; ?>

