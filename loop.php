<?php
/**
 * The loop that displays posts.
 *
 * The loop displays the posts and the post content.  See
 * http://codex.wordpress.org/The_Loop to understand it and
 * http://codex.wordpress.org/Template_Tags to understand
 * the tags used in it.
 *
 * This can be overridden in child themes with loop.php or
 * loop-template.php, where 'template' is the loop context
 * requested by a template. For example, loop-index.php would
 * be used if it exists and we ask for the loop with:
 * <code>get_template_part( 'loop', 'index' );</code>
 *
 * @package WordPress
 * @subpackage Boilerplate
 * @since Boilerplate 1.0
 */
?>

<?php /* If there are no posts to display, such as an empty archive page */ ?>
<?php if ( ! have_posts() ) : ?>
	<article id="post-0" class="post error404 not-found">
		<h1 class="entry-title">Ei löytynyt</h1>
		<div class="entry-content">
			<p>Sivua ei löytynyt hakemillasi ehdoilla (virhe 404)</p>
			<?php get_search_form(); ?>
		</div><!-- .entry-content -->
	</article><!-- #post-0 -->
<?php endif; ?>

<?php
	/* Start the Loop.
	 *
	 * In Twenty Ten we use the same loop in multiple contexts.
	 * It is broken into three main parts: when we're displaying
	 * posts that are in the gallery category, when we're displaying
	 * posts in the asides category, and finally all other posts.
	 *
	 * Additionally, we sometimes check for whether we are on an
	 * archive page, a search page, etc., allowing for small differences
	 * in the loop on each template without actually duplicating
	 * the rest of the loop that is shared.
	 *
	 * Without further ado, the loop:
	 */
	 
	 $first = 1;
	 ?>
<?php while ( have_posts() ) : the_post(); ?>

<?php /* How to display posts in the Gallery category. */ ?>

	<?php if ( in_category( _x('gallery', 'gallery category slug', 'boilerplate') ) ) : ?>
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'boilerplate' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>

			<div class="entry-meta">
				<?php boilerplate_posted_on(); ?>
			</div><!-- .entry-meta -->

			<div class="entry-content">
<?php if ( post_password_required() ) : ?>
				<?php the_content(); ?>
<?php else : ?>			
				<?php 
					$images = get_children( array( 'post_parent' => $post->ID, 'post_type' => 'attachment', 'post_mime_type' => 'image', 'orderby' => 'menu_order', 'order' => 'ASC', 'numberposts' => 999 ) );
					if ( $images ) :
						$total_images = count( $images );
						$image = array_shift( $images );
						$image_img_tag = wp_get_attachment_image( $image->ID, 'thumbnail' );
				?>
						<div class="gallery-thumb">
							<a class="size-thumbnail" href="<?php the_permalink(); ?>"><?php echo $image_img_tag; ?></a>
						</div><!-- .gallery-thumb -->
						<p><em><?php printf( __( 'This gallery contains <a %1$s>%2$s photos</a>.', 'boilerplate' ),
								'href="' . get_permalink() . '" title="' . sprintf( esc_attr__( 'Permalink to %s', 'boilerplate' ), the_title_attribute( 'echo=0' ) ) . '" rel="bookmark"',
								$total_images
							); ?></em></p>
				<?php endif; ?>
						<?php the_excerpt(); ?>
<?php endif; ?>
			</div><!-- .entry-content -->

			<footer class="entry-utility">
				<a href="<?php echo get_term_link( _x('gallery', 'gallery category slug', 'boilerplate'), 'category' ); ?>" title="<?php esc_attr_e( 'View posts in the Gallery category', 'boilerplate' ); ?>"><?php _e( 'More Galleries', 'boilerplate' ); ?></a>
				|
				<?php comments_popup_link( __( 'Kommentoi', 'boilerplate' ), __( '1 kommentti', 'boilerplate' ), __( '% kommenttia', 'boilerplate' ) ); ?>
				<?php Muokkaa_post_link( __( 'Muokkaa', 'boilerplate' ), '|', '' ); ?>
			</footer><!-- .entry-utility -->
		</article><!-- #post-## -->

<?php /* How to display posts in the asides category */ ?>

	<?php elseif ( in_category( _x('asides', 'asides category slug', 'boilerplate') ) ) : ?>
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

		<?php if ( is_archive() || is_search() ) : // Display excerpts for archives and search. ?>
			<div class="entry-summary">
				<?php the_excerpt(); ?>
			</div><!-- .entry-summary -->
		<?php else : ?>
			<div class="entry-content">
				<?php the_content( __( 'Jatka lukemista <span class="meta-nav">&rarr;</span>', 'boilerplate' ) ); ?>
			</div><!-- .entry-content -->
		<?php endif; ?>

			<footer class="entry-utility">
				<?php boilerplate_posted_on(); ?>
				|
				<?php comments_popup_link( __( 'Kommentoi', 'boilerplate' ), __( '1 kommentti', 'boilerplate' ), __( '% kommenttia', 'boilerplate' ) ); ?>
				<?php Muokkaa_post_link( __( 'Muokkaa', 'boilerplate' ), '| ', '' ); ?>
			</footer><!-- .entry-utility -->
		</article><!-- #post-## -->

<?php /* How to display all other posts. */ ?>

	<?php else : ?>
		<article id="post-<?php the_ID(); ?>" <?php if($first) { echo ' class="first"'; } ?>>
			<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'boilerplate' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>

			<div class="entry-meta">
				<?php the_date(); ?>
				<?php	the_author_meta('first_name'); ?>
			</div><!-- .entry-meta -->

	<?php if ( is_archive() || is_search() ) : // Only display excerpts for archives and search. ?>
			<div class="entry-summary">
				<?php the_excerpt(); ?>
			</div><!-- .entry-summary -->
	<?php else : ?>
			<div class="entry-content">
				<?php the_content( __( 'Jatka lukemista <span class="meta-nav">&rarr;</span>', 'boilerplate' ) ); ?>
				<p>
					<script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
					<a href="https://twitter.com/share" class="twitter-share-button" data-count="none" data-via="Saraste2012">Tweet</a>
					<iframe src="http://www.facebook.com/plugins/like.php?href=<?php echo urlencode(get_permalink());?>&send=false&layout=button_count&width=110&show_faces=false&action=like&colorscheme=light&font&height=21" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:110px; height:21px; margin-bottom: -1px;" allowTransparency="true"></iframe>
				</p>
			</div><!-- .entry-content -->
	<?php endif; ?>

        <?php if (false) : ?>
			<footer class="entry-utility">
				<?php if ( count( get_the_category() ) ) : ?>
					<?php printf( __( 'Posted in %2$s', 'boilerplate' ), 'entry-utility-prep entry-utility-prep-cat-links', get_the_category_list( ', ' ) ); ?>
					|
				<?php endif; ?>
				<?php
					$tags_list = get_the_tag_list( '', ', ' );
					if ( $tags_list ):
				?>
					<?php printf( __( 'Tagged %2$s', 'boilerplate' ), 'entry-utility-prep entry-utility-prep-tag-links', $tags_list ); ?>
					|
				<?php endif; ?>
				<?php comments_popup_link( __( 'Kommentoi', 'boilerplate' ), __( '1 kommentti', 'boilerplate' ), __( '% kommenttia', 'boilerplate' ) ); ?>
				<?php Muokkaa_post_link( __( 'Muokkaa', 'boilerplate' ), '| ', '' ); ?>
			</footer><!-- .entry-utility -->
        <?php endif; ?>
		</article><!-- #post-## -->

		<?php comments_template( '', true ); ?>

	<?php endif; // This was the if statement that broke the loop into three parts based on categories. ?>
<?php $first = 0; ?>
<?php endwhile; // End the loop. Whew. ?>

<?php /* Display navigation to next/previous pages when applicable */ ?>
<?php if (  $wp_query->max_num_pages > 1 ) : ?>
	<nav id="nav-below" class="navigation">
		<?php next_posts_link( __( '&larr; Vanhemmat artikkelit', 'boilerplate' ) ); ?>
		<?php previous_posts_link( __( 'Uudemmat artikkelit &rarr;', 'boilerplate' ) ); ?>
	</nav><!-- #nav-below -->
<?php endif; ?>