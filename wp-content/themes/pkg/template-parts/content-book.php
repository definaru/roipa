<?php
/**
 * Template part for displaying posts
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 * @package pkg
 */
?>
<div style="display:none;">
    <?php $post = get_post(the_ID());?>
</div>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <nav class="jumbotron m-0 p-0 rounded-0">
        <ol class="breadcrumb rounded-0 mb-0 ml-lg-4 ml-sm-0">
            <li class="breadcrumb-item"><a href="/">Главная</a></li>
            <?php
                $categories = get_the_category();
                foreach($categories as $category){
                   $cat_link = get_category_link($category->cat_ID);
                   echo '<a class="breadcrumb-item" href="'.$cat_link.'">'.$category->name.'</a>';
                }
            ?>            
            <li class="breadcrumb-item active" aria-current="page"><?=$post->post_title;?></li>
        </ol>          
    </nav>

    
	<header class="entry-header rounded-0 mb-0">
        
		<?php
		if ( is_singular() ) :
			the_title( '<h3 class="text-center">', '</h3>' );
		else :
			the_title( '<h4 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h4>' );
		endif;

		if ( 'post' === get_post_type() ) :
			?>
			<div class="entry-meta">
				<?php
				// pkg_posted_on();
				// pkg_posted_by();
				?>
			</div>
		<?php endif; ?>
	<?php 
            pkg_post_thumbnail();
            echo $post->post_content; 
            edit_post_link('<i class="ionicons ion-android-create"></i>', '', '', $post->ID, 'btn btn-outline-secondary pull-right');
        ?>            
	</header>


	<div class="entry-content">
            <?php
                wp_link_pages( array(
                    'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'pkg' ),
                    'after'  => '</div>',
                ) );
            ?>
	</div>
</article>