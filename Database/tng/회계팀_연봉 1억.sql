SELECT
	COUNT(8)
FROM department_emps
WHERE dept_code = 'D007'
;

SELECT *
FROM department_emps
WHERE dept_code = 'D007'
	AND end_at IS NULL
;

SELECT
	employees.emp_id
	,employees.name
	,salaries.salary
	,salaries.end_at
	,department_emps.dept_code
FROM salaries
	JOIN employees
		ON employees.emp_id = salaries.emp_id
			AND salaries.end_at IS NULL
	JOIN department_emps
		ON department_emps.emp_id = employees.emp_id
			AND department_emps.dept_code = 'D007'
			AND department_emps.end_at IS NULL
;

UPDATE salaries
SET salaries.updated_at = NOW()
	,salaries.end_at = DATE(NOW())
WHERE salaries.sal_id IN (
									SELECT
										salaries.sal_id
									FROM salaries
										JOIN employees
											ON employees.emp_id = salaries.emp_id
												AND salaries.end_at IS NULL
										JOIN department_emps
											ON department_emps.emp_id = employees.emp_id
												AND department_emps.dept_code = 'D007'
												AND department_emps.end_at IS NULL
								)
;

SELECT
	salaries.emp_id
FROM salaries
	JOIN employees
		ON employees.emp_id = salaries.emp_id
			AND salaries.end_at = '2024-09-06'
	JOIN department_emps
		ON department_emps.emp_id = employees.emp_id
			AND department_emps.dept_code = 'D007'
			AND department_emps.end_at IS NULL
;

INSERT INTO salaries (
	emp_id
	,salary
	,start_at
)
SELECT DISTINCT
	employees.emp_id
	,100000000


SELECT DISTINCT
	 employees.emp_id
	,10000000 salary
	,DATE(NOW()) start_at
FROM salaries salsal
	JOIN employees
		ON employees.emp_id = salsal.emp_id
	JOIN department_emps
		ON department_emps.emp_id = employees.emp_id
			AND department_emps.dept_code = 'D002'
			AND department_emps.end_at IS NULL