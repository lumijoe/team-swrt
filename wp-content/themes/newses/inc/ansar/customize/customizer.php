<?php
/**
 * newses Theme Customizer
 *
 * @package Newses
 */

if (!function_exists('newses_get_option')):
/**
 * Get theme option.
 *
 * @since 1.0.0
 *
 * @param string $key Option key.
 * @return mixed Option value.
 */
function newses_get_option($key) {

	if (empty($key)) {
		return;
	}

	$value = '';

	$default       = newses_get_default_theme_options();
	$default_value = null;

	if (is_array($default) && isset($default[$key])) {
		$default_value = $default[$key];
	}

	if (null !== $default_value) {
		$value = get_theme_mod($key, $default_value);
	} else {
		$value = get_theme_mod($key);
	}

	return $value;
}
endif;

// Load customize default values.
require get_template_directory().'/inc/ansar/customize/customizer-callback.php';

// Load customize default values.
require get_template_directory().'/inc/ansar/customize/customizer-default.php';

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function newses_customize_register($wp_customize) {

	// Load customize controls.
	require get_template_directory().'/inc/ansar/customize/customizer-control.php';

    // Load customize sanitize.
	require get_template_directory().'/inc/ansar/customize/customizer-sanitize.php';

	$wp_customize->get_setting('custom_logo')->sanitize_callback  = 'esc_url_raw';
	$wp_customize->get_setting('custom_logo')->transport  = 'postMessage';
	$wp_customize->get_setting('blogname')->transport         = 'postMessage';
	$wp_customize->get_setting('blogdescription')->transport  = 'postMessage';
	$wp_customize->get_setting('header_textcolor')->transport = 'postMessage';
	$wp_customize->get_section('title_tagline')->priority = 10;

	if (isset($wp_customize->selective_refresh)) {

		$wp_customize->selective_refresh->add_partial('custom_logo', array(
			'selector'        => '.site-logo', 
			'render_callback' => 'custom_logo_selective_refresh'
		));

		$wp_customize->selective_refresh->add_partial('blogname', array(
			'selector'        => '.site-title a, .site-title-footer a',
			'render_callback' => 'newses_customize_partial_blogname',
		));
		
		$wp_customize->selective_refresh->add_partial('blogdescription', array(
			'selector'        => '.site-description, .site-description-footer',
			'render_callback' => 'newses_customize_partial_blogdescription',
		));		

		$wp_customize->selective_refresh->add_partial('newses_header_fb_link', array(
			'selector'        => '.mg-headwidget .mg-head-detail .info-right',
			'render_callback' => 'newses_customize_partial_newses_header_fb_link',
		));


		$wp_customize->selective_refresh->add_partial('banner_advertisement_section', array(
			'selector'        => '.header-ads',
			'render_callback' => 'newses_customize_partial_banner_advertisement_section',
		));

		$wp_customize->selective_refresh->add_partial('select_slider_news_category', array(
			'selector'        => '.homemain',
			'render_callback' => '.newses_customize_partial_select_slider_news_category',
		));

		$wp_customize->selective_refresh->add_partial('latest_tab_title', array(
			'selector'        => '.top-right-area .nav-tabs',
			'render_callback' => '.newses_customize_partial_latest_tab_title',
		));


		$wp_customize->selective_refresh->add_partial('show_popular_tags_title', array(
			'selector'        => '.mg-tpt-txnlst strong',
			'render_callback' => 'newses_customize_partial_show_popular_tags_title',
		));

		$wp_customize->selective_refresh->add_partial('newses_date_time_show_type', array(
			'selector'        => '.mg-head-detail .info-left li',
			'render_callback' => 'newses_customize_partial_newses_date_time_show_type',
		));

		$wp_customize->selective_refresh->add_partial('flash_news_title', array(
			'selector'        => '.mg-latest-news .bn_title h2 span',
			'render_callback' => 'newses_customize_partial_flash_news_title',
		));

		$wp_customize->selective_refresh->add_partial('trending_post_title', array(
			'selector'        => '.recentarea .mg-sec-title h4',
			'render_callback' => 'newses_customize_partial_trending_section_title',
		));


		$wp_customize->selective_refresh->add_partial('you_missed_title', array(
			'selector'        => '.missed-inner .mg-sec-title h4 span',
			'render_callback' => 'newses_customize_partial_you_missed_title',
		));

		$wp_customize->selective_refresh->add_partial('newses_related_post_title', array(
			'selector'        => '.related-title span.bg',
			'render_callback' => 'newses_customize_partial_newses_related_post_title',
		));

		$wp_customize->selective_refresh->add_partial('header_search_enable', array(
			'selector'        => '.mg-search-box',
			'render_callback' => 'newses_customize_partial_header_search_enable',
		));

		$wp_customize->selective_refresh->add_partial('newses_footer_fb_link', array(
			'selector'        => '.mg-social',
			'render_callback' => 'newses_customize_partial_newses_footer_fb_link',
		));

	}

    $default = newses_get_default_theme_options();

    $selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';

	/*theme option panel info*/
	require get_template_directory().'/inc/ansar/customize/theme-options.php';

}
add_action('customize_register', 'newses_customize_register');

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function newses_customize_partial_blogname() {
	bloginfo('name');
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function newses_customize_partial_blogdescription() {
	bloginfo('description');
}

function newses_customize_partial_select_slider_news_category() {
	return get_theme_mod( 'select_slider_news_category' );
}


function newses_customize_partial_latest_tab_title() {
	return get_theme_mod( 'latest_tab_title' );
}


function newses_customize_partial_banner_advertisement_section() {
	return get_theme_mod( 'banner_advertisement_section' );
}

function newses_customize_partial_trending_section_title() {
	return get_theme_mod( 'trending_section_title' );
}

function newses_customize_partial_newses_header_fb_link() {
	return get_theme_mod( 'newses_header_fb_link' );
}

function newses_customize_partial_newses_date_time_show_type() {
	return get_theme_mod( 'newses_date_time_show_type' );
}

function newses_customize_partial_show_popular_tags_title() {
	return get_theme_mod( 'show_popular_tags_title' );
}

function newses_customize_partial_flash_news_title() {
	return get_theme_mod( 'flash_news_title' );
}


function newses_customize_partial_you_missed_title() {
    return get_theme_mod( 'you_missed_title' );
}

function newses_customize_partial_newses_related_post_title() {
    return get_theme_mod( 'newses_related_post_title' );
}
function newses_customize_partial_newses_footer_fb_link() {
    return get_theme_mod( 'newses_footer_fb_link' );
}

function newses_customize_partial_header_search_enable() {
    return get_theme_mod( 'header_search_enable' );
}

function custom_logo_selective_refresh() {
	if( get_theme_mod( 'custom_logo' ) === "" ) return;
	echo '<div class="site-logo">'.the_custom_logo().'</div>';
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function newses_customize_preview_js() {
	wp_enqueue_script('newses-customizer', get_template_directory_uri().'/js/customizer.js', array('customize-preview'), '20151215', true);
}
add_action('customize_preview_init', 'newses_customize_preview_js');

function newses_customizer_css() {
    wp_enqueue_script( 'newses-customize-controls', get_template_directory_uri() . '/assets/customizer-admin.js', array( 'customize-controls' ) );
}
add_action( 'customize_controls_enqueue_scripts', 'newses_customizer_css',0 );


/************************* Related Post Callback function *********************************/

    function newses_rt_post_callback ( $control ) 
    {
        if( true == $control->manager->get_setting ('newses_enable_related_post')->value()){
            return true;
        }
        else {
            return false;
        }       
    }

/************************* Theme Customizer with Sanitize function *********************************/
function newses_theme_option( $wp_customize )
{
    function newses_sanitize_text( $input ) {
        return wp_kses_post( force_balance_tags( $input ) );
    }


        /*--- Site title Font size **/
    $wp_customize->add_setting('newses_title_font_size',
        array(
            'default'           => 34,
            'capability'        => 'edit_theme_options',
            'transport'         => 'postMessage',
            'sanitize_callback' => 'absint',
        )
    );

    $wp_customize->add_control('newses_title_font_size',
        array(
            'label'    => esc_html__('Site Title Size', 'newses'),
            'section'  => 'title_tagline',
            'type'     => 'number',
            'priority' => 50,
        )
    );

    $wp_customize->add_setting('newses_center_logo_title',
    array(
        'default' => false,
        'transport' => 'postMessage',
        'sanitize_callback' => 'newses_sanitize_checkbox',
    )
	);

	$wp_customize->add_control('newses_center_logo_title',
	    array(
	        'label' => esc_html__('Display Center Site Title and Tagline', 'newses'),
	        'section' => 'title_tagline',
	        'type' => 'checkbox',
	        'priority' => 55,

	    )
	);
	
    $wp_customize->remove_control('background_color');

	$wp_customize->add_setting(
        'background_color', 
		array( 
			'transport' => 'postMessage',
			'sanitize_callback' => 'newses_alpha_color_custom_sanitization_callback',
			'default' => '#eee',
		) 
	);
    $wp_customize->add_control(new Newses_Customize_Alpha_Color_Control( $wp_customize,'background_color', 
	array(
			'label'      => __('Background Color', 'newses' ),
			'section' => 'colors',
		)
    ) );
/*--- Get Site info control ---*/
$wp_customize->get_control( 'header_textcolor')->label = __( 'Site Title/Tagline Color', 'newses' );
$wp_customize->get_control( 'header_textcolor')->section = 'title_tagline';
}
add_action('customize_register','newses_theme_option');