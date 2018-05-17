</div><!-- Container End -->

<footer id="footer">
	<div class="row">
		<div class="large-4 columns">
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
		<div class="large-5 columns">
			<?php if ( is_active_sidebar( 'footer-3' ) ) { ?>
				<ul id="footer-3-sidebar" class="footer-sidebar">
					<?php dynamic_sidebar( 'footer-3' ); ?>
				</ul>
			<?php } ?>
		</div>
	</div>
</footer>

<?php  wp_footer(); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fitvids/1.2.0/jquery.fitvids.min.js"></script>
<script>
  jQuery(document).ready(function($){
    // Target your .container, .wrapper, .post, etc.
    $("body").fitVids();
  });
</script>
</body>
</html>
