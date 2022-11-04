<?php

if (! defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class Elementor_Dynamic_Tag_Mod_PermaLink extends \Elementor\Core\DynamicTags\Tag
{
    protected $name = "mod-permalink";

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
        echo get_the_permalink();
    }
}
