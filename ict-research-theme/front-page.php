<?php
/**
 * Custom Front Page Template
 * Template Name: Homepage
 */

get_header(); ?>

<!-- Hero Section -->
<section class="hero-section-dark" id="hero-particles">
    <div class="hero-content">
        
        <div class="hero-badge">
            <i class="fas fa-star"></i>
            <span>Leading Research Innovation</span>
        </div>
        
        <h1 class="hero-title">Advancing Research Through Innovation</h1>
        
        <p class="hero-subtitle">
            A collaborative research platform exploring cutting-edge solutions in artificial intelligence, 
            data science, cybersecurity, and emerging technologies.
        </p>
        
        <div class="hero-buttons">
            <a href="<?php echo home_url('/research-projects'); ?>" class="hero-btn-primary">
                Explore Research Projects
                <i class="fas fa-arrow-right"></i>
            </a>
  
        </div>
        
        <div class="hero-stats">
            <div class="stat-item">
                <span class="stat-number">15+</span>
                <span class="stat-label">Active Projects</span>
            </div>
            <div class="stat-item">
                <span class="stat-number">50+</span>
                <span class="stat-label">Researchers</span>
            </div>
            <div class="stat-item">
                <span class="stat-number">100+</span>
                <span class="stat-label">Publications</span>
            </div>
        </div>
        
    </div>
</section>

<!-- Features/Research Areas Section -->
<section class="features-section">
    <div class="features-container">
        
        <h2 class="section-title">Our Research Areas</h2>
        <p class="section-subtitle">
            Exploring the frontiers of technology through interdisciplinary collaboration and innovation
        </p>
        
        <div class="features-grid">
            
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-brain"></i>
                </div>
                <h3 class="feature-title">Artificial Intelligence</h3>
                <p class="feature-description">
                    Developing intelligent systems that learn, adapt, and solve complex problems across various domains.
                </p>
            </div>
            
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-shield-alt"></i>
                </div>
                <h3 class="feature-title">Cybersecurity</h3>
                <p class="feature-description">
                    Creating robust security solutions to protect digital infrastructure and data from emerging threats.
                </p>
            </div>
            
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-chart-line"></i>
                </div>
                <h3 class="feature-title">Data Science</h3>
                <p class="feature-description">
                    Extracting insights from large datasets to drive decision-making and innovation.
                </p>
            </div>
            
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-network-wired"></i>
                </div>
                <h3 class="feature-title">Distributed Systems</h3>
                <p class="feature-description">
                    Building scalable and reliable systems for the next generation of digital infrastructure.
                </p>
            </div>
            
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-user-friends"></i>
                </div>
                <h3 class="feature-title">Human-Computer Interaction</h3>
                <p class="feature-description">
                    Designing intuitive interfaces that enhance user experience and accessibility.
                </p>
            </div>
            
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="fas fa-leaf"></i>
                </div>
                <h3 class="feature-title">Sustainable Computing</h3>
                <p class="feature-description">
                    Developing environmentally responsible technology solutions for a greener future.
                </p>
            </div>
            
        </div>
        
        <div style="text-align: center; margin-top: 2rem;">
            <a href="<?php echo home_url('/research-projects'); ?>" class="btn btn-primary">
                Explore Research Projects →
            </a>
        </div>
        
    </div>
</section>

<?php get_footer(); ?>