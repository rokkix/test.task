<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Тестовое задание “Каталог”</title>
    <link rel="stylesheet" href="css/styles.min.css"/>
    <script src="js/jquery-1.8.3.min.js"></script>
    <script src="js/script.js"></script>
    <script src="js/common.js"></script>
</head>
<body>
<header class="header">
    <div class="header__inner">
        <a href="#"><img class="header__logo" src="images/header__logo.png" alt="Auto Company 7"/></a>
        <div class="header__info">Тестовое задание “Каталог”</div>
    </div>
</header>

<div class="layout">

    <aside class="sidebar">
        <form class="sidebar__form" method="get" action="">
            <input type="hidden" name="act" value="SortByValues"/>
            <input type="hidden" name="ctrl" value="Ad"/>
            <h2 class="sidebar__title">Подберите авто</h2>
            <select class="form__select" name="name" id="make">
                <option value="0">Выберите марку</option>
                <?php foreach ($groupNames as $name) : ?>

                    <option value="<?php echo $name->name ?>"><?php echo $name->name ?></option>
                <?php endforeach; ?>

            </select>
            <select class="form__select" name="model" id="model">
                <option value="0">Выберите модель</option>
                <?php foreach ($groupModels as $model) : ?>
                    <option value="<?php echo $model->model ?>"><?php echo $model->model ?></option>
                <?php endforeach; ?>
            </select>
            <label class="form__label" for="price">Цена</label>
            <div class="form__holder">
                <input class="form__input form__input_margin_left" id="price" type="text" value="0" name="pricel"/><span
                    class="form__label">-</span>
                <input class="form__input form__input_margin_right" type="text" value="20000" name="pricer"/><span
                    class="form__label">$</span>
            </div>
            <div class="form__expand" id="hiddenContent">
                <select class="form__select" name="type_fuel" id="fuel">
                    <option value="0">Тип топлива</option>
                    <?php foreach ($groupFuels as $groupFuel) : ?>
                        <option value="<?php echo $groupFuel->type_fuel ?>"><?php echo $groupFuel->type_fuel ?></option>
                    <?php endforeach; ?>
                </select>
                <select class="form__select" name="korobka" id="transmission">
                    <option value="0">Коробка передач</option>
                    <?php foreach ($groupTransmissions as $groupTransmission) : ?>
                        <option
                            value="<?php echo $groupTransmission->korobka ?>"><?php echo $groupTransmission->korobka ?></option>
                    <?php endforeach; ?>
                </select>
                <label class="form__label" for="year_from">Год</label>
                <div class="form__holder">
                    <select class="form__select form__select_width_double" name="year_from" id="year_from">
                        <option value="1960"></option>
                        <?php foreach ($groupDates as $groupDate) : ?>
                            <option value="<?php echo $groupDate->date ?>"><?php echo $groupDate->date ?></option>
                        <?php endforeach; ?>
                    </select>
                    <span class="form__label">-</span>
                    <select class="form__select form__select_width_double" name="year_to" id="year_to">
                        <option value="2016"></option>
                        <?php foreach ($groupDates as $groupDate) : ?>
                            <option value="<?php echo $groupDate->date ?>"><?php echo $groupDate->date ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <button class="form__button" type="submit"><span class="form__button-inner">Показать результат</span>
            </button>
            <div class="form__wrap"><a class="form__search" id="showHideContent" href="#">Расширенный поиск</a></div>
        </form>

        <div class="sidebar__brands">
            <ul class="sidebar__list">
                <?php foreach ($modelGroups as $modelGroup) : ?>
                    <li class="sidebar__item" id= <?php echo $modelGroup->name ?>><?php echo $modelGroup->name ?>
                        (<?php echo $modelGroup->groupmodel ?>)
                    </li>
                <?php endforeach; ?>

            </ul>

        </div>
    </aside>

    <div class="content content_page_catalog">
        <div class="catalog">

            <div class="catalog__sort">
                <span>Сортировать по:</span>
                <a href="date">Дата выпуска
                    <i class="catalog__icon catalog__icon_type_down"></i>
                </a>
                <a href="price">Цена

                    <i class="catalog__icon catalog__icon_type_down"></i>
                </a>
            </div>

            <h1 class="catalog__title">Все авто</h1>
            <ul id=tovar class="catalog__list">
                <?php if (!empty($pages)): ?>
                    <?php foreach ($pages as $page) : ?>
                        <li class="catalog__item">
                            <a class="catalog__image" href="#">
                                <?php if (file_exists(__DIR__ . '/App/Views/images/' . $page->id . '.jpeg')): ?>
                                    <img src="App/Views/images/<?php echo $page->id; ?>.jpeg" alt=""/>
                                <?php else: ?>
                                    <img src="App/Views/images/no_image.jpeg" alt=""/>
                                <?php endif ?>
                                <?php if ($page->flag) : ?>
                                    <div class="catalog__badge">Новинка</div>
                                <?php endif ?>

                            </a>
                            <div class="catalog__description">
                                <div class="catalog__wrap">
                                    <span class="catalog__price">$<?php echo $page->price; ?></span>
                                </div>
                                <span class="catalog__number">#<?php echo $page->artil; ?></span>
                                <a class="catalog__model" href="#"><?php echo $page->name . ' ' . $page->model; ?></a>
                                <p class="catalog__features">
                                    <?php echo $page->date . ', ' . $page->type_fuel . ', ' . $page->korobka . ', ' . $page->kuzov; ?>
                                </p>
                                <p class="catalog__options" id="catalog__options">
                                    <span
                                        class="catalog__options-title">Описание:</span> <?php echo $page->description; ?>
                                </p>
                            </div>
                        </li>
                    <?php endforeach; ?>
                <?php else : ?>
                    <h2>Объявлений нет.</h2>
                <?php endif ?>
            </ul>

            <div class="pagelist" id="page">

                <?php echo $pagen; ?>
            </div>
        </div>
    </div>
</div>

<footer class="footer">
    <div class="footer__inner">
        <div class="footer__copyright">© Lamanteam, 2015</div>
    </div>
</footer>

</body>
</html>