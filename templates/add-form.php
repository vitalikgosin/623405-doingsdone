<?php


?>


 <main class="content__main">
        <h2 class="content__main-heading">Добавление задачи</h2>

        <form class="form"  action="" method="post" enctype="multipart/form-data">
          <div class="form__row">
              <?php if (isset($errors['name'])){ ?>
                  <p class="form__message">

                      <span class="form__message error-message">
                        «Заполните это поле»
                      </span>
                  </p>
                  <label class="form__label" for="name">Название <sup>*</sup></label>

                  <input class="form__input <?= $error_class ?>" type="text" name="name" id="name" value="" placeholder="Введите название">
              <?php }
              else {?>


              <label class="form__label" for="name">Название <sup>*</sup></label>

            <input class="form__input " type="text" name="name" id="name" value="" placeholder="Введите название">
              <?php }?>

          </div>

          <div class="form__row">

              <?php if (isset($errors['project'])){?>
                  <p class="form__message">

                      <span class="form__message error-message">
                        «Заполните это поле»
                      </span>
                  </p>
              <label class="form__label" for="project">Проект <sup>*</sup></label>
              <select class="form__input form__input--select <?= $error_class ?>" name="project" id="project">

              <?php }
              else{
              ?>


                  <label class="form__label" for="project">Проект <sup>*</sup></label>

                  <select class="form__input form__input--select" name="project" id="project">
                      <?php
                      }
                foreach ($arr_projects_name as $project_name){
                   // var_dump($project_name);
                    ?>
                    <option value="<?=$project_name["project_name"]?>"><?=$project_name["project_name"]?></option>


                  <?php }  ?>
            </select>
          </div>

          <div class="form__row">
            <label class="form__label" for="date">Дата выполнения</label>

            <input class="form__input form__input--date" type="date" name="date" id="date" value="" placeholder="Введите дату в формате ДД.ММ.ГГГГ">
          </div>

          <div class="form__row">
            <label class="form__label" for="preview">Файл</label>

            <div class="form__input-file">
              <input class="visually-hidden" type="file" name="preview" id="preview" value="">

              <label class="button button--transparent" for="preview">
                <span>Выберите файл</span>
              </label>
            </div>
          </div>


            <div class="form__row form__row--controls">


            <input class="button" type="submit" name="" value="Добавить">
          </div>
        </form>
      </main>
