<?php

function custom_feed_rundown() {
   add_feed( 'XMLFeedName', 'custom_feed_rundown' );
}

add_action( 'init', 'custom_feed_rundown' );

function custom_feed_rundown() {
   header( 'Content-Type: text/html' );
   $postCount = 1; // The number of posts to show in the feed
   $posts = query_posts('showposts=' . $postCount);
header('Content-Type: '.feed_content_type('rss-http').'; charset='.get_option('blog_charset'), true);
echo '<?xml version="1.0" encoding="'.get_option('blog_charset').'"?'.'>';
?>
<rss version="2.0"
        xmlns:content="http://purl.org/rss/1.0/modules/content/"
        xmlns:media="http://search.yahoo.com/mrss/"
        xmlns:g="http://schemas.google.com/pcn/2020"
         xmlns:wfw="http://wellformedweb.org/CommentAPI/"
         xmlns:dc="http://purl.org/dc/elements/1.1/"
         xmlns:atom="http://www.w3.org/2005/Atom"
         xmlns:sy="http://purl.org/rss/1.0/modules/syndication/"
         xmlns:slash="http://purl.org/rss/1.0/modules/slash/"
        <?php do_action('rss2_ns'); ?>>
<channel>
        <title><?php bloginfo_rss('name'); ?></title>
        <atom:link href="<?php self_link(); ?>" rel="self" type="application/rss+xml" />
        <link><?php bloginfo_rss('url') ?></link>
        <description><?php bloginfo_rss('description') ?></description>
        <lastBuildDate><?php echo mysql2date('D, d M Y H:i:s +0000', get_lastpostmodified('GMT'), false); ?></lastBuildDate>
        <language><?php bloginfo_rss( 'language' ); ?></language>
        <sy:updatePeriod><?php echo apply_filters( 'rss_update_period', 'hourly' ); ?></sy:updatePeriod>
        <sy:updateFrequency><?php echo apply_filters( 'rss_update_frequency', '1' ); ?></sy:updateFrequency>
        <?php do_action('rss2_head'); ?>
        <?php while(have_posts()) : the_post(); ?>
         <item>
               <g:panel type="RUNDOWN"></g:panel>
               <g:panel_title>Panel Title</g:panel_title>
                  <guid isPermaLink="false"><?php the_guid(); ?></guid>
                  <pubDate><?php echo mysql2date('D, d M Y H:i:s +0000', get_post_time('Y-m-d H:i:s', true), false); ?></pubDate>
                  <title><?php the_title_rss(); ?></title>
                  <author>
                   <?php the_author(); ?>
                  </author>
                  <description>
                     <?php 
                     $data = get_excerpt(75);
                     echo wp_filter_nohtml_kses($data);
                     ?>
                  </description>
                  <link><?php the_permalink_rss(); ?></link>
                  <media:content url="<?php the_post_thumbnail_url() ?>"></media:content>
                  <?php endwhile;?>
                  <g:article_group role="RUNDOWN">
                        <?php
                        $postCount = 2;
                        $post = query_posts(
                                    array(
                                       'offset' => 1,
                                       'showposts' => $postCount,
                                          )
                                    );
                        while(have_posts()) : the_post(); ?>
                       <g:item>
                           <guid isPermalink="true"><?php the_guid(); ?></guid>
                           <title><?php the_title_rss() ?></title>
                           <author>
                              <?php the_author(); ?>
                           </author>
                           <link><?php the_permalink_rss() ?></link>
                           <media:content url="<?php the_post_thumbnail_url() ?>"></media:content>
                      </g:item>
                      <?php endwhile; ?>
                     </g:article_group>
               <?php rss_enclosure(); ?>
               <?php do_action('rss2_item'); ?>
         </item>
</channel>
</rss>
<?php

}