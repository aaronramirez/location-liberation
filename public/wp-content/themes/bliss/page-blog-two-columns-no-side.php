<?php
	/* Template name: Blog: Two Columns No Sidebar */ 

	$layout = of_get_option('side_bar');
	$layout = (empty($layout)) ? 'right_side' : $layout;
	$hide_title = get_post_meta( $post->ID, 'bluth_page_hide_title', 'off' );
	get_header(); 

?>
	<div id="primary" class="row-fluid">
		<div id="content" class="twocolumn span10 offset1" role="main">
			<div class="row-fluid">
			<?php 
				global $post;
				wp_reset_postdata();
				$myposts = get_posts(array(
					'posts_per_page'   => 10));
				$i = 1;
				?><div class="span6"><?php
					foreach( $myposts as $post ) : setup_postdata($post); 
						if(is_float($i/2)){

							?><div class="row-fluid"><?php
								get_template_part( 'inc/post-format/content', get_post_format() );
							?></div><?php
						}
						$i++;
					endforeach; 
				?></div><?php
				$i = 1;
				wp_reset_postdata();
				?><div class="span6"><?php
					foreach( $myposts as $post ) : setup_postdata($post); 
						if(!is_float($i/2)){

							?><div class="row-fluid"><?php
								get_template_part( 'inc/post-format/content', get_post_format() );
							?></div><?php
						}
						$i++;
					endforeach; 
				?></div><?php

				kriesi_pagination(); 

				?> 
			</div><!-- .row-fluid -->
		</div><!-- #content -->

	</div><!-- #primary .content-area -->
<?php get_footer(); ?>