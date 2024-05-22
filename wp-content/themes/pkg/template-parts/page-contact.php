<?php
    /* 
     * Template Name: Контакты
     */
    get_header();
    $dir = get_template_directory_uri();
    $current_user = wp_get_current_user();
    $page = get_post(get_the_ID());
?>
<section id="post" class="mt-5 bg-white">
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
	<div class="container py-5">
        <div class="row pt-5">
            <div class="col-12 text-center intro">
                <h2 class="fw-bold"><?=$post->post_title;?></h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 my-5 info">
                <?=$post->post_content;?>
                <div id="soc">
                    <a href="https://t.me/roipaAtl" target="_blank" rel="nofollow noreferrer noopener" class="btn btn-primary btn-lg px-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16">
                          <path d="M15.964.686a.5.5 0 0 0-.65-.65L.767 5.855H.766l-.452.18a.5.5 0 0 0-.082.887l.41.26.001.002 4.995 3.178 3.178 4.995.002.002.26.41a.5.5 0 0 0 .886-.083zm-1.833 1.89L6.637 10.07l-.215-.338a.5.5 0 0 0-.154-.154l-.338-.215 7.494-7.494 1.178-.471z"/>
                        </svg>
                        Telegram канал
                    </a>
                    <a href="https://www.youtube.com/@roipa-atlant" target="_blank" rel="nofollow noreferrer noopener" class="btn btn-danger btn-lg px-4">
                        <svg xmlns="http://www.w3.org/2000/svg" width="29" height="29" fill="currentColor" viewBox="0 0 16 16">
                          <path d="M8.051 1.999h.089c.822.003 4.987.033 6.11.335a2.01 2.01 0 0 1 1.415 1.42c.101.38.172.883.22 1.402l.01.104.022.26.008.104c.065.914.073 1.77.074 1.957v.075c-.001.194-.01 1.108-.082 2.06l-.008.105-.009.104c-.05.572-.124 1.14-.235 1.558a2.01 2.01 0 0 1-1.415 1.42c-1.16.312-5.569.334-6.18.335h-.142c-.309 0-1.587-.006-2.927-.052l-.17-.006-.087-.004-.171-.007-.171-.007c-1.11-.049-2.167-.128-2.654-.26a2.01 2.01 0 0 1-1.415-1.419c-.111-.417-.185-.986-.235-1.558L.09 9.82l-.008-.104A31 31 0 0 1 0 7.68v-.123c.002-.215.01-.958.064-1.778l.007-.103.003-.052.008-.104.022-.26.01-.104c.048-.519.119-1.023.22-1.402a2.01 2.01 0 0 1 1.415-1.42c.487-.13 1.544-.21 2.654-.26l.17-.007.172-.006.086-.003.171-.007A100 100 0 0 1 7.858 2zM6.4 5.209v4.818l4.157-2.408z"/>
                        </svg>
                        Youtube канал
                    </a>                    
                </div>

                
                <p><hr /></p>
                <p>Вы можете подпиаться на e-mail рассылку интересной информации об Атлантиде и деятельности РОИПА:</p>
                
                <div class="col-md-4">
                    <div id="notification" data-bs-toggle="modal" data-bs-target="#myModal" class="d-flex justify-content-center align-items-center cp gap-2 btn btn-lg btn-warning">
                        <span class="material-symbols-outlined">notification_add</span>
                        <span>Подписаться</span> 
                    </div>                    
                </div>
            </div>
        </div>
	</div>
    </div>
</section>
<?php /*
<iframe src="https://yandex.ru/map-widget/v1/?um=constructor%3A19d2c4b94eb506bcf27d32f5eb1925f48435e706816c3dbadd855a67b4c9a831&amp;source=constructor" width="100%" height="400" frameborder="0"></iframe>
*/ ?>
<?php get_footer(); ?>