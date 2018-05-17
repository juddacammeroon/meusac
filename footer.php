	</div><!-- Row End -->
</div><!-- Container End -->
<?php if ( is_single() ) { ?>
	<?php if (has_category('news')){?>
		<?php echo do_shortcode('[post-footer category="news" title="news"]');?>
	<?php }?>
	<?php 
		if (has_category('notice-boards')){
			$css_slug = '';
			$category = get_the_category(); 
			echo do_shortcode('[post-footer category="notice-boards" title="notices"]');
		}
	?>
<?php }?>
<footer id="footer">
	<div class="row">
		<div class="large-3 columns">
			<?php if ( is_active_sidebar( 'footer-1' ) ) { ?>
				<ul id="footer-1-sidebar" class="footer-sidebar">
					<?php dynamic_sidebar( 'footer-1' ); ?>
				</ul>
			<?php } ?>
		</div>
		<div class="large-3 columns">
			<?php if ( is_active_sidebar( 'footer-2' ) ) { ?>
				<ul id="footer-2-sidebar" class="footer-sidebar">
					<?php dynamic_sidebar( 'footer-2' ); ?>
				</ul>
			<?php } ?>
		</div>
		<div class="large-6 columns">
			<?php if ( is_active_sidebar( 'footer-3' ) ) { ?>
				<ul id="footer-3-sidebar" class="footer-sidebar">
					<?php dynamic_sidebar( 'footer-3' ); ?>
				</ul>
			<?php } ?>
		</div>
	</div>
</footer>

<?php wp_footer(); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fitvids/1.2.0/jquery.fitvids.min.js"></script>
<script>
  jQuery(document).ready(function($){
    // Target your .container, .wrapper, .post, etc.
    $("body").fitVids();
  });
</script>
</body>
</html>
