<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other 'pages' on your WordPress site will use a different template.
 *
 * @package Wordpress
 * @subpackage Kleo
 * @since Kleo 1.0
 */

get_header(); ?>

<?php get_template_part('page-parts/general-title-section'); ?>

<?php get_template_part('page-parts/general-before-wrap'); ?>

<?php if ( have_posts() ) : ?>
    <?php
	// Start the Loop.
	while ( have_posts() ) : the_post();
    ?>

        <?php
		/*
		 * Include the post format-specific template for the content. If you want to
		 * use this in a child theme, then include a file called called content-___.php
		 * (where ___ is the post format) and that will be used instead.
		 */
	//	get_template_part( 'content', 'page' );
        ?>

        <?php get_template_part( 'page-parts/posts-social-share' ); ?>

        <?php if ( sq_option( 'page_comments', 0 ) == 1 ): ?>

            <!-- Begin Comments -->
            <?php
			if ( comments_open() || get_comments_number() ) {
				comments_template( '', true );
			} ?>
            <!-- End Comments -->

        <?php endif; ?>


	<?php endwhile; ?>

<?php 

add_filter( 'terms_clauses', 'terms_clauses_47840519', 10, 3 );
function terms_clauses_47840519( $clauses, $taxonomies, $args ){
    global $wpdb;

    if( !isset( $args['__first_letter'] ) ){
        return $clauses;
    }

    $clauses['where'] .= ' AND ' . $wpdb->prepare( "t.name LIKE %s", $wpdb->esc_like( $args['__first_letter'] ) . '%' );

    return $clauses;

}


// LIST ALL CATEGORIES WITH LETTER A
?>
<div class="authorsByLetter">
	<h4 class="authorsByLetters-title">A:</h4>
	<?php
	$terms = get_terms( array(
		'taxonomy' => 'category',
		'__first_letter' => 'a', // desired first letter
	) );

	if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
		echo '<ul class="authorsByLetters">';
		foreach ( $terms as $term ) {
			$term_link = get_term_link( $term );

			echo '<li class="authorsByLetters-item"><a href="' . $term_link . '">' . $term->name . '&nbsp;('. $term->count .')'.'</a></li>';
			
		}
		echo '</ul>';
	}

	?>
</div>

<?php
// LIST ALL CATEGORIES WITH LETTER B
?>
<div class="authorsByLetter">
	<h4 class="authorsByLetters-title">B:</h4>
	<?php
	$terms = get_terms( array(
		'taxonomy' => 'category',
		'__first_letter' => 'b', // desired first letter
	) );

	if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
		echo '<ul class="authorsByLetters">';
		foreach ( $terms as $term ) {
			$term_link = get_term_link( $term );

			echo '<li class="authorsByLetters-item"><a href="' . $term_link . '">' . $term->name . '&nbsp;('. $term->count .')'.'</a></li>';
			
		}
		echo '</ul>';
	}

	?>
</div>

<?php
// LIST ALL CATEGORIES WITH LETTER C
?>
<div class="authorsByLetter">
	<h4 class="authorsByLetters-title">C:</h4>
	<?php
	$terms = get_terms( array(
		'taxonomy' => 'category',
		'__first_letter' => 'c', // desired first letter
	) );

	if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
		echo '<ul class="authorsByLetters">';
		foreach ( $terms as $term ) {
			$term_link = get_term_link( $term );

			echo '<li class="authorsByLetters-item"><a href="' . $term_link . '">' . $term->name . '&nbsp;('. $term->count .')'.'</a></li>';
			
		}
		echo '</ul>';
	}

	?>
</div>

<?php
// LIST ALL CATEGORIES WITH LETTER D
?>
<div class="authorsByLetter">
	<h4 class="authorsByLetters-title">D:</h4>
	<?php
	$terms = get_terms( array(
		'taxonomy' => 'category',
		'__first_letter' => 'd', // desired first letter
	) );

	if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
		echo '<ul class="authorsByLetters">';
		foreach ( $terms as $term ) {
			$term_link = get_term_link( $term );

			echo '<li class="authorsByLetters-item"><a href="' . $term_link . '">' . $term->name . '&nbsp;('. $term->count .')'.'</a></li>';
			
		}
		echo '</ul>';
	}

	?>
</div>

<?php
// LIST ALL CATEGORIES WITH LETTER E
?>
<div class="authorsByLetter">
	<h4 class="authorsByLetters-title">E:</h4>
	<?php
	$terms = get_terms( array(
		'taxonomy' => 'category',
		'__first_letter' => 'e', // desired first letter
	) );

	if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
		echo '<ul class="authorsByLetters">';
		foreach ( $terms as $term ) {
			$term_link = get_term_link( $term );

			echo '<li class="authorsByLetters-item"><a href="' . $term_link . '">' . $term->name . '&nbsp;('. $term->count .')'.'</a></li>';
			
		}
		echo '</ul>';
	}

	?>
</div>

<?php
// LIST ALL CATEGORIES WITH LETTER F
?>
<div class="authorsByLetter">
	<h4 class="authorsByLetters-title">F:</h4>
	<?php
	$terms = get_terms( array(
		'taxonomy' => 'category',
		'__first_letter' => 'f', // desired first letter
	) );

	if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
		echo '<ul class="authorsByLetters">';
		foreach ( $terms as $term ) {
			$term_link = get_term_link( $term );

			echo '<li class="authorsByLetters-item"><a href="' . $term_link . '">' . $term->name . '&nbsp;('. $term->count .')'.'</a></li>';
			
		}
		echo '</ul>';
	}

	?>
</div>

<?php
// LIST ALL CATEGORIES WITH LETTER G
?>
<div class="authorsByLetter">
	<h4 class="authorsByLetters-title">G:</h4>
	<?php
	$terms = get_terms( array(
		'taxonomy' => 'category',
		'__first_letter' => 'g', // desired first letter
	) );

	if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
		echo '<ul class="authorsByLetters">';
		foreach ( $terms as $term ) {
			$term_link = get_term_link( $term );

			echo '<li class="authorsByLetters-item"><a href="' . $term_link . '">' . $term->name . '&nbsp;('. $term->count .')'.'</a></li>';
			
		}
		echo '</ul>';
	}

	?>
</div>

<?php
// LIST ALL CATEGORIES WITH LETTER H
?>
<div class="authorsByLetter">
	<h4 class="authorsByLetters-title">H:</h4>
	<?php
	$terms = get_terms( array(
		'taxonomy' => 'category',
		'__first_letter' => 'h', // desired first letter
	) );

	if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
		echo '<ul class="authorsByLetters">';
		foreach ( $terms as $term ) {
			$term_link = get_term_link( $term );

			echo '<li class="authorsByLetters-item"><a href="' . $term_link . '">' . $term->name . '&nbsp;('. $term->count .')'.'</a></li>';
			
		}
		echo '</ul>';
	}

	?>
</div>

<?php
// LIST ALL CATEGORIES WITH LETTER I
?>
<div class="authorsByLetter">
	<h4 class="authorsByLetters-title">I:</h4>
	<?php
	$terms = get_terms( array(
		'taxonomy' => 'category',
		'__first_letter' => 'i', // desired first letter
	) );

	if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
		echo '<ul class="authorsByLetters">';
		foreach ( $terms as $term ) {
			$term_link = get_term_link( $term );

			echo '<li class="authorsByLetters-item"><a href="' . $term_link . '">' . $term->name . '&nbsp;('. $term->count .')'.'</a></li>';
			
		}
		echo '</ul>';
	}

	?>
</div>

<?php
// LIST ALL CATEGORIES WITH LETTER J
?>
<div class="authorsByLetter">
	<h4 class="authorsByLetters-title">J:</h4>
	<?php
	$terms = get_terms( array(
		'taxonomy' => 'category',
		'__first_letter' => 'j', // desired first letter
	) );

	if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
		echo '<ul class="authorsByLetters">';
		foreach ( $terms as $term ) {
			$term_link = get_term_link( $term );

			echo '<li class="authorsByLetters-item"><a href="' . $term_link . '">' . $term->name . '&nbsp;('. $term->count .')'.'</a></li>';
			
		}
		echo '</ul>';
	}

	?>
</div>

<?php
// LIST ALL CATEGORIES WITH LETTER K
?>
<div class="authorsByLetter">
	<h4 class="authorsByLetters-title">K:</h4>
	<?php
	$terms = get_terms( array(
		'taxonomy' => 'category',
		'__first_letter' => 'k', // desired first letter
	) );

	if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
		echo '<ul class="authorsByLetters">';
		foreach ( $terms as $term ) {
			$term_link = get_term_link( $term );

			echo '<li class="authorsByLetters-item"><a href="' . $term_link . '">' . $term->name . '&nbsp;('. $term->count .')'.'</a></li>';
			
		}
		echo '</ul>';
	}

	?>
</div>

<?php
// LIST ALL CATEGORIES WITH LETTER L
?>
<div class="authorsByLetter">
	<h4 class="authorsByLetters-title">L:</h4>
	<?php
	$terms = get_terms( array(
		'taxonomy' => 'category',
		'__first_letter' => 'l', // desired first letter
	) );

	if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
		echo '<ul class="authorsByLetters">';
		foreach ( $terms as $term ) {
			$term_link = get_term_link( $term );

			echo '<li class="authorsByLetters-item"><a href="' . $term_link . '">' . $term->name . '&nbsp;('. $term->count .')'.'</a></li>';
			
		}
		echo '</ul>';
	}

	?>
</div>

<?php
// LIST ALL CATEGORIES WITH LETTER M
?>
<div class="authorsByLetter">
	<h4 class="authorsByLetters-title">M:</h4>
	<?php
	$terms = get_terms( array(
		'taxonomy' => 'category',
		'__first_letter' => 'm', // desired first letter
	) );

	if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
		echo '<ul class="authorsByLetters">';
		foreach ( $terms as $term ) {
			$term_link = get_term_link( $term );

			echo '<li class="authorsByLetters-item"><a href="' . $term_link . '">' . $term->name . '&nbsp;('. $term->count .')'.'</a></li>';
			
		}
		echo '</ul>';
	}

	?>
</div>

<?php
// LIST ALL CATEGORIES WITH LETTER N
?>
<div class="authorsByLetter">
	<h4 class="authorsByLetters-title">N:</h4>
	<?php
	$terms = get_terms( array(
		'taxonomy' => 'category',
		'__first_letter' => 'n', // desired first letter
	) );

	if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
		echo '<ul class="authorsByLetters">';
		foreach ( $terms as $term ) {
			$term_link = get_term_link( $term );

			echo '<li class="authorsByLetters-item"><a href="' . $term_link . '">' . $term->name . '&nbsp;('. $term->count .')'.'</a></li>';
			
		}
		echo '</ul>';
	}

	?>
</div>

<?php
// LIST ALL CATEGORIES WITH LETTER O
?>
<div class="authorsByLetter">
	<h4 class="authorsByLetters-title">O:</h4>
	<?php
	$terms = get_terms( array(
		'taxonomy' => 'category',
		'__first_letter' => 'o', // desired first letter
	) );

	if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
		echo '<ul class="authorsByLetters">';
		foreach ( $terms as $term ) {
			$term_link = get_term_link( $term );

			echo '<li class="authorsByLetters-item"><a href="' . $term_link . '">' . $term->name . '&nbsp;('. $term->count .')'.'</a></li>';
			
		}
		echo '</ul>';
	}

	?>
</div>

<?php
// LIST ALL CATEGORIES WITH LETTER P
?>
<div class="authorsByLetter">
	<h4 class="authorsByLetters-title">P:</h4>
	<?php
	$terms = get_terms( array(
		'taxonomy' => 'category',
		'__first_letter' => 'p', // desired first letter
	) );

	if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
		echo '<ul class="authorsByLetters">';
		foreach ( $terms as $term ) {
			$term_link = get_term_link( $term );

			echo '<li class="authorsByLetters-item"><a href="' . $term_link . '">' . $term->name . '&nbsp;('. $term->count .')'.'</a></li>';
			
		}
		echo '</ul>';
	}

	?>
</div>

<?php
// LIST ALL CATEGORIES WITH LETTER Q
?>
<div class="authorsByLetter">
	<h4 class="authorsByLetters-title">Q:</h4>
	<?php
	$terms = get_terms( array(
		'taxonomy' => 'category',
		'__first_letter' => 'q', // desired first letter
	) );

	if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
		echo '<ul class="authorsByLetters">';
		foreach ( $terms as $term ) {
			$term_link = get_term_link( $term );

			echo '<li class="authorsByLetters-item"><a href="' . $term_link . '">' . $term->name . '&nbsp;('. $term->count .')'.'</a></li>';
			
		}
		echo '</ul>';
	}

	?>
</div>

<?php
// LIST ALL CATEGORIES WITH LETTER R
?>
<div class="authorsByLetter">
	<h4 class="authorsByLetters-title">R:</h4>
	<?php
	$terms = get_terms( array(
		'taxonomy' => 'category',
		'__first_letter' => 'r', // desired first letter
	) );

	if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
		echo '<ul class="authorsByLetters">';
		foreach ( $terms as $term ) {
			$term_link = get_term_link( $term );

			echo '<li class="authorsByLetters-item"><a href="' . $term_link . '">' . $term->name . '&nbsp;('. $term->count .')'.'</a></li>';
			
		}
		echo '</ul>';
	}

	?>
</div>

<?php
// LIST ALL CATEGORIES WITH LETTER S
?>
<div class="authorsByLetter">
	<h4 class="authorsByLetters-title">S:</h4>
	<?php
	$terms = get_terms( array(
		'taxonomy' => 'category',
		'__first_letter' => 's', // desired first letter
	) );

	if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
		echo '<ul class="authorsByLetters">';
		foreach ( $terms as $term ) {
			$term_link = get_term_link( $term );

			echo '<li class="authorsByLetters-item"><a href="' . $term_link . '">' . $term->name . '&nbsp;('. $term->count .')'.'</a></li>';
			
		}
		echo '</ul>';
	}

	?>
</div>

<?php
// LIST ALL CATEGORIES WITH LETTER T
?>
<div class="authorsByLetter">
	<h4 class="authorsByLetters-title">T:</h4>
	<?php
	$terms = get_terms( array(
		'taxonomy' => 'category',
		'__first_letter' => 't', // desired first letter
	) );

	if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
		echo '<ul class="authorsByLetters">';
		foreach ( $terms as $term ) {
			$term_link = get_term_link( $term );

			echo '<li class="authorsByLetters-item"><a href="' . $term_link . '">' . $term->name . '&nbsp;('. $term->count .')'.'</a></li>';
			
		}
		echo '</ul>';
	}

	?>
</div>

<?php
// LIST ALL CATEGORIES WITH LETTER U
?>
<div class="authorsByLetter">
	<h4 class="authorsByLetters-title">U:</h4>
	<?php
	$terms = get_terms( array(
		'taxonomy' => 'category',
		'__first_letter' => 'U', // desired first letter
	) );

	if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
		echo '<ul class="authorsByLetters">';
		foreach ( $terms as $term ) {
			$term_link = get_term_link( $term );

			echo '<li class="authorsByLetters-item"><a href="' . $term_link . '">' . $term->name . '&nbsp;('. $term->count .')'.'</a></li>';
			
		}
		echo '</ul>';
	}

	?>
</div>

<?php
// LIST ALL CATEGORIES WITH LETTER V
?>
<div class="authorsByLetter">
	<h4 class="authorsByLetters-title">V:</h4>
	<?php
	$terms = get_terms( array(
		'taxonomy' => 'category',
		'__first_letter' => 'v', // desired first letter
	) );

	if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
		echo '<ul class="authorsByLetters">';
		foreach ( $terms as $term ) {
			$term_link = get_term_link( $term );

			echo '<li class="authorsByLetters-item"><a href="' . $term_link . '">' . $term->name . '&nbsp;('. $term->count .')'.'</a></li>';
			
		}
		echo '</ul>';
	}

	?>
</div>

<?php
// LIST ALL CATEGORIES WITH LETTER W
?>
<div class="authorsByLetter">
	<h4 class="authorsByLetters-title">W:</h4>
	<?php
	$terms = get_terms( array(
		'taxonomy' => 'category',
		'__first_letter' => 'w', // desired first letter
	) );

	if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
		echo '<ul class="authorsByLetters">';
		foreach ( $terms as $term ) {
			$term_link = get_term_link( $term );

			echo '<li class="authorsByLetters-item"><a href="' . $term_link . '">' . $term->name . '&nbsp;('. $term->count .')'.'</a></li>';
			
		}
		echo '</ul>';
	}

	?>
</div>

<?php
// LIST ALL CATEGORIES WITH LETTER X
?>
<div class="authorsByLetter">
	<h4 class="authorsByLetters-title">X:</h4>
	<?php
	$terms = get_terms( array(
		'taxonomy' => 'category',
		'__first_letter' => 'x', // desired first letter
	) );

	if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
		echo '<ul class="authorsByLetters">';
		foreach ( $terms as $term ) {
			$term_link = get_term_link( $term );

			echo '<li class="authorsByLetters-item"><a href="' . $term_link . '">' . $term->name . '&nbsp;('. $term->count .')'.'</a></li>';
			
		}
		echo '</ul>';
	}

	?>
</div>

<?php
// LIST ALL CATEGORIES WITH LETTER Y
?>
<div class="authorsByLetter">
	<h4 class="authorsByLetters-title">Y:</h4>
	<?php
	$terms = get_terms( array(
		'taxonomy' => 'category',
		'__first_letter' => 'y', // desired first letter
	) );

	if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
		echo '<ul class="authorsByLetters">';
		foreach ( $terms as $term ) {
			$term_link = get_term_link( $term );

			echo '<li class="authorsByLetters-item"><a href="' . $term_link . '">' . $term->name . '&nbsp;('. $term->count .')'.'</a></li>';
			
		}
		echo '</ul>';
	}

	?>
</div>

<?php
// LIST ALL CATEGORIES WITH LETTER Z
?>
<div class="authorsByLetter">
	<h4 class="authorsByLetters-title">Z:</h4>
	<?php
	$terms = get_terms( array(
		'taxonomy' => 'category',
		'__first_letter' => 'z', // desired first letter
	) );

	if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
		echo '<ul class="authorsByLetters">';
		foreach ( $terms as $term ) {
			$term_link = get_term_link( $term );

			echo '<li class="authorsByLetters-item"><a href="' . $term_link . '">' . $term->name . '&nbsp;('. $term->count .')'.'</a></li>';
			
		}
		echo '</ul>';
	}

	?>
</div>



<?php endif; ?>

<?php get_template_part('page-parts/general-after-wrap'); ?>

<?php get_footer(); ?>