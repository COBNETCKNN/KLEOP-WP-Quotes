<?php
// Load the KLEO metabox in the WP Nav Menu Admin UI
add_action( 'load-nav-menus.php', 'kleo_admin_wp_nav_menu_meta_box' );

/** Menus *********************************************************************/

/**
 * Register meta box and associated JS for KLEO WP Nav Menu .
 *
 * @since Kleo 1.5.1
 */
function kleo_admin_wp_nav_menu_meta_box() {

	add_meta_box( 'add-kleo-nav-menu', esc_html__( 'KLEO', 'kleo' ), 'kleo_admin_do_wp_nav_menu_meta_box', 'nav-menus', 'side', 'default' );

	add_action( 'admin_print_footer_scripts', 'kleo_admin_wp_nav_menu_restrict_items' );
}

/**
 * Build and populate the BuddyPress accordion on Appearance > Menus.
 *
 * @since Kleo 1.5.1
 *
 * @global $nav_menu_selected_id
 */
function kleo_admin_do_wp_nav_menu_meta_box() {
	global $nav_menu_selected_id;

	$walker = new Kleo_Walker_Nav_Menu_Checklist( false );
	$args   = array( 'walker' => $walker );

	$post_type_name = 'kleo';

	$menu_items = array();

	$menu_items[] = array(
		'name' => esc_html__( 'Login', 'kleo' ),
		'slug' => 'login',
		'link' => '#'
	);
	$menu_items[] = array(
		'name' => esc_html__( 'Logout', 'kleo' ),
		'slug' => 'logout',
		'link' => "#"
	);
	$menu_items[] = array(
		'name' => esc_html__( 'Register', 'kleo' ),
		'slug' => 'register',
		'link' => "#"
	);

	$menu_items = apply_filters( 'kleo_nav_menu_items', $menu_items );

	$page_args = array();
	if ( ! empty( $menu_items ) ) {
		foreach ( $menu_items as $item ) {

			// Remove <span>number</span>
			$item_name = preg_replace( '/([.0-9]+)/', '', $item['name'] );
			$item_name = trim( strip_tags( $item_name ) );

			$page_args[ $item['slug'] ] = (object) array(
				'ID'             => - 1,
				'post_title'     => $item_name,
				'post_author'    => 0,
				'post_date'      => 0,
				'post_excerpt'   => $item['slug'],
				'post_type'      => 'page',
				'post_status'    => 'publish',
				'comment_status' => 'closed',
				'guid'           => $item['link']
			);
		}

	} else {
		esc_html_e( 'No items available here for the moment', 'kleo' );

		return;
	}

	?>

	<div id="kleo-menu" class="posttypediv">
		<p><?php esc_html_e( 'Some links are relative to the current user, and are not visible to visitors who are not logged in.', 'kleo' ) ?></p>

		<div id="tabs-panel-posttype-<?php echo esc_attr( $post_type_name ); ?>-loggedin"
		     class="tabs-panel tabs-panel-active">
			<ul id="kleo-menu-checklist-loggedin" class="categorychecklist form-no-clear">
				<?php echo walk_nav_menu_tree( array_map( 'wp_setup_nav_menu_item', $page_args ), 0, (object) $args ); ?>
			</ul>
		</div>
		<p>With BuddyPress/bbPress installed you can add a link to your profile with ##profile_link## in the URL input
			from <strong>Links</strong> section bellow. Example: ##profile_link##/messages</p>
		<p>You can also include the members username next to the My Account avatar with ##member_name## in the Title
			Attribute field.</p>

		<p class="button-controls">
			<span class="add-to-menu">
				<input
					type="submit"<?php if ( function_exists( 'wp_nav_menu_disabled_check' ) ) : wp_nav_menu_disabled_check( $nav_menu_selected_id ); endif; ?>
					class="button-secondary submit-add-to-menu right"
					value="<?php esc_attr_e( 'Add to Menu', 'kleo' ); ?>" name="add-custom-menu-item"
					id="submit-kleo-menu"/>
				<span class="spinner"></span>
			</span>
		</p>
	</div><!-- /#kleo-menu -->

	<?php
}

/**
 * Restrict various items from view if editing a KLEO menu.
 *
 * If a person is editing a KLEO menu item, that person should not be able to
 * see or edit the following fields:
 *
 * - CSS Classes - We use the 'bp-menu' CSS class to determine if the
 *   menu item belongs to BP, so we cannot allow manipulation of this field to
 *   occur.
 * - URL - This field is automatically generated by BP on output, so this
 *   field is useless and can cause confusion.
 *
 * Note: These restrictions are only enforced if javascript is enabled.
 *
 * @since Kleo 1.5.1
 */
function kleo_admin_wp_nav_menu_restrict_items() {
	?>
	<script type="text/javascript">
		jQuery('#menu-to-edit').on('click', 'a.item-edit', function () {
			var settings = jQuery(this).closest('.menu-item-bar').next('.menu-item-settings');
			var css_class = settings.find('.edit-menu-item-classes');

			if (css_class.val().indexOf('kleo-menu') === 0) {
				css_class.attr('readonly', 'readonly');
				settings.find('.field-url').css('display', 'none');
			}
		});
	</script>
	<?php
}

/**
 * Create a set of Kleo-specific links for use in the Menus admin UI.
 *
 * Borrowed heavily from {@link Walker_Nav_Menu_Checklist}, but modified so as not
 * to require an actual post type or taxonomy, and to force certain CSS classes
 *
 * @since Kleo 1.5.1
 */
class Kleo_Walker_Nav_Menu_Checklist extends Walker_Nav_Menu {

	/**
	 * Constructor.
	 *
	 * @see Walker_Nav_Menu::__construct() for a description of parameters.
	 *
	 * @param array $fields See {@link Walker_Nav_Menu::__construct()}.
	 */
	public function __construct( $fields = false ) {
		if ( $fields ) {
			$this->db_fields = $fields;
		}
	}

	/**
	 * Create the markup to start a tree level.
	 *
	 * @see Walker_Nav_Menu::start_lvl() for description of parameters.
	 *
	 * @param string $output See {@Walker_Nav_Menu::start_lvl()}.
	 * @param int $depth See {@Walker_Nav_Menu::start_lvl()}.
	 * @param array $args See {@Walker_Nav_Menu::start_lvl()}.
	 */
	public function start_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat( "\t", $depth );
		$output .= "\n$indent<ul class='children'>\n";
	}

	/**
	 * Create the markup to end a tree level.
	 *
	 * @see Walker_Nav_Menu::end_lvl() for description of parameters.
	 *
	 * @param string $output See {@Walker_Nav_Menu::end_lvl()}.
	 * @param int $depth See {@Walker_Nav_Menu::end_lvl()}.
	 * @param array $args See {@Walker_Nav_Menu::end_lvl()}.
	 */
	public function end_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat( "\t", $depth );
		$output .= "\n$indent</ul>";
	}

	/**
	 * Create the markup to start an element.
	 *
	 * @see Walker::start_el() for description of parameters.
	 *
	 * @param string $output Passed by reference. Used to append additional
	 *        content.
	 * @param object $item Menu item data object.
	 * @param int $depth Depth of menu item. Used for padding.
	 * @param object $args See {@Walker::start_el()}.
	 * @param int $id See {@Walker::start_el()}.
	 */
	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		global $_nav_menu_placeholder;

		$_nav_menu_placeholder = ( 0 > $_nav_menu_placeholder ) ? intval( $_nav_menu_placeholder ) - 1 : - 1;
		$possible_object_id    = isset( $item->post_type ) && 'nav_menu_item' == $item->post_type ? $item->object_id : $_nav_menu_placeholder;
		$possible_db_id        = ( ! empty( $item->ID ) ) && ( 0 < $possible_object_id ) ? (int) $item->ID : 0;

		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		$output .= $indent . '<li>';
		$output .= '<label class="menu-item-title">';
		$output .= '<input type="checkbox" class="menu-item-checkbox';

		if ( property_exists( $item, 'label' ) ) {
			$title = $item->label;
		}

		$output .= '" name="menu-item[' . $possible_object_id . '][menu-item-object-id]" value="' . esc_attr( $item->object_id ) . '" /> ';
		$output .= isset( $title ) ? esc_html( $title ) : esc_html( $item->title );
		$output .= '</label>';

		if ( empty( $item->url ) ) {
			$item->url = $item->guid;
		}

		if ( ! in_array( array( 'kleo-menu', 'kleo-' . $item->post_excerpt . '-nav' ), $item->classes ) ) {
			$item->classes[] = 'kleo-menu';
			$item->classes[] = 'kleo-' . $item->post_excerpt . '-nav';
		}

		// Menu item hidden fields
		$output .= '<input type="hidden" class="menu-item-db-id" name="menu-item[' . $possible_object_id . '][menu-item-db-id]" value="' . $possible_db_id . '" />';
		$output .= '<input type="hidden" class="menu-item-object" name="menu-item[' . $possible_object_id . '][menu-item-object]" value="' . esc_attr( $item->object ) . '" />';
		$output .= '<input type="hidden" class="menu-item-parent-id" name="menu-item[' . $possible_object_id . '][menu-item-parent-id]" value="' . esc_attr( $item->menu_item_parent ) . '" />';
		$output .= '<input type="hidden" class="menu-item-type" name="menu-item[' . $possible_object_id . '][menu-item-type]" value="custom" />';
		$output .= '<input type="hidden" class="menu-item-title" name="menu-item[' . $possible_object_id . '][menu-item-title]" value="' . esc_attr( $item->title ) . '" />';
		$output .= '<input type="hidden" class="menu-item-url" name="menu-item[' . $possible_object_id . '][menu-item-url]" value="' . esc_attr( $item->url ) . '" />';
		$output .= '<input type="hidden" class="menu-item-target" name="menu-item[' . $possible_object_id . '][menu-item-target]" value="' . esc_attr( $item->target ) . '" />';
		$output .= '<input type="hidden" class="menu-item-attr_title" name="menu-item[' . $possible_object_id . '][menu-item-attr_title]" value="' . esc_attr( $item->attr_title ) . '" />';
		$output .= '<input type="hidden" class="menu-item-classes" name="menu-item[' . $possible_object_id . '][menu-item-classes]" value="' . esc_attr( implode( ' ', $item->classes ) ) . '" />';
		$output .= '<input type="hidden" class="menu-item-xfn" name="menu-item[' . $possible_object_id . '][menu-item-xfn]" value="' . esc_attr( $item->xfn ) . '" />';
	}
}


/**
 * Add Kleo-specific items to the wp_nav_menu.
 *
 * @since Kleo 1.5.1
 *
 * @param WP_Post $menu_item The menu item.
 *
 * @return obj The modified WP_Post object.
 */
function kleo_setup_nav_menu_item( $menu_item ) {
	if ( is_admin() ) {
		return $menu_item;
	}

	// We use information stored in the CSS class to determine what kind of
	// menu item this is, and how it should be treated
	if ( ! isset( $menu_item->classes ) || ! is_array( $menu_item->classes ) ) {
		return $menu_item;
	}
	$css_target = preg_match( '/\skleo-(.*)-nav/', implode( ' ', $menu_item->classes ), $matches );


	// If this isn't a KLEO menu item, we can stop here
	if ( empty( $matches[1] ) ) {
		return $menu_item;
	}

	switch ( $matches[1] ) {
		case 'login' :
			if ( is_user_logged_in() ) {
				$menu_item->_invalid = true;
			} else {
				$menu_item->url     = wp_login_url();
				$menu_item->classes = "kleo-show-login";
			}

			break;

		case 'logout' :
			if ( ! is_user_logged_in() ) {
				$menu_item->_invalid = true;
			} else {
				$menu_item->url = wp_logout_url( kleo_get_requested_url() );
			}

			break;

		// Don't show the Register link to logged-in users
		case 'register' :
			if ( is_user_logged_in() ) {
				$menu_item->_invalid = true;
			} else {
				$menu_item->url = wp_registration_url();
			}

			break;

		default:
			break;
	}

	$menu_item = apply_filters( 'kleo_setup_nav_item_' . $matches[1], $menu_item );

	// If component is deactivated, make sure menu item doesn't render
	if ( empty( $menu_item->url ) ) {
		$menu_item->_invalid = true;
	}

	return $menu_item;
}

add_filter( 'wp_setup_nav_menu_item', 'kleo_setup_nav_menu_item', 10, 1 );
