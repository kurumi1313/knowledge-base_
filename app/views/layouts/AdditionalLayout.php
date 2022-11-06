<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="icon" href="/app/assets/images/favicon.ico" type="image/x-icon">

    <title><?php echo $title; ?></title>

    <link rel="stylesheet" href="/app/assets/styles/index.css">
    <link rel="stylesheet" href="/app/assets/styles/modal-window.css">

    <?php echo $styles; ?>
</head>
<body>

    <div id="app">
        <?php echo $content; ?>
    </div>

    <div class="cover">
        <div class="window">
            <div class="modal_content feedback_to_admin">
                <button class="connectionwithadmin">Открыть</button>
                <button class="btn-close">Закрыть</button>
            </div>
            <?php 
                require DIR . '/app/views/ModalWindowView.php'; 
            ?>
        </div>
    </div>

    <script src="/app/assets/scripts/user-message.js" defer></script>
    <script src="/app/assets/scripts/modal-window.js" defer></script>

    <?php echo $scripts; ?>

</body>
</html>