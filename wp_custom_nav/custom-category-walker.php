<?php 

class Custom_Nav_Walker extends Walker_Nav_Menu {
  public function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
      $indent = str_repeat("\t", $depth);
      $output .= $indent . '<li>';

      if ('category' === $item->object) {
          // For categories, use get_category_link() function
          $cat_url = get_category_link($item->object_id);
          $output .= '<a  class="block py-2 pl-3 pr-4 rounded md:border-0 md:p-0 text-color font-bold" href="' . esc_attr($cat_url) . '" >' . esc_attr($item->title) . '</a>';
      } elseif ('page' === $item->object) {
          // For pages, use get_permalink() function
          $page_url = get_permalink($item->object_id);
          $output .= '<a class="block py-2 pl-3 pr-4 rounded md:border-0 md:p-0 text-color font-bold" href="' . esc_attr($page_url) . '">' . esc_attr($item->title) . '</a>';
      } else {
          // For other menu items, use get_permalink() function
          $item_url = get_permalink($item->object_id);
          $output .= '<a class="block py-2 pl-3 pr-4 rounded md:border-0 md:p-0 text-color font-bold" href="' . esc_attr($item_url) . '">' . esc_attr($item->title) . '</a>';
      }
  }

  public function end_el(&$output, $item, $depth = 0, $args = array()) {
              $output .= "</li>\n";
              
  }
}
