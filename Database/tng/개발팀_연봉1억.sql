SELECT
	employees.emp_id
	,employees.name
	,salaries.salary
	,salaries.end_at sal_end_at
FROM salaries
	JOIN employees
		ON salaries.emp_id = employees.emp_id
			AND salaries.end_at IS NULL
	JOIN	department_emps
		ON department_emps.emp_id = employees.emp_id
			AND department_emps.dept_code = 'D002'
			AND department_emps.end_at IS NULL
;

UPDATE salaries
SET salaries.end_at = DATE(NOW())
	,salaries.updated_at = NOW()
WHERE salaries.end_at IN (
						SELECT salaries.end_at sal_end_at_2
						FROM salaries
							JOIN employees
								ON salaries.emp_id = employees.emp_id
									AND salaries.end_at IS NULL
							JOIN	department_emps
								ON department_emps.emp_id = employees.emp_id
									AND department_emps.dept_code = 'D002'
									AND department_emps.end_at IS NULL
					) IS NULL
;

SELECT
	employees.emp_id
	,department_emps.dept_code
	,salaries.end_at AS sal_end_at_3
	,salaries.updated_at AS sal_updated_at
FROM salaries
	JOIN employees
		ON employees.emp_id = salaries.emp_id
	JOIN department_emps
		ON department_emps.emp_id = employees.emp_id
			AND department_emps.dept_code = 'D002'
			AND department_emps.end_at IS NULL
;

INSERT INTO salaries (
	emp_id
	,salary
	,start_at
)
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
;

SELECT
	COUNT(*)
FROM salaries
WHERE salary = 10000000
;