<?php
/**
 * Template Name: About Page
 *
 * @package ICT_Research
 */

get_header(); ?>

<main id="primary" class="site-main">

    <!-- Hero Section -->
    <section class="hero-section-firefly">
        <div class="firefly-bg-overlay"></div>
        <div class="firefly-bg-pattern"></div>
        
        <!-- Firefly Particles -->
        <div class="firefly-container">
            <?php for ($i = 0; $i < 70; $i++) : 
                $size = rand(3, 8);
                $startX = rand(0, 100);
                $endX = rand(0, 100);
                $startY = rand(100, 120);
                $endY = -1 * rand(10, 30);
                $duration = rand(20, 40);
                $delay = rand(-40, 0); // Negative delay to ensure particles are visible on load
            ?>
                <div class="firefly-particle-wrapper" style="
                    --size: <?php echo $size; ?>px;
                    --x-start: <?php echo $startX; ?>vw;
                    --x-end: <?php echo $endX; ?>vw;
                    --y-start: <?php echo $startY; ?>vh;
                    --y-end: <?php echo $endY; ?>vh;
                    --duration: <?php echo $duration; ?>s;
                    --delay: <?php echo $delay; ?>s;">
                    <div class="firefly-circle"></div>
                </div>
            <?php endfor; ?>
        </div>

        <div class="hero-content" style="position: relative; z-index: 10;">
            <h1 class="hero-title">About Our Research</h1>
            <p class="hero-subtitle">
                Pioneering the future of technology through interdisciplinary collaboration and academic excellence.
            </p>
        </div>
    </section>

    <!-- Mission & Vision -->
    <section class="section-padding">
        <div class="container">
            <div class="about-grid">
                <div class="about-content">
                    <h2 class="section-title text-left" style="text-align: left;">Our Mission</h2>
                    <p>To advance the frontiers of Information and Communication Technology through innovative research, fostering a collaborative environment that bridges the gap between theoretical foundations and real-world applications.</p>
                    
                    <h2 class="section-title text-left mt-4" style="text-align: left;">Our Vision</h2>
                    <p>To be a globally recognized center of excellence in ICT research, driving digital transformation and sustainable technological development for the betterment of society.</p>
                </div>
                <div class="about-image">
                    <div class="feature-card" style="height: 100%; display: flex; align-items: center; justify-content: center; background: #f8f9fa; min-height: 300px;">
                        <i class="fas fa-university" style="font-size: 8rem; color: #e1e4e8;"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="stats-section">
        <div class="container">
            <div class="stats-grid">
                <div class="stat-item">
                    <h3>2015</h3>
                    <p>Established</p>
                </div>
                <div class="stat-item">
                    <h3>$5M+</h3>
                    <p>Research Grants</p>
                </div>
                <div class="stat-item">
                    <h3>40+</h3>
                    <p>Industry Partners</p>
                </div>
                <div class="stat-item">
                    <h3>150+</h3>
                    <p>Alumni</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Team Section -->
    <section class="section-padding" style="background: #fff;">
        <div class="container">
            <h2 class="section-title">Meet Our Team</h2>
            <p class="section-subtitle">The brilliant minds behind our research initiatives</p>
            
            <div class="team-grid">
                <!-- Team Member 1 -->
                <div class="team-card-flip">
                    <div class="team-card-inner">
                        <div class="team-card-front">
                            <div class="team-avatar">
                                <i class="fas fa-user-circle"></i>
                            </div>
                            <h3>Dr. Sarah Connor</h3>
                            <span class="team-role">Director of Research</span>
                        </div>
                        <div class="team-card-back">
                            <h3>Dr. Sarah Connor</h3>
                            <p>Specializing in Artificial Intelligence and Neural Networks.</p>
                        </div>
                    </div>
                </div>

                <!-- Team Member 2 -->
                <div class="team-card-flip">
                    <div class="team-card-inner">
                        <div class="team-card-front">
                            <div class="team-avatar">
                                <i class="fas fa-user-circle"></i>
                            </div>
                            <h3>Prof. Alan Turing</h3>
                            <span class="team-role">Lead Data Scientist</span>
                        </div>
                        <div class="team-card-back">
                            <h3>Prof. Alan Turing</h3>
                            <p>Expert in Cryptography and Algorithm Design.</p>
                        </div>
                    </div>
                </div>

                <!-- Team Member 3 -->
                <div class="team-card-flip">
                    <div class="team-card-inner">
                        <div class="team-card-front">
                            <div class="team-avatar">
                                <i class="fas fa-user-circle"></i>
                            </div>
                            <h3>Dr. Ada Lim</h3>
                            <span class="team-role">Senior Researcher</span>
                        </div>
                        <div class="team-card-back">
                            <h3>Dr. Ada Lim</h3>
                            <p>Pioneer in Computer Programming and Systems Architecture.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>