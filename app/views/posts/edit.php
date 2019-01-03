<?php include_once APPROOT . '/views/inc/header.php';?>

<section id="edit-post">
<?php flash('editpost-fail'); 
      flash('addpost-fail'); 
?>
<!-- __title__ -->
    <h3 class="display-4 text-center text-warning">Edit Post</h3>
    <p class="text-muted text-center" style="font-size:17px;">What's in your mind?!</p>
    <form action="<?php echo URLROOT; ?>/posts/edit/<?php echo $data['post_id'];?>" method="post"> 
        <!-- __description__ -->
        <div class="form-group">
            <input class="form-control <?php echo !empty($data['description_err']) ? 'is-invalid' : ''; ?>" name="description" type="text" placeholder="Description..." value="<?php echo $data['description']; ?>">
            <p class="invalid-feedback"><?php echo $data['description_err']; ?></p>
        </div>
        <!-- __text__ -->
        <div class="form-group">
            <textarea class="form-control <?php echo !empty($data['text_err']) ? 'is-invalid' : ''; ?>" name="text" id="" cols="30" rows="10" placeholder="Text..."><?php echo $data['text']; ?></textarea>
            <p class="invalid-feedback"><?php echo $data['text_err']; ?></p>
        </div>
        <input class="btn btn-primary" type="submit" value="Edit">

    </form>

</section>
<?php include_once APPROOT . '/views/inc/footer.php';?>