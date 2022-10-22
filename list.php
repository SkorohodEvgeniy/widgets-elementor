<?php
use Elementor\Control_Media;
use Elementor\Group_Control_Image_Size;
use Elementor\Icons_Manager;
use Elementor\Utils;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;






if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Templines_List extends Widget_Base {

    public function get_name() {
        return 'templines-list-box';
    }

    public function get_title() {
        return esc_html__( 'List', 'templines-helper-core' );
    }

    public function get_icon() {
        return 'fa fa-list-ol tm-icon';
    }

    public function get_categories() {
        return array('templines-helper-core-elements');
    }



    protected function register_controls() {
        // Sub Title
        $this->start_controls_section(
            'section_elementor_list_general',
            [
                'label' => __( 'General List Setting', 'templines-helper-core' ),
            ]
        );
        $this->add_control(
            'list-style',
            [
                'label'   => __( 'List Style', 'templines-helper-core' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'style-one',
                'options' => [
                    'style-one'              =>         esc_attr__('Style One','templines-helper-core'),
                    'style-two'              =>         esc_attr__('Style Two','templines-helper-core'),
                ],
            ]
        );


        $repeater = new Repeater();
        $repeater->add_control(
            'list_title',
            [
                'label' => __( 'List Title', 'templines-helper-core' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Partnership', 'templines-helper-core' ),
            ]
        );



        $this->add_control(
            'list_item_list',
            [
                'label'       => '',
                'type'        => Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),

            ]
        );

        //Color

        $this->add_control(
            'list_title_color',
            [
                'label' => __( 'Title Color', 'templines-helper-core' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'scheme' => [
                    'type' => \Elementor\Core\Schemes\Color::get_type(),
                    'value' => \Elementor\Core\Schemes\Color::COLOR_1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .list-item a' => 'color: {{VALUE}}',
                ],
                'default' => '#222222'
            ]
        );


        $this->end_controls_section();

    }

    protected function render() {
        $settings = $this->get_settings_for_display(); ?>
        <?php if($settings['list-style'] == 'style-one'){?>
            <ul class="about_list">
                <?php foreach ($settings['list_item_list'] as $key => $item){?>
                    <li class="list-item">
                        <svg aria-hidden="true" focusable="false" data-prefix="fal" data-icon="arrow-right" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="svg-inline--fa fa-arrow-right fa-w-14">
                            <path fill="currentColor" d="M216.464 36.465l-7.071 7.07c-4.686 4.686-4.686 12.284 0 16.971L387.887 239H12c-6.627 0-12 5.373-12 12v10c0 6.627 5.373 12 12 12h375.887L209.393 451.494c-4.686 4.686-4.686 12.284 0 16.971l7.071 7.07c4.686 4.686 12.284 4.686 16.97 0l211.051-211.05c4.686-4.686 4.686-12.284 0-16.971L233.434 36.465c-4.686-4.687-12.284-4.687-16.97 0z" class=""></path>
                        </svg>
                        <a><?php echo esc_attr($item['list_title']);?></a>
                    </li>
                <?php } ?>
            </ul>
        <?php } elseif ($settings['list-style'] == 'style-two'){?>
            <ul class="about_list_two">
                <?php foreach ($settings['list_item_list'] as $key => $item){?>
                    <li class="list-item">
                        <i class="fa fa-check" aria-hidden="true"></i>
                        <a><?php echo esc_attr($item['list_title']);?></a>
                    </li>
                <?php } ?>
            </ul>
        <?php } ?>
    <?php }
}