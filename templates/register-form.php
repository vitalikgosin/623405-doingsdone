<?php

?>

<div class="content">
        <section class="content__side">
          <p class="content__side-info">Если у вас уже есть аккаунт, авторизуйтесь на сайте</p>

          <a class="button button--transparent content__side-button" href="form-authorization.html">Войти</a>
        </section>

        <main class="content__main">
          <h2 class="content__main-heading">Регистрация аккаунта</h2>

          <form class="form" action="register.php" method="post">
            <div class="form__row">
              <label class="form__label" for="email">E-mail <sup>*</sup></label>

                <?php if (isset($errors)){?>
              <input class="form__input form__input--error" type="text" name="email" id="email" value="" placeholder="Введите e-mail">

              <p class="form__message">E-mail введён некорректно</p>
                <?php }
                else{ ?>
                <input class="form__input " type="text" name="email" id="email" value="" placeholder="Введите e-mail">

               <?php } ?>
            </div>

            <div class="form__row">
              <label class="form__label" for="password">Пароль <sup>*</sup></label>

              <input class="form__input" type="password" name="password" id="password" value="" placeholder="Введите пароль">
                <?php if (isset($errors)){?>

                <?php

                ?>
            </div>

            <div class="form__row">
              <label class="form__label" for="name">Имя <sup>*</sup></label>

              <input class="form__input" type="password" name="name" id="name" value="" placeholder="Введите пароль">
            </div>

            <div class="form__row form__row--controls">
                <?php if (isset($errors)){?>
              <p class="error-message">Пожалуйста, исправьте ошибки в форме</p>
                <?php }?>
              <input class="button" type="submit" name="" value="Зарегистрироваться">
            </div>
          </form>
        </main>
      </div>
