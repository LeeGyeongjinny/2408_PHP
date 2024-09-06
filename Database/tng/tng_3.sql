UPDATE salaries
SET end_at = DATE(NOW())
	,updated_at = NOW()
WHERE 
	emp_id = 99995
	AND end_at IS NULL
;

INSERT INTO salaries (
	emp_id
	,salary
	,start_at
	,end_at
	,created_at
	,updated_at
	,deleted_at
)
VALUES (
	99995
	,40000000
	,DATE(NOW())
	,NULL
	,NOW()
	,NOW()
	,NULL
);

SELECT *
FROM salaries
WHERE emp_id = 99995
;

-- pk로 하면 절대 다른게 선택되지 않는다
-- pk값 직접 넣기 대신 subQuery로 pk값 넣기
UPDATE salaries
SET
	updated_at = NOW()
	,end_at = DATE(NOW())
WHERE sal_id = (
						SELECT sal_id
						FROM salaries
						WHERE emp_id = 99992
						ORDER BY start_at DESC
						LIMIT 1
					)
;

INSERT INTO salaries (
	emp_id
	,salary
	,start_at
)
VALUES (
	99992
	,35000000
	,DATE(NOW())
);

-- 잘 적용됐나 확인
SELECT *
FROM salaries
WHERE emp_id = 99992
;

-- pk 값 알아내기
SELECT sal_id
FROM salaries
WHERE emp_id = 99992
ORDER BY start_at DESC
LIMIT 1
;

