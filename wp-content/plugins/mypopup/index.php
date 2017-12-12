<?php 

/*
Plugin Name: Plugin Popup
Description: popup sur pages
Version: 0.0.1
Author: Stephane Escobar
*/




// slider on home page slider

// Add script
add_action("wp_enqueue_scripts", "custom_popup_scripts");

function custom_popup_scripts(){
    wp_enqueue_script("popup_script", plugin_dir_url("./")."/mypopup/popup.js", array( "jquery" ));
    wp_enqueue_style( "popup_styles", plugin_dir_url("./")."/mypopup/styles.css" );//Add css

    
}
// Actions hook
add_action("init", "create_popup_post_type");

function create_popup_post_type(){

    register_post_type( "popups", [

        "labels" => [

            "name" =>"popups",
            "singular_name" => "popup",
            "all_items " => "Tous les popups",
            "add_new " => "Ajouter un popup"
        ],
        "Popup",
        "description" => "ajouter un popup",
        "show_in_menu" => true,
        "public" => true,
        "menu_icon" => "dashicons-star-half",
        "menu_position" => 23,
        "supports" => [
            "title",
            "editor",
            "revisions",
            "thumbnail"
            

        ]
        // "taxonomies" => [
        //     "category",
        //     "post_tag"

        // ]
    
    ] );
}


add_shortcode( "popups", "display_popup_shortcode" );

function display_popup_shortcode($atts){

$popups = new WP_Query( ["post_type" => "popups" ] );

$popup_html ="<div id='slider'>";

    if ( $popups->have_posts() ){

        while( $popups->have_posts() ){

            $popups->the_post();
            
                $title =get_the_title();
                $content = get_the_content();
                $thumbnail_url =get_the_post_thumbnail_url( null, "full" );
                

                // if( get_post_meta( $slides->post->ID, "note")){

                //      $note = get_post_meta($slides->post->ID, "note" )[0];
                // }
                // else{
                //     $note = false;
                // }
            
                $popup_html .= "<div class='simple-popup'>";
                    $popup_html.="<img src='".$thumbnail_url."' />";
                    $popup_html .= "<div class='right-content'>";
                        $popup_html.="<h3>".$title." </>";
                        $popup_html.="<p>".$content." </p>";
                        // $popup_html.="<a href='".$popuplink."'> En savoir plus </a>";
                        // if ( $note != false){
                        // $popup_html.="<i> Note: ".$note."/5 </i>";
                        // }
                    $popup_html .= "</div>";
                $popup_html .= "</div>";
        }

    
    }

    $popup_html .="</div>";

    return $popup_html;

}

add_action( 'admin_init', 'my_admin_popup' );

function my_admin_popup() {
    add_meta_box( 'popup_meta_box',
        'Popup Details',
        'display_popup_meta_box',
        'popups', 'normal', 'high'
    );
}

function display_popup_meta_box( $popup_details ) {
    
    $popup_name = esc_html( get_post_meta( $popup_details->ID, 'popup_name', true ) );
    
    ?>
    <table>
        <tr>
            <td style="width: 100%">Nom du Popup</td>
            <td><input type="text" size="80" name="the_popup_name" value="<?php echo $popup_name; ?>" /></td>
        </tr>
    </table>
    <?php
}

add_action( 'save_post', 'add_popup_fields', 10, 2 );

function add_popup_fields( $popup_details_id, $popup_details ) {
    // Check post type for popups
    if ( $popup_details->post_type == 'popups' ) {
        // Store data in post meta table if present in post data
        if ( isset( $_POST['the_popup_name'] ) && $_POST['the_popup_name'] != '' ) {
            update_post_meta( $popup_details_id, 'popup_name', $_POST['the_popup_name'] );
        }
        
    }
}

add_filter( 'template_include', 'include_template_function', 1 );

function include_template_function( $template_path ) {
    if ( get_post_type() == 'popups' ) {
        if ( is_single() ) {
            // checks if the file exists in the theme first,
            // otherwise serve the file from the plugin
            if ( $theme_file = locate_template( array ( 'single-popups.php' ) ) ) {
                $template_path = $theme_file;
            } else {
                $template_path = plugin_dir_path(__FILE__). '/single-popups.php';
            }
        }
    }
    return $template_path;
}
