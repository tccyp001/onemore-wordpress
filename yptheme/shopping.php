<?php
/**
	Template Name: Shopping Cart Template

*/
?>
<html>
<head>
<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
<style type="text/css">

</style>
<title><?php wp_title( '|', true, 'right' ); bloginfo('name'); ?></title>
<link href="<?php echo esc_url( get_template_directory_uri() ); ?>/css/woocommerce-layout-onemore.css" rel='stylesheet' type='text/css' />
<link href="<?php echo esc_url( get_template_directory_uri() ); ?>/css/main.css" rel='stylesheet' type='text/css' />
<link href="<?php echo esc_url( get_template_directory_uri() ); ?>/css/cart.css" rel='stylesheet' type='text/css' />
<link href="<?php echo esc_url( get_template_directory_uri() ); ?>/css/bootstrap.css" rel='stylesheet' type='text/css' />
<link href="<?php echo esc_url( get_template_directory_uri() ); ?>/css/shoppingcart-style.css" rel='stylesheet' type='text/css' />
<script type="text/javascript" src="/wp-includes/js/jquery/jquery.js?ver=1.11.3"></script>
<script type="text/javascript" src="/wp-includes/js/jquery/jquery-migrate.min.js?ver=1.2.1"></script>
<script type="text/javascript" src="/wp-content/plugins/woocommerce/assets/js/jquery-blockui/jquery.blockUI.min.js?ver=2.70"></script>
<script src = "/wp-content/plugins/woocommerce/assets/js/frontend/cart.js"> </script>
<script src = "/wp-content/plugins/woocommerce/assets/js/frontend/checkout.js"> </script>
<script src = "/wp-content/plugins/woocommerce/assets/js/frontend/cart-fragments.js"> </script>
<script type="text/javascript">
/* <![CDATA[ */
var wc_cart_params = {"ajax_url":"\/wp-admin\/admin-ajax.php","wc_ajax_url":"\/index.php\/cart\/?wc-ajax=%%endpoint%%","update_shipping_method_nonce":"0cdc9898ff"};
/* ]]> */
</script>
<script type="text/javascript">
/* <![CDATA[ */
var wc_checkout_params = {"ajax_url":"\/wp-admin\/admin-ajax.php","wc_ajax_url":"\/index.php\/checkout\/?wc-ajax=%%endpoint%%","update_order_review_nonce":"9578a72be5","apply_coupon_nonce":"971f568a64","remove_coupon_nonce":"02da8c8e35","option_guest_checkout":"yes","checkout_url":"\/index.php\/checkout\/?wc-ajax=checkout","is_checkout":"1","debug_mode":"","i18n_checkout_error":"Error processing checkout. Please try again."};
/* ]]> */
</script>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />


</head>

<body class='woocommerce-cart woocommerce-page customize-support'>
<?php while (have_posts()) : the_post(); ?>
<div class="header-fix">
		<div class="row">
			  <div class="col-md-12">
				 <div class="header-left">
					 <div class="shoppingcart-logo">
						<a href="index.html"><img class="logo-image" src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/LOGO.png" alt="" height="35" width="75"/></a>
					 </div>
          <ul class="header-menu">
                 <li><a href="./index.html">HOME</a></li>
                  <li><a href="./index.html">PRODUCT</a></li>
                  <li><a href="./comingSoon.html">PRESS</a></li>
                  <li><a href="./FAQ.html">SUPPORT</a></li>
                <div class="clear"></div>
          </ul>
	    		  <div class="clear"></div>
	    	    </div>
	            <div class="header_right">
             <div class="col-md-2">
          </div>
				    <ul class="icon1 sub-icon1 profile_img">
              <li><a class="active-icon c1" href="#"> </a></li>
              <li><a class="sb-icon-search" href="/shop"> </a></li>
				   </ul>
		           <div class="clear"></div>
	       </div>
	      </div>
	 </div>
	</div>
<div id="content">
    <div class="site-aligner">
        <section class="site-main content-left" id="sitemain">
        	 <div class="blog-post">
	<?php the_content(); endwhile; ?>
  </div><!-- blog-post -->
             </section>
        <div class="sidebar_right">
        </div><!-- sidebar_right -->
        <div class="clear"></div>
    </div><!-- site-aligner -->
</div><!-- content -->
<div class="footer">
            <div class="container">
                <div class="row">
                <div class="col-md-2">
                        <ul class="footer_box">
                            <h4>PRODUCT</h4>
                            <li><a href="./index.html">HOME</a></li>
                            <li><a href="./index.html">TECH SPECS</a></li>
                            <li><a href="./FAQ.html">FAQ</a></li>
                        </ul>
                    </div>
                    <div class="col-md-2">
                        <ul class="footer_box">
                            <h4>COMPANY</h4>
                            <li><a href="./comingSoon.html">BLOG</a></li>
                            <li><a href="./comingSoon.html">PRESS</a></li>
                            <li><a href="./aboutUs.html">ABOUT US</a></li>
                            <li><a href="./comingSoon.html">CAREER</a></li>
							<li><a href="./comingSoon.html">CONTACT</a></li>
                        </ul>
                    </div>
                   <div class="col-md-2">
                        <ul class="footer_box">
                            <h4>SOCIAL STUFF</h4>
                            <li><a href="https://www.facebook.com/1MoreUSA/">FACEBOOK</a></li>
                            <li><a href="https://twitter.com/1MOREUSA">TWITTER</a></li>
                            <li><a href="https://plus.google.com/u/1/b/109723769822278278709/109723769822278278709/">GOOGLE+</a></li>
                            <li><a href="https://www.instagram.com/1MOREUSA/">INSTAGRAM</a></li>
                        </ul>
                    </div>
          <div class="col-md-2">
            <ul class="footer_box">
              <h4>ENGLISH</h4>
              <a>
                <h4>中文</h4>
              </a>
            </ul>
          </div>
                    <div class="col-md-offset-1 col-md-3">
                        <ul class="footer_box">
                            <li><img class="logo-footer" src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/LOGO.png"/></li>
              <li><a href="#">email address</a></li>
              <hr>
             <li><a href="#">Copyright Terms & Conditions | Privacy Policy</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
</body>
</html>