<?php
use Elementor\Control_Media;
use Elementor\Group_Control_Image_Size;
use Elementor\Icons_Manager;
use Elementor\Utils;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Group_Control_Typography;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Templines_Custom_section extends Widget_Base {

    public function get_name() {
        return 'templines-custom-section';
    }

    public function get_title() {
        return esc_html__( 'Custom Section', 'templines-helper-core' );
    }

    public function get_icon() {
        return 'fa fa-font templines-icon';
    }

    public function get_categories() {
        return array('templines-helper-core-elements');
    }

    protected function register_controls() {
        $this->start_controls_section(
            'section_elementor_title_general_style',
            [
                'label' => __( 'General Styles', 'templines-helper-core' ),
            ]
        );



        $this->end_controls_section();
    }

    protected function render() {
        $result = '';
        $this->add_render_attribute( 'wrapper', 'class', 'page-builder-custom-section-wrap' );
        $this->add_render_attribute( 'title', 'class', 'title' );
        $this->add_render_attribute( 'sub-title', 'class', 'sub-title fl-primary-color' );
        $settings = $this->get_settings_for_display();


    }
}