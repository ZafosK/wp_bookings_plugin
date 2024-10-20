<?php
/*
Plugin Name: Appointment Booking
Description: A simple appointment booking plugin.
Version: 1.0
Author: Your Name
*/

// Prevent direct access to the file
if (!defined('ABSPATH')) {
    exit;
}

// Include additional files
include_once plugin_dir_path(__FILE__) . 'includes/booking-form.php';
include_once plugin_dir_path(__FILE__) . 'includes/admin-management.php';

// Database creation for storing appointments
register_activation_hook(__FILE__, 'ab_create_appointments_table');

function ab_create_appointments_table() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'appointments';

    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE $table_name (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        name tinytext NOT NULL,
        email text NOT NULL,
        date date NOT NULL,
        time time NOT NULL,
        PRIMARY KEY  (id)
    ) $charset_collate;";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
}
