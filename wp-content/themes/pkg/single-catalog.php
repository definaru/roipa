<?php
/*
 Template Name: Каталог
 Template Post Type: post
 */
get_header(); 
$list_array = CFS()->get('list_array');
?>
<div style="display:none;">
    <?php $catalog = get_post(the_ID());?>
</div>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <nav class="jumbotron m-0 p-0">
        <ol class="breadcrumb rounded-0 mb-0">
            <li class="breadcrumb-item"><a href="/">Главная</a></li>
            <?php
//                $categories = get_the_category();
//                foreach ($categories as $category) {
//                    $cat_link = get_category_link($category->cat_ID);
//                    echo '<a class="breadcrumb-item" href="' . $cat_link . '">' . $category->name . '</a>';
//                }
            ?>  
            <li class="breadcrumb-item active" aria-current="page"><?=$post->post_title;?></li>
        </ol>          
    </nav>
    <header class="entry-header jumbotron rounded-0 mb-0">
        <div class="row">
            <div class="col-md-12 text-center">
                <?php 
                    the_title( '<h3>', '</h3>' ).edit_post_link('<i class="ionicons ion-android-create"></i>', '', '', $post->ID, 'btn btn-outline-secondary pull-right');
                ?>                
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="card bg-light p-5 rounded-0 border-0">
                <?php if(CFS()->get( 'premier' ) == '') : ?> 
                    <div class="d-block text-center pt-5 pb-5">
                        ( Нет образцов )
                    </div>
                <?php else : ?>                    
                    <div id="imagesfull">
                        <div class="swiper-wrapper">

                            <?php foreach ( CFS()->get( 'premier' ) as $premier ) { ?>
                            <div class="swiper-slide">
                                <a data-fancybox="image" href="<?=$premier['scan'];?>" data-caption="<?=$premier['innot'];?>">
                                    <img class="img-fluid" src="<?=$premier['scan'];?>" alt="<?=$premier['innot'];?>">
                                </a>
                            </div>
                            <?php } ?>
                        </div>
                        <div class="swiper-paginations"></div>
                    </div>
                <?php endif;?>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card bg-white p-5 rounded-0 border-0">
                    <div class="row mb-3">
                        <?php if(CFS()->get( 'srock' ) == '') : else : ?>
                        <div class="col-md-4">
                            <strong class="head-pkg">Срок обучения</strong>
                            <p class="text-muted"><?=CFS()->get( 'srock' );?></p>
                        </div>
                        <?php endif;?>
                        <?php if(CFS()->get( 'price' ) == '') : else : ?>
                        <div class="col-md-4">
                            <strong class="head-pkg">Цена</strong>
                            <p class="text-muted"><?=CFS()->get( 'price' );?></p>
                        </div>
                        <?php endif;?>
                        <?php if(CFS()->get( 'action' ) == '') : else : ?>
                        <div class="col-md-4">
                            <strong class="head-pkg">Срок действия</strong> 
                            <p class="text-muted"><?=CFS()->get( 'action' );?></p>
                        </div>
                        <?php endif;?>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <?=$catalog->post_content;?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <?=($list_array == '') ? '' : '<a class="curse-info__link hex" href="#more">Подробнее</a>';?>
                            <?php if(CFS()->get( 'file' ) == '') : else : ?>
                            <div class="document">
                                <div class="document__title">Необходимые документы</div>
                                <div class="text-muted">Заявка на обучение &nbsp;
                                    <a class="document__link" href="<?=CFS()->get( 'file' );?>" download>(<?=CFS()->get( 'link' );?>)</a>
                                </div>
                            </div>  
                            <?php endif;?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="mt-3 col-sm-6">
                            <button class="btn btn-primary btn-block btn-lg rounded-0" data-toggle="modal" data-target="#addservis">Заказать услугу</button>
                        </div>
                        <div class="mt-3 col-sm-6">
                            <a href="/calculator" class="btn btn-primary btn-block btn-lg rounded-0">Расчет стоимости</a>
                        </div>
                    </div>
                </div>         
            </div>
        </div>
        
        <?php if($list_array == '') : else : ?>
        <div class="row" id="more">
            <div class="col-md-12 text-center pt-5 pb-4 mt-4">
                <h3><?=CFS()->get( 'names' ); // Программы обучения по охране труда?></h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <?php $flag = 1; foreach ($list_array as $field ) { $i = $flag++; ?>
                    <div class="card rounded-0 mb-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-1 xs-center">
                                    <strong><?=$field['abbr'];?></strong>
                                </div>
                                <div class="col-sm-8"<?=(empty($field['addProgram'])) ? '' : ' data-toggle="collapse" data-target="#sin'.$i.'"';?>>
                                    <p class="m-0 xs-center<?=(empty($field['addProgram'])) ? '' : ' opens';?>">
                                        <?=$field['full_name'];?> <?=(empty($field['addProgram'])) ? '' : '<i class="ionicons ion-ios-arrow-back"></i>';?>
                                    </p>
                                </div>
                                <div class="col-sm-1">
                                    <p class="m-0 text-muted xs-center"><?=$field['time'];?></p>
                                </div>
                                <div class="col-sm-2 text-center">
                                    <?php if($field['linkpro'] == '') : ?>
                                    
                                    <?php else : ?>
                                    <a class="learning__link" href="<?=$field['linkpro'];?>" target="_blank">
                                        <img src="/wp-content/themes/pkg/img/pdf.svg" alt="PDF file" class="mr-1 mt-0" style="width: 40px;position: absolute;top: -7px;margin-left: -40px;"> Скачать план
                                    </a>
                                    <?php endif;?>
                                </div>
                            </div>                        
                        </div>
                        
                        
                    <?php if( empty($field['addProgram']) ) : else : ?>
                	<?php foreach ($field['addProgram'] as $dop) { ?>
                        <div id="sin<?=$i;?>" class="collapse">
                            <div class="card rounded-0">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-1 xs-center">
                                            <strong><?=$dop['dop_abbr'];?></strong>
                                        </div>
                                        <div class="col-sm-8">
                                            <p class="m-0 xs-center"><?=$dop['dop_full_name'];?></p>
                                        </div>
                                        <div class="col-sm-1">
                                            <p class="m-0 text-muted xs-center"><?=$dop['dop_time'];?></p>
                                        </div>
                                        <div class="col-sm-2 text-center">
                                            <?php if($dop['dop_linkpro'] == '') : ?>

                                            <?php else : ?>
                                            <a class="learning__link" href="<?=$dop['dop_linkpro'];?>" target="_blank">
                                                <img src="/wp-content/themes/pkg/img/pdf.svg" alt="PDF file" class="mr-1 mt-0" style="width: 40px;position: absolute;top: -7px;margin-left: -40px;"> Скачать план
                                            </a>
                                            <?php endif;?>
                                        </div>
                                    </div>                        
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    <?php endif;?>  
                        
                        
                    </div>
                <?php } ?>
            </div>
        </div>        
        <?php endif; ?>
    </header>


<!--    <div class="jumbotron rounded-0 bg-white">
            <?php
//            wp_link_pages( array(
//                    'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'pkg' ),
//                    'after'  => '</div>',
//            ) );
            ?>
    </div>-->
</article>
<?php get_footer(); // get_sidebar();?>
