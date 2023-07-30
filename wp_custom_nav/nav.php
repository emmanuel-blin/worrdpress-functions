
<?php
// Include the custom walker file
require_once get_template_directory() . '/parts/custom-category-walker.php';
?>



 <nav class="bg-white w-full">
   <div class="max-w-screen flex flex-wrap items-center justify-between mx-auto">
     <a href="/" class="flex items-center logo">
         <img src="<?php bloginfo('template_url');?>Path_To_Logo" class="h-auto w-[8rem] md:w-full" alt="" />
     </a>
     <button data-collapse-toggle="navbar-default" type="button" class="inline-flex items-center p-2 ml-3 text-sm text-gray-500 rounded-lg xl:hidden hover:ring-2 hover:ring-black focus:outline-none focus:ring-2 focus:ring-black text-color " aria-controls="navbar-default" aria-expanded="false">
       <span class="sr-only">Ouvrir le menu</span>
       <svg class="w-10 h-10" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path></svg>
     </button> 

     <div class="hidden w-full xl:flex md:w-auto flex" id="navbar-default">
      

     <?php
            $args = array(
                'theme_location' => 'primary-menu',
                'container'      => 'ul',
                'menu_class'     => 'font-medium flex flex-col md:items-center p-4 md:p-0 mt-4 md:flex-row md:space-x-8 md:mt-0 md:border-0',
                'walker'         => new Custom_Nav_Walker(),
                'style'          => '',
            );
            wp_nav_menu($args);
            ?>

      <a href="icon url" target="_blank" class="py-2 px-3"><img src="<?php bloginfo('template_url');?>Path_To_Icon" alt=""></a>
     </div>
     
     </div>
 </nav>  
