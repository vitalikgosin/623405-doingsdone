
CREATE DATABASE doingsdone
 DEFAULT CHARACTER SET utf8
 DEFAULT COLLATE utf8_general_ci;

  CREATE TABLE project (
  id_project        INT AUTO_INCREMENT PRIMARY KEY,
  id_user           INT,
  project_name      CHAR(128)
  );

  CREATE TABLE task (
  id_task           INT AUTO_INCREMENT PRIMARY KEY,
  id_user           INT,
  id_project        INT,
  creation_date     DATE,
  date_complete    DATE,
  status            BOOLEAN  DEFAULT '0',

  file_link         VARCHAR(512) CHARACTER SET 'ascii' COLLATE 'ascii_general_ci' NOT NULL,
  date_for_task     DATE
  );

  CREATE TABLE users (
  id_user           INT AUTO_INCREMENT PRIMARY KEY,
  registration_date DATE,
  name              CHAR(128),
  email             CHAR(128) UNIQUE,
  password          CHAR(64),
  contacts          VARCHAR(512)
  );


CREATE INDEX name_i ON users(name);
CREATE INDEX user_id_i ON users(id_user);
CREATE INDEX project_i  ON task(project_name);