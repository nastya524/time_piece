<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="public/assets/styles/app.css">
    <link rel="stylesheet" href="public/assets/css/catalog.css">
    <script>
        window.userId = <?= isset($_SESSION['user']['id']) ? json_encode($_SESSION['user']['id']) : "'null'" ?>;
    </script>
    <script defer src="public/assets/js/header.js"></script>
    <script defer src="public/assets/js/slider.js"></script>
    <script defer src="public/assets/js/cart-counter.js"></script>
    <title>TimePiece Palace</title>
</head>
<body>
    <header class="header">
        <div class="header__inner container">
            <div class="header__content">
                <a class="header__logo logo" href="/" >
                    <img class="logo__img"
                         src="public/assets/media/svg/logo.svg"
                         alt="TimePiece Palace"
                         width="202" height="30" loading="lazy"
                    >
                </a>
                <nav class="header__menu">
                    <ul class="header__menu-list">
                        <li class="header__menu-item"><a href="/brands" class="header__menu-link" title="Перейти к каталогу брендов">Бренды</a></li>
                        <li class="header__menu-item"><a href="/catalog" class="header__menu-link" title="Перейти к каталогу часов">Каталог</a></li>
                        <li class="header__menu-item"><a href="/catalog-man" class="header__menu-link" title="Перейти к каталогу мужских часов">Мужские</a></li>
                        <li class="header__menu-item"><a href="/catalog-woman" class="header__menu-link" title="Перейти к каталогу женских часов">Женские</a></li>
                    </ul>
                </nav>
                <ul class="header__icon-menu-list">
                    <?php
                    if(!isset($_SESSION["user"])) {
                    ?>
                        <li class="header__icon-menu-item">
                            <a href="/cart" class="header__icon-menu-link">
                                <span class="visually-hidden">Перейти в корзину</span>
                                <img class="header__icon-menu-img"
                                     src="public/assets/media/svg/cart.svg"
                                     alt="Перейти в корзину"
                                     title="Перейти в корзину"
                                     width="40" height="40" loading="lazy"
                                >
                                <span id="cartCounter" class="cart-counter"></span>
                            </a>
                        </li>
                        <li class="header__icon-menu-item header__icon-account-menu-item">
                            <a href="/registration" class="header__icon-account-menu-link">
                                <span class="visually-hidden">Зарегистрироваться</span>
                                <img class="header__icon-menu-img"
                                     src="public/assets/media/svg/user.svg"
                                     alt="Зарегистрироваться"
                                     title="Зарегистрироваться"
                                     width="40" height="40" loading="lazy"
                                >
                                <div class="header__menu-login">Войти</div>
                            </a>
                        </li>
                    <?php
                    } else {
                    ?>
                        <li class="header__icon-menu-item">
                            <a href="/cart" class="header__icon-menu-link">
                                <span class="visually-hidden">Перейти в корзину</span>
                                <img class="header__icon-menu-img"
                                     src="public/assets/media/svg/cart.svg"
                                     alt="Перейти в корзину"
                                     title="Перейти в корзину"
                                     width="40" height="40" loading="lazy"
                                >
                                <span id="cartCounter" class="cart-counter"></span>
                            </a>
                        </li>
                        <li class="header__icon-menu-item header__icon-account-menu-item">
                            <form action="/profile" method="get" style="margin-bottom: 0;">
                                <button class="header__icon-menu-link--logout header__icon-account-menu-link" type="button" id="profileButton">
                                    <img class="header__icon-menu-img"
                                         src="/public/assets/media/svg/user.svg"
                                         alt="Профиль"
                                         title="Профиль"
                                         width="40" height="40" loading="lazy">
                                    <div class="header__menu-login"><?=$_SESSION["user"]["first_name"] . " " . mb_substr($_SESSION["user"]["last_name"], 0, 1) . '.'?></div>
                                    <img class="arrow-icon" id="arrowIcon"
                                         src="/public/assets/media/svg/arrowIcon.svg"
                                         alt="Профиль"
                                         title="Профиль"
                                         width="16" height="8" loading="lazy">
                                </button>
                            </form>
                            <div class="dropdown-menu" id="dropdownMenu">
                                <?php
                                if ($_SESSION['user']['role'] == 1) {
                                ?>
                                <a href="/admin-panel" class="dropdown-menu-item">Админ-панель</a>
                                <hr class="dropdown-divider">
                                    <?php
                                }
                                ?>
                                <form action="/auth/logout" method="post" style="margin: 0;">
                                    <button type="submit" class="dropdown-menu-item dropdown-logout-btn">Выход</button>
                                </form>
                            </div>
                        </li>
                        <div class="screen-overlay" id="screenOverlay"></div>
                    <?php
                    }
                    ?>
                </ul>
            </div>
        </div>
    </header>
