<?php
get_header();
do_action('genesis_before_content_sidebar_wrap');
$url = get_stylesheet_directory_uri();
$no_thum = "<img src='" . $url . "/images/custom/no_thumb.png' alt='no_thumb' />";
?>
<div class="content-sidebar-wrap">
    <?php do_action('genesis_before_content'); ?>
    <main class="content" role="main" itemprop="mainContentOfPage" itemscope="itemscope" itemtype="http://schema.org/Blog">
        <?php
        do_action('genesis_before_loop');
        do_action('genesis_before_entry');
        ?>
        <div id="product-detail">
            <?php
            if (have_posts()) : the_post();
                $fields = get_field_objects(); // lay cac tham so, tra ra 1 array
                ?>
                <h1 class="heading"><span><?php the_title(); ?></span></h1>
                <div class="Information">
                    <div class="anhspsp">
                        <a href="#" title="<?php the_title(); ?>">
                            <?php
                            if (has_post_thumbnail())
                                the_post_thumbnail("medium", array("alt" => get_the_title()));
                            else
                                echo $no_thum;
                            ?>
                        </a>
                    </div>
                </div><!--end .Information -->
                <div class="clear"></div>
                <div class="entry-content">
                    <?php
                    the_content();
                    ?>
                </div>
            <?php endif; ?>
        </div><!--End. Product-Detail-->
        <?php
        do_action('genesis_after_loop');
        ?>

    </main><!-- end #content -->
    <?php do_action('genesis_after_content'); ?>
</div><!-- end #content-sidebar-wrap -->
<?php
do_action('genesis_after_content_sidebar_wrap');
get_footer();
?>