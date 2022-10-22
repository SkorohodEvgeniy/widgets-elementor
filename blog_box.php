<?php
use Elementor\Control_Media;
use Elementor\Group_Control_Image_Size;
use Elementor\Icons_Manager;
use Elementor\Utils;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;


if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Templines_Blog_Box extends Widget_Base {

    public function get_name() {
        return 'templines-blog-box';
    }

    public function get_title() {
        return esc_html__( 'Blog Box', 'templines-helper-core' );
    }

    public function get_icon() {
        return 'fa fa-newspaper-o templines-icon';
    }

    public function get_categories() {
        return array('templines-helper-core-elements');
    }

    protected function register_controls() {

        $this->start_controls_section(
            'section_elementor_blog_box_general',
            [
                'label' => __( 'General Blog Box Setting', 'templines-helper-core' ),
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
            'title_style',
            [
                'label'   => __( 'Title Short', 'templines-helper-core' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'enable',
                'options' => [
                    'enable'              =>         esc_attr__('Enable','templines-helper-core'),
                    'disable'                =>         esc_attr__('Disable','templines-helper-core'),
                ],
            ]
        );

        $this->end_controls_section();

    }

    protected function render() {
        $this->add_render_attribute( 'wrapper', 'class', 'page-builder-blog-box-wrap' );
        $settings = $this->get_settings_for_display();
        ?>
        <div <?php echo $this->get_render_attribute_string('wrapper');?>>
            <?php
            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
            $args = array(
                'post_type'                 => 'post',
                'post_status'               => 'publish',
                'posts_per_page'            => 3,
                'paged'                     => $paged,
                'ignore_sticky_posts' => 1
            );
            $posts = new WP_Query( $args );
            if( $posts->have_posts() ) : while( $posts->have_posts() ) : $posts->the_post();
            ?>
            <?php if(isset($settings['blog_style']) && $settings['blog_style'] == 'style_one'){?>
                <article <?php post_class('fl-post--item col-4') ?> id="post-<?php the_ID() ?>" data-post-id="<?php the_ID() ?>">
                    <?php if(has_post_thumbnail()){ ?>
                        <div class="post--holder">
                            <?php echo get_the_post_thumbnail(get_the_ID(), 'kaskad_size_360x300_crop'); ?>
                            <a class="image-post-link" href="<?php echo esc_url(the_permalink()); ?>">
                            </a>
                        </div>
                    <?php } ?>
                    <div class="post-bottom-content">
                        <div class="post-top-info">
                            <?php
                            $check_cats = get_the_terms(get_the_ID(), 'category');
                            if(!empty($check_cats) && $check_cats != null){?>
                                <div class="post-info-category">
                                    <!--Category -->
                                    <?php the_category(' ', '');?>
                                    <!--Category end-->
                                </div>
                            <?php } ?>
                            <?php
                            $author_id = get_post_field( 'post_author', get_the_ID() );
                            $author_name = get_the_author_meta('display_name', $author_id);
                            ?>
                            <span class="author-link">
                                <a href="<?php echo  esc_url(get_author_posts_url($author_id), 'templines-helper-core')?>">
                                    <?php echo esc_attr($author_name, 'templines-helper-core');?>
                                </a>
                            </span>
                        </div>
                        <h3 class="post--title">
                            <?php $title = get_the_title( get_the_ID() );?>
                            <a class="title-link"
                               href="<?php esc_url(the_permalink()); ?>">

                                <?php if ($settings['title_style'] == 'enable'){?>
                                    <?php echo fl_japanworm_shorten_title($title); ?>
                                <?php } else { ?>
                                    <?php echo esc_html($title); ?>
                                <?php } ?>

                            </a>
                        </h3>
                    </div>
                    <div class="post-bottom-button">
                        <div class="post-text--content">
                            <?php echo templines_limit_excerpt(15); ?>
                        </div>
                    </div>
                </article>
            <?php } elseif(isset($settings['blog_style']) && $settings['blog_style'] == 'style_two') {?>
                <article <?php post_class('fl-post--item-two col-4') ?> id="post-<?php the_ID() ?>" data-post-id="<?php the_ID() ?>">
                        <?php if(has_post_thumbnail()){ ?>
                            <div class="post--holder">
                                <?php echo get_the_post_thumbnail(get_the_ID(), 'kaskad_size_360x300_crop'); ?>
                                <a class="image-post-link" href="<?php echo esc_url(the_permalink()); ?>">
                                </a>
                            </div>
                        <?php } ?>
                        <div class="post-bottom-content">
                            <div class="post-top-info">

                                <?php
                                $author_id = get_post_field( 'post_author', get_the_ID() );
                                $author_name = get_the_author_meta('display_name', $author_id);
                                ?>
                                <span class="author-link">
                                    <a href="<?php echo  esc_url(get_author_posts_url($author_id), 'templines-helper-core')?>">
                                        <i class="kaskad-user"></i>
                                        <?php echo esc_attr($author_name, 'templines-helper-core');?>
                                    </a>
                                </span>

                                <!--Date -->
                                <div class="post-date-content">
                                    <i class="kaskad-date"></i>
                                    <span><?php echo esc_attr(get_the_date());?></span>
                                </div>
                                <!--Date end-->
                            </div>
                            <h3 class="post--title">
                                <?php $title = get_the_title( get_the_ID() );?>
                                <a class="title-link"
                                   href="<?php esc_url(the_permalink()); ?>">
                                    <?php if ($settings['title_style'] == 'enable'){?>
                                        <?php echo fl_japanworm_shorten_title($title); ?>
                                    <?php } else { ?>
                                        <?php echo esc_html($title); ?>
                                    <?php } ?>
                                </a>
                            </h3>
                        </div>
                        <div class="post-bottom-button">
                            <div class="post-text--content">
                                <?php echo templines_limit_excerpt(15); ?>
                            </div>
                            <div class="post-btn-read-more">
                                <a class="fl-custom-btn" href="<?php the_permalink(); ?>">
                                    <span><?php echo esc_html__('Read More', 'templines-helper-core') ?></span>
                                </a>
                            </div>
                        </div>

                    </article>
            <?php } elseif(isset($settings['blog_style']) && $settings['blog_style'] == 'style_three') {?>
                <article <?php post_class('fl-post--item-three col-4') ?> id="post-<?php the_ID() ?>" data-post-id="<?php the_ID() ?>">
                        <?php if(has_post_thumbnail()){ ?>
                            <div class="post--holder">
                                <?php echo get_the_post_thumbnail(get_the_ID(), 'kaskad_size_360x300_crop'); ?>
                                <a class="image-post-link" href="<?php echo esc_url(the_permalink()); ?>">
                                </a>
                            </div>
                        <?php } ?>
                        <div class="post-bottom-content">
                            <div class="post-top-info">
                                <?php
                                $check_cats = get_the_terms(get_the_ID(), 'category');
                                if(!empty($check_cats) && $check_cats != null){?>
                                    <div class="post-info-category">
                                        <!--Category -->
                                        <?php the_category('|', '');?>
                                        <!--Category end-->
                                    </div>
                                <?php } ?>

                                <!--Date -->
                                <div class="post-date-content">
                                    <span><?php echo esc_attr(get_the_date());?></span>
                                </div>
                                <!--Date end-->
                            </div>
                            <h3 class="post--title">
                                <?php $title = get_the_title( get_the_ID() );?>
                                <a class="title-link"
                                   href="<?php esc_url(the_permalink()); ?>">

                                    <?php if ($settings['title_style'] == 'enable'){?>
                                        <?php echo fl_japanworm_shorten_title($title); ?>
                                    <?php } else { ?>
                                        <?php echo esc_html($title); ?>
                                    <?php } ?>
                                </a>
                            </h3>
                            <div class="post-text--content">
                                <?php echo templines_limit_excerpt(15); ?>
                            </div>
                        </div>
                        <div class="post-end-content">
                            <?php
                            $author_id = get_post_field( 'post_author', get_the_ID() );
                            $author_name = get_the_author_meta('display_name', $author_id);
                            ?>
                            <span class="author-link">
                                <a href="<?php echo  esc_url(get_author_posts_url($author_id), 'templines-helper-core')?>">
                                    <i class="kaskad-user"></i>
                                    <?php echo __('By ', 'templines-helper-core') . esc_attr($author_name, 'templines-helper-core');?>
                                </a>
                            </span>
                            <span class="fl-post-comments">
                                <i class="fa fa-comment-o"></i>
                                <span class="comments-wrap">
                                    <?php echo get_comments_number(get_the_ID());?>
                                </span>
                           </span>

                        </div>
                    </article>
            <?php } ?>
            <?php
            endwhile; endif;
            wp_reset_query();
                ?>
        </div>

<?php

    }
}