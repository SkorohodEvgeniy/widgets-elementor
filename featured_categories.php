<?php
use Elementor\Control_Media;
use Elementor\Group_Control_Image_Size;
use Elementor\Icons_Manager;
use Elementor\Utils;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;


if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Templines_Featured_Categories extends Widget_Base {

    public function get_name() {
        return 'templines-featured-categories';
    }

    public function get_title() {
        return esc_html__( 'Featured categories', 'templines-helper-core' );
    }

    public function get_icon() {
        return 'fa fa-newspaper-o templines-icon';
    }

    public function get_categories() {
        return array('templines-helper-core-elements');
    }
	
	public function get_style_depends() {

		wp_register_style( 'featured_categories-w', plugins_url( '../assets/css/featured_categories.css', __FILE__ ) );

		return [
			'featured_categories-w',
		];

	}

    protected function register_controls() {

        $this->start_controls_section(
            'section_elementor_blog_box_general',
            [
                'label' => __( 'General Blog Box Setting', 'templines-helper-core' ),
            ]
        );

         $this->add_control(
            'image',
            [
                'label' => __( 'Choose Image', 'templines-helper-core' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );
		
		$this->add_group_control(
			\Elementor\Group_Control_Image_Size::get_type(),
			[
				'name' => 'image',
				'default' => 'full',
				'separator' => 'none',
			]
		);
		
		 $this->add_control(
            'link',
            [
                'label' => __( 'Link', 'templines-helper-core' ),
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
            'button_text',
            [
                'label' => __( 'Name Category', 'templines-helper-core' ),
                'type' => Controls_Manager::TEXT,
                'placeholder' => __( 'Enter your name category', 'templines-helper-core' ),
                'separator' => 'before',
                'label_block' => true,
            ]
        );
		
		$this->add_control(
            'button_text_two',
            [
                'label' => __( 'Subtitle', 'templines-helper-core' ),
                'type' => Controls_Manager::TEXT,
                'placeholder' => __( 'Enter your subtitle text', 'templines-helper-core' ),
                'separator' => 'before',
                'label_block' => true,
            ]
        );

        $this->end_controls_section();

    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        ?>
            
			<div class="featured__category">
				<div class="cat_img">
					<div class="col_img">
						<a href="<?php echo $settings['link']['url'] ?>" >
						<?php	echo \Elementor\Group_Control_Image_Size::get_attachment_image_html( $settings ); ?>
						<div class="cat_text">
							<h3 class="title"><?php echo $settings['button_text'] ?></h3>
							<p class="text"><?php echo $settings['button_text_two'] ?></p>
						</div>
						</a>
					</div>
				</div>
            </div>

<?php

    }
	
	protected function content_template() {
		?>
		<#
		var image = {
			id: settings.image.id,
			url: settings.image.url,
			size: settings.image_size,
			dimension: settings.image_custom_dimension,
			model: view.getEditModel()
		};

		var image_url = elementor.imagesManager.getImageUrl( image );

		if ( ! image_url ) {
			return;
		}
		#>
		<img src="{{{ image_url }}}" />
		<?php
	}
}