-- -- DB Host     : localhost
-- -- DB Port     : 3306
-- -- DB Name     : itir9421_gis
-- -- DB Username :
-- -- DB Password :

DROP TABLE IF EXISTS tb_institution;
DROP TABLE IF EXISTS tb_mark;
DROP TABLE IF EXISTS tb_category;
DROP TABLE IF EXISTS tb_users;
CREATE DATABASE IF NOT EXISTS itir9421_gis;


CREATE TABLE IF NOT EXISTS tb_mark (
    mark_id BIGINT PRIMARY KEY AUTO_INCREMENT,
    mark_lat VARCHAR(20),
    mark_lon VARCHAR(20),
    mark_address VARCHAR(255),
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP() ON UPDATE CURRENT_TIMESTAMP(),
    deleted_at TIMESTAMP NULL DEFAULT
);

CREATE TABLE IF NOT EXISTS tb_category (
    cat_id BIGINT PRIMARY KEY AUTO_INCREMENT,
    cat_name VARCHAR(45),
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP() ON UPDATE CURRENT_TIMESTAMP(),
    deleted_at TIMESTAMP NULL DEFAULT
);

CREATE TABLE IF NOT EXISTS tb_institution (
    institu_id BIGINT PRIMARY KEY AUTO_INCREMENT,
    institu_name VARCHAR(45),
    institu_npsn VARCHAR(20),
    institu_logo VARCHAR(255),
    institu_image VARCHAR(255),
    mark_id BIGINT,
    cat_id BIGINT,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP() ON UPDATE CURRENT_TIMESTAMP(),
    FOREIGN KEY (mark_id) REFERENCES tb_mark(mark_id),
    FOREIGN KEY (cat_id) REFERENCES tb_category(cat_id),
    deleted_at TIMESTAMP NULL DEFAULT
);




CREATE TABLE IF NOT EXISTS tb_users (
    user_id BIGINT PRIMARY KEY AUTO_INCREMENT,
    firstname VARCHAR(45),
    lastname VARCHAR(45),
    user_name VARCHAR(45),
    user_pwd VARCHAR(255),
    user_image VARCHAR(255),
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP() ON UPDATE CURRENT_TIMESTAMP(),
    deleted_at TIMESTAMP NULL DEFAULT
);




















-- YG DIBAWAH INI GK DIPAKE:
-- CREATE TABLE IF NOT EXISTS tb_frontpage_widget(
	-- id_widget VARCHAR(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
	-- widget_name TEXT(50) NOT NULL,
	-- widget_status ENUM('active', 'not_active', 'active_at', 'expired_at'),
	-- created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
    -- updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP() ON UPDATE CURRENT_TIMESTAMP()
-- );
-- INSERT INTO tb_frontpage_widget(widget_name, widget_status)
-- VALUES
    -- ('Featured Widget 1', 'active'),
    -- ('Featured Widget 2', 'not_active'),
    -- ('Featured Widget 3', 'active_at'),
    -- ('Featured Widget 4', 'expired_at');





