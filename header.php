<?php
require_once "config.php";
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="ko">
<head>
<meta charset="UTF-8">
<title>웹 게시글 프로그램 <?= $APP_VERSION ?></title>

<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>

<!-- Navigation Bar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container">

    <!-- Left Brand -->
    <a class="navbar-brand fw-bold" href="index.php">WebBoard</a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">

      <!-- Left Menu -->
      <ul class="navbar-nav me-auto">
        <li class="nav-item"><a class="nav-link" href="index.php">홈</a></li>

        <?php if (isset($_SESSION['member_no'])): ?>
        <li class="nav-item"><a class="nav-link" href="board_write.php">글쓰기</a></li>
        <?php endif; ?>

        <?php if (isset($_SESSION['level_no']) && $_SESSION['level_no'] == 9): ?>
        <li class="nav-item"><a class="nav-link" href="admin.php">관리자</a></li>
        <?php endif; ?>
      </ul>

      <!-- Right Menu -->
      <ul class="navbar-nav">
        <?php if (isset($_SESSION['member_no'])): ?>
          <span class="navbar-text text-light me-3">
            <?php echo htmlspecialchars($_SESSION['name']); ?> 님
          </span>
          <li class="nav-item"><a class="nav-link" href="logout.php">로그아웃</a></li>

        <?php else: ?>
          <li class="nav-item"><a class="nav-link" href="login.php">로그인</a></li>
          <li class="nav-item"><a class="nav-link" href="member_register.php">회원가입</a></li>
        <?php endif; ?>
      </ul>

    </div>
  </div>
</nav>

<div class="container my-4">

