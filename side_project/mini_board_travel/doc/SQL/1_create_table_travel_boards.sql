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

DROP TABLE IF EXISTS bucket_lists;
CREATE TABLE bucket_lists(
	bkl_id				BIGINT(20) 	UNSIGNED		PRIMARY KEY		AUTO_INCREMENT
	,title				VARCHAR(50)					NOT NULL
	,bucket_content 	VARCHAR(1000) 				NOT NULL
	,country 			VARCHAR(50)					NOT NULL
	,sort 				VARCHAR(15)					NOT NULL
	,info_content 		VARCHAR(100)
	,info_img 			VARCHAR(600)
);

INSERT INTO travel_boards(
	country
	,city
	,departure
	,arrive
	,content	
)
VALUES
	('미국', '올랜도')
	,('미국', '올랜도')
	,('미국', '올랜도')
	,('미국', '올랜도')
	,('미국', '올랜도')
	,('미국', '올랜도')
	,('미국', '올랜도')
	,('미국', '올랜도')
	,('미국', '올랜도')
;