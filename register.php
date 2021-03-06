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


//----------------------------------------------------------------------- count

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

//-------------------------------------------------------------------

$tpl_data = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $form = $_POST;
    $errors = [];

    //----------------------------------------------------------------------- check if empty

    //$error_class = '';

        $required = ['name', 'email', 'password'];


        $dict = ['name' => 'Название', 'password' => 'password', 'email' =>'email'];

        foreach ($required as $key) {


            if (empty($_POST[$key])) {
                $errors[$key] = 'Это поле надо заполнить';
                $error_class = 'form__input--error';
               /* $add_content = include_template('register-form.php',
                    [
                        'errors' => $errors,
                        'error_class' => $error_class,
                        'dict' => $dict
                    ]);
               */
            }
        }

//----------------------------------------------------------------------------------------------email
    $email = mysqli_real_escape_string($con, $form['email']);
    $sql_check_mail = "SELECT id_user FROM users WHERE email = '$email'";


    $res = mysqli_query($con, $sql_check_mail);

    if (!$res) {                   //------ check results
        $error = mysqli_error($con);
        print("Ошибка MySQL: "
            . $error);
        die();
    }
//var_dump($res);
    if (mysqli_num_rows($res) > 0 ) {
        $errors['email_exist'] = 1;
    }
    else if (empty($errors)){
        $password = password_hash($form['password'], PASSWORD_DEFAULT);

        $sql = 'INSERT INTO `users` (`id_user`, `registration_date`, `name`, `email`, `password`, `contacts`) 
                VALUES ("", NOW(), ?, ?, ?, "");';
        $stmt = db_get_prepare_stmt($con, $sql, [$form['name'], $form['email'], $password]);
        $res = mysqli_stmt_execute($stmt);

        header("Location: index.php");
        exit();
    }

   /* if ($res && empty($errors)) {

    }*/

    $tpl_data['errors'] = $errors;
    $tpl_data['values'] = $form;
}
//-----------------------------------------------------------------------------------
$page_content = include_template('register-form.php', $tpl_data);


$layout_content = include_template('layout.php',
    ['content' => $page_content,


       'arr_projects_and_count' => $qw_project_name_and_count,
        'title' => 'Дела в порядке register form'
    ]);
print($layout_content);

