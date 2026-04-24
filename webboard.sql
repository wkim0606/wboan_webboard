-- 2025. 11. 22 by WBOAN
--
- database (webboard) 생성
-- 
CREATE DATABASE IF NOT EXISTS webboard
  DEFAULT CHARACTER SET utf8mb4;          
USE webboard;

-- database (webboard)-MemberLevel table 생성
-- 
CREATE TABLE MemberLevel (                            -- MemberLevel 테이블 먼저 생성 필요
  level_no      INT AUTO_INCREMENT PRIMARY KEY,  -- 회원등급번호, PK, 자동 증가
  level_name    VARCHAR(50) NOT NULL UNIQUE,       -- 등급이름, 중복 방지
  level_desc    VARCHAR(200) NULL                        -- 등급설명, NULL 허용
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;    -- transaction, foreign key 지원

SHOW INDEX from MemberLevel; 

-- webboard-Member table 생성
--
CREATE TABLE Member (
  member_no    INT AUTO_INCREMENT PRIMARY KEY,                     -- 회원번호 (PK, AI)
  id                 VARCHAR(50) NOT NULL UNIQUE,
  passwd          VARCHAR(255) NOT NULL,
  name             VARCHAR(50) NOT NULL,
  level_no         INT NOT NULL,                                 -- 이름/도메인 맞춤
  regdate          DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,   -- 가입일자 (기본값 현재시간)
  
  CONSTRAINT fk_member_level FOREIGN KEY (level_no) 
      REFERENCES MemberLevel(level_no)
      ON UPDATE CASCADE        -- 부모테이블의 PK값이 바뀌면 FK도 변경됨
      ON DELETE RESTRICT         -- 부모테이블의 행 삭제하는 경우 자식 테이블에서 참조하는 데이터가 있으면 삭제를 금지
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=1;

SHOW INDEX from Member ; 

-- webboard-Board table 생성
--
CREATE TABLE Board (
  board_no       INT AUTO_INCREMENT PRIMARY KEY,    -- 글번호 (PK, AI)
  member_no   INT NOT NULL,                                  -- 회원번호 (FK  Member)
  title              VARCHAR(255) NOT NULL,                    -- 글제목
  content         LONGTEXT NOT NULL,
  create_date    DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,

  CONSTRAINT fk_board_member
    FOREIGN KEY (member_no) REFERENCES Member(member_no)
    ON UPDATE CASCADE                                  -- 부모테이블의 PK값이 바뀌면 FK도 변경됨
    ON DELETE CASCADE                                   -- 게시글은 회원삭제 시 함께 삭제
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;      -- transaction, foreign key 지원

SHOW INDEX from Board ; 
-- MemberLevel 에 초기 데이터 입력
--
INSERT INTO MemberLevel (level_no, level_name, level_desc) VALUES
(1, '일반회원', '가입 시 기본 권한을 가진 회원'),
(2, '운영자', '운영권한을 가진회원'), 
(3, 'VIP', '가입 시 VVIP 권한을 가진 회원'),
(9, '관리자',   '사이트 운영 및 모든 권한을 가진 관리자');

INSERT INTO member (id, passwd, name, level_no, regdate) VALUES
('admin',   'admin1234',   '관리자', 9, NOW()),
('wboan01', 'wboan011234', '홍길동', 1, '2025-08-31'),
('wboan02', 'wboan021234', '홍길이', 2, NOW()),
('wboan03', 'wboan031234', '홍길삼', 3, NOW()),
('user01',  SHA2('user011234', 256),  '홍길사', 3, NOW()),
('user02',  SHA2('user021234', 256),  '홍길사', 3, NOW());

INSERT INTO Board (member_no, title, content)
VALUES (1, '첫 번째 게시글입니다', '게시판 기능 테스트를 위한 첫 번째 글입니다.');

INSERT INTO Board (member_no, title, content)
VALUES (2, '두 번째 게시글입니다', '두 번째 테스트 글을 등록합니다.');

SELECT * FROM information_schema.TABLES WHERE table_schema='webboard';
