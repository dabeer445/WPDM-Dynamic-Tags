<?php
/**
 * Plugin Name: WPDM - Elementor Dynamic Tags
 * Description: Add dynamic tags mod details.
 * Version:     1.0.0
 * Author:      M.Dabeer
 * Author URI:  https://developers.elementor.com/
 * Text Domain: wpdm-dt
 *
 */

if (! defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}


define("TAG_GROUP", "wpdm");
define("TAG_DIR", __DIR__ . "/dynamic-tags");
define("WIDGET_DIR", __DIR__ . "/widgets");

require_once(__DIR__ . '/wpdm-shortcodes.php');


/**
 * Register Request Variables Dynamic Tag Group.
 *
 * Register new dynamic tag group for Request Variables.
 *
 * @since 1.0.0
 * @param \Elementor\Core\DynamicTags\Manager $dynamic_tags_manager Elementor dynamic tags manager.
 * @return void
 */
function register_request_variables_dynamic_tag_group($dynamic_tags_manager)
{
    $dynamic_tags_manager->register_group(
        TAG_GROUP,
        [
            'title' => esc_html__('Mod Details', 'wpdm-dt')
        ]
    );
}
add_action('elementor/dynamic_tags/register', 'register_request_variables_dynamic_tag_group');

function register_server_variable_dynamic_tag($dynamic_tags_manager)
{
    require_once(TAG_DIR . '/all-mod-tags.php');

    $dynamic_tags_manager->register(new \Elementor_Dynamic_Tag_Mod_Name());
    $dynamic_tags_manager->register(new \Elementor_Dynamic_Tag_Mod_Breadcrumb());
    $dynamic_tags_manager->register(new \Elementor_Dynamic_Tag_Mod_Version());
    $dynamic_tags_manager->register(new \Elementor_Dynamic_Tag_Mod_CreateDate());
    $dynamic_tags_manager->register(new \Elementor_Dynamic_Tag_Mod_ModifyDate());
    $dynamic_tags_manager->register(new \Elementor_Dynamic_Tag_Mod_MainLink());
    $dynamic_tags_manager->register(new \Elementor_Dynamic_Tag_Mod_EditMod());
    $dynamic_tags_manager->register(new \Elementor_Dynamic_Tag_Mod_CoverImage());
    $dynamic_tags_manager->register(new \Elementor_Dynamic_Tag_Mod_PrevImage());
    $dynamic_tags_manager->register(new \Elementor_Dynamic_Tag_Mod_ShortDescription());
    $dynamic_tags_manager->register(new \Elementor_Dynamic_Tag_Mod_Size());
    $dynamic_tags_manager->register(new \Elementor_Dynamic_Tag_Mod_Views());
    $dynamic_tags_manager->register(new \Elementor_Dynamic_Tag_Mod_Links());
    $dynamic_tags_manager->register(new \Elementor_Dynamic_Tag_Mod_PrevGallery());
    $dynamic_tags_manager->register(new \Elementor_Dynamic_Tag_Mod_PermaLink());
    $dynamic_tags_manager->register(new \Elementor_Dynamic_Tag_Mod_AuthorLink());
    $dynamic_tags_manager->register(new \Elementor_Dynamic_Tag_Mod_Tracking());
    $dynamic_tags_manager->register(new \Elementor_Dynamic_Tag_Mod_GameImages());
    $dynamic_tags_manager->register(new \Elementor_Dynamic_Tag_Mod_Package_ID());
    $dynamic_tags_manager->register(new \Elementor_Dynamic_Tag_Timer());



    $dynamic_tags_manager->register(new \Elementor_Dynamic_Tag_My_Mods());
    $dynamic_tags_manager->register(new \Elementor_Dynamic_Tag_My_Contributions());
    $dynamic_tags_manager->register(new \Elementor_Dynamic_Tag_My_Downloads());
    $dynamic_tags_manager->register(new \Elementor_Dynamic_Tag_My_Downloads_ID());
    $dynamic_tags_manager->register(new \Elementor_Dynamic_Tag_User_Contributions_ID());
    $dynamic_tags_manager->register(new \Elementor_Dynamic_Tag_Displayed_User_Mods_ID());
    $dynamic_tags_manager->register(new \Elementor_Dynamic_Tag_My_Favs());
    $dynamic_tags_manager->register(new \Elementor_Dynamic_Tag_Mod_DelMod());



    $dynamic_tags_manager->register(new \Elementor_Dynamic_Tag_Post_Meta());
}
add_action('elementor/dynamic_tags/register', 'register_server_variable_dynamic_tag');

function register_gallery_widget($widgets_manager)
{
    require_once(__DIR__ . '/widgets/url-gallery.php');

    $widgets_manager->register(new \Elementor_Widget_URL_Gallery());
}
add_action('elementor/widgets/register', 'register_gallery_widget');
