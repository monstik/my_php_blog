<h1>Главная страница</h1>
<div>
    <?php
    foreach ($news as $val) :?>
        <h2><?php echo $val['title'] ?></h2>
        <p><?php echo $val['description'] ?></p>
    <?php endforeach;?>

</div>