<?php
function ela_widgets_init() {
	register_sidebar( array(
		'name'          => esc_attr__( 'Default sidebar', 'ela' ),
		'id'            => 'sidebar-1',
		'description'   => esc_attr__( 'This is the default sidebar in your blog, add widgets here and it will appear on all pages have this sidebar.', 'ela' ),
		'before_widget' => '<div id="%1$s" class="widget_container widget_content widget %2$s clearfix">',
		'after_widget'  => "</div>",
		'before_title'  => '<h4 class="widget_title title"><span class="page_header_title">',
		'after_title'   => '</span></h4>',
	) );

	register_sidebar( array(
		'name'          => esc_attr__( 'Intro Sidebar', 'ela' ),
		'id'            => 'sidebar-intro',
		'description'   => esc_attr__( 'This is intro sidebar, all content in this sidebar will appear in your homepage before blog posts.', 'ela' ),
		'before_widget' => '<div id="%1$s" class="widget_container widget_content intro_widget_content widget %2$s clearfix">',
		'after_widget'  => "</div>",
		'before_title'  => '<h4 class="widget_title title"><span class="page_header_title">',
		'after_title'   => '</span></h4>',
	) );

	register_sidebar( array(
		'name'          => esc_attr__( 'Sliding Sidebar', 'ela' ),
		'id'            => 'sidebar-sliding',
		'description'   => esc_attr__( 'This is the sliding sidebar, all the contents in this sidebar will appear in the sliding section activated by the triple bar hamburger icon in the main menu.', 'ela' ),
		'before_widget' => '<div id="%1$s" class="widget_container widget_content widget %2$s clearfix">',
		'after_widget'  => "</div>",
		'before_title'  => '<h4 class="widget_title title"><span class="page_header_title">',
		'after_title'   => '</span></h4>',
	) );

	register_sidebar( array(
		'name'          => esc_attr__( 'Footer Sidebar 1', 'ela' ),
		'id'            => 'footer-1',
		'before_widget' => '<div id="%1$s" class="widget_container widget_content widget %2$s clearfix">',
		'after_widget'  => "</div>",
		'before_title'  => '<h4 class="widget_title title"><span class="page_header_title">',
		'after_title'   => '</span></h4>',
	) );

	register_sidebar( array(
		'name'          => esc_attr__( 'Footer Sidebar 2', 'ela' ),
		'id'            => 'footer-2',
		'before_widget' => '<div id="%1$s" class="widget_container widget_content widget %2$s clearfix">',
		'after_widget'  => "</div>",
		'before_title'  => '<h4 class="widget_title title"><span class="page_header_title">',
		'after_title'   => '</span></h4>',
	) );

	register_sidebar( array(
		'name'          => esc_attr__( 'Footer Sidebar 3', 'ela' ),
		'id'            => 'footer-3',
		'before_widget' => '<div id="%1$s" class="widget_container widget_content widget %2$s clearfix">',
		'after_widget'  => "</div>",
		'before_title'  => '<h4 class="widget_title title"><span class="page_header_title">',
		'after_title'   => '</span></h4>',
	) );

}

add_action( 'widgets_init', 'ela_widgets_init' );