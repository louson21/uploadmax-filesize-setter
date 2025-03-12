# UploadMax Filesize Setter Plugin

## Description
The **UploadMax Filesize Setter** plugin allows WordPress administrators to easily set and manage the maximum upload file size limit directly from the WordPress admin panel. This ensures better control over server resources without modifying PHP configuration files manually.

## Features
- Set the maximum upload file size from the WordPress admin panel
- Secure input validation and sanitization
- Dynamic limit enforcement using WordPress filters
- User-friendly interface in the settings panel
- Nonce security check to prevent unauthorized form submissions

## Installation
### Automatic Installation
1. Download the plugin ZIP file.
2. Go to **Plugins > Add New** in your WordPress admin panel.
3. Click **Upload Plugin** and select the ZIP file.
4. Click **Install Now**, then **Activate**.

### Manual Installation
1. Extract the ZIP file.
2. Upload the extracted folder to the `/wp-content/plugins/` directory via FTP.
3. Go to **Plugins > Installed Plugins** in your WordPress admin panel.
4. Locate **UploadMax Filesize Setter** and click **Activate**.

## Usage
1. Navigate to **Settings > Upload Filesize** in your WordPress admin panel.
2. Enter the new maximum upload file size (e.g., `64M`, `128M`).
3. Click **Save Changes**.
4. The new limit will take effect immediately.

## Filters
- `upload_size_limit`: Dynamically modifies the upload file size limit based on the admin settings.

## Security
- Uses `wp_nonce_field` and `check_admin_referer` to prevent CSRF attacks.
- Sanitizes all user inputs before saving settings.

## Uninstallation
- Deactivating the plugin will remove the settings from the database.

## Changelog
### Version 1.0.0
- Initial release with admin settings page and upload size enforcement.

## License
This plugin is licensed under the **GPL2 License**.

## Support
For any issues or feature requests, please contact the developer.
