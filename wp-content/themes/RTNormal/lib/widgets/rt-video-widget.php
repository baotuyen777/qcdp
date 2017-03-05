<?php

	register_widget('Video');

class Video extends WP_Widget {

 
    function video() {
		$widget_ops = array('classname' => 'video_widget', 'description' => __( 'Add Video', 'rt') );
        parent::WP_Widget(false, $name = __('Video', 'rt'), $widget_ops);
		$this->alt_option_name = 'Rt_video';

		
			
    }
	
	
	function form($instance) {

	// giá trị
		$title     = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$url    = isset( $instance['url'] ) ? esc_url( $instance['url'] ) : '';
	?>

	<p>
	<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Tiêu đề Video', 'genesis'); ?></label>
	<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
	</p>

	<p><label for="<?php echo $this->get_field_id( 'url' ); ?>"><?php _e( 'Link Video', 'genesis' ); ?></label>
	<input class="widefat" id="<?php echo $this->get_field_id( 'url' ); ?>" name="<?php echo $this->get_field_name( 'url' ); ?>" type="text" value="<?php echo esc_url($url); ?>" size="3" /></p>
	
	<?php
	}

	
	function widget($args, $instance) {
		$video = array();
		if ( ! $this->is_preview() ) {
			$video = wp_cache_get( 'Rt_video', 'widget' );
		}

		if ( ! is_array( $video ) ) {
			$video = array();
		}

		if ( ! isset( $args['widget_id'] ) ) {
			$video['widget_id'] = $this->id;
		}

		if ( isset( $video[ $args['widget_id'] ] ) ) {
			echo $video[ $args['widget_id'] ];
			return;
		}

		ob_start();
		extract($args);

		$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : '';

		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

		$url   = isset( $instance['url'] ) ? esc_url( $instance['url'] ) : '';

		echo $before_widget;
		
		if ( $title ) echo $before_title . $title . $after_title;
		
		if( ($url) ) {
			echo wp_oembed_get($url);
		}
		echo $after_widget;


		if ( ! $this->is_preview() ) {
			$video[ $args['widget_id'] ] = ob_get_flush();
			wp_cache_set( 'Rt_video', $video, 'widget' );
		} else {
			ob_end_flush();
		}
	}
	
}	