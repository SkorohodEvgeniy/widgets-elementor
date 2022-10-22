<?php
use Elementor\Control_Media;
use Elementor\Core\Base\Document;
use Elementor\Group_Control_Image_Size;
use Elementor\Icons_Manager;
use Elementor\Utils;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use ElementorPro\Modules\QueryControl\Module as QueryControlModule;
use ElementorPro\Plugin;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Templines_Testimonial_Slider extends Widget_Base {

    public function get_name() {
        return 'templines-testimonial-slider';
    }

    public function get_title() {
        return esc_html__( 'Testimonial Slider', 'templines-helper-core' );
    }

    public function get_icon() {
        return 'fa fa-star-o templines-icon';
    }

    public function get_categories() {
        return array('templines-helper-core-elements');
    }


    protected function register_controls() {
        $this->start_controls_section(
            'section_elementor_testimonial_slider_general_setting',
            [
                'label' => __( 'General Setting', 'templines-helper-core' ),
            ]
        );

        $this->add_control(
            'testimonials_style',
            [
                'label'   => __( 'Testimonials Style', 'templines-helper-core' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'style_one',
                'options' => [
                    'style_one'              =>         esc_attr__('Style One','templines-helper-core'),
                    'style_two'                =>         esc_attr__('Style Two','templines-helper-core'),
                ],
            ]
        );

        $this->add_control(
            'testimonials_controls_style',
            [
                'label'   => __( 'Control Style', 'templines-helper-core' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'dots',
                'options' => [
                    'dots'              =>         esc_attr__('Dots','templines-helper-core'),
                    'arrows'                =>         esc_attr__('Arrows','templines-helper-core'),
                ],
            ]
        );


        $repeater = new Repeater();
        $repeater->add_control(
            'image',
            [
                'label'             => __( 'Image Avatar', 'templines-helper-core' ),
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
        $repeater->add_control(
            'editor',
            [
                'label' => 'Content',
                'type' => Controls_Manager::WYSIWYG,
                'default' => '<p>Magna aliqua quis nostrud exercitation ullamco laboris nisut aliqua yxa consequat duis aute irure dolor iny reprehenderit voluptate velit esse cilum dols sed ipsum nulla pariatur nostrul doney quis nostrud saercitation ullamco laboris nisi ut aliquip reprehenderit.</p>',
            ]
        );
        $repeater->add_control(
            'name',
            [
                'label' => __( 'Name', 'templines-helper-core' ),
                'type' => Controls_Manager::TEXT,
                'default'   => 'JOHN MARTIN',
            ]
        );
        $repeater->add_control(
            'after_name',
            [
                'label' => __( 'After Name Text', 'templines-helper-core' ),
                'type' => Controls_Manager::TEXT,
                'default'   => 'KTM Motorcycle Buyer',
            ]
        );


        $this->add_control(
            'testimonial_slider_list',
            [
                'label'       => '',
                'type'        => Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'default'     => [
                    [
                        'editor'                => '<p>Magna aliqua quis nostrud exercitation ullamco laboris nisut aliqua yxa consequat duis aute irure dolor iny reprehenderit voluptate velit esse cilum dols sed ipsum nulla pariatur nostrul doney quis nostrud saercitation ullamco laboris nisi ut aliquip reprehenderit.</p>',
                        'name'                  => 'JOHN MARTIN',
                        'after_name'            =>'KTM Motorcycle Buyer',
                     ],
                    [
                        'editor'                => '<p>Magna aliqua quis nostrud exercitation ullamco laboris nisut aliqua yxa consequat duis aute irure dolor iny reprehenderit voluptate velit esse cilum dols sed ipsum nulla pariatur nostrul doney quis nostrud saercitation ullamco laboris nisi ut aliquip reprehenderit.</p>',
                        'name'                  => 'JOHN MARTIN',
                        'after_name'            => 'Ducati Motorcycle Buyer',
                    ],

                ],
                'title_field' => '{{{ name }}}',
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $result = '';
        $slider_class = uniqid('fl-testimonials-slider-').'-'.rand(100,9999);;

        $this->add_render_attribute( 'wrapper', 'class', 'templines-testimonials-slider-wrap' );
        $this->add_render_attribute( 'wrapper_slider', 'class', 'fl-testimonials-slider '.$slider_class );
        $settings = $this->get_settings_for_display();
        $size = 'kaskad_size_100x100_crop';
        $size_two = 'kaskad_size_size_50x50_crop';

        if(isset($settings['testimonials_controls_style']) && $settings['testimonials_controls_style'] == 'dots'){
            $dots = 'dots: true,';
            $arrows = 'arrows: false,';
            $css_class = 'arrows_false';
        } elseif (isset($settings['testimonials_controls_style']) && $settings['testimonials_controls_style'] == 'arrows'){
            $dots = 'dots: false,';
            $arrows = 'arrows: true,';
            $css_class = '';
        }

        if(isset($settings['testimonials_style']) && $settings['testimonials_style'] == 'style_one'){
            $result .='<div '.$this->get_render_attribute_string('wrapper').'>';

            $result .='<div '.$this->get_render_attribute_string('wrapper_slider').'>';

            foreach ( $settings['testimonial_slider_list'] as $index => $item ) :
                $editor_content = $this->parse_text_editor( $item['editor'] );
                $result .='<div class="slider-item">';
                $result .='<div class="fl-testimonial-image">';
                if ( $item['image'] ) {
                    $result .='<div class="entry-content">';
                    $result .= wp_get_attachment_image( $item[ 'image' ][ 'id' ], $size, false, ['loading' => 'lazy'] );
                    $result .='</div>';
                }
                $result .='</div>';

                $result .='<div class="fl-testimonial-content">';
                $result .='<div class="title-wrap">';
                if($editor_content!=''){
                    $result .= '<div class="fl-content fl-font-style-medium">'.templines_delete_wpautop($editor_content,true).'</div>';
                }
                if($item['name']!=''){
                    $result .= '<div class="fl-name fl-font-style-medium">';
                    $result .= templines_delete_wpautop($item['name'],true);
                    $result .= '<div class="fl-testimonial-stars">';
                    $result .= '<i class="fa fa-star" aria-hidden="true"></i>';
                    $result .= '<i class="fa fa-star" aria-hidden="true"></i>';
                    $result .= '<i class="fa fa-star" aria-hidden="true"></i>';
                    $result .= '<i class="fa fa-star" aria-hidden="true"></i>';
                    $result .= '<i class="fa fa-star" aria-hidden="true"></i>';
                    $result .= '</div>';
                    $result .= '</div>';
                }
                if($item['after_name']!=''){
                    $result .= '<div class="fl-name-prof fl-font-style-medium">'.templines_delete_wpautop($item['after_name'],true).'</div>';
                }
                $result .='</div>';
                $result .='</div>';

                $result .='</div>';

            endforeach;
            $result .='</div>';
            $result .= '<div class="fl-testimonials-arrows ' . $css_class . '">
                                <span class="fl-testimonials-arrows-left"><i class="fa fa-angle-left" aria-hidden="true"></i></span>
                                <span class="fl-testimonials-arrows-right"><i class="fa fa-angle-right" aria-hidden="true"></i></span>
                            </div>';
            $result .= '    <script>
                                    jQuery.noConflict()(function ($){ 
                                         var testimonials_slider = $(\'.' . $slider_class . '\');  
                                         testimonials_slider.slick({ 
                                                    '. $dots . $arrows .'
                                                    autoplay: false,
                                                    autoplaySpeed: 6000,
                                                    speed: 500,
                                                    slidesToShow: 3,
                                                    slidesToScroll: 1,
                                                    draggable: true,
                                                    centerMode: true,
                                                    infinite: true,
                                                    prevArrow: ".fl-testimonials-arrows-left",
                                                    nextArrow: ".fl-testimonials-arrows-right",
                                                    responsive: [           
                                                        {
                                                          breakpoint: 1300,
                                                          settings: {
                                                            slidesToShow: 2,
                                                            slidesToScroll: 1,
                                                            variableWidth: false, 
                                                            centerMode: false,
                                                          }
                                                        },
                                                         {
                                                          breakpoint: 768,
                                                          settings: {
                                                            slidesToShow: 1,
                                                            slidesToScroll: 1,
                                                            variableWidth: false, 
                                                            centerMode: true,
                                                          }
                                                        },
                                                    ]
                                         })
                                     });
                                </script>';
            $result .='</div>';
        } elseif(isset($settings['testimonials_style']) && $settings['testimonials_style'] == 'style_two') {

            $result .='<div '.$this->get_render_attribute_string('wrapper').'>';

                $result .='<div '.$this->get_render_attribute_string('wrapper_slider').'>';
                    foreach ( $settings['testimonial_slider_list'] as $index => $item ) :
                        $editor_content = $this->parse_text_editor( $item['editor'] );

                        $result .='<div class="slider-item-two">';
                            $result .='<div class="fl-testimonial-image">';
                            if ( $item['image'] ) {
                                $result .='<div class="entry-content">';
                                $result .= wp_get_attachment_image( $item[ 'image' ][ 'id' ], $size_two, false, ['loading' => 'lazy'] );
                                $result .='</div>';
                            }

                            $result .='<div class="tm-entry-content">';
                            if($item['name']!=''){
                                $result .= '<div class="fl-name fl-font-style-medium">';
                                $result .= templines_delete_wpautop($item['name'],true);

                                $result .= '</div>';
                            }
                            if($item['after_name']!=''){
                                $result .= '<div class="fl-name-prof fl-font-style-medium">'.templines_delete_wpautop($item['after_name'],true).'</div>';
                                $result .= '<div class="fl-testimonial-stars">';
                                $result .= '<i class="fa fa-star" aria-hidden="true"></i>';
                                $result .= '<i class="fa fa-star" aria-hidden="true"></i>';
                                $result .= '<i class="fa fa-star" aria-hidden="true"></i>';
                                $result .= '<i class="fa fa-star" aria-hidden="true"></i>';
                                $result .= '<i class="fa fa-star" aria-hidden="true"></i>';
                                $result .= '</div>';
                            }
                            $result .='</div>';
                            $result .='</div>';
                            if($editor_content!=''){
                                $result .= '<div class="fl-content fl-font-style-medium">'.templines_delete_wpautop($editor_content,true).'</div>';
                            }
                        $result .='</div>';
                    endforeach;
                $result .='</div>';
            $result .= '<div class="fl-testimonials-arrows ' . $css_class . '">
                                <span class="fl-testimonials-arrows-left"><i class="fa fa-angle-left" aria-hidden="true"></i></span>
                                <span class="fl-testimonials-arrows-right"><i class="fa fa-angle-right" aria-hidden="true"></i></span>
                            </div>';
            $result .= '    <script>
                                    jQuery.noConflict()(function ($){ 
                                         var testimonials_slider = $(\'.' . $slider_class . '\');  
                                         testimonials_slider.slick({ 
                                                    '. $dots . $arrows .'
                                                    autoplay:false,
                                                    autoplaySpeed: 6000,
                                                    speed: 500,
                                                    slidesToShow: 2,
                                                    slidesToScroll: 1,
                                                    draggable: true,
                                                    centerMode: true,
                                                    infinite: true,
                                                    prevArrow: ".fl-testimonials-arrows-left",
                                                    nextArrow: ".fl-testimonials-arrows-right",
                                                    responsive: [           
                                                        {
                                                          breakpoint: 1340,
                                                          settings: {
                                                            slidesToShow: 2,
                                                            slidesToScroll: 1,
                                                            variableWidth: false, 
                                                            centerMode: true,
                                                          }
                                                        },
                                                         {
                                                          breakpoint: 768,
                                                          settings: {
                                                            slidesToShow: 1,
                                                            slidesToScroll: 1,
                                                            variableWidth: false, 
                                                            centerMode: true,
                                                          }
                                                        },
                                                    ]
                                         })
                                     });
                                </script>';
            $result .='</div>';

        }



        echo  $result;

    }
}