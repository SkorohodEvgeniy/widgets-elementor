<?php
use Elementor\Control_Media;
use Elementor\Group_Control_Image_Size;
use Elementor\Icons_Manager;
use Elementor\Utils;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Templines_Image_Decor extends Widget_Base {

    public function get_name() {
        return 'templines-custom-image-decor';
    }

    public function get_title() {
        return esc_html__( 'Image Decor', 'templines-helper-core' );
    }

    public function get_icon() {
        return 'fa fa-picture-o templines-icon';
    }

    public function get_categories() {
        return array('templines-helper-core-elements');
    }

    protected function register_controls() {
        $this->start_controls_section(
            'section_elementor_image_decor_general_setting',
            [
                'label' => __( 'General Setting', 'templines-helper-core' ),
            ]
        );

        $this->add_control(
            'image_1',
            [
                'label' => __( 'Choose Image 1', 'templines-helper-core' ),
                'type' => Controls_Manager::MEDIA,
                'dynamic' => [
                    'active' => true,
                ],
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Image_Size::get_type(), [
                'name' => 'image_1', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `testimonial_image_size` and `testimonial_image_custom_dimension`.
                'default' => 'full',
            ]
        );
        $this->add_control(
            'image_2',
            [
                'label' => __( 'Choose Image 2', 'templines-helper-core' ),
                'type' => Controls_Manager::MEDIA,
                'dynamic' => [
                    'active' => true,
                ],
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Image_Size::get_type(), [
                'name' => 'image_2', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `testimonial_image_size` and `testimonial_image_custom_dimension`.
                'default' => 'full',
            ]
        );

        $this->end_controls_section();
        // Style Option
        // Title
        $this->start_controls_section(
            'section_title_style',
            [
                'label' => __( 'Style', 'templines-helper-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'vertical_position',
            [
                'label' => __( 'Vertical Position', 'templines-helper-core' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .page-builder-decor-image-wrap' => 'top: {{SIZE}}{{UNIT}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'horizontal_position',
            [
                'label' => __( 'Horizontal Position', 'templines-helper-core' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .page-builder-decor-image-wrap' => 'left: {{SIZE}}{{UNIT}}',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $result = '';
        $this->add_render_attribute( 'wrapper', 'class', 'page-builder-decor-image-wrap' );
        $settings = $this->get_settings_for_display();

        $result .='<div '.$this->get_render_attribute_string('wrapper').'>';

                if($settings['image_1']){
                    $result .='<div class="decor-image-wrap"><div class="entry-content">'.wp_get_attachment_image( $settings[ 'image_1' ][ 'id' ], $settings[ 'image_1_size' ], false, ["class" => "decor-image"], ['loading' => 'lazy'] ).'</div></div>';
                }

                if($settings['image_2']){
                    $result .='<div class="decor-image-wrap"><div class="entry-content">'.wp_get_attachment_image( $settings[ 'image_2' ][ 'id' ], $settings[ 'image_2_size' ], false, ["class" => "decor-image"], ['loading' => 'lazy'] ).'</div></div>';
                }

        $result .='</div>';

        echo  $result;

    }
}