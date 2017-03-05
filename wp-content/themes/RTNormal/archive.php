<?php
get_header();
do_action('genesis_before_content_sidebar_wrap');
$url = get_stylesheet_directory_uri();
$current_cat_id = get_query_var('cat');
$no_thum = "<img src='" . $url . "/images/custom/no_thumb.png' alt='no_thumb' />";
?>
<div class="content-sidebar-wrap">
    <?php do_action('genesis_before_content');
    ?>
    <main class="content" role="main" itemprop="mainContentOfPage" itemscope="itemscope" itemtype="http://schema.org/Blog">
        <?php
        do_action('genesis_before_loop');
        ?>
        <div id="home-news">
            <?php
            $category = get_categories('child_of=' . $current_cat_id . '&hide_empty=0');
            if (count($category) != 0) {
                ?>
                <h1 class="heading"><span><?php echo get_cat_name($current_cat_id); ?></span></h1>
                <div class="wrap_post_items cat_item">
                    <?php
                    foreach ($category as $list) {
                        $child = new WP_Query('cat=' . $list->cat_ID . '&showposts=20');
                        ?>
                        <div class="img-category">
                            <div class="category_image">
                                <a href="<?php echo get_category_link($list->cat_ID); ?>" title="<?php echo get_cat_name($list->cat_ID); ?>" class="img">
                                    <img src="<?php echo z_taxonomy_image_url($list->cat_ID); ?>" />
                                </a>
                            </div>
                            <h2>  
                                <a class="product-title" href="<?php echo get_category_link($list->cat_ID); ?>">
                                    <?php echo get_cat_name($list->cat_ID); ?>
                                </a>
                            </h2>
        <!--                            <p class="read">
                                <a class="readmore" href="<?php echo get_category_link($list->cat_ID); ?>">
                                    <i class="fa fa-hand-o-right"></i>Chi tiết
                                </a>
                            </p>-->
                        </div>

                        <?php
                    }
                    ?>
                </div>
                <?php
            } else {
                ?>
                <h1 class="heading"><span><?php echo get_cat_name($current_cat_id); ?></span></h1>
                <div class="product-list">
                    <div class="wrap_post_items">
                        <?php
                        $q = new WP_Query('cat=' . $current_cat_id . '&paged=' . get_query_var('paged'));
                        if ($q->have_posts()):
                            $x = 1;
                            while ($q->have_posts()):
                                $q->the_post();
                                ?>
                                <div class="product-item">
                                    <div class="product-img">
                                        <a class="img" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                                            <?php
                                            if (has_post_thumbnail())
                                                the_post_thumbnail("medium", array("alt" => get_the_title()));
                                            else
                                                echo $no_thum;
                                            ?>
                                        </a>
                                    </div>
                                    <a class="product-title" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>

                                    <?php the_content_limit('500', 'Đọc thêm'); ?>
                                </div><!--End .product-item-->
                                <?php
                            endwhile;
                            if (function_exists('wp_pagenavi')) {
                                wp_pagenavi();
                            }
                            wp_reset_postdata();
                        endif;
                        ?>
                    </div><!--End .product-list-->
					</div>
                <?php } ?>
            
        </div><!--End #news-wrap-->
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