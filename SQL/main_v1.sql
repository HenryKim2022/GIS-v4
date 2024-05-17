-- -- DB Host     : localhost
-- -- DB Port     : 3306
-- -- DB Name     : itir9421_gis
-- -- DB Username :
-- -- DB Password :

DROP TABLE IF EXISTS tb_institution;
DROP TABLE IF EXISTS tb_mark;
DROP TABLE IF EXISTS tb_logins;
DROP TABLE IF EXISTS tb_users;
-- DROP TABLE IF EXISTS tb_levels;
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
    institu_name TEXT(45),
    institu_category TEXT(45),
    institu_npsn VARCHAR(20),
    institu_logo TEXT(254),
    institu_address TEXT(254),
    institu_descb TEXT(254),
    institu_image TEXT(254),
    mark_id INT(9),
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP() ON UPDATE CURRENT_TIMESTAMP(),
    FOREIGN KEY (mark_id) REFERENCES tb_mark(mark_id)
);


-- CREATE TABLE IF NOT EXISTS tb_levels (
--     level_id INT(9) PRIMARY KEY AUTO_INCREMENT,
--     level_name TEXT(45),
--     created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
--     updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP() ON UPDATE CURRENT_TIMESTAMP(),
-- );

CREATE TABLE IF NOT EXISTS tb_users (
    user_id INT(9) PRIMARY KEY AUTO_INCREMENT,
    user_name TEXT(45),
    user_image TEXT(254),
    -- level_id INT(9),
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP() ON UPDATE CURRENT_TIMESTAMP(),
    FOREIGN KEY (level_id) REFERENCES tb_levels(level_id)
);

CREATE TABLE IF NOT EXISTS tb_logins (
    login_id INT(9) PRIMARY KEY AUTO_INCREMENT,
    user_id TEXT(45),
    user_password TEXT(254),
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
    updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP() ON UPDATE CURRENT_TIMESTAMP(),
    FOREIGN KEY (user_id) REFERENCES tb_users(user_id)
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





