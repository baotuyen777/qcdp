<?php
/**
 * RT Option Theme setting
 *
 * @package      RT Option
 * @author       RT Team
 * @copyright    Copyright (c) 2014, RT Team
 */


/* Define our constants
------------------------------------------------------------ */

define( 'RT_SETTINGS_FIELD', 'rt-options' );


/* Setup default options
------------------------------------------------------------ */
function rt_default_theme_options() {
	$options = array(
		'rt_num_home_boxes' => 1,
        'rt_image_banner' => '',
        'rt_adv'		=> 0,
	);
	return apply_filters( 'rt_default_theme_options', $options );
}


function add_my_js(){
	wp_enqueue_script( "my-upload", THEME_URI. "/lib/js/upload.js", array( "jquery" ) );
	wp_enqueue_media();
}
add_action('admin_enqueue_scripts','add_my_js');


/* Sanitize any inputs
------------------------------------------------------------ */

add_action( 'genesis_settings_sanitizer_init', 'rt_sanitize_inputs' );
function rt_sanitize_inputs() {
    genesis_add_option_filter( 'no_html', RT_SETTINGS_FIELD, array( 'rt_num_home_boxes', 'rt_image_banner' ) );
}


/* Register our settings and add the options to the database
------------------------------------------------------------ */

add_action( 'admin_init', 'rt_register_settings' );
function rt_register_settings() {
	register_setting( RT_SETTINGS_FIELD, RT_SETTINGS_FIELD );
	add_option( RT_SETTINGS_FIELD, rt_default_theme_options() );

	if ( genesis_get_option( 'reset', RT_SETTINGS_FIELD ) ) {
		update_option( RT_SETTINGS_FIELD, rt_default_theme_options() );
		genesis_admin_redirect( RT_SETTINGS_FIELD, array( 'reset' => 'true' ) );
		exit;
	}
}


/* Admin notices for when options are saved/reset
------------------------------------------------------------ */
add_action( 'admin_notices', 'rt_theme_settings_notice' );
function rt_theme_settings_notice() {
	if ( ! isset( $_REQUEST['page'] ) || $_REQUEST['page'] != RT_SETTINGS_FIELD )
		return;

	if ( isset( $_REQUEST['reset'] ) && 'true' == $_REQUEST['reset'] )
		echo '<div id="message" class="updated"><p><strong>' . __( 'Reset thành công', 'genesis' ) . '</strong></p></div>';
	elseif ( isset( $_REQUEST['settings-updated'] ) && 'true' == $_REQUEST['settings-updated'] )
		echo '<div id="message" class="updated"><p><strong>' . __( 'Lưu thành công', 'genesis' ) . '</strong></p></div>';
}


/* Register our theme options page
------------------------------------------------------------ */

add_action( 'admin_menu', 'rt_theme_options' );
function rt_theme_options() {
	global $_rt_settings_pagehook;
	$_rt_settings_pagehook = add_menu_page( 'RT Options', 'RT Options', 'manage_options', RT_SETTINGS_FIELD, 'rt_theme_options_page', get_stylesheet_directory_uri().'/images/logort.png',59 );
	//add_action( 'load-'.$_ctsettings_settings_pagehook, 'ctsettings_settings_styles' );
	add_action( 'load-'.$_rt_settings_pagehook, 'rt_settings_scripts' );
	add_action( 'load-'.$_rt_settings_pagehook, 'rt_settings_boxes' );
}


/* Setup our scripts
------------------------------------------------------------ */
function rt_settings_scripts() {
	global $_rt_settings_pagehook;
	wp_enqueue_script( 'common' );
	wp_enqueue_script( 'wp-lists' );
	wp_enqueue_script( 'postbox' );
}


/* Setup our metaboxes
------------------------------------------------------------ */
function rt_settings_boxes() {
	global $_rt_settings_pagehook;
	add_meta_box( 'rt-settings-home', __( 'Thiết lập trang chủ', 'genesis' ), 'rt_settings_home', $_rt_settings_pagehook, 'main' );
	add_meta_box( 'rt-image-banner', __( 'Thiết lập Banner/Logo - Favicon', 'genesis' ), 'rt_image_banner', $_rt_settings_pagehook, 'main' );
	add_meta_box( 'rt-slider-home', __( 'Thiết lập Slider trang chủ', 'genesis' ), 'rt_slider_home', $_rt_settings_pagehook, 'main' );
	add_meta_box( 'rt-adv', __( 'Thiết lập quảng cáo hai bên', 'raothue' ), 'rt_adv', $_rt_settings_pagehook, 'main' );
}


/* Add our custom post metabox for social sharing
------------------------------------------------------------ */
function rt_settings_home() { ?>

	<p><strong><?php _e('Số lượng danh mục sản phẩm: ', 'genesis'); ?></strong>
	<input type="text" name="<?php echo RT_SETTINGS_FIELD; ?>[rt_num_home_boxes]" value="<?php echo esc_attr( gtid_get_option('rt_num_home_boxes') ); ?>" size="1" /><input type="submit" class="button-secondary" value="<?php _e('Lưu lại', 'genesis') ?>" /><br />
	</p>
	<hr />
	<?php
		$total_home_boxes = gtid_get_option('rt_num_home_boxes');
		$total_home_boxes = !isset($total_home_boxes) ? 0 : $total_home_boxes;
		for( $i = 1; $i <= $total_home_boxes; $i++ ) {
			$home_setting_i = 'home_cat_'.$i;
		?>
				<p><?php _e("Chọn danh mục hiển thị ", 'genesis'); echo $i; ?>
	<?php wp_dropdown_categories(array('selected' => gtid_get_option($home_setting_i), 'name' => RT_SETTINGS_FIELD.'['.$home_setting_i.']', 'orderby' => 'Name' , 'hierarchical' => 1, 'show_option_all' => __("Tất cả", 'genesis'), 'hide_empty' => '0' )); ?></p>
			<?php
		}
	?>
	<hr />
	<p><?php _e('Số sản phẩm: ', 'genesis'); ?>

	<input type="text" name="<?php echo RT_SETTINGS_FIELD; ?>[number_home_product]" value="<?php echo esc_attr( gtid_get_option('number_home_product') ); ?>" size="1" /><br />

	</p><!--End_1-->
<hr>
<!-- Box News-->
	<p><strong><?php _e('Số lượng danh mục tin: ', 'genesis'); ?></strong>
	<input type="text" name="<?php echo RT_SETTINGS_FIELD; ?>[rt_num_home_news]" value="<?php echo esc_attr( gtid_get_option('rt_num_home_news') ); ?>" size="1" /><input type="submit" class="button-secondary" value="<?php _e('Lưu lại', 'genesis') ?>" /><br />
	</p>
	<hr />
	<?php
		$total_home_boxes2 = gtid_get_option('rt_num_home_news');
		$total_home_boxes2 = !isset($total_home_boxes2) ? 0 : $total_home_boxes2;
		for( $i2 = 1; $i2 <= $total_home_boxes2; $i2++ ) {
			$home_setting_i2 = 'news_cat_'.$i2;
			?>
				<p><?php _e("Chọn danh mục hiển thị", 'genesis'); echo $i2; ?>
	<?php wp_dropdown_categories(array('selected' => gtid_get_option($home_setting_i2), 'name' => RT_SETTINGS_FIELD.'['.$home_setting_i2.']', 'orderby' => 'Name' , 'hierarchical' => 1, 'show_option_all' => __("Tất cả", 'genesis'), 'hide_empty' => '0','taxonomy'=> 'danhmuc' )); ?></p>
			<?php
		}
	?>
	<hr />
	<p><?php _e('Số tin: ', 'genesis'); ?>

	<input type="text" name="<?php echo RT_SETTINGS_FIELD; ?>[number_home_product2]" value="<?php echo esc_attr( gtid_get_option('number_home_product2') ); ?>" size="1" /><br />

	</p>
	<!--Box News -->

<?php }

function rt_image_banner(){
// Nhúng upload vào theme options
?>
<p>
	<label for="upload_image1"><b>Banner / Logo : </b>
    <input id="upload_image1" type="text" size="36" name="<?php echo RT_SETTINGS_FIELD; ?>[rt_image_banner]" value="<?php echo esc_attr( gtid_get_option('rt_image_banner') ); ?>" />
    <input id="upload_image_button1" class="button" type="button" value="Upload Image" />
    </label>
</p>
<p>
	<label id="rt-favicon" ><b>Favicon ( 32px x 32px ) : </b>
    <input class="rt-value-upload" type="text" size="36" name="<?php echo RT_SETTINGS_FIELD; ?>[rt_image_favicon]" value="<?php echo esc_attr( gtid_get_option('rt_image_favicon') ); ?>" />
    <input id="upload_favicon" class="button rt-upload" type="button" value="Upload" />
    </label> ( .png, .jpg, .ico, .jpeg, .bmp )
	
</p>
<?php
}


// function custom slider

function rt_slider_home(){
?>
<p>
	<label><b><?php _e('Chọn slider hiển thị : ', 'raothue'); ?></b>
		<select id="select-slider" name="<?php echo RT_SETTINGS_FIELD ?>[rt_slider_home]" class='postform'>
			<option value="0"><?php _e('Chọn tên slider', 'raothue'); ?></option>
			<?php
				$sl = new WP_Query('post_type=ml-slider');
				while ( $sl->have_posts() ) : $sl->the_post();
				$id = get_the_ID();
			?>
			<option value="<?php echo $id ?>" <?php if ( $id == gtid_get_option('rt_slider_home') ) echo 'selected="selected"'; ?>><?php the_title() ?></option>
			<?php endwhile; wp_reset_postdata(); ?>
		</select>
		<span> <?php _e('Chọn tên slider đã tạo ở mục ', 'raothue'); ?><b>Meta Slider</b> </span>
    </label>
</p>
<?php
}

function rt_adv() {
	$rt_content_w = gtid_get_option( 'rt_adv_content_w' ) ? gtid_get_option( 'rt_adv_content_w' ) : 980;
	$screen_w = gtid_get_option( 'rt_adv_screen_w' );

	$leftw = gtid_get_option( 'rt_adv_leftw' ) ? gtid_get_option( 'rt_adv_leftw' ) : 100;
	$lefth = gtid_get_option( 'rt_adv_lefth' ) ? gtid_get_option( 'rt_adv_lefth' ) : 500;
	$leftlink = gtid_get_option( 'rt_adv_leftlink' ) ? gtid_get_option( 'rt_adv_leftlink' ) : '#';
	$leftsource = gtid_get_option( 'rt_adv_leftsource' );

	$rightw = gtid_get_option( 'rt_adv_rightw' ) ? gtid_get_option( 'rt_adv_rightw' ) : 100;
	$righth = gtid_get_option( 'rt_adv_righth' ) ? gtid_get_option( 'rt_adv_righth' ) : 500;
	$rightlink = gtid_get_option( 'rt_adv_rightlink' ) ? gtid_get_option( 'rt_adv_rightlink' ) : '#';
	$rightsource = gtid_get_option( 'rt_adv_rightsource' );

	$margint = gtid_get_option( 'rt_adv_margint' ) ? gtid_get_option( 'rt_adv_margint' ) : 80;
	$marginl = gtid_get_option( 'rt_adv_marginl' ) ? gtid_get_option( 'rt_adv_marginl' ) : 10;
	$marginr = gtid_get_option( 'rt_adv_marginr' ) ? gtid_get_option( 'rt_adv_marginr' ) : 10;

	$rt_follow = gtid_get_option( 'rt_adv_follow' ) ? gtid_get_option( 'rt_adv_follow' ) : 0;
	$rt_newtab = gtid_get_option( 'rt_adv_newtab' ) ? gtid_get_option( 'rt_adv_newtab' ) : 0;


?>
<div><input type="checkbox" name="<?php echo RT_SETTINGS_FIELD ?>[rt_adv]" value="1" <?php if ( gtid_get_option('rt_adv') == 1 ) echo 'checked' ?> /><?php _e(' Bật / Tắt', 'raothue'); ?></div>
<?php
	if ( gtid_get_option('rt_adv') == 1 ) :
?>
<div class="rt-wrap-adv">
	<p>
		<span class="sp-left"><?php _e('Hiển thị trên màn hình ', 'raothue'); ?><b style="font-weight:700">>=</b></span>
		<select name="<?php echo RT_SETTINGS_FIELD ?>[rt_adv_screen_w]">
        	<option value="768" <?php if ( $screen_w == '768' ) echo 'selected' ?>>768px</option>
            <option value="1024" <?php if ( $screen_w == '1024' ) echo 'selected' ?>>1024px</option>
            <option value="1280" <?php if ( $screen_w == '1280' ) echo 'selected' ?>>1280px</option>
        </select>
	</p>
	<p><span class="sp-left"><?php _e('Chiều rộng website :', 'raothue'); ?></span> <input type="number" name="<?php echo RT_SETTINGS_FIELD ?>[rt_adv_content_w]" value="<?php echo $rt_content_w ?>" min="480" max="3000" />px</p>
	<p>
		<span class="sp-left"><?php _e('Cách lề ', 'raothue'); ?></span>
		<span class="sp-box"><?php _e('Trái ', 'raothue'); ?><input type="number" name="<?php echo RT_SETTINGS_FIELD ?>[rt_adv_marginl]" value="<?php echo $marginl ?>" min="0" max="1000" />px</span>
		<span class="sp-box"><?php _e('Phải ', 'raothue'); ?><input type="number" name="<?php echo RT_SETTINGS_FIELD ?>[rt_adv_marginr]" value="<?php echo $marginr ?>" min="0" max="1000" />px</span>
		<span class="sp-box"><?php _e('Trên ', 'raothue'); ?><input type="number" name="<?php echo RT_SETTINGS_FIELD ?>[rt_adv_margint]" value="<?php echo $margint ?>" min="0" max="1000" />px</span>
	</p>
	<p>
		<span class="sp-box">Nofollow ? <input type="checkbox" name="<?php echo RT_SETTINGS_FIELD ?>[rt_adv_follow]" value="1" <?php if ( $rt_follow == 1 ) echo 'checked' ?> /></span>
		<span class="sp-box"><?php _e('Mở trong tab mới ? ', 'raothue'); ?><input type="checkbox" name="<?php echo RT_SETTINGS_FIELD ?>[rt_adv_newtab]" value="1" <?php if ( $rt_newtab == 1 ) echo 'checked' ?> /></span>
	</p>
	<div class="box-rt-adv">
		<p><?php _e('<b>Ảnh trái : </b>', 'raothue'); ?></p>
		<p>
			<span class="sp-box"><?php _e('Chiều rộng :', 'raothue'); ?> <input type="number" name="<?php echo RT_SETTINGS_FIELD ?>[rt_adv_leftw]" value="<?php echo $leftw ?>" min="0" max="500" />px</span>
			<span class="sp-box"><?php _e('Chiều cao : ', 'raothue'); ?> <input type="number" name="<?php echo RT_SETTINGS_FIELD ?>[rt_adv_lefth]" value="<?php echo $lefth ?>" min="0" max="500" />px</span>
		</p>
		<p><?php _e('<span class="sp-left">Liên kết : </span>', 'raothue'); ?> <input type="text" size="36" name="<?php echo RT_SETTINGS_FIELD; ?>[rt_adv_leftlink]" value="<?php echo $leftlink; ?>" /> ( http://... )</p>
		<div id="rt-adv-leftsource"><?php _e('<span class="sp-left">Nguồn : </span>', 'raothue'); ?>
			<input class="rt-value-upload" type="text" size="36" name="<?php echo RT_SETTINGS_FIELD; ?>[rt_adv_leftsource]" value="<?php echo $leftsource; ?>" />
			<input id="upload_rt_adv_left" class="button rt-upload" type="button" value="Upload" />
		</div>
	</div> <!-- end box left rt adv -->

	<div class="box-rt-adv">
		<p><?php _e('<b>Ảnh phải : </b>', 'raothue'); ?></p>
		<p>
			<span class="sp-box"><?php _e('Chiều rộng :', 'raothue'); ?> <input type="number" name="<?php echo RT_SETTINGS_FIELD ?>[rt_adv_rightw]" value="<?php echo $rightw ?>" min="0" max="500" />px</span>
			<span class="sp-box"><?php _e('Chiều cao : ', 'raothue'); ?> <input type="number" name="<?php echo RT_SETTINGS_FIELD ?>[rt_adv_righth]" value="<?php echo $righth ?>" min="0" max="500" />px</span>
		</p>
		<p><?php _e('<span class="sp-left">Liên kết : </span>', 'raothue'); ?> <input type="text" size="36" name="<?php echo RT_SETTINGS_FIELD; ?>[rt_adv_rightlink]" value="<?php echo $rightlink; ?>" /> ( http://... )</p>
		<div id="rt-adv-rightsource"><?php _e('<span class="sp-left">Nguồn : </span>', 'raothue'); ?>
			<input class="rt-value-upload" type="text" size="36" name="<?php echo RT_SETTINGS_FIELD; ?>[rt_adv_rightsource]" value="<?php echo $rightsource; ?>" />
			<input id="upload_rt_adv_left" class="button rt-upload" type="button" value="Upload" />
		</div>
	</div> <!-- end box right rt adv -->

</div> <!-- end rt-wrap-adv -->
<?php endif; ?>
<?php
}

/* Set the screen layout to one column
------------------------------------------------------------ */
add_filter( 'screen_layout_columns', 'rt_settings_layout_columns', 10, 2 );
function rt_settings_layout_columns( $columns, $screen ) {
	global $_rt_settings_pagehook;
	if ( $screen == $_rt_settings_pagehook ) {
		$columns[$_rt_settings_pagehook] = 1;
	}
	return $columns;
}


/* Build our theme options page
------------------------------------------------------------ */
function rt_theme_options_page() {
	global $_rt_settings_pagehook, $screen_layout_columns;
	$width = "width: 99%;";
	$hide2 = $hide3 = " display: none;";
	?>
	<div id="rtsettings" class="wrap genesis-metaboxes">
		<form method="post" action="options.php">

			<?php wp_nonce_field( 'closedpostboxes', 'closedpostboxesnonce', false ); ?>
			<?php wp_nonce_field( 'meta-box-order', 'meta-box-order-nonce', false ); ?>
			<?php settings_fields( RT_SETTINGS_FIELD ); ?>

			<?php screen_icon( 'options-general' ); ?>

			<h2 style="line-height:66px;">
				<img style="float:left;width:60px;height:auto;margin-right:16px;" src="<?php echo get_stylesheet_directory_uri(); ?>/images/logort1.png" />
				<?php _e( 'RT Options', 'genesis' ); ?>
			</h2>
			<div style="float:right;margin:40px 8px 0 0">
			<input type="submit" class="button-primary genesis-h2-button" value="<?php _e( 'Lưu lại', 'genesis' ) ?>" />
			<input type="submit" class="button-highlighted genesis-h2-button" name="<?php echo RT_SETTINGS_FIELD; ?>[reset]" value="<?php _e( 'Reset', 'genesis' ); ?>" onclick="return genesis_confirm('<?php echo esc_js( __( 'Bạn có muốn cài đặt lại từ đầu ?', 'genesis' ) ); ?>');" />
			</div>
			<div style="clear:both"></div>
			<div class="metabox-holder">
				<div class="postbox-container" style="<?php echo $width; ?>">
					<?php do_meta_boxes( $_rt_settings_pagehook, 'main', null ); ?>
				</div>
			</div>

			<div class="bottom-buttons">
				<input type="submit" class="button-primary" value="<?php _e('Lưu lại', 'genesis') ?>" />
				<input type="submit" class="button-highlighted" name="<?php echo RT_SETTINGS_FIELD; ?>[reset]" value="<?php _e('Reset', 'genesis'); ?>" />
			</div>

		</form>
	</div>
	<script type="text/javascript">
		//<![CDATA[
		jQuery(document).ready( function($) {
			// close postboxes that should be closed
			$('.if-js-closed').removeClass('if-js-closed').addClass('closed');
			// postboxes setup
			postboxes.add_postbox_toggles('<?php echo $_rt_settings_pagehook; ?>');
		});
		//]]>
	</script>

<?php }