<?php

if (! defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class Elementor_Dynamic_Tag_Mod_Breadcrumb extends \Elementor\Core\DynamicTags\Tag
{
    protected $name = "mod-breadcrumbs";

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
        $mod_id = get_the_ID();

        $game = get_post_meta($mod_id, '__wpdm_game', true);
        $cate = get_post_meta($mod_id, '__wpdm_sub_cat', true);

        echo "<a href='https://".strtolower(str_replace(" ", "-", $game)).".modsanctum.org'>$game</a> > <a href='/jsf/jet-engine/tax/wpdmcategory:".strtolower(str_replace(" ", "", $cate))."'>$cate</a>";
    }
}
