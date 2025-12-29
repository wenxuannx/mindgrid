<?php
/**
 * Archive template for Research Projects
 *
 * @package ICT_Research
 */

get_header(); ?>

<main id="primary" class="site-main">

    <!-- Page Header with Particle Effect -->
    <div class="archive-header hero-section-dark" id="archive-particles">
        <div class="hero-content">
            <h1 class="hero-title" style="font-size: clamp(2rem, 5vw, 3.5rem);"><?php _e('Our Research Projects', 'ict-research'); ?></h1>
            <p class="hero-subtitle"><?php _e('Browse our comprehensive collection of innovative ICT research', 'ict-research'); ?></p>
        </div>
    </div>
    
    <div class="container section-padding">
        
        <!-- Filter Bar -->
        <div class="filter-bar">
            <div class="filter-controls">
                
                <!-- Research Area Filter -->
                <div class="filter-group">
                    <label for="filter-research-area"><?php _e('Research Area:', 'ict-research'); ?></label>
                    <select id="filter-research-area" name="research_area">
                        <option value=""><?php _e('All Areas', 'ict-research'); ?></option>
                        <?php
                        $research_areas = get_terms(array(
                            'taxonomy' => 'research_area',
                            'hide_empty' => true,
                        ));
                        foreach ($research_areas as $area) {
                            echo '<option value="' . esc_attr($area->slug) . '">' . esc_html($area->name) . '</option>';
                        }
                        ?>
                    </select>
                </div>
                
                <!-- Status Filter -->
                <div class="filter-group">
                    <label for="filter-status"><?php _e('Status:', 'ict-research'); ?></label>
                    <select id="filter-status" name="status">
                        <option value=""><?php _e('All Statuses', 'ict-research'); ?></option>
                        <option value="ongoing"><?php _e('Ongoing', 'ict-research'); ?></option>
                        <option value="completed"><?php _e('Completed', 'ict-research'); ?></option>
                        <option value="planned"><?php _e('Planned', 'ict-research'); ?></option>
                    </select>
                </div>
                
                <!-- Department Filter -->
                <div class="filter-group">
                    <label for="filter-department"><?php _e('Department:', 'ict-research'); ?></label>
                    <select id="filter-department" name="department">
                        <option value=""><?php _e('All Departments', 'ict-research'); ?></option>
                        <?php
                        $departments = get_terms(array(
                            'taxonomy' => 'department',
                            'hide_empty' => true,
                        ));
                        foreach ($departments as $dept) {
                            echo '<option value="' . esc_attr($dept->slug) . '">' . esc_html($dept->name) . '</option>';
                        }
                        ?>
                    </select>
                </div>
                
                <!-- Search -->
                <div class="filter-group" style="flex-grow: 1;">
                    <label for="filter-search"><?php _e('Search:', 'ict-research'); ?></label>
                    <input type="text" id="filter-search" name="search" placeholder="<?php esc_attr_e('Search projects...', 'ict-research'); ?>">
                </div>
                
            </div>
        </div>
        
        <!-- Results Count -->
        <div class="results-count" style="margin: 20px 0; color: #666;">
            <?php
            global $wp_query;
            $total = $wp_query->found_posts;
            printf(_n('Showing %s project', 'Showing %s projects', $total, 'ict-research'), number_format_i18n($total));
            ?>
        </div>
        
        <!-- Projects Grid -->
        <div id="projects-container" class="projects-grid">
            <?php
            if (have_posts()) :
                while (have_posts()) :
                    the_post();
                    get_template_part('template-parts/content', 'project-card');
                endwhile;
            else :
                echo '<p>' . __('No projects found.', 'ict-research') . '</p>';
            endif;
            ?>
        </div>
        
        <!-- Pagination -->
        <div class="pagination" style="margin-top: 40px; text-align: center;">
            <?php
            the_posts_pagination(array(
                'mid_size'  => 2,
                'prev_text' => __('← Previous', 'ict-research'),
                'next_text' => __('Next →', 'ict-research'),
            ));
            ?>
        </div>
        
    </div>
</main>

<?php get_footer(); ?>
