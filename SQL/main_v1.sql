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
    mark_id INT(9) PRIMARY KEY AUTO_INCREMENT,
    mark_lat VARCHAR(20),
    mark_lon VARCHAR(20),
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP() ON UPDATE CURRENT_TIMESTAMP()
);

CREATE TABLE IF NOT EXISTS tb_institution (
    institu_id INT(9) PRIMARY KEY AUTO_INCREMENT,
    institu_name VARCHAR(45),
    institu_npsn VARCHAR(20),
    institu_logo VARCHAR(254),
    institu_address VARCHAR(254),
    institu_image VARCHAR(254),
    mark_id INT(9),
    cat_id INT(9),
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP() ON UPDATE CURRENT_TIMESTAMP(),
    FOREIGN KEY (mark_id) REFERENCES tb_mark(mark_id)
    FOREIGN KEY (cat_id) REFERENCES tb_category(cat_id)
);


CREATE TABLE IF NOT EXISTS tb_category (
    cat_id INT(9) PRIMARY KEY AUTO_INCREMENT,
    cat_name VARCHAR(45),
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP() ON UPDATE CURRENT_TIMESTAMP(),
);

CREATE TABLE IF NOT EXISTS tb_users (
    user_id INT(9) PRIMARY KEY AUTO_INCREMENT,
    user_name VARCHAR(45),
    user_password VARCHAR(45),
    user_image VARCHAR(254),
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP() ON UPDATE CURRENT_TIMESTAMP()
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





