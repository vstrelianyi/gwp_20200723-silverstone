<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package SilverStoneF1
 */

get_header();
?>

	<div id="primary" class="content-area nca">
		<main id="main" class="site-main news-container">
			<div class="container">
			<div class="breadcrumbs">
				<ul>
					<li>
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>">Главная</a>
						<i class="icon-arrow"></i>
					</li>
					<li>
						<span>Новости</span>
					</li>
				</ul>
			</div>

				<?php if ( have_posts() ) : ?>
					<div class="novosti-header">
						<?php
						post_type_archive_title('<h1 class="page-title">', '</h1>');
						// the_archive_title( '<h1 class="page-title">', '</h1>' );
						the_archive_description( '<div class="archive-description">', '</div>' );
						?>
					</div><!-- .page-header -->
					<div class="news-main">
						<div class="news-sidebar">
							<div class="inner">
								<?php 
									$terms = get_terms( 'news_cat' ); 
									foreach( $terms as $term ) :
								?>
									<a class="category-item" href="<?php echo get_term_link( $term, 'news_cat' ); ?>">
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
						<?php 
							// $paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;
							$args = array( 
								'post_type' => 'news',
								'posts_per_page' => -1,
							);
							$loop = new WP_Query( $args );
							while ( $loop->have_posts() ) : $loop->the_post(); ?>
							<div class="news-item">
								<a class="mc-entry-content service-entry-content" href="<?php the_permalink(); ?>">
									<?php
										if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
											the_post_thumbnail('big-thumb');
										}
									?>
								</a>
								<div>
									<h3><?php the_title(); ?></h3>
									<?php
									the_excerpt();
									?>
									<a href="<?php the_permalink(); ?>" class="button">Подробнее</a>
									<span class="date"><?php the_date(); ?></span>
								</div>
							</div>
							<?php endwhile; wp_reset_query();?>
						</div>
					</div>
					<?php	else :
					get_template_part( 'template-parts/content', 'none' );
				endif;
				?>
			</div>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();

