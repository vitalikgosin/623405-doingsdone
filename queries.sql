
INSERT INTO project(id_user) SELECT id_user FROM users; INSERT INTO project SET project_name = 'Входящие';
INSERT INTO project(id_user) SELECT id_user FROM users; INSERT INTO project SET project_name = 'Учеба';
INSERT INTO project(id_user) SELECT id_user FROM users; INSERT INTO project SET project_name = 'Работа';
INSERT INTO project(id_user) SELECT id_user FROM users; INSERT INTO project SET project_name = 'Домашние дела';
INSERT INTO project(id_user) SELECT id_user FROM users; INSERT INTO project SET project_name = 'Авто';

INSERT INTO task(id_user) SELECT id_user FROM users;
iNSERT INTO task(id_project) SELECT id_project FROM project;
INSERT INTO task SET
task_name = 'Собеседование в IT компании',
id_project = '1',
creation_date ='2010-12-10',
complete_date ='2020-12-10',
status = 1,
date_for_task = '2018-12-10';

INSERT INTO task(id_user) SELECT id_user FROM users;
iNSERT INTO task(id_project) SELECT id_project FROM project;
INSERT INTO task SET
task_name = 'Выполнить тестовое задание',
creation_date ='2010-12-10',
complete_date ='2020-12-10',
status = 1,
date_for_task = '2018-12-10';

INSERT INTO task(id_user) SELECT id_user FROM users;
iNSERT INTO task(id_project) SELECT id_project FROM project;
INSERT INTO task SET
task_name = 'Сделать задание первого раздела',
id_project = '1',
creation_date ='2010-12-10',
complete_date ='2020-12-10',
status = 1,
date_for_task = '2018-12-10';


INSERT INTO users
SET
registration_date = '01.01.2001',
name = 'Вова',
email='vova@mail.ru',
password= 123456,
contacts= 'russia';

INSERT INTO users
SET
registration_date = '01.01.2002',
name = 'Катя',
email='katya@mail.ru',
password= 123456,
contacts= 'russia';

INSERT INTO users
SET
registration_date = '01.01.2003',
name = 'Лена',
email='lena@mail.ru',
password='123456',
contacts= 'russia';

INSERT INTO users
SET
registration_date = '01.01.2004',
name = 'Миша',
email ='misha@mail.ru',
password= 123456 ,
contacts= 'russia';
