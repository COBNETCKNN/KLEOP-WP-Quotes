<?php
/**
 * The template for displaying a "No posts found" message
 *
 * @package WordPress
 * @subpackage Kleo
 * @since Kleo 1.0
 */
?>

<div class="page-content text-center">
	<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

	<p><?php echo wp_kses_post( sprintf( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'kleo' ), esc_url( admin_url( 'post-new.php' ) ) ) ); ?></p>

	<?php elseif ( is_search() ) : ?>

	<p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'kleo' ); ?></p>
	<?php /* get_search_form(); */ ?>

	<?php else : ?>

	<h4><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'kleo' ); ?></h4>
	<?php /* get_search_form(); */ ?>

	<?php endif; ?>
</div><!-- .page-content -->
