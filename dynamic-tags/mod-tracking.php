<?php

if (! defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class Elementor_Dynamic_Tag_Mod_Tracking extends \Elementor\Core\DynamicTags\Tag
{
    protected $name = "mod-tracking-status";

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
        $main_file = "";
        $id = get_the_ID();
        $meta = get_post_meta($id, '__wpdm_fileinfo', true);
        if (is_array(maybe_unserialize($meta))) {
            foreach (maybe_unserialize($meta) as $k => $file) {
                if ($file["main"] == "1") {
                    $main_file = $k;
                    break;
                }
            }
        }

        global $wpdb;
        $table = "{$wpdb->prefix}ahm_download_stats";
        $retrieve_data = $wpdb->get_results(
            $wpdb->prepare(
                "SELECT `timestamp` FROM $table WHERE `pid`= %d AND `uid` = %d  ORDER BY `id` DESC LIMIT 1",
                intval(get_the_ID()),
                intval(get_current_user_id())
            )
        );
        $value = '';
        if (count($retrieve_data)>0) {
            $value = '<div class="ribbon down"  data-toggle="tooltip" data-placement="top" title="Downloaded" style="--color: #118444;width:2rem;"><div class="content">*</div></div>';
            if (intval($retrieve_data[0]->timestamp)*1000 < $main_file) {
                $value = '<div class="ribbon down"  data-toggle="tooltip" data-placement="top" title="Update Available" style="--color: #e5bc10;width:2rem;"><div class="content">+</div></div>';
            }
        }

        echo wp_kses_post($value);
    }
}
