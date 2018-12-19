<?php require_once APPROOT . '/views/inc/header.php';?>
<h1><?php echo $data['title']; ?></h1>
    <ul>
    <?php foreach($data['posts'] as $post): ?>
    <li><?php echo $post->title;?><br>
    <?php echo $post->text;?>
    <?php endforeach; ?>
    </ul>
<?php include_once APPROOT . '/views/inc/footer.php';?>
