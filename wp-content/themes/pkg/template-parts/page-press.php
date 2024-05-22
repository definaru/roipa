<?php
    /**
    * Template name: Пресса о нас
    */
    get_header();

    $page = get_post(get_the_ID());
?>
<section class="bg-white mt-5" id="post-<?php the_ID(); ?>">
    <nav class="bg-primary jumbotron m-0 pt-5">
        <div class="container px-3 pb-3">
            <ol class="breadcrumb rounded-0 mb-0">
                <li class="breadcrumb-item"><a href="/">Главная</a></li>
                <li class="breadcrumb-item text-muted" aria-current="page"><?=$page->post_title;?></li>
            </ol>              
        </div>
    </nav>
    <div class="container py-5">
        <div class="row pt-5">
            <div class="col-12 text-center intro">
                <h2 class="fw-bold"><?=$page->post_title;?></h2>
            </div>
            <div class="col-12 text-center mt-4 text-secondary">
                <?=$page->post_content;?>
            </div>
        </div>
        <div class="row mt-3 mb-5">
            
            <div class="col-md-4 info">
                <a href="https://svpressa.ru/post/article/169114/" target="_blank" class="card shadow-sm border-0">
                    <div class="card-header text-center border-0 bg-white p-0" style="overflow: hidden;height: 325px">
                        <img 
                            src="/wp-content/uploads/2022/11/461.jpg"
                            class="shadow w-100" 
                            alt="Свободная Пресса" 
                        />
                    </div>
                    <div class="card-body text-center px-1 py-2" style="height: 150px">
                        <p>Интервью президента РОИПА Георгия Нефедьева порталу "Свободная Пресса"</p>
                    </div>
                </a>
            </div>
            
            <div class="col-md-4 info">
                <a href="/wp-content/uploads/2022/11/17.pdf" target="_blank" class="card shadow-sm border-0">
                    <div class="card-header text-center border-0 bg-white p-0" style="overflow: hidden;height: 325px">
                        <img 
                            src="/wp-content/uploads/2022/11/460.png"
                            class="shadow w-100" 
                            alt="Калининградская правда. № 101 (18713)" 
                        />
                    </div>
                    <div class="card-body text-center px-1 py-2" style="height: 150px">
                        <p>
							Статья президента РОИПА Георгия Нефедьева, посвященная памяти 
							Андрея Склярова (Калининградская правда. № 101 (18713). 2017).
						</p>
                    </div>
                </a>
            </div>
            
            <div class="col-md-4 info">
                <a href="/wp-content/uploads/2022/11/1.pdf" target="_blank" class="card shadow-sm border-0">
                    <div class="card-header text-center border-0 bg-white p-0" style="overflow: hidden;height: 325px">
                        <img 
                            src="/wp-content/uploads/2022/11/462.jpg"
                            class="shadow w-100" 
                            alt="Калининградская правда. № 101 (18713)" 
                        />
                    </div>
                    <div class="card-body text-center px-1 py-2" style="height: 150px">
                        <p>
							В рубрике "ПОИСКИ, НАХОДКИ, РАЗМЫШЛЕНИЯ, ИЗОБРЕТЕНИЯ", газеты «Калининградская правда» ( г.Королёв ), 
							от 25 сентября 2014 г. опубликованоинтервью президента РОИПА Георгия Нефедьева
						</p>
                    </div>
                </a>
            </div>

        </div>
    </div>
</section>
<hr />
<?php get_footer();?>