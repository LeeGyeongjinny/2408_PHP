CREATE DATABASE IF NOT EXISTS mini_board;

USE mini_board;

DROP TABLE IF EXISTS board;
-- 초기 구축때 있는 것 초기화시키고 한다
-- 주의) 있는 데이터도 날아감

CREATE TABLE board(
	id					BIGINT(20) 		UNSIGNED 	PRIMARY KEY AUTO_INCREMENT
	,title 			VARCHAR(50)						NOT NULL
	,content			VARCHAR(1000) 					NOT NULL
	,created_at 	TIMESTAMP						NOT NULL 	DEFAULT 		CURRENT_TIMESTAMP()
	,updated_at 	TIMESTAMP						NOT NULL 	DEFAULT 		CURRENT_TIMESTAMP()
	,deleted_at 	TIMESTAMP
);