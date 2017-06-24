<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Afrin
 */
?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
            
        <?php get_sidebar( 'footer' ); ?>
                
		<div class="site-info">
			<?php printf( __( 'Theme: %1$s by %2$s.', 'afrin' ), 'Afrin', '<a href="http://ebangali.com/">eBangali</a>' ); ?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
