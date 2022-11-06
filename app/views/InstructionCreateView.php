<form method="POST" action="/instruction/add" class="sample form-send">
  <fieldset>
    <legend>Шаблон для создания инструкции</legend>
    <label class = "head-sample">Заголовок</label>
    <div class="head-sample-text-block">
      <input class="head-sample-text" type="text" name="head_i" required>
    </div>
    <label class = "about-sample">Тема</label>
    <div class="about-sample-text-block">
      <input class ="about-sample-text" type = "text" name="theme_i" required>
    </div>
    <div class="file-block">
      <textarea class = "create" name="content_i" placeholder="Введите содержание инструкции" cols = "20" wrap = "hard" required></textarea>
      <input type="file" name="files_i[]" class = "file" value="Выберите файл(ы)" accept="image/*, video/*, .pdf" multiple required>
    </div>
    <div class = "buttons">
      <button type="reset" class="clear">Очистить</button>
      <button class="sent" type="submit">Отправить</button>
    </div>
  </fieldset>
</form>
