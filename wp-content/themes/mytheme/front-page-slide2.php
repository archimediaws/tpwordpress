<?php
/**

 * Template Name: Home Whith Slider2
 *
 */

get_header();
get_custom_styles();
?>


	<div id="primary" class="content-area">
		<main id="main" class="site-main flexcat" role="main">



		<?php 

    while ( have_posts() ){

        the_post();

        $title = get_the_title( );
        $content = get_the_content();

        $tech_posts = new WP_Query( array (
            "cat" => get_option("home_category"),
            "order" => "ASC",
            "orderby"=> "date"
        ));

    ?>
    
        <div class="post-displayer ">
            <?php while($tech_posts->have_posts()){ 
                
                $tech_posts->the_post();

                $post_title =get_the_title();
                $post_thumb =get_the_post_thumbnail( null, "full" );
                $link = get_the_permalink();
            ?>
            
                <a href="<?= $link ?>">
                <div class="post-item">
                    <h5><?= $post_title ?></h5>
                    <div><?= $post_thumb ?></div>
                </div>

            <?php } ?>
        </div>

    </div>

<?php } ?> 
		</main><!-- #main -->
	</div><!-- #primary -->
	


<?php get_footer();
