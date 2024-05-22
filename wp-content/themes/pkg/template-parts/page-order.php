<?php
    /**
    * Template name: Order
    */
    get_header();
    $page = get_post(get_the_ID());
?>
<section class="bg-white">
    <div id="order" class="container py-5">
        <div class="row pt-5">
            <div class="col-12 text-center pt-5 intro">
                <h2 class="fw-bold" v-html="agree ? title : '<?=$page->post_title;?>'"></h2>
            </div>
        </div>
        <div class="row py-5" v-if="!agree">
            <div class="col-md-12 order">
                <pre><?=$page->post_content;?></pre>
            </div>
            <div class="col-md-12">
                <div class="d-flex gap-2 justify-content-end">
                    <a href="/" class="btn btn-sm btn-outline-dark px-4">Я не принимаю</a>
                    <buttom class="btn btn-sm btn-success px-4" v-on:click="Okey">Я принимаю</buttom>                
                </div>
            </div>
        </div>
        <div class="row py-5" v-else>
            <div class="col-md-10 offset-md-1">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card shadow border-0 rounded-top">
                            <div class="card-header bg-white text-center pt-3 border-0">
                                <h3 class="fw-bold">Обычное Членство</h3>
                            </div>
                            <div class="card-body bg-white">
                                <ul class="ps-4 py-4">
                                    <li>- Участие в мероприятиях</li>
                                    <li class="text-muted">- <s>Возможность разместить статью</s></li>
                                    <li class="text-muted">- <s>Выступать на конференции</s></li>
                                    <li class="text-muted">- <s>Личная встреча с президентом РОИПА</s></li>
                                </ul>
                            </div>
                            <div class="card-footer text-center border-0 py-4">
                                <strong>0 <sup class="text-muted">.00</sup> ₽</strong>
                            </div>
                            <div class="card-footer bg-white d-grid border-0">
                                <a href="/login" class="btn btn-info btn-block btn-lg btn-info text-white">
                                    Выбрать
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card shadow border-0 rounded-top">
                            <div class="card-header bg-white text-center pt-3 border-0">
                                <h3 class="fw-bold text-info">V.I.P. Членство</h3>
                            </div>
                            <div class="card-body bg-white">
                                <ul class="ps-4 py-4">
                                    <li>- Участие в мероприятиях</li>
                                    <li>- Возможность разместить статью</li>
                                    <li>- Выступать на конференции</li>
                                    <li>- Личная встреча с президентом РОИПА</li>
                                </ul>
                            </div>
                            <div class="card-footer text-center border-0 py-4">
                                <strong>1,000 <sup class="text-muted">.00</sup> ₽</strong>
                            </div>
                            <div class="card-footer bg-white d-grid border-0">
                                <a href="/login" class="btn btn-info btn-block btn-lg btn-info text-white">
                                    Выбрать
                                </a>
                            </div>
                        </div>
                    </div>                    
                </div>
            </div>
        </div>
    </div>
</section>
<hr />
<?php get_footer();?>