<?php 
// Add capabilities to Editor role, source https://wordpress.org/documentation/article/roles-and-capabilities/
function add_capabilities_to_editor_role() {
   $role = get_role('editor');
   $role->add_cap('edit_theme_options'); // Allow access to Appearance options (Widget, Menus, Customize, Header).
   $role->add_cap('create_users', 'list_users', 'remove_users'); // Allow access to Accounts menu.
   $role->add_cap('update_plugins', 'update_core'); // Allow access to update menu, (Dashboard->updates).
}
add_action('admin_init', 'add_capabilities_to_editor_role');

?>