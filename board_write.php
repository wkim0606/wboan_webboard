<?php
require_once "db.php";
require_once "header.php";

if (!isset($_SESSION["member_no"])) {
    echo "<script>alert('로그인이 필요합니다.'); location.href='login.php';</script>";
    require_once "footer.php";
    exit;
}
?>

<h2 class="mb-3">게시글 작성</h2>

<form method="post" action="board_write_process.php">
  <div class="mb-3">
    <label class="form-label">제목</label>
    <input type="text" name="title" class="form-control" required>
  </div>

  <div class="mb-3">
    <label class="form-label">내용</label>
    <textarea name="content" rows="10" class="form-control" required></textarea>
  </div>

  <button type="submit" class="btn btn-primary">등록</button>
  <a href="index.php" class="btn btn-secondary">목록</a>
</form>

<?php require_once "footer.php"; ?>

