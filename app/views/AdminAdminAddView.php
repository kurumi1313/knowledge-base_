<div class="container">
    <form action="/admin/add/admin" method="POST" class="admin-form form-send">
        <h2>Добавить админа</h2>
        <div>
            <input type="text" name="admin_firstname" class="admin-form__input" placeholder="first name" required />
            <input type="text" name="admin_secondname" class="admin-form__input" placeholder="second name" required />
            <input type="number" name="admin_code" class="admin-form__input" placeholder="code" required />
            <input type="email" name="admin_email" class="admin-form__input" placeholder="email" required />
            <input type="text" name="admin_login" class="admin-form__input" placeholder="login" required />
            <input type="password" name="admin_password" class="admin-form__input" placeholder="password" required />
            <button type="submit" class="admin-form__btn">Добавить</button>
        </div>
    </form>
</div>