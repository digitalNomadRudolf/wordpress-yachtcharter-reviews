<?php
/*
Template Name: Yacht Review
*/
get_header(); ?>

<section class="news-header" style="background: url(<?php the_field('yachtreview_header', 139); ?>) no-repeat;">
        </section>

            <!-- news left section -->
            <section class="yt-news">
                <div class="container">
                    <div class="row margin-below undo-sidemarge">
                            <div class="col-12 title-col xtra-m-top">
                                <?php $post_type = get_post_type(get_the_ID()); ?>
                                    <h1 class="makemewhite"><?php echo $post_type . 'S'; ?></h1>
                            </div>
                    </div>

                    <div class="row undo-sidemarge padding-below">
                        
                        <!-- this main area contains the content on the left and an aside on the right -->
                        <div class="col-lg-8 news-left">
                            <!-- this area will list the categories. each categorie lists three items and a big button that links to the specific category listing page -->
                            <div class="row">
                                <div class="news-columns">

                                <?php

                                    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                                    $args = array(
                                        'post_type' => array('yachtreview'),
                                        'posts_per_page' => 8,
                                        'post_status' => 'publish',                                       
                                        'orderby' => 'date',
                                        'paged' => $paged,
                                    );
                                    $the_query = new WP_Query($args);
                                    
                                ?>
                                <!-- first news area -->
                                <?php if($the_query->have_posts()) :  ?>
                                <div class="outer-full">
                                    <div class="title">
                                        <h1><a href="<?php echo get_post_type_archive_link($post_type); ?>"><?php echo ucfirst($post_type) . 's'; ?></a></h1>
                                    </div>
                                        <div class="row">
                                        <?php while($the_query->have_posts()) : 
                                           $the_query->the_post(); ?>
                                            <div class="col-sm-6 inner-col">
                                                <div class="feat-art">
                                                    <div class="img-wrap">
                                                        <a href="<?php the_permalink(); ?>" class="img-container">
                                                            <img src="<?php the_post_thumbnail_url(); ?>" alt="image of the article">
                                                        </a>
                                                    </div>
                                                    <p class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></p>
                                                    <p class="preview"><?php the_excerpt(); ?></p>
                                                    <p class="date"><?php echo get_the_date( 'l F j, Y' ); ?></p>
                                                </div>
                                            </div>
                                        <?php endwhile; ?>
                                        
                                        <?php 
                                        $next_post_link = get_next_posts_link(' Older Results ', $the_query->max_num_pages);
                                        $previous_post_link = get_previous_posts_link(' Newer Results');
                                        ?>

                                        <?php 
                            
                                            if($the_query->max_num_pages > 1) :  ?>

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
                                                
                                                <?php else : ?>
                                                <?php endif; ?>
                                            </div>
                                            <?php endif; ?>
                                    </div>
                                </div>
                                    <?php 
                                        endif;
                                        wp_reset_postdata();
                                    ?>
                                </div>
                            </div>
                        </div>

                        <?php get_sidebar(); ?>
            </section>

<?php get_footer(); ?>