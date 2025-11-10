<?php
	$id = 0;
	$dir = plugins_url('', dirname(__FILE__) );
	$blockClass = 'wp-block-menu-option-block'; 
	$menu_option = get_fields()['menu_option'] ?? '';

	// Menu Walkers
	$wp_header_menu = array(
		'theme_location' 	=> 'wp-header-menu',
		'depth'             => 4,
		'container'         => false,
		'menu_class'        => '',
		'before' 			=> '<input class="item-sub" type="checkbox" name="menu-item"><em></em>',
		'fallback_cb'       => '__return_false',
		'items_wrap' 		=> '<ul id="%1$s" class="menu-item__sub-wrap navbar-nav me-auto mb-2 mb-md-0 %2$s">%3$s</ul>',
		'walker'            => new bootstrap_5_wp_nav_menu_walker(),
	) ?? '';

	$wp_footer_menu = array(
		'theme_location' => 'wp-footer-menu',
		'container' => 'nav',
		'container_class' => 'foo-menu-block__content--list',						
		'container_id' => 'wp-footer-menu',
		'menu_class' => 'foo-menu-block__content',
		'fallback_cb' => '__return_false',
		'items_wrap' => '<ul id="%1$s" class="navbar-nav me-auto mb-2 mb-md-0 %2$s">%3$s</ul>',
		'depth' => 1, // 1 = no dropdowns, 2+ dropdowns
		'before' => '<input class="item-sub" type="checkbox" name="nav">',
		'after' => '',
		'link_before' => '',
		'link_after' => '',
		'walker' => new bootstrap_5_wp_nav_menu_walker()
	) ?? '';
?>
<?php if( $menu_option == 'WP Footer Menu' ) { ?>
	<div class="foo-menu-block">
		<?php wp_nav_menu( $wp_footer_menu ); ?>
	</div>
<?php } elseif ( $menu_option == 'WP Header Menu' ) { ?>
	<nav class="navbar navbar-expand-md navbar-light bg-light header-nav header-menu-block" role="navigation">
		<span class="navbar-toggler-btn" data-target="#wp-header-menu" style="display:none"><em></em><em></em><em></em></span>
		<div class="container-boxed">
			<div class="collapse navbar-collapse wp-header-menu-container" id="wp-header-menu"><?php wp_nav_menu( $wp_header_menu ); ?></div>
			<input type="checkbox" class="checkbox" id="toggleBtn" />
			<div class="navbar_customer-account" style="display:none"><a class="wp-block-navigation-item__content" href="<?=get_home_url()?>"><span class="wp-block-navigation-item__label">My Account</span></a></div>
			<div class="navbar_mini-cart" style="display:none"><?=do_blocks('<!-- wp:woocommerce/mini-cart {"addToCartBehaviour":"open_drawer","hasHiddenPrice":false,"priceColor":{},"iconColor":{"name":"White","slug":"white","color":"#ffffff","class":"has-white-product-count-color"},"productCountColor":{"name":"White","slug":"white","color":"#ffffff","class":"has-white-product-count-color"},"className":"top-minicart-ico"} /-->')?></div>
			<div class="navbar_wishlist" style="display:none"><!-- wp:shortcode -->[yith_wcwl_wishlist_url]<!-- /wp:shortcode --></div>
			<div class="navbar_language-bar" style="display:none"><ul id="lang-sw"><?php if ( function_exists('pll_the_languages') ) { pll_the_languages( array( 'show_flags' => 1,'show_names' => 0 ) ); } ?></ul></div>
			<div class="navbar_search-bar" style="display:none"><?=do_blocks('<!-- wp:search {"label":"Search","width":24,"widthUnit":"px","buttonText":"Search","buttonPosition":"button-only","buttonUseIcon":true,"isSearchFieldHidden":true} /-->')?></div>
			<div class="navbar_light-dark" style="display:none"><i class="fas fa-moon"></i><i class="fas fa-sun"></i><div class="ball"></div></div>
		</div>
	</nav>
	<div class="header-nav-overlay" style="display:none"></div>
<?php } else { ?>
	<div>* Please choose navigation menu!</div>
<?php } ?>
