<?php
/**
	Template Name: Faq Page Template

*/
get_header(); 
?>
<link href="<?php echo esc_url( get_template_directory_uri() ); ?>/css/bootstrap.css" rel='stylesheet' type='text/css' />
<link href="<?php echo esc_url( get_template_directory_uri() ); ?>/css/style.css" rel='stylesheet' type='text/css' />
<?php while (have_posts()) : the_post(); ?>

<div class="header" style="position:relative; background:#000;">
		<div class="row" style="background:#000;">
			  <div class="col-md-12">
				  <div class="header-left">
					   <div class="logo">
						    <a href="/index.php/main/"><img class="logo-image" src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/LOGO.png" alt="" height="35" width="75" style="margin-top: 10px;"/></a>
					   </div>
             <ul class="header-menu">
				   <li><a href="/index.php/Main">HOME</a></li>
                  <li><a href="/index.php/Main">PRODUCT</a></li>
                  <li><a href="/index.php/Comingsoon">PRESS</a></li>
                  <li><a href="/index.php/Faq">SUPPORT</a></li>
				     <li><a href="../Cart">Cart</a></li>
                <div class="clear"></div>
             </ul>
	    		   <div class="clear"></div>
	    	  </div>
	        <div class="header_right">
          <div class="col-md-2">
            <ul class="icon1 sub-icon1 profile_img">
              <li><a class="active-icon c1" href="#"> </a></li>
           </ul>
               <div class="clear"></div>
         </div>
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
					<ul class="footer_box" style="padding-left: 40px;">
					<h4>PRODUCT</h4>
						<li><a href="/index.php/Main">HOME</a></li>
						<li><a href="/index.php/Main">TECH SPECS</a></li>
						<li><a href="/index.php/FAQ">FAQ</a></li>
					</ul>
					</div>
					<div class="col-md-2">
					<ul class="footer_box">
					<h4>COMPANY</h4>
						<li><a href="/index.php/comingsoon">BLOG</a></li>
						<li><a href="/index.php/comingsoon">PRESS</a></li>
						<li><a href="/index.php/aboutUs">ABOUT US</a></li>
						<li><a href="/index.php/comingsoon">CAREER</a></li>
						<li><a href="/index.php/comingsoon">CONTACT</a></li>
					</ul>
                    </div>
                    <div class="col-md-2">
                        <ul class="footer_box">
                            <h4>SOCIAL</h4>
                            <li><a href="https://www.facebook.com/1MoreUSA/">FACEBOOK</a></li>
                            <li><a href="https://twitter.com/1MOREUSA">TWITTER</a></li>
                            <li><a href="https://plus.google.com/u/1/b/109723769822278278709/109723769822278278709/">GOOGLE+</a></li>
                            <li><a href="https://www.instagram.com/1MOREUSA/">INSTAGRAM</a></li>
                        </ul>
                    </div>
          <div class="col-md-2">
            <ul class="footer_box">
			<h4>ENGLISH</h4>
			&nbsp;
			<a href='http://china.1more.com/'>
			<h4>中文</h4>
			</a>
			</ul>
          </div>
                    <div class="col-md-offset-1 col-md-3">
                        <ul class="footer_box">
                            <li><img class="logo-footer" src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/LOGO.png"/></li>
              <li><a href="#">email address : info@1moreusa.com</a></li>
              <hr>
             <li><a href="#">Copyright Terms & Conditions | Privacy Policy</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
<?php get_footer(); ?>