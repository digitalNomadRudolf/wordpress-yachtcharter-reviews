<!-- footer section with links to charter yachts and again a newsletter signup -->
<footer class="footer">
                <div class="container">
                    <div class="row">
                        
                       <?php 

                        if(is_active_sidebar('footer-1')) {
                            dynamic_sidebar('footer-1');
                        }
                        if(is_active_sidebar('footer-2')) {
                            dynamic_sidebar('footer-2');
                        }
                        if(is_active_sidebar('footer-3')) {
                            dynamic_sidebar('footer-3');
                        }

                       ?>
                    </div>

                    <p class="btm-copy">Made with &hearts; by Digital Nomad Rudolf &copy; 2019</p>
                </div>
            </footer>

            <?php wp_footer();?>
    </body>
</html>