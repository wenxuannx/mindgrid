<?php
/**
 * The footer template
 *
 * @package ICT_Research
 */
?>

</div><!-- #content -->

<footer id="colophon" class="site-footer">
    <div class="container">
        <div class="footer-content">
            
            <?php if (is_active_sidebar('footer-1')) : ?>
                <div class="footer-widgets">
                    <?php dynamic_sidebar('footer-1'); ?>
                </div>
            <?php endif; ?>
            
            <div class="footer-info">
                <p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. <?php esc_html_e('All rights reserved.', 'ict-research'); ?></p>
                
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'footer',
                    'menu_id'        => 'footer-menu',
                    'container'      => 'nav',
                    'container_class' => 'footer-navigation',
                    'fallback_cb'    => false,
                ));
                ?>
            </div>
            
            <div class="footer-social">
                <!-- Add your social media links here -->
                <a href="#" aria-label="Facebook"><span class="dashicons dashicons-facebook"></span></a>
                <a href="#" aria-label="Twitter"><span class="dashicons dashicons-twitter"></span></a>
                <a href="#" aria-label="LinkedIn"><span class="dashicons dashicons-linkedin"></span></a>
            </div>
            
        </div>
    </div>
</footer>

<!-- Chatbox Widget -->
<div class="chatbox-widget">
    <!-- Chat Toggle Button -->
    <button class="chatbox-toggle" aria-label="Toggle Chat">
        <i class="fas fa-comment-dots"></i>
        <span class="chat-notification-badge">1</span>
    </button>

    <!-- Chat Window -->
    <div class="chatbox-window">
        <!-- Chat Header -->
        <div class="chatbox-header">
            <div class="chatbox-header-info">
                <i class="fas fa-user-circle"></i>
                <div>
                    <h4>ICT Research Support</h4>
                    <span class="chatbox-status">
                        <span class="status-dot"></span>
                        Online
                    </span>
                </div>
            </div>
            <button class="chatbox-close" aria-label="Close Chat">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <!-- Chat Messages -->
        <div class="chatbox-messages" id="chatbox-messages">
            <div class="chat-message bot-message">
                <div class="message-avatar">
                    <i class="fas fa-robot"></i>
                </div>
                <div class="message-content">
                    <p>Hello! 👋 How can we help you today?</p>
                    <span class="message-time">Just now</span>
                </div>
            </div>
        </div>

        <!-- Chat Input -->
        <div class="chatbox-input">
            <input type="text" id="chat-input" placeholder="Type your message..." autocomplete="off">
            <button class="chat-send-btn" id="chat-send-btn" aria-label="Send Message">
                <i class="fas fa-paper-plane"></i>
            </button>
        </div>
    </div>
</div>

<?php wp_footer(); ?>

</body>
</html>
