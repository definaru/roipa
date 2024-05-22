<?php
    /**
     * Template part for displaying page content in page.php
     */
     // О РОИПА
    $post = get_post(get_the_ID());
?>

<article id="post-<?php the_ID(); ?>" class="mt-5">
    <nav class="bg-primary jumbotron m-0 pt-5">
        <div class="container px-3 pb-3">
            <ol class="breadcrumb rounded-0 mb-0">
                <li class="breadcrumb-item"><a href="/">Главная</a></li>
                <li class="breadcrumb-item text-muted" aria-current="page">
                    <?=$post->post_title;?>
                </li>
            </ol>              
        </div>
    </nav>
    <header class="jumbotron rounded-0 text-center mb-0">
        <div class="container py-5">
            <div class="row pt-5">
                <div class="col-12 text-center intro">
                    <?php the_title( '<h2 class="fw-bold">', '</h2>' )?>
                </div>
            </div>       
        </div>
    </header>

    <?php // =get_the_post_thumbnail( null, 'img-fluid', $attr );?>

    <div class="container bg-white mb-5 pb-5 info">
        
            <?php
            
            the_content();

            wp_link_pages( array(
                    'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'pkg' ),
                    'after'  => '</div>',
            ) );
            //edit_post_link('<i class="ionicons ion-android-create"></i>', '', '', $post->ID, 'btn btn-outline-secondary');
            ?>
            <?php edit_post_link(
                '<span class="material-symbols-outlined">edit_note</span>', 
                '', '', 
                $post->ID, 
                'btn btn-outline-secondary'
            );?> 
    </div>        
</article>
<hr/>