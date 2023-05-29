# Wordpress New Feed Generator

### Description 

Those Wordpress Functions will generate a custom XML feed with the requirement for Google News Publisher, 

`single_story_panel.php`
Create an rss feed for the single story panel with related content,

`<g:panel type="SINGLE_STORY"></g:panel`

---------------------------------------------------------------------

`rundown_panel.php`
Create a rss feed for the rundown panel, with the 3 last published articles,

`<g:panel type="RUNDOWN"></g:panel>`

---------------------------------------------------------------------

`rundown_single_atom.php`
create a atom feed for the rundown panel,  with the 3 last published articles, and a single story panel with the 3 last article from a choosen category,

`<g:panel type="RUNDOWN"></g:panel>`

`<g:panel type="SINGLE_STORY"></g:panel`

`
  $psotCount = 2;
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
                           // new entry tags here 
                               <?php
                          endwhile;
                      }
                       ?>
`

---------------------------------------------------------------------

### Display the new feeds

Go to Setting -> Permalinks 
Click the " Save Changes "

and access your new feed via yourDomain[.]com/feed/XMLFeedName


NB : That's not a perfect solution, this is still in progress, feel free to give input for improuvement :) 
