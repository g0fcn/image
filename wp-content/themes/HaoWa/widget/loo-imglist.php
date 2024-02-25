<?php
add_action( 'widgets_init', 'loo_imglists' );

function loo_imglists() {
	register_widget( 'loo_imglists' );
}

class loo_imglists extends WP_Widget {
	function loo_imglists() {
		$widget_ops = array( 'classname' => 'widget', 'description' => '图文列表' );
		$this->WP_Widget( 'loo_imglists', '图文列表', $widget_ops, $control_ops );
	}

	function widget( $args, $instance ) {
		extract( $args );

		$title        = apply_filters('widget_name', $instance['title']);
		$limit        = $instance['limit'];
		$cat          = $instance['cat'];
		$orderby      = $instance['orderby'];
		$img 		  = $instance['img'];
		$height		  = $instance['height'];

		$style='';
		echo $before_widget;
		echo $before_title.$title.$after_title; 
		echo ' <div class="sidebarcon"><ul class="hotnews">
';
		echo ltheme_posts_lists( $orderby,$limit,$cat,$height);
		echo '</div></ul>';
		echo $after_widget;
	}

	function form( $instance ) {
?>

<p>
  <label> 标题：
    <input style="width:100%;" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $instance['title']; ?>" />
  </label>
</p>
<p>
  <label> 分类限制： <a style="font-weight:bold;color:#f60;text-decoration:none;" href="javascript:;" title="格式：1,2 &nbsp;表限制ID为1,2分类的文章&#13;格式：-1,-2 &nbsp;表排除分类ID为1,2的文章&#13;也可直接写1或者-1；注意逗号须是英文的">？</a>
    <input style="width:100%;" id="<?php echo $this->get_field_id('cat'); ?>" name="<?php echo $this->get_field_name('cat'); ?>" type="text" value="<?php echo $instance['cat']; ?>" size="24" />
  </label>
</p>
<p>
  <label> 显示数目：
    <input style="width:100%;" id="<?php echo $this->get_field_id('limit'); ?>" name="<?php echo $this->get_field_name('limit'); ?>" type="number" value="<?php echo $instance['limit']; ?>" size="24" />
  </label>
</p>
<?php
	}
}
function ltheme_posts_lists($orderby,$limit,$cat,$height) {
	$args = array(
		'order'            => DESC,
		'cat'              => $cat,
		'orderby'          => $orderby,
		'showposts'        => $limit,
		'caller_get_posts' => 1
	);
	query_posts($args);
	while (have_posts()) : the_post(); 
?>
<li>
  <div class="row">
    <div class="col-md-4 col-xs-4">
      <div class="newsthumb"> <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" target="_blank"> <img  src="<?php echo get_template_directory_uri(); ?>/timthumb.php?src=<?php echo post_thumbnail_src(); ?>&h=60&w=110&zc=1" class="attachment-news-thumb size-news-thumb wp-post-image" alt="" 0="" /> </a> </div>
    </div>
    <div class="col-md-8 col-xs-8">
      <div class="newstext" id="newstext">
        <div class="newstexttop"> <a href="<?php the_permalink(); ?>" target="_blank" title="<?php the_title(); ?>">
          <h4>
            <?php the_title(); ?>
          </h4>
          </a> </div>
      </div>
    </div>
    <div class="clearfix"></div>
    <div class="col-md-4 col-xs-4"></div>
    <div class="col-md-8 col-xs-8">
      <div class="newstag">
        <?php if( cs_get_option( 'i_article_view' ) ) { ?>
        <span><i class="fa fa-eye" aria-hidden="true"></i>
        <?php get_post_views($post -> ID); ?>
        次</span>
        <?php }?>
        <span>
        <?php the_time('Y-m-d')?>
        </span> </div>
    </div>
  </div>
</li>
<?php endwhile; wp_reset_query();} ?>
