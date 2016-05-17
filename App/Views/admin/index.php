<div class="container">
    <h1>Новости</h1>
	
    <button class="btn btn-success btn-md" style="margin-bottom: 5px">
    <a href="/admin/create" style="text-decoration: none; color: white">    Написать свою новость</a>
    </button>
    <?php if (!empty($news)): ?>
        <?php foreach ($news as $article) : ?>

            <div class="panel panel-success">
                <div class="panel-heading">
                    
                        <h4>    <?php echo $article->title; ?></h4>
                </div>
                <div class="panel-body"><?php echo $article->text; ?>
                    <p><a href="/admin/one/?id=<?php echo $article->id ?>">Подробно >>></a></p>
                </div>
                <div class="panel-footer" style="font-size: small">
                    <?php if (!empty($article->author)):?>
                    <p><b>Автор
                            : </b><i> <?php echo $article->author->firstname . ' ' . $article->author->lastname; ?></i>
                    </p>
                <?php endif ?>
                    <p><b>Опубликовано: <?php echo $article->published; ?></b></p>
                </div>
            </div>

        <?php endforeach; ?>
    <?php else : ?>
        <h2>Новостей пока нет. Добавьте свою новость</h2>
    <?php endif ?>
</div>






			<?php if (!empty($ads)): ?>
				 <?php foreach ($ads as $ad) : ?>	
					<li class="catalog__item">
                        <a class="catalog__image" href="#">
                            <img src="images/cars/catalog/mazda.png" alt="Mazda 6" />
                            <div class="catalog__badge">Новинка</div>
                        </a>
                        <div class="catalog__description">
                            <div class="catalog__wrap">
                                <span class="catalog__price"></span>
                            </div>
                            <span class="catalog__number">#<?php echo $ad->artil; ?></span>
                            <a class="catalog__model" href="#"><?php echo $ad->name; ?></a>
                            <p class="catalog__features">
							
                                2008, 202 000, Бензин, Механика, Cедан
                            </p>
                            <p class="catalog__options" id="catalog__options">
                                <span class="catalog__options-title">Описание:</span> CD проигрыватель MP3, CD чейнджер MP3, AUX-разъём, Бортовой компьютер, Монохромный монитор, Кондиционер
                            </p>
                        </div>
                    </li>
				<?php endforeach; ?>
			<?php else : ?>
				<h2>Новостей пока нет. Добавьте свою новость</h2>
			<?php endif ?>




