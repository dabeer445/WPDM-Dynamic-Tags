<?php

if (! defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class Elementor_Dynamic_Tag_Mod_PrevImage extends \ElementorPro\Modules\DynamicTags\Tags\Base\Data_Tag
{
    protected $name = "mod-preview-image";

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
        return [ \Elementor\Modules\DynamicTags\Module::IMAGE_CATEGORY ];
    }

    public function get_value(array $options = [])
    {
        return
            [
                'id' => '',
                'url' => wp_upload_dir()["baseurl"].get_post_meta(get_the_ID(), '__wpdm_preview_img', true),
            ];
    }
}
