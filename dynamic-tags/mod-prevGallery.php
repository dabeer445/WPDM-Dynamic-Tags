<?php

if (! defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class Elementor_Dynamic_Tag_Mod_PrevGallery extends \Elementor\Core\DynamicTags\Tag
{
    protected $name = "mod-preview-gallery";

    public function get_name()
    {
        return $this->name;
    }

    public function get_title()
    {
        return esc_html__(ucwords(str_replace("-", " ", $this->name)), 'plugin-name');
    }

    public function get_group()
    {
        return [ TAG_GROUP ];
    }

    public function get_categories()
    {
        return [ \Elementor\Modules\DynamicTags\Module::GALLERY_CATEGORY,\Elementor\Modules\DynamicTags\Module::TEXT_CATEGORY ];
    }

    public function render()
    {
        global $post;
        $mod_id = $post->ID;

        if (!$mod_id) {
            return;
        }

        // wp_remote_post("https://ensir1zx1inq9.x.pipedream.net/2",['body'=>implode("|", get_post_meta($mod_id, "__wpdm_additional_previews",true))]);

        echo implode("|", get_post_meta($mod_id, "__wpdm_additional_previews", true));
    }
}
