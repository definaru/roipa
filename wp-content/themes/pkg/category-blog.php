<?php 
    /*
    Template Name: Category Blog
    Template Post Type: post
    */
    get_header();
    $formatter = new IntlDateFormatter(
        'ru_RU', 
        IntlDateFormatter::LONG, 
        IntlDateFormatter::NONE, 
        'Europe/Moscow'
    );
    $page = get_post(get_the_ID());
    $args = array(
        'no_found_rows' => true,
        'orderby'       => '',
        'order'         => 'DESC',
        'post_id'       => $page->ID,
        'status'        => 'all',
        'count'         => false
    );
    $author = get_user_meta($page->post_author);
    registerCssStyle('
        figure img {
            width: 100%;
            margin-bottom: 10px
        }
        figure {
            text-align: center;
            color: #6e6a6a;
        }
    ');
    $tags = get_the_tags($page->ID);
?>
<section id="blog" class="mt-5 bg-white">
    <nav class="bg-primary jumbotron m-0 pt-5">
        <div class="container px-3 pb-3">
            <ol class="breadcrumb rounded-0 mb-0">
                <li class="breadcrumb-item"><a href="/" class="text-white">Главная</a></li>
                <li class="breadcrumb-item"><a href="/blog">Блог</a></li>
                <li class="breadcrumb-item text-muted" aria-current="page">
                    <?=$post->post_title;?>
                </li>
            </ol>              
        </div>
    </nav> 
    
    <div class="container pt-1 pb-5">
        <div class="row pt-5">
            
            <div class="card bg-white col-md-10 offset-md-1 p-0">
                <div class="card-body">
                    <img 
                        src="<?=get_the_post_thumbnail_url($page->ID, 'full')?>" 
                        class="w-100 d-block mb-0 rounded"
                    />  
                    <div class="d-flex align-items-center gap-2 text-muted py-4">
                        <i class="material-symbols-outlined">calendar_month</i> 
                        Опубликовано: 
                        <?=$formatter->format(date_create($page->post_modified));?>
                        <?=date_format(date_create($page->post_modified), " в H:i");?> 
                        <?php edit_post_link('ред.', '', '', $page->ID, '');?>                     
                    </div>
                    <hr class="mb-2" />
                    <h1 class="fw-bold"><?=$page->post_title;?></h1>
                    <hr />
                    <div class="w-100 mt-4 column">
                        <?=$page->post_content;?>
                    </div>
                    <div>
                    <div class="d-block py-3">
                        <hr />
                    </div>
                </div>

                <div class="d-flex flex-column flex-md-row justify-content-center justify-content-md-between gap-md-0 gap-3">
                    <div class="d-flex align-items-center">
                        <div class="pe-2">
                            <img 
                                src="<?=$author["userimg"][0];?>" 
                                style="width: 50px;height: 50px;object-fit: cover"
                                alt="<?=$author["first_name"][0];?>" 
                                class="rounded-circle" 
                            />
                        </div>
                        <div class="p-2 info flex-grow-1">
                            <a href="/author/<?=$author["nickname"][0];?>">
                                <h6 class="m-0">
                                    <u><?=$author["first_name"][0] .' '. $author["last_name"][0];?></u>
                                </h6>
                                <small class="text-muted">Автор статьи</small>
                            </a>
                        </div>
                    </div> 
                    
                    <?php require get_template_directory() . '/inc/share-buttin.php';?>
                    <strong class="d-flex align-items-center gap-2">
                        <i class="material-symbols-outlined">chat</i>
                        <?=sklonen($page->comment_count, 'комментарий', 'комментария', 'комментариев');?>
                    </strong>              
                </div>

                <div>
                    <pre>
                        <?php /*
                            <select onChange="document.location.href=this.options[this.selectedIndex].value;">";
                                <option>Tags</option>
                                <?php foreach( get_tags() as $tag ) { ?>
                                    <option value="<?=get_tag_link($tag->term_id);?>"><?=$tag->name;?></option>
                                <?php } ?>
                            </select>                    
                        */ ?>
                    </pre>
                    <?php foreach( $tags as $tag ) {?>
		                <a href="/tag/<?=$tag->slug;?>" class="badge rounded-pill bg-primary"><?=$tag->name;?></a>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="bg-light">
    <div class="container py-5">
        <div class="d-flex justify-content-center row">
            <div class="col-md-12 info">
                <?php the_post_navigation( array(
                	'next_text' => '<span class="screen-reader-text">Далее →</span><div class="d-block w-100 text-truncate">%title</div>',
                	'prev_text' => '<span class="screen-reader-text">← Назад</span><div class="d-block w-100 text-truncate">%title</div>',
                ) ); ?>
            </div>
        </div>
    </div>
</section>

<?php if( $comments = get_comments( $args ) ) { ?>
<section id="comments" class="bg-white">
    <div class="container py-5">
        <div class="row">
            <div class="col-md-10 offset-md-1">
                <h3 class="fw-bold text-primary mb-3">Комментарии к статье</h3>
                <?php foreach( $comments as $comment ) { 
                    $user = get_user_by('email', $comment->comment_author_email); 
                    $rbac = get_userdata( $user->ID );
                    $roles = $rbac->roles;
                ?>
                    <div class="card border-0">
                        <div class="d-flex py-2 px-4 mb-2">
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
        </div>
    </div>
</section>
<?php } ?>

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
<?php endif; ?>
<hr />

<?php get_footer();?>