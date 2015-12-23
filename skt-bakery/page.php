<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package SKT Bakery
 */

get_header(); ?>
<link href="<?php echo esc_url( get_template_directory_uri() ); ?>/css/woocommerce-layout-onemore.css" rel='stylesheet' type='text/css' />
<link href="<?php echo esc_url( get_template_directory_uri() ); ?>/css/main.css" rel='stylesheet' type='text/css' />
<link href="<?php echo esc_url( get_template_directory_uri() ); ?>/css/cart.css" rel='stylesheet' type='text/css' />
<link href="<?php echo esc_url( get_template_directory_uri() ); ?>/css/bootstrap.css" rel='stylesheet' type='text/css' />
<link href="<?php echo esc_url( get_template_directory_uri() ); ?>/css/shoppingcart-style.css" rel='stylesheet' type='text/css' />
<div class="header-fix">
		<div class="row">
			  <div class="col-md-12">
				 <div class="header-left">
					 <div class="shoppingcart-logo">
						<a href="../Main"><img class="logo-image" src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/LOGO.png" alt="" height="35" width="75"/></a>
					 </div>
          <ul class="header-menu">
                 <li><a href="../Main">HOME</a></li>
                  <li><a href="../Main">PRODUCT</a></li>
                  <li><a href="../comingSoon">PRESS</a></li>
                  <li><a href="../Faq">SUPPORT</a></li>
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
    <section class="site-main content-left page-content" id="sitemain">
 		<?php if( have_posts() ) :
							while( have_posts() ) : the_post(); ?>
                            	<h1 class="entry-title"><?php the_title(); ?></h1>
                                <div class="entry-content">
                                			<?php the_content(); ?>
                                            <?php
												//If comments are open or we have at least one comment, load up the comment template
												if ( comments_open() || '0' != get_comments_number() )
													comments_template();
												?>
                                </div><!-- entry-content -->
                      		<?php endwhile; else : endif; ?>
      <div class="clear"></div>
        </section>
        
        <div class="clear"></div>
    </div>
    </div><!-- content -->
<?php get_footer(); ?>