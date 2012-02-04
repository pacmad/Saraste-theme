<?php
/*
Template Name: Etusivu
*/

get_header();

?>

<article id="featured">
	<div>
	<?php while ( have_posts() ) : the_post(); ?>
		<?php the_content(); ?>
	<?php endwhile; ?>
	<div style="clear: both;"></div>
	</div>
</article>

<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/jquery.countdown.pack.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/js/saraste-counter.js"></script>
<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory'); ?>/css/featured.css">
<!--[if lt IE 8]><style type="text/css">#countdown { display: none; }</style><![endif]-->

<div id="featured-wrapper">
	<div><a href="#"><span>Katso kuvat!</span></a></div>
	<div><a href="#"><span>Perustiedot leiristä</span></a></div>
	<div><a href="#"><span>Saraste-kätköjen etsintä on alkanut!</span></a></div>
	<br class="clear">
</div>

<article>
	<h2>Nyt ajankohtaista</h2>
	<?php $count = 1; ?>
	<?php	$posts = get_posts(); ?>
	<?php	foreach($posts as $post) : setup_postdata($post); ?>
		<div class="post-excerpt <?php if($count%2 == 0) echo 'second'; ?>">
			<?php the_post_thumbnail(); ?>
			<h3><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h3>
			<?php the_excerpt(); ?>
		</div>
		<?php if($count == 3){ ?>
			<div id="fb" style="float: left; width: 260px; margin-top: 20px;">
				<div id="fb-root"></div>
					<script>
						(function(d, s, id) {
							var js, fjs = d.getElementsByTagName(s)[0];
							if (d.getElementById(id)) {return;}
							js = d.createElement(s); js.id = id;
							js.src = "//connect.facebook.net/fi_FI/all.js#xfbml=1";
							fjs.parentNode.insertBefore(js, fjs);
						}(document, 'script', 'facebook-jssdk'));
					</script>
				<div class="fb-like-box" data-href="http://www.facebook.com/pages/Saraste-2012/247896551907822" data-width="260" data-show-faces="false" data-stream="true" data-header="false"></div>
			</div>
		<?php } ?>
		<?php $count++; ?>
	<?php endforeach; ?>
	<br class="clear">
</article>
<?php	get_footer(); ?>