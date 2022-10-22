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

class Templines_Action_Content extends Widget_Base {

    public function get_name() {
        return 'templines-action-content';
    }

    public function get_title() {
        return esc_html__( 'Action Content', 'templines-helper-core' );
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
        $this->add_control(
            'image_bg',
            [
                'label' => __( 'Choose Background Image', 'templines-helper-core' ),
                'type' => Controls_Manager::MEDIA,
                'dynamic' => [
                    'active' => true,
                ],
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'button_text',
            [
                'label' => __( 'Button Text', 'templines-helper-core' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Get Started', 'templines-helper-core' ),
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

        $this->add_responsive_control(
            'align_common',
            [
                'label' => __( 'Text Alignment', 'templines-helper-core' ),
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
                    'justify' => [
                        'title' => __( 'Justified', 'templines-helper-core' ),
                        'icon' => 'fa fa-align-justify',
                    ],
                ],
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}}' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
        // Sub Title
        $this->start_controls_section(
            'section_elementor_custom_sub_title',
            [
                'label' => __( 'Sub Title', 'templines-helper-core' ),
            ]
        );
        $this->add_control(
            'sub_title',
            [
                'label' => esc_html__( 'Sub Title', 'templines-helper-core' ),
                'type' => Controls_Manager::TEXTAREA,
                'dynamic' => [
                    'active' => true,
                ],
                'placeholder' => esc_html__( 'Enter your title', 'templines-helper-core' ),
                'default' => '',
            ]
        );
        $this->add_control(
            'sub_title_style',
            [
                'label' => __( 'Sub Title Style', 'templines-helper-core' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'default'                       => 'Default',
                    'fl-font-style-regular'         => 'Regular',
                    'fl-font-style-regular-two'     => 'Regular Two',
                    'fl-font-style-bolt'            => 'Bolt',
                    'fl-font-style-bolt-two'        => 'Bolt Two',
                    'fl-font-style-medium'          => 'Medium',
                    'fl-font-style-lighter-than'    => 'Light',
                    'fl-font-style-semi-bolt'       => 'Semi Bolt',
                ],
                'default' => 'fl-font-style-medium',
            ]
        );
        $this->end_controls_section();

        // Title
        $this->start_controls_section(
            'section_elementor_custom_title',
            [
                'label' => __( 'Title', 'templines-helper-core' ),
            ]
        );
        $this->add_control(
            'title',
            [
                'label' => esc_html__( 'Title', 'templines-helper-core' ),
                'type' => Controls_Manager::TEXTAREA,
                'dynamic' => [
                    'active' => true,
                ],
                'placeholder' => esc_html__( 'Enter your title', 'templines-helper-core' ),
                'default' => 'Great performance <br> that matters in future',
            ]
        );

        $this->add_control(
            'title_size',
            [
                'label' => __( 'HTML Tag', 'templines-helper-core' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'h1' => 'H1',
                    'h2' => 'H2',
                    'h3' => 'H3',
                    'h4' => 'H4',
                    'h5' => 'H5',
                    'h6' => 'H6',
                    'div' => 'div',
                    'span' => 'span',
                    'p' => 'p',
                ],
                'default' => 'h2',
            ]
        );

        $this->add_control(
            'title_style',
            [
                'label' => __( 'Title Style', 'templines-helper-core' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'default'                       => 'Default',
                    'fl-font-style-regular'         => 'Regular',
                    'fl-font-style-regular-two'     => 'Regular Two',
                    'fl-font-style-bolt'            => 'Bolt',
                    'fl-font-style-bolt-two'        => 'Bolt Two',
                    'fl-font-style-medium'          => 'Medium',
                    'fl-font-style-lighter-than'    => 'Light',
                    'fl-font-style-semi-bolt'       => 'Semi Bolt',
                ],
                'default' => 'fl-font-style-medium',
            ]
        );

        $this->end_controls_section();

        // Style Option
            // Title
        $this->start_controls_section(
            'section_title_style',
            [
                'label' => __( 'Title Style', 'templines-helper-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => __( 'Text Color', 'templines-helper-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .title' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'title_margin_option',
            [
                'label' => __( 'Title Margin', 'templines-helper-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'typography',
                'selector' => '{{WRAPPER}} .title',
            ]
        );
        $this->end_controls_section();
        // Sub Title
        $this->start_controls_section(
            'section_sub_title_style',
            [
                'label' => __( 'Sub Title Style', 'templines-helper-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'sub_title_color',
            [
                'label' => __( 'Sub Text Color', 'templines-helper-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .fl-action-content-meta .sub-title' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'pre_title_font_size',
            [
                'label' => __( 'Pre Title Font Size', 'templines-helper-core' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 150,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .fl-action-content-meta .sub-title' => 'font-size: {{SIZE}}{{UNIT}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'pre_title_line_height',
            [
                'label' => __( 'Sub Title Line Height', 'templines-helper-core' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 150,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .fl-action-content-meta .sub-title' => 'line-height: {{SIZE}}{{UNIT}}',
                ],
            ]
        );
        $this->add_responsive_control(
            'pre_title_letter_spacing',
            [
                'label' => __( 'Sub Title Letter Spacing', 'templines-helper-core' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min'   => -5,
                        'max'   => 10,
                        'step'  => 0.1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .fl-action-content-meta .sub-title' => 'letter-spacing: {{SIZE}}{{UNIT}}',
                ],
            ]
        );
        $this->add_control(
            'sub_title_transform',
            [
                'label' => __( 'Sub Title Text Transform', 'templines-helper-core' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    ''                              => 'Uppercase',
                    'none'                          => 'None',
                    'capitalize'                    => 'Capitalize',
                    'lowercase'                     => 'Lowercase',
                ],
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .sub-title' => 'text-transform: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_section();
    }

    protected function render() {
        $result = '';
        $this->add_render_attribute( 'wrapper', 'class', 'page-builder-custom-action-content-wrap' );
        $this->add_render_attribute( 'title', 'class', 'title' );
        $this->add_render_attribute( 'sub-title', 'class', 'sub-title fl-primary-color' );
        $settings = $this->get_settings_for_display();
        if ( ! empty( $settings['link']['url'] ) ) {
            $this->add_link_attributes( 'button', $settings['link'] );
        }
        if($settings['title_style']):
            $this->add_render_attribute( 'title', 'class', $settings['title_style']);
        endif;

        if($settings['sub_title_style']):
            $this->add_render_attribute( 'sub-title', 'class', $settings['sub_title_style'] );
        endif;

        $result .= '<div '.$this->get_render_attribute_string('wrapper').'>';
            if(isset($settings['image_bg']['url'])){
                $result .= '<img class="fl_action_content_bg" src="'.$settings['image_bg']['url'].'">';
            }

            $result .='<span class="fl-action-content-meta">';

                if($settings['title']):
                    $result .='<'.$settings['title_size'].' '.$this->get_render_attribute_string( 'title' ).'>';
                    $result .= $settings['title'];
                    $result .='</'.$settings['title_size'].'>';
                endif;

                if($settings['sub_title']):
                    $result .='<span '.$this->get_render_attribute_string( 'sub-title' ).'>'.$settings['sub_title'].'</span>';
                endif;

            $result .='</span>';
        $result .='<a class="fl-action-btn fl-custom-btn " '.$this->get_render_attribute_string('button').'>'.$settings['button_text'].'<div class="button-decor"></div></a>';

        $result .= '</div>';

        echo  $result;

    }
}