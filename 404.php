<?php /* Template Name: Not Found */ 

get_header(); ?>

<section class="news-header" style="background: url(<?php the_field('404_header', 148); ?>) no-repeat;">
        </section>

            <!-- news left section -->
            <section class="yt-news">
                <div class="container">
                    <div class="row margin-below undo-sidemarge">
                            <div class="col-12 title-col xtra-m-top">
                                    <h1 class="makemewhite">Page not found...</h1>
                            </div>
                    </div>

                    <div class="row undo-sidemarge padding-below">
                        
                        <!-- this main area contains the content on the left and an aside on the right -->
                        <div class="col-lg-8 news-left">
                            <!-- this area will list the categories. each categorie lists three items and a big button that links to the specific category listing page -->
                            <div class="row">
                                <div class="news-columns">

                                <!-- first news area -->
                                <div class="outer-full">
                                    <div class="title">
                                        <h1><?php the_field('404_title', 148); ?></h1>
                                        <p><?php the_field('404_message', 148); ?></p>
                                    </div>
                                        <div class="row">
                                            <?php get_search_form(); ?>
                                        </div>
                                </div>

                            </div>

                            </div>
                        </div>


                        <?php get_sidebar(); ?>

                    </div>
                </div>
            </section>

<?php get_footer(); ?>