<?php
/**
	Template Name: Index Page Template

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
<!--end slider -->
<script type="text/javascript">
        $(document).ready(function() {
            $(".dropdown img.flag").addClass("flagvisibility");

            $(".dropdown dt a").click(function() {
                $(".dropdown dd ul").toggle();
            });

            $(".dropdown dd ul li a").click(function() {
                var text = $(this).html();
                $(".dropdown dt a span").html(text);
                $(".dropdown dd ul").hide();
                $("#result").html("Selected value is: " + getSelectedValue("sample"));
            });

            function getSelectedValue(id) {
                return $("#" + id).find("dt a span.value").html();
            }

            $(document).bind('click', function(e) {
                var $clicked = $(e.target);
                if (! $clicked.parents().hasClass("dropdown"))
                    $(".dropdown dd ul").hide();
            });


            $("#flagSwitcher").click(function() {
                $(".dropdown img.flag").toggleClass("flagvisibility");
            });

            $("#testbtn").click(function () {
            $("#sidebar").toggleClass("collapsed");
           // $("#slider_container1").toggleClass("col-md-12 col-md-9");

            return false;
          });
		  
		    $('.awesome-tooltip').tooltip({
        placement: 'left'
    });

    $(window).bind('scroll',function(e){
      dotnavigation();
    });

    function dotnavigation(){

        var numSections = $('section').length;

        $('#dot-nav li a').removeClass('active').parent('li').removeClass('active');
        $('section').each(function(i,item){
          var ele = $(item), nextTop;

          console.log(ele.next().html());

          if (typeof ele.next().offset() != "undefined") {
            nextTop = ele.next().offset().top;
          }
          else {
            nextTop = $(document).height();
          }

          if (ele.offset() !== null) {
            thisTop = ele.offset().top - ((nextTop - ele.offset().top) / numSections);
          }
          else {
            thisTop = 0;
          }

          var docTop = $(document).scrollTop();

          if(docTop >= thisTop && (docTop < nextTop)){
            $('#dot-nav li').eq(i).addClass('active');
          }
        });
    }

    /* get clicks working */
    $('#dot-nav li').click(function(){

        var id = $(this).find('a').attr("href"),
          posi,
          ele,
          padding = 0;

        ele = $(id);
        posi = ($(ele).offset()||0).top - padding;

        $('html, body').animate({scrollTop:posi}, 'slow');

        return false;
    });

        });
     </script>

</head>

<body>
<?php while (have_posts()) : the_post(); ?>
<div class="header">
		<div class="row">
			  <div class="col-md-12">
				 <div class="header-left">
					 <div class="logo">
						<a href="/index.php/main/"><img class="logo-image" src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/LOGO.png" alt="" height="35" width="75"/></a>
					 </div>
          <ul class="header-menu">
                 <li><a href="/index.php/Main">HOME</a></li>
                  <li><a href="/index.php/Main">PRODUCT</a></li>
                  <li><a href="/index.php/Comingsoon">PRESS</a></li>
                  <li><a href="/index.php/Faq">SUPPORT</a></li>
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

<div id="page-content">
	<?php the_content(); endwhile; ?>
</div>
<div class="footer">
<div class="container">
<div class="row">
<div class="col-md-2">

<ul class="footer_box">
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
&nbsp;
<h4>中文</h4>
</div>
</ul>
<div class="col-md-offset-1 col-md-3">

<ul class="footer_box">
	<li><img class="logo-footer" src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/LOGO.png" alt="" /></li>
	<li><a href="#">email address</a></li>
<hr />

	<li><a href="#">Copyright Terms &amp; Conditions | Privacy Policy</a></li>
</ul>
</div>
</div>
</div>
</div>

</body>
</html>