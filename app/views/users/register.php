<?php require_once APPROOT . '/views/inc/header.php';?>
    <section id="register-form" class="form-container col-md-6 mx-auto">
       <!-- __title__ -->
        <h3 class="display-4 mb-4 text-center">Create a new account</h3>

        <form action="<?php echo URLROOT; ?>/users/register" method="post">
        <!-- __fullname__ -->
         <div class="form-group">
            <input class="form-control <?php echo $data['fullname_err'] != '' ? 'is-invalid':''; ?>" type="text" name="fullname" placeholder="full name...">
            <p class="invalid-feedback"><?php echo $data['fullname_err']; ?></p>
         </div>
         <!-- __email__ -->
         <div class="form-group">
            <input class="form-control <?php echo $data['email_err'] != '' ? 'is-invalid':''; ?>" type="email" name="email" placeholder="email address...">
            <p class="invalid-feedback"><?php echo $data['email_err']; ?></p>
         </div>
         <!-- __username__ -->
         <div class="form-group">
         <input class="form-control <?php echo $data['fullname_err'] != '' ? 'is-invalid':''; ?>" type="text" name="username" placeholder="username...">
         <p class="invalid-feedback"><?php echo $data['fullname_err']; ?></p>
         </div>
         <!-- __password__ -->
         <div class="form-group">
            <input class="form-control <?php echo $data['password_err'] != '' ? 'is-invalid':''; ?>" name="password" type="password" placeholder="password...">
            <p class="invalid-feedback"><?php echo $data['password_err']; ?></p>
         </div>
         <!-- __confirm__password__ -->
         <div class="form-group">
            <input class="form-control <?php echo $data['password_confirm_err'] != '' ? 'is-invalid':''; ?>" name="password_confirm" type="password" placeholder="confirm password...">
            <p class="invalid-feedback"><?php echo $data['password_confirm_err']; ?></p>
         </div>
         <!-- __buttons__ -->
         <input type="submit" class="btn btn-success">
         <a href="<?php echo URLROOT; ?>/users/login" class="btn btn-link text-secondary">Already have an account?!</a>

        </form>

    </section>
<?php include_once APPROOT . '/views/inc/footer.php';?>