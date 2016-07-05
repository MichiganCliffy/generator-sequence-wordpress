<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package <%= ThemeName %>
 */

?>

  	</div><!-- .row -->
  </div><!-- .main-content -->

	<footer class="global-footer container" role="contentinfo">
    <section class="col-xs-12 col-md-6 col-lg-5">
      <h1>Links</h1>
      <?php wp_nav_menu( array('menu' => 'footer-nav', 'menu_class' => 'footer-nav') ); ?>
    </section>
    <?php dynamic_sidebar( 'sidebar-footer' ); ?>
	</footer>

<?php wp_footer(); ?>

</body>
</html>
