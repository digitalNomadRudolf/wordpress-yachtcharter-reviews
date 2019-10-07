<?php /* Template Name: custom-search-results */ 
get_header(); ?>

<section class="sub-header">
        </section>

            <!-- destinations overview -->
            <section class="yt-destinations">
                <div class="container">


                <?php

                    $list = array();
                    $item = array();

                foreach($_POST as $key => $value) {
                    if($value != '') {
                        $item['taxonomy'] = htmlspecialchars($key);
                        $item['terms'] = htmlspecialchars($value);
                        $item['field'] = 'slug';
                        $list[] = $item;
                    }
                }
                $cleanArray = array_merge(array('relation' => 'AND'), $list);
                /* print_r($cleanArray); */

                $args['post_type'] = 'yachtreview';
                $args['posts_per_page'] = 3;
                $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                $args['paged'] = $paged;
                $args['tax_query'] = $cleanArray;
                $the_query = new WP_Query($args);

                /* print_r($the_query); */ ?>

                    <div class="row margin-below">

                            <div class="col-12 title-col xtra-m-top">
                                    <h1 class="makemewhite"><?php the_title(); ?></h1>
                            </div>
                    </div>

                    <div class="row padding-below">
                    <?php
                    echo ($the_query->found_posts > 0) ? '<h3 class="foundPosts">' . $the_query->found_posts. ' listings found</h3>' : '<h3 class="foundPosts">We found no results</h3>';?>
	                <?php while ( $the_query->have_posts() ) : $the_query->the_post();?>

                        <div class="col-lg-4 yt-latest__col">
                                <div class="img-container">
                                    <a href="<?php the_permalink(); ?>">
                                    <img src="<?php the_post_thumbnail(); ?>" alt="superyacht" class="latest-img"></a>
                                </div>
                            <div class="latest-inner">
                                <h1><a href="<?php the_permalink(); ?>" class="gen-title"><?php the_title(); ?></a></h1>
                                <p><?php the_excerpt(); ?></span></a></p>
                            </div>
                        </div>

                        <?php endwhile; /* wp_reset_postdata(); */?>


                        <?php  /* print_r($the_query->max_num_pages); */
                        if($the_query->max_num_pages > 1) :  ?>

                        <?php 
                            $next_post_link = get_next_posts_link(' Older Results ', $the_query->max_num_pages);
                            $previous_post_link = get_previous_posts_link(' Newer Results');
                        ?>
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
                              wp_reset_postdata();?>

                    </div>
                </div>
            </section>

            <section class="newsletter-cta">
                <div class="container">
                    <div class="newsletter-bg">
                        <div class="left-part">
                            <h1>Subscribe to our Newsletter</h1>
                            <p>Be the first to receive discounts and important news</p>
                        </div>

                        <div class="right-part">
                        <form action="<?php bloginfo('url'); ?>/newsletter/" method="post">
                            <input type="text" placeholder="Email address goes here..." name="news-signup" id="news-signup" autocomplete="off">
                            <button type="submit" class="sub-news-btn">Sign up</button>
                        </form>
                        </div>
                    </div>
                </div>
            </section>


<?php get_footer(); ?>