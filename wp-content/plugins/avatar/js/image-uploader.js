(function($) {
    var defaultImg = $('#profile-user-img').attr('data-src');

    $('.user_image_button').on('click', function(event) {

       var image = wp.media({
           title: 'Upload Image',
           // Параметр mutiple: true необходим, если нужно загрузить несколько файлов за раз
           multiple: false
        }).open()
        .on('select', function(e) {
            // Возвращаем выбранное в медиа-загрузчике изображение как объект
            var uploaded_image = image.state().get('selection').first();
            var image_url = uploaded_image.toJSON().url;
            $('#userimg').val(image_url);
            $('#profile-user-img').attr('src', image_url);
        });
        return false;

    });
    $('.remove-user-image').on('click', function(event) {
        $('#userimg').val('');
        $('#profile-user-img').attr('src', defaultImg);
    });
})(jQuery);