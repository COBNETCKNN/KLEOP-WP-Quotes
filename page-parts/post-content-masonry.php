<?php
/**
 * The template Masonry blog item
 *
 * @package WordPress
 * @subpackage Kleo
 * @since Kleo 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( array( "post-item" ) ); ?>>
    <div class="post-content animated animate-when-almost-visible el-appear">

		<?php
		global $kleo_config;
		$kleo_post_format = get_post_format();

		/* For portfolio post type */
		if ( get_post_type() == 'portfolio' ) {
			if ( get_cfield( 'media_type' ) && get_cfield( 'media_type' ) != '' ) {
				$media_type = get_cfield( 'media_type' );
				switch ( $media_type ) {
					case 'slider':
						$kleo_post_format = 'gallery';
						break;

					case 'video':
					case 'hosted_video':
						$kleo_post_format = 'video';
						break;
				}
			}
		}

		switch ( $kleo_post_format ) {

			case 'video':

				//oEmbed video
				$video = get_cfield( 'embed' );
				// video bg self hosted
				$bg_video_args = array();
				$k_video       = '';

				if ( get_cfield( 'video_mp4' ) ) {
					$bg_video_args['mp4'] = esc_attr( get_cfield( 'video_mp4' ) );
				}
				if ( get_cfield( 'video_ogv' ) ) {
					$bg_video_args['ogv'] = esc_attr( get_cfield( 'video_ogv' ) );
				}
				if ( get_cfield( 'video_webm' ) ) {
					$bg_video_args['webm'] = esc_attr( get_cfield( 'video_webm' ) );
				}

				if ( ! empty( $bg_video_args ) ) {
					$attr_strings = array(
						'preload="none"'
					);

					if ( get_cfield( 'video_poster' ) ) {
						$attr_strings[] = 'poster="' . esc_attr( get_cfield( 'video_poster' ) ) . '"';
					}

					$k_video .= '<div class="kleo-video-wrap">' .
					            '<video ' . join( ' ', $attr_strings ) . ' controls="controls" class="kleo-video" style="width: 100%; height: 100%;">';

					$source = '<source type="%s" src="%s" />';
					foreach ( $bg_video_args as $video_type => $video_src ) {
						$video_type = wp_check_filetype( $video_src, wp_get_mime_types() );
						$k_video    .= sprintf( $source, $video_type['type'], esc_url( $video_src ) );
					}

					$k_video .= '</video></div>';

					echo $k_video; // PHPCS: XSS ok.

				} // oEmbed
                elseif ( ! empty( $video ) ) {
					global $wp_embed;
					echo '<div class="masonry-video-oembed">';
					echo apply_filters( 'kleo_oembed_video', $video );
					echo '</div>';
				}

				break;

			case 'audio':

				$audio = get_cfield( 'audio' );
				if ( ! empty( $audio ) ) { ?>
                    <div class="post-audio">
                        <audio preload="none" class="kleo-audio" id="audio_<?php the_ID(); ?>" style="width:100%;"
                               src="<?php echo esc_attr( $audio ); ?>"></audio>
                    </div>
					<?php
				}
				break;

			case 'gallery':

				$slides = get_cfield( 'slider' );
				echo '<div class="kleo-banner-slider">'
				     . '<div class="kleo-banner-items modal-gallery" data-speed="2000">';
				if ( $slides ) {
					foreach ( $slides as $slide ) {
						if ( $slide ) {
							$image = aq_resize( $slide, $kleo_config['post_gallery_img_width'], $kleo_config['post_gallery_img_height'], true, true, true );
							//small hack for non-hosted images
							if ( ! $image ) {
								$image = $slide;
							}
							echo '<article>
								<a href="' . $slide . '" data-rel="modalPhoto[inner-gallery]">
									<img src="' . $image . '" alt="' . get_the_title() . '">'
							     . kleo_get_img_overlay()
							     . '</a>
							</article>';
						}
					}
				}

				echo '</div>'
				     . '<a href="#" class="kleo-banner-prev"><i class="icon-angle-left"></i></a>'
				     . '<a href="#" class="kleo-banner-next"><i class="icon-angle-right"></i></a>'
				     . '<div class="kleo-banner-features-pager carousel-pager"></div>'
				     . '</div>';

				break;

			case 'quote':
			case 'link':
			case 'status':

				echo '<div class="inner-content">'
				     . get_the_content()
				     . '</div><!--end inner-content-->';
				break;

			case 'image':
			default:
				if ( kleo_get_post_thumbnail_url() != '' ) {

					echo '<div class="post-image">';
					echo '<a href="' . get_permalink() . '" class="element-wrap">'
					     . kleo_get_post_thumbnail( null, 'kleo-post-grid' )
					     . kleo_get_img_overlay()
					     . '</a>';
					echo '</div><!--end post-image-->';
				}

				break;
		}
		?>

		<?php if ( $kleo_post_format !== 'quote' && $kleo_post_format !== 'link' ) : ?>

            <div class="post-header">

				<?php if ( $kleo_post_format !== 'status' ): ?>
                    <span class="masonryTitle post-title entry-title"><?php the_title(); ?>
				</span>
				<?php endif; ?>

                <span class="post-meta">
                    <?php kleo_entry_meta(); ?>
                </span>

            </div><!--end post-header-->

			<?php if ( $kleo_post_format !== 'status' ): ?>

				<?php if ( kleo_excerpt() !== '<p></p>' ) : ?>
                    <div class="post-info">
					<?php 
						$categories = get_the_category();
						$postcat = get_the_category();

						if ( ! empty( $categories ) ) { ?>
							<a href="<?php echo get_category_link( $postcat[0]->term_id ); ?>">
								<h3 class="categoryAuthor-grid">- <?php echo $postcat[0]->name; ?></h3>
							</a>
						<?php
							
						}
					?>

					<?php /*
					<div class="entry-summary">
						<?php echo kleo_excerpt(); ?>
					</div><!-- .entry-summary -->
					*/ ?>

                    </div><!--end post-info-->
				<?php endif; ?>

			<?php endif; ?>

		<?php endif; ?>

		<?php if ( $kleo_post_format == 'quote' ): ?>
		<?php 
			$categories = get_the_category();
			$postcat = get_the_category();

			if ( ! empty( $categories ) ) { ?>
				<a href="<?php echo get_category_link( $postcat[0]->term_id ); ?>">
					<h3 class="categoryAuthor-grid-quote">- <?php echo $postcat[0]->name; ?></h3>
				</a>
			<?php
				
			}
		?>
		<?php endif; ?>
        <div class="post-footer">
            <small>
				<?php do_action( 'kleo_post_footer' ); ?>

				<?php if ( $kleo_post_format == 'link' ): ?>
                    <a href="<?php echo sq_get_url_link( get_the_content(), get_permalink() ); ?>" target="_blank">
                        <span class="muted pull-right"><?php esc_html_e( "Read more", 'kleo' ); ?></span>
                    </a>
				<?php else: ?>
					
                    <a href="<?php the_permalink(); ?>"><span class="muted pull-right">

					<?php 
						if(!$kleo_post_format == 'post'){
							// displaying share buttons on standard display type
							get_template_part('page-parts/grid-social', 'share'); 
						}

					?>
                    </a>
				<?php endif; ?>

            </small>
        </div><!--end post-footer-->

    </div><!--end post-content-->
</article>
