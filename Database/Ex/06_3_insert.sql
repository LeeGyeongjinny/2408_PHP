-- INSERT문 : 신규 데이터를 저장

-- 기본구조
-- INSERT INTO 테이블명 (컬럼1, 컬럼2...)
-- VALUES (값1, 값2...);

INSERT INTO employees(
	NAME
	,birth
	,gender
	,hire_at
	,fire_at
	,sup_id
	,created_at
	,updated_at
	,deleted_at
)
VALUES (
	'이경진'
	,'2000-01-01'
	,'F'
	,'2024-09-02'
	,NULL
	,NULL
	,'2024-09-02 00:00:00'
	,'2024-09-02 00:00:00'
	,NULL
);

-- select insert
INSERT INTO employees(
	NAME
	,birth
	,gender
	,hire_at
	,fire_at
	,sup_id
	,created_at
	,updated_at
	,deleted_at
)
SELECT
	NAME
	,birth
	,gender
	,hire_at
	,fire_at
	,sup_id
	,created_at
	,updated_at
	,deleted_at
FROM employees
WHERE emp_id IN (1,2)
;

-- 자신의 직급 정보 삽입
INSERT INTO title_emps(
	emp_id
	,title_code
	,start_at
	,end_at
	,created_at
	,updated_at
	,deleted_at
)
VALUES (
	100002
	,'T001'
	,'2024-09-02'
	,NULL
	,'2024-09-02 00:00:00'
	,'2024-09-02 00:00:00'
	,NULL 
)
;

-- 내가 넣은 정보 확인하기
SELECT * FROM title_emps WHERE emp_id = 100002;

-- 자신의 급여 정보 삽입
INSERT INTO salaries(
	emp_id
	,salary
	,start_at
	,end_at
	,created_at
	,updated_at
	,deleted_at
)
VALUES (
	100002
	,50000000
	,'2024-09-02'
	,NULL
	,'2024-09-02 00:00:00'
	,'2024-09-02 00:00:00'
	,NULL
)
;

-- 자신의 소속 부서 삽입
INSERT INTO department_emps(
	emp_id
	,dept_code
	,start_at
	,end_at
	,created_at
	,updated_at
	,deleted_at
)
VALUES (
	100002
	,'D009'
	,'2024-09-02'
	,NULL
	,'2024-09-02 00:00:00'
	,'2024-09-02 00:00:00'
	,NULL
)
;

