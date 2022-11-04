<?php

if (! defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class Elementor_Dynamic_Tag_Timer extends \Elementor\Core\DynamicTags\Tag
{
    protected $name = "timer";

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
            'timer',
            [
                'type' => \Elementor\Controls_Manager::NUMBER,
                'label' => esc_html__('Timer (s)', 'plugin-name'),
            ]
        );
    }

    public function render()
    {
        $timer = (int) $this->get_settings('timer');

        if (! $timer) {
            return;
        }
        $date = new DateTime();
        $timeZone = $date->getTimezone();
        // echo $timeZone->getName();

        $val = time() - 21600 + $timer;
        echo date("Y-m-d G:i", $val);
    }
}
