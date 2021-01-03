<?php
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );
function my_theme_enqueue_styles() {
    $parenthandle = 'parent-style'; // A comment goes here.
    $theme = wp_get_theme();
    wp_enqueue_style( $parenthandle, get_template_directory_uri() . '/style.css', 
        array(),  // if the parent theme code has a dependency, copy it to here
        $theme->parent()->get('Version')
    );

    wp_enqueue_style( 'bootstrap', $src = get_stylesheet_directory_uri() . '/assets/css/bootstrap.css'); //loads bootstrap from theme not cdn



    wp_enqueue_style( 'child-style', get_stylesheet_uri(),
        array( $parenthandle ),
        /*$theme->get('Version') // this only works if you have Version in the style header*/
    );
}

function blankslate_add_google_fonts() {
 
wp_enqueue_style( 'blankslate-google-fonts', 'https://fonts.googleapis.com/css2?family=Montserrat&family=Roboto+Condensed:ital,wght@0,400;0,700;1,400&display=swap', false ); 
}
 
add_action( 'wp_enqueue_scripts', 'blankslate_add_google_fonts' );

/**MOVES ADMIN BAR TO THE BOTTOM OF THE PAGE **/

function move_admin_bar() {
    echo '
    <style type="text/css">
    body {margin-top: -28px;padding-bottom: 28px;}
    body.admin-bar #wphead {padding-top: 0;}
    body.admin-bar #footer {padding-bottom: 28px;}
    #wpadminbar { top: auto !important;bottom: 0;}
    #wpadminbar .quicklinks .menupop ul { bottom: 28px;}
    </style>';
    }
    add_action( 'wp_head', 'move_admin_bar' );



/**
         * Add support for core custom logo.
         *
         * @link https://codex.wordpress.org/Theme_Logo
         */

add_theme_support( 'custom-logo', array(
    'height'      => 100,
    'width'       => 400,
    'flex-height' => true,
    'flex-width'  => true,
    'header-text' => array( 'site-title', 'site-description' ),
) );

/** CUSTOM LOGO IN HEADER **/

add_action('blankslate_site_branding','blankslate_social_navigation');

function blankslate_main_banner() { ?>
    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_html( get_bloginfo( 'name' ) ); ?>" class="navbar-brand" style="max-width:120px;" rel="home">
          <?php
$custom_logo_id = get_theme_mod( 'custom_logo' );
$custom_logo_url = wp_get_attachment_image_url( $custom_logo_id , 'full' );
echo '<img src="' . esc_url( $custom_logo_url ) . '"class="img-fluid" alt="">';
?>
        </a>
<?php }