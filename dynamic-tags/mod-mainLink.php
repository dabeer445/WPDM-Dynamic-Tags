<?php

if (! defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class Elementor_Dynamic_Tag_Mod_MainLink extends \Elementor\Core\DynamicTags\Tag
{
    protected $name = "mod-main-link";

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
        $mod_id = get_the_ID();

        $main_file = "";
        foreach (maybe_unserialize(get_post_meta($mod_id, '__wpdm_fileinfo', true)) as $k => $file) {
            if ($file["main"] == "1") {
                $main_file = $k;
                break;
            }
        }

        $link = WPDM()->package->getDownloadURL($mod_id, array('ind' => $main_file));
        echo $link;

        // $value = $link;
        // echo wp_kses_post( $value );
    }
}
