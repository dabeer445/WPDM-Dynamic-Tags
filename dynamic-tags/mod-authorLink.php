<?php

if (! defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class Elementor_Dynamic_Tag_Mod_AuthorLink extends \Elementor\Core\DynamicTags\Tag
{
    protected $name = "mod-author-link";

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
        $this->add_control(
            'author_links',
            [
                'type' => \Elementor\Controls_Manager::SELECT,
                'label' => esc_html__('Links', 'plugin-name'),
                'options' => array(
                                'mods' => 'Mods',
                                'mods/contributions' => 'Contributions',
                                '/' => 'Simple',
                            ),
            ]
        );
    }

    public function render()
    {
        $mod_author = get_the_author();
        $author_links = $this->get_settings('author_links');


        $value = "https://modsanctum.org/members/".$mod_author.'/'.$author_links;


        echo $value;
    }
}
