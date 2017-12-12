<?php
/*Template part of Popups Template
 */
 
 ?>
<div id="primary">
    <div id="content" role="main">
    <?php
    $mypost = array( 'post_type' => 'popups', );
    $loop = new WP_Query( $mypost );
    ?>
    <?php while ( $loop->have_posts() ) : $loop->the_post();?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <header class="entry-header">
 
                <!-- Display featured image in right-aligned floating div -->
                <div style=" margin: 10px; display:flex; align-items: center;" >

                <div>
                    <?php the_post_thumbnail( array( 200, 200 ) ); ?>
                </div>
                <div style="margin-left: 10px;">
                <!-- Display Title and Popup Name -->
                <strong>Titre: </strong><?php the_title(); ?><br />
                <strong>Nom du Popup: </strong>
                
                <?php echo esc_html( get_post_meta( get_the_ID(), 'popup_name', true ) ); ?>
                </div>
                </div>
                <br />

              
            </header>
 
            <!-- Display popup contents -->
            <div class="entry-content"><?php the_content(); ?></div>
        </article>
 
    <?php endwhile; ?>
    </div>
</div>
<?php wp_reset_query(); ?>
