<div class="container">
    <form action="/instruction/add" method="POST" class="admin-form form-send">
        <h2>Добавить инструкцию</h2>
        <div>
            <input type="text" name="head_i" class="admin-form__input" placeholder="header" required />
            <input type="text" name="theme_i" class="admin-form__input" placeholder="theme" required />
            <textarea name="content_i" placeholder="Введите содержание инструкции" cols = "20" wrap = "hard" required></textarea>
            <input type="file" name="files_i[]" class="file" value="Выберите файл(ы)" accept="image/*, video/*, .pdf" multiple required>
            <div style="display:flex;flex-direction:row;justify-content:space-between;width:100%">
                <button type="reset" class="admin-form__btn">Очистить</button>
                <button type="submit" class="admin-form__btn">Добавить</button>
            </div>
        </div>
    </form>
</div>