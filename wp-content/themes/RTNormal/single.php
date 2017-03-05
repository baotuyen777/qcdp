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
				do_action( 'genesis_before_entry' );
			?>
                <div id="product-detail">
                	<?php if(have_posts()) : the_post();
                            $fields = get_field_objects(); // lay cac tham so, tra ra 1 array
                    ?>
                    <h1 class="heading"><span><?php the_title();?></span></h1>
					<div class="Information">
   				         <div class="anhspsp">
    					 <a href="#" title="<?php the_title();?>">
    					<?php if(has_post_thumbnail()) the_post_thumbnail("medium",array("alt" => get_the_title()));
                                else echo $no_thum; ?>
    					 </a>
                        </div>

                    <div class="thongso">
						<ul>
                            <?php
                            if(count($fields) != 0) :
                            foreach($fields as $val) :
                                if( !empty($val['value']) ){
                            ?>
                            <li>
                                <span class="left"><?php echo $val['label']; ?></span>
                                <span class="right">
                                <?php
                                    if( $val['name'] == 'gia' || $val['name'] == 'gia_khuyen_mai' ){
                                        echo number_format($val['value'],0,'','.')." VNĐ";
                                    }else{
                                        echo the_field($val['_name']);
                                    }
                                 ?>
                                </span>
                            </li>

                            <?php } endforeach; endif; ?>
						</ul>
<!--	<a class="contact" href="/mua-hang/?product=<?php the_title(); ?>&amp;product_url=<?php the_permalink();?>">Mua hàng</a> -->
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

                    <div id="related-post">
                        <h3 class="heading"><span>Sản Phẩm Liên Quan</span></h3>
                        <div class="product-list">
                      <?php
			            $category = wp_get_object_terms( $post->ID, 'category',array('orderby' => 'parent', 'order' => 'DESC'));
                        global $post;
                        $rel = new WP_Query(array(
                            'cat' => $category[0]->cat_ID,
                            'showposts' => 9,
                            'post__not_in' => array($post->ID)
                        ));
                        if($rel->have_posts()):
                            while($rel->have_posts()):
                                $rel->the_post();

                           get_template_part('loop');

                                endwhile;
                            endif;
                        ?>
                    </div>

                </div>
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