<?php

if (! defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Elementor gallery Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
class Elementor_Widget_URL_Gallery extends \Elementor\Widget_Base
{
    protected $name = "url-gallery";

    /**
     * Get widget name.
     *
     * Retrieve gallery widget name.
     *
     * @since 1.0.0
     * @access public
     * @return string Widget name.
     */
    public function get_name()
    {
        return $this->name;
    }

    /**
     * Get widget title.
     *
     * Retrieve gallery widget title.
     *
     * @since 1.0.0
     * @access public
     * @return string Widget title.
     */
    public function get_title()
    {
        return esc_html__(ucwords(str_replace("-", " ", $this->name)), 'plugin-name');
    }

    /**
     * Get widget icon.
     *
     * Retrieve gallery widget icon.
     *
     * @since 1.0.0
     * @access public
     * @return string Widget icon.
     */
    public function get_icon()
    {
        return 'eicon-code';
    }

    /**
     * Get widget categories.
     *
     * Retrieve the list of categories the gallery widget belongs to.
     *
     * @since 1.0.0
     * @access public
     * @return array Widget categories.
     */
    public function get_categories()
    {
        return [ 'general' ];
    }

    /**
     * Get widget keywords.
     *
     * Retrieve the list of keywords the gallery widget belongs to.
     *
     * @since 1.0.0
     * @access public
     * @return array Widget keywords.
     */
    public function get_keywords()
    {
        return [ 'gallery', 'url', 'link' ];
    }

    /**
     * Register gallery widget controls.
     *
     * Add input fields to allow the user to customize the widget settings.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function register_controls()
    {
        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__('Content', 'elementor-gallery-widget'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'urls',
            [
                'label' => esc_html__('URL to get picture from', 'elementor-gallery-widget'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'placeholder' => esc_html__('https://your-link.com', 'elementor-gallery-widget'),
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        $this->end_controls_section();
    }

    /**
     * Render gallery widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $imgs = explode("|", $settings['urls']) ;

        // wp_remote_post("https://ensir1zx1inq9.x.pipedream.net/4",['body'=>json_encode($imgs)]);
        $width = $settings['width'] ?? '300';

        $html = "<div class='card-body row'>";
        $baseURL = wp_upload_dir()["baseurl"];
        $basePath = wp_upload_dir()["basedir"];
        $id = uniqid();



        foreach ($imgs as $img) {
            $img = str_replace($baseURL, "", $img);
            $img = str_replace($basePath, "", $img);

            $url = $baseURL.$img;
            $path = $basePath.$img;
            // wp_remote_post("https://ensir1zx1inq9.x.pipedream.net/4",['body'=>$url]);
            $html .= "<a href='$url' data-fancybox='gallery_{$id}' >
                        <img  src='". wpdm_dynamic_thumb($path, array($width, $width)) ."'/>
                    </a>";
        }

        $html .= "</div>";

        echo $html;
    }
}
