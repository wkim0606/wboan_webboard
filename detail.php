<?php
require_once "db.php";
require_once "header.php";

if (!isset($_GET['board_no'])) {
    echo "<div class='alert alert-danger'>잘못된 접근입니다.</div>";
    require_once "footer.php";
    exit;
}

$board_no = (int)$_GET['board_no'];

$sql = "SELECT b.board_no, b.title, b.content, b.create_date,
               m.member_no, m.name, m.level_no
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

// 권한 체크용
$login_member_no = $_SESSION['member_no'] ?? null;
$login_level_no  = $_SESSION['level_no'] ?? null;  // 없을 수도 있으니 admin 페이지에서 세션 셋팅하거나 추가 구현 가능

$is_owner = ($login_member_no && $login_member_no == $post['member_no']);
$is_admin = ($login_level_no && $login_level_no == 9);
?>

<div class="card">
  <div class="card-header">
    <h4><?php echo htmlspecialchars($post['title']); ?></h4>
    <small>
      작성자: <?php echo htmlspecialchars($post['name']); ?> |
      작성일: <?php echo $post['create_date']; ?>
    </small>
  </div>
  <div class="card-body">
    <p><?php echo nl2br(htmlspecialchars($post['content'])); ?></p>
  </div>
  <div class="card-footer text-end">
    <a href="index.php" class="btn btn-secondary btn-sm">목록</a>
    <?php if ($is_owner || $is_admin): ?>
      <a href="update.php?board_no=<?php echo $post['board_no']; ?>" class="btn btn-primary btn-sm">수정</a>
      <a href="delete.php?board_no=<?php echo $post['board_no']; ?>" class="btn btn-danger btn-sm"
         onclick="return confirm('정말 삭제하시겠습니까?');">삭제</a>
    <?php endif; ?>
  </div>
</div>

<?php require_once "footer.php"; ?>

