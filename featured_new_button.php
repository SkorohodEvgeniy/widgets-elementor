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
class Templines_Featured_New_Button extends Widget_Base {

    public function get_name() {
        return 'templines-button-new';
    }

    public function get_title() {
        return esc_html__( 'Button new', 'templines-helper-core' );
    }

    public function get_icon() {
        return 'fa fa-link templines-icon';
    }

    public function get_categories() {
        return array('templines-helper-core-elements');
    }
	
	public function get_style_depends() {

		wp_register_style( 'featured_reviews', plugins_url( '../assets/css/featured_new_button.css', __FILE__ ) );

		return [
			'featured_reviews',
		];

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
                    '{{WRAPPER}} .wrapper_link' => 'text-align: {{VALUE}};',
                ],
            ]
        );
		
			$this->add_control(
            'icon_svg_three',
            [
                'label'            => __( 'Icon', 'templines-helper-core' ),
                'type'             => \Elementor\Controls_Manager::ICONS,
                'default'          => [
                    'value'   => 'fas fa-star',
                    'library' => 'fa-solid',
                ]
            ]
        );

        $this->add_control(
            'image_three',
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
                'selector' => '{{WRAPPER}} .link__template',
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
                    '{{WRAPPER}} .link__template' => 'color: {{VALUE}}',
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
                    '{{WRAPPER}} .link__template:hover' => 'color: {{VALUE}}',
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
                    '{{WRAPPER}} .link__template' => 'background-color: {{VALUE}}',
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
                    '{{WRAPPER}} .link__template:hover' => 'background-color: {{VALUE}}',
                ],
                'default' => '#4da1f4'
            ]
        );


        $this->end_controls_section();
    }

    protected function render() {
		$this->add_render_attribute( 'wrapper', 'class', 'wrapper_link' );
		$this->add_render_attribute( 'button', 'class', 'link__template d-flex align-items-center justify-content-center' );
        $settings = $this->get_settings_for_display(); ?>
		
			<div <?php echo $this->get_render_attribute_string( 'wrapper' ); ?>>
				<a href="<?php echo $settings['link'];?>" <?php echo $this->get_render_attribute_string( 'button' ); ?>>
                    <div class="text"><?php echo $settings['button_text'];?></div>
					<?php if( $settings['icon_svg_three']['value'] == !''  ){
					
						echo '<span class="d-flex align-items-center justify-content-center" >';
							\Elementor\Icons_Manager::render_icon( $settings['icon_svg_three'], [ 'aria-hidden' => 'true' ]  ); 
						echo '</span>';
					} ?>
                </a>
			</div>	
<?php
    }

	
}
