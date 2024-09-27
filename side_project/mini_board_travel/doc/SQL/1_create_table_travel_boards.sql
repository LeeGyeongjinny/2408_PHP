CREATE DATABASE IF NOT EXISTS travels;

USE travels;

DROP TABLE IF EXISTS travel_boards;

CREATE TABLE travel_boards(
	id					BIGINT(20) 	UNSIGNED		PRIMARY KEY		AUTO_INCREMENT
	,country 		VARCHAR(50)					NOT NULL
	,city 			VARCHAR(50) 				NOT NULL
	,departure 		DATE	 						NOT NULL
	,arrive 			DATE							NOT NULL
	,companion 		VARCHAR(10)
	,content 		VARCHAR(2000) 				NOT NULL
	,created_at	 	TIMESTAMP					NOT NULL 		DEFAULT	CURRENT_TIMESTAMP()
	,updated_at	 	TIMESTAMP					NOT NULL 		DEFAULT	CURRENT_TIMESTAMP()
	,deleted_at		TIMESTAMP
);	