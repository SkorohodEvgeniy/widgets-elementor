<?php
use Elementor\Control_Media;
use Elementor\Group_Control_Image_Size;
use Elementor\Icons_Manager;
use Elementor\Utils;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;


if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Templines_Icon_Box extends Widget_Base {

    public function get_name() {
        return 'templines-icon-box';
    }

    public function get_title() {
        return esc_html__( 'Icon Box', 'templines-helper-core' );
    }

    public function get_icon() {
        return 'fa fa-stop templines-icon';
    }

    public function get_categories() {
        return array('templines-helper-core-elements');
    }

    protected function register_controls() {
        // Sub Title
        $this->start_controls_section(
            'section_elementor_icon_box_general',
            [
                'label' => __( 'General Icon Box Setting', 'templines-helper-core' ),
            ]
        );
        $this->add_control(
            'icon-box-style',
            [
                'label'   => __( 'Icon Box Style', 'templines-helper-core' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'style-one',
                'options' => [
                    'style-one'              =>         esc_attr__('Style One','templines-helper-core'),
                    'style-two'              =>         esc_attr__('Style Two','templines-helper-core'),
                    'style-three'            =>         esc_attr__('Style Three','templines-helper-core'),
                    'style-four'             =>         esc_attr__('Style Four','templines-helper-core'),
                    'style-five'             =>         esc_attr__('Style Five','templines-helper-core'),
                    'style-six'             =>         esc_attr__('Style Six','templines-helper-core'),
                ],
            ]
        );

        $this->add_control(
            'icon_svg',
            [
                'label'            => __( 'Icon', 'templines-helper-core' ),
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
            'image',
            [
                'label' => __( 'Choose Image', 'templines-helper-core' ),
                'type' => Controls_Manager::MEDIA,
                'dynamic' => [
                    'active' => true,
                ],
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'icon-box-style' => array('style-six'),
                ],
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
                'default' => 'Cutting Edge Tech',
            ]
        );
        $this->add_control(
            'editor',
            [
                'label' => 'Icon Box Content',
                'type' => Controls_Manager::WYSIWYG,
                'default' => '<p>Exercitation ullamco laboris nis exa  duis aute irure dolor.</p>',

            ]
        );

        $this->add_control(
            'button_text',
            [
                'label' => __( 'Button Text', 'templines-helper-core' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Get Directions', 'templines-helper-core' ),
                'placeholder' => __( 'Enter your button text', 'templines-helper-core' ),
                'description' => __( 'Enter your button text', 'templines-helper-core' ),
                'separator' => 'before',
                'label_block' => true,
                'condition' => [
                    'icon-box-style' => array('style-two', 'style-three', 'style-six'),
                ],
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
                'condition' => [
                    'icon-box-style' => array('style-two', 'style-three', 'style-six'),
                ],
            ]
        );






        $this->end_controls_section();
        // Style
        // Title
        $this->start_controls_section(
            'section_style',
            [
                'label' => __( 'Style', 'templines-helper-core' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        //Color
        $this->add_control(
            'btn_color',
            [
                'label' => __( 'Button Color', 'templines-helper-core' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'scheme' => [
                    'type' => \Elementor\Core\Schemes\Color::get_type(),
                    'value' => \Elementor\Core\Schemes\Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .fl-icon-box-btn' => 'color: {{VALUE}}',
                ],
                'default' => '#222222'
            ]
        );
        $this->add_control(
            'btn_color_hv',
            [
                'label' => __( 'Button Color Hover', 'templines-helper-core' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'scheme' => [
                    'type' => \Elementor\Core\Schemes\Color::get_type(),
                    'value' => \Elementor\Core\Schemes\Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .fl-icon-box-btn:hover' => 'color: {{VALUE}}',
                ],
                'default' => '#ffffff'
            ]
        );
        //Background
        $this->add_control(
            'btn_bg_color',
            [
                'label' => __( 'Background Color', 'templines-helper-core' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'scheme' => [
                    'type' => \Elementor\Core\Schemes\Color::get_type(),
                    'value' => \Elementor\Core\Schemes\Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .fl-icon-box-btn' => 'background-color: {{VALUE}}',
                ],
                'default' => '#ffffff'
            ]
        );
        $this->add_control(
            'btn_bg_color_hv',
            [
                'label' => __( 'Background Color Hover', 'templines-helper-core' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'scheme' => [
                    'type' => \Elementor\Core\Schemes\Color::get_type(),
                    'value' => \Elementor\Core\Schemes\Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .fl-icon-box-btn:hover' => 'background-color: {{VALUE}}',
                ],
                'default' => '#f44153'
            ]
        );

        $this->end_controls_section();

    }

    protected function render() {
        $this->add_render_attribute( 'wrapper', 'class', 'page-builder-icon-box-wrap' );
        $settings = $this->get_settings_for_display();
        $editor_content = $this->parse_text_editor( $settings['editor'] );
        if($settings['icon-box-style']){
            $this->add_render_attribute( 'wrapper', 'class', 'icon-box-'.$settings['icon-box-style'].'' );
        }
        if ( ! empty( $settings['link']['url'] ) ) {
            $this->add_link_attributes( 'button', $settings['link'] );
        }
        ?>
        <div <?php echo $this->get_render_attribute_string('wrapper');?>>

            <div class="icon-box-left-content">
                <?php if($settings['image']['url']): ?>
                    <img class="icon_box_image" src="<?php echo esc_url($settings['image']['url']);?>" height="230"/>
                <?php endif; ?>
                <?php if($settings['icon_svg']):
                    echo '<div class="icon-wrap">';
                    Icons_Manager::render_icon( $settings['icon_svg']);
                    echo '</div>';
                endif; ?>
            </div>
            <div class="icon-box-right-content">
                <?php if($settings['title']):?>
                    <h5 class="icon-box-title fl-font-style-medium">
                        <?php echo $settings['title']?>
                    </h5>
               <?php endif; ?>
                <?php
                if($editor_content):?>
                <div class="icon-box-content">
                    <?php echo templines_delete_wpautop($editor_content,true);?>
                </div>
                <?php endif; ?>

                <?php if($settings['button_text']):?>
                    <a class="fl-icon-box-btn" <?php echo $this->get_render_attribute_string('button');?>><?php echo $settings['button_text'];?></a>
                <?php endif; ?>
            </div>
        </div>

<?php

    }
}