-- 사원의 사번, 이름, 현재 직급명, 현재 소속부서명, 현재 연봉 조회
SELECT
	employees.emp_id
	,employees.name
	,titles.title
	,departments.dept_name
	,salaries.salary
FROM employees
	JOIN title_emps
		ON title_emps.emp_id = employees.emp_id
			AND title_emps.end_at IS NULL
	JOIN titles
		ON titles.title_code = title_emps.title_code
	JOIN department_emps
		ON department_emps.emp_id = employees.emp_id
			AND department_emps.end_at IS NULL
	JOIN departments
		ON departments.dept_code = department_emps.dept_code
	JOIN salaries
		ON salaries.emp_id = employees.emp_id
			AND salaries.end_at IS NULL
;

-- view 생성
CREATE VIEW view_emp_now_data
AS
SELECT
	employees.emp_id
	,employees.name
	,titles.title
	,departments.dept_name
	,salaries.salary
FROM employees
	JOIN title_emps
		ON title_emps.emp_id = employees.emp_id
			AND title_emps.end_at IS NULL
	JOIN titles
		ON titles.title_code = title_emps.title_code
	JOIN department_emps
		ON department_emps.emp_id = employees.emp_id
			AND department_emps.end_at IS NULL
	JOIN departments
		ON departments.dept_code = department_emps.dept_code
	JOIN salaries
		ON salaries.emp_id = employees.emp_id
			AND salaries.end_at IS NULL
;

-- view 사용
SELECT * FROM view_emp_now_data;

-- view 삭제
DROP VIEW view_emp_now_data;