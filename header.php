<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WP_Bootstrap_Starter
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.4.0/dist/leaflet.css"
          integrity="sha512-puBpdR0798OZvTTbP4A8Ix/l+A4dHDD0DGqYW6RQ+9jxkRFclaxxQb/SJAWZfWAkuyeQUytO7+7N4QKrDh+drA=="
          crossorigin=""/>
    <link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri()?>/inc/assets/css/slick.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri()?>/inc/assets/css/slick-theme.css"/>

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'wp-bootstrap-starter' ); ?></a>
    <?php if(!is_page_template( 'blank-page.php' ) && !is_page_template( 'blank-page-with-container.php' )): ?>
	<header id="masthead" class="site-header fixed-top <?php echo wp_bootstrap_starter_bg_class(); ?>" role="banner">
       <div class="row">
           <div class="col-md-3">
            <div class="navbar-brand">
                <?php if ( get_theme_mod( 'wp_bootstrap_starter_logo' ) ): ?>
                    <a href="<?php echo esc_url( home_url( '/' )); ?>">
                        <img src="<?php echo esc_attr(get_theme_mod( 'wp_bootstrap_starter_logo' )); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" style="height:100px; width: auto;">
                    </a>
                <?php else : ?>
                    <a class="site-title" href="<?php echo esc_url( home_url( '/' )); ?>"><?php esc_url(bloginfo('name')); ?></a>
                <?php endif; ?>

            </div>
           </div>
           <div class="col-md-6 text-center">
            <div class="container" style="line-height: 100px;">
                <nav class="navbar navbar-expand-xl p-0">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-nav" aria-controls="" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <?php
                    wp_nav_menu(array(
                    'theme_location'    => 'primary',
                    'container'       => 'div',
                    'container_id'    => 'main-nav',
                    'container_class' => 'collapse navbar-collapse justify-content-center',
                    'menu_id'         => false,
                    'menu_class'      => 'navbar-nav',
                    'depth'           => 3,
                    'fallback_cb'     => 'wp_bootstrap_navwalker::fallback',
                    'walker'          => new wp_bootstrap_navwalker()
                    ));
                    ?>

                </nav>
            </div>
           </div>
           <div class="col-md-3 text-right right-btn" style="color: white; line-height: 100px; font-size: 1.5rem;">
               <div class="row">
                   <div class="col-md-3">
                       <a href="tel:0558917434"><i class="fas fa-phone" data-toggle="tooltip" data-placement="top" title="05 58 91 74 34"></i></a>
                   </div>
                   <div class="col-md-3">
                       <a style="cursor: pointer"  data-toggle="tooltip" data-placement="top" title="Nous trouver" >
                           <i class="fas fa-map-marker-alt" data-toggle="modal" data-target="#map"></i>
                       </a>
                   </div>
                   <div class="col-md-6">
                       <div class="container">
                        <button type="button" class="btn" style="background-color: #6b9809; color: white;">Demander un devis</button>
                       </div>
                   </div>
               </div>
           </div>
       </div>
        <!-- Modal -->
        <div class="modal fade" id="map" tabindex="-1" role="dialog" aria-labelledby="map" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Nous trouver</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div id="mapid"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                    </div>
                </div>
            </div>
        </div>
	</header><!-- #masthead -->
    <?php if(is_front_page() && !get_theme_mod( 'header_banner_visibility' )): ?>
        <div id="page-sub-header" <?php if(has_header_image()) { ?>style="background-image: url('<?php header_image(); ?>');" <?php } ?>>
                <div class="slider" style="position: relative;">
                <?php


                $args = array(
                    'post_type' => 'realisation',
                    'posts_per_page' => -1,
                    'meta_query' => array(
                        array(
                            'key' => 'mise_en_avant',
                            'value' => '1',
                            'compare' => '=='
                        )
                    )
                );
                $loop = new WP_Query( $args );
                while ( $loop->have_posts() ) : $loop->the_post();
                    $bg = get_field("preview");
                    echo '<div class="entry-content" style="background: url('.$bg.'); background-position: center; background-size:cover; margin: 0;">';?>
                        <div style="position:relative; height: 100%;">
                            <div style="position: absolute; background: rgba(79, 113, 9, .75); color: white; bottom: 15px; width: 30%; padding: 2rem;">
                                <?php the_title();?>
                            </div>
                        </div>
                 <?php
                    echo '</div>';
                endwhile;

                ?>
                </div>
            <a href="#content" class="page-scroller"><i class="fa fa-fw fa-angle-down"></i></a>

        </div>
    <?php endif; ?>
	<div id="content" class="site-content">
		<div class="container">
			<div class="row">
                <?php endif; ?>