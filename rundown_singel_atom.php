<?php 

function custom_atom_feed_combined() {
   add_feed( 'atomrss', 'custom_atom_feed_combined' );
}

add_action( 'init', 'custom_atom_feed_combined' );



function custom_atom_feed_combined() {
   header( 'Content-Type: text/html' );
   header('Content-Type: '.feed_content_type('rss-http').'; charset='.get_option('blog_charset'), true);
   $postCount = 1; // The number of posts to show in the feed
   $posts = query_posts('showposts=' . $postCount);
   $xml = '<?xml version="1.0" encoding="' . get_option('blog_charset') . '"?' . '>';
   $xml .= "\n";
   $xml .= '<feed version="2.0" xmlns="http://www.w3.org/2005/Atom" xmlns:media="http://search.yahoo.com/mrss/" xmlns:g="http://schemas.google.com/pcn/2020">';
   echo $xml;
?>
   <id><?php the_guid(); ?></id>
   <title><?php bloginfo_rss('name'); ?></title>
   <updated><?php echo mysql2date('Y-m-d\TH:i:s\Z', get_lastpostmodified('GMT'), false); ?></updated>
   <?php while (have_posts()) : the_post(); ?>
      <entry>
         <id>panel-rundown-1</id>
         <published><?php echo mysql2date('Y-m-d\TH:i:s\Z', get_post_time('Y-m-d H:i:s', true), false); ?></published>
         <updated><?php echo mysql2date('Y-m-d\TH:i:s\Z', get_post_modified_time('Y-m-d H:i:s', true), false); ?></updated>
         <g:panel type="RUNDOWN">Multiple Articles Panel</g:panel>
         <g:panel_title>Panel Name</g:panel_title>
         <g:article_group type="RUNDOWN">
              <?php endwhile; ?>
              <?php
                        $postCount = 3;
                        $post = query_posts(
                                    array(
                                       'offset' => 0,
                                       'showposts' => $postCount,
                                          )
                                    );
                        while(have_posts()) : the_post(); ?>
                        <entry>
                        <id><?php the_ID(); ?></id>
                        <title><?php the_title_rss(); ?></title>
                        <link href="<?php the_permalink();?>"/>
                        <author><name><?php the_author();?> </name></author>
                        <g:overline>Overline 1</g:overline>
                        <media:content url="<?php the_post_thumbnail_url();?>"></media:content>
                        </entry>

                     <?php endwhile; ?>
         </g:article_group>
      </entry>
      <entry>
      <?php
                      $postCount = 1;
                      $category = get_category_by_slug('category_slug');
                      if ($category) {
                          $post = query_posts(
                              array(
                                  'offset' => 0,
                                  'showposts' => $postCount,
                                  'category__in' => array($category->term_id),
                              )
                          );
                          while (have_posts()) : the_post();?>
             <id>Panel-single-1</id>
             <published><?php echo mysql2date('Y-m-d\TH:i:s\Z', get_post_time('Y-m-d H:i:s', true), false); ?></published>
             <updated><?php echo mysql2date('Y-m-d\TH:i:s\Z', get_post_modified_time('Y-m-d H:i:s', true), false); ?></updated>
             <g:panel type="SINGLE_STORY">Single Panel With Related Content</g:panel>
             <g:panel_title>Panel Name</g:panel_title>
             <g:overline>Category Name</g:overline>
             <title><?php the_title_rss();?></title>
             <summary></summary>
             <author><name><?php the_author();?> </name></author>
             <link href="<?php the_permalink();?>"/>
             <media:content url="<?php the_post_thumbnail_url();?>"></media:content>
             <?php
                          endwhile;
                      }
                       ?>
             <g:article_group role="RELATED_CONTENT">
               <?php
                      $postCount = 2;
                      $category = get_category_by_slug('category_slug');
                      if ($category) {
                          $post = query_posts(
                              array(
                                  'offset' => 1,
                                  'showposts' => $postCount,
                                  'category__in' => array($category->term_id),
                              )
                          );
                          while (have_posts()) : the_post();?>
               <entry>
                  <id><?php the_ID(); ?></id>
                  <g:overline>Category Name</g:overline>
                  <title><?php the_title_rss();?></title>
                  <link><?php the_permalink(); ?></link>
                  <author><name><?php the_author();?> </name></author>
                  <media:content url="<?php the_post_thumbnail_url();?>"></media:content>
               </entry>
               <?php endwhile; 
            } 
            ?>
         </g:article_group>
      </entry>
   </feed>
<?php
}
