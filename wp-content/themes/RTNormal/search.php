<?php
	get_header();
	do_action( 'genesis_before_content_sidebar_wrap' );
	?>
	<div class="content-sidebar-wrap">
		<?php do_action( 'genesis_before_content' ); ?>
		<main class="content" role="main" itemprop="mainContentOfPage" itemscope="itemscope" itemtype="http://schema.org/Blog">
			<?php
				do_action( 'genesis_before_loop' );
			?>
            <div id="search-result">
               <h2 class="heading"><a>Kết quả tìm kiếm : <?php echo $_GET['s']; ?></a></h2>
                <?php
                    if(have_posts()) {
                        while(have_posts()){
                            the_post();
                ?>
               <div class="news-post">
                    <h2><a href="<?php the_permalink();?>" title="<?php the_title();?>"><?php echo the_title();?></a></h2>
                    <a href="<?php the_permalink();?>" title="<?php the_title();?>">

                    <?php if(has_post_thumbnail()) the_post_thumbnail("medium",array("alt" => get_the_title()));
                        else echo $no_thum; ?>
                    </a>

                    <?php the_content_limit(150,'Đọc Thêm');?>

                </div><!--End .news-post-->
                <?php
                        }//End while
                    }//Endif
                ?>
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