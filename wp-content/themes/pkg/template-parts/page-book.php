<?php
    /**
    * Template name: Book
    */
    get_header();
    //$id = get_post(get_the_ID());
    $link = array_reverse(explode('/', $_SERVER['REQUEST_URI']))[0];

    global $post;

    $posts = get_posts( [
        'posts_per_page' => 6,
        'category_name' => 'book',
        'orderby'     => 'date',
        'order'       => 'DESC',        
        'post_type' => 'post',
    ] );
?>
<section class="bg-white">
    <div class="container py-5">
        <div class="row pt-5">
            <h2><?=$link === 'book' ? 'No link'  : $link?></h2>

        </div>
        <?php 
            foreach( $posts as $post ) { 
                //setup_postdata( $post ); 
                $user = get_user_by('id', $post->post_author);
                
        ?>
                <div class="article-elem">
                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    <p><?=get_the_post_thumbnail_url( $post->ID, 'full' );?></p>
                    <p><?=$post->post_author?></p>
                    <b><?=$post->post_excerpt?></b>
                    <?=$user->user_nicename;?>
                    <?=$user->display_name;?>
                    <pre><?php // var_dump($post);?></pre>
                </div>
        <?php } //wp_reset_postdata(); ?>

        <pre><?php //var_dump($query);?></pre>
    </div>
</section>
<hr />
<?php get_footer();?>