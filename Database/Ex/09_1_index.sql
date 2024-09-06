-- INDEX 확인
SHOW INDEX FROM employees;

-- 0.032초 
SELECT * FROM employees  WHERE NAME = '주정웅';

-- INDEX 생성
ALTER TABLE employees ADD INDEX idx_employees_name (NAME);

-- 0.000초 
SELECT * FROM employees WHERE NAME = '주정웅';

-- INDEX 제거
DROP INDEX idx_employees_name ON employees;

