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
	<?php 
		$terms = get_terms( $taxonomy );
		$curTerm =  $wp_query->queried_object;
	
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
						<a href="<?php echo esc_url( home_url( '/novosti' ) ); ?>">Новости</a>
						<i class="icon-arrow"></i>
					</li>
					<li>
						<span><?php echo $curTerm->name; ?></span>
					</li>
				</ul>
			</div>
			<div class="novosti-header">
				<h1><?php echo $curTerm->name; ?></h1>
			</div><!-- .page-header -->
			<div class="news-main">
				<div class="news-sidebar">
					<div class="inner">
						<?php 
							foreach( $terms as $term ) :
								if ($term->name == $curTerm->name){
									$active = 'current';
								}
								else $active= '';
							?>
							<a class="category-item <?php echo $active;?>" href="<?php echo get_term_link( $term, $taxonomy ); ?>">
								<img src="<?php the_field('ncat_img', $term); ?>" />
								<span><?php echo $term->name; ?></span>
							</a>
						<?php endforeach; ?>
					</div>
				</div>
				<div class="news-content">
					<?php while( have_posts() ) : the_post(); ?>
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
					<?php endwhile; ?>
				</div>
			</div>


			</div>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
?>