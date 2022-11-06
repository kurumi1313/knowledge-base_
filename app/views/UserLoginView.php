<div class="main-signin__container">
  <div>
    <div class="main-signin">
      <div class="main-signin__head">
        <p>База знаний компании "Великий Кулинар"</p>
        <p>АВТОРИЗАЦИЯ</p>
      </div>
      <div class="main-signin__middle">
      <div class="middle__form">
        <form method="POST" action="/login/auth" class="login_form form-send">
            <input class = "code_s" name="code_s" type="text" placeholder="Код сотрудника" required>
            <input type="password" name="password" placeholder="Пароль" required>
            <input type="submit" value="ВОЙТИ">
          </form>
      </div>
      </div>
    </div>
    <div class="photo">
      <img class = "logo" src = "/app/assets/images/logo.jpg">
    </div>
  </div>
</div>