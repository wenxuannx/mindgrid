<?php
/**
 * ICT Research Theme Functions
 * 
 * @package ICT_Research
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

/**
 * Theme Setup
 */
function ict_research_setup() {
    // Add theme support
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ));
    add_theme_support('custom-logo', array(
        'height'      => 100,
        'width'       => 400,
        'flex-height' => true,
        'flex-width'  => true,
    ));
    
    // Register navigation menus
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'ict-research'),
        'footer'  => __('Footer Menu', 'ict-research'),
    ));
    
    // Add image sizes
    add_image_size('project-thumbnail', 400, 250, true);
    add_image_size('project-featured', 1200, 600, true);
    add_image_size('project-gallery', 600, 400, true);
}
add_action('after_setup_theme', 'ict_research_setup');

/**
 * Enqueue Scripts and Styles
 */
function ict_research_scripts() {
    // Main stylesheet
    wp_enqueue_style('ict-research-style', get_stylesheet_uri(), array(), '1.0.0');

    // Particle.js library
    wp_enqueue_script('particleground', get_template_directory_uri() . '/js/particle.js', array(), '1.1.0', true);

    // Custom JS
    wp_enqueue_script('ict-research-script', get_template_directory_uri() . '/js/main.js', array('jquery', 'particleground'), '1.0.0', true);

    // Localize script for AJAX
    wp_localize_script('ict-research-script', 'ictResearch', array(
        'ajaxurl' => admin_url('admin-ajax.php'),
        'nonce'   => wp_create_nonce('ict_research_nonce'),
    ));
}
add_action('wp_enqueue_scripts', 'ict_research_scripts');

/**
 * Register Custom Post Type: Research Projects
 */
function ict_research_register_post_types() {
    $labels = array(
        'name'                  => _x('Research Projects', 'Post Type General Name', 'ict-research'),
        'singular_name'         => _x('Research Project', 'Post Type Singular Name', 'ict-research'),
        'menu_name'             => __('Research Projects', 'ict-research'),
        'name_admin_bar'        => __('Research Project', 'ict-research'),
        'archives'              => __('Project Archives', 'ict-research'),
        'attributes'            => __('Project Attributes', 'ict-research'),
        'parent_item_colon'     => __('Parent Project:', 'ict-research'),
        'all_items'             => __('All Projects', 'ict-research'),
        'add_new_item'          => __('Add New Project', 'ict-research'),
        'add_new'               => __('Add New', 'ict-research'),
        'new_item'              => __('New Project', 'ict-research'),
        'edit_item'             => __('Edit Project', 'ict-research'),
        'update_item'           => __('Update Project', 'ict-research'),
        'view_item'             => __('View Project', 'ict-research'),
        'view_items'            => __('View Projects', 'ict-research'),
        'search_items'          => __('Search Project', 'ict-research'),
        'not_found'             => __('Not found', 'ict-research'),
        'not_found_in_trash'    => __('Not found in Trash', 'ict-research'),
    );
    
    $args = array(
        'label'                 => __('Research Project', 'ict-research'),
        'description'           => __('Research projects and studies', 'ict-research'),
        'labels'                => $labels,
        'supports'              => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'),
        'taxonomies'            => array('research_area', 'department'),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'menu_icon'             => 'dashicons-welcome-learn-more',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => 'research-projects',
        'rewrite'               => array('slug' => 'research-projects'),
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'post',
        'show_in_rest'          => true,
    );
    
    register_post_type('research_project', $args);
}
add_action('init', 'ict_research_register_post_types');

/**
 * Register Custom Taxonomies
 */
function ict_research_register_taxonomies() {
    // Research Area Taxonomy
    $labels = array(
        'name'                       => _x('Research Areas', 'Taxonomy General Name', 'ict-research'),
        'singular_name'              => _x('Research Area', 'Taxonomy Singular Name', 'ict-research'),
        'menu_name'                  => __('Research Areas', 'ict-research'),
        'all_items'                  => __('All Research Areas', 'ict-research'),
        'parent_item'                => __('Parent Research Area', 'ict-research'),
        'parent_item_colon'          => __('Parent Research Area:', 'ict-research'),
        'new_item_name'              => __('New Research Area Name', 'ict-research'),
        'add_new_item'               => __('Add New Research Area', 'ict-research'),
        'edit_item'                  => __('Edit Research Area', 'ict-research'),
        'update_item'                => __('Update Research Area', 'ict-research'),
        'view_item'                  => __('View Research Area', 'ict-research'),
        'separate_items_with_commas' => __('Separate areas with commas', 'ict-research'),
        'add_or_remove_items'        => __('Add or remove research areas', 'ict-research'),
        'choose_from_most_used'      => __('Choose from the most used', 'ict-research'),
        'popular_items'              => __('Popular Research Areas', 'ict-research'),
        'search_items'               => __('Search Research Areas', 'ict-research'),
        'not_found'                  => __('Not Found', 'ict-research'),
    );
    
    $args = array(
        'labels'                     => $labels,
        'hierarchical'               => true,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => true,
        'rewrite'                    => array('slug' => 'research-area'),
        'show_in_rest'               => true,
    );
    
    register_taxonomy('research_area', array('research_project'), $args);
    
    // Department Taxonomy
    $labels = array(
        'name'                       => _x('Departments', 'Taxonomy General Name', 'ict-research'),
        'singular_name'              => _x('Department', 'Taxonomy Singular Name', 'ict-research'),
        'menu_name'                  => __('Departments', 'ict-research'),
        'all_items'                  => __('All Departments', 'ict-research'),
        'parent_item'                => __('Parent Department', 'ict-research'),
        'parent_item_colon'          => __('Parent Department:', 'ict-research'),
        'new_item_name'              => __('New Department Name', 'ict-research'),
        'add_new_item'               => __('Add New Department', 'ict-research'),
        'edit_item'                  => __('Edit Department', 'ict-research'),
        'update_item'                => __('Update Department', 'ict-research'),
        'view_item'                  => __('View Department', 'ict-research'),
        'search_items'               => __('Search Departments', 'ict-research'),
        'not_found'                  => __('Not Found', 'ict-research'),
    );
    
    $args = array(
        'labels'                     => $labels,
        'hierarchical'               => true,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => false,
        'rewrite'                    => array('slug' => 'department'),
        'show_in_rest'               => true,
    );
    
    register_taxonomy('department', array('research_project'), $args);
}
add_action('init', 'ict_research_register_taxonomies');

/**
 * Register Widget Areas
 */
function ict_research_widgets_init() {
    register_sidebar(array(
        'name'          => __('Sidebar', 'ict-research'),
        'id'            => 'sidebar-1',
        'description'   => __('Add widgets here.', 'ict-research'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));
    
    register_sidebar(array(
        'name'          => __('Footer', 'ict-research'),
        'id'            => 'footer-1',
        'description'   => __('Footer widget area.', 'ict-research'),
        'before_widget' => '<div id="%1$s" class="footer-widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="footer-widget-title">',
        'after_title'   => '</h4>',
    ));
}
add_action('widgets_init', 'ict_research_widgets_init');

/**
 * Custom Excerpt Length
 */
function ict_research_excerpt_length($length) {
    return 25;
}
add_filter('excerpt_length', 'ict_research_excerpt_length', 999);

/**
 * Custom Excerpt More
 */
function ict_research_excerpt_more($more) {
    return '...';
}
add_filter('excerpt_more', 'ict_research_excerpt_more');

/**
 * AJAX Filter Projects
 */
function ict_research_filter_projects() {
    check_ajax_referer('ict_research_nonce', 'nonce');
    
    $research_area = isset($_POST['research_area']) ? sanitize_text_field($_POST['research_area']) : '';
    $status = isset($_POST['status']) ? sanitize_text_field($_POST['status']) : '';
    $department = isset($_POST['department']) ? sanitize_text_field($_POST['department']) : '';
    $search = isset($_POST['search']) ? sanitize_text_field($_POST['search']) : '';
    
    $args = array(
        'post_type'      => 'research_project',
        'posts_per_page' => 12,
        'paged'          => isset($_POST['paged']) ? intval($_POST['paged']) : 1,
    );
    
    // Add tax query
    $tax_query = array('relation' => 'AND');
    
    if (!empty($research_area)) {
        $tax_query[] = array(
            'taxonomy' => 'research_area',
            'field'    => 'slug',
            'terms'    => $research_area,
        );
    }
    
    if (!empty($department)) {
        $tax_query[] = array(
            'taxonomy' => 'department',
            'field'    => 'slug',
            'terms'    => $department,
        );
    }
    
    if (count($tax_query) > 1) {
        $args['tax_query'] = $tax_query;
    }
    
    // Add meta query for status
    if (!empty($status)) {
        $args['meta_query'] = array(
            array(
                'key'     => 'project_status',
                'value'   => $status,
                'compare' => '=',
            ),
        );
    }
    
    // Add search
    if (!empty($search)) {
        $args['s'] = $search;
    }
    
    $query = new WP_Query($args);
    
    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            get_template_part('template-parts/content', 'project-card');
        }
        wp_reset_postdata();
    } else {
        echo '<p>No projects found matching your criteria.</p>';
    }
    
    wp_die();
}
add_action('wp_ajax_filter_projects', 'ict_research_filter_projects');
add_action('wp_ajax_nopriv_filter_projects', 'ict_research_filter_projects');

/**
 * AJAX Contact Form Handler
 * 
 * Note: This handler assumes your form fields have `name` attributes like
 * 'contact_name', 'contact_email', and 'contact_message'.
 * Please adjust them if your form uses different names.
 */
function ict_research_send_contact_message() {
    // 1. Verify nonce
    check_ajax_referer('ict_research_nonce', 'nonce');

    // 2. Sanitize and validate inputs
    $name = isset($_POST['contact_name']) ? sanitize_text_field($_POST['contact_name']) : '';
    $email = isset($_POST['contact_email']) ? sanitize_email($_POST['contact_email']) : '';
    $subject = isset($_POST['contact_subject']) ? sanitize_text_field($_POST['contact_subject']) : 'New Message from Website';
    $message = isset($_POST['contact_message']) ? sanitize_textarea_field($_POST['contact_message']) : '';

    // Basic validation
    if (empty($name) || empty($message) || !is_email($email)) {
        wp_send_json_error(array('message' => 'Invalid form data. Please fill all required fields correctly.'));
    }

    // 3. Prepare and send email
    $to = get_option('admin_email');
    $headers = array('Content-Type: text/html; charset=UTF-8', 'From: ' . $name . ' <' . $email . '>', 'Reply-To: ' . $email);
    
    $body = "<h2>New Message from " . get_bloginfo('name') . "</h2>";
    $body .= "<p><strong>From:</strong> " . esc_html($name) . "</p>";
    $body .= "<p><strong>Email:</strong> " . esc_html($email) . "</p>";
    $body .= "<p><strong>Subject:</strong> " . esc_html($subject) . "</p>";
    $body .= "<h3>Message:</h3>";
    $body .= "<p>" . nl2br(esc_html($message)) . "</p>";

    $sent = wp_mail($to, $subject, $body, $headers);

    // 4. Send JSON response
    if ($sent) {
        wp_send_json_success(array('message' => 'Email sent successfully!'));
    } else {
        wp_send_json_error(array('message' => 'Failed to send email. Please try again later.'));
    }
}
add_action('wp_ajax_send_contact_message', 'ict_research_send_contact_message');
add_action('wp_ajax_nopriv_send_contact_message', 'ict_research_send_contact_message');

/**
 * Add Custom Fields Support (if not using ACF)
 * This is a placeholder - you would use ACF plugin for production
 */
function ict_research_add_meta_boxes() {
    add_meta_box(
        'project_details',
        'Project Details',
        'ict_research_project_details_callback',
        'research_project',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'ict_research_add_meta_boxes');

function ict_research_project_details_callback($post) {
    wp_nonce_field('ict_research_save_project_details', 'ict_research_project_details_nonce');
    
    $status = get_post_meta($post->ID, 'project_status', true);
    $lead = get_post_meta($post->ID, 'research_lead', true);
    $start_date = get_post_meta($post->ID, 'start_date', true);
    $end_date = get_post_meta($post->ID, 'end_date', true);
    $funding = get_post_meta($post->ID, 'funding_source', true);
    ?>
    <p>
        <label for="project_status"><strong>Project Status:</strong></label><br>
        <select name="project_status" id="project_status" style="width: 100%;">
            <option value="ongoing" <?php selected($status, 'ongoing'); ?>>Ongoing</option>
            <option value="completed" <?php selected($status, 'completed'); ?>>Completed</option>
            <option value="planned" <?php selected($status, 'planned'); ?>>Planned</option>
        </select>
    </p>
    <p>
        <label for="research_lead"><strong>Research Lead:</strong></label><br>
        <input type="text" name="research_lead" id="research_lead" value="<?php echo esc_attr($lead); ?>" style="width: 100%;">
    </p>
    <p>
        <label for="start_date"><strong>Start Date:</strong></label><br>
        <input type="date" name="start_date" id="start_date" value="<?php echo esc_attr($start_date); ?>" style="width: 100%;">
    </p>
    <p>
        <label for="end_date"><strong>End Date:</strong></label><br>
        <input type="date" name="end_date" id="end_date" value="<?php echo esc_attr($end_date); ?>" style="width: 100%;">
    </p>
    <p>
        <label for="funding_source"><strong>Funding Source:</strong></label><br>
        <input type="text" name="funding_source" id="funding_source" value="<?php echo esc_attr($funding); ?>" style="width: 100%;">
    </p>
    <?php
}

function ict_research_save_project_details($post_id) {
    if (!isset($_POST['ict_research_project_details_nonce'])) {
        return;
    }
    
    if (!wp_verify_nonce($_POST['ict_research_project_details_nonce'], 'ict_research_save_project_details')) {
        return;
    }
    
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }
    
    $fields = array('project_status', 'research_lead', 'start_date', 'end_date', 'funding_source');
    
    foreach ($fields as $field) {
        if (isset($_POST[$field])) {
            update_post_meta($post_id, $field, sanitize_text_field($_POST[$field]));
        }
    }
}
add_action('save_post', 'ict_research_save_project_details');

/**
 * Add Schema.org Markup for Research Projects
 */
function ict_research_add_schema_markup() {
    if (is_singular('research_project')) {
        global $post;

        $schema = array(
            '@context' => 'https://schema.org',
            '@type' => 'ResearchProject',
            'name' => get_the_title(),
            'description' => get_the_excerpt(),
            'url' => get_permalink(),
        );

        $lead = get_post_meta($post->ID, 'research_lead', true);
        if ($lead) {
            $schema['creator'] = array(
                '@type' => 'Person',
                'name' => $lead
            );
        }

        $start_date = get_post_meta($post->ID, 'start_date', true);
        if ($start_date) {
            $schema['startDate'] = $start_date;
        }

        echo '<script type="application/ld+json">' . json_encode($schema) . '</script>';
    }
}
add_action('wp_head', 'ict_research_add_schema_markup');

/**
 * Fallback Menu
 */
function ict_research_fallback_menu() {
    echo '<ul id="primary-menu" class="menu">';
    echo '<li><a href="' . esc_url(home_url('/')) . '">Home</a></li>';
    echo '<li><a href="' . esc_url(home_url('/about')) . '">About Us</a></li>';
    echo '<li><a href="' . esc_url(home_url('/research-projects')) . '">Projects</a></li>';
    echo '</ul>';
}
