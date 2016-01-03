<?php
/**
 * Login Form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.2.6
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$show_reg_form = ( get_option( 'woocommerce_enable_myaccount_registration' ) === 'yes' ) ? true : false;

// Is this a popup form? - "$is_popup" is passed to "wc_get_template()" in footer.php
if ( isset( $is_popup ) ) {
	$hide_header_footer = false;
	// Redirect popup form to "my account" page
	$popup_redirect_url = esc_url( get_permalink( get_option( 'woocommerce_myaccount_page_id' ) ) );
	$popup_redirect_input = sprintf( '<input type="hidden" id="nm-login-popup-redirect-input" name="redirect" value="%s" />', $popup_redirect_url );
	$popup_form_action = sprintf( ' action="%s"', $popup_redirect_url );
} else {
	$hide_header_footer = true;
	$popup_redirect_input = $popup_form_action = '';
}

?>

<?php 
	// Include CSS for hiding header and footer?
	if ( $hide_header_footer ) : 
?>
<style type="text/css">
	.nm-header-placeholder, #nm-header, #nm-footer { display: none; }
	.nm-header-login { display: block; }
</style>
<?php endif; ?>

<?php do_action( 'woocommerce_before_customer_login_form' ); ?>

<div id="customer_login" class="nm-myaccount-login">
	<?php wc_print_notices(); ?>
		
    <div class="nm-myaccount-login-inner">
		
        <div id="nm-login-wrap" class="inline slide-up fade-in">
            <h2><?php _e( 'Login', 'woocommerce' ); ?></h2>
    
            <form<?php echo $popup_form_action; ?> method="post" class="login">
    			
                <?php echo $popup_redirect_input; ?>
                
                <?php do_action( 'woocommerce_login_form_start' ); ?>
    
                <p class="form-row form-row-wide">
                    <label for="username"><?php _e( 'Username or email address', 'woocommerce' ); ?> <span class="required">*</span></label>
                    <input type="text" class="input-text" name="username" id="username" value="<?php if ( ! empty( $_POST['username'] ) ) { echo esc_attr( $_POST['username'] ); } ?>" />
                </p>
                <p class="form-row form-row-wide">
                    <label for="password"><?php _e( 'Password', 'woocommerce' ); ?> <span class="required">*</span></label>
                    <input class="input-text" type="password" name="password" id="password" />
                </p>
    
                <?php do_action( 'woocommerce_login_form' ); ?>
    
                <p class="form-actions">
                    <?php wp_nonce_field( 'woocommerce-login' ); ?>
                    <input type="submit" class="button" name="login" value="<?php _e( 'Login', 'woocommerce' ); ?>" />
                </p>
                
                <p class="form-group">
                    <input name="rememberme" type="checkbox" id="rememberme" class="nm-custom-checkbox" value="forever" />
                    <label for="rememberme" class="nm-custom-checkbox-label inline"><?php _e( 'Remember me', 'woocommerce' ); ?></label>
                
                    <span class="lost_password"><a href="<?php echo esc_url( wc_lostpassword_url() ); ?>"><?php _e( 'Lost your password?', 'woocommerce' ); ?></a></span>
                </p>
                
                <?php if ( $show_reg_form ) : ?>
                
                <div class="nm-form-toggle form-row form-row-wide">
                    <div class="nm-login-form-sep">
                        <span><?php esc_html_e( 'Or', 'nm-framework' ); ?></span>
                    </div>
                    <a href="#" id="nm-show-register-button" class="button border"><?php _e( 'Register', 'woocommerce' ); ?></a>
                </div>
                
                <?php endif; ?>
                
                <?php do_action( 'woocommerce_login_form_end' ); ?>
    
            </form>
        </div>

        <?php if ( $show_reg_form ) : ?>

        <div id="nm-register-wrap">
            <h2><?php _e( 'Register', 'woocommerce' ); ?></h2>
    
            <form<?php echo $popup_form_action; ?> method="post" class="register">
    			
                <?php echo $popup_redirect_input; ?>
                
                <?php do_action( 'woocommerce_register_form_start' ); ?>
    
                <?php if ( 'no' === get_option( 'woocommerce_registration_generate_username' ) ) : ?>
    
                    <p class="form-row form-row-wide">
                        <label for="reg_username"><?php _e( 'Username', 'woocommerce' ); ?> <span class="required">*</span></label>
                        <input type="text" class="input-text" name="username" id="reg_username" value="<?php if ( ! empty( $_POST['username'] ) ) { echo esc_attr( $_POST['username'] ); } ?>" />
                    </p>
    
                <?php endif; ?>
    
                <p class="form-row form-row-wide">
                    <label for="reg_email"><?php _e( 'Email address', 'woocommerce' ); ?> <span class="required">*</span></label>
                    <input type="email" class="input-text" name="email" id="reg_email" value="<?php if ( ! empty( $_POST['email'] ) ) { echo esc_attr( $_POST['email'] ); } ?>" />
                </p>
    
                <?php if ( 'no' === get_option( 'woocommerce_registration_generate_password' ) ) : ?>
    
                    <p class="form-row form-row-wide">
                        <label for="reg_password"><?php _e( 'Password', 'woocommerce' ); ?> <span class="required">*</span></label>
                        <input type="password" class="input-text" name="password" id="reg_password" />
                    </p>
    
                <?php endif; ?>
    
                <!-- Spam Trap -->
                <div style="<?php echo ( ( is_rtl() ) ? 'right' : 'left' ); ?>: -999em; position: absolute;"><label for="trap"><?php _e( 'Anti-spam', 'woocommerce' ); ?></label><input type="text" name="email_2" id="trap" tabindex="-1" /></div>
    
                <?php do_action( 'woocommerce_register_form' ); ?>
                <?php do_action( 'register_form' ); ?>
    
                <p class="form-actions">
                    <?php wp_nonce_field( 'woocommerce-register' ); ?>
                    <input type="submit" class="button" name="register" value="<?php _e( 'Register', 'woocommerce' ); ?>" />
                </p>
                
                <?php if ( $show_reg_form ) : ?>
                
                <div class="nm-form-toggle form-row form-row-wide">
                    <div class="nm-login-form-sep">
                        <span><?php esc_html_e( 'Or', 'nm-framework' ); ?></span>
                    </div>
                    <a href="#" id="nm-show-login-button" class="button border"><?php _e( 'Login', 'woocommerce' ); ?></a>
                </div>
                
                <?php endif; ?>
                
                <?php do_action( 'woocommerce_register_form_end' ); ?>
    
            </form>
        </div>
    
        <?php endif; ?>

        <?php do_action( 'woocommerce_after_customer_login_form' ); ?>
    
    </div>
</div>
