<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

// BEGIN ENQUEUE PARENT ACTION
// AUTO GENERATED - Do not modify or remove comment markers above or below:

if ( !function_exists( 'chld_thm_cfg_parent_css' ) ):
    function chld_thm_cfg_parent_css() {
        wp_enqueue_style( 'chld_thm_cfg_parent', trailingslashit( get_template_directory_uri() ) . 'style.css', array(  ) );
    }
endif;
add_action( 'wp_enqueue_scripts', 'chld_thm_cfg_parent_css', 10 );

// END ENQUEUE PARENT ACTION

/*************************************************************************************** MY THEME  */
// ICI CUSTOM SUR MON THEME ENFANT

//infos du footer
add_action('action_site_info', 'My_siteInfo');

function My_siteInfo() {

    echo '© 2017 - ' . get_bloginfo ( 'name' ) ;
}

/** steph theme function */
/** dev **/ 
function dd($target){
	echo "<prev>";
	var_dump ($target); 
	echo "</prev>";
	die();
}
//custom home page section sur theme twentyseventeen

function My_front_page_sections() {
    return 3; // nb sections en home page
}
add_filter( 'twentyseventeen_front_page_sections', 'My_front_page_sections' );

function My_body_classes_child( $classes ){
if ( is_active_sidebar( 'sidebar-1' ) &&  is_page() ) {
        $classes[] = 'has-sidebar';
    }
    return $classes;
}
add_filter( 'body_class', 'My_body_classes_child' );


// register sidbar
function My_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Left Sidebar', 'twentyseventeen' ),
		'id'            => 'sidebar-4',
		'description'   => __( 'Add widgets here to appear in your sidebar on pages width left sidebar.', 'twentyseventeen' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Right Sidebar', 'twentyseventeen' ),
		'id'            => 'sidebar-5',
		'description'   => __( 'Add widgets here to appear in your sidebar on pages width right sidebar.', 'twentyseventeen' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

}
add_action( 'widgets_init', 'My_widgets_init' );


// custom admin personnalisation des pages du theme ... color/ category ...


add_action( "admin_menu", "generate_theme_menu" ); 
add_action('admin_menu', 'my_admin_color_page');
add_action('admin_menu', 'my_admin_popups_page');

add_action("admin_init", "add_option_home_category"); 
add_action("admin_init", "add_option_color_customs");
add_action("admin-init","add_option_popups");
add_action("admin_enqueue_scripts", "load_scripts");

// al'init du admin menu ajoute une option dans la bdd wordpress option = home_category
function add_option_home_category(){
	// creer une option dans la bbd pour le choix de la categorie
	add_option( "home_category" );

	
}

// set les valeur de couleurs dans les option de la bdd color_customs
function add_option_color_customs(){
	// creer une option dans la bbd pour le choix des couleur
	add_option("custom_colors", []);
}


function add_option_popups(){
	// creer une option dans la bbd pour le choix des popups
	add_option("my_popups");
}


// au moment ou le menu admin se charge on demande a generer un nouveai item dans le menu
function generate_theme_menu(){
	// ajoute item au menu admin My Theme
	add_menu_page( "My Theme", "My Theme", "administrator", "stephane_theme_menu", "generate_theme_menu_page", "dashicons-welcome-widgets-menus", 101);
	
}


function generate_theme_menu_page(){

	if ( isset ( $_POST["home_category"] ) ){ // si la categorie home est setter dans le form on post home_category

		update_option( "home_category", $_POST["home_category"]);
	}
	$option_val = get_option("home_category"); // recupere l'option 
	$categories = get_categories( ); // recup toutes les categories
	?>

	<h1>Administration de Mon theme</h1>
	<h2>Custom de la Home Page Slider </h2>

	<form method="post">
	
	<label>
		<span> Choix de la categorie des posts à afficher </span>	
		<select name="home_category">
		
		<?php foreach ( $categories as $category){ // boucle sur le tableau des categories ?> 
			
			<option value="<?= $category->cat_ID  ?>"  <?php isSelected($category->cat_ID) ?> >
			<?= $category->name  ?>
			</option>

		<?php } ?>

	</label>

		<input type="submit" value="valider" />

	</form>

	<?php
}

function isSelected( $value){
	if( $value == get_option ("home_category")){
		echo "selected";
	}
}


function load_scripts(){
	wp_enqueue_script("colorjs", get_stylesheet_directory_uri()."/assets/js/jscolor.js");
}

// admin gestion coleurs fond du template home slider

function my_admin_color_page() {
	add_submenu_page(
		'stephane_theme_menu',
		'Admin Color',
		'Admin Color',
		'manage_options',
		'admin-color-page',
		'generate_admin_color_page' );
}


function generate_admin_color_page(){
		

		if ( isset ( $_POST["color_h"] ) && isset ( $_POST["color_c"] ) && isset ( $_POST["color_f"] )){ // si la categorie home est setter dans le form on post home_category

				$colors = [

					"headers" => $_POST["color_h"],
					"body" => $_POST["color_c"],
					"background" => $_POST["color_f"]
				];

					update_option( "custom_colors", $colors);
				}

		
		$colors_val = [
			"headers" => [],
			"body" => "",
			"background" => ""

		];
		if (get_option("custom_colors")){
			$colors_val = get_option("custom_colors");
		}
		
		?>


		<h1>Administration des couleurs page home slider</h1>
		
	
	<form method = "post">
		
	<!-- gestion couleur des titre -->
	<?php for( $i=0; $i <6; $i++){?>

		<label>
		<span>Couleur h<?= $i+1 ?> </span>
		<input class="jscolor" type="text" name="color_h[]" value="<?= $colors_val["headers"][$i] ?> " />
		</label></br>

	<?php } ?>

		<label>
		<span>Couleur corps </span>
		<input class="jscolor" type="text" name="color_c" value="<?= $colors_val["body"] ?>"/>
		</label></br>

		<label>
		<span>Couleur fond </span>
		<input class="jscolor" type="text" name="color_f" value="<?= $colors_val["background"] ?>"/>
		</label></br>

	
			<input type="submit" value="valider" />
	
	</form>

		


		<?php
	}



	function get_custom_styles(){
	
		$custom_colors = get_option( "custom_colors");

		echo "<style>";

		for ( $i=0; $i<6; $i++ ){

			echo "h".($i+1)." {color: #". $custom_colors["headers"][$i]. "}";
		} 

		echo "p { color: #" . $custom_colors["body"] . " }";
		echo "#content { background-color: #" . $custom_colors["background"] . " }";

		echo "</style>";

	
	}



	// admin gestion du choix des popups

function my_admin_popups_page() {
	add_submenu_page(
		'stephane_theme_menu',
		'Admin Popup',
		'Admin Popup',
		'manage_options',
		'admin-popups-page',
		'generate_admin_popups_page' );
}

function generate_admin_popups_page(){
	
		if ( isset ( $_POST["the_popup"] ) ){ // si la categorie home est setter dans le form on post home_category
	
			update_option( "my_popups", $_POST["the_popup"]);
		}
		$option_val = get_option("my_popups"); // recupere l'option 
		$popups = get_post_type_object('popups');
		//  dd($popups);
		?>
	
	<h1>Administration des popups</h1>
	<h2>Custom de la Page ... </h2>
	
		<form method="post">
		
		<label>
		<span> Choix du popup à afficher </span>	
		<select name="the_popup">
		
		<?php foreach ( $popups as $popup){ // boucle sur le popups ?> 
			
			<option value="<?= $popup->name  ?>"  <?php isSelectedpopup($popup->name) ?> >
			<?= $popup->name  ?>
			</option>

		<?php } ?>

		</label>
	
			<input type="submit" value="valider" />
	
		</form>
	
		
		<h1>Liste des popups disponibles </h1>

		<?php
		
		get_template_part( 'template-parts/post/content', 'single-popups' );


		} ?>


<?php
	function isSelectedpopup( $value){
		if( $value == get_option ("my_popups")){
			echo "selected";
		}
	}

	function get_custom_popup(){
		
			$custom_colors = get_option( "custom_colors");
	
			echo "<style>";
	
			for ( $i=0; $i<6; $i++ ){
	
				echo "h".($i+1)." {color: #". $custom_colors["headers"][$i]. "}";
			} 
	
			echo "p { color: #" . $custom_colors["body"] . " }";
			echo "#content { background-color: #" . $custom_colors["background"] . " }";
	
			echo "</style>";
	
		
		}




	// divers

	function remove_footer_admin () {
		echo '<span id="footer-thankyou">Merci avoir fait appel à Stéphane pour votre site';
	}
	add_filter('admin_footer_text', 'remove_footer_admin');
