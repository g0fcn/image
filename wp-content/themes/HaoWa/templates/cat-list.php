<?php 
/*
	template name: 文章列表
*/
?>
<?php get_header();?>
<link rel="stylesheet" href="<?php bloginfo('template_url');?>/list.css" />
<style>
.imglist li h4{width:180px !important}
</style>
<div class="container">
  <?php get_sidebar();?>
  <div class="mainleft">
    <?php while ( have_posts() ) : the_post(); ?>
    <div class="spost_list box">
      <?php if ( is_sticky() ) : ?>
      <h2><a href="<?php the_permalink() ?>">
        <?php the_title(); ?>
        </a></h2>
      <?php else : ?>
      <div class="sexcerpt">
        <div class="sthumbnail"> <a href="<?php the_permalink()?>" class="zoom" rel="bookmark" title="<?php the_title_attribute();?>"target="_blank"> <img src="<?php echo get_template_directory_uri(); ?>/timthumb.php?src=<?php echo post_thumbnail_src(); ?>&h=160&w=270&zc=1" alt="<?php the_title(); ?>"> </a> </div>
        <h2><a href="<?php the_permalink() ?>" title="<?php the_title(); ?> "target="_blank">
          <?php the_title(); ?>
          </a></h2>
        <div class="sinfo"> <span class="info_category">
          <?php the_category(', ')?>
          </span> <span class=" ">
          <?php the_tags('',' ','');?>
          </span> </div>
        <span class="note">
        <?php if(has_excerpt()) the_excerpt(); else echo mb_strimwidth(strip_tags($post->post_content),0,220,'...'); ?>
        </span> </div>
      <?php endif; ?>
    </div>
    <?php endwhile; ?>
  </div>
  </ul>
  <div class="clear"></div>
</div>
</div>
<div class="wpagenavi">
  <?php par_pagenavi(9); ?>
</div>
<div class="clear"></div>
<?php get_footer(); ?>
