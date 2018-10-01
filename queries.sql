
INSERT INTO project SET project_name = 'Входящие', id_project=1, id_user=2;
INSERT INTO project SET project_name = 'Учеба', id_project=2, id_user=2;
INSERT INTO project SET project_name = 'Работа', id_project=3, id_user=1;
INSERT INTO project SET project_name = 'Домашние дела', id_project=4, id_user=2;
INSERT INTO project SET project_name = 'Авто', id_project=5, id_user=3;


INSERT INTO task SET
id_project = 1,
id_user = 1,
task_name = 'Собеседование в IT компании',
creation_date ='2010-12-10',
complete_date ='2020-12-10',
status = 1,
date_for_task = '2018-12-10';


INSERT INTO task SET
id_project =4,
id_user =1,
task_name = 'Выполнить тестовое задание',
creation_date ='2010-12-10',
complete_date ='2020-12-10',
status = 1,
date_for_task = '2018-12-10';


INSERT INTO task SET
id_project =2,
id_user =3,
task_name = 'Сделать задание первого раздела',
creation_date ='2010-12-10',
complete_date ='2020-12-10',
status = 1,
date_for_task = '2018-12-10';


INSERT INTO users
SET
id_user = 1,
registration_date = '01.01.2001',
name = 'Вова',
email='vova@mail.ru',
password= 123456,
contacts= 'russia';

INSERT INTO users
SET
id_user = 4,
registration_date = '01.01.2002',
name = 'Катя',
email='katya@mail.ru',
password= 123456,
contacts= 'russia';

INSERT INTO users
SET
id_user = 3,
registration_date = '01.01.2003',
name = 'Лена',
email='lena@mail.ru',
password='123456',
contacts= 'russia';

INSERT INTO users
SET
id_user = 2,
registration_date = '01.01.2004',
name = 'Миша',
email ='misha@mail.ru',
password= 123456 ,
contacts= 'russia';


-- -----------------------------------------------get data
SELECT * FROM project WHERE id_user = 2;
SELECT task_name FROM task WHERE id_project = 2;
UPDATE `task` SET `status` = '0' WHERE `task`.`id_task` = 1;

SELECT * FROM task WHERE date_for_task = DATE_ADD(CURRENT_DATE(), INTERVAL 1 DAY);

UPDATE `task` SET `task_name` = 'aaaa' WHERE `task`.`id_task` = 1;


