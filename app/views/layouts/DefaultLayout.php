<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="icon" href="/app/assets/images/favicon.ico" type="image/x-icon">

    <title><?php echo $title; ?></title>

    <link rel="stylesheet" href="/app/assets/styles/index.css">
    <link rel="stylesheet" href="/app/assets/styles/default-header.css">
    <link rel="stylesheet" href="/app/assets/styles/default-footer.css">
    <link rel="stylesheet" href="/app/assets/styles/modal-window.css">

    <style>
        body {
            background: repeat center url("/app/assets/images/back1.jpg");
        }
    </style>

    <?php echo $styles; ?>
</head>
<body>

    <div id="app">
        <?php 
            require DIR . '/app/views/additional/' . ucfirst($layout) . 'Header.php';
            echo $content; 
            require DIR . '/app/views/additional/' . ucfirst($layout) . 'Footer.php';
        ?>
    </div>

    <div class="cover">
        <div class="window">
            <?php 
                require DIR . '/app/views/additional/' . ucfirst($layout) . 'FeedBackToAdmin.php'; 
                require DIR . '/app/views/ModalWindowView.php'; 
            ?>
        </div>
    </div>

    <script src="/app/assets/scripts/search.js" defer></script>
    <script src="/app/assets/scripts/form.js" defer></script>
    <script src="/app/assets/scripts/user-message.js" defer></script>
    <script src="/app/assets/scripts/DefaultHeader.js" defer></script>
    <script src="/app/assets/scripts/modal-window.js" defer></script>
    <script src="/app/assets/scripts/head-menu.js" defer></script>
    
    <?php echo $scripts; ?>

</body>
</html>