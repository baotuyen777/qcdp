<?php
add_action('widgets_init', create_function('', "register_widget('michael_facebook');"));

class Michael_Facebook extends WP_Widget {

    function Michael_Facebook() {
        $widget_ops = array('classname' => 'michael_facebook-widget', 'description' => __('facebook', 'genesis'));
        $control_ops = array('width' => 505, 'height' => 250, 'id_base' => 'support-online');
        $this->WP_Widget('support-online', __('RT - Hỗ trợ trực tuyến', 'genesis'), $widget_ops, $control_ops);
    }

    function widget($args, $instance) {
        extract($args);
        $instance = wp_parse_args((array) $instance, array(
            'title' => '',
            'number_supporter' => 1,
        ));
        $instance['number_supporter'];
    }

    function update($new_instance, $old_instance) {
        return $new_instance;
    }

    function form($instance) {

        $instance = wp_parse_args((array) $instance, array(
            'title' => '',
            'number_supporter' => 1,
        ));
        ?>


        <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Tiêu đề', 'genesis'); ?>:</label>
            <input type="text" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo esc_attr($instance['title']); ?>" style="width:95%;" /></p>
        <hr />

        <p><label for="<?php echo $this->get_field_id('number_supporter'); ?>"><?php _e('Số hỗ trợ viên', 'genesis'); ?>:</label>
            <textarea id="<?php echo $this->get_field_id('number_supporter'); ?>" name="<?php echo $this->get_field_name('number_supporter'); ?>" />
            <?php echo esc_attr($instance['number_supporter']); ?>
        </textarea>
        </p>
        <?php
    }

}
?>