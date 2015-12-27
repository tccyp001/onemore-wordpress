<?php
/**
	Template Name: Faq Page Template

*/
get_header(); 
?>
<link href="<?php echo esc_url( get_template_directory_uri() ); ?>/css/bootstrap.css" rel='stylesheet' type='text/css' />
<link href="<?php echo esc_url( get_template_directory_uri() ); ?>/css/style.css" rel='stylesheet' type='text/css' />
<?php while (have_posts()) : the_post(); ?>

<div id="page-content">
	<?php the_content(); endwhile; ?>
</div>
<?php get_footer(); ?>