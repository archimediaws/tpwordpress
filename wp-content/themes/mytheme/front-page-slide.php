<?php
/**

 * Template Name: Home Whith Slider
 *
 */

get_header();
get_custom_styles();
?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">

	<?php while ( have_posts() ){

		the_post();

        $cat_posts = new WP_Query( array (
            "cat" => get_option("home_category"),
            "order" => "ASC",
            "orderby"=> "date"
        ));
		// dd($cat_posts);
		?>
		<?php // Show the selected frontpage whith slider content.
		if ( $cat_posts->have_posts() ) :
	
			while ( $cat_posts->have_posts() ) : $cat_posts->the_post();
			
							// the_title();
							// the_post_thumbnail( null, "full" );
							// the_permalink();

				get_template_part( 'template-parts/page/content', 'front-page-slide' );

			endwhile;
		else : 
			get_template_part( 'template-parts/post/content', 'none' );
		endif; ?>

	<?php } ?>	
		

	</main><!-- #main -->
</div><!-- #primary -->

<?php get_footer();

