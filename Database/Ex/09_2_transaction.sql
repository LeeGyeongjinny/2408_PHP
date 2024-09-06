-- Transaction 시작
START TRANSACTION;

-- INSERT
INSERT INTO employees (
	NAME, birth, gender, hire_at
)
VALUES (
	'이경진', '2000-01-01', 'F', DATE(NOW())
);

-- SELECT
SELECT * FROM employees WHERE emp_id >= 100001;

-- rollback
-- ROLLBACK;

-- commit
COMMIT;