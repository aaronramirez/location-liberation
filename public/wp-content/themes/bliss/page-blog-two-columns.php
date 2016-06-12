<?php
	/* Template name: Blog: Two Columns */ 

$layout = of_get_option('side_bar');
$layout = (empty($layout)) ? 'right_side' : $layout;
$layout = 'single';
$ad_posts_mode = of_get_option('ad_posts_mode', 'none');
$ad_posts_frequency = of_get_option('ad_posts_frequency', 'none');
$ad_posts_box = of_get_option('ad_posts_box', true);

get_header(); ?>


<?php
	// Advert above content
	$ad_content_placement 	= of_get_option('ad_content_placement', array('home' => true,'pages' => true,'posts' => true));
	$ad_content_mode 		= of_get_option('ad_content_mode', 'none');
	$ad_content_box 		= of_get_option('ad_content_box', true);
	$ad_content_padding 		= of_get_option('ad_content_padding', true);

	if($ad_content_mode != 'none' and $ad_content_placement['home'] == true and is_home()){
		echo '<div class="above_content'.(($ad_content_box) ? ' box' : '').(($ad_content_padding) ? ' pad15' : '').'">';
			if($ad_content_mode == 'image'){
				echo '<a href="'.of_get_option('ad_content_image_link').'" target="_blank"><img src="'.of_get_option('ad_content_image').'"></a>';
			}elseif($ad_content_mode == 'html'){
				echo apply_filters('shortcode_filter',do_shortcode(of_get_option('ad_content_code')));
			}elseif($ad_content_mode == 'google_ads'){
				blu_get_google_ads(); 
			}
		echo '</div>';
	}
?>
	<style type="text/css">
	.author-image{ display: none; }
	.entry-content p{ font-size: 14px; display: none; }
	.entry-content p:first-child{ display: block; }
	/*.entry-content{ display: none; }*/
	</style>
	<div id="primary" class="row <?php echo $layout; ?>">
		
		<?php if($layout == 'both_side'){ ?>
		<aside id="side-bar" class="span3 widget-area">
				<?php dynamic_sidebar( 'sidebar_left' ); ?>
		</aside>
		<?php } ?>	

		<div id="content" class="twocolumn span10 offset1" role="main">
			<div class="row-fluid">
				<div id="above-blog" class="widget-area">
					<?php dynamic_sidebar( 'above_blog' ); ?>
				</div>
			</div>
			<div class="columns"> <?php
				global $post;
				wp_reset_postdata();
				$myposts = get_posts(array(
					'posts_per_page'   => 10,
/*				  	'tax_query' => array( array(
				      		'taxonomy' => 'post_format',
				      		'field' => 'slug',
				      		'terms' => 'post-format-status',
				      		'operator' => 'NOT IN' ) )*/
				  	));
					foreach( $myposts as $post ) : setup_postdata($post); 
						get_template_part( 'inc/post-format/content', get_post_format() );
					endforeach; 


				// kriesi_pagination(); 

				?> 
			</div><!-- .columns --><? kriesi_pagination(); ?>
		</div><!-- #content -->

		<?php if($layout == 'left_side'){ ?>
		<aside id="side-bar" class="span4 widget-area">
				<?php dynamic_sidebar( 'sidebar_left'); ?>
		</aside>
		<?php } ?>	
		<?php if($layout == 'right_side'){ ?>
		<aside id="side-bar" class="span4 widget-area">
				<?php dynamic_sidebar( 'sidebar_right' ); ?>
		</aside>
		<?php } ?>		
		<?php if($layout == 'both_side'){ ?>
		<aside id="side-bar" class="span3 widget-area">
				<?php dynamic_sidebar( 'sidebar_right' ); ?>
		</aside>
		<?php } ?>		
	</div><!-- #primary -->
<?php get_footer(); ?>