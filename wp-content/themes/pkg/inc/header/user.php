<?php
    $user = get_user_meta(get_current_user_id());
    $user_img = get_user_meta( get_current_user_id(), 'userimg', 1 );
?>
<template v-if="card.length > 0">
    <div class="align-self-center dropdown">
        <button class="btn d-flex align-items-center" data-bs-toggle="dropdown">
            <span class="material-symbols-outlined ">shopping_cart</span>
            <span class="pulse" style="left: 33px;top: 3px"></span>
            <div class="px-3">{{card.length}}</div>
            {{totalCounts()}}
        </button>  
        <ul class="dropdown-menu dropdown-menu-end border-0 shadow">
            <li style="width:300px" v-for="(item, id) in card">
                <a class="dropdown-item d-flex align-items-center gap-3" href="#">
                    <img :src="item.image" :alt="item.name" style="width:40px" /> 
                    <div class="d-flex flex-column">
                        <span class="clip">{{ item.name }}</span>
                        <b class="text-primary">{{ priceFormat(item.price) }} ₽</b>
                    </div>
                </a>
            </li>
            <li><div class="dropdown-divider"></div></li>
            <li>
                <a href="/card" class="dropdown-item ">
                    <div class="btn btn-warning fw-bold w-100">Перейти в корзину</div>
                </a>
            </li>
        </ul>                  
    </div>
</template>
<div class="py-3 ps-3 d-flex gap-2 align-items-center" :class="[card.length > 0 ? 'border-start' : '']">
    <img 
        class="rounded-circle" src="<?=$user_img;?>" 
        style="width:50px;height: 50px;object-fit: cover;" 
        alt="<?=$user['first_name'][0];?>" 
    />
    <div class="dropdown">
        <a href="/profile" class="fw-bold ms-2 info" data-bs-toggle="dropdown">
            <?=$user['first_name'][0];?>
        </a>
        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-dark mt-29">
            <li>
                <a class="dropdown-item d-flex gap-3 align-items-center" href="/profile">
                    <i class="fa fa-user-graduate text-warning"></i> Мой профиль
                </a>
            </li>
            <li>
                <a class="dropdown-item d-flex gap-3 align-items-center" href="#">
                    <i class="fa fa-comment text-warning"></i> Сообщения
                </a>
            </li>
            <li><hr class="dropdown-divider m-0"></li>
            <li>
                <a class="dropdown-item d-flex gap-3 align-items-center" href="<?=wp_logout_url( home_url() );?>">
                    <i class="fa fa-power-off text-warning"></i> Выйти
                </a>
            </li>
        </ul>
    </div>
</div>

