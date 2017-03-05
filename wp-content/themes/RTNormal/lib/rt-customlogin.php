<?php
function rt_login_logo() { ?>

<link rel='stylesheet' href='<?php echo get_stylesheet_directory_uri(); ?>/lib/css/login.css' type='text/css' media='all' />

<?php }

add_action( 'login_enqueue_scripts', 'rt_login_logo' );

?>