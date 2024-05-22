<?php
    /* 
     * Template Name: Корзина
     */
    get_header();
    $dir = get_template_directory_uri();
    $current_user = wp_get_current_user();
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
        </div>
        <div class="row">
            
            <div class="col-12" v-if="card.length > 0">
                <template v-if="!loading">
                    <p class="mg-b-0 text-muted mb-3">
                        Всего {{card.length+' '+countGoods(card.length, 'товар', 'товара', 'товаров')}}
                    </p>
                    <ul>
                        <li class="card mb-2" v-for="(item, id) in card">
                            <div class="row d-flex justify-content-between">
                                <div class="col-md-1 m-2">
                                    <img 
                                        :src="item.image" 
                                        :alt="item.name" 
                                        class="mr-3 cp" 
                                        v-on:click="getStartLink(item.link)" 
                                        style="width: 60px" 
                                    />
                                </div>
                                <div class="col-md-6 p-2 d-flex align-items-center">
                                    <div 
										 class="d-flex flex-column justify-content-start cp" 
										 v-on:click="getStartLink(item.link)"
									>
                                        <span>{{ item.author }}</span>
                                        <small data-bs-toggle="tooltip" :title="item.name" class="fw-bold">
											"{{ item.name }}"
										</small>
                                        <u class="text-muted">{{ item.type }}</u>                                
                                    </div>
                                </div>
                                <div class="col-md-2 p-2 d-flex align-items-center">
                                    {{ priceFormat(item.price) }} ₽
                                </div>
								<div class="col-md-1 me-4 d-flex align-items-center">
									<div class="btn-group">
										<button v-on:click="inCrement(item.id)" class="btn material-symbols-outlined">
											add
										</button>
										<button type="button" class="btn">{{item.count}}</button>
										<button class="btn material-symbols-outlined" v-if="item.count == 1">remove</button>
										<button class="btn material-symbols-outlined" v-on:click="deCrement(item.id)" v-else>
											remove
										</button>
									</div>									
								</div>
                                <div class="col-md-1 p-3 me-5 d-flex align-items-center flex-row-reverse">
                                    <span class="material-symbols-outlined text-danger cp" v-on:click="removeCart(id)">
										delete
									</span>
                                </div>
                            </div>
                        </li>
                    </ul>
                    <div class="d-flex justify-content-between mb-5 pb-5">
                        <div></div>
                        <div class="d-flex gap-4 align-items-center">
                            <div style="font-size: 25px">
                                <strong class="fw-bold">Итого:</strong> 
                                <span class="font-weight-light">{{priceFormat(totalSum)}} ₽</span> 
								<small class="text-muted">({{amount}} шт.)</small>
                            </div>                             
                            <button class="btn btn-success btn-lg px-5">Оплатить</button>
                        </div>
                    </div>
					{{totalAmount}}
                    {{totalSumma}}
                </template>
                <template v-else>
                    <div class="card mb-2" v-for="n in 3">
                        <div class="row d-flex justify-content-between" style="opacity: 0.2">
                            <div class="col-md-1 m-2">
                                <div class="bg-dark rounded py-5 h-100"></div>
                            </div> 
                            <div class="col-md-7 p-2 d-flex align-items-center">
                                <div class="d-flex flex-column justify-content-start cp w-75">
                                    <span class="bg-dark rounded mb-1 w-75 p-2"></span> 
                                    <small class="bg-dark rounded mb-1 w-100 p-0">...</small> 
                                    <u class="bg-dark rounded w-25 p-2"></u>
                                </div>
                            </div> 
                            <div class="col-md-2 p-2 d-flex align-items-center">
                                <span class="bg-dark p-2 w-50 rounded opacity-25"></span>
                            </div> 
                            <div class="col-md-1 p-3 me-3 d-flex align-items-center flex-row-reverse">
                                <span class="material-symbols-outlined bg-dark rounded">delete</span>
                            </div>
                        </div>
                    </div>
                </template>
            </div>
            <div class="col-12" v-else>
                <div class="p-5 my-4 bg-light rounded-3">
                    <div class="container-fluid py-5">
                        <h1 class="display-5 fw-bold">Ваша корзина пустая</h1>
                        <p class="col-md-8 fs-4">Мы не обнаружили в вашей корзине ни одного товара, 
                            чтобы здесь отобразился список ваших покупок, пожалуйста, 
                            нажмите кнопку "Выбрать товар", а затем в самом товаре кликнуть "В корзину".
                        </p>
                        <a href="/store" class="btn btn-info text-white btn-lg" type="button">Выбрать товар</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>