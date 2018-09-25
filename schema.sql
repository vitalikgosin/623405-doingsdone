
CREATE DATABASE doingsdone
 DEFAULT CHARACTER SET utf8
 DEFAULT COLLATE utf8_general_ci;

  CREATE TABLE project (
  
  author            CHAR(128),
  );

  CREATE TABLE task (
  id                INT AUTO_INCREMENT PRIMARY KEY,
  creation_date     DATE,
  execution_date    DATE,
  status            BOOLEAN  DEFAULT '0',
  project_name      CHAR(128),
  file_link         VARCHAR(512) CHARACTER SET 'ascii' COLLATE 'ascii_general_ci' NOT NULL,
  date_for_task     DATE,
  );

  CREATE TABLE users (
  id                INT AUTO_INCREMENT PRIMARY KEY,
  registration_date DATE,
  name              CHAR(128),
  email             CHAR(128) UNIQUE,
  password          CHAR(64),
  contacts          CHAR(264),
  );