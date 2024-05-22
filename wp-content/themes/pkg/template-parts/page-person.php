<?php
/**
* Template name: Person
*/
get_header();
$page = get_post(get_the_ID());
?>
<section class="bg-white">
    <div class="container py-5">
        <div class="row pt-5">
            <div class="col-12 text-center pt-5 intro">
                <h2 class="fw-bold"><?=$page->post_title;?></h2>
            </div>
        </div>
        <div class="row py-5">
            <?php $blogusers = get_users(
                //'orderby=meta_value_num&nicename__not_in=a@ncv4ru'
                [
                    'exclude' => array( 1, 2, 5, 6, 9 ),
                    'orderby' => 'id',
                    'order'   => 'ASC'
                ]
            );
                foreach ($blogusers as $user) { ?>
                <div class="col-md-3">
                    <div class="card shadow info mb-4">
                        <div class="card-header bg-dark p-0" style="height:300px">
                            <img 
                                src="<?=get_user_meta($user->ID)["userimg"][0];?>" 
                                style="width: 100%;object-fit: cover;height: 300px"
                                alt="<?=$user->display_name;?>" 
                            />
                        </div>

                        <div class="card-header text-center border-0 bg-white">
                            <h5 class="fw-bold my-1" style="height: 80px">
                                <a href="/author/<?=$user->user_nicename;?>">
                                    <?=$user->display_name;?>
                                </a>
                            </h5>
                            <p class="mb-1">
                                <?php // =$user->user_email;?>
                                <?php // =get_user_meta($user->ID)["birthdate"][0];?>
                            </p>                            
                        </div>

                        <?php /*<pre><?php var_dump(get_user_meta($user->ID));?></pre>*/ ?>
                        
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</section>
<hr />
<?php get_footer();?>