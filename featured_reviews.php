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

class Templines_Featured_Reviews extends Widget_Base {

    public function get_name() {
        return 'templines-featured-reviews';
    }

    public function get_title() {
        return esc_html__( 'Featured Reviews', 'templines-helper-core' );
    }

    public function get_icon() {
        return 'fa fa-newspaper-o templines-icon';
    }

    public function get_categories() {
        return array('templines-helper-core-elements');
    }

	public function get_style_depends() {

		wp_register_style( 'featured_reviews', plugins_url( '../assets/css/featured_reviews.css', __FILE__ ) );

		return [
			'featured_reviews',
		];

	}
	
	public function get_script_depends() {

		wp_register_script( 'reviews-slick', plugins_url( '../assets/js/reviews/slick.min.js', __FILE__ ) );
		wp_register_script( 'reviews-main', plugins_url( '../assets/js/reviews/main.js', __FILE__ ) );

		return [
			'reviews-slick',
			'reviews-main',
		];

	}

    protected function register_controls() {

        $this->start_controls_section(
            'section_elementor_blog_box_general',
            [
                'label' => __( 'General Featured Items Setting', 'templines-helper-core' ),
            ]
        );
		
		
		

        $this->end_controls_section();

    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        ?>
		
		<div class="reviews__slider">
              <div class="item" style="max-width: 480px">
                <div class="item-card">
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    xmlns:xlink="http://www.w3.org/1999/xlink"
                    width="55"
                    height="30"
                    viewBox="0 0 55 30"
                  >
                    <image
                      id="quotes"
                      width="53"
                      height="28"
                      xlink:href="data:img/png;base64,iVBORw0KGgoAAAANSUhEUgAAADUAAAAcCAMAAAD2mwe8AAAABGdBTUEAALGPC/xhBQAAACBjSFJNAAB6JgAAgIQAAPoAAACA6AAAdTAAAOpgAAA6mAAAF3CculE8AAABL1BMVEUAv/X///8Av/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAAAAC2hbzAAAAY3RSTlMAAB11u+f30pdGAhui/NpWV/KvD3EVWuyJQBoTKmW/yQcg9Y8OROKLaBfXJP6RJZl/EITxBMI57kjTZCm0eKCAmBgnU00GPF3YFLEia/jj3+bvTt0RlAh7LsGoZljwzAkLhfMoV0VnAAAAAWJLR0Rkwtq4CQAAAAlwSFlzAAALEgAACxIB0t1+/AAAAAd0SU1FB+YIEQoUEOqSa+MAAAHLSURBVDjLdZTXQkIxDIbjAJQhgqICIoII6kGGyhLce4t7r77/O5j0rLaUXNAkPx80aRsA0waHhj2MeX0jo35QzT864vMy5hkeGgQYIDPzgWCI2TYWVqDwmKOFggGXGo8w0aITAjMRlbTIuE1NMsV8MQeK+VRx0qSmeDA9E08kZ1NzPEjPW9B8msdzqdlkIj4zzYMpojJZchdy1vcW8xQWrKhAQX7RinILFGYzSPF9L7mFLK9Q2Qb3DWrSyrIrLvG6B8Ao4roq9qyEXWZl7pbR85ZEcRUzRQMqVFNVavUaptY30NlYR29N0qpUWwVq6l/h6dE26ujUyQnIIv1ZDRr42VTOtYW5TVw3cW0pWhNzDaCfaytKB3NbuG7h2lG0NgFaahtzO32oDKd0O7Qp3Q5NStMNh9J1w6Q0nXcoTectqveUXQp2e07ZonpulEiZN2pPQym3V6KU2ytQwkup7h8cHkmU8FJixyclgZJf5WlTpORXWdw9cyllApxfCJQyARqXhkNJ04axq2uBkqYN2o1LOZPtxlFdyp5st11HVG4F3N33UrY9PIb6UPD0nO1HAby89qFws28kvIPWPqjmT60U/2Kdbz0FP79/3fA/Zb/cIuBie4UAAAAASUVORK5CYII="
                    />
                  </svg>
                  <p class="text">
                    Quis nostrud exercitation ullamco laboris nisit aliquip ex
                    ea commodo consequat. Duis aute irure dolor in reprehenderit
                    in voluptate velitse acillum dolore fugiat nulla pariatur.
                  </p>
                  <div class="row g-0">
                    <div class="col-lg-2">
                      <img
                        src="img/customers-1.jpg"
                        class="img-fluid rounded-start"
                        alt="customer"
                      />
                    </div>
                    <div class="col-lg-10">
                      <div class="card-body">
                        <h5 class="card-title mb-0">John McKenzie</h5>
                        <p class="card-text">Customer</p>
                        <img src="img/png/icon-star.png" alt="" />
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="item">
                <div class="item-card">
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    xmlns:xlink="http://www.w3.org/1999/xlink"
                    width="55"
                    height="30"
                    viewBox="0 0 55 30"
                  >
                    <image
                      id="quotes"
                      width="53"
                      height="28"
                      xlink:href="data:img/png;base64,iVBORw0KGgoAAAANSUhEUgAAADUAAAAcCAMAAAD2mwe8AAAABGdBTUEAALGPC/xhBQAAACBjSFJNAAB6JgAAgIQAAPoAAACA6AAAdTAAAOpgAAA6mAAAF3CculE8AAABL1BMVEUAv/X///8Av/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAAAAC2hbzAAAAY3RSTlMAAB11u+f30pdGAhui/NpWV/KvD3EVWuyJQBoTKmW/yQcg9Y8OROKLaBfXJP6RJZl/EITxBMI57kjTZCm0eKCAmBgnU00GPF3YFLEia/jj3+bvTt0RlAh7LsGoZljwzAkLhfMoV0VnAAAAAWJLR0Rkwtq4CQAAAAlwSFlzAAALEgAACxIB0t1+/AAAAAd0SU1FB+YIEQoUEOqSa+MAAAHLSURBVDjLdZTXQkIxDIbjAJQhgqICIoII6kGGyhLce4t7r77/O5j0rLaUXNAkPx80aRsA0waHhj2MeX0jo35QzT864vMy5hkeGgQYIDPzgWCI2TYWVqDwmKOFggGXGo8w0aITAjMRlbTIuE1NMsV8MQeK+VRx0qSmeDA9E08kZ1NzPEjPW9B8msdzqdlkIj4zzYMpojJZchdy1vcW8xQWrKhAQX7RinILFGYzSPF9L7mFLK9Q2Qb3DWrSyrIrLvG6B8Ao4roq9qyEXWZl7pbR85ZEcRUzRQMqVFNVavUaptY30NlYR29N0qpUWwVq6l/h6dE26ujUyQnIIv1ZDRr42VTOtYW5TVw3cW0pWhNzDaCfaytKB3NbuG7h2lG0NgFaahtzO32oDKd0O7Qp3Q5NStMNh9J1w6Q0nXcoTectqveUXQp2e07ZonpulEiZN2pPQym3V6KU2ytQwkup7h8cHkmU8FJixyclgZJf5WlTpORXWdw9cyllApxfCJQyARqXhkNJ04axq2uBkqYN2o1LOZPtxlFdyp5st11HVG4F3N33UrY9PIb6UPD0nO1HAby89qFws28kvIPWPqjmT60U/2Kdbz0FP79/3fA/Zb/cIuBie4UAAAAASUVORK5CYII="
                    />
                  </svg>
                  <p class="text">
                    Quis nostrud exercitation ullamco laboris nisit aliquip ex
                    ea commodo consequat. Duis aute irure dolor in reprehenderit
                    in voluptate velitse acillum dolore fugiat nulla pariatur.
                  </p>
                  <div class="row g-0">
                    <div class="col-lg-2">
                      <img
                        src="img/customers-2.jpg"
                        class="img-fluid rounded-start"
                        alt="customer"
                      />
                    </div>
                    <div class="col-lg-10">
                      <div class="card-body">
                        <h5 class="card-title mb-0">John McKenzie</h5>
                        <p class="card-text">Customer</p>
                        <img src="img/png/icon-star.png" alt="" />
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="item">
                <div class="item-card">
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    xmlns:xlink="http://www.w3.org/1999/xlink"
                    width="55"
                    height="30"
                    viewBox="0 0 55 30"
                  >
                    <image
                      id="quotes"
                      width="53"
                      height="28"
                      xlink:href="data:img/png;base64,iVBORw0KGgoAAAANSUhEUgAAADUAAAAcCAMAAAD2mwe8AAAABGdBTUEAALGPC/xhBQAAACBjSFJNAAB6JgAAgIQAAPoAAACA6AAAdTAAAOpgAAA6mAAAF3CculE8AAABL1BMVEUAv/X///8Av/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAAAAC2hbzAAAAY3RSTlMAAB11u+f30pdGAhui/NpWV/KvD3EVWuyJQBoTKmW/yQcg9Y8OROKLaBfXJP6RJZl/EITxBMI57kjTZCm0eKCAmBgnU00GPF3YFLEia/jj3+bvTt0RlAh7LsGoZljwzAkLhfMoV0VnAAAAAWJLR0Rkwtq4CQAAAAlwSFlzAAALEgAACxIB0t1+/AAAAAd0SU1FB+YIEQoUEOqSa+MAAAHLSURBVDjLdZTXQkIxDIbjAJQhgqICIoII6kGGyhLce4t7r77/O5j0rLaUXNAkPx80aRsA0waHhj2MeX0jo35QzT864vMy5hkeGgQYIDPzgWCI2TYWVqDwmKOFggGXGo8w0aITAjMRlbTIuE1NMsV8MQeK+VRx0qSmeDA9E08kZ1NzPEjPW9B8msdzqdlkIj4zzYMpojJZchdy1vcW8xQWrKhAQX7RinILFGYzSPF9L7mFLK9Q2Qb3DWrSyrIrLvG6B8Ao4roq9qyEXWZl7pbR85ZEcRUzRQMqVFNVavUaptY30NlYR29N0qpUWwVq6l/h6dE26ujUyQnIIv1ZDRr42VTOtYW5TVw3cW0pWhNzDaCfaytKB3NbuG7h2lG0NgFaahtzO32oDKd0O7Qp3Q5NStMNh9J1w6Q0nXcoTectqveUXQp2e07ZonpulEiZN2pPQym3V6KU2ytQwkup7h8cHkmU8FJixyclgZJf5WlTpORXWdw9cyllApxfCJQyARqXhkNJ04axq2uBkqYN2o1LOZPtxlFdyp5st11HVG4F3N33UrY9PIb6UPD0nO1HAby89qFws28kvIPWPqjmT60U/2Kdbz0FP79/3fA/Zb/cIuBie4UAAAAASUVORK5CYII="
                    />
                  </svg>
                  <p class="text">
                    Quis nostrud exercitation ullamco laboris nisit aliquip ex
                    ea commodo consequat. Duis aute irure dolor in reprehenderit
                    in voluptate velitse acillum dolore fugiat nulla pariatur.
                  </p>
                  <div class="row g-0">
                    <div class="col-lg-2">
                      <img
                        src="img/customers-3.jpg"
                        class="img-fluid rounded-start"
                        alt="customer"
                      />
                    </div>
                    <div class="col-lg-10">
                      <div class="card-body">
                        <h5 class="card-title mb-0">John McKenzie</h5>
                        <p class="card-text">Customer</p>
                        <img src="img/png/icon-star.png" alt="" />
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="item">
                <div class="item-card">
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    xmlns:xlink="http://www.w3.org/1999/xlink"
                    width="55"
                    height="30"
                    viewBox="0 0 55 30"
                  >
                    <image
                      id="quotes"
                      width="53"
                      height="28"
                      xlink:href="data:img/png;base64,iVBORw0KGgoAAAANSUhEUgAAADUAAAAcCAMAAAD2mwe8AAAABGdBTUEAALGPC/xhBQAAACBjSFJNAAB6JgAAgIQAAPoAAACA6AAAdTAAAOpgAAA6mAAAF3CculE8AAABL1BMVEUAv/X///8Av/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAv/UAAAAC2hbzAAAAY3RSTlMAAB11u+f30pdGAhui/NpWV/KvD3EVWuyJQBoTKmW/yQcg9Y8OROKLaBfXJP6RJZl/EITxBMI57kjTZCm0eKCAmBgnU00GPF3YFLEia/jj3+bvTt0RlAh7LsGoZljwzAkLhfMoV0VnAAAAAWJLR0Rkwtq4CQAAAAlwSFlzAAALEgAACxIB0t1+/AAAAAd0SU1FB+YIEQoUEOqSa+MAAAHLSURBVDjLdZTXQkIxDIbjAJQhgqICIoII6kGGyhLce4t7r77/O5j0rLaUXNAkPx80aRsA0waHhj2MeX0jo35QzT864vMy5hkeGgQYIDPzgWCI2TYWVqDwmKOFggGXGo8w0aITAjMRlbTIuE1NMsV8MQeK+VRx0qSmeDA9E08kZ1NzPEjPW9B8msdzqdlkIj4zzYMpojJZchdy1vcW8xQWrKhAQX7RinILFGYzSPF9L7mFLK9Q2Qb3DWrSyrIrLvG6B8Ao4roq9qyEXWZl7pbR85ZEcRUzRQMqVFNVavUaptY30NlYR29N0qpUWwVq6l/h6dE26ujUyQnIIv1ZDRr42VTOtYW5TVw3cW0pWhNzDaCfaytKB3NbuG7h2lG0NgFaahtzO32oDKd0O7Qp3Q5NStMNh9J1w6Q0nXcoTectqveUXQp2e07ZonpulEiZN2pPQym3V6KU2ytQwkup7h8cHkmU8FJixyclgZJf5WlTpORXWdw9cyllApxfCJQyARqXhkNJ04axq2uBkqYN2o1LOZPtxlFdyp5st11HVG4F3N33UrY9PIb6UPD0nO1HAby89qFws28kvIPWPqjmT60U/2Kdbz0FP79/3fA/Zb/cIuBie4UAAAAASUVORK5CYII="
                    />
                  </svg>
                  <p class="text">
                    Quis nostrud exercitation ullamco laboris nisit aliquip ex
                    ea commodo consequat. Duis aute irure dolor in reprehenderit
                    in voluptate velitse acillum dolore fugiat nulla pariatur.
                  </p>
                  <div class="row g-0">
                    <div class="col-lg-2">
                      <img
                        src="img/customers-2.jpg"
                        class="img-fluid rounded-start"
                        alt="customer"
                      />
                    </div>
                    <div class="col-lg-10">
                      <div class="card-body">
                        <h5 class="card-title mb-0">John McKenzie</h5>
                        <p class="card-text">Customer</p>
                        <img src="img/png/icon-star.png" alt="" />
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="news__pagination">
              <div class="slider-dots-box"></div>
            </div>
		
     

<?php

    }
}