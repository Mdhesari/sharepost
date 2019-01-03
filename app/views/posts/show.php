<?php include_once APPROOT . '/views/inc/header.php';?>

<a href="<?php echo URLROOT; ?>/posts" class="btn btn-light">
<i class="fa fa-backward"></i> Back
</a>

<section id="post-show" class="mt-4">
    <h1 class="display-4"><?php echo $data['post']->description; ?></h1>
    <p class="text-info mb-4 mt-1">Published On <?php echo $data['post']->date; ?></p>
    <div class="bg-light py-3 px-4">
        <p class="lead"><?php echo $data['post']->text; ?></p>
    </div>
    <p class="mt-3 text-muted">Written By
        <strong><?php echo $data['user']->full_name; ?></strong>
    </p>
    <?php if($data['post']->user_id == $_SESSION['user_id']): ?>
    <hr>
    <!-- __Edit__Button__ -->
    <a href="<?php echo URLROOT; ?>/posts/edit/<?php echo $data['post']->id; ?>" class="btn btn-dark">Edit</a>

    <!-- __Delete__Button__ -->
    <form class="float-right" action="<?php echo URLROOT;?>/posts/delete/<?php echo $data['post']->id; ?>" method="post">
       <input type="submit" value="Delete" class="btn btn-danger"> 
    </form>
    <?php endif; ?>
</section>


<?php include_once APPROOT . '/views/inc/footer.php';?>