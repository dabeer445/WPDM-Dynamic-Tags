<?php

if (! defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class Elementor_Dynamic_Tag_Mod_Links extends \Elementor\Core\DynamicTags\Tag
{
    protected $name = "mod-links";

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

    protected function register_controls()
    {
        $social_links = [];

        foreach (['discord', 'reddit', 'github', 'web', 'patreon', 'ms_group'] as $variable) {
            $social_links[ $variable ] = ucwords(str_replace('_', ' ', $variable));
        }

        $this->add_control(
            'external_links',
            [
                'type' => \Elementor\Controls_Manager::SELECT,
                'label' => esc_html__('Links', 'plugin-name'),
                'options' => $social_links,
            ]
        );
    }

    public function render()
    {
        $external_links = $this->get_settings('external_links');

        if (! $external_links) {
            return;
        }

        $value = get_post_meta(get_the_ID(), '__wpdm_'.$external_links, true) ?? '';
        if (! isset($value)) {
            return;
        }

        echo $value;
    }
}
