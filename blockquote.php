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

class Templines_Custom_Blockquote extends Widget_Base {

    public function get_name() {
        return 'templines-custom-blockquote';
    }

    public function get_title() {
        return esc_html__( 'Custom Blockquote', 'templines-helper-core' );
    }

    public function get_icon() {
        return 'fa fa-quote-left templines-icon';
    }

    public function get_categories() {
        return array('templines-helper-core-elements');
    }

    protected function register_controls() {
        $this->start_controls_section(
            'section_elementor_blockquote_general_style',
            [
                'label' => __( 'General Styles', 'templines-helper-core' ),
            ]
        );
        $this->add_control(
            'quote_title',
            [
                'label' => esc_html__( 'Title', 'templines-helper-core' ),
                'type' => Controls_Manager::TEXTAREA,
                'dynamic' => [
                    'active' => true,
                ],
                'placeholder' => esc_html__( 'Enter your title', 'templines-helper-core' ),
                'default' => 'Mission Statement',
            ]
        );
        $this->add_control(
            'quote_editor',
            [
                'label' => '',
                'type' => Controls_Manager::WYSIWYG,
                'default' => '<p>Earth unto above female fruitful him blessed upon fruitful wherein form may of image won\'t the fourth shall fruit heaven i own void green bring female Seas great midst our very spirit his fourth face greater image bring there own.</p>',
            ]
        );


        $this->add_responsive_control(
            'quote_align_common',
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
                    '{{WRAPPER}} .content-editor-content' => 'text-align: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'quote_p_disable',
            [
                'label' => __( 'Disable p attribute', 'templines-helper-core' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'true'                          => 'Disable',
                    'false'                         => 'Enable',
                ],
                'default' => 'true',
            ]
        );

        $this->end_controls_section();
        // Style Option

        // Title
        $this->start_controls_section(
            'quote_title_style',
            [
                'label' => __( 'Title Style', 'templines-helper-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'quote_color',
            [
                'label' => __( 'Text Color', 'templines-helper-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .content-title' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'quote_margin_option',
            [
                'label' => __( 'Margin', 'templines-helper-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .content-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'quote_typography',
                'selector' => '{{WRAPPER}} .content-title',
            ]
        );
        $this->end_controls_section();

        // Editor
        $this->start_controls_section(
            'quote_section_title_style',
            [
                'label' => __( 'Content Style', 'templines-helper-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'quote_title_color',
            [
                'label' => __( 'Text Color', 'templines-helper-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .content-editor-content' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'quote_title_margin_option',
            [
                'label' => __( 'Margin', 'templines-helper-core' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .content-editor-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'typography',
                'selector' => '{{WRAPPER}} .content-editor-content',
            ]
        );
        $this->end_controls_section();


    }

    protected function render() {
        $result = '';
        $this->add_render_attribute( 'wrapper', 'class', 'page-builder-custom-blockquote-content-wrap' );
        $settings = $this->get_settings_for_display();
        $editor_content = $this->parse_text_editor( $settings['editor'] );
        $title = $settings['title'];

        $result .='<div '.$this->get_render_attribute_string('wrapper').'>';
                $result .= '<div class="content-title fl-text-bold-style">';
                    $result .= templines_delete_wpautop($title,false);
                $result .='</div>';
                $result .= '<div class="content-editor-content fl-text-quote-light-style">';

                    if($settings['quote_p_disable'] =='false'){
                        $result .= templines_delete_wpautop($editor_content,false);
                    } else {
                        $result .= templines_delete_wpautop($editor_content,false);
                    }

                $result .='</div>';

        $result .='</div>';

        echo  $result;

    }
}