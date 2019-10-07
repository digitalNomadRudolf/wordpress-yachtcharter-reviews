<?php 

class Walker_Nav_Primary extends Walker_Nav_menu {

        function start_lvl( &$output, $depth = 0, $args = array() ) {
            $indent = str_repeat("\t", $depth);
            $submenu = ($depth > 0 ? 'sub-menu' : '');
            /* $output .= "\n$indent<ul id=\"menu\" class=\"menu$submenu depth_$depth\">\n"; */
        }

        function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {

            $indent = ($depth) ? str_repeat("\t", $depth) : '';

            $li_attributes = '';
            $class_names = $value = '';
            $classes = empty($item->classes) ? array() : (array) $item->classes;
            $classes[] = ($args->walker->has_children) ? 'dropdown' : ''; // maybe dropdown if it doesnt work
            $classes[] = ($item->current || $item->current_item_ancestor) ? 'active' : '';
            $classes[] = 'menu-item-' . $item->ID;
            
            if($depth && $args->walker->has_children) {
                $classes[] = 'menu-sub';
            }

            $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args));
            $class_names = ' class="' . esc_attr($class_names) . '"';

            $id = apply_filters('nav_menu_item_id', 'menu-item-' .$item->ID, $item, $args);
            $id = strlen($id) ? 'id="' . esc_attr($id) . '"' : ''; 

            $output .= $indent . '<li ' . $id . $value . $class_names . $li_attributes . '>';

            $attributes = !empty($item->attr_title) ? ' title="' . esc_attr($item->attr_title) . '"' : '';
            $attributes .= !empty($item->target) ? ' target="' . esc_attr($item->target) . '"' : '';
            $attributes .= !empty($item->xfn) ? ' rel="' . esc_attr($item->xfn) . '"' : '';
            $attributes .= !empty($item->url) ? ' href="' . esc_attr($item->url) . '"' : ''; 
            $attributes .= $depth > 0 ? 'class="sub-link"' : '';
            
            /* $attributes .= ($args->walker->has_children) && $depth > 0 ? 'class="sub-link"' : '';  */

                $item_output = $args->before;
                $item_output .= '<a' . $attributes . '>'; 
                $item_output .= apply_filters('the_title', $item->title, $item->ID);
                $item_output .= '</a>';
                $item_output .= $args->after;
                
                
            
            $output .= apply_filters ( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );

            if($depth == 0 && $args->walker->has_children) {
                $output .= '<ul class="menu-sub">';
            }
        }

        function end_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
            $output .= '</a>';
        }

        function end_lvl( &$output, $depth = 0, $args = array() ) {
            $output .= '</ul>';
        }

}


?>