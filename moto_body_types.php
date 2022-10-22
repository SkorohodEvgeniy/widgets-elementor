<?php
use Elementor\Control_Media;
use Elementor\Group_Control_Image_Size;
use Elementor\Icons_Manager;
use Elementor\Utils;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Templines_Moto_Body_Types extends Widget_Base {

    public function get_name() {
        return 'templines-moto-body-types';
    }

    public function get_title() {
        return esc_html__( 'Moto Body Types', 'templines-helper-core' );
    }

    public function get_icon() {
        return 'fa fa-motorcycle templines-icon';
    }

    public function get_categories() {
        return array('templines-helper-core-elements');
    }
    public function get_select_categories() {
        $args = array( 'taxonomy' => 'auto-body', 'hide_empty' => '0');
        $auto_categories = get_categories($args);
        $auto_cats = array();
        $i = 0;
        foreach($auto_categories as $category){
            if(is_object($category)){
                $auto_cats[$category->name] = $category->slug;
            }
        }
        return $auto_cats;
    }
    public function get_optionasd() {
        return new PIXAD_Settings();
    }
    protected function register_controls() {

        $this->start_controls_section(
            'section_elementor_text_editor_general_style',
            [
                'label' => __( 'General Styles', 'templines-helper-core' ),
            ]
        );

        $this->add_control(
            'category_body_types',
            [
                'label' => esc_html__( 'Body Types', 'templines-helper-core' ),
                'type' => Controls_Manager::SELECT2,
                'options' => $this->get_select_categories(),
                'multiple' => true,
                'description' => __( 'Select body types to show', 'templines-helper-core' ),
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $result = '';
        $this->add_render_attribute( 'wrapper', 'class', 'page-builder-moto-body-types-wrap' );
        $settings = $this->get_settings_for_display();


        $result .='<div '.$this->get_render_attribute_string('wrapper').'>';

        $include = array();
        foreach ( $settings['category_body_types'] as $element ) {
            $include = $element;
        }
        $pixadSettings = new PIXAD_Settings();
        $options = $pixadSettings->getSettings( 'WP_OPTIONS', '_pixad_autos_settings', true );
        $url_page_listings = get_page_uri( $options['autos_listing_car_page']);

        $args = array( 'taxonomy' => 'auto-model', 'hide_empty' => '0', 'include' => implode(',', $include));
        $autos_categories = get_categories ($args);
        if( $autos_categories ):
            foreach($autos_categories as $auto_cat) :
                $auto_t_id = $auto_cat->term_id;
                $auto_cat_meta = get_option("auto_model_$auto_t_id");
                $auto_cat_thumb_url = get_option("pixad_model_thumb$auto_t_id");
                //	$auto_link = get_term_link( $auto_cat ); // OLD

                $auto_link = home_url() . '/' .  $url_page_listings . '/?make=' . $auto_cat->slug ; // NEW

                if($auto_cat_thumb_url){
                    $img_src = wp_get_attachment_image_src( attachment_url_to_postid( $auto_cat_thumb_url ), 'autozone-model-thumb' );
                }else{
                    $img_src[0] = ''.get_template_directory_uri().'/img/brand-logo.jpg' ;
                }
                $result .= '
				
				
			<div class="models_list_item">
			 <a class="mli_link" href="'.esc_url($auto_link).'">
				<div class="mli_img_wrapper" style="background-image: url('.esc_url($img_src[0]).');">
					
				</div>
				<span class="mli_title">
					'.wp_kses_post($auto_cat->name).'
				</span>
				</a>
			</div>
	';
            endforeach;
        endif;

        $result .='</div>';

        echo  $result;

    }
}