<?php 
global $url,$no_thum;

$gia = get_field('gia');
$khuyenmai = get_field('gia_khuyen_mai');
?>
<div class="product-item">
    <div class="product-img">
        <a class="img" href="<?php the_permalink();?>" title="<?php the_title();?>">
            <?php if(has_post_thumbnail()) the_post_thumbnail("medium",array("alt" => get_the_title()));
                else echo $no_thum; ?>
        </a>
    </div>
<a class="product-title" href="<?php the_permalink();?>" title="<?php the_title();?>"><?php the_title();?></a>
<p class="read">
    <a href="<?php the_permalink();?>" class="readmore"><i class="fa fa-hand-o-right"></i>Chi tiết</a>
</p>
</div><!--End .product-item-->