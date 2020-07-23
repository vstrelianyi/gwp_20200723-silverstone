<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package SilverStoneF1
 */

?>
<?php
	// Returns Array of Term Names for "my_taxonomy".
	$term_list = wp_get_post_terms( $post->ID, 'news_cat', array( 'fields' => 'names' ) );
	$current_pt_cat = reset($term_list);
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<h1>Новости</h1>
	<div class="news-main">
		<div class="news-sidebar">
			<div class="inner">
				<?php 
					$terms = get_terms( 'news_cat' ); 
					foreach( $terms as $term ) :
				?>
					<a class="category-item <?php if($term->name == $current_pt_cat) {echo "current";} ?>" href="<?php echo get_term_link( $term, 'news_cat' ); ?>">
						<img src="<?php the_field('ncat_img', $term); ?>" />
						<div class="link-aside">
							<span><?php echo $term->name; ?></span>
							<span>Подробнее</span>
						</div>
					</a>
				<?php endforeach; ?>
			</div>
		</div>
		<div class="news-content">
			<div class="featured-img-container">
				<?php
					if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
						the_post_thumbnail( 'full' );
					}
				?>
			</div>
			<header class="entry-header">
				<div class="date"><?php the_date(); ?></div>
				<?php
				the_title('<h3 class="entry-title">', '</h3>');
				if ( 'post' === get_post_type() ) :
					?>
					<div class="entry-meta">
						<?php
						ssf_posted_on();
						ssf_posted_by();
						?>
					</div><!-- .entry-meta -->
				<?php endif; ?>
			</header>
			<div class="entry-content">
				<?php
				the_content( sprintf(
					wp_kses(
						/* translators: %s: Name of current post. Only visible to screen readers */
						__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'ssf' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					get_the_title()
				) );

				wp_link_pages( array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'ssf' ),
					'after'  => '</div>',
				) );
				?>
			</div><!-- .entry-content -->
			<footer class="entry-footer">
				<?php ssf_entry_footer(); ?>
			</footer><!-- .entry-footer -->
		</div>

</article><!-- #post-<?php the_ID(); ?> -->
