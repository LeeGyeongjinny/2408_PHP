CREATE DATABASE IF NOT EXISTS travels;

USE travels;

DROP TABLE IF EXISTS travel_boards;

CREATE TABLE travel_boards(
	id					BIGINT(20) 	UNSIGNED		PRIMARY KEY		AUTO_INCREMENT
	,country 		VARCHAR(50)					NOT NULL
	,city 			VARCHAR(50) 				NOT NULL
	,departure 		DATE	 						NOT NULL
	,arrival 			DATE							NOT NULL
	,companion 		VARCHAR(10)
	,title			VARCHAR(50)					NOT NULL
	,content 		VARCHAR(2000) 				NOT NULL
	,img_1			VARCHAR(600)
	,img_2			VARCHAR(600)
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
	,created_at	 		TIMESTAMP					NOT NULL 		DEFAULT	CURRENT_TIMESTAMP()
	,updated_at	 		TIMESTAMP					NOT NULL 		DEFAULT	CURRENT_TIMESTAMP()
	,deleted_at			TIMESTAMP
);

INSERT INTO travel_boards(
	country
	,city
	,departure
	,arrival
	,title
	,content	
)
VALUES
	('한국', '대구','2025-01-01','2025-01-02','한국 좋아','대구 좋아용')
	,('한국', '서울','2025-01-01','2025-01-02','한국 좋아','서울 좋아용')
	,('이탈리아', '피렌체','2025-01-01','2025-01-02','이탈리아 좋아','피렌체 좋아용')
	,('이탈리아', '베네치아','2025-01-01','2025-01-02','이탈리아 좋아','베네치아 좋아용')
	,('영국', '런던','2025-01-01','2025-01-02','영국 좋아','런던 좋아용')
	,('미국', '올랜도','2025-01-01','2025-01-02','미국 좋아','올랜도 좋아용')
	,('미국', '뉴욕','2025-01-01','2025-01-02','미국 좋아','뉴욕 좋아용')
	,('프랑스', '파리','2025-01-01','2025-01-02','프랑스 좋아','프랑스 좋아용')
	,('스페인', '바르셀로나','2025-01-01','2025-01-02','스페인 좋아','바르셀로나 좋아용')
	,('태국', '방콕','2025-01-01','2025-01-02','태국 좋아','방콕 좋아용')
	,('체코', '프라하','2025-01-01','2025-01-02','체코 좋아','프라하 좋아용')
	,('대만', '까오슝','2025-01-01','2025-01-02','대만 좋아','까오슝 좋아용')
	,('헝가리', '부다페스트','2025-01-01','2025-01-02','헝가리 좋아','부다페스트 좋아용')
	,('덴마크', '코펜하겐','2025-01-01','2025-01-02','덴마크 좋아','코펜하겐 좋아용')
;

INSERT INTO bucket_lists(
	title	
	,bucket_content
	,country
	,sort
)
VALUES
	('버킷리스트', '뭘 적어야좋을까', '한국' ,'기타')
	,('콜플콘서트', '가즈아아아아ㅏㅇ아아앙', '한국' ,'체험')
	,('집각고싶어', '집에가면 누워야지', '미국','기타')
	,('누워있고싶어', '뭘 적어야좋을까', '외국' ,'기타')
	,('왜 연동이 안되냐', '뭘 적어야좋을까', '한국' ,'기타')
	,('버킷리스트', '뭘 적어야좋을까', '한국' ,'기타')
	,('버킷리스트', '뭘 적어야좋을까', '한국' ,'기타')	
;
