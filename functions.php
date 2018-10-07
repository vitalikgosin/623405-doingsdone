<?php

function include_template($name, $data) {
    $name = 'templates/' . $name;
    $result = '';

    if (!file_exists($name)) {
        return $result;
    }

    ob_start();
    extract($data);
    require($name);

    $result = ob_get_clean();

    return $result;
}

date_default_timezone_set('Europe/Moscow');

//------------------------------------------- show hide function
$show_complete_tasks = rand(0, 1);
