<!-- Google Tag Manager (noscript) -->
 <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-K28D5R" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
<header>
  <div class="top-nav">
    <div class="container">
      <div class="row d-flex align-items-center">
        <div class="col-12 text-right inner-topnav-block">
          <div class="top-menu">
            <?php
                wp_nav_menu(
    array(
                        'theme_location' => 'topheader',
                        'container'       => false,
                        'depth'             => 3,

                    )
);
            ?>
          </div>

          <div class="serch-blcok">
            <?php get_search_form(); ?>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div x-data="{ navOpen: false }" class="container position-relative">
    <div class="logo">
      <?php
        $custom_logo_id = get_theme_mod('custom_logo');
        $logo = wp_get_attachment_image_src($custom_logo_id, 'full');
        if (has_custom_logo()) {
            echo '<a href="' .esc_url(home_url()) . '"><img src="' . esc_url($logo[0]) . '" alt="' . get_bloginfo('name') . '"></a>';
        } else {
            echo '<h1>'. get_bloginfo('name') .'</h1>';
        }
        ?>
    </div>
    <div class="menu" :class="!navOpen ? '' : 'display'">
    <?php
        wp_nav_menu(
            array(
                'theme_location' => 'primary',
                'container'       => false,
                'items_wrap' => '<ul class="exo-menu">%3$s</ul>',
                'depth'             => 3,
                'walker'         => new Clean_Nav_Walker(),
            )
        );
    ?>
          <div class="top-menu responsive-top-menus">
            <?php
                wp_nav_menu(
        [
                        'theme_location' => 'topheader',
                        'container'      => false,
                        'depth'          => 3,

                    ]
    );
                ?>
          </div>
    </div>
<?php
        $mobile_menu_icon = get_field('mobile_menu_icon', 'option');
        $mobile_menu_close_icon = get_field('mobile_menu_close_icon', 'option');
      ?>
        <a x-show="!navOpen" @click="navOpen = true" class="toggle-menu open-menu-icon d-md-none"
          ><img src="<?php echo $mobile_menu_icon['url']; ?>" alt="<?php echo $mobile_menu_icon['alt']; ?>"
        /></a>
        <a x-show="navOpen" @click="navOpen = false" class="toggle-menu close-icon d-md-none"
          ><img src="<?php echo $mobile_menu_close_icon['url']; ?>" alt="<?php echo $mobile_menu_close_icon['alt']; ?>"
        /></a>
  </div>
</header>

