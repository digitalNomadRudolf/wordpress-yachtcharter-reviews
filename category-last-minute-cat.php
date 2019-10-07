<?php get_header(); ?>

<section class="sub-header">
        </section>

            <!-- destinations overview -->
            <section class="yt-destinations">
                <div class="container">

                <?php
                
                $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                $args = array(
                    'posts_per_page' => 6,
                    'cat' => 24,
                    'post_status' => 'publish',
                    'orderby' => 'date',
                    'paged' => $paged,
                );
                $cat_query = new WP_Query($args);
                $category = get_category(get_query_var('cat'));

                ?>

                    <div class="row margin-below">
                            <div class="col-12 title-col xtra-m-top">
                                    <h1 class="makemewhite"><?php echo get_cat_name(24); ?></h1>
                            </div>
                    </div>

                    <div class="row padding-below">
                        <?php  if(!$cat_query->have_posts()) {
                            echo '<h1>There are no search results for your search...</h1>';
                        } ?>

                    <?php
                    if($cat_query->have_posts()) :
                    while ($cat_query->have_posts() ) : 
                        $cat_query->the_post();?>

                        <div class="col-lg-4 yt-latest__col">
                                <div class="img-container">
                                    <a href="<?php the_permalink(); ?>">
                                    <img src="<?php the_post_thumbnail(); ?>" alt="superyacht" class="latest-img"></a>
                                </div>
                            <div class="latest-inner">
                                <h1><a href="<?php the_permalink(); ?>" class="gen-title"><?php the_title(); ?></a></h1>

                                <p><?php the_field('normal_excerpt'); ?><a href="<?php the_permalink(); ?>">
                                <span class="to-article"><?php the_field('italic_excerpt'); ?></span></a></p>
                            </div>
                        </div>

                        <?php endwhile; ?>

                        <?php 
                            $next_post_link = get_next_posts_link(' Older Results ', $cat_query->max_num_pages);
                            $previous_post_link = get_previous_posts_link(' Newer Results');
                        ?>

                        <?php 
                            
                            if($cat_query->max_num_pages > 1) :  ?>
                            <div class="navigation-wrap">
                          <?php  if($next_post_link && $previous_post_link) : ?>
                             
                                <div class="row page-navigation older">
	                                <?php echo $next_post_link ?>
                                </div>

                                <div class="row page-navigation newer">
                                    <?php echo $previous_post_link ?>
                                </div>
                            <?php 
                             elseif(!$next_post_link ) :
                            ?>
                                <div class="row page-navigation newer">
                                    <?php echo $previous_post_link ?>
                                </div>
                            <?php 
                             elseif(!$previous_post_link) :
                            ?>
                                <div class="row page-navigation older">
	                                <?php echo $next_post_link ?>
                                </div>
                            </div>
                            <?php else : ?>
                            <?php endif; ?>
                        <?php else : ?>
                        
                        <?php endif;
                              endif;
                              wp_reset_postdata();?>
                        
                    </div>
                </div>
            </section>
 <?php get_footer(); ?>
