<?php include_once APPROOT . '/views/inc/header.php';?>

<a href="<?php echo URLROOT; ?>/posts" class="btn btn-light">
    <i class="fa fa-backward"></i> Back
</a>

<div class="mt-3">
    <?php
flash('comment_added');
flash('comment_failed');
?>
</div>

<section id="post-show" class="mt-4">
    <?php if (strlen($data['post']->image) > 8): ?>
    <img src="<?php echo URLROOT; ?>/assets/pictures/posts/<?php echo $_SESSION['user_id'] . '/' . $data['post']->image; ?>"
        class="img-thumbnail" alt="...">
    <?php endif;?>

    <h1 class="display-4">
        <?php echo $data['post']->description; ?>
    </h1>

    <p class="text-info mb-4 mt-1">
        <?php echo time_elapsed_string($data['post']->date); ?>
    </p>

    <div class="bg-light py-3 px-4">
        <p class="lead">
            <?php echo $data['post']->text; ?>
        </p>
    </div>

    <p class="mt-3 text-muted">Written By
        <strong>
            <?php echo $data['user']->full_name; ?>
        </strong>
    </p>

    <?php if ($data['post']->user_id == $_SESSION['user_id']): ?>

    <hr>

    <!-- __Edit__Button__ -->
    <a href="<?php echo URLROOT; ?>/posts/edit/<?php echo $data['post']->id; ?>" class="btn btn-dark">Edit</a>

    <!-- __Delete__Button__ -->
    <form class="float-right" action="<?php echo URLROOT; ?>/posts/delete/<?php echo $data['post']->id; ?>"
        method="post">
        <input type="submit" value="Delete" class="btn btn-danger">

    </form>

    <?php endif;?>
    
</section>

<section id="comments" class="bg-light p-4 mt-5">
    <!-- __title__ -->
    <div class="row">
        <h3 data-toggle="collapse" data-target="#view_comments"><i class="fa fa-comments"></i> Comments <span
                class="text-mini">[Click here]</span></h3>

    </div>

    <!-- __comments__ -->
    <div class="collapse" id="view_comments">

        <form class="mt-5" action="<?php echo URLROOT; ?>/comments/add/<?php echo $data['post']->id; ?>" method="post">
            <!-- __textarea__ -->
            <div class="form-group">
                <textarea name="comment_text" required id="comment_text" rows="5" placeholder="Feedback..."></textarea>
            </div>

            <!-- __submit__ -->
            <input type="submit" class="btn btn-primary">

        </form>
    </div>
</section>


<?php include_once APPROOT . '/views/inc/footer.php';?>