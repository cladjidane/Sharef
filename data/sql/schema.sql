CREATE TABLE category (id INT AUTO_INCREMENT, name VARCHAR(45), created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, deleted_at DATETIME, slug VARCHAR(255), root_id BIGINT, lft INT, rgt INT, level SMALLINT, UNIQUE INDEX category_sluggable_idx (slug), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE = INNODB;
CREATE TABLE file (id INT AUTO_INCREMENT, name VARCHAR(45), size VARCHAR(255), path VARCHAR(45), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE = INNODB;
CREATE TABLE ressource (id INT AUTO_INCREMENT, title VARCHAR(255), description MEDIUMTEXT, state INT, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, deleted_at DATETIME, slug VARCHAR(255), UNIQUE INDEX ressource_sluggable_idx (slug), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE = INNODB;
CREATE TABLE ressource_category (id INT AUTO_INCREMENT, id_ressource INT, id_category INT, INDEX id_ressource_idx (id_ressource), INDEX id_category_idx (id_category), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE = INNODB;
CREATE TABLE ressource_file (id INT AUTO_INCREMENT, id_ressource INT, id_file INT, INDEX id_ressource_idx (id_ressource), INDEX id_file_idx (id_file), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE = INNODB;
ALTER TABLE ressource_category ADD CONSTRAINT ressource_category_id_ressource_ressource_id FOREIGN KEY (id_ressource) REFERENCES ressource(id);
ALTER TABLE ressource_category ADD CONSTRAINT ressource_category_id_category_category_id FOREIGN KEY (id_category) REFERENCES category(id);
ALTER TABLE ressource_file ADD CONSTRAINT ressource_file_id_ressource_ressource_id FOREIGN KEY (id_ressource) REFERENCES ressource(id);
ALTER TABLE ressource_file ADD CONSTRAINT ressource_file_id_file_file_id FOREIGN KEY (id_file) REFERENCES file(id);
