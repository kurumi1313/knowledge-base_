<div class="modal_content feedback_to_admin">
    <form action="/admin/feedback" method="POST" class="form-send">
        <div class="label-text-block">
            <label class="label">От: </label>
            <label class="label label-text">
                <?php echo ucfirst($_SESSION['userInfo']['firstname']) . ' ' . ucfirst($_SESSION['userInfo']['secondname']); ?>
            </label></br>
        </div>
        <div class="contents">
            <input type="text" class="theme_message" name="theme_message" placeholder="Тема" required>
            <textarea class="textarea" name="feedback_message" placeholder="Ваше сообщение, которое будет прочитано" required></textarea></br>
        </div>
        <div class="buttons">
            <button type="submit" class="btn-success">Отправить</button>
        </div>
    </form>
    <div class="btn-cont">
        <button class="btn-close">Закрыть</button>
    </div>
</div>