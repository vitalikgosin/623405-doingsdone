<?php
require('functions.php');


$con = mysqli_connect("localhost", "root", "", "doingsdone");

mysqli_set_charset($con, "utf8");
if ($con == false) {                  //---------- check connection
   print("Ошибка подключения: "
. mysqli_connect_error());
}
else {
   //print("Соединение установлено");



 // print projects  

    $sql_projects ="SELECT * FROM project WHERE id_user = 2;";
    $result_projects = mysqli_query($con, $sql_projects);

        if (!$result_projects) {                   //------ check results
        $error = mysqli_error($con);
        print("Ошибка MySQL: "
        . $error);
        }

    $rows_projects = mysqli_fetch_all($result_projects, MYSQLI_ASSOC); 
    
       

// print tasks


    $sql_tasks ="SELECT * FROM task WHERE id_user = 2;";
    
    $result_tasks = mysqli_query($con, $sql_tasks);

        if (!$result_tasks) {                   //------ check results
        $error = mysqli_error($con);
        print("Ошибка MySQL: "
        . $error);
        }

    $rows_tasks = mysqli_fetch_all($result_tasks, MYSQLI_ASSOC); 

    
        

}




$index_content = include_template('index.php', ['arr_tasks' => $rows_tasks]);


$layout_content = include_template('layout.php',
    ['content' => $index_content, 'arr_projects' => $rows_projects, 'arr_tasks' => $rows_tasks, 'title' => 'Дела в порядке']);

print($layout_content);
