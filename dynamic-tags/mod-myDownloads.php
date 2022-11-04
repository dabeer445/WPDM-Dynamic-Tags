<?php

if (! defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class Elementor_Dynamic_Tag_My_Downloads extends \Elementor\Core\DynamicTags\Tag
{
    protected $name = "my-downloads";

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
        return [ \Elementor\Modules\DynamicTags\Module::URL_CATEGORY ];
    }

    public function render()
    {
        echo wp_kses_post(bp_loggedin_user_domain() . 'mods/download-mods/');
    }
}
