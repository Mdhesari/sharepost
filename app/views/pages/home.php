<?php require_once APPROOT . '/views/inc/header.php';?>
    <div class="jumbotron">
        <h1><?php echo $data['title']; ?></h1>
        <p class="lead"><?php echo $data['description']; ?></p>
        <a class="btn btn-info" href="<?php echo URLROOT;?>">How to start?</a>
    </div>
<?php include_once APPROOT . '/views/inc/footer.php';?>