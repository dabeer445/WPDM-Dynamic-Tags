<?php

if (! defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class Elementor_Dynamic_Tag_My_Downloads_ID extends \Elementor\Core\DynamicTags\Tag
{
    protected $name = "my-downloads-id";

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
        global $wpdb;

        $id = [];
        $res = $wpdb->get_results("select s.pid from {$wpdb->prefix}posts p, {$wpdb->prefix}ahm_download_stats s where s.pid = p.ID and s.uid = '".get_current_user_id()."' ");
        foreach ($res as $value) {
            $id[] =  $value->pid;
        }
        echo implode(",", $id);
    }
}
