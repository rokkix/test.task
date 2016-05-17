<div class="container">
    <h1>Новости</h1>
   <?php if (!empty($news)): ?>
        <?php foreach ($news as $article) : ?>

            <div class="panel panel-success">
                <div class="panel-heading">
                   
                        <h4>    <?php echo $article->title; ?></h4>
                </div>
                <div class="panel-body"><?php echo $article->description; ?>
                    <p><a href="/news/one/?id=<?php echo $article->id ?>">Подробно >>></a></p>
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

