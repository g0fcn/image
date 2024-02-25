<?php get_header();?>
<div class="content">
<div class="container">
  <div class="row">
    <div class="col-md-1 sidebar">
      <div class="content-sidebar ">
        <dl id="goto">
        </dl>
      </div>
    </div>
    <div class="col-md-11">
      <?php
    global $cat;
    $cats = get_categories(array(
        'child_of' => $cat,
        'parent' => $cat,
        'hide_empty' => 0
    ));
    $c = get_category($cat);
    if(empty($cats)){
?>
      <div class="part" id="<?php $category = get_the_category();//默认获取当前所属分类
echo $category[0]->cat_ID; //输出分类 id ?>" data-title="<?php single_cat_title(); ?>">
        <h2 class=""><strong>
          <?php single_cat_title(); ?>
          </strong></h2>
        <div class="items ">
          <div class="row">
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <div class="col-xs-6 col-sm-4 col-md-2">
              <div class="item">
                <?php if( cs_get_option( 'dawa_post_u' ) ) { ?>
                <a href="<?php the_permalink(); ?>"target="_blank" title="<?php the_title(); ?>">
                <?php }else{ ?>
                <a href="<?php echo get_post_meta($post->ID,"url_value",true);?>" rel="nofollow" target="_blank" title="<?php the_title(); ?>">
                <?php }?>
                <img src="<?php echo get_template_directory_uri(); ?>/timthumb.php?src=<?php echo post_thumbnail_src(); ?>&h=52&w=52&zc=1">
                <h3>
                  <?php the_title(); ?>
                </h3>
                <p>
                  <?php if(has_excerpt()) the_excerpt(); else echo mb_strimwidth(strip_tags($post->post_content),0,59,'...'); ?>
                </p>
                </a> </div>
            </div>
            <?php endwhile; ?>
            <?php else: ?>
            <?php endif; ?>
          </div>
        </div>
        <?php
}else{
    foreach($cats as $the_cat){
        $posts = get_posts(array(
            'category' => $the_cat->cat_ID,
            'numberposts' => 100,
        ));
        if(!empty($posts)){
            echo '
			<div class="part" id="'.$the_cat->cat_ID.'" data-title="'.$the_cat->name.'">
          <h2 class=""><strong>'.$the_cat->name.'</strong></h2>
          <div class="items "><div class="row">';
                    foreach($posts as $post){
                        echo '
						
              <div class="col-xs-6 col-sm-4 col-md-2">
                <div class="item">
				
				 ';

        if( cs_get_option( 'dawa_post_u') ){
            echo '<a href="'.get_permalink($post->ID).'" target="_blank" rel="nofollow" title="'.$post->post_title.'">';
        }else {
              echo ' <a href="'.get_post_meta($post->ID,"url_value",true).'" target="_blank" rel="nofollow" title="'.$post->post_title.'">';
        }
        echo '
		
				 
				  <img src="'; echo get_template_directory_uri();echo '/timthumb.php?src='; echo post_thumbnail_src ();echo'&h=52&w=52&zc=1" alt="'.$post->post_title.'">
                  <h3>'.$post->post_title.'</h3>
                  <p>'.mb_strimwidth(strip_tags($post->post_content),0,59,'...').'</p>
                  </a> 
				  
					</div>	</div>
					
						';
                    }
					
				
					
                echo '</div></div>';
        }
		  echo '</div>';
    }
}
?>
        <div class="content-words"> <?php echo cs_get_option( 'i_ad_cat_txt' ); ?> </div>
        <div class="content-linkto "> <?php echo cs_get_option( 'i_ad_cat' ); ?></div>
      </div>
    </div>
  </div>
</div>
<?php get_footer(); ?>
