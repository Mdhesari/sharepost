<?php include_once APPROOT . '/views/inc/header.php';?>

<!-- title and axolury buttons -->
<div class="row">
    <div class="col-md-6">
        <h1 class="display-4">Posts</h1>
    </div>
    <div class="col-md-6">
        <a href="<?php echo URLROOT; ?>/posts/add" class="btn btn-primary float-right">
            <i class="fa fa-pencil"></i> Add
        </a>
    </div>
</div>

<!-- posts area -->
<section class="mt-5" id="post">
    <?php flash('addpost-success'); 
          flash('delete-success');    
          flash('editpost-success');   
    ?>
    <?php foreach ($data['posts'] as $post): ?>
    <div class="card card-body mb-4">
        <h4 class="mb-2 card-title text-capitalize"><?php echo $post->description; ?></h4>
        <span class="text-info">On <?php echo $post->date; ?></span>
        <span class="mb-3 text-muted">Written By
            <strong><?php echo $post->full_name; ?></strong>
        </span>
        <p class="card-text"><?php echo $post->text; ?></p>
        <a href="<?php echo URLROOT;?>/posts/show/<?php echo $post->postId; ?>" class="btn btn-link">Read More</a>
    </div>
</section>

<?php endforeach;?>
<?php include_once APPROOT . '/views/inc/footer.php';?>