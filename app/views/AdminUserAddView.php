<div class="container">
    <form action="/admin/add/user" method="POST" class="admin-form form-send">
        <h2>Добавить пользователя</h2>
        <div>
            <input type="text" name="user_firstname" class="admin-form__input" placeholder="first name" required />
            <input type="text" name="user_secondname" class="admin-form__input" placeholder="second name" required />
            <input type="number" name="user_code" class="admin-form__input" placeholder="code" required />
            <input type="text" name="user_role" class="admin-form__input" placeholder="role" required />
            <input type="email" name="user_email" class="admin-form__input" placeholder="email" required />
            <input type="password" name="user_password" class="admin-form__input" placeholder="password" required />
            <button type="submit" class="admin-form__btn">Добавить</button>
        </div>
    </form>
</div>