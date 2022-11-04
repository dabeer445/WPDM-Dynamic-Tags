<?php

if (! defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class Elementor_Dynamic_Tag_Mod_ModifyDate extends \Elementor\Core\DynamicTags\Tag
{
    protected $name = "mod-modify-date";

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

        foreach (maybe_unserialize(get_post_meta($mod_id, '__wpdm_fileinfo', true)) as $k => $file) {
            if ($file["main"] == "1") {
                $val = (int)$k;
                $value = date('j M y, g:i a', $val/1000);
                break;
            }
        }

        // $value = get_the_modified_time('j M y, g:i a');

        echo wp_kses_post($value);
    }
}
