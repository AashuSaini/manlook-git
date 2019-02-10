<div class="wrap-logo-mobile text-center">
    <?php 
        $logo_mobile = get_theme_mod('zoo_site_logo_mobile','');
        if($logo_mobile){ ?>
            <span class="site-logo-mobile">
                <a href="<?php echo esc_url(home_url('/')); ?>" rel="home"
                              title="<?php bloginfo('name'); ?>">
                    <img src="<?php echo esc_url(($logo_mobile)) ?>" alt="<?php bloginfo('name'); ?>"/>
                </a>
            </span>
    <?php } else{ ?>
        <p class="site-title">
            <a href="<?php echo esc_url(home_url('/')); ?>" rel="home"
                          title="<?php bloginfo('name'); ?>"><?php bloginfo('name'); ?></a>
        </p>
    <?php }?>
</div>