<?php
use Elementor\Control_Media;
use Elementor\Group_Control_Image_Size;
use Elementor\Icons_Manager;
use Elementor\Utils;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;


if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Templines_Moto_Slider_Icon_Template extends Widget_Base {

    public function get_name() {
        return 'templines-moto-slider-icon-template';
    }

    public function get_title() {
        return esc_html__( 'Moto Slider Icon Template', 'templines-helper-core' );
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
            'moto_slider_icon_general_setting',
            [
                'label' => __( 'Icon Setting', 'templines-helper-core' ),
            ]
        );
        $repeater = new Repeater();
        $repeater->add_control(
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

        $repeater->add_control(
            'title',
            [
                'label' => esc_html__( 'Title', 'templines-helper-core' ),
                'type' => Controls_Manager::TEXTAREA,
                'dynamic' => [
                    'active' => true,
                ],
                'placeholder' => esc_html__( 'Enter your title', 'templines-helper-core' ),
                'default' => 'Color',
            ]
        );
        $repeater->add_control(
            'content',
            [
                'label' => esc_html__( 'Content', 'templines-helper-core' ),
                'type' => Controls_Manager::TEXTAREA,
                'dynamic' => [
                    'active' => true,
                ],
                'placeholder' => esc_html__( 'Enter your title', 'templines-helper-core' ),
                'default' => 'Black',
            ]
        );
        $this->add_control(
            'moto_icon_slider_template_list',
            [
                'label'       => '',
                'type'        => Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'default'     => [
                    [
                        'title'     => __('Color', 'templines-helper-core' ),
                        'content'   => __('Black ', 'templines-helper-core' ),
                        'icon_svg'  => '',
                    ],
                    [
                        'title'     => __('Category', 'templines-helper-core' ),
                        'content'   => __('Adventure', 'templines-helper-core' ),
                        'icon_svg'  => '',
                    ],
                    [
                        'title'     => __('Bore/Stroke', 'templines-helper-core' ),
                        'content'   => __('80mm / 49.7mm', 'templines-helper-core' ),
                        'icon_svg'  => '',
                    ],
                    [
                        'title'     => __('Displacement', 'templines-helper-core' ),
                        'content'   => __('999 cc', 'templines-helper-core' ),
                        'icon_svg'  => '',
                    ],
                    [
                        'title'     => __('Engine type', 'templines-helper-core' ),
                        'content'   => __('4-Stroke Cylinder', 'templines-helper-core' ),
                        'icon_svg'  => '',
                    ],

                    [
                        'title'     => __('Engine Power', 'templines-helper-core' ),
                        'content'   => __('205hp (151 kW)', 'templines-helper-core' ),
                        'icon_svg'  => '',
                    ],
                ],
                'title_field' => '{{{ title }}}',
            ]
        );
        $this->end_controls_section();

    }

    protected function render() {
        $i = 0;
        $this->add_render_attribute( 'wrapper', 'class', 'moto-slider-icon-template' );

        $settings = $this->get_settings_for_display();

        echo '<div '.$this->get_render_attribute_string('wrapper').'>';

        echo '<div class="row">';

        foreach ( $settings['moto_icon_slider_template_list'] as $index => $item ) : $i++;
                    if($i % 2){
                        echo  "<div class='col-5 icon-box-slider-container'>";
                    }else{
                        echo "<div class='col-6 icon-box-slider-container'>";
                    }?>

                   <div class="entry-content">

                        <div class="icon-wrap">
                            <?php if ($item['icon_svg']):
                                Icons_Manager::render_icon($item['icon_svg']);
                            endif;?>
                        </div>

                        <div class="content-wrap">
                            <div class="icon-title fl-font-style-medium"><?php echo $item['title'];?></div>
                            <div class="icon-content"><?php echo $item['content'];?></div>
                        </div>

                    </div>
                    </div>
        <?php endforeach;?>

        </div>

        </div>
<?php
    }
}