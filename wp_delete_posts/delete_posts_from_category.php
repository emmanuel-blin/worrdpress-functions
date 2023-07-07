

<?php 

get_header();
?>



<?php


   $category_id = 6; // The Cat Id
   $days_old = 30; // Number of days after which posts should be deleted
   $category = get_category($category_id);

    $args = array(
       'category' => $category_id,
       'date_query' => array(
           array(
               'before' => $days_old . ' days ago',
               'inclusive' => true, //indicating that the posts within the specified date range should also include the boundary dates
           ),
       ),
       'posts_per_page' => -1,
       'fields' => 'ids', // indicating that only the post IDs should be returned, rather than the full post objects.
   );

   $posts = get_posts($args);

?>


   <div style="max-width: 33%; margin-inline: auto;">
   <h3 style="text-decoration:underline; color: red; font-size: 1.3rem; font-weight: 900;">Delete posts !</h3>
   <p style="color: red; font-size: 1.1rem; font-weight: 900;">Be careful this is definitive !</p>


   <form method="post">
      <button type="submit" name="delete_all_posts">Delete them all</button>
   </form>
<?php
   if (isset($_POST['delete_all_posts'])) {
    // Display a confirmation message and a button to proceed with deletion
    echo "Are you sure you want to delete all posts?";
    echo '<form method="post">';
    echo '<button type="submit" name="confirm_delete_all_posts">Yes, delete all posts</button>'; // This button is not definitive
    echo '</form>';
} elseif (isset($_POST['confirm_delete_all_posts'])) {
    // Get all post IDs
    $post_ids = $posts;
    // Loop through each post ID and delete the post
    foreach ($post_ids as $post_id) {
        wp_delete_post($post_id, false); // Set the second parameter to true to permanently delete the post, or false to move to the trash
    }
    // Display a message confirming deletion
    echo "All posts have been deleted.";
}

   foreach ($posts as $post_id) {

      $link = get_the_permalink($post_id);
      ?>

<div style="display: flex; flex-wrap: wrap; gap: 1rem;">
        <a style="display: flex;" href="<?php echo $link ?>">
            <p style="color: #000;"><?php echo get_the_title($post_id). ' '; ?></p>
        </a>
        <!-- Button to delete  the current post -->
        <form method="post" style="margin-inline-start: auto;">
            <input type="hidden" name="post_id" value="<?php echo $post_id; ?>">
            <button
                  type="submit"
                  name="delete_post"
                  style="background: red; color:#fff; fot-weight: 700; outline: none; border-color:red;">
                  Supprimer
            </button>
        </form>
</div>
<hr/>
    <?php
}



if (isset($_POST['delete_post'])) {
    $post_id = $_POST['post_id'];
    wp_delete_post($post_id, true); // Set the second parameter to true to permanently delete the post or false to move to trash
    echo "Post : " . $post_id . "has been deleted";
}

?>
</div>

<?php
get_footer();

?>

