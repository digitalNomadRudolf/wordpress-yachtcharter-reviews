<?php get_header(); ?>

<!-- yacht image with on top a yacht finder form -->  
<section class="hero-landing" style="background: url(<?php the_field('big_hero_image'); ?>) no-repeat;">
            <div class="container">
                    <div class="row">
                        <div class="inner-txt">
                        <!-- <h1><a href="#">Main message</a></h1> -->
                        <h2><?php the_field('big_hero_title'); ?><span class="join"><?php the_field('colored_title'); ?></span></h2>

                        <button class="read-more"><a href="#landing-main">discover more</a></button>
                        </div>
                    </div>

                    <div class="row">
                        <div class="container yt-find">
                                
                        </div>
                    </div>
            </div>
        </section>

        <section class="yt-news move-down">
            <div class="container">

                <div class="row padding-below">
                    
                    <!-- this main area contains the content on the left and an aside on the right -->
                    <div class="col-lg-8 news-left">
                        <!-- this area will list the categories. each categorie lists three items and a big button that links to the specific category listing page -->
                        <div class="row">
                            <div class="news-columns">

                            <!-- first news area -->
                            <div class="outer-full" id="landing-main">
                                <div class="title">
                                    <h1><a href="<?php the_permalink(); ?>"><?php the_field('post_intro_title'); ?></a></h1>
                                </div>
                                    <div class="row">
                                        <div class="col-md-12 inner-col">
                                            <div class="feat-art">
                                                <div class="img-wrap">
                                                    <a href="<?php the_permalink(); ?>" class="img-container">
                                                        <img src="<?php the_field('post_main_image'); ?>" alt="main image of this post">
                                                    </a>
                                                </div>
                                                <p class="title article-heading"><a href="<?php the_permalink(); ?>"><?php the_field('post_secondary_title'); ?></a></p>
                                                <span class="author">By <?php setup_postdata($post); the_author(); ?></span> -
                                                <span class="date">On <?php echo get_the_date( 'l F j, Y' ); ?></span>
                                                <p class="preview bigger">
                                                    <?php the_field('intro_paragraph'); ?>
                                                </p>

                                                <!-- <p class="article-txt">Lorem ipsum dolor sit amet consectetur adipisicing elit. Alias amet enim aliquam non repellat illum quas nihil nemo, repellendus reiciendis, distinctio eum, molestias ipsa ab modi iusto soluta? Ducimus, voluptatum.</p> -->

                                               <?php the_field('first_content_part'); ?>

                                                <h2><?php the_field('midpost_image_title'); ?></h2>

                                                <div class="container pad-zero">
                                                    <div class="row x-marge-b">
                                                <div class="col-6">
                                                    <div class="article-img">
                                                        <img src="<?php the_field('midpost_image_left'); ?>" alt="the left image of this post">
                                                    </div>
                                                </div>

                                                <div class="col-6">
                                                    <div class="article-img">
                                                        <img src="<?php the_field('midpost_image_right'); ?>" alt="the right image of this post">
                                                    </div>
                                                </div>
                                                
                                                    </div>
                                                </div>

                                                <?php the_field('second_content_part'); ?>

                                                <!-- <blockquote class="blockquote">"sailing is a lifestyle..."</blockquote> -->

                                            </div>
                                        </div>

                                        
                                    </div>

                                    <button class="goto-cat"><a href="<?php echo get_page_link(get_page_by_title('More Articles')) ?>"><span class="goto-cat--link">more articles</span></a></button>
                            </div>
                        </div>

                        </div>
                    </div>


                    <?php get_sidebar(); ?>

                </div>
            </div>
        </section>

        <?php get_footer(); ?>