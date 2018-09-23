<?php
require('functions.php');

$arr_projects = ['Входящие', 'Учеба', 'Работа', 'Домашние дела', 'Авто'];
$arr_tasks = [
    [
        'task' => 'Собеседование в IT компании',
        'date' => '23.09.2018',
        'category' =>  'Работа',
        'done' => 'Нет',
    ],
    [
        'task' => 'Выполнить тестовое задание',
        'date' => '25.12.2018',
        'category' =>  'Работа',
        'done' => 'Нет',
    ],
    [
        'task' => 'Сделать задание первого раздела',
        'date' => '21.12.2018',
        'category' =>  'Учеба',
        'done' => 'Да',
    ],
    [
        'task' =>  'Встреча с другом',
        'date' => '22.12.2018',
        'category' =>  'Входящие',
        'done' => 'Нет',
    ],
    [
        'task' =>    'Купить корм для кота',
        'date' => 'Нет',
        'category' =>  'Домашние дела',
        'done' => 'Нет',
    ],
    [
        'task' =>    'Заказать пиццу',
        'date' => 'Нет',
        'category' =>  'Домашние дела',
        'done' => 'Нет',
    ]


];


$index_content = include_template('index.php',
    ['arr_tasks' => $arr_tasks]);


$layout_content = include_template('layout.php',
    ['content' => $index_content, 'arr_projects' => $arr_projects, 'arr_tasks' => $arr_tasks, 'title' => 'Дела в порядке']);

print($layout_content);
