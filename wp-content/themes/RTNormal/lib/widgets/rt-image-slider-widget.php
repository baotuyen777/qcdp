<?php
add_action('widgets_init', create_function('', "register_widget('GTID_Logo_Slider');"));
class GTID_Logo_Slider extends WP_Widget {

	function GTID_Logo_Slider() {
		$widget_ops = array( 'classname' => 'img-slider', 'description' => __('Logo Slider', 'genesis') );
		$control_ops = array( 'width' => 250, 'height' => 350, 'id_base' => 'imgslide' );
		$this->WP_Widget( 'imgslide', __('Featured - Image Slider', 'genesis'), $widget_ops, $control_ops );
        add_action('wp_enqueue_scripts', array(&$this, 'gtid_scripts'));
	}

	function widget($args, $instance) {
		extract($args);

		// defaults
		$instance = wp_parse_args( (array)$instance, array(
			'title' => '',
            'img_num' => 0
		) );

		echo $before_widget;

            echo $before_title . apply_filters('widget_title', $instance['title']) . $after_title;
            ?>
            <script type="text/javascript">
    			jQuery(document).ready(function() {
    				jQuery("#image-slider").jCarouselLite({
    					speed: 3000,
    					visible: 9,
    					scroll: 1,
                        auto: true,
    					vertical: false,
                        circular: true
    				});
                });
    		</script>
            <div id="imgslider-contain">
                <div id="image-slider">
                    <ul>
                        <?php for($i = 0; $i < $instance['img_num']; $i++) : ?>
                            <li><a href="<?php echo $instance['img_link_'.$i]; ?>" rel="nofollow" target="_blank">
                                <img src="<?php echo $instance['img_src_'.$i]; ?>" alt="Logo" width="99" height="39" />
                            </a></li>
                        <?php endfor; ?>
                    </ul>
                </div>
            </div>
            <?php

		echo $after_widget;
	}

	function update($new_instance, $old_instance) {
		return $new_instance;
	}

	function form($instance) {

		// ensure value exists
		$instance = wp_parse_args( (array)$instance, array(
			'title' => '',
            'link' => '',
            'img_num' => 0
		) );

?>

		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Tiêu đề', 'genesis'); ?>:</label>
		<input type="text" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" style="width:99%;" /></p>

<!--
        <p><label for="<?php echo $this->get_field_id('link'); ?>"><?php _e('Link', 'genesis'); ?>:</label>
		<input type="text" id="<?php echo $this->get_field_id('link'); ?>" name="<?php echo $this->get_field_name('link'); ?>" value="<?php echo esc_attr( $instance['link'] ); ?>" style="width:99%;" /></p>
-->
        <div><label for="<?php echo $this->get_field_id('img_num'); ?>"><?php _e('Số ảnh', 'genesis'); ?>:</label>
		<input type="text" id="<?php echo $this->get_field_id('img_num'); ?>" name="<?php echo $this->get_field_name('img_num'); ?>" value="<?php echo esc_attr( $instance['img_num'] ); ?>" size="2" />

            <p class="alignright">
        		<img alt="" title="" class="ajax-feedback " src="<?php bloginfo('url'); ?>/wp-admin/images/wpspin_light.gif" style="visibility: hidden;" />
        		<input type="submit" value="Save" class="button-primary widget-control-save" id="savewidget" name="savewidget" />
            </p>
        </div>

        <?php for($i = 0; $i < $instance['img_num']; $i++) : ?>
            <div style="background: #F5F5F5; margin-bottom: 10px; padding: 10px;">
                <p><label for="<?php echo $this->get_field_id('img_src_'.$i); ?>"><?php _e('Nguồn ảnh', 'genesis'); echo $i+1; ?>:</label>
		<input type="text" id="<?php echo $this->get_field_id('img_src_'.$i); ?>" name="<?php echo $this->get_field_name('img_src_'.$i); ?>" value="<?php echo esc_attr( $instance['img_src_'.$i] ); ?>" style="width:90%;" /></p>

                <p><label for="<?php echo $this->get_field_id('img_link_'.$i); ?>"><?php _e('Liên kết', 'genesis'); echo $i+1; ?>:</label>
        		<input type="text" id="<?php echo $this->get_field_id('img_link_'.$i); ?>" name="<?php echo $this->get_field_name('img_link_'.$i); ?>" value="<?php echo esc_attr( $instance['img_link_'.$i] ); ?>" style="width:90%;" /></p>
            </div>
        <?php endfor; ?>

	<?php
	}

    function gtid_scripts() {
        wp_enqueue_script('jquery');
        wp_enqueue_script('jcarousellite', CHILD_URL.'/lib/js/jcarousellite_1.0.1.min.js', array('jquery'), '1.0.1');
    }
}