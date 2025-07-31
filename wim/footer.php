        </main>
    </div>

    <footer id="colophon" class="site-footer">
        <div class="footer-content">
            <p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. Tüm hakları saklıdır.</p>
            <p>WordPress ile güçlendirilmiştir.</p>
        </div>
    </footer>
</div>

<script>
// Mobile menu toggle
document.addEventListener('DOMContentLoaded', function() {
    const mobileMenuToggle = document.getElementById('mobile-menu-toggle');
    const mobileMenu = document.getElementById('mobile-menu');
    
    if (mobileMenuToggle && mobileMenu) {
        mobileMenuToggle.addEventListener('click', function() {
            mobileMenu.classList.toggle('active');
        });
        
        // Close mobile menu when clicking outside
        document.addEventListener('click', function(e) {
            if (!mobileMenuToggle.contains(e.target) && !mobileMenu.contains(e.target)) {
                mobileMenu.classList.remove('active');
            }
        });
    }
});
</script>

<?php wp_footer(); ?>

</body>
</html> 