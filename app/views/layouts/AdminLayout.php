<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="icon" href="/app/assets/images/favicon.ico" type="image/x-icon">

    <title><?php echo $title; ?></title>

    <link rel="stylesheet" href="/app/assets/styles/index.css">
    <link rel="stylesheet" href="/app/assets/styles/admin-panel.css">

    <?php echo $styles; ?>
</head>
<body>

    <div id="app">
        <?php 
        require DIR . '/app/views/additional/' . ucfirst($layout) . 'Header.php';
        require DIR . '/app/views/additional/' . ucfirst($layout) . 'Nav.php'; 
        ?>

        <main>
            <?php echo $content; ?>
        </main>

        <?php 
        require DIR . '/app/views/additional/' . ucfirst($layout) . 'Footer.php';
        ?>
    </div>

    <script type="module" src="https://unpkg.com/ionicons@5.0.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule="" src="https://unpkg.com/ionicons@5.0.0/dist/ionicons/ionicons.js"></script>
    <script src="/app/assets/scripts/admin.js" defer></script>
    <script src="/app/assets/scripts/admin-message.js" defer></script>

    <?php echo $scripts; ?>

</body>
</html>