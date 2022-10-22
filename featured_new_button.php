<?php
use Elementor\Control_Media;
use Elementor\Group_Control_Image_Size;
use Elementor\Icons_Manager;
use Elementor\Utils;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/**
 * Elementor activities widget.
 *
 * Elementor widget that displays a bullet list with any chosen icons and texts.
 *
 * @since 1.0.0
 */
class Templines_Button extends Widget_Base {

    public function get_name() {
        return 'templines-button-simple';
    }

    public function get_title() {
        return esc_html__( 'Button', 'templines-helper-core' );
    }

    public function get_icon() {
        return 'fa fa-link templines-icon';
    }

    public function get_categories() {
        return array('templines-helper-core-elements');
    }

    protected function register_controls() {
        $this->start_controls_section(
            'section_elementor_text_editor_general_style',
            [
                'label' => __( 'General Styles', 'templines-helper-core' ),
            ]
        );

        $this->add_responsive_control(
            'align_button',
            [
                'label' => __( 'Button Alignment', 'templines-helper-core' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __( 'Left', 'templines-helper-core' ),
                        'icon' => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'templines-helper-core' ),
                        'icon' => 'fa fa-align-center',
                    ],
                    'right' => [
                        'title' => __( 'Right', 'templines-helper-core' ),
                        'icon' => 'fa fa-align-right',
                    ],
                ],
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .page-builder-button-wrap' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_text',
            [
                'label' => __( 'Button Text', 'templines-helper-core' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Get in Touch', 'templines-helper-core' ),
                'placeholder' => __( 'Enter your button text', 'templines-helper-core' ),
                'description' => __( 'Enter your button text', 'templines-helper-core' ),
                'separator' => 'before',
                'label_block' => true,
            ]
        );



        $this->add_control(
            'link',
            [
                'label' => __( 'Button Link', 'templines-helper-core' ),
                'type' => Controls_Manager::URL,
                'dynamic' => [
                    'active' => true,
                ],
                'placeholder' => __( 'https://your-link.com', 'templines-helper-core' ),
                'default' => [
                    'url' => '#',
                ],
            ]
        );

        $this->add_control(
            'button_css_id',
            [
                'label' => __( 'Button ID', 'templines-helper-core' ),
                'type' => Controls_Manager::TEXT,
                'dynamic' => [
                    'active' => true,
                ],
                'default' => '',
                'title' => __( 'Add your custom id WITHOUT the Pound key. e.g: my-id', 'templines-helper-core' ),
                'description' => __( 'Please make sure the ID is unique and not used elsewhere on the page this form is displayed. This field allows <code>A-z 0-9</code> & underscore chars without spaces.', 'templines-helper-core' ),
                'separator' => 'before',
            ]
        );


        /*
                * Custom
                */
        //Typography
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'content_typography',
                'label' => __( 'Typography', 'plugin-domain' ),
                'global' => [
                    'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
                ],
                'selector' => '{{WRAPPER}} .fl-default-button',
            ]
        );
        //Color
        $this->add_control(
            'title_color',
            [
                'label' => __( 'Color', 'plugin-domain' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'scheme' => [
                    'type' => \Elementor\Core\Schemes\Color::get_type(),
                    'value' => \Elementor\Core\Schemes\Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .fl-default-button' => 'color: {{VALUE}}',
                ],
                'default' => '#ffffff'
            ]
        );
        $this->add_control(
            'title_color_hv',
            [
                'label' => __( 'Color Hover', 'plugin-domain' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'scheme' => [
                    'type' => \Elementor\Core\Schemes\Color::get_type(),
                    'value' => \Elementor\Core\Schemes\Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .fl-default-button:hover' => 'color: {{VALUE}}',
                ],
                'default' => '#ffffff'
            ]
        );
        //Background
        $this->add_control(
            'bg_color',
            [
                'label' => __( 'Background Color', 'plugin-domain' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'scheme' => [
                    'type' => \Elementor\Core\Schemes\Color::get_type(),
                    'value' => \Elementor\Core\Schemes\Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .fl-default-button' => 'background-color: {{VALUE}}',
                ],
                'default' => '#f44153'
            ]
        );
        $this->add_control(
            'bg_color_hv',
            [
                'label' => __( 'Background Color Hover', 'plugin-domain' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'scheme' => [
                    'type' => \Elementor\Core\Schemes\Color::get_type(),
                    'value' => \Elementor\Core\Schemes\Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .fl-default-button:hover' => 'background-color: {{VALUE}}',
                ],
                'default' => '#4da1f4'
            ]
        );


        $this->end_controls_section();
    }

    protected function render() {
        $this->add_render_attribute( 'wrapper', 'class', 'page-builder-button-wrap' );
        $this->add_render_attribute( 'button', 'class', 'fl-default-button' );
        $this->add_render_attribute( 'button', 'role', 'button' );
        $result = '';
        $settings = $this->get_settings_for_display();

        if ( ! empty( $settings['link']['url'] ) ) {
            $this->add_link_attributes( 'button', $settings['link'] );
        }

        if ( ! empty( $settings['button_css_id'] ) ) {
            $this->add_render_attribute( 'button', 'id', $settings['button_css_id'] );
        }

        $result .='<div '.$this->get_render_attribute_string('wrapper').'>';

        $result .='<a '.$this->get_render_attribute_string('button').'>'.$settings['button_text'].'</a>';

        $result .='</div>';

        echo  $result;

    }
}