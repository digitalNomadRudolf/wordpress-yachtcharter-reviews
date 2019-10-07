<?php
/*
    =================================
     Remove Generator Version Number
    =================================

*/
function yachtproject_remove_wp_version_strings($src) {
    global $wp_version;
    parse_str(parse_url($src, PHP_URL_QUERY), $query);
    if (!empty($query['ver']) && $query['ver'] === $wp_version) {
        $src = remove_query_arg('ver', $src);
    }
    return $src;
}
add_filter('script_loader_src', 'yachtproject_remove_wp_version_strings');
add_filter('style_loader_src', 'yachtproject_remove_wp_version_strings');

function yachtproject_remove_meta_version() {
    return '';
}
add_filter('the_generator', 'yachtproject_remove_meta_version');

/*
    =============================
     Adding the CSS and JS files
    =============================

*/
function yachtproject_site_setup() {
    wp_enqueue_style('style', get_template_directory_uri() . '/dist/css/bundle.css', array(), microtime(), 'all');
    wp_enqueue_style('bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', array(), microtime());
    wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css?family=Raleway:100,400,900|Roboto+Slab:100,400&display=swap');
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css');
    
    wp_enqueue_script( 'modernizr', get_template_directory_uri() . '/src/js/modernizr.custom.js', array(), microtime(), true);
    wp_enqueue_script( 'script', get_template_directory_uri() . '/src/js/script.js', array('jquery'), microtime(), true);
    wp_enqueue_script( 'navbar-init', get_template_directory_uri() . '/src/js/navbar-init.js', array(), microtime(), true);
    wp_enqueue_script( 'main', get_template_directory_uri() . '/dist/js/main.js', array('jquery'), microtime(), false);
}
add_action('wp_enqueue_scripts', 'yachtproject_site_setup');


/*
    ====================================
     Setup theme support and nav menus
    ====================================

*/
function yachtproject_site_init() {
    add_theme_support('post-thumbnails');
    add_theme_support('title-tag');
    add_theme_support('html5', array(
        'comment-list', 'comment-form', 'search-form', 'gallery', 'caption'
    ));
    register_nav_menus( array(
        'header' => 'Header menu',
        'footer' => 'Footer menu',
        'primary-menu' => __('Primary Menu', 'topmenu'),
        'secondary-menu' => __('Secondary Menu', 'secondmenu')
    ));
}

if ( function_exists('register_sidebar') )
  register_sidebar(array(
    'name' => 'Sidebar',
    'id' => 'sidebar-1',
    'class' => 'custom',
    'description' => 'Standard Sidebar',
    'before_widget' => '<div class = "widgetizedArea">',
    'after_widget' => '</div>',
    'before_title' => '<h3>',
    'after_title' => '</h3>',
  )
);

register_sidebar(array(
    'name' => 'Footer Area 1',
    'id' => 'footer-1',
    'class' => 'custom',
    'description' => 'The footer area',
    'before_widget' => '<div class="col-sm-4 foot-col">',
    'after_widget' => '</div>',
    'before_title' => '<div class="col-title"><h3>',
    'after_title' => '</h3></div>',
  )
);

register_sidebar(array(
    'name' => 'Footer Area 2',
    'id' => 'footer-2',
    'class' => 'custom',
    'description' => 'The footer area',
    'before_widget' => '<div class="col-sm-4 foot-col">',
    'after_widget' => '</div>',
    'before_title' => '<div class="col-title"><h3>',
    'after_title' => '</h3></div>',
  )
);

register_sidebar(array(
    'name' => 'Footer Area 3',
    'id' => 'footer-3',
    'class' => 'custom',
    'description' => 'The footer area',
    'before_widget' => '<div class="col-sm-4 foot-col">',
    'after_widget' => '</div>',
    'before_title' => '<div class="col-title no-b-pad"><h3>',
    'after_title' => '</h3></div>',
  )
);

add_action('after_setup_theme', 'yachtproject_site_init');
add_theme_support('custom-background');
add_theme_support('custom-header');
add_theme_support('post-thumbnails');
add_theme_support('post-formats', array(
    'aside', 'image', 'video'
));

/*
    ===================
     Custom Post Types
    ===================
*/

function yachtproject_cpt_yachtreviews() {
    $labels = array(
       'name'          => 'Yacht Reviews',
       'singular_name' => 'Yacht_Review',
       'add_new'       => 'Create New Yacht Review',
       'all_items'     => 'All Items',
       'add_new_item'  => 'Add Item',
       'edit_item'     => 'Edit Item',
       'new_item'      => 'New Item',
       'view_item'     => 'View Item',
       'search_item'   => 'Search Yacht Review',
       'not_found'     => 'No items found',
       'not_found_in_trash' => 'No items found in trash',
       'parent_item_colon'  => 'Parent Item',
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'has_archive' => true,
        'publicly_queryable' => true,
        'query_var' => true,
        'rewrite' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
        'menu_icon' => 'dashicons-palmtree',
        'supports' => array(
            'title',
            'editor',
            'excerpt',
            'thumbnail',
            'revisions',
        ),
        'taxonomies' => array(
            'category',
            'post_tag'
        ),
        'menu_position' => 5,
        'exclude_from_search' => false
    );
    register_post_type('Yacht Review', $args);
}

add_action('init', 'yachtproject_cpt_yachtreviews');

/*
    ===================
     Taxonomies
    ===================
        guests
        boat type
        last minute
        destinations
*/
function yachtproject_ctx_guest_capacity() { 
    // add new taxonomy hierarchical
    $labels = array(
        'name' => 'Guest Capacity',
        'singular' => 'Guest Capacity',
        'search_items' => 'Search Capacity',
        'all_items' => 'All',
        'parent_item' => 'Parent item',
        'parent_item_colon' => 'Parent item:',
        'edit_item' => 'Edit Capacity',
        'update_item' => 'Update Capacity',
        'add_new_item' => 'Add New Capacity',
        'new_item_name' => 'New item Name',
        'menu_name' => 'Guest Capacity'
    );

    $args = array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        // rewrite is always better for SEO
        'rewrite' => array('slug' => 'guest_capacity')
    );

    // this taxonomy is going to be applied ONLY to the 'yacht reviews' custom post type
    register_taxonomy('guest_capacity', array('yachtreview'), $args);
}

add_action('init', 'yachtproject_ctx_guest_capacity');

function yachtproject_ctx_boat_type() {
    // add new taxonomy hierarchical
    $labels = array(
        'name' => 'Boat Type',
        'singular' => 'Boat Type',
        'search_items' => 'Search Boat Type',
        'all_items' => 'All Boat Types',
        'parent_item' => 'Parent Boat Type',
        'parent_item_colon' => 'Parent Boat Type:',
        'edit_item' => 'Edit Boat Type',
        'update_item' => 'Update Boat Type',
        'add_new_item' => 'Add New Boat Type',
        'new_item_name' => 'New Boat Type Name',
        'menu_name' => 'Boat Type'
    );

    $args = array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        // rewrite is always better for SEO
        'rewrite' => array('slug' => 'boat_type')
    );

    register_taxonomy('boat_type', array('yachtreview'), $args);
}

add_action('init', 'yachtproject_ctx_boat_type');

function yachtproject_ctx_last_minute() {
    // add new taxonomy hierarchical
    $labels = array(
        'name' => 'Last Minute',
        'singular' => 'Last Minute',
        'search_items' => 'Search Last Minute',
        'all_items' => 'All Last Minutes',
        'parent_item' => 'Parent Last Minute',
        'parent_item_colon' => 'Parent Last Minute:',
        'edit_item' => 'Edit Last Minute',
        'update_item' => 'Update Last Minute',
        'add_new_item' => 'Add New Last Minute',
        'new_item_name' => 'New Last Minute Name',
        'menu_name' => 'Last Minute'
    );

    $args = array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        // rewrite is always better for SEO
        'rewrite' => array('slug' => 'last-minute')
    );

    register_taxonomy('last minute', array('yachtreview'), $args);
}

add_action('init', 'yachtproject_ctx_last_minute');

function yachtproject_ctx_destinations() {
    // add new taxonomy hierarchical
    $labels = array(
        'name' => 'Destination',
        'singular' => 'Destination',
        'search_items' => 'Search Destination',
        'all_items' => 'All Destinations',
        'parent_item' => 'Parent Destination',
        'parent_item_colon' => 'Parent Destination:',
        'edit_item' => 'Edit Destination',
        'update_item' => 'Update Destination',
        'add_new_item' => 'Add New Destination',
        'new_item_name' => 'New Destination Name',
        'menu_name' => 'Destination'
    );

    $args = array(
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        // rewrite is always better for SEO
        'rewrite' => array('slug' => 'destinations')
    );

    register_taxonomy('destinations', array('yachtreview'), $args);
}

add_action('init', 'yachtproject_ctx_destinations');

/*
    ====================================
     Custom Charter Search on Home Page
    ====================================

*/
function yachtproject_build_select($tax) {
    $terms = get_terms($tax);
    if($tax === 'destinations') {
        $selectclass = 'yt-search--dest';
        $classname   = 'yt-search__col big-wrap';
        $lab         = 'Where do you want to go?';
    } else if ($tax === 'guest_capacity') {
        $selectclass = 'yt-search--guests';
        $classname   = 'yt-search__col guest-wrap';
        $lab         = 'How many guests?';
    } else if ($tax === 'boat_type') {
        $selectclass = 'yt-search--btype';
        $classname   = 'yt-search__col btype-wrap';
        $lab         = 'Boat Type';
    } 

    $x = '<div class="' . $classname . '">';
    $x .= $classname === 'yt-search__col btype-wrap' ? '<div class="form-group form-row">' : '';
    $x .= '<label>' . $lab . '</label>';
    $x .= '<select name="' . $tax . '" class="' . $selectclass . '">';
    $x .= '<option value="">' . ucfirst($lab) . '</option>';
    
    
    foreach($terms as $term) {
        $x .= '<option value="' . $term->slug . '">' . $term->name . '</option>';
    }
    $x .= $classname === 'yt-search__col btype-wrap' ? '</select></div></div>' : '</select></div>';
    return $x;
}



function searchfilter($query) {

    if ($query->is_search && !is_admin() ) {
        $query->set('post_type',array('post', 'yachtreview'));
    }
return $query;
}
add_filter('pre_get_posts','searchfilter');

function custom_excerpt_length($length) {
	return 30;
}
add_filter('excerpt_length', 'custom_excerpt_length', 999);

function wpdocs_excerpt_more( $more ) {
    return '';
}
add_filter( 'excerpt_more', 'wpdocs_excerpt_more' );



function exclude_category($query) {
	$query->set('cat','-1');
	return $query;
}
add_filter('pre_get_posts','exclude_category');

/*
    =====================
     Include Walker File
    =====================

*/
require get_template_directory() . '/inc/walker.php'; 
