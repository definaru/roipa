<?php
/**
 * roipa functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package roipa
 */

if ( ! function_exists( 'roipa_setup' ) ) :

	function roipa_setup() {

		load_theme_textdomain( 'roipa', get_template_directory() . '/languages' );

		add_theme_support( 'automatic-feed-links' );

		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'roipa' ),
		) );

		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'roipa_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'roipa_setup' );

function roipa_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'roipa_content_width', 640 );
}
add_action( 'after_setup_theme', 'roipa_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function roipa_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'roipa' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'roipa' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'roipa_widgets_init' );

function roipa_scripts() {
	wp_enqueue_style( 'roipa-style', get_stylesheet_uri() );

	wp_enqueue_script( 'roipa-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'roipa-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'roipa_scripts' );

require get_template_directory() . '/inc/custom-header.php';
require get_template_directory() . '/inc/template-tags.php';
require get_template_directory() . '/inc/template-functions.php';
require get_template_directory() . '/inc/customizer.php';

if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

function pregPhone($phone = '')
{
    return preg_replace('/[^0-9]/', '', $phone);
}


function replCuts($string)
{
    return str_ireplace("//", "<br/>", $string);
}



function getMenuItem($id = 2, $class = '', $ul = '')
{
    $menu_items = wp_get_nav_menu_items($id);
    $menu_list = '';
    foreach ( (array) $menu_items as $key => $menu_item ) {
        $text = $menu_item->title;
        $title = $menu_item->attr_title ? ' data-toggle="tooltip" title="'.$menu_item->attr_title.'"' : '';
        $target = $menu_item->target;
        if($menu_item->url == '#') { // если это номер телефона
            $url = 'tel:+'.pregPhone($text);
        }
        elseif($menu_item->url == 'http://@') { // если ссылка на карту
            $url = 'https://www.google.ru/maps/place/'.$text;
        }
        elseif($menu_item->url == 'http://@#') { // если это email адрес
            $url = 'mailto:'.$text;
        }
        else { // иначе выводим обычную ссылку
            $url = $menu_item->url;
        }
        $menu_list .= PHP_EOL.
        '<li><a href="' . $url . '"'.$target.''.$title.'>' . $text . '</a></li>'. // шаблон одной ссылки в меню
        PHP_EOL;
    }
    
    $menu_obj = get_term( $id, 'nav_menu' );
    $tag_ul = ($ul) ? ' class="'.$ul.'"' : '';
    wp_nav_menu( array(
        'menu' => $id, 
        'container' => false,
        'container_class' => false,
        'items_wrap' => 
        PHP_EOL.'<div class="'.$class.'">'.
        PHP_EOL.'<h5 class="title">'.$menu_obj->name.'</h5>'. // выводим заголовок (имя) меню
        PHP_EOL.'<ul'.$tag_ul.'>'.$menu_list.'</ul>'.PHP_EOL.
        PHP_EOL.'</div>'
    ));
}

function getLogotype() 
{
    // $logo_img = wp_get_attachment_image( get_theme_mod('custom_logo'), 'full', false, array(
    //     'id'    => 'logo',
    //     'class'    => 'display-1',
    //     'itemprop' => 'logo',
    //     'alt' => get_bloginfo( 'name', 'display' ),
    // ) );
    $logo_img = wp_get_attachment_image_src( get_theme_mod( 'custom_logo' ), 'full' )[0];
    $img = '<img src="'.$logo_img.'" class="display-1" alt="'.get_bloginfo('name').'" style="filter: invert(60%)">';
    $logo = '<a href="/" id="logo" class="d-block mb-4">'.$img.'</a>';
    return ($logo_img == '') ? get_bloginfo( 'name', 'display' ) : $logo;
}

function showMessage($message, $errormsg = false)
{
    if ($errormsg) {
        echo '<div id="message" class="error">';
    }
    else {
        echo '<div id="message" class="updated fade">';
    }

    echo "<p><strong>$message</strong></p></div>";
}

function fb_disable_feed() {
    wp_redirect(get_option('siteurl'));
}
add_action('do_feed', 'fb_disable_feed', 1);
add_action('do_feed_rdf', 'fb_disable_feed', 1);
add_action('do_feed_rss', 'fb_disable_feed', 1);
add_action('do_feed_rss2', 'fb_disable_feed', 1);
add_action('do_feed_atom', 'fb_disable_feed', 1);
remove_action( 'wp_head', 'feed_links_extra', 3 );
remove_action( 'wp_head', 'feed_links', 2 );
remove_action( 'wp_head', 'rsd_link' );

function email ($mail = '', $params = '')
{
    return "<a href='mailto:$mail' $params>$mail</a>";
}

function phone ($phone = '', $params = [])
{
    return "<a href='tel:$phone' $params>$phone</a>";
}

function wp_actions()
{
    $header = '<meta name="robots" content="index, follow">'.PHP_EOL;
    $header .= '<meta name="author" content="Официальный сайт"/>'.PHP_EOL;
    return $header;
    //do_action( 'wp_actions' );
}

function add_wp_style()
{
    $dir = get_template_directory_uri();
    $head  = '<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.css" rel="stylesheet" media="all">'.PHP_EOL;
    $head .= '<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">'.PHP_EOL;
    $head .= '<link href="'.$dir.'/css/defina.min.css" rel="stylesheet">'.PHP_EOL;
    $head .= '<link href="'.$dir.'/style.css" rel="stylesheet">'.PHP_EOL;

    return $head;
}

function strCuts2($string = '', $in = 0, $str = 20)
{
    mb_internal_encoding("UTF-8");
    return mb_substr($string, $in, $str);
}

function add_wp_scripts()
{   
    $dir = get_template_directory_uri();
    $script  = '<script src="'.$dir.'/js/jquery.min.js"></script>'.PHP_EOL; //  $_SERVER['REQUEST_URI'] === '/' ? '' : 
    $script .= '<script src="https://cdn.jsdelivr.net/npm/vue@2.6.12"></script>'.PHP_EOL;
    $script .= '<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>'.PHP_EOL;
    $script .= '<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.umd.js"></script>'.PHP_EOL;
    $script .= '<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.1/toastr.min.js"></script>'.PHP_EOL;
    $script .= '<script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>'.PHP_EOL;
    //$script .= '<script src="'.$dir.'/js/define.browse.js"></script>'.PHP_EOL;
    $script .= '<script src="'.$dir.'/js/defina.min.js"></script>'.PHP_EOL;
    
    return $script;
}

function my_admin_notice(){
    global $pagenow;
    if ( $pagenow == 'nav-menus.php' ) {
         echo '<div class="notice notice-info is-dismissible">
                <p><strong>Подсказка:</strong></p>
                <p>1) Выберите меню</p>
                <p>2) Выберите блок "Произвольные ссылки"</p>
                <p>3) Впешите в "URL" поле:</p>
                <hr/>
                <p>
                <b>#</b> - если хотите получить ссылку на <u>телефон</u><br/>
                <b>http://@</b> - если хотите получить адрес на <u>Google карте</u><br/>
                <b>http://@#</b> - Если хотите получить ссылку на <u>электронную почту</u> 
                </p>
        </div>';
    }
}
add_action('admin_notices', 'my_admin_notice');


function alertDefina(){
    global $pagenow;
    if ( $pagenow == 'index.php' ) {
         echo '<div class="notice  is-dismissible">
                    <h2 class="hndle ui-sortable-handle"><span>Новые возможности</span></h2><hr>
                        <table style="width: 80%;margin-left: 14%;">
                            <tbody>
                            <tr>
                                <td>
                                    <img src="https://defina.ru/panel/img/cms_defina_box.png" alt="CMS Defina" style="width:250px;margin-right: 35px;">
                                </td>
                                <td style="vertical-align: top;">
                                    <div id="yoast-seo-ryte-assessment" style="float: left;border-top: 0;width: 57%;margin: 0;padding: 50px 0;">
                                        <h1 style="font-family: sans-serif;font-weight: bold;">
                                            Вышла новая версия
                                            <br> 
                                            <strong>
                                                <span style="color:#d13a7a">CMS</span>
                                            </strong> 
                                            Defina 
                                            <sup style="color: #999;font-weight: 100;">v4.6.22</sup>
                                        </h1>
                                        <p style="padding: 19px 0;color: #666;font-family: sans-serif;">CMS Defina - это движок, который поможет вам в создании и наполнении сайта. Всё работает быстро и легко, попробуйте творчество вместе с CMS Defina. Управление сайтом давное не было столь комфортным и удобным, как сейчас.
                                        Управляйте вашим сайтом с телефона. Рисуйте блоки, выбирайте шрифты и цвета сами.</p>
                                        <a class="landing-page button" href="https://defina.ru/app/cms_defina" target="_blank" style="padding: 20px 50px;line-height: 1px;font-weight: bold;">Подробнее</a>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>';
    }
}
add_action('admin_notices', 'alertDefina');


function getGravatarImage($email, $size) 
{
    return 'https://www.gravatar.com/avatar/' . md5(strtolower(trim($email))) . '&s=' . $size;
}    


function getMenuFly() {
    return wp_get_nav_menu_items(2);
}

function insertSubscribers(\WP_REST_Request $req) {

    $headers = $req->get_headers();

    global $wpdb;
    $table_name = 'defina_subscribers';
    $name       = $_POST['name'];
    $email      = $_POST['email'];

    $wpdb->insert(
        $table_name, 
        array(
            'name'  => esc_sql($name),
            'email' => esc_sql($email),
            'agree' => esc_sql($_POST['agree']),
            'date'  => esc_sql($_POST['date'])
        ), array('%s', '%s', '%s', '%s')
    );
    return json_encode([
        'message' => 'Вы успешно подписаны', 
        'data' => [
            'name' => $name,
            'email' => $email
        ]], true);
}


// http://roipa.host/wp-json/api/v1/menu
add_action( 'rest_api_init', function () {
	register_rest_route( 'api/v1', '/menu', array(
		'methods' => 'GET',
		'callback' => 'getMenuFly',
	));
});

// http://roipa.host/wp-json/api/v1/subscribers
add_action( 'rest_api_init', function () {
	register_rest_route( 'api/v1', '/subscribers', array(
		'methods' => 'POST',
		'callback' => 'insertSubscribers',
        'permission_callback' => function() { return ''; }
	));
});


// ЛОГИРОВАНИЕ
function isUserLogin()
{
	//$link = "getStartLink('profile')";
	$user_img = get_user_meta( get_current_user_id(), 'userimg', 1 );
	if(is_user_logged_in()) {
		require get_template_directory() . '/inc/header/user.php';
	} else {
		require get_template_directory() . '/inc/header/login.php';
	}
}




// БРЕНДИРОВАНИЕ
// ставим логотип компании [настройка брендирования]
function my_custom_login_logo()
{
    echo '<style> .login h1 a {  background-image:url('.get_bloginfo('template_directory').'/img/464565473547.png)  !important; } </style>';
}
add_action('login_head',  'my_custom_login_logo');

// Изменяем атрибут title у ссылки логотипа
function wp_login_logo_title_attr( $title ) {
    return get_bloginfo( 'name' );
}
add_filter( 'login_headertitle', 'wp_login_logo_title_attr' );

// Изменяем ссылку с логотипа
function wp_login_logo_link_url( $url ){
    return home_url();
}
add_filter( 'login_headerurl', 'wp_login_logo_link_url' );

// Подключаем стили к страница аунтификации
function add_stylesheet_to_head() {
    echo '<link href="'.get_template_directory_uri().'/css/defina.admin.min.css" rel="stylesheet" type="text/css">';
}
add_action( 'login_head', 'add_stylesheet_to_head' );

// Подключаем скрипт к страница аунтификации
function add_scripts_to_body() {
    wp_enqueue_script('defina', get_template_directory_uri() . '/js/defina.js', array(), false, true);
}
add_action( 'login_enqueue_scripts', 'add_scripts_to_body' );


function getSocialIcons()
{
    $soc_menu_items = wp_get_nav_menu_items(9);
    $soc_menu_list = '';
    foreach ( (array) $soc_menu_items as $key => $soc_menu_items ) {
        $text = $soc_menu_items->title;
        $url = $soc_menu_items->url;
        $title = $soc_menu_items->attr_title;
        if($title) {
            $soc_menu_list .= 
                PHP_EOL.
                '<a href="'.$url.'" 
                    target="_blank" 
                    class="btn btn-light btn-sm rounded-circle d-flex align-items-center justify-content-center" 
                    style="width: 50px;height:50px"
                    data-bs-toggle="tooltip" 
                    data-bs-placement="top" title="'.$title.'"
                >
                    <i class="'.$text.' text-muted fs-4"></i>
                </a>';
                PHP_EOL;            
        }

    }
    wp_nav_menu( array(
        'menu' => $id, 
        'container' => 'div',
        'container_class' => 'd-flex align-items-center gap-3',
        'items_wrap' => PHP_EOL.$soc_menu_list.PHP_EOL
    ));
}

function formatHeaderBook($header)
{
    $title = $header;
    $word = explode(". ", $title);
    $end = $word[2] ? '. <small class="d-block w-100 text-center text-muted fs-6">('.$word[2].')</small>' : '';
    return $word[0].'. '.$word[1].$end;
}



add_action( 'init', 'storeBooks' );
function storeBooks(){
	add_rewrite_rule( 
        //'^(store/book)/([^/]*)?', 
        '^store/book/(.*)',
        'index.php?pagename=$matches[1]&link=$matches[2]', 
        'top' 
    );
	add_rewrite_tag( '%link%', '([^&]+)' );
}


function wp_pretty_login() {
    add_rewrite_rule( 'login$', 'wp-login.php', 'top' );
}
add_action( 'init', 'wp_pretty_login' );


function true_add_contacts( $contactmethods ) {
	$contactmethods['birthdate'] = 'Ваш день рождения';
	$contactmethods['country'] = 'Ваша страна';
	$contactmethods['phone'] = 'Номер телефона';
	$contactmethods['skype'] = 'Скайп';
	return $contactmethods;
}
add_filter('user_contactmethods', 'true_add_contacts', 10, 1);

function save_profile_fields() {
    $current_user = wp_get_current_user();
    $user_id = $current_user->id;
	update_usermeta( $user_id, 'birthdate', $_POST['birthdate'] );
	update_usermeta( $user_id, 'country', $_POST['country'] );
	update_usermeta( $user_id, 'phone', $_POST['phone'] );
	update_usermeta( $user_id, 'skype', $_POST['skype'] );
}
add_action( 'personal_options_update', 'save_profile_fields' );
add_action( 'edit_user_profile_update', 'save_profile_fields' );


function getRoleRBAC()
{
    return [
        'contributor'   => 'Участник', 
        'author'        => 'Автор', 
        'editor'        => 'Редактор', 
        'administrator' => 'Администратор'
    ];
}

function currentImagePost($id)
{
    return wp_get_attachment_url(get_post_thumbnail_id($id, 'medium', false));
}

function getTagBlog($id)
{
    $tags = get_the_tags($id);
    $list = '';
    foreach( $tags as $tag ) {
        $list .= '<a href="/tag/'.$tag->slug.'" class="badge bg-primary">'.$tag->name.'</a>';
    }
    return $list;
}

function getFormatBlogDate($date)
{
    $datetime = date_create($date);
    return date_format( $datetime, 'F d, Y');
}


// Кнопка "редактировать"
function Edit($id, $text = 'ред', $class = 'btn btn-sm btn-secondary text-white edit')
{
    $user = get_userdata(get_current_user_id());
    return (current_Role($user->ID) == 'administrator') ? edit_post_link($text, '', '', $id, $class) : '';
}

function sklonen($n,$s1,$s2,$s3, $b = false)
{
    // sklonen( 'число', 'новость', 'новости', 'новостей') 1, 2, 5
    $m = $n % 10; $j = $n % 100;
    if($b) {$n = $n;}
    if($m==0 || $m>=5 || ($j>=10 && $j<=20)) {return $n.' '.$s3;}
    if($m>=2 && $m<=4) {return  $n.' '.$s2;}
    return $n.' '.$s1;
}

function registerCssStyle($css = '')
{
    echo '<style>'.PHP_EOL.$css.PHP_EOL.'</style>';
}

function currentImg()
{
    $thumb_id = get_post_thumbnail_id();
    $thumb_url = wp_get_attachment_image_src($thumb_id,'thumbnail-size', true);
    return $thumb_url[0];    
}


function mytheme_comment($comment, $args = array(), $depth = 1)
{
    $GLOBALS['comment'] = $comment;
    $email = get_comment_author_email( $comment->comment_ID );
    switch ( $comment->comment_type ) :
        case '' :
?>
       <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
            <div id="comment-<?php comment_ID(); ?>">
                <div class="media border p-2 mb-3 d-none">
                    <img 
                        src="<?=getGravatarImage($email, 120)?>" 
                        alt="<?=get_comment_author( $comment->comment_ID );?>" 
                        class="mr-3 mt-0 rounded-circle" 
                        style="width:120px;">
                    <div class="media-body">
                        <h4>
                            <?=get_comment_author( $comment->comment_ID );?>
                            <small class="text-muted t-11">
<!--                                <a href="<?php // =esc_url( get_comment_link( $comment->comment_ID ) ) ?>">-->
                                    <?php printf(__('%1$s at %2$s'), get_comment_date(),  get_comment_time()) ?>
<!--                                </a>-->
                            </small>
                        </h4>
                        <?php comment_text() ?>
                        <?php edit_comment_link( __( 'Редактировать' ), ' ' ); ?>
<!--                        /wp-admin/comment.php?action=editcomment&c=1-->
                            <a href="<?=$_SERVER['REQUEST_URI']?>?replytocom=<?=comment_ID();?>#respond">ответить</a>
                    </div>
                </div>
 
                <?php if ($comment->comment_approved == '0') : ?>
                    <div class="comment-awaiting-verification"><?php _e('Your comment is awaiting moderation.') ?></div>
                    <br />
                <?php endif; ?>
                
                <div class="reply">
                    <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
                </div>
            </div>
<?php
        break;
    endswitch;
}
add_filter('wp_list_comments_args', 'mytheme_comment');

function viewPDFreview($param) 
{
    return '<a data-fancybox data-type="iframe" class="text-danger" data-src="'.$param.'" href="javascript:;">Прочесть отзыв</a>';
}

function getFileOpen($param) {
    return '<div class="media border p-2">
        <img src="'.get_template_directory_uri().'/img/pdf.svg" alt="PDF file" class="mr-1 mt-0" style="width:60px;">
        <div class="media-body">
            <h4 class="m-0 text-dark"><small>#Прикреплё (PDF file)</small></h4>
            <p class="m-0 nofocus">'.viewPDFreview($param).'</p>
        </div>
    </div>';
}

function isIndexHome()
{
    return $_SERVER['REQUEST_URI'] === '/' ? 'hero' : '';
}


add_filter( 'nav_menu_css_class', 'add_my_class_to_nav_menu', 10, 2 );
function add_my_class_to_nav_menu( $classes, $item ) {
    $id = $item->ID;
    $url = $item->url;
    $parent = $item->menu_item_parent;

    $parents = $parent === $id? 'trah' : 'dropdown';
    $currency = $_SERVER['REQUEST_URI'];
    $active = ($url == $currency) ? ' active' : ' ';
	$classes[] = $active;
    foreach ( $classes as $key => $class ) {
		if ( $class == 'menu-item' ) {
			$classes[ $key ] = '';
		}
		if ( $class == 'menu-item-type-custom' ) {
			$classes[ $key ] = '';
		}
		if ( $class == 'menu-item-object-custom' ) {
			$classes[ $key ] = '';
		}
		if ( $class == 'menu-item-has-children' ) {
			$classes[ $key ] = 'dropdown';
		}
	}

	return $classes;
}


add_filter( 'nav_menu_submenu_css_class', 'change_wp_nav_menu', 10, 3 );
function change_wp_nav_menu( $classes, $args, $depth ) {
	foreach ( $classes as $key => $class ) {
		if ( $class == 'sub-menu' ) {
			$classes[ $key ] = 'dropdown-menu dropdown-menu-end';
		}
	}
	return $classes;
}


add_filter( 'nav_menu_link_attributes', function( $atts, $item, $args ) {
    $menu_items = array(9,10,11);
    if (in_array($item->ID, $menu_items)) {
        $atts['class'] = 'dropdown-toggle';
        $atts['data-bs-toggle'] = 'dropdown';
    }

    return $atts;

}, 10, 3 );


function add_class_to_non_top_level_menu_anchors( $atts, $item, $args, $depth ) {

    $url = $item->url;
    $currency = $_SERVER['REQUEST_URI'];

    if ( $url == $currency ) {
        $atts['class'] = 'active';
    }
    if ( 0 !== $depth ) {
        $atts['class'] = 'dropdown-item';
    }
 
    return $atts;
}
add_filter( 'nav_menu_link_attributes', 'add_class_to_non_top_level_menu_anchors', 10, 4 );