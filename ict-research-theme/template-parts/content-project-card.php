<?php
/**
 * Template part for displaying project cards
 *
 * @package ICT_Research
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('project-card'); ?>>
    
    <?php if (has_post_thumbnail()) : ?>
        <a href="<?php the_permalink(); ?>">
            <?php the_post_thumbnail('project-thumbnail', array('class' => 'project-card-image')); ?>
        </a>
    <?php else : ?>
        <div class="project-card-image" style="background: #ecf0f1; display: flex; align-items: center; justify-content: center; color: #95a5a6;">
            <?php _e('No Image', 'ict-research'); ?>
        </div>
    <?php endif; ?>
    
    <div class="project-card-content">
        
        <?php
        $status = get_post_meta(get_the_ID(), 'project_status', true);
        if ($status) :
            $status_class = 'status-' . esc_attr($status);
            $status_label = ucfirst($status);
            ?>
            <span class="project-status <?php echo $status_class; ?>">
                <?php echo esc_html($status_label); ?>
            </span>
        <?php endif; ?>
        
        <h3 class="project-title">
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
        </h3>
        
        <div class="project-meta">
            <?php
            $lead = get_post_meta(get_the_ID(), 'research_lead', true);
            if ($lead) {
                echo esc_html($lead) . ' • ';
            }
            
            $areas = get_the_terms(get_the_ID(), 'research_area');
            if ($areas && !is_wp_error($areas)) {
                echo esc_html($areas[0]->name);
            }
            ?>
        </div>
        
        <div class="project-excerpt">
            <?php echo wp_trim_words(get_the_excerpt(), 20, '...'); ?>
        </div>
        
        <a href="<?php the_permalink(); ?>" class="btn btn-primary" style="font-size: 0.9em;">
            <?php _e('View Project →', 'ict-research'); ?>
        </a>
        
    </div>
    
</article>
