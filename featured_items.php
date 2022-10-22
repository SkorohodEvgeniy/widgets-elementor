<?php
use Elementor\Control_Media;
use Elementor\Group_Control_Image_Size;
use Elementor\Icons_Manager;
use Elementor\Utils;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;


if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Templines_Featured_Items extends Widget_Base {

    public function get_name() {
        return 'templines-featured-items';
    }

    public function get_title() {
        return esc_html__( 'Featured items', 'templines-helper-core' );
    }

    public function get_icon() {
        return 'fa fa-newspaper-o templines-icon';
    }

    public function get_categories() {
        return array('templines-helper-core-elements');
    }

	public function get_style_depends() {

		wp_register_style( 'featured_items-w', plugins_url( '../assets/css/featured_items.css', __FILE__ ) );

		return [
			'featured_items-w',
		];

	}

    protected function register_controls() {

        $this->start_controls_section(
            'section_elementor_blog_box_general',
            [
                'label' => __( 'General Featured Items Setting', 'templines-helper-core' ),
            ]
        );
		
		$this->add_control(
            'blog_style',
            [
                'label'   => __( 'Blog Style', 'templines-helper-core' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'style_one',
                'options' => [
                    'style_one'              =>         esc_attr__('Style One','templines-helper-core'),
                    'style_two'                =>         esc_attr__('Style Two','templines-helper-core'),
                    'style_three'                =>         esc_attr__('Style Three','templines-helper-core'),
                ],
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
            'background_color',
            [
                'label' => __( 'Background color', 'templines-helper-core' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'scheme' => [
                    'type' => \Elementor\Core\Schemes\Color::get_type(),
                    'value' => \Elementor\Core\Schemes\Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .hand__picked-item' => 'color: {{VALUE}}',
                ],
                'default' => '#ffffff'
            ]
        );
		
		 $this->add_control(
            'background_color_hv',
            [
                'label' => __( 'Background Hover', 'templines-helper-core' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'scheme' => [
                    'type' => \Elementor\Core\Schemes\Color::get_type(),
                    'value' => \Elementor\Core\Schemes\Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .hand__picked-item:hover' => 'color: {{VALUE}}',
                ],
                'default' => '#ffffff'
            ]
        );
		
		$this->add_control(
            'title_three',
            [
                'label' => __( 'Title', 'templines-helper-core' ),
                'type' => Controls_Manager::TEXT,
                'placeholder' => __( 'Enter your title', 'templines-helper-core' ),
                'separator' => 'before',
                'label_block' => true,
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
		
		
		
       
            <?php
            ?>
            <?php if(isset($settings['blog_style']) && $settings['blog_style'] == 'style_one'){?>
                 <section class="hand__picked">
			  <?php } elseif(isset($settings['blog_style']) && $settings['blog_style'] == 'style_two') {?>	
                 <section class="hand__picked-two">
			  
			<?php } elseif(isset($settings['blog_style']) && $settings['blog_style'] == 'style_three') {?>
                 <section class="hand__picked-three">
                
            <?php } ?>	 
				 
          <div class="container">

            <div class="row gx-0">
              <div class="col">
                <div
                  class="hand__picked-item vehicles d-flex flex-column align-items-center justify-content-center"
                >
                  <div class="icon_item">
						<?php if($settings['image_three']['url']): ?>
							<img class="icon_box_image" src="<?php echo esc_url($settings['image_two_three']['url']);?>" height="230"/>
						<?php endif; ?>
						<?php if($settings['icon_svg_three']):
							echo '<div class="icon-wrap">';
							Icons_Manager::render_icon( $settings['icon_svg_three']);
							echo '</div>';
						endif; ?>
					
					</div>
                  <span class="hand__picked-item--line"></span>
				  
                  <h3 class="hand__picked-item--title"><?php echo $settings['title_three'];?></h3>
				  
				  <?php if(isset($settings['blog_style']) && $settings['blog_style'] == 'style_one'){?>
						<?php echo $settings['editor_three']; ?>
				   <?php } ?>
				   
                </div>
              </div>
               </div>
                   
          </div>
         
        </section>
				
				
          
               
            
           
     

<?php

    }
}