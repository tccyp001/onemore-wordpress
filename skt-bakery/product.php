<?php
/**
	Template Name: PRODUCT Template

*/
?>
<html>
<head>
<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
<style type="text/css">

</style>
<title><?php wp_title( '|', true, 'right' ); bloginfo('name'); ?></title>


<link href="<?php echo esc_url( get_template_directory_uri() ); ?>/css/bootstrap.css" rel='stylesheet' type='text/css' />
<link href="<?php echo esc_url( get_template_directory_uri() ); ?>/css/style.css" rel='stylesheet' type='text/css' />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800' rel='stylesheet' type='text/css'>
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/jquery.min.js"></script>
<!--<script src="js/jquery.easydropdown.js"></script>-->
<!--start slider -->

<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/jquery-ui.min.js"></script>


</head>

<body>
<?php while (have_posts()) : the_post(); ?>
<div class="header">
		<div class="row">
			  <div class="col-md-12">
				 <div class="header-left">
					 <div class="logo">
						<a href="index.html"><img class="logo-image" src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/LOGO.png" alt="" height="35" width="75"/></a>
					 </div>
          <ul class="header-menu">
                 <li><a href="../Main">HOME</a></li>
                  <li><a href="./Main">PRODUCT</a></li>
                  <li><a href="../ComingSoon">PRESS</a></li>
                  <li><a href="../FAQ">SUPPORT</a></li>
                <div class="clear"></div>
          </ul>
	    		  <div class="clear"></div>
	    	    </div>
	            <div class="header_right" style="margin:5px; width:12%;">
				    <button class="buy-button" onclick="buyBtnClicked()">
              <a href="#">BUY NOW</a>
            </button>
	         </div>
	      </div>
	 </div>
	</div>

<div id="page-content">
	<?php the_content(); endwhile; ?>
</div>
<div class="footer">
            <div class="container">
                <div class="row">
                <div class="col-md-2">
                        <ul class="footer_box">
                            <h4>PRODUCT</h4>
                            <li><a href="../Main">HOME</a></li>
                            <li><a href="../Main">TECH SPECS</a></li>
                            <li><a href="../FAQ">FAQ</a></li>
                        </ul>
                    </div>
                    <div class="col-md-2">
                        <ul class="footer_box">
                            <h4>COMPANY</h4>
                            <li><a href="../comingSoon">BLOG</a></li>
                            <li><a href="../comingSoon">PRESS</a></li>
                            <li><a href="../aboutUs">ABOUT US</a></li>
                            <li><a href="../comingSoon">CAREER</a></li>
							<li><a href="../comingSoon">CONTACT</a></li>
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