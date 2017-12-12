<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>

<div class="wrap">

	<?php if ( have_posts() ) : ?>
		<header class="page-header">
			<?php
				the_archive_title( '<h1 class="page-title">', '</h1>' );
				the_archive_description( '<div class="taxonomy-description">', '</div>' );
			?>
		</header><!-- .page-header -->
	<?php endif; ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main flexcat" role="main">



		<?php


		// variable $wp_the_query  / global utilisant le WP_Query qui génére la page archive
		$count = $GLOBALS['wp_query']->post_count;
		// dd($count);
		 ?>
		<?php $i = 0; ?>

		<?php

		

		if ( have_posts() && $count >= 3  ) : ?>

					
			<?php
			/* Start the Loop */
			while ( have_posts() ) : the_post(); ?>

			
			<?php
			/* compteur  */
			if($i == 0) {
				echo '<div class="clear-row">';
			}
			?>

			<div class="my-row">
				

				<?php  get_template_part( 'template-parts/post/contentcat', get_post_format() ); ?>
				

			</div>


			<?php
			 $i++;
			if( $count == 3 && $i == 1 ) {
				$i = 0;
				echo '</div>';
			}
			elseif( $count >= 4 && $i == 2){
				$i = 0;
				echo '</div>';
			}

			elseif( $count >= 6 && $i == 3){
				$i = 0;
				echo '</div>';
			}
			?>
			
			<?php endwhile; ?>

			<?php
			if($count > 0) {
			 echo '</div>';
			}
			?>


			<?php the_posts_pagination( array(
				'prev_text' => twentyseventeen_get_svg( array( 'icon' => 'arrow-left' ) ) . '<span class="screen-reader-text">' . __( 'Previous page', 'twentyseventeen' ) . '</span>',
				'next_text' => '<span class="screen-reader-text">' . __( 'Next page', 'twentyseventeen' ) . '</span>' . twentyseventeen_get_svg( array( 'icon' => 'arrow-right' ) ),
				'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'twentyseventeen' ) . ' </span>',
			) );

		
		else :

			if ( have_posts() ) :
				/* Start the Loop */
				while ( have_posts() ) : the_post();
				
					get_template_part( 'template-parts/post/content', get_post_format() );
				
				endwhile;

				the_posts_pagination( array(
					'prev_text' => twentyseventeen_get_svg( array( 'icon' => 'arrow-left' ) ) . '<span class="screen-reader-text">' . __( 'Previous page', 'twentyseventeen' ) . '</span>',
					'next_text' => '<span class="screen-reader-text">' . __( 'Next page', 'twentyseventeen' ) . '</span>' . twentyseventeen_get_svg( array( 'icon' => 'arrow-right' ) ),
					'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'twentyseventeen' ) . ' </span>',
				) );

				

			else:
			

			get_template_part( 'template-parts/post/content', 'none' );

			endif;
				
		endif ?>

		</main><!-- #main -->
	</div><!-- #primary -->
	
</div><!-- .wrap -->

<?php get_footer(); 
