<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package tahaluf-task
 */

get_header();
?>

	<main id="primary" class="site-main">

      <?php  
	   $catSlug = $_POST['cat'];
      if(!isset($_POST['submit'])){
          $args = array(
            'post_type'      => 'post',
            'posts_per_page' => 4,
            'order'   => 'DESC',
            'orderby' => 'date',
            'paged' => 1
        );
      }else {
          $args = array(
            'post_type'      => 'post',
            'posts_per_page' => -1,
            'order'   => 'ASC',
            'orderby' => 'date',
            'date_query' => array(
                array(
                    'after' => @$_POST['fromDate'],
                    'before' => @$_POST['toDate'],
                    'inclusive' => true,
                )
                  
            ), 'category_name' => @$catSlug,
        );
      }
      
        
        $query = new WP_Query($args);
        ?>
        <div class="content">
        
        <?php
        if ( $query->have_posts() ) : ?>
        
    <div class="container">
        <div id="mySidebar" class="sidebar">
          <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
         <form method="POST" class="filter-form">
             <p> Filter By Category </p>
          <select name="cat" class="filter-select">
               <?php 
                    $categories = get_categories();
                    foreach($categories as $category) {?>
                      <option vlaue="<?php echo get_cat_ID($category->name); ?> "> <?php echo $category->name; ?></option>
                    <?php } ?>
               
          </select>
          <p>Date: </p>
          <input type="text" name="fromDate" required id="fromDate" value=""> 
          <p>TO</p>
           <input type="text" name="toDate" id="toDate" required value=""></p>
           <input class="reset" type="reset" required value="Clear Filters"/>
           <input type="submit" name="submit" class="apply-filter" value="Apply Filter" />
        </form>
         
        </div>
        
                    

    <div id="main">
       <?php if(!isset($_POST['submit'])){?>
      
		<?php if(!isset($_POST['submit'])){?>
		<div class="content card card-title" style="padding:0 20px">
			<h2>Welcome To</h2>
			<h1 style="color:#D3202E">Tahaluf task</h1>
			<p>List of Posts 2023</p>
			<button class="openbtn" onclick="openNav()">Modify Filter</button>
			<?php } ?>
		</div>
      <?php } ?>
         
    </div>
    <?php if (isset($_POST['cat'])){?>
          <div class="filter-meta">
           <span><?php echo @$_POST['cat']; ?></span>
           <span><?php echo @$_POST['fromDate']; ?></span>
           <span><?php echo @$_POST['toDate']; ?></span>
        </div>
         <?php } ?> 
                <div class="new-loading">
                    <?php if(isset($_POST['submit'])){?>
                    <div class="content card card-title" style="padding:0 20px">
                        <h2>Welcome To</h2>
                        <h1 style="color:#D3202E">Tahaluf task</h1>
                        <p>List of Postst 2023</p>
                        <button class="openbtn" style="cursor:unset;">Filter Results</button>
                    </div>
                  <?php } ?>
					                    
                    <?php while ( $query->have_posts() ) : $query->the_post();?>
                        <?php get_template_part( 'template-parts/blog-grid' );?>
                    <?php endwhile; ?>
                    
                </div><!-- row -->
                <?php if(!isset($_POST['submit'])){?>
                    <div class="btn__wrapper">
                      <a href="#!" class="btn load" id="load-more">Load more</a>
                    </div>
                <?php } ?>
                
            </div><!-- ontainer -->
        

        <?php else :?>
            <?php get_template_part( 'template-parts/content', 'none' );?>
        <?php endif; ?>
    
	</main><!-- #main -->

<?php
get_sidebar();
get_footer();
