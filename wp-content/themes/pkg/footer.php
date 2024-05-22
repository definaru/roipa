    </div>
    <footer itemscope itemtype="http://schema.org/WPFooter">
        <meta itemprop="copyrightYear" content="<?=date('Y');?>">
        <meta itemprop="copyrightHolder" content="<?=get_bloginfo('description'); ?>">
        <section class="bg-light py-5">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-lg-3">
                        <?=getLogotype();?>
                        <p class="text-muted"><?=get_bloginfo('description'); ?></p>
                        <div>
                            <?=getSocialIcons();?>
                        </div>
                    </div>
                    <div class="col-12 col-lg-3">
                        <h4 class="mb-4 text-info mt-4 mt-lg-0">Ресурсы</h4>
                        <ul class="d-flex flex-column gap-2">
                            <li>
                                <a href="/history">О сообществе</a>
                            </li>
                            <li>
                                <a href="/blog">Новости</a>
                            </li>
                            <li>
                                <a href="/person">Членство</a>
                            </li>
                            <li>
                                <a href="/contact">Контакты</a>
                            </li>
                            <li>
                                <a href="/order">Устав</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-12 col-lg-3">
                        <h4 class="mb-4 text-info mt-4 mt-lg-0">Материалы</h4>
                        <ul class="d-flex flex-column gap-2">
                            <li>
                                <a href="/video">Видео</a>
                            </li>
                            <li>
                                <a href="/photo">Фото</a>
                            </li>
                            <li>
                                <a href="/article">Публикации</a>
                            </li>
                            <li>
                                <a href="/press">Пресса о нас</a>
                            </li>
                            <li>
                                <a href="/art">Атлантида в искусстве</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-12 col-lg-3" itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
                        <h4 class="mb-4 text-info mt-4 mt-lg-0">Контакты</h4>
                        <ul class="d-flex flex-column gap-4">
                            <li class="d-flex align-items-center gap-2">
                                <span class="material-symbols-outlined text-info">mail</span> 
                                <span> 
									<a href="mailto:atlantisroipa@gmail.com" itemprop="email">atlantisroipa@gmail.com</a>
								</span> 
                            </li>
                            <li class="d-flex align-items-center gap-2">
                                <span class="material-symbols-outlined text-info">call</span>
                                <span> 
									<a href="tel:+79165650806" itemprop="telephone">+7 (916) 565 08 06</a>
								</span> 
                            </li>
							<li class="d-flex align-items-center gap-2">
                                <span class="material-symbols-outlined text-info">link</span>
                                <span> 
									<a href="http://roipa.org" target="_blank" rel="nofollow noreferrer noopener">Старый сайт РОИПА</a>
								</span> 
                            </li>
                        </ul>
                    </div>
                    <?php /*
                    <div class="col-3 text-info">
                        <h4 class="mb-4">Обратная связь</h4>
                        <p class="d-flex align-items-center gap-2 info">
                            <span class="material-symbols-outlined">ads_click</span>
                            <a href="#">По вопросам рекламы</a>
                        </p>
                        <div class="d-flex flex-column gap-2">
                            <div id="notification" data-bs-toggle="modal" data-bs-target="#myModal" class="d-flex justify-content-center align-items-center cp gap-2 btn btn-lg btn-warning">
                                <span class="material-symbols-outlined">notification_add</span>
                                <span>Подписаться</span> 
                            </div>
                            <a href="/order" class="d-flex justify-content-center align-items-center gap-2 btn btn-lg btn-info text-white">
                                <span class="material-symbols-outlined">heart_plus</span>
                                <span>Присоединиться</span>
                            </a>
                        </div>
                    </div>                    
                    */ ?>

                </div>
            </div>            
        </section>

        <section id="footer" class="bg-secondary border-top border-light py-3">
            <div class="container d-flex flex-column flex-lg-row justify-content-between">
                <div class="text-white">
                    <small>© РОИПА &middot; <?=date('Y');?>. Все права защищены.</small>
                </div>
                <div>
                    <ul class="d-flex flex-column flex-lg-row gap-1 gap-lg-3 justify-content-center m-0">
                        <?php the_privacy_policy_link('<li><small>', '</small></li>'); ?>
                        <li><small><a href="/terms-of-use">Пользовательское соглашение</a></small></li>
                        <li><small><a href="/blog">Блог</a></small></li>
                    </ul>
                </div>
            </div>
        </section>



        <div class="modal fade" id="myModal" v-if="!send">
            <div id="subscribers" class="modal-dialog modal-lg modal-dialog-centered">
                <form class="modal-content border-0" @submit.prevent="save">
                    <div class="modal-header py-2 border-0">
                        <h4 class="modal-title text-primary">Подписка на рассылку</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body px-5 mt-5">
                        <div class="mb-3">
                            <input 
                                type="text" 
                                autocomplete="off" 
                                autocorrect="off" 
                                autocapitalize="words" 
                                spellcheck="false" 
                                name="name" 
                                class="form-control border" 
                                :class="[error_names && name === '' ? 'border-danger' : 'border-primary']"
                                placeholder="Ваше имя..."
                                v-model.trim="name"
                            />
                            <div class="invalid-feedback d-block" v-if="error_names && name === ''">
                                Напишите ваше имя
                            </div>
                        </div>
                        <div class="mb-3">
                            <input 
                                type="email" 
                                autocomplete="off" 
                                autocorrect="off" 
                                autocapitalize="words" 
                                spellcheck="false" 
                                name="email" 
                                class="form-control border" 
                                :class="[error_email && email === '' ? 'border-danger' : 'border-primary']"
                                placeholder="Ваш e-mail адрес для рассылки..."
                                v-model.trim="email"
                            />
                            <div class="invalid-feedback d-block" v-if="error_email && email === ''">
                                Напишите ваш email
                            </div>
                            <div class="invalid-feedback d-block" v-if="email_invalid">
                                Пожалуйста введите правильный email адрес
                            </div>
                        </div>
                        <div class="d-flex justify-content-center mb-2">
                            <div class="form-check m-0">
                                <input 
                                    id="privacyPolicy"
                                    v-model="tosAgreement"
                                    class="form-check-input" 
                                    name="tosAgreement" 
                                    type="checkbox" 
                                />
                                <label class="form-check-label" :class="[error_agree && !tosAgreement ? 'text-danger' : 'text-dark']" for="privacyPolicy">
                                    Я соглашаюсь на обработку своих персональных данных. 
                                </label>
                            </div>                                        
                        </div>
                    </div>
                    <div class="d-flex justify-content-center modal-footer border-0 px-4 pt-0">
                        <small class="d-flex align-items-center">
                            <span class="material-symbols-outlined text-success">lock</span> 
                            &#160;Мы не занимаемся SPAM рассылкой и передачей ваших персональных данных третьим лицам.
                        </small>                            
                    </div>
                    <div class="d-flex justify-content-between border-top border-light gap-4 pt-4 px-5 pb-5">
                        <div>
                            <small class="text-muted">Подписка осуществляется исключительно по вашему собственному желанию.</small>
                        </div>
                        <button 
                            type="submit"
                            class="d-flex align-items-center gap-2 btn btn-success px-5 py-2"
                            v-on:click="Send"
                            v-html="button"
                        >
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <template v-else></template>

    </footer>
    <?php wp_footer(); ?>    
    <?=add_wp_scripts();?>
    </body>
</html>