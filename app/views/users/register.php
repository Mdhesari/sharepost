<?php require_once APPROOT . '/views/inc/header.php';?>

    <section id="register-form" class="form-container col-md-6 mx-auto">
       <!-- __title__ -->
        <h3 class="display-4 text-center">Create a new account</h3>
        <p class="text-muted text-center" style="font-size:17px;">Start with our website and enjoy as much as you can...</p>

        <form action="<?php echo URLROOT; ?>/users/register" method="post">
        <!-- __fullname__ -->
         <div class="form-group">
            <input class="form-control <?php echo $data['fullname_err'] != '' ? 'is-invalid' : ''; ?>" type="text" name="fullname" placeholder="full name..." required value="<?php echo $data['fullname']; ?>">
            <p class="invalid-feedback"><?php echo $data['fullname_err']; ?></p>
         </div>
         <!-- __email__ -->
         <div class="form-group">
            <input class="form-control <?php echo $data['email_err'] != '' ? 'is-invalid' : ''; ?>" type="email" name="email" placeholder="email address..." required value="<?php echo $data['email']; ?>">
            <p class="invalid-feedback"><?php echo $data['email_err']; ?></p>
         </div>
         <!-- __username__ -->
         <div class="form-group">
         <input class="form-control <?php echo $data['username_err'] != '' ? 'is-invalid' : ''; ?>" type="text" name="username" placeholder="username..." required value="<?php echo $data['username']; ?>">
         <p class="invalid-feedback"><?php echo $data['username_err']; ?></p>
         </div>
         <!-- __password__ -->
         <div class="form-group">
            <input class="form-control <?php echo $data['password_err'] != '' ? 'is-invalid' : ''; ?>" name="password" type="password" placeholder="password..." required value="<?php echo $data['password']; ?>">
            <p class="invalid-feedback"><?php echo $data['password_err']; ?></p>
         </div>
         <!-- __password__confirm__ -->
         <div class="form-group">
            <input class="form-control <?php echo $data['password_confirm_err'] != '' ? 'is-invalid' : ''; ?>" name="password_confirm" type="password" placeholder="confirm password..." required value="<?php echo $data['password_confirm']; ?>">
            <p class="invalid-feedback"><?php echo $data['password_confirm_err']; ?></p>  
         </div>
         <!-- __Gender__ -->
         <div class="btn-group mb-3" data-toggle="buttons">
            <label class="btn active">
               <input type="radio" name='gender' value="male" checked>
               <i class="fa fa-circle-o fa-2x"></i>
               <i class="fa fa-check-circle-o fa-2x"></i>
               <span> Male</span>
            </label>
            <label class="btn">
                <input type="radio" name='gender' value="female">
                <i class="fa fa-circle-o fa-2x"></i>
                <i class="fa fa-check-circle-o fa-2x"></i>
                <span> Female</span>
            </label>
         </div><br>

         <!-- __buttons__ -->
         <input type="submit" class="btn btn-success">
         <a href="<?php echo URLROOT; ?>/users/login" class="btn btn-link text-link">Already have an account?!</a>

        </form>

    </section>

<?php include_once APPROOT . '/views/inc/footer.php';?>