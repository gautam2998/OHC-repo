<?php
?>

<footer>
      <div class="container c-container">
        <div class="row align-items-center mx-0">
          <div class="col-lg-6 col-12 px-0">
            <div class="footer-left">
              <div class="footer-logo">
                <?php $footer_logo = get_field('footer_logo', 'option')?>
                <a href="#"><img src="<?php echo $footer_logo['url']; ?>" alt="<?php echo $footer_logo['alt']; ?>" /></a>
              </div>
              <div class="footer-nav-link">
                <?php simple_menu('footer-1') ?>
              </div>
              <div class="footer-nav-link footer-nav-link-responsive">
                <?php simple_menu('footer-2') ?>
              </div>
            </div>
          </div>
          <div class="col-lg-6 col-12 px-0">
            <div class="footer-right">
              <div class="address">
                <address><?php the_field('footer_address', 'option'); ?></address>
                <div class="contact-detail">
                  <?php
                    if (have_rows('footer_contact', 'option')):
                    while (have_rows('footer_contact', 'option')) : the_row();
                    $footer_contact_image = get_sub_field('footer_contact_image');
                  ?>
                  <a href="<?php the_sub_field('footer_contact_url'); ?>"
                    ><img
                      src="<?php echo $footer_contact_image['url'];?>"
                      alt="<?php echo $footer_contact_image['alt'];?>"
                    /><?php the_sub_field('footer_contact_text'); ?></a
                  >
                  <?php
                    endwhile;
                    endif;
                  ?>
                </div>
              </div>
              <div class="footer-social-icon">
                <ul>
                   <?php
                    if (have_rows('social', 'option')):
                    while (have_rows('social', 'option')) : the_row();
                    $social_icons = get_sub_field('social_icons');
                  ?>
                  <li>
                    <a href="<?php the_sub_field('social_url'); ?>"
                      ><img src="<?php echo $social_icons['url'];?>" alt="<?php echo $social_icons['alt'];?>"
                    /></a>
                  </li>
                  <?php
                    endwhile;
                    endif;
                  ?>
                </ul>
              </div>
              <div class="responsive-footer-set">
                <div class="copyright">
                  <span
                    >© <?php echo date('Y'); ?> <a href="<?php home_url(); ?>">Ohio</a> History Connection All Rights Reserved.</span>
                </div>
                <div class="company-policy">
                  <?php simple_menu('footer-3') ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </footer>

<?php wp_footer(); ?>
