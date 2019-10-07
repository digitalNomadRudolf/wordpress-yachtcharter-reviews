<form id="searchform" method="get" action="<?php echo home_url( '/' ); ?>">
    <input type="text" class="search-field" name="s" placeholder="Search" value="<?php the_search_query(); ?>">
    <!-- <a href="javascript:{}" type="submit" onclick="document.getElementById('searchform').submit(); return false;" class="button"> -->
        <button type="submit" class="button" value="<?php the_search_query(); ?>">                
            <i class="fas fa-search"></i>
        </button>
    <!-- </a> -->
</form>