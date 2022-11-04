<?php

if (! defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class Elementor_Dynamic_Tag_User_Contributions_ID extends \Elementor\Core\DynamicTags\Tag
{
    protected $name = "user-contributions-id";

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
        return [ \Elementor\Modules\DynamicTags\Module::TEXT_CATEGORY ];
    }

    public function render()
    {
        echo implode(",", get_user_meta(bbp_get_displayed_user_id(), '__wpdm_contributions')[0]);
    }
}
