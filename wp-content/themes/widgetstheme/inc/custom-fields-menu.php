<?php

/*

@package wpsandbox

  =====================================
    Create fields
    Show columns
    Save/Update fields
    Update the Walker nav
  =====================================

*/

// Creat Fields
function fields_list(){
	return array(
		'megamenu' => 'Activate MegaMenu',
		'column-divider' => 'Column Divider',
		'featured-image' => 'Feautured Image',
	);
}

// Setup Fields
function megamenu_fields( $id, $item, $depth, $args ){
	
	$fields = fields_list();

	foreach ( $fields as $_key => $label ) :
		
		$key = sprintf( 'menu-item-%s', $_key );
		$id = sprintf( 'edit-%s-%s', $key, $item->ID );
		$name = sprintf( '%s[%s]', $key, $item->ID );
		$value = get_post_meta( $item->ID, $key, true );
		$class = sprintf( 'field-%s', $_key );

		?>
			<p class="description description-wide <?php esc_attr( $class ) ?>">
				<label for="<?php esc_attr( $id ) ?>">
					<input type="checkbox" if="<?php esc_attr( $id ) ?>" name="<?php esc_attr( $name ) ?>" value="1" <?php echo ( $value == 1 ) ? 'checked="checked"' : ''; ?>>
					<?php echo esc_attr( $label ) ?>
				</label>
			</p>
		<?php
	endforeach;
}
add_action( 'wp_nav_menu_item_custom_fields', 'megamenu_fields', 10, 4);

// Create Columns
function megamenu_columns( $columns ){

	$fields = fields_list();
	$columns = array_merge( $columns, $fields );
	return $columns; 

}
add_filter( 'manage_nav-menus_columns', 'megamenu_columns', 99);

// Save Fields
function megamenu_save_update( $menu_id, $menu_item_db_id, $menu_item_args ){

	// NO AJAX = NO AUTOSAVE
	if( defined( 'DOING_AJAX' ) && DOING_AJAX ) {
		return;
	}
	
	// SAVE BY CLICK SaveButton
	check_admin_referer( 'update-nav_menu', 'update-nav-menu-nonce');

	$fields = fields_list();

	foreach( $fields as $_key => $label ) {

		$key = sprintf( 'menu-item-%s', $_key );
		// Sanitize
		if( ! empty( $_POST[ $key ][ $menu_item_db_id ] ) ){
			$value = $_POST[ $key ][ $menu_item_db_id ];
		} else {
			$value = null;
		}
		// Save or Update
		if( ! is_null( $value ) ) {
			update_post_meta( $menu_item_db_id, $key, $value );
			echo "key:$key<br />";
		} else {
			delete_post_meta( $menu_item_db_id, $key );
		}
	}
}
add_action( 'wp_update_nav_menu_item', 'megamenu_save_update', 10 , 3 );

// UPDATE the WALKER NAV CLASS
function megamenu__filter_walkernav( $walker ){
	$walker = 'Megamenu_Walker_Edit';
	if( ! class_exists( $walker ) ){
		require_once dirname(__FILE__) . '/templates/walker-edit.php';
	}
	return $walker;
}
add_filter( 'wp_edit_nav_menu_walker', 'megamenu__filter_walkernav', 99);


