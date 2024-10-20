<?php
function ab_admin_menu() {
    add_menu_page(
        'Appointments',
        'Appointments',
        'manage_options',
        'ab-appointments',
        'ab_admin_page_contents',
        'dashicons-calendar-alt',
        26
    );
}
add_action('admin_menu', 'ab_admin_menu');

function ab_admin_page_contents() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'appointments';

    $results = $wpdb->get_results("SELECT * FROM $table_name");
    ?>

    <div class="wrap">
        <h1>Appointments</h1>
        <table class="widefat">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Date</th>
                    <th>Time</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($results as $row) { ?>
                <tr>
                    <td><?php echo esc_html($row->name); ?></td>
                    <td><?php echo esc_html($row->email); ?></td>
                    <td><?php echo esc_html($row->date); ?></td>
                    <td><?php echo esc_html($row->time); ?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <?php
}
