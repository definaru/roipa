<?php
/**
* Template name: Calculator
*/
get_header();
$decimal = '&#8381;';
?>
<div style="display:none;">
    <?php $page = get_post(the_ID());?>
</div>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <nav class="jumbotron m-0 p-0 rounded-0">
        <ol class="breadcrumb rounded-0 mb-0 ml-lg-4 ml-sm-0">
            <li class="breadcrumb-item"><a href="/">Главная</a></li>          
            <li class="breadcrumb-item active" aria-current="page"><?=$page->post_title;?></li>
        </ol>          
    </nav>
    <header class="entry-header jumbotron rounded-0 mb-0">
        <div class="row">
            <div class="col-md-12 text-center">
                <?php 
                    the_title( '<h3>', '</h3>' ).edit_post_link('<i class="ionicons ion-android-create"></i>', '', '', $post->ID, 'btn btn-outline-secondary pull-right');
                ?>                
            </div>
            <div class="col-md-12">
                <?=$post->post_content;?>
                <div class="btn-block d-block mb-4"></div>
                <div class="table-responsive">
                    
                <div class="alert alert-danger fade in alert-dismissible show mt-5 mb-3 text-center">
                    При заказе от 10 программ предусмотрена <strong>скидка 30%</strong>
                </div>
                <div id="result">
                    <table id="table" class="table table-bordered table-striped table-hover bg-light">
                        <tr class="bg-white">
                            <th>Список курсов</th>
                            <th>Продолжительность</th>
                            <th>Стоимость</th>
                            <th>кол-во/чел.</th>
                        </tr>
                        <tr data-key="1">
                            <td>Охрана труда при работах на высоте</td>
                            <td>30-48 часов</td>
                            <td><?=number_format('3000');?> <?=$decimal;?></td>
                            <td class="p-0" id="calculator">
                                <input id="key1" class="calc__input border-0" type="number" min="1" data-time="30-48 часов" data-text="Охрана труда при работах на высоте" data-price="3000" data-total="0">
                            </td>
                        </tr>
                        <tr data-key="2">
                            <td>Охрана труда для руководителей и специалистов</td>
                            <td>40 часов</td>
                            <td><?=number_format('2500');?> <?=$decimal;?></td>
                            <td class="p-0" id="calculator">
                                <input id="key2" class="calc__input border-0" type="number" min="1" data-time="40 часов" data-text="Охрана труда для руководителей и специалистов" data-price="2500" data-total="0">
                            </td>
                        </tr>
                        <tr data-key="3">
                            <td>Пожарно-технический минимум</td>
                            <td>7-28 часов</td>
                            <td><?=number_format('2500');?> <?=$decimal;?></td>
                            <td class="p-0" id="calculator">
                                <input id="key3" class="calc__input border-0" type="number" min="1" data-time="7-28 часов" data-text="Пожарно-технический минимум" data-price="2500" data-total="0">
                            </td>
                        </tr>
                        <tr data-key="4">
                            <td>Повышение квалификации</td>
                            <td>72 часа</td>
                            <td><?=number_format('4000');?> <?=$decimal;?></td>
                            <td class="p-0" id="calculator">
                                <input id="key4" class="calc__input border-0" type="number" min="1" data-time="72 часа" data-text="Повышение квалификации" data-price="4000" data-total="0">
                            </td>
                        </tr>
                        <tr data-key="5">
                            <td>Повышение квалификации для работ на особо опасных объектах</td>
                            <td>112 часов</td>
                            <td><?=number_format('5000');?> <?=$decimal;?></td>
                            <td class="p-0" id="calculator">
                                <input id="key5" class="calc__input border-0" type="number" min="1" data-time="112 часов" data-text="Повышение квалификации для работ на особо опасных объектах" data-price="5000" data-total="0">
                            </td>
                        </tr>
                        <tr data-key="6">
                            <td>Профессиональная переподготовка</td>
                            <td>256 часов</td>
                            <td><?=number_format('15000');?> <?=$decimal;?></td>
                            <td class="p-0" id="calculator">
                                <input id="key6" class="calc__input border-0" type="number" min="1" data-time="256 часов" data-text="Профессиональная переподготовка" data-price="15000" data-total="0">
                            </td>
                        </tr>
                        <tr data-key="7">
                            <td>Профессиональная переподготовка</td>
                            <td>512 часов</td>
                            <td><?=number_format('20000');?> <?=$decimal;?></td>
                            <td class="p-0" id="calculator">
                                <input id="key7" class="calc__input border-0" type="number" min="1" data-time="512 часов" data-text="Профессиональная переподготовка" data-price="20000" data-total="0">
                            </td>
                        </tr>
                        <tr data-key="8">
                            <td>Оказание первой медицинской помощи</td>
                            <td>8 часов</td>
                            <td><?=number_format('4000');?> <?=$decimal;?></td>
                            <td class="p-0" id="calculator">
                                <input id="key8" class="calc__input border-0" type="number" min="1" data-time="8 часов" data-text="Оказание первой медицинской помощи" data-price="4000" data-total="0">
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2"><strong id="rur">Итого результат:</strong></td>
                            <td>
                                <span id="total" class="font-weight-bold"></span>
                            </td>
                            <td style="text-align: center;">
                                <div id="people">
                                    <span class="font-weight-bold" id="the_price_v_m"></span> чел.
                                </div>
                            </td>
                        </tr>                        
                    </table>
                </div> 

                    

                </div>
            </div>
            <div id="starts" class="col-md-12 mt-3 d-none">
                <?=do_shortcode( '[contact-form-7 id="87" title="Заказ обучающих курсов"]' ); ?>
            </div>
            
            <table id="test">
                <tr></tr>
            </table>
            <?php /*<textarea id="orderbuy" rows="5" style="width: 100%;"></textarea>*/ ?>
            
        </div>
    </header>
    
</article>           
<?php get_footer();?>