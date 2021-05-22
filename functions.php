<?php
/**
 * Venet functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Venet
 */

if ( ! function_exists( 'venet_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function venet_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Venet, use a find and replace
		 * to change 'venet' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'venet', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
				'primary' => esc_html__( 'Primary', 'venet' ),
			) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
			) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'venet_custom_background_args', array(
					'default-color' => 'ffffff',
					'default-image' => '',
				) ) );

		add_theme_support( 'woocommerce' );
	}
add_action( 'after_setup_theme', 'venet_setup' );
endif;

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function venet_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'venet_content_width', 640 );
}
add_action( 'after_setup_theme', 'venet_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function venet_widgets_init() {
	register_sidebar( array(
			'name'          => esc_html__( 'Sidebar', 'venet' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'venet' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		) );
}
add_action( 'widgets_init', 'venet_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function venet_scripts() {
	wp_enqueue_style( 'venet-style', get_stylesheet_uri() );

	wp_enqueue_script( 'venet-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'venet-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	$get_template_directory_uri = get_template_directory_uri();
	$version = '1.0';

	wp_enqueue_style( 'fa', '//maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css', array(), $version );
	wp_enqueue_style( 'main', $get_template_directory_uri . '/HTMLResources/css/main.css', array(), $version );
	wp_enqueue_style( 'venet-bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css', array(), $version );
	wp_enqueue_script( 'venet-bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js', array( 'jquery' ), $version, true );
	wp_enqueue_script( 'framework', $get_template_directory_uri . '/HTMLResources/js/framework.min.js', array( 'jquery' ), $version, true );
	wp_enqueue_script( 'lib', $get_template_directory_uri . '/HTMLResources/js/lib.min.js', array( 'jquery' ), $version, true );
	wp_enqueue_script( 'util', $get_template_directory_uri . '/HTMLResources/js/util.min.js', array( 'jquery' ), $version, true );
	wp_enqueue_script( 'custom', $get_template_directory_uri . '/js/custom.js', array( 'jquery' ), $version, true );

	$nonce = wp_create_nonce( 'add_to_cart' );

	// Localize the script with new data.
	global $woocommerce;
	$object_array = array(
		'nonce'  	   => $nonce,
		'admin_url'    => esc_url( admin_url( 'admin-ajax.php' ) ),
		'cart_url'     => esc_url( site_url().'/cart' ),
		'checkout_url' => esc_url( site_url().'/checkout' ),	
	);
	wp_localize_script( 'custom', 'add_to_cart_ticket', $object_array );

}
add_action( 'wp_enqueue_scripts', 'venet_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * ACF options
 */
if ( function_exists( 'acf_add_options_page' ) ) {
	acf_add_options_page();
}

/**
 * Unset/remove the non required default image sizes
 *
 * @param array $sizes the array of default sizes.
 *
 * @return array $sizes the modified array.
 */
function venet_remove_default_image_sizes( $sizes ) {
	unset( $sizes['thumb'] );
	unset( $sizes['medium'] );
	unset( $sizes['large'] );

	return $sizes;
}
add_filter( 'intermediate_image_sizes_advanced', 'venet_remove_default_image_sizes' );

/**
 * Unset/remove the non required additional image sizes
 *
 * @param void
 *
 * @return void
 */
function venet_remove_additional_image_sizes() {
	remove_image_size( 'shop_thumbnail' );
	remove_image_size( 'shop_catalog' );
	remove_image_size( 'shop_single' );

	$prog_labels = array(
		'name'               => _x( 'Programmes', 'post type general name', 'venet' ),
		'singular_name'      => _x( 'Programme', 'post type singular name', 'venet' ),
		'menu_name'          => _x( 'Programmes', 'admin menu', 'venet' ),
		'name_admin_bar'     => _x( 'Programme', 'add new on admin bar', 'venet' ),
		'add_new'            => _x( 'Add New', 'programme', 'venet' ),
		'add_new_item'       => __( 'Add New Programme', 'venet' ),
		'new_item'           => __( 'New Programme', 'venet' ),
		'edit_item'          => __( 'Edit Programme', 'venet' ),
		'view_item'          => __( 'View Programme', 'venet' ),
		'all_items'          => __( 'All Programmes', 'venet' ),
		'search_items'       => __( 'Search Programmes', 'venet' ),
		'parent_item_colon'  => __( 'Parent Programmes:', 'venet' ),
		'not_found'          => __( 'No programmes found.', 'venet' ),
		'not_found_in_trash' => __( 'No programmes found in Trash.', 'venet' ),
	);

	$prog_args = array(
		'labels'             => $prog_labels,
		'description'        => __( 'Description.', 'venet' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'programme' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor' ),
	);

	register_post_type( 'programme', $prog_args );

	$labels = array(
		'name'               => _x( 'External Programmes', 'post type general name', 'venet' ),
		'singular_name'      => _x( 'External Programme', 'post type singular name', 'venet' ),
		'menu_name'          => _x( 'External Programmes', 'admin menu', 'venet' ),
		'name_admin_bar'     => _x( 'External Programme', 'add new on admin bar', 'venet' ),
		'add_new'            => _x( 'Add New', 'External programme', 'venet' ),
		'add_new_item'       => __( 'Add New External Programme', 'venet' ),
		'new_item'           => __( 'New External Programme', 'venet' ),
		'edit_item'          => __( 'Edit External Programme', 'venet' ),
		'view_item'          => __( 'View External Programme', 'venet' ),
		'all_items'          => __( 'All External Programmes', 'venet' ),
		'search_items'       => __( 'Search External Programmes', 'venet' ),
		'parent_item_colon'  => __( 'Parent External Programmes:', 'venet' ),
		'not_found'          => __( 'No external programmes found.', 'venet' ),
		'not_found_in_trash' => __( 'No external programmes found in Trash.', 'venet' ),
	);

	$args = array(
		'labels'             => $labels,
		'description'        => __( 'Description.', 'venet' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'external-programme' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor' ),
	);

	register_post_type( 'external-programme', $args );
}
add_action( 'init', 'venet_remove_additional_image_sizes' );


/**
 * Adding custom class to body depending on requirement
 *
 * @param {array} $classes default classes.
 *
 * @return {array}$classes the modified classes.
 */
function venet_custom_body_classes( $classes ) {
	if ( is_page_template( 'templates/template-home-page.php' ) ) {
		$classes[] = 'home';
	}

	if ( is_page_template( 'templates/template-contact-us.php' ) ) {
		$classes[] = 'contact';
	}

	return $classes;
}
add_filter( 'body_class', 'venet_custom_body_classes' );

/**
 * Adding Google Analytics
 *
 */
function venet_add_google_analytics() {
	// Based on cookie accept/decline analytics code will be enqued.
	if ( function_exists('cn_cookies_accepted') && cn_cookies_accepted() ) {
	    echo "<script>
		  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

		  ga('create', 'UA-80644064-1', 'auto');
		  ga('send', 'pageview');

		</script>";
	}
}
add_action( 'wp_footer', 'venet_add_google_analytics' );

/**
 * Loading more post using AJAX on Template Press.
 *
 * @param void
 *
 * @return {json}$response - the response to be sent.
 */
function venet_load_news_posts() {
	$paged = $_POST['paged'];
	$posts = $_POST['posts'];

	$latest_post_args = array(
		'post_type'      => 'post',
		'posts_per_page' => 6,
		'paged'          => $paged,
		'orderby'        => 'date',
		'order'          => 'DESC',
	);

	$latest_post = new WP_Query( $latest_post_args );
	ob_start();

	while ( $latest_post->have_posts() ) : $latest_post->the_post(); ?>
		<div class="col-xs-12 col-sm-4">
			<a href="<?php the_permalink() ?>" class="item">
				<?php if ( has_post_thumbnail ( ) ) : ?>
					<figure>
						<img src="<?php the_post_thumbnail_url() ?>" />
					</figure>
				<?php endif; ?>

				<div class="date">
					<?php echo get_the_date( 'F dS Y' ); ?>
				</div>
				<div class="title">
					<?php the_title(); ?>
				</div>
				<p><?php echo wp_trim_words( get_the_content(), 10 ); ?></p>
			</a>
		</div>
	<?php endwhile;
	wp_reset_postdata();

	$newer_posts = ob_get_contents();
	ob_end_clean();

	$show_more = false;

	if ( $latest_post->found_posts > $posts + 6 ) {
		$show_more = true;
	}

	$response = array(
		'html' => $newer_posts,
		'show_more' => $show_more,
		'posts' => $posts + 6,
		'paged' => $paged + 1,
	);

	echo json_encode( $response );
	die;
}

add_action( 'wp_ajax_load_news_post', 'venet_load_news_posts' );
add_action( 'wp_ajax_nopriv_load_news_pos', 'venet_load_news_posts' );

/**
 * Displaying a new column for displaying Templates in Pages
 *
 * @param {array} $columns default columns
 *
 * @return {array}$columns the modified columns
 */
function venet_template_column( $columns ) {
	return array_merge( $columns,
	array(
		'templates' => __( 'Templates', 'venet' )
		)
	);
}
add_filter( 'manage_pages_columns' , 'venet_template_column' );

/**
 * Displaying the Templates Name in Added Column in Pages
 *
 * @param {string} $column_name - all custom column added.
 * @param {int}   $post_id     - post id of each pages
 *
 * @return {string} - the value to be displayed.
 */
function venet_template_custom_column( $column_name, $post_id ) {
	if ( 'templates' === $column_name ) {
		if ( $template = get_post_meta( $post_id, '_wp_page_template', true ) ) {
			echo $template;
		} else {
			echo esc_html_e( 'default', 'venet' );
		}
	}
}
add_action( 'manage_pages_custom_column', 'venet_template_custom_column', 10, 2 );

/**
 * Adding custom submenu page using ACF Pro plugin for all FAQ and standfirst text.
 *
 * @param void
 *
 * @return void
 */
function venet_option_for_event_pages() {

	if ( function_exists( 'acf_add_options_sub_page' ) ) {
		acf_add_options_sub_page( 'Events Setting' );
		acf_add_options_sub_page( 'Theme Setting' );
	}
}
add_action( 'admin_menu', 'venet_option_for_event_pages', 9 );

/**
 * Override the default zoom level of google map in event calender plugin
 *
 * @return {int} the zoom level for event location map
 */
function venet_event_map_zoom() {
	return 13;
}
add_filter( 'tribe_events_single_map_zoom_level', 'venet_event_map_zoom' );


/**
 * Add to cart inplementation of ticket
 * Ajax callback function
 * Fetch ajax response and verify the product type
 * Adds ticket to cart
 *
 * @return void
 */
function venet_ajax_add_to_cart() {

	$i = 0;
	global $woocommerce;

	// Verify if nonce matches.
	if ( wp_verify_nonce( sanitize_text_field( wp_unslash( isset( $_POST['nonce'] ) ? $_POST['nonce'] : '' ) ), 'add_to_cart' ) ) {

		// Sanitizing the $_POST data
		$tickets = $_POST['tickets'];

		if ( ! empty( $tickets ) ) {

			foreach ( $tickets as $ticket_id => $quantity ) {
				$woocommerce->cart->add_to_cart( $ticket_id, $quantity );
			}

			$message = 'Ticket Added Successfully to Cart';
			$notice_type = 'success';

		} else {
			$message = 'Sorry , No tickets choosen';
			$notice_type = 'error';
		}

		$result['type'] = $notice_type;
		$result['message'] = $message;

		echo json_encode( $result );
		wp_die();
	}
}

add_action( 'wp_ajax_add_to_cart', 'venet_ajax_add_to_cart' );
add_action( 'wp_ajax_nopriv_add_to_cart', 'venet_ajax_add_to_cart' );

/**
 * Function to return Export events button text in french and in english.
 *
 * @return {string} - the value to be displayed.
 */
function venet_custom_ical_btn_text() {
	if ( 'fr' == qtranxf_getLanguage() ) {
		return 'Exporter &eacute;v&eacute;nements';
	} else {
		return 'Export events';
	}
}
add_filter( 'tribe_events_ical_export_text', 'venet_custom_ical_btn_text' );

/**
 * Function to return events page link on cart if cart is empty.
 *
 * @return {string} - the value to be displayed.
 */
function venet_change_return_shop_url() {
	return site_url( '/visit/' );
}
add_filter( 'woocommerce_return_to_shop_redirect', 'venet_change_return_shop_url' );
add_filter( 'woocommerce_continue_shopping_redirect', 'venet_change_return_shop_url', 20 );

/*
 * EXAMPLE OF CHANGING ANY TEXT (STRING) IN THE EVENTS CALENDAR
 * See the codex to learn more about WP text domains:
 * http://codex.wordpress.org/Translating_WordPress#Localization_Technology
 * Example Tribe domains: 'tribe-events-calendar', 'tribe-events-calendar-pro'...
 */
function venet_language_based_text_changes( $translation, $text, $domain ) {
	if ( 'fr' == qtranxf_getLanguage() ) {
		$custom_text = array(
			"Children" => "Gratuit&eacute;",
			"children" => "gratuit&eacute;",
			"Student" => "&Eacute;tudiant",
			"student" => "&eacute;tudiant",
			"Students" => "&Eacute;tudiants",
			"Adult" => "Adulte",
			"Find %s" => "Trouver des %s",
			"%s for %S" => "%s en %s",
			"Month" => "Mois",
			"List" => "liste",
			"Day" => "Jour",
			"View As" => "Trier par",
			"Events" => "&Eacute;v&eacute;nements",
			"Event" => "&Eacute;v&eacute;nement",
			"Slots available" => "Places disponibles",
			"No tickets available" => "Pas de billets disponibles",
			"No tickets left" => "Pas de billets disponibles",
			"Share this page" => "Partagez cette page",
			"Find out more »" => "en savoir plus »",
			"404 Not Found" => "404 - Page non trouv&eacute;e",
			"Oops! That page can’t be found." => "Oops! Cette page ne peut être trouv&eacute;e.",
			"It looks like nothing was found at this location." => "Il semble que rien n&#39;a &eacute;t&eacute; trouv&eacute; &agrave; cet endroit.",
			"Click Here to go to Home Page" => "Cliquez ici pour aller &agrave; la page d&#39;accueil",
			"Date" => "Rendez-vous amoureux",
			"Search" => "Recherche",
			"Location" => "Emplacement",
			"Keyword" => "Mot-cl&eacute;",
			"Near" => "Pr&eacute;s",
			"French" => "Fran&ccedil;ais",
			"&copy; Copyright 2016. Venet Foundation. All Rights Reserved." => "&copy; Droits D&#39;auteur 2016. Venet Fondation. Tous Droits R&eacute;serv&eacute;s",
			"Privacy And Cookie policy" => "Politique de confidentialit&eacute; et de cookies",
			"Checkout" => "Check-out",
			"Your tickets from %s" => "Vos billets à partir de %s",
			"Your tickets" => "Vos billets",
			"Purchaser" => "Acheteur",
			"Security Code" => "Code de s&eacute;curit&eacute;",
			"Ticket Type" => "Type de billet",
			"Check in for this event" => "Check in pour cet &eacute;v&eacute;nement",
			"Organizer" => "Organisateur",
			"Scan this QR code at the event to check in." => "Scannez ce code QR lors de l&#39;&eacute;v&eacute;nement pour vous enregistrer.",
			"QR Code Image" => "Image du code QR",
			"You'll receive your tickets in another email." => "Vous recevrez vos billets dans un autre courrier électronique.",
			"%s - Powered by WooCommerce" => "%s - Propuls&eacute; par WooCommerce",
			'Return to visit page' => "Retour à la page de visite",
			'Child' => 'Enfant',
			'child' => 'enfant',
			'View All %s' => 'Voir tout %s',
			'View %s' => 'Voir %s',
			'Find out more' => 'En savoir plus',
			'Program' => 'Programme',
			'Current Events' => 'Actualit&eacute;s',
			'Sold out' => 'Complet',
 		);
	} else {
		$custom_text = array(
			'Return to shop' => 'Return to visit page',
		);
	}

	$domain_array = array( 'tribe-events-calendar-pro', 'venet', 'tribe-events-calendar', 'event-tickets', 'the-events-calendar', 'woocommerce' );

	// If this text domain starts with "tribe-", "the-events-", or "event-" and we have replacement text
	if ( ( in_array( $domain, $domain_array ) || strpos( $domain, 'tribe-' ) === 0 || strpos( $domain, 'the-events-' ) === 0 || strpos( $domain, 'event-' ) === 0 ) && array_key_exists( $translation, $custom_text ) ) {
		$translation = $custom_text[ $translation ];
	}
	return $translation;
}
add_filter( 'gettext', 'venet_language_based_text_changes', 20, 3 );

/**
 * Sending PDF file based on langauge user has selected
 */
function venet_attach_pdf_to_mail( $attachments, $type, $object ) {
	// send attachment to ticket mail
	//if ( did_action( 'wootickets-send-tickets-email' ) ) {
	if ( qtranxf_getLanguage() == 'en' ) {
		$attachments[] = get_template_directory() . '/assets/pdfs/vf_conf_page_eng.pdf';
	} else {
		$attachments[] = get_template_directory() . '/assets/pdfs/vf_conf_page_fr.pdf';
	}
	//}
	return $attachments;
}
add_filter( 'woocommerce_email_attachments', 'venet_attach_pdf_to_mail', 10, 3 );

/** 
 * Removes Order Notes Title - Additional Information
 */
add_filter( 'woocommerce_enable_order_notes_field', '__return_false' );

/**
 * Removed order notes fileds from backend
 */
function venet_remove_order_notes( $fields ) {
	unset( $fields['order']['order_comments'] );
	return $fields;
}
add_filter( 'woocommerce_checkout_fields' , 'venet_remove_order_notes' );

/**
 * Send a copy of tickets to admin email also
 */
function modify_woo_ticket_headers( $headers ) {
	remove_filter( 'woocommerce_email_headers', 'modify_woo_ticket_headers' );
	$bcc = sanitize_email( get_option( 'admin_email' ) );
	return $headers . "Bcc: $bcc\r\n";
}

function before_woo_tickets_sent() {
	add_filter( 'woocommerce_email_headers', 'modify_woo_ticket_headers' );
}
add_action( 'wootickets-send-tickets-email', 'before_woo_tickets_sent', 5 );

/**
 * Change the title just on the Month View in French version.
 *
 * @param string $title title of the month view
 *
 * @return {string}$title - the response to be sent.
 */
function venet_change_events_title( $title ) {
	if ( tribe_is_month() & ( 'fr' == qtranxf_getLanguage() ) ) {
		$title = str_replace( 'for', 'en', $title );
	}
	return $title;
}
add_filter( 'tribe_get_events_title', 'venet_change_events_title' );

/**
 * Change the Subject of order confirmation mail in French version.
 *
 * @param string $subject Subject of order confirmation mail
 *
 * @return {string}$subject - the subject to be sent.
 */
function venet_change_events_order_subject( $subject ) {
	$site_name = get_option( 'blogname' );
	if ( 'fr' == qtranxf_getLanguage() ) {
		$subject = 'Vos billets à partir de ' . $site_name;
	}

	return $subject;
}
add_filter( 'wootickets_ticket_email_subject', 'venet_change_events_order_subject' );

/**
* Change the name of item in French version of order email.
*
* @param string $name title of the month view
* @param object $item item
*
* @return {string}$name - the name to be sent in email.
*/
function venet_woocommerce_order_item_name( $name, $item ) {
	$event = tribe_events_get_ticket_event( $item['product_id'] );
	$date_txt = '';

	if ( 'fr' == qtranxf_getLanguage() ) {
		$name = str_ireplace( 'Children', 'Gratuit&eacute;', $name );
		$name = str_replace( 'Students', '&Eacute;tudiants', $name );
		$name = str_replace( 'Student', '&Eacute;tudiant', $name );
		$name = str_replace( 'Adult', 'Adulte', $name );
		$name = str_replace( 'Child', 'Enfant', $name );
		$name = str_replace( 'child', 'enfant', $name );
		$name = str_replace( 'adult', 'adulte', $name );
		$date_txt = ' - &eacute;v&eacute;nement du ';
		/* Adds Event start date to ticket order titles in email order and checkout screens */
		if ( ! is_wc_endpoint_url( 'order-received' ) && ( false !== $event ) ) {
			$start_date = tribe_get_start_date( $event, false, 'j F' );
			$start_time = tribe_get_start_date( $event, false, 'G:i' );
			$name .= $date_txt . $start_date . ' @ ' . $start_time;
		}
	} else {
		$date_txt = ' - Event is on ';
		/* Adds Event start date to ticket order titles in email order and checkout screens */
		if ( ! is_wc_endpoint_url( 'order-received' ) && ( false !== $event ) ) {
			$name .= $date_txt . tribe_get_start_date( $event );
		}
	}

	return $name;
}
add_filter( 'woocommerce_order_item_name', 'venet_woocommerce_order_item_name', 10, 2 );

/**
* Custom text on thankyou page after checkout.
*
* @param int $order_id id of the order
*
* @return void
*/
function venet_custom_thank_you_text( $order_id ) {
	// Create an order instance.
	$order = wc_get_order( $order_id );
	?>
	<h2>
	<?php
	if ( qtranxf_getLanguage() == 'en' ) {
		echo 'Event Details';
	} else {
		echo 'D&eacute;tails de &eacute;v&egrave;nement';
	}
	?>
	</h2>
	<table class="shop_table order_details">
		<thead>
			<tr>
				<th class="product-name">
					<?php
					if ( qtranxf_getLanguage() == 'en' ) {
						echo 'Event Date';
					} else {
						echo 'Date de &eacute;v&eacute;nement';
					}
					?>
				</th>
				<th class="product-total">
					<?php
					if ( qtranxf_getLanguage() == 'en' ) {
						echo 'Event Time';
					} else {
						echo 'Heure de &eacute;v&egrave;nement';
					}
					?>
				</th>
			</tr>
		</thead>
		<tbody>
			<?php
			if ( sizeof( $order->get_items() ) > 0 ) {
				$event_ids = array();
				$notification_html = '';
				foreach ( $order->get_items() as $item ) {
					$product_id = $item['product_id'];
					$event_id = get_post_meta( $product_id, '_tribe_wooticket_for_event', true );

					if ( ! in_array( $event_id, $event_ids ) ) {
						$start_date = tribe_get_start_date( $event_id, false, 'F j, Y' );
						$start_time = tribe_get_start_date( $event_id, false, 'g:i a' );
						$notification_html .= '<p class="woocommerce-notice">';
						if ( qtranxf_getLanguage() == 'en' ) {
							$notification_html .= 'The visit will begin promptly at ' . $start_time . '. Kindly plan ahead as traffic is quite dense during this time of year. Guided tours will begin on time so please don&#39;t be late.';
						} else {
							$notification_html .= 'La visite d&#233;butera &#224;  ' . $start_time . ' pr&#233;cise. Veuillez pr&#233;voir de l&rsquo; avance, la circulation &#233;tant dense &#224; cette p&#233;riode de l&rsquo; ann&#233;e. Les visites guid&#233;es commencent &#224; l&#39;heure, nous vous remercions de ne pas arriver en retard.';
						}
						$notification_html .= '</p>';
						?>
						<tr>
							<td class="product-name">
								<?php echo  $start_date; ?>
							</td>
							<td class="product-total">
								<?php echo  $start_time; ?>
							</td>
						</tr>
						<?php
						$event_ids[] = $event_id;
					}
				}
			}
			?>
		</tbody>
	</table>
	<?php
	echo $notification_html;
}

add_action( 'woocommerce_thankyou', 'venet_custom_thank_you_text', 10, 1 );

/**
* Reply To header for woocommerce related emails.
*
* @param string $headers header info
* @param int $id order id
* @param object $order order object
*
* @return void
*/
function venet_add_reply_to_wc_order_emails( $headers = '', $id = '', $order ) {
	$headers .= "Reply-to: <info@venetfoundation.org>\r\n";
	return $headers;
}
add_filter( 'woocommerce_email_headers', 'venet_add_reply_to_wc_order_emails', 10, 3 );

/**
 * Defining a meta box for displaying all templates
 *
 * @param null
 * @return null
 */
function venet_add_meta_boxes_for_event() {
	add_meta_box(
	    'venet-event-share-box',
	    __( 'Event Custom Box' ),
	    'venet_render_event_custom_meta_box',
	    'tribe_events',
	    'side',
	    'high'
	);
}
add_action( 'add_meta_boxes_tribe_events', 'venet_add_meta_boxes_for_event' );

/**
 * Show sharing link and attendees related stuff.
 *
 * @param object Post object.
 * @return null
 */
function venet_render_event_custom_meta_box( $post ) {
	$link_tobe_shared = get_post_meta( $post->ID, 'private_share_link', true );
	$is_event_private = ( '' != get_post_meta( $post->ID, 'is_event_private', true ) ) ? get_post_meta( $post->ID, 'is_event_private', true ) : 'no';
	$ticket_current_number = get_post_meta( $post->ID, '_tribe_progressive_ticket_current_number', true );
	$ticket_global_stock_level = get_post_meta( $post->ID, '_tribe_ticket_global_stock_level', true );
	wp_nonce_field( basename( __FILE__ ), 'share-box-nonce' );
	?>
	<label for="is_event_private"><strong>Make event as private</strong></label><br/>
	<input type="radio" name="is_event_private" value="no" <?php checked( $is_event_private, 'no' ); ?> >No
	<input type="radio" name="is_event_private" value="yes" <?php checked( $is_event_private, 'yes' ); ?> > Yes<br/><br/>
	<label for="private_share_link"><strong>Private link to share with customer</strong></label><br/>
	<input type="text" name="private_share_link" id="title_field" class="title_field" readonly value="<?php echo $link_tobe_shared;?>" style="width:100%;"/>
	<?php
	$screen = get_current_screen();

	if ( ( 'add' != $screen->action ) && ( '' != $ticket_global_stock_level ) && ( 'no' == $is_event_private ) ) : ?>

	<label for="ticket_current_number"><strong>Ticket current number</strong></label><br/>
	<input type="text" name="ticket_current_number" id="title_field" class="title_field" value="<?php echo $ticket_current_number;?>" style="width:100%;"/>
	<label for="ticket_global_stock_level"><strong>Shared capacity( Remaining seats )</strong></label><br/>
	<input type="text" name="ticket_global_stock_level" id="title_field" class="title_field" value="<?php echo $ticket_global_stock_level;?>" style="width:100%;"/>

	<?php endif; ?>
<?php
}

/**
 * Save meta box fields for event.
 *
 *
 * @param $post_id - current post id
 *
 * @return void
 */
function venet_save_custom_meta_box( $post_id ) {

	if ( ! isset( $_POST['share-box-nonce'] ) || ! wp_verify_nonce( $_POST['share-box-nonce'], basename( __FILE__ ) ) ) {
		return $post_id;
	}

	/*
	 * If this is an autosave, our form has not been submitted,
	 * so we don't want to do anything.
	 */
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
	    return $post_id;
	}


	// Check the user's permissions.
	if ( 'tribe_events' == $_POST['post_type'] ) {
	    if ( ! current_user_can( 'edit_page', $post_id ) ) {
	        return $post_id;
	    }
	} else {
	    if ( ! current_user_can( 'edit_post', $post_id ) ) {
	        return $post_id;
	    }
	}


	$private_share_link = '';
	$is_event_private = ( isset( $_POST['is_event_private'] ) ) ? $_POST['is_event_private'] : 'no';

	if ( 'yes' == $is_event_private ) {
	    $private_share_link = add_query_arg( array(
		    'privatelink' => 'id_' . $post_id,
		), get_permalink( $post_id ) );
	} else {
		$ticket_current_number = ( isset( $_POST['ticket_current_number'] ) ) ? $_POST['ticket_current_number'] : '';

		if ( '' != $ticket_current_number ) {
		    update_post_meta( $post_id, '_tribe_progressive_ticket_current_number', $ticket_current_number );
		}

		$ticket_global_stock_level = ( isset( $_POST['ticket_global_stock_level'] ) ) ? $_POST['ticket_global_stock_level'] : '';

		if ( '' != $ticket_global_stock_level ) {
		    update_post_meta( $post_id, '_tribe_ticket_global_stock_level', $ticket_global_stock_level );
		}
	}
	update_post_meta( $post_id, 'is_event_private', $is_event_private );
	update_post_meta( $post_id, 'private_share_link', $private_share_link );
}

add_action( 'save_post', 'venet_save_custom_meta_box', 10, 3 );

/**
* Change the name of item in French version of cart page.
*
* @param string $name title of the month view
* @param object $item item
*
* @return {string}$name - the name to be sent in email.
*/
function venet_woocommerce_cart_item_name( $name, $item ) {
	if ( 'fr' == qtranxf_getLanguage() ) {
		$name = str_ireplace( 'Children', 'Gratuit&eacute;', $name );
		$name = str_replace( 'Students', '&Eacute;tudiants', $name );
		$name = str_replace( 'Student', '&Eacute;tudiant', $name );
		$name = str_replace( 'Adult', 'Adulte', $name );
		$name = str_replace( 'Child', 'Enfant', $name );
		$name = str_replace( 'child', 'enfant', $name );
		$name = str_replace( 'adult', 'adulte', $name );
	}

	return $name;
}
add_filter( 'woocommerce_cart_item_name', 'venet_woocommerce_cart_item_name', 10, 2 );

/**
* Change "Buy Now!" button text
*
* @param string $html button html
*
* @return {string}$html - button html.
*/
function venet_tribe_buy_now_button_text( $html ) {
	if ( 'fr' == qtranxf_getLanguage() ) {
		$html = str_replace( 'Buy Now!' , 'Acheter', $html );
		$html = str_replace( 'Sold out' , 'Complet', $html );
	} else {
		$html = str_replace( 'Buy Now!' , 'Buy', $html );
	}
	return $html;
}
add_filter( 'tribe_tickets_buy_button', 'venet_tribe_buy_now_button_text', 11, 2 );

function venet_image_editor_default_to_gd( $editors ) {
    $gd_editor = 'WP_Image_Editor_GD';
    $editors = array_diff( $editors, array( $gd_editor ) );
    array_unshift( $editors, $gd_editor );
    return $editors;
}
add_filter( 'wp_image_editors', 'venet_image_editor_default_to_gd' );

add_filter( 'woocommerce_cart_item_name', 'shorten_woo_product_title', 10, 3 );
function shorten_woo_product_title( $title, $cart_item, $cart_item_key ) {
    //return "HEllo";
    $_product   = $cart_item['data'] ;
    $ticket_id = $_product->get_id();
    $event_id = get_post_meta($ticket_id, '_tribe_wooticket_for_event', true);
	$event_name = get_the_title($event_id);

	$start_stamp = get_post_meta($event_id, '_EventStartDate', true);
    $end_stamp = get_post_meta($event_id, '_EventEndDate', true);
    
    $date1 = explode( " ", $start_stamp );
    $event_date = $date1[0];
    $timestamp = strtotime($event_date);
 	$event_date = date("d M Y", $timestamp);

    $time1 = $date1[1];
    $date2 = explode( " ", $end_stamp );
    $time2 = $date2[1];
    return "$event_name - $title <br> 
    <small><b>Event Date </b>: $event_date </small><br>
    <small><b>Event Time </b>: $time1 - $time2</small>";
    // if ( is_checkout() || is_shop() ) {
    //     // Use as the product name the characters up to but not including the first dash character
    //     $n = 1; // 1st dash
    //     $pieces = explode(' - ', $title); // Break up the title into an array delimited by the "space dash space" characters
    //     $shortname = implode(' - ', array_slice($pieces, 0, $n)); // Grab the short name in front of the first dash character
    //     return $shortname; // Return it back
    // } else {
    //     return $title; // Give the full product name
    // }
}
