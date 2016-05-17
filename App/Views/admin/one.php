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

      <button style="background-color: cornflowerblue"><a href="/?act=create&ctrl=admin">Создать</a></button>
	  <button style="background-color: green"><a href="/?ctrl=admin">Назад</a></button>
     <button style="background-color: cornflowerblue"><a href="/?act=update&ctrl=admin&id=<?php echo $ad->id;?>">Изменить</a></button>
	<button style="background-color: red"><a href="/?act=delete&ctrl=admin&id=<?php echo $ad->id;?>">Удалить</a></button>
                <h1 class="catalog__title">Авто</h1>
                <ul class="catalog__list">
					 <?php if (!empty($ad)): ?>
						 	
							<li class="catalog__item">
								<a class="catalog__image" href="#">
									<?php if (file_exists(__DIR__ . '/../images/' . $ad->id . '.jpeg')): ?>
										<img src="App/Views/images/<?php echo $ad->id;?>.jpeg" alt="" />
									<?php else:?>	
										<img src="App/Views/images/no_image.jpeg" alt="" />
									<?php endif ?>
									<?php if ($ad->flag) : ?>
										<div class="catalog__badge">Новинка</div>
									<?php endif ?>	
								</a>
								<div class="catalog__description">
									<div class="catalog__wrap">
										<span class="catalog__price">$<?php echo $ad->price; ?></span>
									</div>
									<span class="catalog__number">#<?php echo $ad->artil; ?></span>
									 <?php echo $ad->name .' '.$ad->model; ?>
									<p class="catalog__features">
										<?php echo $ad->date . ', ' . $ad->type_fuel . ', ' . $ad->korobka . ', ' . $ad->kuzov; ?>
									</p>
									<p class="catalog__options" id="catalog__options">
										<span class="catalog__options-title">Описание:</span> <?php echo $ad->description; ?>
									</p>
								</div>
							</li>
						
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