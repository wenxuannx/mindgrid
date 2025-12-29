<?php
/**
 * Template Name: Contact Page
 *
 * @package ICT_Research
 */

get_header(); ?>

<main id="primary" class="site-main contact-page-wrapper">

    <!-- Contact Page with Hero Background -->
    <section class="contact-full-page hero-section-dark" id="contact-particles">
        <div class="contact-content-wrapper">

            <h1 class="contact-page-title">Get in touch</h1>

            <div class="contact-layout">

                

                <!-- Right: Contact Form -->
                <div class="contact-form-wrapper">
                    <form class="contact-form-modern" id="contact-form" method="post" action="">

                        <div class="form-group">
                            <input type="text" id="contact-name" name="contact_name" placeholder="Name" required>
                        </div>

                        <div class="form-group">
                            <input type="email" id="contact-email" name="contact_email" placeholder="Email" required>
                        </div>

                        <div class="form-group">
                            <textarea id="contact-message" name="contact_message" rows="6" placeholder="Message" required></textarea>
                        </div>

                        <button type="submit" class="btn-send">
                            Submit
                        </button>

                    </form>

                    <div id="form-response" class="form-response" style="display: none;"></div>
                </div>

            </div>

        </div>
    </section>

</main>

<?php get_footer(); ?>
