<?php
/*
Template Name: More Articles
*/
get_header(); ?>

<section class="news-header" style="background: url(<?php the_field('more_articles_header'); ?>) no-repeat;">
        </section>

            <!-- news left section -->
            <section class="yt-news">
                <div class="container">
                    <div class="row margin-below undo-sidemarge">
                            <div class="col-12 title-col xtra-m-top">
                                    <h1 class="makemewhite"><?php the_title(); ?></h1>
                            </div>
                    </div>

                    <div class="row undo-sidemarge padding-below">
                        
                        <!-- this main area contains the content on the left and an aside on the right -->
                        <div class="col-lg-8 news-left">
                            <!-- this area will list the categories. each categorie lists three items and a big button that links to the specific category listing page -->
                            <div class="row">
                                <div class="news-columns">

                                <?php

                                    $categories = get_categories();
                                    foreach($categories as $category) {
                                    $args = array(
                                        'post_type' => array('post', 'yachtreview'),
                                        'posts_per_page' => 4,
                                        'post_status' => 'publish',                                       
                                        'orderby' => 'date',
                                        /* 'category__in' => array(24, 34, -1), */
                                        'category__in' => array($category->term_id),
                                    );
                                    $posts = get_posts($args);
                                    if($posts) {
                                ?>
                                <!-- first news area -->
                                <div class="outer-full">
                                    <div class="title">
                                        <h1><a href="<?php echo get_category_link($category->term_id); ?>"><?php echo ucfirst($category->name); ?></a></h1>
                                    </div>
                                        <div class="row">
                                        <?php 
                                            foreach($posts as $post) {
                                                setup_postdata($post);
                                        ?>
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
                                            <?php } ?>
                                        </div>
                                        <button class="goto-cat"><a href="<?php echo get_category_link($category->term_id); ?>">more articles</a></button>
                                </div>
                                    <?php 
                                }
                            }
                                        wp_reset_postdata();
                                    ?>
                                </div>
                            </div>
                        </div>

                        <?php get_sidebar(); ?>

                    </div>
                </div>
            </section>

<?php get_footer(); ?>