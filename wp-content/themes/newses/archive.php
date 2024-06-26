<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @package Newses
 */
get_header(); ?>
<!--==================== Newses breadcrumb section ====================-->
<?php get_template_part('index','banner'); ?>
<!--container-->
<div id="content" class="container archive-class">
    <!--row-->
    <div class="row">
        <?php 
        $newses_content_layout = esc_attr(get_theme_mod('newses_content_layout','align-content-right'));
        if($newses_content_layout == "align-content-left"|| $newses_content_layout == "grid-left-sidebar") { ?>
            <aside class="col-md-4">
                <?php get_sidebar();?>
            </aside>
        <?php } if($newses_content_layout == "align-content-right" || $newses_content_layout == "align-content-left"){ ?>
            <div class="col-md-8">
                <?php get_template_part('content',''); ?>
            </div>
        <?php } elseif($newses_content_layout == "full-width-content") { ?>
            <div class="col-md-12">
                <?php get_template_part('content',''); ?>
            </div>
        <?php } if($newses_content_layout == "grid-left-sidebar" || $newses_content_layout == "grid-right-sidebar"){ ?>
            <div class="col-md-8">
                <?php get_template_part('content','grid'); ?>
            </div>
        <?php } elseif($newses_content_layout == "grid-fullwidth") { ?>
            <div class="col-md-12">
                <?php get_template_part('content','grid'); ?>
            </div>
        <?php } ?>
        <?php if($newses_content_layout == "align-content-right" || $newses_content_layout == "grid-right-sidebar")  { ?>
        <!--col-md-4-->
            <aside class="col-md-4">
                <?php get_sidebar();?>
            </aside>
        <!--/col-md-4-->
        <?php } ?>
    </div>
    <!--/row-->
</div>
<!--/container-->
<?php
get_footer();