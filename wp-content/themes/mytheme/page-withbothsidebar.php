<?php
/**

 * Template Name: Left & Right Sidebar
 *
 */

get_header(); ?>

<div class="wrap">



	<div id="primary" class="content-area">

		<main id="main" class="site-main flex" role="main">

		<div class="left-sidebar">
		<?php dynamic_sidebar("sidebar-4"); ?>
		</div>
		

			<div class="article-page">
			<?php
			while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/page/content', 'page' );

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;

			endwhile; // End of the loop.
			?>
			</div> <!-- article-pag -->


			<div class="left-sidebar">
			<?php dynamic_sidebar("sidebar-5"); ?>
			</div>

		</main><!-- #main -->
	</div><!-- #primary -->
	
</div><!-- .wrap -->

<?php get_footer();
