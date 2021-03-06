<div class="row main-magazine">
    <div class="bar-info d-lg-none">
        <div class="col-md-8 col-sm-6 col-xs-12 small-left-padding">Nejnovější články</div>
        <div class="col-md-4 col-sm-6">Inzerce</div>
    </div>

    <div class="col-md-8 col-sm-12 col-xs-12">
      <div id="posts">
        <?php //$firstSticky = true;
            $FeatureArgs = array('posts_per_page' => 1,'post__in'  => get_option( 'sticky_posts' ),'ignore_sticky_posts' => 1 );
            $FeaturePost = new WP_Query($FeatureArgs);
        ?>

         <?php $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
            if ( is_home() ) {
                $query = new WP_Query(array(
                'paged' => $paged,
                'posts_per_page' => 8,
                'category_name' => 'arena',
                'post__not_in' => array($FeaturePost->post->ID),
                ));
            } else
            {
                $query = new WP_Query(array(
                'post_type' => 'post',
                'ignore_sticky_posts' => true,
                'paged' => $paged,
                'posts_per_page' => 14,
                'category_name' => artalk_get_current_category()
                ));
            }
         ?>
    		<?php while ($query -> have_posts()) : $query->the_post(); ?>
            <?php
/*                if (is_sticky() && $firstSticky)
                {
                    $firstSticky == false;
                //    continue;
                }*/
                get_template_part('templates/post', artalk_get_current_category() );
            ?>

    		<?php endwhile; ?>
            <?php getFurtherContentButton($taxonomy='category',$terms=get_category_by_slug( 'arena' )->cat_ID,$author=0); ?>
      </div>
      	<?php  get_template_part('templates/magazine-bottom'); ?>
    </div>

	<?php wp_reset_query(); ?>
	<?php wp_reset_postdata(); ?>

	<?php get_template_part('templates/sidebar'); ?>
