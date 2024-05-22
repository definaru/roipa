<?php
    $url = home_url('/blog/'.$page->post_name);
    $image = currentImg();
    $description = strCuts2(strip_tags($page->post_content),0 ,200);
?>
<ul class="d-flex align-items-center m-0" style="font-size: 30px">
    <li class="page-item">
        <a class="ps-0 page-link text-dark border-0 bg-white" style="font-size: 14px">Поделится:</a>
    </li>
    <li class="page-item">
        <a class="page-link border-0 bg-white" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?=$url;?>">
            <i class="fab fa-facebook"></i>
        </a>
    </li>
    <li class="page-item">
        <a class="page-link border-0 bg-white" target="_blank" href="https://twitter.com/share?url=<?=$url;?>&text=<?=$post->post_title;?>">
            <i class="fab fa-twitter"></i>
        </a>
    </li>
    <li class="page-item">
        <a class="page-link border-0 bg-white" target="_blank" href="https://vk.com/share.php?url=<?=$url;?>&title=<?=$post->post_title;?>&description=<?=htmlspecialchars($description);?>&image=<?=$image;?>&noparse=true">
            <i class="fab fa-vk"></i>
        </a>
    </li>  
    <li class="page-item">
        <a class="page-link border-0 bg-white" target="_blank" href="https://pinterest.com/pin/create/button/?url=<?=$url;?>&media=<?=$image;?>&description=<?=htmlspecialchars($description);?>">
            <i class="fab fa-pinterest"></i>
        </a>
    </li>
</ul>

