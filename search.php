<?php get_header(); ?>

<section class="sub-header">
        </section>

            <!-- destinations overview -->
            <section class="yt-destinations">
                <div class="container">

                <?php

                global $wp_query;
                
                ?>

                    <div class="row margin-below">

                            <div class="col-12 title-col xtra-m-top">
                                    <h1 class="makemewhite">Search Results</h1>
                            </div>
                    </div>

                    <div class="row padding-below">
                        <?php  if(!have_posts()) {
                            echo '<h1>There are no search results for your search...</h1>';
                        } ?>

                    <?php
                    if(have_posts()) :
                    while (have_posts() ) : 
                        the_post();?>

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
                            $next_post_link = get_next_posts_link(' Older Results ', $wp_query->max_num_pages);
                            $previous_post_link = get_previous_posts_link(' Newer Results');
                        ?>

                        <?php 
                            
                        if(paginate_links()) :  ?>
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
