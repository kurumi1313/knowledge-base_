<div class="login-wrapper">
    <div class="login-container">
        <form action="/admin/auth" method="POST" class="admin-form form-send">
            <h2>Вход в админ-панель</h2>
            <div>
                <input type="text" id="admin_login" name="admin_login" class="admin-form__input" placeholder="login" required />
                <input type="password" id="admin_password" name="admin_password" class="admin-form__input" placeholder="password" required />
                <button type="submit" class="admin-form__btn">Войти</button>
            </div>
        </form>
    </div>
</div>