<?php
// Check if the "Section Intro" sidebar is active
if ( is_active_sidebar( 'section-intro' ) ) : ?>
    <?php dynamic_sidebar( 'section-intro' ); ?>
<?php endif; ?>