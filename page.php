<?php

get_header(); ?>

<section class="news-header" style="background: url(<?php the_field('page_header'); ?>) no-repeat;">
        </section>

            <!-- news left section -->
            <section class="yt-news">
                <div class="container">
                    <div class="row margin-below undo-sidemarge">
                            <div class="col-12 title-col xtra-m-top">
                                    <h1 class="makemewhite"><?php the_title(); ?></h1>
                            </div>
                    </div>
                    
                    <!-- this main area contains the content on the left and an aside on the right -->
                    <div class="col-lg-12 news-left">

                                    <div class="row">
                                        <div class="col-md-12 inner-col">
                                            <div class="feat-art">
                                                <h1 class="title article-heading"><?php the_field('page_title'); ?></h1><br/>
                                                
                                                <p class="preview bigger">
                                                    <?php the_field('page_intro_paragraph'); ?>
                                                </p>

                                                <!-- <p class="article-txt">Lorem ipsum dolor sit amet consectetur adipisicing elit. Alias amet enim aliquam non repellat illum quas nihil nemo, repellendus reiciendis, distinctio eum, molestias ipsa ab modi iusto soluta? Ducimus, voluptatum.</p> -->

                                               <?php the_field('first_content_page'); ?>

                                                <h2><?php the_field('secondary_page_title'); ?></h2><br/>

                                                <?php the_field('second_content_page'); ?>

                                            </div>
                                        </div>
                                    </div>
                                 </div>
                              </div>
                    </section>

<?php get_footer(); ?>