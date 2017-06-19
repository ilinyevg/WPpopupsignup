//fancybox plugin used
add_action( 'wp_ajax_user_signup', 'user_signup' );
add_action('wp_ajax_nopriv_user_signup', 'user_signup');
 
function user_signup() {

   global $reg_errors, $username, $password, $email, $first_name, $last_name;
   
    validate_form( 
        $_POST['username'],
        $_POST['password'],
        $_POST['email'], 
        $_POST['fname'],
        $_POST['lname']
        );
    
    $first_name =   sanitize_text_field( $_POST['fname'] );
    $last_name  =   sanitize_text_field( $_POST['lname'] );
    $email      =   sanitize_email( $_POST['email'] );
    $username   =   sanitize_user( $_POST['username'] );
    $password   =   esc_attr( $_POST['password'] );

    if ( count( $reg_errors->get_error_messages()) < 1 ) {   
        save_signup_details();  
    }  
}

function signup_popup_form() {  
    ob_start();
    ?>
    <div style="text-align:center;">
    <a href="#registration_form">Apply Now</a>
    </div>
    <div class="fancybox-hidden" style="display: none;">
        <div id="registration_form">
          <form id="photographer_signup" class="photographer_signup regform"  action="<?php echo admin_url('admin-ajax.php'); ?>" method="post" enctype="multipart/form-data">
            <h4>SIGN UP</h4>
            <div id ="errors"></div>
            
            <input type="hidden" name="action" value="user_signup">

             <div> 
                <input type="text" name="fname" id="fname" placeholder="First Name" required value="<?php ( isset( $first_name ) ? $first_name : null ) ?>">
            </div>
            
            <div> 
                <input type="text" name="lname" id="lname" placeholder="Last Name" required value="<?php ( isset( $last_name ) ? $last_name : null ) ?>">
            </div>

             <div> 
                <input type="email" name="email" id="email"  placeholder="Email" required value="<?php ( isset( $email ) ? $email : null ) ?>"  >
            </div>

            <div> 
                <input type="text" name="username" id="username" placeholder="Username" required value="<?php ( isset( $username ) ? $username : null ) ?>">
            </div>

            <div> 
                <input type="password" name="password" id="password" placeholder="Password" required >
            </div>
            
            <div>
                <input class="" type="submit" name="submit" value="Register"/>
            </div> 
           
          </form>
        </div>
    </div>

    <?php
    echo ob_get_clean(); 
}
