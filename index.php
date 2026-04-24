<?php
require_once "db.php";
require_once "header.php";
?>
<p class="text-center text-muted">현재 버전: <?= $APP_VERSION ?></p>

<!-- 🟦 프로그램명 타이틀 -->
<div class="text-center mb-4">
    <h1 class="fw-bold" style="font-size: 43px;">웹 게시글 프로그램</h1>
    <p class="text-muted">간단한 게시글 등록/수정/삭제 기능을 제공합니다.</p>
</div>

<h3 class="mb-3">📄 게시판 목록</h3>

<?php
$sql = "SELECT b.board_no, b.title, b.create_date, m.name
        FROM Board b
        JOIN Member m ON b.member_no = m.member_no
        ORDER BY b.board_no DESC";

$result = $conn->query($sql);
?>

<table class="table table-hover align-middle">
  <thead class="table-dark">
    <tr>
      <th style="width: 80px">번호</th>
      <th>제목</th>
      <th style="width: 150px">작성자</th>
      <th style="width: 180px">작성일</th>
    </tr>
  </thead>
  <tbody>

  <?php while ($row = $result->fetch_assoc()): ?>
    <tr>
      <td><?php echo $row['board_no']; ?></td>
      <td>
        <a href="detail.php?board_no=<?php echo $row['board_no']; ?>" 
           class="text-decoration-none fw-semibold">
          <?php echo htmlspecialchars($row['title']); ?>
        </a>
      </td>
      <td><?php echo htmlspecialchars($row['name']); ?></td>
      <td><?php echo $row['create_date']; ?></td>
    </tr>
  <?php endwhile; ?>

  </tbody>
</table>

<?php require_once "footer.php"; ?>

