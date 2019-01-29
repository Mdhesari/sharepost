<?php include_once APPROOT . '/views/inc/header.php';?>

<!-- title and axolury buttons -->
<div class="row mb-3">
    <div class="col-md-6">
        <h1 class="display-4">Posts</h1>
    </div>
    <div class="col-md-6">
        <a href="<?php echo URLROOT; ?>/posts/add" class="btn btn-primary float-right">
            <i class="fa fa-pencil"></i> Add
        </a>
    </div>
</div>

<?php
flash('addpost-success');
flash('delete-success');
flash('editpost-success');
flash('like');
?>

<section id="posts" class="card-columns mt-3">
    <?php foreach ($data['posts'] as $post): ?>
    <article class="card">
        <?php if (strlen($post->image) > 8): ?>
        <img src="<?php echo URLROOT; ?>/assets/pictures/posts/<?php echo $post->user_id . '/' . $post->image ?>" class="card-img-top"
            alt="...">
        <?php endif;?>
        <div class="card-body">
            <h5 class="card-title">
                <?php echo $post->description; ?>
            </h5>
            <p class="author mb-3 text-muted">Written By
                <strong>
                    <?php echo $post->full_name; ?>
                </strong>
            </p>
            <p class="card-text">
                <?php echo $post->text; ?>
            </p>
        </div>
        <div class="card-footer">
            <a href="<?php echo URLROOT; ?>/posts/show/<?php echo $post->postId; ?>" class="btn btn-link">Read More</a>
            <small class="text-muted"><?php echo time_elapsed_string($post->date) ?></small>
        </div>
    </article>
    <?php endforeach;?>
</section>



<?php include_once APPROOT . '/views/inc/footer.php';?>