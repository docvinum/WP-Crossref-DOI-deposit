<?php
/*
Plugin Name: Crossref DOI Deposit
Plugin URI: https://github.com/docvinum/Wordpress-Crossref-DOI-deposit-plugin
Plugin Author: DocVinum
Plugin Version: 0.1.0
Description: A WordPress plugin to deposit DOIs to Crossref for published content.
Author: DocVinum @ EtOH
Author URI: https://github.com/docvinum
License: MIT
Text Domain: crossref-doi-deposit
*/ 

// Add settings page to the admin menu
add_action('admin_menu', 'crossref_doi_deposit_settings_page');

function crossref_doi_deposit_settings_page() {
    add_options_page(
        'Crossref DOI Deposit Settings',
        'Crossref DOI Deposit',
        'manage_options',
        'crossref-doi-deposit-settings',
        'crossref_doi_deposit_render_settings_page'
    );
}

// Render settings page
function crossref_doi_deposit_render_settings_page() {
    ?>
    <div class="wrap">
        <h1><?php _e('Crossref DOI Deposit Settings', 'crossref-doi-deposit'); ?></h1>
        <form method="post" action="options.php">
            <?php
            settings_fields('crossref_doi_deposit_settings_group');
            do_settings_sections('crossref-doi-deposit-settings');
            submit_button();
            ?>
        </form>
    </div>
    <?php
}

// Register settings
add_action('admin_init', 'crossref_doi_deposit_register_settings');

function crossref_doi_deposit_register_settings() {
    register_setting('crossref_doi_deposit_settings_group', 'crossref_doi_deposit_settings');

    // General settings section
    add_settings_section(
        'crossref_doi_deposit_general_settings',
        __('General Settings', 'crossref-doi-deposit'),
        'crossref_doi_deposit_general_settings_section_callback',
        'crossref-doi-deposit-settings'
    );

    // Add settings fields
    add_settings_field(
        'doi_prefix',
        __('DOI Prefix', 'crossref-doi-deposit'),
        'crossref_doi_deposit_doi_prefix_callback',
        'crossref-doi-deposit-settings',
        'crossref_doi_deposit_general_settings'
    );

    // Other settings fields should be added here (login_id, login_passwd, URL du dépôt, etc.)
}

// General settings section callback
function crossref_doi_deposit_general_settings_section_callback() {
    _e('General settings for the Crossref DOI Deposit plugin.', 'crossref-doi-deposit');
}

// DOI Prefix field callback
function crossref_doi_deposit_doi_prefix_callback() {
    $options = get_option('crossref_doi_deposit_settings');
    ?>
    <input type="text" name="crossref_doi_deposit_settings[doi_prefix]" value="<?php echo $options['doi_prefix']; ?>" />
    <?php
}

// Add other settings field callbacks here (login_id, login_passwd, URL du dépôt, etc.)
// Ajouter d'autres champs de réglage ici (login_id, login_passwd, URL du dépôt, etc.)
// login_id Production
add_settings_field(
    'prod_login_id',
    __('Production Login ID', 'crossref-doi-deposit'),
    'crossref_doi_deposit_prod_login_id_callback',
    'crossref-doi-deposit-settings',
    'crossref_doi_deposit_general_settings'
);

// login_passwd Production
add_settings_field(
    'prod_login_passwd',
    __('Production Login Password', 'crossref-doi-deposit'),
    'crossref_doi_deposit_prod_login_passwd_callback',
    'crossref-doi-deposit-settings',
    'crossref_doi_deposit_general_settings'
);

// login_id Test
add_settings_field(
    'test_login_id',
    __('Test Login ID', 'crossref-doi-deposit'),
    'crossref_doi_deposit_test_login_id_callback',
    'crossref-doi-deposit-settings',
    'crossref_doi_deposit_general_settings'
);

// login_passwd Test
add_settings_field(
    'test_login_passwd',
    __('Test Login Password', 'crossref-doi-deposit'),
    'crossref_doi_deposit_test_login_passwd_callback',
    'crossref-doi-deposit-settings',
    'crossref_doi_deposit_general_settings'
);

// Production Login ID field callback
function crossref_doi_deposit_prod_login_id_callback() {
    $options = get_option('crossref_doi_deposit_settings');
    ?>
    <input type="text" name="crossref_doi_deposit_settings[prod_login_id]" value="<?php echo $options['prod_login_id']; ?>" />
    <?php
}

// Production Login Password field callback
function crossref_doi_deposit_prod_login_passwd_callback() {
    $options = get_option('crossref_doi_deposit_settings');
    ?>
    <input type="password" name="crossref_doi_deposit_settings[prod_login_passwd]" value="<?php echo $options['prod_login_passwd']; ?>" />
    <?php
}

// Test Login ID field callback
function crossref_doi_deposit_test_login_id_callback() {
    $options = get_option('crossref_doi_deposit_settings');
    ?>
    <input type="text" name="crossref_doi_deposit_settings[test_login_id]" value="<?php echo $options['test_login_id']; ?>" />
    <?php
}

// Test Login Password field callback
function crossref_doi_deposit_test_login_passwd_callback() {
    $options = get_option('crossref_doi_deposit_settings');
    ?>
    <input type="password" name="crossref_doi_deposit_settings[test_login_passwd]" value="<?php echo $options['test_login_passwd']; ?>" />
    <?php
}

$options = get_option('crossref_doi_deposit_settings');
$prod_login_id = $options['prod_login_id'];
