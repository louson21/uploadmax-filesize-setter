<?php
/**
 * Plugin Name: UploadMax Filesize Setter
 * Description: Allows users to set and manage upload filesize limits dynamically.
 * Version:     1.0.0
 * Author:      Louie Sonugan
 * Author URI:  https://louiesonugan.com/
 * License:     GPL2
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Activation Hook
register_activation_hook(__FILE__, 'uploadmax_filesize_setter_activation');
function uploadmax_filesize_setter_activation() {
    add_option('uploadmax_upload_size', ini_get('upload_max_filesize'));
}

// Deactivation Hook
register_deactivation_hook(__FILE__, 'uploadmax_filesize_setter_deactivation');
function uploadmax_filesize_setter_deactivation() {
    delete_option('uploadmax_upload_size');
}

// Add Settings Page
add_action('admin_menu', 'uploadmax_filesize_setter_menu');
function uploadmax_filesize_setter_menu() {
    add_options_page('Max Upload Filesize', 'Upload Filesize', 'manage_options', 'uploadmax-filesize', 'uploadmax_filesize_settings_page');
}

// Render Settings Page
function uploadmax_filesize_settings_page() {
    if (!current_user_can('manage_options')) {
        wp_die(__('You do not have sufficient permissions to access this page.'));
    }
    
    if (isset($_POST['submit']) && check_admin_referer('uploadmax_size_nonce')) {
        $new_size = sanitize_text_field($_POST['max_upload_size']);
        update_option('uploadmax_upload_size', $new_size);
        echo '<div class="updated"><p><strong>Settings updated!</strong></p></div>';
    }
    
    $current_size = get_option('uploadmax_upload_size', ini_get('upload_max_filesize'));
    ?>
    <div class="wrap">
        <h2>Upload Filesize Settings</h2>
        <form method="post">
            <?php wp_nonce_field('uploadmax_size_nonce'); ?>
            <label for="max_upload_size">Set the maximum upload size (e.g., 64M, 128M, 256M):</label>
            <input type="text" name="max_upload_size" value="<?php echo esc_attr($current_size); ?>">
            <br><br>
            <input type="submit" name="submit" class="button-primary" value="Save Changes">
        </form>
    </div>
    <?php
}

// Apply Upload Size Limit
add_filter('upload_size_limit', 'uploadmax_size_limit');
function uploadmax_size_limit($size) {
    $new_size = get_option('uploadmax_upload_size', ini_get('upload_max_filesize'));
    return wp_convert_hr_to_bytes($new_size);
}
