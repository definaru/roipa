<div class="container pt-5">
    <div class="row py-4">
        <?php foreach( $ecwd_organizer as $user ) { ?>
            <div class="col-lg-12 mb-5">
                <div class="d-flex border info">
                    <div class="pe-4">
                        <img 
                            src="<?=get_the_post_thumbnail_url($user->ID, 'full')?>" 
                            style="width: 150px"
                            class="d-block"
                        />
                    </div>
                    <div class="flex-grow-1">
                        <div class="d-flex flex-column justify-content-center h-100">
                            <a href="/organizer/<?=$user->post_name?>"><h4><?=$user->post_title?></h4></a>
                            <p><?=$user->post_content?></p>                            
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>                  
    </div>
</div>