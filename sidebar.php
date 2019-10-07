<!-- the aside -->

<?php  

    $args = array(
        'post_type' => 'yachtreview',
        'posts_per_page' => 1,
        'orderby' => 'date',
    );
    $first_query = new WP_Query($args);

?>
<aside class="col-lg-4 news-aside">
                        <div class="news-right">

                            <div class="right-col">

                                <!-- promo or discount or deals  -->

                                <?php 

                                if($first_query->have_posts()) :
                                    while($first_query->have_posts()) :
                                        $first_query->the_post();

                                ?>
                                <div class="special-deal">

                                    <a href="<?php the_permalink(); ?>" class="s-deal-link">
                                    <img src="<?php the_post_thumbnail_url(); ?>" alt="special-deal" class="s-deal-img">
                                    <p class="s-deal-title"><?php the_title(); ?></p>
                                    </a>
                                </div>
                                <?php 
                                    endwhile;
                                    endif;
                                    wp_reset_postdata();
                                ?>

                               <!--  area for the rental yachts or reviews or upcoming events etc -->
                                
                               <?php 

                                    $args = array(
                                        'post_type' => 'yachtreview',
                                        'posts_per_page' => 3,
                                        'orderby' => 'date',
                                    );
                                    $second_query = new WP_Query($args);
                               

                                 if($second_query->have_posts()) : ?>
                                <div class="best-rentals">
                                    <p class="title">Best Yacht Charter Reviews</p>
                                    <ul class="rentals-list">
                                    
                                    <?php while($second_query->have_posts()) :
                                        $second_query->the_post();
                                   ?>
                                        <li>
                                            <div class="rental-img-wrap">
                                                <a href="<?php the_permalink(); ?>" class="rental--link">
                                                    <img src="<?php the_post_thumbnail_url(); ?>" alt="yacht for rent" class="rental-img">
                                                    <div class="overlay-title"><?php the_title(); ?></div>
                                                </a>

                                                <div class="rental-caption">
                                                    <p><?php the_excerpt(); ?></p>
                                                </div>

                                            </div>

                                            
                                        </li>

                                    <?php endwhile;   ?>

                                        <button class="goto-rentals"><a href="<?php echo get_post_type_archive_link('yachtreview'); ?>">All Yacht Charter reviews</a></button>
                                    </ul>
                                    
                                </div>

                                    <?php
                                        endif;
                                        wp_reset_postdata();
                                    ?>

                               <!--  newsletter signup box small -->
                                <div class="newsletter-wrap-box">
                                    <div class="nl-bg-area">
                                        <div class="nl-title">
                                            <h3>Signup for our Newsletter</h3>
                                        </div>
                                        <div class="nl-desc">
                                            <p>profit from the best deals we have to offer</p>
                                        </div>
                                        <div class="nl-form-wrap">
                                            <form action="<?php bloginfo('url'); ?>/newsletter/" autocomplete="false" role="form" method="post" id="nl-form">
                                                <input type="text" class="email" placeholder="Email">
                                                <button type="submit">Sign up</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </aside>