<?php
// Enqueue the custom CSS
function ab_enqueue_styles() {
    wp_enqueue_style('ab-booking-styles', plugin_dir_url(__FILE__) . '../assets/style.css');
}
add_action('wp_enqueue_scripts', 'ab_enqueue_styles');

// Shortcode to display booking form
function ab_display_booking_form() {
    ob_start();
    ?>

    <form class="ab-booking-form" method="post" action="">
        <label for="ab_name">Name:</label>
        <input type="text" id="ab_name" name="ab_name" required>

        <label for="ab_email">Email:</label>
        <input type="email" id="ab_email" name="ab_email" required>

        <label for="ab_date">Select Date:</label>
        <input type="date" id="ab_date" name="ab_date" required>

        <label for="ab_time">Select Time:</label>
        <input type="time" id="ab_time" name="ab_time" required>

        <input type="submit" name="ab_submit" value="Book Appointment">
    </form>

    <?php
    // Handle form submission
    if (isset($_POST['ab_submit'])) {
        $name = sanitize_text_field($_POST['ab_name']);
        $email = sanitize_email($_POST['ab_email']);
        $date = sanitize_text_field($_POST['ab_date']);
        $time = sanitize_text_field($_POST['ab_time']);

        // Insert booking into the database
        global $wpdb;
        $table_name = $wpdb->prefix . 'appointments';
        $wpdb->insert($table_name, array(
            'name' => $name,
            'email' => $email,
            'date' => $date,
            'time' => $time
        ));

        echo '<p>Thank you for booking. We will get back to you shortly.</p>';
    }

    return ob_get_clean();
}
add_shortcode('appointment_booking_form', 'ab_display_booking_form');
