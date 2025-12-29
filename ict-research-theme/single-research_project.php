<?php
/**
 * Single Research Project Template
 *
 * @package ICT_Research
 */

get_header(); ?>

<?php while (have_posts()) : the_post(); ?>

    <main id="primary" class="site-main">
        
        <!-- Project Hero -->
        <div class="project-hero" <?php if (has_post_thumbnail()) : ?>
            style="background-image: linear-gradient(rgba(44, 62, 80, 0.7), rgba(44, 62, 80, 0.7)), url('<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'full')); ?>');"
        <?php endif; ?>>
            <div class="container">
                <div class="project-hero-content">
                    
                    <?php
                    $status = get_post_meta(get_the_ID(), 'project_status', true);
                    if ($status) :
                        $status_class = 'status-' . esc_attr($status);
                        ?>
                        <span class="project-status <?php echo $status_class; ?>">
                            <?php echo ucfirst(esc_html($status)); ?> <?php _e('Project', 'ict-research'); ?>
                        </span>
                    <?php endif; ?>
                    
                    <h1><?php the_title(); ?></h1>
                    
                    <?php if (has_excerpt()) : ?>
                        <p class="project-intro"><?php echo get_the_excerpt(); ?></p>
                    <?php endif; ?>
                    
                    <div class="project-meta-inline">
                        <?php
                        $areas = get_the_terms(get_the_ID(), 'research_area');
                        if ($areas && !is_wp_error($areas)) :
                            ?>
                            <span>🔬 <?php echo esc_html($areas[0]->name); ?></span>
                        <?php endif; ?>
                        
                        <?php
                        $start_date = get_post_meta(get_the_ID(), 'start_date', true);
                        $end_date = get_post_meta(get_the_ID(), 'end_date', true);
                        if ($start_date) :
                            ?>
                            <span>📅 <?php echo esc_html(date('M Y', strtotime($start_date))); ?>
                            <?php if ($end_date) : ?>
                                - <?php echo esc_html(date('M Y', strtotime($end_date))); ?>
                            <?php else : ?>
                                - <?php _e('Ongoing', 'ict-research'); ?>
                            <?php endif; ?>
                            </span>
                        <?php endif; ?>
                        
                        <?php
                        $lead = get_post_meta(get_the_ID(), 'research_lead', true);
                        if ($lead) :
                            ?>
                            <span>👤 <?php echo esc_html($lead); ?></span>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Main Content Area -->
        <div class="container section-padding">
            <div class="project-main-content">
                
                <!-- Main Content Column -->
                <div class="project-content">
                    
                    <!-- Project Overview -->
                    <section class="project-section">
                        <h2><?php _e('Project Overview', 'ict-research'); ?></h2>
                        <div class="project-description">
                            <?php the_content(); ?>
                        </div>
                    </section>
                    
                    <!-- Photo Gallery (if ACF gallery exists) -->
                    <?php
                    // This is placeholder for ACF gallery
                    // In production, you would use: $gallery = get_field('project_gallery');
                    $gallery_images = array(); // Placeholder
                    
                    if (!empty($gallery_images)) :
                        ?>
                        <section class="project-section">
                            <h2><?php _e('Project Gallery', 'ict-research'); ?></h2>
                            <div class="project-gallery">
                                <?php foreach ($gallery_images as $image) : ?>
                                    <div class="gallery-item">
                                        <img src="<?php echo esc_url($image['url']); ?>" 
                                             alt="<?php echo esc_attr($image['alt']); ?>">
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </section>
                    <?php endif; ?>
                    
                    <!-- Project Videos (if ACF video repeater exists) -->
                    <?php
                    // Placeholder for ACF video field
                    // In production: $videos = get_field('project_videos');
                    $videos = array(); // Placeholder
                    
                    if (!empty($videos)) :
                        ?>
                        <section class="project-section">
                            <h2><?php _e('Project Videos', 'ict-research'); ?></h2>
                            <?php foreach ($videos as $video) : ?>
                                <div class="video-embed" style="margin-bottom: 30px;">
                                    <?php echo wp_oembed_get($video['url']); ?>
                                </div>
                            <?php endforeach; ?>
                        </section>
                    <?php endif; ?>
                    
                </div>
                
                <!-- Sidebar -->
                <aside class="project-sidebar">
                    <div class="sidebar-card">
                        <h3><?php _e('Project Details', 'ict-research'); ?></h3>
                        
                        <?php
                        $lead = get_post_meta(get_the_ID(), 'research_lead', true);
                        if ($lead) :
                            ?>
                            <div class="sidebar-section">
                                <strong><?php _e('Principal Investigator', 'ict-research'); ?></strong>
                                <p><?php echo esc_html($lead); ?></p>
                            </div>
                        <?php endif; ?>
                        
                        <?php
                        $departments = get_the_terms(get_the_ID(), 'department');
                        if ($departments && !is_wp_error($departments)) :
                            ?>
                            <div class="sidebar-section">
                                <strong><?php _e('Department', 'ict-research'); ?></strong>
                                <p><?php echo esc_html($departments[0]->name); ?></p>
                            </div>
                        <?php endif; ?>
                        
                        <?php
                        $start_date = get_post_meta(get_the_ID(), 'start_date', true);
                        $end_date = get_post_meta(get_the_ID(), 'end_date', true);
                        if ($start_date) :
                            ?>
                            <div class="sidebar-section">
                                <strong><?php _e('Duration', 'ict-research'); ?></strong>
                                <p>
                                    <?php echo esc_html(date('F Y', strtotime($start_date))); ?>
                                    <?php if ($end_date) : ?>
                                        - <?php echo esc_html(date('F Y', strtotime($end_date))); ?>
                                    <?php else : ?>
                                        - <?php _e('Present', 'ict-research'); ?>
                                    <?php endif; ?>
                                </p>
                            </div>
                        <?php endif; ?>
                        
                        <?php
                        $areas = get_the_terms(get_the_ID(), 'research_area');
                        if ($areas && !is_wp_error($areas)) :
                            ?>
                            <div class="sidebar-section">
                                <strong><?php _e('Research Area', 'ict-research'); ?></strong>
                                <p>
                                    <?php
                                    $area_names = array();
                                    foreach ($areas as $area) {
                                        $area_names[] = esc_html($area->name);
                                    }
                                    echo implode(', ', $area_names);
                                    ?>
                                </p>
                            </div>
                        <?php endif; ?>
                        
                        <?php
                        $funding = get_post_meta(get_the_ID(), 'funding_source', true);
                        if ($funding) :
                            ?>
                            <div class="sidebar-section">
                                <strong><?php _e('Funding Source', 'ict-research'); ?></strong>
                                <p><?php echo esc_html($funding); ?></p>
                            </div>
                        <?php endif; ?>
                        
                        <div style="margin-top: 30px;">
                            <a href="<?php echo esc_url(home_url('/contact')); ?>" class="btn btn-primary" style="width: 100%; text-align: center;">
                                <?php _e('Contact Team', 'ict-research'); ?>
                            </a>
                        </div>
                    </div>
                </aside>
                
            </div>
            
            <!-- Related Projects -->
            <?php
            $current_areas = wp_get_post_terms(get_the_ID(), 'research_area', array('fields' => 'ids'));
            
            if (!empty($current_areas)) :
                $related_args = array(
                    'post_type'      => 'research_project',
                    'posts_per_page' => 3,
                    'post__not_in'   => array(get_the_ID()),
                    'tax_query'      => array(
                        array(
                            'taxonomy' => 'research_area',
                            'field'    => 'term_id',
                            'terms'    => $current_areas,
                        ),
                    ),
                );
                
                $related_query = new WP_Query($related_args);
                
                if ($related_query->have_posts()) :
                    ?>
                    <section class="related-projects" style="margin-top: 60px;">
                        <h2><?php _e('Related Research Projects', 'ict-research'); ?></h2>
                        <div class="projects-grid">
                            <?php
                            while ($related_query->have_posts()) :
                                $related_query->the_post();
                                get_template_part('template-parts/content', 'project-card');
                            endwhile;
                            wp_reset_postdata();
                            ?>
                        </div>
                    </section>
                    <?php
                endif;
            endif;
            ?>
            
        </div>
        
    </main>

<?php endwhile; ?>

<?php get_footer(); ?>
