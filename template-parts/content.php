<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package tahaluf-task
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header ">
	    <section class="head-post" style="background-image: url('<?php echo get_template_directory_uri(); ?>/images/map-bg.png");';background-size:cover>
	        <?php the_breadcrumb(); ?>
	    </section>
	
	</header><!-- .entry-header -->
	<section class="post-contant">
		<?php
		if ( is_singular() ) :
			the_title( '<h1 class="entry-title new-line">', '</h1>' );
		else :
			the_title( '<h2 class="entry-title new-line"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;
		
		if ( 'post' === get_post_type() ) :
			?>
			
			<div class="entry-meta">
			<span><?php tahaluf_task_posted_on() ?></span> | <span> <?php tahaluf_task_entry_footer(); ?></span>

			</div><!-- .entry-meta -->
		<?php endif; ?>

	<?php tahaluf_task_post_thumbnail(); ?>

	<div class="entry-content">
		<?php
		the_content(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'tahaluf-task' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				wp_kses_post( get_the_title() )
			)
		);

		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'tahaluf-task' ),
				'after'  => '</div>',
			)
		);
		?>
	</div><!-- .entry-content -->
	<footer class="entry-footer">
		
	</footer><!-- .entry-footer -->
	<!-- #post-<?php the_ID(); ?> -->
	</section>
</article>
