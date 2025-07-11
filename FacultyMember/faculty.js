        const sidebar = document.getElementById('sidebar');
        const mainContent = document.getElementById('mainContent');
        const toggleSidebarBtn = document.getElementById('toggleSidebar');
        const navLinks = document.querySelectorAll('.sidebar-nav .nav-link, .breadcrumb-item a.sidebar-link, .quick-actions .btn[data-section]');

        // Function to display filename after selection (for multiple inputs)
        function displayFileName(inputId, displayId) {
            const input = document.getElementById(inputId);
            const display = document.getElementById(displayId);
            if (input && input.files.length > 0) {
                display.textContent = `Selected file: ${input.files[0].name}`;
            } else {
                display.textContent = '';
            }
        }
        
        // Function to handle section switching
        function showSection(sectionId) {
            document.querySelectorAll('.content-section').forEach(section => {
                section.style.display = 'none';
            });
            const activeSection = document.getElementById(sectionId + '-section');
            if (activeSection) {
                activeSection.style.display = 'block';
            }

            document.querySelectorAll('.sidebar-nav .nav-link').forEach(link => {
                link.classList.remove('active');
                if (link.dataset.section === sectionId) {
                    link.classList.add('active');
                }
            });
        }

        navLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                if(this.dataset.section) {
                     // For actual href links like breadcrumbs, prevent default if it's a section link
                    if (this.getAttribute('href') && this.getAttribute('href').startsWith('#')) {
                        e.preventDefault();
                    }
                }

                const sectionId = this.dataset.section;
                if (sectionId) {
                    showSection(sectionId);
                    // Update URL hash, but only if it's a primary navigation, not for quick action buttons that might also have data-section
                    if(this.classList.contains('nav-link') || this.classList.contains('sidebar-link')) {
                        window.location.hash = sectionId;
                    }
                    

                    // If sidebar is not collapsed and screen is small (mobile behavior)
                    if (window.innerWidth <= 768 && !sidebar.classList.contains('collapsed') && sidebar.classList.contains('show')) {
                         sidebar.classList.remove('show'); // Hide sidebar on mobile after click
                    }
                }
            });
        });
        
        // Initial section load based on hash or default to dashboard
        function loadInitialSection() {
            let sectionId = window.location.hash.substring(1);
            if (!sectionId || !document.getElementById(sectionId + '-section')) {
                sectionId = 'dashboard'; // Default section
            }
            showSection(sectionId);
             // Ensure the correct sidebar link is active
            document.querySelectorAll('.sidebar-nav .nav-link').forEach(link => {
                link.classList.remove('active');
                if (link.dataset.section === sectionId) {
                    link.classList.add('active');
                }
            });
        }
        
        let desktopToggleHandler = () => {
            sidebar.classList.toggle('collapsed');
            mainContent.classList.toggle('expanded');
            // Toggle visibility of nav-section-title text, not the element itself
            document.querySelectorAll('.sidebar .nav-section-title .nav-text').forEach(titleText => {
                titleText.style.display = sidebar.classList.contains('collapsed') ? 'none' : '';
            });
        };
        
        let mobileToggleHandler = () => {
             sidebar.classList.toggle('show'); // Used for transform: translateX
        };

        // Responsive sidebar behavior for mobile
        function checkMobileSidebar() {
            if (toggleSidebarBtn) { // Ensure button exists
                toggleSidebarBtn.removeEventListener('click', desktopToggleHandler);
                toggleSidebarBtn.removeEventListener('click', mobileToggleHandler);

                if (window.innerWidth <= 768) {
                    if(!sidebar.classList.contains('collapsed')) { 
                        sidebar.classList.add('collapsed'); 
                        mainContent.classList.add('expanded');
                    }
                    sidebar.classList.remove('show'); 
                    toggleSidebarBtn.addEventListener('click', mobileToggleHandler);
                } else {
                    sidebar.classList.remove('show'); 
                    toggleSidebarBtn.addEventListener('click', desktopToggleHandler);
                }
                // Initial state for section titles based on sidebar state
                document.querySelectorAll('.sidebar .nav-section-title .nav-text').forEach(titleText => {
                     titleText.style.display = sidebar.classList.contains('collapsed') ? 'none' : '';
                });
            }
        }


        // Call on load and resize
        window.addEventListener('load', () => {
            loadInitialSection();
            checkMobileSidebar();
        });
        window.addEventListener('resize', checkMobileSidebar);

        // Add click listener to sidebar links for mobile to hide sidebar after navigation
        document.querySelectorAll('.sidebar .nav-link').forEach(link => {
            link.addEventListener('click', () => {
                if (window.innerWidth <= 768 && sidebar.classList.contains('show')) {
                    sidebar.classList.remove('show');
                }
            });
        });

         // Ensure nav-text within nav-section-title is also handled for collapse/expand
        if (toggleSidebarBtn) {
            toggleSidebarBtn.addEventListener('click', () => {
                 // This is part of the desktopToggleHandler logic now
            });
        }