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

class Templines_Custom_Text_Editor extends Widget_Base {

    public function get_name() {
        return 'templines-custom-text-editor';
    }

    public function get_title() {
        return esc_html__( 'Custom Text Editor', 'templines-helper-core' );
    }

    public function get_icon() {
        return 'fa fa-text-width templines-icon';
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
        $this->add_control(
            'editor',
            [
                'label' => '',
                'type' => Controls_Manager::WYSIWYG,
                'default' => '<p>Earth unto above female fruitful him blessed upon fruitful wherein form may of image won\'t the fourth shall fruit heaven i own void green bring female Seas great midst our very spirit his fourth face greater image bring there own.</p>',
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
                    '{{WRAPPER}} .content-editor-content' => 'text-align: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'p_disable',
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
            'section_title_style',
            [
                'label' => __( 'Style', 'templines-helper-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'title_color',
            [
                'label' => __( 'Text Color', 'templines-helper-core' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .content-editor-content' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'title_margin_option',
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
        $this->add_render_attribute( 'wrapper', 'class', 'page-builder-custom-text-editor-content-wrap' );
        $settings = $this->get_settings_for_display();
        $editor_content = $this->parse_text_editor( $settings['editor'] );


        $result .='<div '.$this->get_render_attribute_string('wrapper').'>';

                $result .= '<div class="content-editor-content">';

                    if($settings['p_disable'] =='false'){

                        $result .= templines_delete_wpautop($editor_content,false);

                    } else {

                        $result .= templines_delete_wpautop($editor_content,true);

                    }

                $result .='</div>';

        $result .='</div>';

        echo  $result;

    }
}