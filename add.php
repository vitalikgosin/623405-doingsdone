<?php
require('functions.php');
require('mysql_helper.php');
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: guest.php");
    exit();
}

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

    $required = ['name', 'project'];
    $errors = [];


    $dict = ['name' => 'Название', 'project' => 'Проект'];
    $errors = [];
    foreach ($required as $key) {


        if (empty($_POST[$key])) {
            $errors[$key] = 'Это поле надо заполнить';
            $error_class = 'form__input--error';

        }

    }


//----------------------------------------------------------------------- upload file

    if (!empty($_FILES['preview']['name'])) {
        $tmp_name = $_FILES['preview']['tmp_name'];


       // $path = $_FILES['preview']['name'];

        //uniq id  as file name
        // set file extantion buy MIME_TYPE

        $finfo = finfo_open(FILEINFO_MIME_TYPE);

        $file_type = finfo_file($finfo, $tmp_name);
        //$f_type  = $_FILES['preview']['type'];

        $f_type = explode("/", $file_type);


        //var_dump( $f_type[1]);
        //die();

        $filename = uniqid() .'.'. $f_type[1];
        //var_dump($filename);

        //var_dump($file_type);
        if ($file_type !== "image/gif" && $file_type !== "image/jpeg" && $file_type !== "image/png") {
            $errors['file'] = 'Загрузите картинку в формате GIF/png/jpeg';
        } else {
            move_uploaded_file($tmp_name, __DIR__ . '/' .  $filename);
            $add_data['preview']['path'] = $filename;
            // var_dump( $add_data['preview']['path'] );
        }
    }

    else {
          $add_data['preview']['path'] = '';
          //$page_content = include_template('add.php', ['add_data' => $add_data]);
      }
 /*
  /*  else      $errors['file'] = 'Вы не загрузили файл';
    }
if (count($errors)) {
        $page_content = include_template('add.php', ['add_data' => $add_data, 'errors' => $errors, 'dict' => $dict]);
    }
    else {
        $page_content = include_template('add.php', ['add_data' => $add_data]);
    }
  */
    /*  $sql_qw_insert_form = 'INSERT INTO `task`
(`id_task`, `id_user`, `id_project`, `task_name`, `creation_date`, `complete_date`, `status`, `file_link`, `date_for_task`)
VALUES (11, 2, 5, $add_data[name],?,?,0,?, $add_data[date], $add_data[preview]);
*/
    if (!empty($errors)) {
        $add_content = include_template('add-form.php',
            [
                'errors' => $errors,
                'error_class' => $error_class,
                'dict' => $dict,
                'arr_projects' => $qw_project_name_and_count,
            ]);

    }
    else {
        //----------------------------------------------------------------------- insert
        //
        //
        $proj_name = $add_data['project'];

        $project_id = proj_id($qw_project_name_and_count, $proj_name);
        //var_dump(proj_id($qw_project_name_and_count, $proj_name));

        $sql_qw_insert_form = "INSERT INTO `task` ( `id_user`, `id_project`, `task_name`, `creation_date`,`status`, `file_link`, `date_for_task`) 
VALUES (?, ?, ?, NOW(), 0, ?,?)";

//var_dump($add_data['preview']['path']);
        if (!isset($_SESSION['user'])) {
            $id_user=0;
        }
        else{
            $id_user = ($_SESSION['user']["id_user"]);

        }

        $sql_dt = [ $id_user, $project_id, $add_data['name'], $add_data['preview']['path'], $add_data['date']];


        $stmt = db_get_prepare_stmt($con, $sql_qw_insert_form, $sql_dt);
        $res_sql_qw = mysqli_stmt_execute($stmt);


        if (!$res_sql_qw) {                   //------ check results
            $error = mysqli_error($con);
            print("Ошибка MySQL: "
                . $error);
            die();
        }



            header("Location: index.php");
        die();


    }

} else {
    $add_content = include_template('add-form.php', ['arr_projects' => $qw_project_name_and_count,]);
}


$layout_content = include_template('layout.php',
    ['content' => $add_content,


        'arr_projects_and_count' => $qw_project_name_and_count,
        'title' => 'Дела в порядке add form'
    ]);
print($layout_content);


