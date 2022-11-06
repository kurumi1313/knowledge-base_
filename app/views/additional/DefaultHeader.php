<nav>
    <ul class="navbar">
      <li><a href="/">Главная</a></li>
      <li><a href="/instructions">Инструкции</a></li>
      <li><a href="/standarts" class="document">Документация</a>
        <ul class="docmenu">
          <li><a href="/standarts">Стандарты</a></li>
          <li><a href="/licenses">Лицензии</a></li>
          <li><a href="/laws">Законы</a></li>
        </ul>
      </li>
      <li><a href="/FAQ" class="FAQ">FAQ</a></li>
    </ul>
</nav>
<header>
  <div class="header-block">
    <div class="header-left">
      <button id="btnmenu" class="menu menu-text"></button>
      <h1 class="head-text">База Знаний</h1>
      <h1 class="head-text"><?php echo ucfirst($_SESSION['userInfo']['firstname']) . ' ' . ucfirst($_SESSION['userInfo']['secondname']); ?></h1>
      <h1 class="head-text"><?php echo ucfirst($_SESSION['userInfo']['role']); ?></h1>
      <?php if ($_SESSION['userInfo']['role'] !== 'admin') : ?>
      <div class="newInstructionBlock">
        <a class="newInstruction" href="/instruction/create">Создать инструкцию</a>
        <a class="newInstruction" href="/logout?r=user">Выйти</a>
        <button class="connectionwithadmin">Связь с администратором</button>
      </div>
      <?php endif; ?>
    </div>
    <div class="header-center">
      <form class="searchblock form-send" action="/search" method="POST">
        <input class="search" type="search" name="s" placeholder="Искать здесь..." required>
        <input class="searchbutton" type="submit" value="Поиск">
      </form>
      <div class = "block_intstruction">
      <a class="instruction" href="/app/assets/documents/Инструкция_к_базе_знаний.pdf">Инструкция по сайту</a>
      </div>
    </div>
    <div class="header-right">
      <div class="footer-logo">
        <img class="logo" src="/app/assets/images/logo.jpg">
      </div>
    </div>
  </div>
  <h1 class="head-caption">Великий Кулинар</h1>
</header>