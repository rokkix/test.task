<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Тестовое задание “Каталог”</title>
    <link rel="stylesheet" href="css/styles.min.css" />
    <script src="js/jquery-1.8.3.min.js"></script>
    <script src="js/common.min.js"></script>
</head>
<body>
    <header class="header">
        <div class="header__inner">
            <a href="#"><img class="header__logo" src="images/header__logo.png" alt="Auto Company 7" /></a>
            <div class="header__info">Тестовое задание “Каталог”</div>
        </div>
    </header>
	
    <div class="layout">

        <aside class="sidebar">
            <form class="sidebar__form" method="post" action="/test.php">
                <h2 class="sidebar__title">Подберите авто</h2>
                <select class="form__select" name="make" id="make">
						<option value="0">Выберите марку</option>
				<?php foreach ($groupNames as $name) : ?>	
							<option value="<?php echo $name->name?>"><?php echo $name->name ?></option>
						<?php endforeach; ?>
                    
                </select>
                <select class="form__select" name="model" id="model">
                    <option value="0">Выберите модель</option>
                    <?php foreach ($groupModels as $model) : ?>	
							<option value="<?php echo $model->model?>"><?php echo $model->model ?></option>
						<?php endforeach; ?>
                </select>
                <label class="form__label" for="price">Цена</label>
                <div class="form__holder">
                    <input class="form__input form__input_margin_left" id="price" type="text"/><span class="form__label">-</span>
                    <input class="form__input form__input_margin_right" type="text"/><span class="form__label">$</span>
                </div>
                <div class="form__expand" id="hiddenContent">
                    <select class="form__select" name="fuel" id="fuel">
                        <option value="0">Тип топлива</option>
                        <option value="1">Бензин</option>
                        <option value="2">Дизель</option>
                    </select>
                    <select class="form__select" name="transmission" id="transmission">
                        <option value="0">Коробка передач</option>
                        <option value="1">Mazda</option>
                        <option value="2">Skoda</option>
                    </select>
                    <label class="form__label" for="year-from">Год</label>
                    <div class="form__holder">
                        <select class="form__select form__select_width_double" name="year-from" id="year-from">
                            <option value="">2013</option>
                            <option value="">2012</option>
                            <option value="">2011</option>
                        </select>
                        <span class="form__label">-</span>
                        <select class="form__select form__select_width_double" name="year-to" id="year-to">
                            <option value="">2012</option>
                            <option value="">2013</option>
                            <option value="">2011</option>
                        </select>
                    </div>
                </div>
                <button class="form__button" type="submit"><span class="form__button-inner">Показать результат</span></button>
                <div class="form__wrap"><a class="form__search" id="showHideContent" href="#">Расширенный поиск</a></div>
            </form>

            <div class="sidebar__brands">
                <ul class="sidebar__list">
				<?php foreach ($modelGroups as $modelGroup) : ?>	
						 <li class="sidebar__item"><a href="/test.php"><?php echo $modelGroup->name?> (<?php echo $modelGroup->groupmodel?>)</a></li>
				<?php endforeach; ?>
                    
                </ul>
                
            </div>
        </aside>

        <div class="content content_page_catalog">
            <div class="catalog">

                <div class="catalog__sort">
                    <span>Сортировать по:</span>
                    <a href="#">Дата выпуска
                        <i class="catalog__icon catalog__icon_type_down"></i>
                    </a>
                    <a href="/?ctrl=ad&act=SortByPrice">Цена
						
                        <i class="catalog__icon catalog__icon_type_down"></i>
                    </a>
                </div>

                <h1 class="catalog__title">Все авто</h1>
                <ul class="catalog__list">
					 <?php if (!empty($pages)): ?>
						 <?php foreach ($pages as $page) : ?>	
							<li class="catalog__item">
								<a class="catalog__image" href="#">
									<img src="images/cars/catalog/mazda.png" alt="Mazda 6" />
									<div class="catalog__badge">Новинка</div>
								</a>
								<div class="catalog__description">
									<div class="catalog__wrap">
										<span class="catalog__price">$<?php echo $page->price; ?></span>
									</div>
									<span class="catalog__number">#<?php echo $page->artil; ?></span>
									<a class="catalog__model" href="/?act=One&ctrl=admin&id=<?php echo $page->id?>"><?php echo $page->name; ?></a>
									<p class="catalog__features">
										<?php echo $page->date . ', ' . $page->type_fuel . ', ' . $page->korobka . ', ' . $page->kuzov; ?>
									</p>
									<p class="catalog__options" id="catalog__options">
										<span class="catalog__options-title">Описание:</span> <?php echo $page->description; ?>
									</p>
								</div>
							</li>
						<?php endforeach; ?>
					<?php else : ?>
						<h2>Новостей пока нет. Добавьте свою новость</h2>
					<?php endif ?>
                </ul>

                <div class="pagelist">
				
                   <?php echo $pagen;?>
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