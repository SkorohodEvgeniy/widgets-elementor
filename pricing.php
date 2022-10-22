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

class Templines_Pricing extends Widget_Base {

    public function get_name() {
        return 'templines-pricing';
    }

    public function get_title() {
        return esc_html__( 'Pricing', 'templines-helper-core' );
    }

    public function get_icon() {
        return 'fa fa-user templines-icon';
    }

    public function get_plans() {
        if (class_exists('MemberOrder')) {
            $levels = pmpro_getAllLevels(false, true);

            $levels_array[0] = "Disable";
            foreach ($levels as $value) {
                $levels_array[$value->id] = $value->name;
            }
        }
        return $levels_array;
    }

    public function get_categories() {
        return array('templines-helper-core-elements');
    }

    protected function register_controls() {
        $this->start_controls_section(
            'section_elementor_pricing_general_setting',
            [
                'label' => __( 'General Setting', 'templines-helper-core' ),
            ]
        );

        $this->add_control(
            'premium_pricing',
            [
                'label'   => __( 'Premium Pricing', 'templines-helper-core' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'style-one',
                'options' => [
                    'enable'              =>         esc_attr__('Enable','templines-helper-core'),
                    'disable'              =>         esc_attr__('Disable','templines-helper-core'),
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
                'default' => 'STANDARD',
            ]
        );


        $this->add_control(
            'pricing_prefix',
            [
                'label' => esc_html__( 'Pricing Prefix', 'templines-helper-core' ),
                'type' => Controls_Manager::TEXTAREA,
                'dynamic' => [
                    'active' => true,
                ],
                'placeholder' => esc_html__( 'Enter your preffix', 'templines-helper-core' ),
                'default' => '$',
            ]
        );


        $this->add_control(
            'pricing',
            [
                'label' => esc_html__( 'Pricing', 'templines-helper-core' ),
                'type' => Controls_Manager::TEXTAREA,
                'dynamic' => [
                    'active' => true,
                ],
                'placeholder' => esc_html__( 'Enter your pricing', 'templines-helper-core' ),
                'default' => '29',
            ]
        );

        $this->add_control(
            'pricing_period',
            [
                'label' => esc_html__( 'Pricing Period', 'templines-helper-core' ),
                'type' => Controls_Manager::TEXTAREA,
                'dynamic' => [
                    'active' => true,
                ],
                'placeholder' => esc_html__( 'Enter your pricing period', 'templines-helper-core' ),
                'default' => '/ month',
            ]
        );


        $repeater = new Repeater();
        $repeater->add_control(
            'text_content',
            [
                'label' => __( 'List Text', 'templines-helper-core' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Partnership', 'templines-helper-core' ),
            ]
        );
        $this->add_control(
            'list_fields',
            [
                'label'       => '',
                'type'        => Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),

            ]
        );



        $this->add_control(
            'membership_plans',
            [
                'label'   => __( 'Choose Plans', 'templines-helper-core' ),
                'type'    => Controls_Manager::SELECT,
                'options' => $this->get_plans()
            ]
        );


        $this->add_control(
            'btn_text',
            [
                'label' => esc_html__( 'Pricing Button Text', 'templines-helper-core' ),
                'type' => Controls_Manager::TEXTAREA,
                'dynamic' => [
                    'active' => true,
                ],
                'placeholder' => esc_html__( 'Enter your button text', 'templines-helper-core' ),
                'default' => 'BUY NOW',
            ]
        );

        $this->add_control(
            'link',
            [
                'label' => esc_html__( 'Pricing Button Link', 'templines-helper-core' ),
                'type' => Controls_Manager::TEXTAREA,
                'dynamic' => [
                    'active' => true,
                ],
                'placeholder' => esc_html__( 'Enter your button link', 'templines-helper-core' ),
                'default' => '#',
            ]
        );


        $this->end_controls_section();
    }

    protected function render() {

        $this->add_render_attribute( 'wrapper', 'class', 'fl-pricing--table-wrapper' );
        $settings = $this->get_settings_for_display();


        if($settings['membership_plans'] == 'disable'){
            if(isset($settings['btn_text']) && $settings['btn_text'] != '') {
                $btn = '<a class="fl-custom-btn fl-font-style-bolt-two secondary-style" href="'. esc_url($settings['btn_link']) .'"></a>';
            }
        } else {
            $checkout_page_id = get_option('pmpro_checkout_page_id', true);
            $checkout_page_lnk = get_permalink($checkout_page_id) . '/?level=' . $settings['membership_plans'];
            $checkout_page_title = get_the_title($checkout_page_id);

            if(isset($settings['btn_text']) && $settings['btn_text'] != '') {
                $btn = '<a class="fl-custom-btn fl-font-style-bolt-two secondary-style" href="'. esc_url($checkout_page_lnk) .'"><span>'.$settings['btn_text'].'</span></a>';
            } else {

                $btn = '<a class="fl-custom-btn fl-font-style-bolt-two secondary-style" href="'. esc_url($checkout_page_lnk) .'"><span>'. $checkout_page_title. '</span></a>';
            }
        }


 ?>
        <div <?php echo $this->get_render_attribute_string('wrapper');?>>
            <?php if(isset($settings['premium_pricing']) && $settings['premium_pricing'] == 'enable') {?>
                <div class="pricing--table premium-table">
            <?php } else { ?>
                <div class="pricing--table">
            <?php } ?>

                <?php if(isset($settings['title']) && $settings['title'] != '') { ?>
                    <div class="pricing-title fl-text-bold-style"><?php echo $settings['title'];?></div>
                <?php } ?>

                <?php if(isset($settings['pricing']) && $settings['pricing'] != '') { ?>
                    <div class="pricing fl-text-bold-style"><span class="prefix-price fl-text-light-style"><?php echo $settings['pricing_prefix']?></span><?php echo $settings['pricing'];?></div>
                <?php } ?>


                <?php if(isset($settings['pricing_period']) && $settings['pricing_period'] != '') { ?>
                    <div class="pricing-period fl-text-bold-style"><?php echo $settings['pricing_period'];?></div>
                <?php } ?>

                <?php if(isset($settings['list_fields']) && $settings['list_fields'] != '') { ?>
                    <ul class="pricing-list">
                        <?php foreach($settings['list_fields'] as $fields2) { ?>
                            <?php if(isset($fields2['text_content']) && !empty($fields2['text_content'])) { ?>
                                <li class="list-vc-li fl-text-regular-style"><span class="left-content"><i class="fa fa-check" aria-hidden="true"></i></span><?php echo $fields2['text_content'];?></li>
                           <?php  }  ?>
                        <?php } ?>
                    </ul>
                <?php } ?>

                <?php if(isset($settings['btn_text']) && $settings['btn_text'] != '') { ?>
                    <div class="price-btn-wrap">
                        <?php echo $btn;?>
                    </div>
                <?php } ?>

            </div>
        </div>

<?php
    }
}