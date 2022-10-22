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

class Templines_Contacts extends Widget_Base {

    public function get_name() {
        return 'templines-contacts';
    }

    public function get_title() {
        return esc_html__( 'Contacts', 'templines-helper-core' );
    }

    public function get_icon() {
        return 'fa fa-phone templines-icon';
    }

    public function get_categories() {
        return array('templines-helper-core-elements');
    }


    protected function register_controls() {
        $this->start_controls_section(
            'section_elementor_contacts_general_setting',
            [
                'label' => __( 'General Setting', 'templines-helper-core' ),
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
                'default' => 'Office Address',
            ]
        );
        $repeater->add_control(
            'editor',
            [
                'label' => 'Content',
                'type' => Controls_Manager::WYSIWYG,
                'default' => '4023  Armbrester Drive, <br> Wilmington, CA 90744 - USA',

            ]
        );
        $repeater->add_control(
            'button_text',
            [
                'label' => __( 'Button Text', 'templines-helper-core' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( '', 'templines-helper-core' ),
                'placeholder' => __( 'Enter your button text', 'templines-helper-core' ),
                'description' => __( 'Enter your button text', 'templines-helper-core' ),
                'separator' => 'before',
                'label_block' => true,
            ]
        );
        $repeater->add_control(
            'link',
            [
                'label' => __( 'Button Link', 'templines-helper-core' ),
                'type' => Controls_Manager::URL,
                'dynamic' => [
                    'active' => true,
                ],
                'placeholder' => __( 'https://your-link.com', 'templines-helper-core' ),
                'default' => [
                    'url' => '',
                ],
            ]
        );

        $this->add_control(
            'contacts_list',
            [
                'label'       => '',
                'type'        => Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'default'     => [
                    [
                        'title'           => 'Office Address',
                        'editor'          => '4023  Armbrester Drive, <br> Wilmington, CA 90744 - USA',
                        'button_text'     => '',
                        'link'            =>'',
                    ],

                ],
            ]
        );

        $this->add_control(
            'tw',
            [
                'label' => __( 'Twitter Link', 'templines-helper-core' ),
                'type' => Controls_Manager::TEXT,
                'default'   => '#',
            ]
        );
        $this->add_control(
            'fb',
            [
                'label' => __( 'Facebook Link', 'templines-helper-core' ),
                'type' => Controls_Manager::TEXT,
                'default'   => '#',
            ]
        );
        $this->add_control(
            'ln',
            [
                'label' => __( 'LinkedIn Link', 'templines-helper-core' ),
                'type' => Controls_Manager::TEXT,
                'default'   => '#',
            ]
        );
        $this->add_control(
            'in',
            [
                'label' => __( 'Instagram Link', 'templines-helper-core' ),
                'type' => Controls_Manager::TEXT,
                'default'   => '#',
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        ?>
        <div class="tm-contacts-contain">

                <?php foreach ($settings['contacts_list'] as $item){ ?>
                    <div class="tm-contacts-wrap">
                        <?php if ( ! empty( $item['link']['url'] ) ) {
                            $this->add_link_attributes( 'button', $item['link'] );
                        }?>
                        <div class="icon-box-left-content">
                            <?php if($item['icon_svg']):?>
                                <div class="icon-wrap">
                                    <?php Icons_Manager::render_icon( $item['icon_svg']);?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="icon-box-right-content">

                            <?php if($item['title']):?>
                                <h5 class="icon-box-title fl-font-style-medium">
                                    <?php echo $item['title']?>
                                </h5>
                            <?php endif; ?>

                            <?php if($item['editor']):?>
                                <div class="icon-box-content">
                                    <?php echo templines_delete_wpautop($item['editor'],true);?>
                                </div>
                            <?php endif; ?>

                            <?php if($item['button_text']):?>
                                <a class="fl-icon-box-btn" <?php echo $this->get_render_attribute_string('button');?>><?php echo $item['button_text'];?></a>
                            <?php endif; ?>

                        </div>
                    </div>
                <?php } ?>

        <div class="contacts_socials">

            <?php if(isset($settings['tw']) && $settings['tw'] != ''):?>
                <a class="contacts_social_inner" href="<?php echo esc_url($settings['tw']);?>">
                    <i class="fa fa-twitter" aria-hidden="true"></i>
                </a>
            <?php endif; ?>

            <?php if(isset($settings['fb']) && $settings['fb'] != ''):?>
                <a class="contacts_social_inner" href="<?php echo esc_url($settings['fb']);?>">
                    <i class="fa fa-facebook" aria-hidden="true"></i>
                </a>
            <?php endif; ?>

            <?php if(isset($settings['ln']) && $settings['ln'] != ''):?>
                <a class="contacts_social_inner" href="<?php echo esc_url($settings['ln']);?>">
                    <i class="fa fa-linkedin" aria-hidden="true"></i>
                </a>
            <?php endif; ?>

            <?php if(isset($settings['in']) && $settings['in'] != ''):?>
                <a class="contacts_social_inner" href="<?php echo esc_url($settings['in']);?>">
                    <i class="fa fa-instagram" aria-hidden="true"></i>
                </a>
            <?php endif; ?>
        </div>
        </div>
        <?php
    }
}