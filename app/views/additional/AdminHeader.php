        <header class="admin_header">
            <div class="admin_header-container">
                <div class="menu-toggle_btn">
                    <ion-icon name="menu-outline"></ion-icon>
                </div>
                <div class="status_bar">
                    Добро пожаловать в Административную панель!
                </div>
                <div class="min_menu_btn-right">
                    <?php echo ucfirst($_SESSION['userInfo']['firstname']) . ' ' . ucfirst($_SESSION['userInfo']['secondname']); ?>
                </div>
            </div>
            <div class="admin_header-right_menu">
                <ul>
                    <li>
                        <a href="/admin/panel/add/admin" class="admin_header-right_menu-links">
                            Добавить админа
                        </a>
                    </li>
                    <!--<li>
                        <a href="/admin/panel/reports">
                            Отчеты
                        </a>
                    </li>-->
                    <li>
                        <a href="/logout?r=admin">
                            Выйти
                        </a>
                    </li>
                </ul>
            </div>
        </header>