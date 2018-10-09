<?php
require('functions.php');






$con = mysqli_connect("localhost", "root", "", "doingsdone");


if ($con == false) {                        //---------- check connection
    print("Ошибка подключения: "
        . mysqli_connect_error());
    die();
}

                                            //print("Соединение установлено");

mysqli_set_charset($con, "utf8");


$sql_project_name ="SELECT project.project_name FROM  project ";

//  SELECT project.project_name, group_concat(task.id_task) FROM task JOIN project ON task.id_project = project.id_project WHERE task.id_user=2  GROUP BY task.id_project;

$qw_result_project_name = mysqli_query($con, $sql_project_name);

if (!$qw_result_project_name) {                   //------ check results
    $error = mysqli_error($con);
    print("Ошибка MySQL: "
        . $error);
    die();
}

$qw_project_name = mysqli_fetch_all($qw_result_project_name, MYSQLI_ASSOC);

$add_content = include_template('add-form.php',
    [
        'arr_projects_name' => $qw_project_name,
        'error_class'=> $error_class,
    ]);

//----------------------------------------------------------------------- check if empty

$error_class = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $name = $_POST;
    $required = ['name'];
    $errors = [];

    foreach ($required as $key) {
        if (empty($_POST[$key])) {
            $errors[$key] = 'Это поле надо заполнить';
        }
    }
/*
    if (isset($_FILES['gif_img']['name'])) {
        $tmp_name = $_FILES['gif_img']['tmp_name'];
        $path = $_FILES['gif_img']['name'];

        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $file_type = finfo_file($finfo, $tmp_name);
        if ($file_type !== "image/gif") {
            $errors['file'] = 'Загрузите картинку в формате GIF';
        }
        else {
            move_uploaded_file($tmp_name, 'uploads/' . $path);
            $gif['path'] = $path;
        }
    }
    else {
        $errors['file'] = 'Вы не загрузили файл';
    }
if (count($errors)) {
		$page_content = include_template('add.php', ['gif' => $gif, 'errors' => $errors, 'dict' => $dict]);
	}
	else {
		$page_content = include_template('view.php', ['gif' => $gif]);
	}
}
else {
	$page_content = include_template('add.php', []);
}

$layout_content = include_template('layout.php',
    ['content' => $index_content,
        //'arr_projects' => $rows_projects,
        'arr_tasks' => $rows_tasks,
        'arr_projects_and_count' => $qw_project_name_and_count,
        'title' => 'Дела в порядке']);



print($layout_content);
*/
}

print($add_content);


