<?php get_header(); ?>
<!-- yacht image with on top a yacht finder form -->  
<section class="hero-main" style="background-image: url(<?php the_field('hero_image', 7); ?>)">
            <div class="container">
                    <div class="row">
                        <div class="inner-txt">
                        
                        <h2><?php the_field('hero_title', 7); ?></h2>
                        </div>
                    </div>

                    <div class="row">
                        <div class="container yt-find">
                            

                            <form method="post" id="advanced-searchform" role="search" action="<?php bloginfo('url'); ?>/search-results/" class="yt-search">
                                    <div class="search-tabs">
                                            <div class="heading">Find Yachts</div>
                                        </div>
                                <fieldset>
                               
                                    <div class="row">
                                    
                                            <?php 
                                            
                                                $object = 'yachtreview';
                                                $taxonomies = get_object_taxonomies($object); 
                                                $the_terms = get_terms($taxonomies);
                                                
                                                $exclude = array('post_tag', 'post_format', 'last minute', 'category');
                                                    

                                                if ($taxonomies) {
                                                    foreach($taxonomies as $taxonomy) {
                                                        
                                                        if(in_array($taxonomy, $exclude)) {
                                                            continue;
                                                        }
                                                        echo yachtproject_build_select($taxonomy);
                                                    }    
                                                }
                                                                                       
                                            ?>

                                   <div class="yt-search__btn find-wrap">
                                        <input type="submit" value="Find">
                                 </div>
                                    </div>
                                </fieldset>
                            </form>
                        </div>
                    </div>
            </div>
        </section>
        
            <section class="pop-dest">
                <div class="container">

                        <?php 

                            $dest_query = new WP_Query(array(
                                'category_name' => 'top-destinations',
                                'posts_per_page' => '1'
                            ));

                        ?>

                    <div class="row">
                        <div class="col-12 title-col">
                            <h1>Destinations</h1>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-lg-6 big-col">

                        <?php 

                            if($dest_query->have_posts()) :
                                while($dest_query->have_posts()) :
                            $dest_query->the_post();
                        ?>

                            <div class="dest-box">
                                <img class="dest-box-img" src="<?php echo get_the_post_thumbnail_url(); ?>">
                                <a href="<?php the_permalink(); ?>" class="dest-box__link"><?php the_title(); ?></a>
                            </div>
                        </div>

                        <div class="col-lg-6 big-col">
                            <div class="dest-box smaller-box">
                                <!-- <img src="" alt=""> -->
                                <div class="titlecaption"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>
                                <?php the_content(); ?>
                                
                            </div>
                        </div>

                        <?php endwhile;
                              endif;
                              wp_reset_postdata();
                        ?>
                    </div>
                </div>
            </section>

            <!-- last minute charters -->
            <section class="last-min">
                <div class="container">

                    <div class="row">
                            <div class="col-12 title-col xtra-m-top">
                                <h1>Last Minute</h1>
                                <span class="lm-sectitle">charters</span>
                            </div>
                    </div>
                              
                    <?php echo do_shortcode( '[wp_flickity id="1"]' ); ?>
                </div>
            </section>

            <!-- latest yacht reviews -->
            <section class="yt-latest">
                <div class="container">

                <?php 

                    $latest_query = new WP_Query(array(
                        'post_type' => 'yachtreview',
                        'posts_per_page' => '3'
                    ));

                    ?>

                    <div class="row">
                            <div class="col-12 title-col xtra-m-top">
                                    <h1>Latest Reviews</h1>
                            </div>
                    </div>

                    <div class="row">
                    <?php 

                            if($latest_query->have_posts()) :
                                while($latest_query->have_posts()) :
                            $latest_query->the_post();
                            ?>
                        <div class="col-lg-4 yt-latest__col">
                        

                                <div class="img-container">
                                    <a href="<?php the_permalink(); ?>">
                                    <img src="<?php echo get_the_post_thumbnail_url(); ?>" alt="superyacht" class="latest-img"></a>
                                </div>
                                
                                <div class="latest-inner">
                                    <h1><a href="<?php the_permalink(); ?>" class="gen-title"><?php the_title(); ?></a></h1>
                                    <?php the_content(); ?>
                                </div>                                
                        </div>
                        <?php endwhile;
                              endif;
                              wp_reset_postdata(); ?>
                    </div>
                    
                </div>
            </section>

            <section class="yt-video">
                    <div class="vid-overlay"><h1>"Our teambuilding trip with the Superyacht Charter Service was awesome!"</h1></div>
                    <video id="yt-video__boat" autoplay="" muted="muted" loop>
                       <source src="<?php the_field('event_video', 7); ?>" type="video/mp4">
                    </video>
                    
                </section>

            <section class="yt-newsl">
                <div class="container">
                        <div class="row">
                                <div class="col-12 title-col xtra-m-top">
                                        <h1>Newsletter</h1>
                                </div>
                        </div>

                    <div class="outer-box">
                        <form action="<?php bloginfo('url'); ?>/newsletter/" method="post">
                                <input type="text" class="news-field" placeholder="Be the first to receive generous discounts and promotions...">
                            
                                <input type="submit" class="btn btn-primary cst-btn-style" value="Signup now">
                            
                        </form>
                    </div>
                </div>
            </section>

<?php get_footer(); ?>