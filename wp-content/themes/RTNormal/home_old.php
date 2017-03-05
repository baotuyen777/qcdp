<?php
    get_header();
    do_action( 'genesis_before_content_sidebar_wrap' );
    $url = get_stylesheet_directory_uri();
    $no_thum = "<img src='".$url."/images/custom/no_thumb.png' alt='no_thumb' />";
    ?>
    <div class="content-sidebar-wrap">
        <?php do_action( 'genesis_before_content' ); ?>
        <main class="content" role="main" itemprop="mainContentOfPage" itemscope="itemscope" itemtype="http://schema.org/Blog">
            <?php
                do_action( 'genesis_before_loop' );
            ?>
            <div id="home-news">
                <div class="product-news-wrap">
            <?php
                $boxes = gtid_get_option('rt_num_home_boxes'); // Lấy số lượng box sản phẩm
                $num = gtid_get_option('number_home_product'); // Lấy số sản phẩm hiển thị trong Loop
                $news_box = gtid_get_option('rt_num_home_news'); // Lấy số lượng box tin
                $num_news =gtid_get_option('number_home_product2'); // Lấy số tin hiển thị trong Loop
                for($i=1;$i<=$boxes;$i++){
                    $products = gtid_get_option('home_cat_'.$i);
                    if($products != 0){
                        $main_post = new WP_Query('cat='.$products.'&showposts='.$num);
              ?>
                    <div class="img-category">
                        <div class="category_image">
                                <a href="<?php echo get_category_link($products); ?>" title="<?php echo get_cat_name($products);?>" class="img">
                                    <img src="<?php echo z_taxonomy_image_url($products); ?>" />
                                </a>
                        </div>
                        <h2>  
                                <a class="product-title" href="<?php echo get_category_link($products); ?>">
                                    <?php echo get_cat_name($products);?>
                                </a>
                        </h2>
                        
                        
                    </div>
               <?php  } }// Kết thúc vòng lặp For số box sản phẩm ?>
                </div><!-- Product Wrap -->
                    <div class="news-wrap">
                        <?php  for($i2=1;$i2<=$news_box;$i2++){
                                 $news = gtid_get_option('news_cat_'.$i2);
                                 if($news!=0) {
                         ?>
                        <h2 class="heading">
                          <span> 
                            <?php $array = get_term_by('id', $news, 'danhmuc');
                                echo $array->name;
                           ?>
                          </span>
                        </h2>
                    <div class="clear"></div>
                    <div class="news-list">
                    <?php
                        $args = array (
                        'post_type'              => 'tin-tuc',
                        'posts_per_page'         => $num_news,
                        'tax_query' => array(
                            array(
                                        'taxonomy' => 'danhmuc',
                                        'field'    => 'id',
                                        'terms'    => $news,
                                ),
                        ),
                        );
                         $news_list = new WP_Query($args); ?>
                    <?php
                            $d=0;
                            while($news_list -> have_posts()):
                            $news_list -> the_post();
                        $d++;
                        if($d==1){
                    ?>
                        <div class="news-item">
                            <a class="img" href="<?php the_permalink();?>" title="<?php the_title();?>">
                                    <?php if(has_post_thumbnail()) the_post_thumbnail("medium",array("alt" => get_the_title()));
                                    else echo $no_thum; ?>
                            </a>
                            <a class="news-title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            <?php the_content_limit("300",">>Xem tiếp"); ?>

                        </div>
                        <?php } else { ?>
                            <div class="news-item">
                                <a class="news-title2" href="<?php the_permalink() ?>" title="<?php the_title() ?>"><i class="fa fa-caret-right"></i> <?php the_title(); ?></a><span class="date"> ( <?php the_time('h:i, d/m/Y');?> ) </span>
                            </div>
                    <?php } endwhile; wp_reset_postdata(); ?>


                    </div><!--News-List-->
                    <?php   } } // Kết thúc vòng For số lượng box tin ?>
               </div><!--End #news-wrap-->
            </div>
             </main><!-- end #content -->
                  <!--#End #home-news-->
        <?php do_action( 'genesis_after_content' ); ?>
        <div class="intro"><?php dynamic_sidebar('widgetpage') ?></div>
   </div> <!-- end #content-sidebar-wrap -->
    <?php
    do_action( 'genesis_after_content_sidebar_wrap' );
    get_footer();

?>