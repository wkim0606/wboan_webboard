<!DOCTYPE html>
<html lang="ko">
<head>
<meta charset="UTF-8">
<title>회원 등록</title>
</head>
<body>
<h2>회원 등록</h2>

<form method="post" action="member_register_process.php">
    아이디: <input type="text" name="id" required><br><br>
    비밀번호: <input type="password" name="passwd" required><br><br>
    이름: <input type="text" name="name" required><br><br>

    등급 선택:
    <select name="level_no" required>
        <option value="">--선택--</option>
        <option value="1">일반회원</option>
        <option value="2">운영자</option>
        <option value="3">VIP</option>
        <option value="9">관리자</option>
    </select>
    <br><br>

    <button type="submit">회원 등록</button>
</form>
</body>
</html>

