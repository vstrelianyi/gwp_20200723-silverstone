<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package SilverStoneF1
 */

get_header();
?>
	<div id="primary" class="content-area">
		<main id="main" class="site-main news-container">
		<div class="container">
			<div class="breadcrumbs">
				<ul>
					<li>
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>">Главная</a>
						<i class="icon-arrow"></i>
					</li>
					<li>
						<a href="<?php echo esc_url( home_url( '/novosti' ) ); ?>">Новости</a>
						<i class="icon-arrow"></i>
					</li>
					<li>
						<span><?php the_title(); ?></span>
					</li>
				</ul>
			</div>
		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', get_post_type() );

			// the_post_navigation();
			the_post_navigation( array(
				'prev_text'                  => __( '%title' ),
				'next_text'                  => __( '%title' ),
				'in_same_term'               => true,
				'taxonomy'                   => __( 'news_cat' ),
				// 'screen_reader_text' => __( 'Continue Reading' ),
			) );

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>
		</div>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
