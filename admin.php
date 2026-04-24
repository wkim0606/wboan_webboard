<?php
require_once "db.php";
require_once "header.php";

$login_level_no = $_SESSION['level_no'] ?? null;

if ($login_level_no != 9) {
    echo "<div class='alert alert-danger'>관리자만 접근 가능합니다.</div>";
    require_once "footer.php";
    exit;
}

// 회원 목록
$sql_member = "SELECT m.member_no, m.id, m.name, m.level_no, ml.level_name, m.regdate
               FROM Member m
               JOIN MemberLevel ml ON m.level_no = ml.level_no
               ORDER BY m.member_no ASC";
$res_member = $conn->query($sql_member);

// 게시글 목록
$sql_board = "SELECT b.board_no, b.title, b.create_date, m.name
              FROM Board b
              JOIN Member m ON b.member_no = m.member_no
              ORDER BY b.board_no DESC";
$res_board = $conn->query($sql_board);
?>

<h2 class="mb-4">관리자 페이지</h2>

<h4>회원 목록</h4>
<table class="table table-sm table-bordered mb-4">
  <thead class="table-light">
    <tr>
      <th>회원번호</th>
      <th>아이디</th>
      <th>이름</th>
      <th>등급번호</th>
      <th>등급명</th>
      <th>가입일</th>
    </tr>
  </thead>
  <tbody>
  <?php while ($row = $res_member->fetch_assoc()): ?>
    <tr>
      <td><?php echo $row['member_no']; ?></td>
      <td><?php echo htmlspecialchars($row['id']); ?></td>
      <td><?php echo htmlspecialchars($row['name']); ?></td>
      <td><?php echo $row['level_no']; ?></td>
      <td><?php echo htmlspecialchars($row['level_name']); ?></td>
      <td><?php echo $row['regdate']; ?></td>
    </tr>
  <?php endwhile; ?>
  </tbody>
</table>

<h4>게시글 목록</h4>
<table class="table table-sm table-bordered">
  <thead class="table-light">
    <tr>
      <th>글번호</th>
      <th>제목</th>
      <th>작성자</th>
      <th>작성일</th>
      <th>관리</th>
    </tr>
  </thead>
  <tbody>
  <?php while ($row = $res_board->fetch_assoc()): ?>
    <tr>
      <td><?php echo $row['board_no']; ?></td>
      <td><?php echo htmlspecialchars($row['title']); ?></td>
      <td><?php echo htmlspecialchars($row['name']); ?></td>
      <td><?php echo $row['create_date']; ?></td>
      <td>
        <a href="detail.php?board_no=<?php echo $row['board_no']; ?>" class="btn btn-sm btn-secondary">보기</a>
        <a href="delete.php?board_no=<?php echo $row['board_no']; ?>"
           class="btn btn-sm btn-danger"
           onclick="return confirm('정말 이 글을 삭제할까요?');">삭제</a>
      </td>
    </tr>
  <?php endwhile; ?>
  </tbody>
</table>

<?php require_once "footer.php"; ?>

