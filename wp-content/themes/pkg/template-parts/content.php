<?php
/**
 * Template part for displaying posts
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 * @package pkg
 */
    $post = get_post(get_the_ID());
    $user = get_user_by('id', $post->post_author);
    $ee = get_post_meta( $post->ID );

    $args = array(
        'no_found_rows' => true,
        'orderby'       => '',
        'order'         => 'DESC',
        'post_id'       => $post->ID,
        'status'        => 'all',
        'count'         => false
    );
    $words = explode('/', $_SERVER['REQUEST_URI']);
    $return = $words[1];
    $fields = CFS()->get( 'block' );
?>
<section id="post" class="mt-5 bg-white">
    <nav class="bg-primary jumbotron m-0 pt-5">
        <div class="container px-3 pb-3">
            <ol class="breadcrumb rounded-0 mb-0">
                <li class="breadcrumb-item"><a href="/" class="text-white">Главная</a></li>
                <?php if($return === 'organizer') : ?>
                    <li class="breadcrumb-item"><a href="/organizers">Организаторы</a></li>
                <?php elseif($return === 'slider') : ?>
                    <li class="breadcrumb-item"><a href="/blog">Блог</a></li>
                <?php else : ?>
                    <li class="breadcrumb-item"><a href="/store">Магазин</a></li>
                <?php endif; ?>
                <li class="breadcrumb-item text-muted" aria-current="page">
                    <?=$post->post_title;?>
                </li>
            </ol>              
        </div>
    </nav>  

    <div class="container pt-5">
        <div class="row py-5">
            <div class="col-md-4 col-12">
                <div class="me-5 <?=$return === 'book' ? 'book' : '';?>">
                    <img 
                        src="<?=get_the_post_thumbnail_url( $post->ID, 'full' );?>" 
                        class="w-100 shadow"
                        alt="<?=$post->post_title;?>" 
                    />
                </div>
            </div>
            <div class="col-md-8 col-12">
                <div class="d-flex flex-column justify-content-center h-100">
                    <?php if($return === 'organizer') : else : ?>
                    <p>
                        <a href="/author/<?=$user->user_nicename;?>" class="text-info">
                            <?=$user->display_name;?>
                        </a>
                    </p>
                    <?php endif; ?>
                    <h3><?=$post->post_title;?></h3>
                    <?php if($return === 'organizer') : ?>
                        <p class="mt-4"><?=$post->post_content;?></p>
                        <p class="info">
                            <strong>Позвонить:</strong>
                            <a href="tel:<?=$ee["ecwd_organizer_meta_phone"][0];?>">
                                <?=$ee["ecwd_organizer_meta_phone"][0];?>
                            </a>
                        </p>
                        <p class="info">
                            <strong>Написать:</strong>
                            <a href="mailto:<?=$ee["ecwd_organizer_meta_website"][0];?>">
                                <?=$ee["ecwd_organizer_meta_website"][0];?>
                            </a>
                        </p>
                    <?php else : ?>
                    <div class="d-flex align-items-center gap-4 mb-3">
                        <p class="m-0">
                            <strong class="fs-3">
                                <?php //=number_format(strip_tags($post->post_excerpt));?>
                                {{priceFormat(summa*count)}}
                            </strong> <strong class="fs-4">₽</strong> 
                        </p>
                        <div id="except" class="d-none"><?=$post->post_excerpt;?></div>
                        <div class="d-flex">
                            <button class="btn">
                                <span class="material-symbols-outlined text-muted" @click="count++">add</span>
                            </button>
                            <button class="btn fs-4 mb-1">{{count}}</button>
                            <button class="btn" :disabled="count === 1">
                                <span class="material-symbols-outlined text-muted" @click="count--">remove</span>
                            </button>
                        </div>
                    </div>
                    <div>
                        <button 
                            class="d-flex align-items-center gap-2 btn btn-info text-white btn-lg px-5" 
                            @click="addToCart(
                                'Книга', 
                                '<?=$user->display_name;?>', 
                                '<?=$post->post_title;?>', 
                                '<?=get_the_post_thumbnail_url( $post->ID, 'full' );?>'
                            )"
                        >
                            <span class="material-symbols-outlined">shopping_cart</span>
                            <span>В корзину</span>
                        </button>                         
                    </div>

                </div>
                <?php endif; ?>
                <pre><?php // var_dump($ee);?></pre>
                <pre><?php // var_dump($post);?></pre>
            </div>
        </div>
    </div>

</section>

<?php if($return === 'organizer') : else : ?>
<section class="bg-white">
    <div class="container">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button 
                    class="nav-link active" 
                    id="profile-tab" 
                    data-bs-toggle="tab" 
                    data-bs-target="#profile" 
                    role="tab" 
                    aria-controls="profile" 
                    aria-selected="false"
                >
                    Описание
                </button>
            </li>            
            <li class="nav-item" role="presentation">
                <button 
                    class="nav-link" 
                    id="home-tab" 
                    data-bs-toggle="tab" 
                    data-bs-target="#home" 
                    role="tab" 
                    aria-controls="home" 
                    aria-selected="true"
                >
                    <?=$post->comment_count > 0 ? 'Отзывы ( '.$post->comment_count.' )' : 'Нет отзывов';?>
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button 
                    class="nav-link" 
                    id="contact-tab" 
                    data-bs-toggle="tab" 
                    data-bs-target="#contact" 
                    role="tab" 
                    aria-controls="contact" 
                    aria-selected="false"
                >
                    Характеристики
                </button>
            </li>
        </ul>    
    </div>    
</section>
<?php endif; ?>


<div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
        <div class="container py-5">
            <p><small class="text-muted"><?=$post->post_content;?></small></p>
        </div>
    </div>    
    <div class="tab-pane fade" id="home" role="tabpanel" aria-labelledby="home-tab">
        <?php if( $comments = get_comments( $args ) ) { ?>
        <section class="py-5">
            <div class="container">
                <div class="row">
                    <?php foreach( $comments as $comment ) { 
                        $user = get_user_by('email', $comment->comment_author_email); 
                        $rbac = get_userdata( $user->ID );
                        $roles = $rbac->roles;
                    ?>
                    <div class="col-12">
                        <div class="d-flex border py-2 px-4 mb-3">
                            <div class="pe-2">
                                <img 
                                    src="<?=get_user_meta($user->ID)["userimg"][0];?>" 
                                    alt="<?=$comment->comment_author;?>" 
                                    class="rounded-circle mt-2"
                                    style="width:80px"
                                />
                            </div>
                            <div class="p-2 flex-grow-1">
                                <h5 class="fw-bold mb-1 text-dark"><?=$comment->comment_author;?></h5>
                                <div class="d-flex align-items-center gap-2 text-muted mb-3">
                                    <span class="material-symbols-outlined" style="font-size: 19px">calendar_month</span> 
                                    <?=$comment->comment_date;?>
                                </div>                            
                                <p hidden><?=$comment->comment_author_email;?></p>
                                <p class="text-dark"><?=$comment->comment_content;?></p>

                                <div class="d-flex flex-row-reverse gap-3">
                                    <?php edit_comment_link( __( 'Редактировать' ), ' ' ); ?>
                                    <a href="?replytocom=<?=$comment->comment_ID;?>#respond">Ответить</a>                                
                                </div>
                            </div>
                        </div>                    
                    </div>
                    <?php } ?>
                </div>
                <?php if ( comments_open() || get_comments_number() ) : ?>
                    <div class="row">
                        <div class="col-md-12 mb-5">
                            <div class="card text-dark">
                                <div class="col-md-8 offset-md-2 py-4 info">
                                    <?php comments_template(); ?>
                                </div>
                            </div>
                        </div>               
                    </div> 
                <?php endif; ?>
            </div>
        </section> 
        <?php } else { ?> 
            <div class="container">
                <?php if ( comments_open() || get_comments_number() ) : ?>
                    <div class="row">
                        <div class="col-md-12 my-5 text-dark">
                            <p>На данный момент никто не прокомментировал данный материал.</p>
                            <button class="btn btn-warning px-5" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOpen" aria-expanded="false" aria-controls="collapseExample">
                                Написать комментарий
                            </button>
                            <div class="collapse" id="collapseOpen">
                                <div class="card text-dark mt-4">
                                    <div class="col-md-8 offset-md-2 py-4 info">
                                        <?php comments_template(); ?>
                                    </div>
                                </div>                            
                            </div>

                        </div>               
                    </div> 
                <?php endif; ?>
            </div>
        <?php } ?>      
    </div>
    <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
        <div class="container py-5 column">
            <ul class="list-group list-group-flush">
            <?php foreach ( $fields as $key => $field ) { ?>
                <li class="list-group-item text-dark d-flex justify-content-between align-items-start">
                    <strong><?=array_key_first($field['options']);?>:</strong>
                    <span>&#160;<?=$field['name'];?></span>
                </li>               
            <?php } ?>                
            </ul>

        </div>
    </div>
</div>
  
<?php /*
    <?php if ( comments_open() || get_comments_number() ) : ?>
    <section class="bg-white">
        <div class="container py-5">
            <div class="row">
                <div class="col-md-12 mb-5">
                    <div class="card bg-white">
                        <div class="col-md-8 offset-md-2 py-4 info">
                            <?php comments_template(); ?>
                        </div>
                    </div>
                </div>               
            </div>         
        </div>
    </section>
    <?php //comment_form(); ?>

    <?php endif; ?>
*/ ?>
<pre><?php //var_dump($post);?></pre>


<hr />