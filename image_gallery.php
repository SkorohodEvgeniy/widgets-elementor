<?php
use Elementor\Control_Media;
use Elementor\Group_Control_Image_Size;
use Elementor\Icons_Manager;
use Elementor\Utils;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Templines_Image_Gallery extends Widget_Base {

    public function get_name() {
        return 'templines-image-gallery';
    }

    public function get_title() {
        return esc_html__( 'Image Gallery', 'templines-helper-core' );
    }

    public function get_icon() {
        return 'fa fa-file-image-o templines-icon';
    }

    public function get_categories() {
        return array('templines-helper-core-elements');
    }

    protected function register_controls() {
        $this->start_controls_section(
            'section_elementor_image_gallery_general_setting',
            [
                'label' => __( 'General Setting', 'templines-helper-core' ),
            ]
        );

        $repeater = new Repeater();
        $repeater->add_control(
            'image_title',
            [
                'label' => __( 'Image Title', 'templines-helper-core' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Image Title', 'templines-helper-core' ),
            ]
        );
        $repeater->add_control(
            'image',
            [
                'label'             => __( 'Choose Image 1', 'templines-helper-core' ),
                'type'              => Controls_Manager::MEDIA,
                'label_block'       => true,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );
        $repeater->add_group_control(
            Group_Control_Image_Size::get_type(), [
                'name' => 'image', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `testimonial_image_size` and `testimonial_image_custom_dimension`.
                'default' => 'full',
            ]
        );

        $this->add_control(
            'gallery_item_list',
            [
                'label'       => '',
                'type'        => Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'default'     => [
                    [
                        'image_title' => __('Image Title One', 'templines-helper-core' ),
                    ],
                    [
                        'image_title' => __('Image Title Two', 'templines-helper-core' ),
                    ],
                    [
                        'image_title' => __('Image Title Three', 'templines-helper-core' ),
                    ],
                ],
                'title_field' => '{{{ image_title }}}',
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $result = '';
        $idf_gallery_popup = uniqid('fl-magnific-popup').'-'.rand(100,9999);
        $this->add_render_attribute( 'wrapper', 'class', 'fl-gallery fl-magic-popup fl-gallery-popup '.$idf_gallery_popup.'' );
        $this->add_render_attribute( 'wrapper', 'data-custom-class', ''.$idf_gallery_popup.'' );


        $settings = $this->get_settings_for_display();

        $result .='<div class="page-builder-image-gallery-wrap">';

        $result .='<div '.$this->get_render_attribute_string('wrapper').'>';
        $s = 1;
        foreach ( $settings['gallery_item_list'] as $index => $item ) :

            if($s == 1){
                $size = 'kaskad_size_555x250_crop';
            } elseif ($s == 2){
                $size = 'kaskad_size_330x255_crop';
                $result .= '<div class="fl-image-row">';
            } elseif ($s == 3){
                $size = 'kaskad_size_190x200_crop';
            }

            if ( $item['image'] ) {

                $result .='<a class="gallery-builder-item image-item" href="'.wp_get_attachment_image_url($item['image']['id'], 'full').'">';
                    $result .='<div class="entry-content">';
                        $result .= wp_get_attachment_image( $item[ 'image' ][ 'id' ], $size, false, ["class" => "img-scale"], ['loading' => 'lazy'] );
                     $result .='</div>';
                $result .='</a>';

            }
            if($s == 3 ){
                $s = 0;
                $result .= '</div>';
            }

            $s++;
        endforeach;

        $result .='</div>';

        $result .='</div>';

        echo  $result;

    }
}