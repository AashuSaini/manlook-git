<?php
/**
 * Template display cover image of Woocommerce Page
 * @since: zoo-theme 1.0.0
 * @Ver: 1.0.0
 */
?>
<?php 
    global $WCMp;
    $vendor_info = zoo_get_vendor_info(); 
?>
<div class="warp-vendor-info">
    <div class="row">
        <div class="vendor-img-profile col-xs-12 col-sm-4 col-md-4">
            <?php if($vendor_info['profile']){ ?>
            <img src="<?php echo esc_url($vendor_info['profile']); ?>">
            <?php } ?>
        </div>
        <div class="vendor-content-profile col-xs-12 col-sm-8 col-md-8">
            <?php if($vendor_info['display_name']){ ?>
            <h2 class="vendor-title"><?php echo esc_attr($vendor_info['display_name']); ?></h2>
            <?php } ?>
            <div class="vendor-rating">
            <?php 
            if (get_wcmp_vendor_settings('is_sellerreview', 'general') == 'Enable') {
                $queried_object = get_queried_object();
                if (isset($queried_object->term_id) && !empty($queried_object)) {
                    $rating_val_array = wcmp_get_vendor_review_info($queried_object->term_id);
                    $WCMp->template->get_template('review/rating.php', array('rating_val_array' => $rating_val_array)); ?>
                    <?php if($rating_val_array['total_rating'] > 1) { ?>
                    <span class="totals-rating"><?php echo esc_attr($rating_val_array['avg_rating']).esc_html__(' rating from ','doma').esc_attr($rating_val_array['total_rating']).esc_html__(' reviews ','doma'); ?>
                    </span>
                <?php } if($rating_val_array['total_rating'] == 1) { ?>
                    <span class="totals-rating"><?php echo esc_attr($rating_val_array['avg_rating']).esc_html__(' rating from ','doma').esc_attr($rating_val_array['total_rating']).esc_html__(' review ','doma'); ?>
                    </span>
                    
            <?php } } } ?>
            </div>
            <?php if($vendor_info['location']){ ?>
            <p class="vendor-address vendor-content">
                <?php echo esc_html__('Address: ','doma'); ?><span><?php echo esc_attr($vendor_info['location']); ?></span></p><?php } ?>
            <?php if($vendor_info['mobile']){ ?>
            <p class="vendor-phone vendor-content">
                <?php echo esc_html__('Phone: ','doma'); ?><span><?php echo esc_attr($vendor_info['mobile']); ?></span></p><?php } ?>
            <?php if($vendor_info['email']){ ?>
            <p class="vendor-email vendor-content">
                <?php echo esc_html__('Email: ','doma'); ?><span><?php echo esc_attr($vendor_info['email']); ?></span></p><?php } ?>
            <p class="vendor-content">
                <?php echo esc_html__('Follow us on social ','doma'); ?></p>
            <ul class="vendor-social">
                <?php if($vendor_info['social']['fb']){ ?>
                <li class="facebook"><a href="<?php echo esc_url($vendor_info['social']['fb']) ?>"
                            title="<?php echo esc_html__('Share to facebook', 'doma') ?>">
                            <i class="cs-font clever-icon-facebook"></i></a></li><?php } ?>
                <?php if($vendor_info['social']['tw']){ ?>
                <li class="twitter"><a href="<?php echo esc_url($vendor_info['social']['tw']) ?>" 
                            title="<?php echo esc_html__('Share to twitter', 'doma') ?>">
                            <i class="cs-font clever-icon-twitter"></i></a></li><?php } ?>
                <?php if($vendor_info['social']['gp']){ ?>
                <li class="googleplus"><a href="<?php echo esc_url($vendor_info['social']['gp']) ?>" 
                            title="<?php echo esc_html__('Share to google plus', 'doma') ?>">
                            <i class="cs-font clever-icon-googleplus"></i></a></li><?php } ?>
                <?php if($vendor_info['social']['ld']){ ?>
                <li class="linkedln"><a href="<?php echo esc_url($vendor_info['social']['ld']) ?>"
                            title="<?php echo esc_html__('Share to pinterest', 'doma') ?>">
                            <i class="cs-font clever-icon-linkedin"></i></a></li><?php } ?>
                <?php if($vendor_info['social']['yt']){ ?>
                <li class="youtube"><a href="<?php echo esc_url($vendor_info['social']['yt']) ?>" 
                            title="<?php echo esc_html__('Share to google plus', 'doma') ?>">
                            <i class="cs-font clever-icon-youtube-1"></i></a></li><?php } ?>
                <?php if($vendor_info['social']['it']){ ?>
                <li class="instagram"><a href="<?php echo esc_url($vendor_info['social']['it']) ?>"
                            title="<?php echo esc_html__('Share to pinterest', 'doma') ?>">
                            <i class="cs-font clever-icon-instagram"></i></a></li><?php } ?>
            </ul>
        </div>
    </div>
</div>