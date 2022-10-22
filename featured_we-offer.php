<?php
use Elementor\Control_Media;
use Elementor\Group_Control_Image_Size;
use Elementor\Icons_Manager;
use Elementor\Utils;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;


if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Templines_Featured_Offer extends Widget_Base {

    public function get_name() {
        return 'templines-featured-we-offer';
    }

    public function get_title() {
        return esc_html__( 'Featured We Offer', 'templines-helper-core' );
    }

    public function get_icon() {
        return 'fa fa-newspaper-o templines-icon';
    }

    public function get_categories() {
        return array('templines-helper-core-elements');
    }
	
	public function get_style_depends() {

		wp_register_style( 'featured_we-offer', plugins_url( '../assets/css/featured_we-offer.css', __FILE__ ) );

		return [
			'featured_we-offer',
		];

	}

    protected function register_controls() {

        $this->start_controls_section(
            'section_elementor_blog_box_one', 
            [
                'label' => __( 'List One', 'templines-helper-core' ),
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
            'button_text',
            [
                'label' => __( 'Button text', 'templines-helper-core' ),
                'type' => Controls_Manager::TEXT,
                'placeholder' => __( 'Enter your name category', 'templines-helper-core' ),
                'separator' => 'before',
                'label_block' => true,
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
		
        $this->end_controls_section();
		
		$this->start_controls_section(
            'section_elementor_blog_box_two', 
            [
                'label' => __( 'List Two', 'templines-helper-core' ),
            ]
        );
		
		$this->add_control(
            'icon_svg_two',
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
            'image_two',
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
            'button_text_two',
            [
                'label' => __( 'Button text', 'templines-helper-core' ),
                'type' => Controls_Manager::TEXT,
                'placeholder' => __( 'Enter your name category', 'templines-helper-core' ),
                'separator' => 'before',
                'label_block' => true,
            ]
        );
		
		 $this->add_control(
            'link_two',
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
            'title_two',
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
            'editor_two',
            [
                'label' => 'Icon Box Content',
                'type' => Controls_Manager::WYSIWYG,
                'default' => '<p>Exercitation ullamco laboris nis exa  duis aute irure dolor.</p>',

            ]
        );
		

        $this->end_controls_section();
		
		$this->start_controls_section(
            'section_elementor_blog_box_three', 
            [
                'label' => __( 'List Three', 'templines-helper-core' ),
            ]
        );
		
		$this->add_control(
            'icon_svg_three',
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
            'button_text_three',
            [
                'label' => __( 'Button text', 'templines-helper-core' ),
                'type' => Controls_Manager::TEXT,
                'placeholder' => __( 'Enter your name category', 'templines-helper-core' ),
                'separator' => 'before',
                'label_block' => true,
            ]
        );
		
		 $this->add_control(
            'link_three',
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
            'title_three',
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
            'editor_three',
            [
                'label' => 'Icon Box Content',
                'type' => Controls_Manager::WYSIWYG,
                'default' => '<p>Exercitation ullamco laboris nis exa  duis aute irure dolor.</p>',

            ]
        );

        $this->end_controls_section();
		

    }

    protected function render() {
        $this->add_render_attribute( 'wrapper', 'class', 'page-builder-blog-box-wrap' );
        $settings = $this->get_settings_for_display();
        ?>
            
			<div class="row we__offer-item">
              <div class="col-12 col-lg-4 p-0 m-0">
                <div class="we__offer-card d-flex flex-column">
					<div class="icon_offer">
						<?php if($settings['image']['url']): ?>
							<img class="icon_box_image" src="<?php echo esc_url($settings['image']['url']);?>" height="230"/>
						<?php endif; ?>
						<?php if($settings['icon_svg']):
							echo '<div class="icon-wrap">';
							Icons_Manager::render_icon( $settings['icon_svg']);
							echo '</div>';
						endif; ?>
					
					</div>
                  <h5 class="title"><?php echo $settings['title'];?></h5>
				  
					
					
						<p class="text">
							<?php echo $settings['editor']; ?>
						</p>
					
                  <a href="<?php echo $settings['link']['url'];?>"><?php echo $settings['button_text'];?></a>
                </div>
              </div>
              <div class="col-12 col-lg-4 p-0 m-0">
                <div class="we__offer-card d-flex flex-column">
					<div class="icon_offer">
						<?php if($settings['image_two']['url']): ?>
							<img class="icon_box_image" src="<?php echo esc_url($settings['image_two']['url']);?>" height="230"/>
						<?php endif; ?>
						<?php if($settings['icon_svg_two']):
							echo '<div class="icon-wrap">';
							Icons_Manager::render_icon( $settings['icon_svg_two']);
							echo '</div>';
						endif; ?>
					
					</div>
                  <h5 class="title"><?php echo $settings['title_two'];?></h5>

						<p class="text">
							<?php echo $settings['editor_two']; ?>
						</p>
					
                  <a href="<?php echo $settings['link_two']['url'];?>"><?php echo $settings['button_text_two'];?></a>
                </div>
              </div>
              <div class="col-12 col-lg-4 p-0 m-0">
                <div class="we__offer-card d-flex flex-column">
					<div class="icon_offer">
						<?php if($settings['image_three']['url']): ?>
							<img class="icon_box_image" src="<?php echo esc_url($settings['image_two_three']['url']);?>" height="230"/>
						<?php endif; ?>
						<?php if($settings['icon_svg_three']):
							echo '<div class="icon-wrap">';
							Icons_Manager::render_icon( $settings['icon_svg_three']);
							echo '</div>';
						endif; ?>
					
					</div>
                  <h5 class="title"><?php echo $settings['title_three'];?></h5>
					
						<p class="text">
							<?php echo $settings['editor_three']; ?>
						</p>
					
                  <a href="<?php echo $settings['link_three']['url'];?>"><?php echo $settings['button_text_three'];?></a>
                </div>
              </div>
            </div>

<?php

    }
}