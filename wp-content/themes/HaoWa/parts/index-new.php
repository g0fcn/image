<div class="part" id="hot" data-title="热门推荐">
          <h2 class="has_link "><strong>热门推荐</strong><a href="<?php echo get_category_link( $cid ); ?>" target="_blank">更多 &gt;</a></h2>
          <div class="items ">
            <div class="row">
                 <?php if ( cs_get_option('i_hot_nums') ) { $picposts = stripslashes(cs_get_option('i_hot_nums')); } else { $picposts = 9; } ?>
    <?php query_posts( array( 'cat'=>$cid, 'ignore_sticky_posts'=>true, 'posts_per_page'=>$picposts ) ); while( have_posts() ): the_post(); ?>
	
              <div class="col-xs-6 col-sm-4 col-md-2">
        <div class="item"> <a href="<?php if( cs_get_option( 'dawa_post_u' ) ) { ?><?php the_permalink(); ?><?php }else{ ?><?php echo get_post_meta($post->ID,"url_value",true);?><?php }?>" rel="nofollow"  target="_blank"  title="<?php the_title(); ?>"> <img src="<?php echo get_template_directory_uri(); ?>/timthumb.php?src=<?php echo post_thumbnail_src(); ?>&h=52&w=52&zc=1" alt="<?php the_title(); ?>">
                  <h3 style="color:<?php echo get_post_meta($post->ID,"tit_value",true);?>"><?php the_title_attribute(); ?></h3>
                  <p><?php if(has_excerpt()) the_excerpt(); else echo mb_strimwidth(strip_tags($post->post_content),0,59,'...'); ?></p>
                  </a> </div>
              </div>
               <?php endwhile; ?>
            </div>
          </div>
        </div>