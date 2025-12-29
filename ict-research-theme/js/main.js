/**
 * ICT Research Theme JavaScript
 */

(function($) {
    'use strict';

    /**
     * Mobile Menu Toggle
     */
    function initMobileMenu() {
        const menuToggle = $('.menu-toggle');
        const navigation = $('.main-navigation');
        const menuIcon = menuToggle.find('i');

        menuToggle.on('click', function() {
            navigation.toggleClass('toggled');
            const expanded = $(this).attr('aria-expanded') === 'true' || false;
            $(this).attr('aria-expanded', !expanded);

            // Toggle icon between bars and times (X)
            if (menuIcon.hasClass('fa-bars')) {
                menuIcon.removeClass('fa-bars').addClass('fa-times');
            } else {
                menuIcon.removeClass('fa-times').addClass('fa-bars');
            }
        });

        // Close menu when clicking on menu items
        $('.main-navigation a').on('click', function() {
            if ($(window).width() <= 768) {
                navigation.removeClass('toggled');
                menuToggle.attr('aria-expanded', 'false');
                menuIcon.removeClass('fa-times').addClass('fa-bars');
            }
        });
    }

    /**
     * AJAX Project Filtering
     */
    function initProjectFilters() {
        const filterArea = $('#filter-research-area');
        const filterStatus = $('#filter-status');
        const filterDepartment = $('#filter-department');
        const filterSearch = $('#filter-search');
        const container = $('#projects-container');

        // Debounce function for search
        function debounce(func, wait) {
            let timeout;
            return function executedFunction(...args) {
                const later = () => {
                    clearTimeout(timeout);
                    func(...args);
                };
                clearTimeout(timeout);
                timeout = setTimeout(later, wait);
            };
        }

        function filterProjects() {
            const data = {
                action: 'filter_projects',
                nonce: ictResearch.nonce,
                research_area: filterArea.val(),
                status: filterStatus.val(),
                department: filterDepartment.val(),
                search: filterSearch.val(),
                paged: 1
            };

            // Show loading state
            container.html('<p style="text-align: center; padding: 40px;">Loading projects...</p>');

            $.ajax({
                url: ictResearch.ajaxurl,
                type: 'POST',
                data: data,
                success: function(response) {
                    container.html(response);
                    
                    // Update results count
                    updateResultsCount();
                },
                error: function() {
                    container.html('<p style="text-align: center; color: #e74c3c;">Error loading projects. Please try again.</p>');
                }
            });
        }

        function updateResultsCount() {
            const projectCount = $('.project-card').length;
            const resultsText = projectCount === 1 ? 
                'Showing 1 project' : 
                'Showing ' + projectCount + ' projects';
            $('.results-count').text(resultsText);
        }

        // Attach event listeners
        if (filterArea.length) {
            filterArea.on('change', filterProjects);
        }

        if (filterStatus.length) {
            filterStatus.on('change', filterProjects);
        }

        if (filterDepartment.length) {
            filterDepartment.on('change', filterProjects);
        }

        if (filterSearch.length) {
            const debouncedFilter = debounce(filterProjects, 500);
            filterSearch.on('keyup', debouncedFilter);
        }
    }

    /**
     * Smooth Scroll for Anchor Links
     */
    function initSmoothScroll() {
        $('a[href*="#"]').not('[href="#"]').not('[href="#0"]').on('click', function(event) {
            if (location.pathname.replace(/^\//, '') === this.pathname.replace(/^\//, '') && 
                location.hostname === this.hostname) {
                
                let target = $(this.hash);
                target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
                
                if (target.length) {
                    event.preventDefault();
                    $('html, body').animate({
                        scrollTop: target.offset().top - 80
                    }, 800);
                }
            }
        });
    }

    /**
     * Gallery Lightbox (Simple Implementation)
     */
    function initGalleryLightbox() {
        const galleryItems = $('.gallery-item img, .project-gallery img');
        
        if (!galleryItems.length) return;

        // Create lightbox overlay
        const lightbox = $('<div class="lightbox-overlay" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.9); z-index:9999; cursor:pointer;"></div>');
        const lightboxImg = $('<img style="position:absolute; top:50%; left:50%; transform:translate(-50%, -50%); max-width:90%; max-height:90%; cursor:default;">');
        const closeBtn = $('<span style="position:absolute; top:20px; right:40px; color:#fff; font-size:40px; cursor:pointer;">&times;</span>');
        
        lightbox.append(closeBtn);
        lightbox.append(lightboxImg);
        $('body').append(lightbox);

        galleryItems.on('click', function(e) {
            e.preventDefault();
            const src = $(this).attr('src');
            lightboxImg.attr('src', src);
            lightbox.fadeIn(300);
        });

        lightbox.on('click', function(e) {
            if (e.target !== lightboxImg[0]) {
                lightbox.fadeOut(300);
            }
        });

        closeBtn.on('click', function() {
            lightbox.fadeOut(300);
        });

        // Close on ESC key
        $(document).on('keyup', function(e) {
            if (e.key === 'Escape' && lightbox.is(':visible')) {
                lightbox.fadeOut(300);
            }
        });
    }

    /**
     * Sticky Header on Scroll with Glassmorphism Effect
     */
    function initStickyHeader() {
        const header = $('.site-header');

        $(window).on('scroll', function() {
            if ($(window).scrollTop() > 50) {
                header.addClass('scrolled');
            } else {
                header.removeClass('scrolled');
            }
        });
    }

    /**
     * Card Hover Effects
     */
    function initCardEffects() {
        $('.project-card').hover(
            function() {
                $(this).addClass('hover-state');
            },
            function() {
                $(this).removeClass('hover-state');
            }
        );
    }

    /**
     * Lazy Load Images (Simple Implementation)
     */
    function initLazyLoad() {
        if ('IntersectionObserver' in window) {
            const images = document.querySelectorAll('img[data-src]');
            
            const imageObserver = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const img = entry.target;
                        img.src = img.dataset.src;
                        img.removeAttribute('data-src');
                        imageObserver.unobserve(img);
                    }
                });
            });

            images.forEach(img => imageObserver.observe(img));
        }
    }

    /**
     * Back to Top Button
     */
    function initBackToTop() {
        // Create button
        const backToTop = $('<button class="back-to-top" style="display:none; position:fixed; bottom:30px; right:30px; background:#3498db; color:#fff; border:none; border-radius:50%; width:50px; height:50px; cursor:pointer; box-shadow:0 2px 10px rgba(0,0,0,0.2); z-index:1000;">↑</button>');
        $('body').append(backToTop);

        // Show/hide on scroll
        $(window).on('scroll', function() {
            if ($(window).scrollTop() > 300) {
                backToTop.fadeIn();
            } else {
                backToTop.fadeOut();
            }
        });

        // Scroll to top on click
        backToTop.on('click', function() {
            $('html, body').animate({ scrollTop: 0 }, 600);
        });
    }

    /**
     * Contact Form AJAX Submission with Modal
     */
    function initContactForm() {
        // Create and append modal HTML
        const modalHTML = `
            <div class="modal-overlay"></div>
            <div class="modal-content">
                <button class="modal-close-btn">&times;</button>
                <div class="modal-icon"></div>
                <h3 class="modal-title"></h3>
                <p class="modal-message"></p>
                <button class="btn btn-primary modal-action-btn">Close</button>
            </div>
        `;
        if (!$('.modal-overlay').length) {
            $('body').append(modalHTML);
        }

        const form = $('.contact-form-modern');
        if (!form.length) return;

        const modalOverlay = $('.modal-overlay');
        const modalContent = $('.modal-content');
        const submitBtn = form.find('.btn-send');
        const originalBtnHTML = submitBtn.html();

        function showModal(type, title, message) {
            modalContent.find('.modal-icon').html(type === 'success' ? '<i class="fas fa-check-circle"></i>' : '<i class="fas fa-times-circle"></i>');
            modalContent.find('.modal-icon').removeClass('success error').addClass(type);
            modalContent.find('.modal-title').text(title);
            modalContent.find('.modal-message').text(message);
            modalOverlay.addClass('visible');
            modalContent.addClass('visible');
        }

        function hideModal() {
            modalOverlay.removeClass('visible');
            modalContent.removeClass('visible');
        }

        // Close modal events
        $('body').on('click', '.modal-overlay, .modal-close-btn, .modal-action-btn', hideModal);
        $(document).on('keyup', function(e) {
            if (e.key === 'Escape' && modalOverlay.hasClass('visible')) {
                hideModal();
            }
        });

        form.on('submit', function(e) {
            e.preventDefault();
            let isValid = true;
            
            form.find('.error-field').removeClass('error-field');

            form.find('input[required], textarea[required]').each(function() {
                if ($(this).val().trim() === '') {
                    isValid = false;
                    $(this).addClass('error-field');
                }
            });

            const emailField = form.find('input[type="email"][required]');
            if (emailField.length > 0) {
                const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (emailField.val().trim() === '' || !emailPattern.test(emailField.val())) {
                    isValid = false;
                    emailField.addClass('error-field');
                }
            }

            if (!isValid) {
                showModal('error', 'Validation Error', 'Please fill in all required fields correctly.');
                return;
            }

            submitBtn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Sending...');
            const formData = $(this).serialize() + '&action=send_contact_message&nonce=' + ictResearch.nonce;

            $.post(ictResearch.ajaxurl, formData, function(response) {
                submitBtn.prop('disabled', false).html(originalBtnHTML);
                if (response.success) {
                    form[0].reset();
                    showModal('success', 'Message Submitted!', 'Thank you for contacting us. We will get back to you shortly.');
                } else {
                    showModal('error', 'Submission Failed', response.data.message || 'An unknown error occurred. Please try again.');
                }
            }).fail(function() {
                submitBtn.prop('disabled', false).html(originalBtnHTML);
                showModal('error', 'Network Error', 'Could not connect to the server. Please check your internet connection and try again.');
            });
        });
    }

    /**
     * Initialize Particle Ground Animation on Hero and Archive Pages
     */
    function initParticleground() {
        const particleContainers = [
            document.getElementById('hero-particles'),
            document.getElementById('archive-particles'),
            document.getElementById('contact-particles')
        ];

        const particleConfig = {
            dotColor: 'rgba(255, 255, 255, 0.5)',
            lineColor: 'rgba(66, 135, 245, 0.3)',
            particleRadius: 5,
            lineWidth: 1,
            curvedLines: false,
            proximity: 120,
            parallax: true,
            parallaxMultiplier: 5,
            density: 15000,
            minSpeedX: 0.05,
            maxSpeedX: 0.3,
            minSpeedY: 0.05,
            maxSpeedY: 0.3
        };

        particleContainers.forEach(function(container) {
            if (container && typeof particleground === 'function') {
                particleground(container, particleConfig);
            }
        });
    }

    /**
     * Chatbox Widget Functionality
     */
    function initChatbox() {
        const chatToggle = $('.chatbox-toggle');
        const chatWindow = $('.chatbox-window');
        const chatClose = $('.chatbox-close');
        const chatInput = $('#chat-input');
        const chatSendBtn = $('#chat-send-btn');
        const chatMessages = $('#chatbox-messages');
        const notificationBadge = $('.chat-notification-badge');

        // Toggle chat window
        chatToggle.on('click', function() {
            chatWindow.toggleClass('active');
            if (chatWindow.hasClass('active')) {
                chatInput.focus();
                // Hide notification badge when chat is opened
                notificationBadge.fadeOut();
            }
        });

        // Close chat window
        chatClose.on('click', function() {
            chatWindow.removeClass('active');
        });

        // Send message function
        function sendMessage() {
            const message = chatInput.val().trim();

            if (message === '') {
                return;
            }

            // Get current time
            const now = new Date();
            const timeString = now.toLocaleTimeString('en-US', {
                hour: 'numeric',
                minute: '2-digit',
                hour12: true
            });

            // Create user message
            const userMessageHTML = `
                <div class="chat-message user-message">
                    <div class="message-avatar">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="message-content">
                        <p>${escapeHtml(message)}</p>
                        <span class="message-time">${timeString}</span>
                    </div>
                </div>
            `;

            // Append user message
            chatMessages.append(userMessageHTML);
            chatInput.val('');

            // Scroll to bottom
            chatMessages.scrollTop(chatMessages[0].scrollHeight);

            // Simulate bot response after 1 second
            setTimeout(function() {
                const botResponses = [
                    "Thank you for your message! A team member will respond shortly.",
                    "I've received your inquiry. How else can I assist you?",
                    "Got it! Is there anything specific you'd like to know about our research?",
                    "Thanks for reaching out! Our team will get back to you soon.",
                    "Received! Feel free to ask me anything about our projects."
                ];

                const randomResponse = botResponses[Math.floor(Math.random() * botResponses.length)];

                const botMessageHTML = `
                    <div class="chat-message bot-message">
                        <div class="message-avatar">
                            <i class="fas fa-robot"></i>
                        </div>
                        <div class="message-content">
                            <p>${randomResponse}</p>
                            <span class="message-time">${timeString}</span>
                        </div>
                    </div>
                `;

                chatMessages.append(botMessageHTML);
                chatMessages.scrollTop(chatMessages[0].scrollHeight);
            }, 1000);
        }

        // Helper function to escape HTML
        function escapeHtml(text) {
            const map = {
                '&': '&amp;',
                '<': '&lt;',
                '>': '&gt;',
                '"': '&quot;',
                "'": '&#039;'
            };
            return text.replace(/[&<>"']/g, function(m) { return map[m]; });
        }

        // Send message on button click
        chatSendBtn.on('click', sendMessage);

        // Send message on Enter key
        chatInput.on('keypress', function(e) {
            if (e.which === 13) {
                sendMessage();
            }
        });

        // Show notification badge after 3 seconds (simulate new message)
        setTimeout(function() {
            if (!chatWindow.hasClass('active')) {
                notificationBadge.fadeIn();
            }
        }, 3000);
    }

    /**
     * Initialize all functions on document ready
     */
    $(document).ready(function() {
        initMobileMenu();
        initProjectFilters();
        initSmoothScroll();
        initGalleryLightbox();
        initStickyHeader();
        initCardEffects();
        initLazyLoad();
        initBackToTop();
        initContactForm();
        initParticleground();
        initChatbox();

        console.log('ICT Research Theme initialized');
    });

    /**
     * Responsive adjustments on window resize
     */
    $(window).on('resize', function() {
        // Close mobile menu on desktop
        if ($(window).width() > 768) {
            $('.main-navigation').removeClass('toggled');
            $('.menu-toggle').attr('aria-expanded', 'false');
        }
    });

})(jQuery);
