<?php
    $default_image = plugins_url(NO_AVATAR, __FILE__);
    $user_img = get_user_meta( $user->ID, 'userimg', true);
    $locale = get_locale();
?>
<h3><?=$locale === 'ru_RU' ? 'Информация о личности' : 'Personal information';?></h3>
<table class="form-table">
    <tr>
        <th>
	        <img 
                data-src="<?=$default_image;?>" 
                width="150" 
                height="150" 
                id="profile-user-img" 
                src="<?=( $user_img!= "" ? $user_img : $default_image) ?>"  
            />
        </th>
        <td>
	        <input type="hidden" name="userimg" id="userimg" value="<?=$user_img ?>" size="50" />
            <span class="profile-buttons">
                <p class="description">
                    <?=$locale === 'ru_RU' ? 'Картинка профиля' : 'Your avatar';?>
                </p>
                <input 
                    type="button" 
                    name="submit" 
                    id="submit-photo" 
                    class="button user_image_button" 
                    value="<?=$locale === 'ru_RU' ? 'Выберите фото' : 'Choose a photo';?>"
                />
                <input 
                    type="button" 
                    name="submit" 
                    id="delete" 
                    class="button delete remove-user-image" 
                    value="&times;"
                />
            </span>    
        </td>
    </tr>
</table>