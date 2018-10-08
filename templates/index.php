<?php



?>


<h2 class="content__main-heading">Список задач</h2>

<form class="search-form" action="index.php" method="post">
    <input class="search-form__input" type="text" name="" value="" placeholder="Поиск по задачам">

    <input class="search-form__submit" type="submit" name="" value="Искать">
</form>

<div class="tasks-controls">
    <nav class="tasks-switch">
        <a href="/" class="tasks-switch__item tasks-switch__item--active">Все задачи</a>
        <a href="/" class="tasks-switch__item">Повестка дня</a>
        <a href="/" class="tasks-switch__item">Завтра</a>
        <a href="/" class="tasks-switch__item">Просроченные</a>
    </nav>

    <label class="checkbox">
        <!--добавить сюда аттрибут "checked", если переменная $show_complete_tasks равна единице-->
        <input class="checkbox__input visually-hidden show_completed" type="checkbox"  <?php if ($show_complete_tasks ==1){ echo 'checked';}?>>
        <span class="checkbox__text">Показывать выполненные</span>
    </label>
</div>
<?php if ($show_complete_tasks ==1){
    echo ' <tr class="tasks__item task task--completed">
                    <td class="task__select">
                        <label class="checkbox task__checkbox">
                            <input class="checkbox__input visually-hidden" type="checkbox" checked>
                            <span class="checkbox__text">Записаться на интенсив "Базовый PHP"</span>
                        </label>
                    </td>
                    <td class="task__date">10.10.2018</td>

                    <td class="task__controls">
                    </td>
                </tr>';}?>


<table class="tasks">

    <?php

        if ($arr_tasks){
        foreach ($arr_tasks as $items =>  $item) {

            $task_name = $item['task_name'];
            $addclass = '';
            $date = $item['date_for_task'];

            //$category = $item['id_project'];
            $done = $item['status'];

            if ($done == '1') {
                $addclass = 'task--completed';
            }
            if ($done == '1' && $show_complete_tasks == 0) {
                continue;
            }

            $curr_date = strtotime("now");
            $task_date = strtotime($date);

            $day_num = 86400;
            $highlight_date = $task_date - $curr_date;

            if ($task_date && $highlight_date < $day_num) {

                $addclass .= ' task--important';

            }



            ?>
            <tr class="tasks__item task <?= $addclass, ' ', $task_important ?>">
                <td class="task__select">
                    <label class="checkbox task__checkbox">
                        <input class="checkbox__input visually-hidden task__checkbox" type="checkbox"
                               value="1">
                        <span class="checkbox__text"><?= htmlspecialchars($task_name) ?></span>
                    </label>
                </td>

                <td class="task__file">
                    <a class="download-link" href="#">Home.psd</a>
                </td>

                <td class="task__date"><?= $date ?></td>
            </tr>


        <?php }
     }?>
</table>