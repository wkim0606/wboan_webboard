<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="ko">
<head>
<meta charset="UTF-8">
<title>웹 게시판</title>
<!-- Bootstrap 5 CDN -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
  <div class="container">
    <a class="navbar-brand" href="index.php">WebBoard</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav me-auto">
        <li class="nav-item"><a class="nav-link" href="index.php">홈</a></li>
        <li class="nav-item"><a class="nav-link" href="board_write.php">글쓰기</a></li>
        <li class="nav-item"><a class="nav-link" href="admin.php">관리자</a></li>
      </ul>
      <ul class="navbar-nav">
        <?php if (isset($_SESSION['member_no'])): ?>
            <li class="nav-item">
              <span class="navbar-text me-2">
                <?php echo htmlspecialchars($_SESSION['name']); ?>님
              </span>
            </li>
            <li class="nav-item"><a class="nav-link" href="logout.php">로그아웃</a></li>
        <?php else: ?>
            <li class="nav-item"><a class="nav-link" href="login.php">로그인</a></li>
            <li class="nav-item"><a class="nav-link" href="member_register.php">회원가입</a></li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>
<div class="container">

