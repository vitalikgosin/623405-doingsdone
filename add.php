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
        //'error_class'=> $error_class,
    ]);


//--------------------------------------------------------------------------------------------------- count

$sql_id_project_tasks = "SELECT project.project_name, project.id_project, COUNT(id_task) AS tasks_count FROM task JOIN project ON task.id_project = project.id_project WHERE task.id_user=2  GROUP BY task.id_project;";

//  SELECT project.project_name, group_concat(task.id_task) FROM task JOIN project ON task.id_project = project.id_project WHERE task.id_user=2  GROUP BY task.id_project;

$qw_result_project_name_and_count = mysqli_query($con, $sql_id_project_tasks);

if (!$qw_result_project_name_and_count) {                   //------ check results
    $error = mysqli_error($con);
    print("Ошибка MySQL: "
        . $error);
    die();
}

$qw_project_name_and_count = mysqli_fetch_all($qw_result_project_name_and_count, MYSQLI_ASSOC);


//----------------------------------------------------------------------- check if empty

$error_class = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST'){

    $add_data = $_POST;
    var_dump($add_data);

    $required = ['name','project'];
    $errors = [];


    $dict = ['name' => 'Название', 'project' => 'Проект', 'file' => ''];
    $errors = [];
    foreach ($required as $key) {


        if (empty($_POST[$key])) {
            $errors[$key] = 'Это поле надо заполнить';
            $error_class = 'form__input--error';
            $add_content = include_template('add-form.php',
                [
                    'errors' => $errors,
                    'error_class' => $error_class,
                    'dict' => $dict
                ]);
        }
    }



        if (isset($_FILES['preview']['name'])) {
            $tmp_name = $_FILES['preview']['tmp_name'];
            //var_dump($tmp_name);

            $path = $_FILES['preview']['name'];

            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $file_type = finfo_file($finfo, $tmp_name);
            //var_dump($file_type);
            if ($file_type !== "image/gif" && $file_type !== "image/jpeg" && $file_type !== "image/png") {
                $errors['file'] = 'Загрузите картинку в формате GIF/png/jpeg';
            }
            else {
                move_uploaded_file($tmp_name, __DIR__.'/' . $path);
                $add_data['preview']['path'] = $path;
              // var_dump( $add_data['preview']['path'] );
            }
        }
        else {
            $errors['file'] = 'Вы не загрузили файл';
        }
    if (count($errors)) {
            $page_content = include_template('add.php', ['add_data' => $add_data, 'errors' => $errors, 'dict' => $dict]);
        }
        else {
            $page_content = include_template('add.php', ['add_data' => $add_data]);
        }
        $sql_qw_insert_form = 'INSERT INTO `task` (`task_name`,  `file_link`,`date_for_task`) 
                    VALUES ($add_data[name],  $add_data[date], $add_data[preview])';
         mysqli_query($con, $sql_qw_insert_form);

    }
    else {
        $page_content = include_template('add.php', []);
    }



$layout_content = include_template('layout.php',
    [   'content' => $add_content,


        'arr_projects_and_count' => $qw_project_name_and_count,
        'title' => 'Дела в порядке add form'
    ]);
print($layout_content);


