<?php
require_once "db.php";
require_once "header.php";

$sql = "SELECT b.board_no, b.title, b.create_date, m.name
        FROM Board b
        JOIN Member m ON b.member_no = m.member_no
        ORDER BY b.board_no DESC";
$result = $conn->query($sql);
?>

<h2 class="mb-3">게시판 목록</h2>

<table class="table table-hover">
  <thead class="table-dark">
    <tr>
      <th>번호</th>
      <th>제목</th>
      <th>작성자</th>
      <th>작성일</th>
    </tr>
  </thead>
  <tbody>
  <?php while ($row = $result->fetch_assoc()): ?>
    <tr>
      <td><?php echo $row['board_no']; ?></td>
      <td>
        <a href="detail.php?board_no=<?php echo $row['board_no']; ?>">
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

