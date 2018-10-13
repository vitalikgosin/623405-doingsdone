<?php

require('functions.php');
require('mysql_helper.php');


$con = mysqli_connect("localhost", "root", "", "doingsdone");


if ($con == false) {                        //---------- check connection
    print("Ошибка подключения: "
        . mysqli_connect_error());
    die();
}

//print("Соединение установлено");

mysqli_set_charset($con, "utf8");


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

$add_content = include_template('register-form.php',
    [
        'arr_projects' => $qw_project_name_and_count,
        //'error_class'=> $error_class,
    ]);

//----------------------------------------------------------------------- get project id
function proj_id($arr, $proj_name)
{
    foreach ($arr as $key => $arr_val) {
        foreach ($arr_val as $i => $val) {

            // var_dump($i);
            //var_dump($val);
            // echo '</br>';

            if ($proj_name == $val) {
                return $arr_val["id_project"];
                //var_dump($arr_val["id_project"]);
            }
        }
    }
    // die;
}

//proj_id($qw_project_name_and_count, 'Учеба');
//var_dump(proj_id($qw_project_name_and_count, 'Учеба'));
//----------------------------------------------------------------------- check if empty

$error_class = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $add_data = $_POST;

    // var_dump($add_data);
    // die();

    $required = ["email", "password", "name"];
    $errors = [];


    $dict = ['email' => 'email', 'password' => 'password', 'name' => "name"];
    $errors = [];
    foreach ($required as $key) {


        if (empty($_POST[$key])) {
            $errors[$key] = 'Это поле надо заполнить';
            $error_class = 'form__input--error';
            $add_content = include_template('register-form.php',
                [
                    'errors' => $errors,
                    'error_class' => $error_class,
                    'dict' => $dict
                ]);
        }
    }


//----------------------------------------------------------------------- insert
    //
    //
    //$proj_name = $add_data['project'];

    //$project_id = proj_id($qw_project_name_and_count, $proj_name);
    //var_dump(proj_id($qw_project_name_and_count, $proj_name));

    $sql_qw_insert_form = "INSERT INTO `users` (`id_user`, `registration_date`, `name`, `email`, `password`, `contacts`)
VALUES ('NULL', 'date()', '?', '?', '?', 'NULL');";

//var_dump($add_data['preview']['path']);
    $sql_dt = [$add_data['name'], $add_data['email'], $add_data['password']];


    $stmt = db_get_prepare_stmt($con, $sql_qw_insert_form, $sql_dt);
    $res_sql_qw = mysqli_stmt_execute($stmt);


    if (!$res_sql_qw) {                   //------ check results
        $error = mysqli_error($con);
        print("Ошибка MySQL: "
            . $error);
        die();
    }

    if ($res_sql_qw) {
        mysqli_query($con, $res_sql_qw);

        //header("Location: index.php");
    }


} else {
    $page_content = include_template('register.php', []);
}


$layout_content = include_template('layout.php',
    ['content' => $add_content,


        'arr_projects_and_count' => $qw_project_name_and_count,
        'title' => 'Дела в порядке add form'
    ]);
print($layout_content);


