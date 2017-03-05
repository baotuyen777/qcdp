<?php
	get_header();
    do_action( 'genesis_before_content_sidebar_wrap' );
    $url = get_stylesheet_directory_uri();
    $no_thum = "<img src='".$url."/images/custom/no_thumb.png' alt='no_thumb' />";

    $term = $wp_query->get_queried_object();
    $catid = $term->term_id;
?>
	<div class="content-sidebar-wrap">
		<?php do_action( 'genesis_before_content' );  ?>
		<main class="content" role="main" itemprop="mainContentOfPage" itemscope="itemscope" itemtype="http://schema.org/Blog">
			<?php
				do_action( 'genesis_before_loop' );
			?>
                <div id="home-news">
                    <h1 class="heading"><span><?php single_term_title(); ?></span></h1>
					<?php
                        $arg = array(
                        'post_type' => 'tin-tuc',
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'danhmuc',
                                'field' => 'id',
                                'terms' => $catid
                            )
                        ),
                        'paged'=> get_query_var('paged')
                        );
                        $news_post = new WP_Query($arg);
                        while($news_post -> have_posts()) :
                            $news_post -> the_post();
                    ?>
                        <div class="news-post">
                            <h2><a href="<?php the_permalink();?>" title="<?php the_title();?>"><?php echo the_title();?></a></h2>
                            <a href="<?php the_permalink();?>" title="<?php the_title();?>">

                            <?php if(has_post_thumbnail()) the_post_thumbnail("medium",array("alt" => get_the_title()));
                                else echo $no_thum; ?>
                            </a>

                            <?php the_content_limit(400,'Đọc Thêm');?>

                        </div><!--End .news-post-->

                        <?php endwhile; 
							if(function_exists('wp_pagenavi')) {wp_pagenavi();}
                            wp_reset_postdata();
        			     ?>

                </div><!--End #news-wrap-->

            <?php

				do_action( 'genesis_after_loop' );

			?>
		</main><!-- end #content -->

		<?php do_action( 'genesis_after_content' ); ?>

	</div><!-- end #content-sidebar-wrap -->
	<?php
	do_action( 'genesis_after_content_sidebar_wrap' );
	get_footer();
?>