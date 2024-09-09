-- 1. 사원 정보테이블에 자신의 정보를 적절하게 넣어주세요.
INSERT INTO employees (
	name
	,birth
	,gender
	,hire_at
)
VALUES (
	'이경진'
	,'1995-10-21'
	,'F'
	,DATE(NOW())
)
;

-- 2. 월급, 직급, 소속부서 테이블에 자신의 정보를 적절하게 넣어주세요.
INSERT INTO salaries (
	emp_id
	,salary
	,start_at
)
VALUES (
	100001
	,50000000
	,DATE(NOW())
)
;

INSERT INTO title_emps(
	emp_id
	,title_code
	,start_at
)
VALUES (
	100001
	,'T001'
	,DATE(NOW())
)
;

INSERT INTO department_emps(
	emp_id
	,dept_code
	,start_at
)
VALUES (
	100001
	,'D002'
	,DATE(NOW())
)
;

-- 3. 짝궁의 것도 넣어주세요.
INSERT INTO employees (
	name
	,birth
	,gender
	,hire_at
)
VALUES (
	'강태희'
	,'2000-01-01'
	,'F'
	,DATE(NOW())
)
;

INSERT INTO salaries (
	emp_id
	,salary
	,start_at
)
VALUES (
	100002
	,50000000
	,DATE(NOW())
)
;

INSERT INTO title_emps(
	emp_id
	,title_code
	,start_at
)
VALUES (
	100002
	,'T001'
	,DATE(NOW())
)
;

INSERT INTO department_emps(
	emp_id
	,dept_code
	,start_at
)
VALUES (
	100002
	,'D002'
	,DATE(NOW())
)
;

-- 4. 나와 짝궁의 소속 부서를 D009로 변경해 주세요.
UPDATE department_emps
SET updated_at = NOW()
	,end_at = DATE(NOW())
WHERE emp_id IN (100001,100002)
;

INSERT INTO department_emps(
	emp_id
	,dept_code
	,start_at
)
VALUES
	('100001', 'D009', DATE(NOW()))
	,('100002', 'D009', DATE(NOW()))
;

-- 5. 짝궁의 모든 정보를 삭제해 주세요.
DELETE FROM salaries
WHERE emp_id = 100002
;

DELETE FROM title_emps
WHERE emp_id = 100002
;

DELETE FROM department_emps
WHERE emp_id = 100002
;

DELETE FROM employees
WHERE emp_id = 100002
;

-- 6. 'D009'부서의 관리자를 나로 변경해 주세요.
SELECT *
FROM department_managers
WHERE
	dept_code = 'D009'
	AND end_at IS NULL
;

UPDATE department_managers
SET updated_at = NOW()
	,end_at = DATE(NOW())
WHERE dept_mgr_id = 64
;

INSERT INTO department_managers (
	emp_id
	,dept_code
	,start_at
)
VALUES (
	100001
	,'D009'
	,DATE(NOW())
)
;

-- 7. 오늘 날짜부로 나의 직책을 '대리'로 변경해 주세요.
UPDATE title_emps
SET updated_at = NOW()
	,end_at = DATE(NOW())
WHERE title_emp_id = 181458
;

SELECT *
FROM title_emps
WHERE emp_id = 100001;

INSERT INTO title_emps (
	emp_id
	,title_code
	,start_at
)
VALUES (
	100001
	,'T002'
	,DATE(NOW())
)
;

-- 8. 최저 연봉 사원의 사번과 이름, 연봉을 출력해 주세요.
-- SELECT
-- 	employees.emp_id
-- 	,employees.name
-- 	,salaries.salary
-- FROM employees
-- 	JOIN salaries
-- 		ON employees.emp_id = salaries.emp_id
-- 			AND salaries.end_at IS NULL
-- 			AND salaries.salary IN (
-- 				SELECT MIN(salaries.salary)
-- 				FROM salaries
-- 				WHERE salaries.end_at IS NULL
-- 				)
-- ORDER BY salaries.salary ASC
-- LIMIT 1
-- ;

SELECT 
	employees.emp_id
	,employees.name
	,salaries.salary
FROM employees
	JOIN salaries
		ON employees.emp_id = salaries.emp_id
		AND employees.fire_at IS NULL
		AND salaries.salary IN (
			SELECT MIN(salaries.salary)
			FROM salaries
			WHERE salaries.end_at IS null
		)
;

-- 9. 전체 사원의 평균 연봉을 출력해 주세요.
SELECT
	AVG(salaries.salary)
FROM salaries
WHERE
	salaries.end_at IS NULL
;

-- 10. 사번이 54321인 사원의 지금까지 평균 연봉을 출력해 주세요.
SELECT
	emp_id
	,AVG(salary)
FROM salaries
WHERE
	emp_id = 54321
GROUP BY emp_id
;

-- 01 아래 구조의 테이블을 작성하는 SQL을 작성해 주세요.
CREATE TABLE users(
	userid		INT			UNSIGNED		PRIMARY KEY	AUTO_INCREMENT
	,username	VARCHAR(30)					NOT NULL
	,authflg		CHAR(1)						DEFAULT '0'
	,birthday	DATE							NOT NULL
	,created_at	DATETIME 					DEFAULT	CURRENT_DATE()
)
;

-- 02 [01]에서 만든 테이블에 아래 데이터를 입력해 주세요.
INSERT INTO users (
	username
	,authflg
	,birthday
	,created_at
)
VALUES (
	'그린'
	,'0'
	,'2024-01-26'
	,CURRENT_DATE() 
)
;

-- 03 [02]에서 만든 레코드를 아래 데이터로 갱신해 주세요.
UPDATE users
SET username = '테스터'
	,authflg = '1'
	,birthday = '2007-03-01'
WHERE userid = 1
;

-- 04 [02]에서 만든 레코드를 삭제해 주세요.
DELETE FROM users
WHERE userid = 1
;

-- 05 [01]에서 만든 테이블에 아래 Column을 추가해 주세요.
ALTER TABLE users
ADD COLUMN addr VARCHAR(100)	NOT NULL DEFAULT '-'
;

-- 06 [01]에서 만든 테이블을 삭제해 주세요.
DROP TABLE users;

-- 07 아래 테이블에서 유저명, 생일, 랭크명을 출력해 주세요.
-- 조건1 : rankmanagement의 FK인 userid는 users의 userid를 참조 중
-- 조건2 : Table users
-- 조건3 : Table rankmanagement

SELECT
	users.username
	,users.birthday
	,rankmanagement.rankname
FROM users
	JOIN rankmanagement
		ON users.userid = rankmanagement.userid
			AND users.userid = 1
;