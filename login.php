<?php
require_once "header.php";  // 공통 헤더 포함
?>

<div class="d-flex justify-content-center mt-5">
  <div class="card shadow-sm" style="width: 380px;">
    <div class="card-body">

      <h3 class="text-center mb-4">로그인</h3>

      <form method="post" action="login_process.php">

        <div class="mb-3">
          <label class="form-label">아이디</label>
          <input type="text" name="id" class="form-control" required>
        </div>

        <div class="mb-3">
          <label class="form-label">비밀번호</label>
          <input type="password" name="passwd" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary w-100">로그인</button>

      </form>

    </div>
  </div>
</div>

<?php
require_once "footer.php";  // 공통 푸터 포함
?>

