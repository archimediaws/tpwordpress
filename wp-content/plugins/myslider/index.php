<?php 

/*
Plugin Name: Plugin Slider
Description: slider sur pages
Version: 0.0.1
Author: Stephane Escobar
*/




// slider on home page slider

// Add script
add_action("wp_enqueue_scripts", "custom_slide_scripts");

function custom_slide_scripts(){
    wp_enqueue_script("slide_script", plugin_dir_url("./")."/myslider/slider.js", array( "jquery" ));
    wp_enqueue_style( "slide_styles", plugin_dir_url("./")."/myslider/styles.css" );//Add css

    
}
// Actions hook
add_action("init", "create_slide_post_type");

function create_slide_post_type(){

    register_post_type( "slides", [

        "labels" => [

            "name" =>"slides",
            "singular_name" => "slide",
            "all_items " => "Tous les slides",
            "add_new " => "Ajouter un slide"
        ],
        "Slide",
        "description" => "ajouter un slider",
        "show_in_menu" => true,
        "public" => true,
        "menu_icon" => "dashicons-star-half",
        "menu_position" => 22,
        "supports" => [
            "title",
            "editor",
            "revisions",
            "thumbnail"

        ]
    
    ] );
}


add_shortcode( "slides", "display_shortcode" );

function display_shortcode($atts){

$slides = new WP_Query( ["post_type" => "slides" ] );

$slide_html ="<div id='slider'>";

    if ( $slides->have_posts() ){

        while( $slides->have_posts() ){

            $slides->the_post();
            
                $title =get_the_title();
                $content = get_the_content();
                $thumbnail_url =get_the_post_thumbnail_url( null, "full" );
                $slidelink = get_the_permalink();

                // if( get_post_meta( $slides->post->ID, "note")){

                //      $note = get_post_meta($slides->post->ID, "note" )[0];
                // }
                // else{
                //     $note = false;
                // }
            
                $slide_html .= "<div class='simple-slide'>";
                    $slide_html.="<img src='".$thumbnail_url."' />";
                    $slide_html .= "<div class='right-content'>";
                        $slide_html.="<h3>".$title." </>";
                        $slide_html.="<p>".$content." </p>";
                        $slide_html.="<a href='".$slidelink."'> En savoir plus </a>";
                        // if ( $note != false){
                        // $slide_html.="<i> Note: ".$note."/5 </i>";
                        // }
                    $slide_html .= "</div>";
                $slide_html .= "</div>";
        }

    
    }

    $slide_html .="</div>";

    return $slide_html;

}