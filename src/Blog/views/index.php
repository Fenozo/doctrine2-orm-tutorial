<?= $renderer->render('header'); ?>

    <h1>Bienvenue sur le blog</h1>


    <ul>
        <li> <a href="<?php echo $router->generateUri('blog.show', ['slug'=>'dfsdhfosdhfod-45']); ?> ">Article 1</a> </li>
        <li>Article</li>
        <li>Article</li>
        <li>Article</li>
        <li>Article</li>
        <li>Article</li>
        <li>Article</li>
    </ul>
<?= $renderer->render('footer'); ?>
