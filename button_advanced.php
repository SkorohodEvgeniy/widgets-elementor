<?php
use Elementor\Control_Media;
use Elementor\Group_Control_Image_Size;
use Elementor\Icons_Manager;
use Elementor\Utils;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;

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
class Templines_Button_Advanced extends Widget_Base {

    public function get_name() {
        return 'templines-button';
    }

    public function get_title() {
        return esc_html__( 'Button Advanced', 'templines-helper-core' );
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
            'button_size',
            [
                'label' => __( 'Button Size', 'templines-helper-core' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'small-size'                => __( 'Small', 'templines-helper-core' ),
                    ''                          => __( 'Normal', 'templines-helper-core' ),
                    'large-size'                => __( 'Large', 'templines-helper-core' ),
                ],
                'default' => '',
            ]
        );

        $this->add_control(
            'icon_svg',
            [
                'label'            => __( 'Button Icon', 'templines-helper-core' ),
                'type'             => Controls_Manager::ICONS,
                'label_block'      => true,
                'default'          => [
                    'value'   => 'fas fa-star',
                    'library' => 'fa-solid',
                ],
                'fa4compatibility' => 'icon'
            ]
        );
        $this->add_control(
            'button_text',
            [
                'label' => __( 'Button Text Top', 'templines-helper-core' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Download from', 'templines-helper-core' ),
                'placeholder' => __( 'Enter your button text', 'templines-helper-core' ),
                'description' => __( 'Enter your button text', 'templines-helper-core' ),
                'separator' => 'before',
                'label_block' => true,
            ]
        );

        $this->add_control(
            'button_text_two',
            [
                'label' => __( 'Button Text Bottom', 'templines-helper-core' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'App Store', 'templines-helper-core' ),
                'placeholder' => __( 'Enter your button bottom text', 'templines-helper-core' ),
                'description' => __( 'Enter your button bottom text', 'templines-helper-core' ),
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
        $this->end_controls_section();
    }

    protected function render() {
        $this->add_render_attribute( 'wrapper', 'class', 'page-builder-button-wrap' );
        $this->add_render_attribute( 'button', 'class', 'fl-default-button' );
        $this->add_render_attribute( 'button', 'role', 'button' );
        $settings = $this->get_settings_for_display();
        $icon = '';
        if ( ! empty( $settings['button_style'] ) ) {
            $this->add_render_attribute( 'button', 'class', $settings['button_style'] );
        }
        if ( ! empty( $settings['button_size'] ) ) {
            $this->add_render_attribute( 'button', 'class', $settings['button_size'] );
        }

        if ( ! empty( $settings['link']['url'] ) ) {
            $this->add_link_attributes( 'button', $settings['link'] );
        }

        if ( ! empty( $settings['button_css_id'] ) ) {
            $this->add_render_attribute( 'button', 'id', $settings['button_css_id'] );
        }
        ?>

        <div <?php echo $this->get_render_attribute_string('wrapper')?>>

        <?php if ($settings['icon_svg']){ ?>
            <div class="icon-wrap">
                <?php Icons_Manager::render_icon($settings['icon_svg']);?>
            </div>
        <?php } ?>

        <a <?php echo $this->get_render_attribute_string('button');?>>
            <?php echo $icon; ?>
            <span class="fl-button-text-top"><?php echo $settings['button_text'] ?></span>
            <span class="fl-button-text-bottom"><?php echo $settings['button_text_two'] ?></span>
        </a>

        </div>
<?php

    }
} ?>