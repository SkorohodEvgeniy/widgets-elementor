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

class Templines_Team extends Widget_Base {

    public function get_name() {
        return 'templines-moto-slider';
    }

    public function get_title() {
        return esc_html__( 'Team', 'templines-helper-core' );
    }

    public function get_icon() {
        return 'fa fa-user templines-icon';
    }

    public function get_categories() {
        return array('templines-helper-core-elements');
    }

    protected function register_controls() {
        $this->start_controls_section(
            'section_elementor_team_general_setting',
            [
                'label' => __( 'General Setting', 'templines-helper-core' ),
            ]
        );

        $repeater = new Repeater();
        $repeater->add_control(
            'image',
            [
                'label'             => __( 'Team Image', 'templines-helper-core' ),
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
            'name',
            [
                'label' => __( 'Team Name', 'templines-helper-core' ),
                'type' => Controls_Manager::TEXT,
                'default'   => 'William Benson',
            ]
        );
        $repeater->add_control(
            'profession',
            [
                'label' => 'Profession',
                'type' => Controls_Manager::TEXT,
                'default' => '<p>Company Manager</p>',
            ]
        );
        $repeater->add_control(
            'facebook',
            [
                'label' => __( 'Facebook', 'templines-helper-core' ),
                'type' => Controls_Manager::TEXT,
                'default'   => '#',
            ]
        );
        $repeater->add_control(
            'twitter',
            [
                'label' => __( 'Twitter', 'templines-helper-core' ),
                'type' => Controls_Manager::TEXT,
                'default'   => '#',
            ]
        );
        $repeater->add_control(
            'instagram',
            [
                'label' => __( 'Instagram', 'templines-helper-core' ),
                'type' => Controls_Manager::TEXT,
                'default'   => '#',
            ]
        );
        $repeater->add_control(
            'linkedin',
            [
                'label' => __( 'LinkedIn', 'templines-helper-core' ),
                'type' => Controls_Manager::TEXT,
                'default'   => '#',
            ]
        );


        $this->add_control(
            'team_list',
            [
                'label'       => '',
                'type'        => Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
            ]
        );


        $this->end_controls_section();
    }

    protected function render() {
        $result = '';
        $this->add_render_attribute( 'wrapper', 'class', 'templines-team-wrap' );
        $settings = $this->get_settings_for_display();


        $result .='<div '.$this->get_render_attribute_string('wrapper').'>';
        $size = 'kaskad_size_265x300_crop';

        foreach ( $settings['team_list'] as $index => $item ) :

            $result .='<div class="team-item">';

                if ( $item['image'] ) {
                    $result .='<div class="image-content">';
                    $result .= wp_get_attachment_image( $item[ 'image' ][ 'id' ], $size, false, ['loading' => 'lazy'] );
                        $result .='<div class="social-wrap">';
                            if ( $item['facebook'] ) {
                                $result .= '<a class="fl-social" href="' . esc_url($item['facebook']) . '"><i class="fa fa-facebook" aria-hidden="true"></i></a>';
                            }
                            if ( $item['twitter'] ) {
                                $result .= '<a class="fl-social" href="' . esc_url($item['twitter']) . '"><i class="fa fa-twitter" aria-hidden="true"></i></a>';
                            }
                            if ( $item['instagram'] ) {
                                $result .= '<a class="fl-social" href="' . esc_url($item['instagram']) . '"><i class="fa fa-instagram" aria-hidden="true"></i></a>';
                            }
                            if ( $item['linkedin'] ) {
                                $result .= '<a class="fl-social" href="' . esc_url($item['linkedin']) . '"><i class="fa fa-linkedin" aria-hidden="true"></i></a>';
                            }
                        $result .='</div>';
                    $result .='</div>';
                }
                $result .='<div class="text-content">';
                    if($item['name'] !=''){
                        $result .= '<span class="fl-team-name fl-text-bold-style">'.$item['name'].'</span>';
                    }
                    if($item['profession'] !=''){
                        $result .= '<span class="fl-team-profession">'.$item['profession'].'</span>';
                    }
                $result .='</div>';

            $result .='</div>';

        endforeach;


        $result .='</div>';

        echo  $result;

    }
}