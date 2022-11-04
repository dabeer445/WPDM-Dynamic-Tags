<?php

if (! defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class Elementor_Dynamic_Tag_Post_Meta extends \Elementor\Core\DynamicTags\Tag
{
    protected $name = "mod-custom-post-meta";

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
        return [
            \Elementor\Modules\DynamicTags\Module::NUMBER_CATEGORY,
            \Elementor\Modules\DynamicTags\Module::TEXT_CATEGORY,
            \Elementor\Modules\DynamicTags\Module::URL_CATEGORY,
            \Elementor\Modules\DynamicTags\Module::COLOR_CATEGORY,
            \Elementor\Modules\DynamicTags\Module::IMAGE_CATEGORY,
            \Elementor\Modules\DynamicTags\Module::MEDIA_CATEGORY,
            \Elementor\Modules\DynamicTags\Module::GALLERY_CATEGORY,
            \Elementor\Modules\DynamicTags\Module::POST_META_CATEGORY,
        ];
    }
    protected function register_controls()
    {
        $this->add_control(
            'wpdm_dt_post_id',
            [
                'type' => \Elementor\Controls_Manager::TEXT,
                'label' => esc_html__('Post ID', 'plugin-name'),
            ]
        );
        $this->add_control(
            'wpdm_dt_meta_key',
            [
                'type' => \Elementor\Controls_Manager::TEXT,
                'label' => esc_html__('Meta Key', 'plugin-name'),
            ]
        );
    }

    public function render()
    {
        $mod_author = get_the_author();
        $post_id = $this->get_settings('wpdm_dt_post_id');
        $meta_key = $this->get_settings('wpdm_dt_meta_key');

        if (!$post_id || !is_numeric($post_id)) {
            echo "<b>Invalid Post ID.</b>";
            return;
        }

        $meta_value = get_post_meta($post_id, $meta_key, true);

        if (!$meta_value) {
            echo "<b>No value found for provided meta key.</b>";
            return;
        }

        echo $meta_value;
    }
}
