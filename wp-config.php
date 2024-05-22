<?php
/**
 * Основные параметры WordPress.
 *
 * Скрипт для создания wp-config.php использует этот файл в процессе установки.
 * Необязательно использовать веб-интерфейс, можно скопировать файл в "wp-config.php"
 * и заполнить значения вручную.
 *
 * Этот файл содержит следующие параметры:
 *
 * * Настройки базы данных
 * * Секретные ключи
 * * Префикс таблиц базы данных
 * * ABSPATH
 *
 * @link https://ru.wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Параметры базы данных: Эту информацию можно получить у вашего хостинг-провайдера ** //
/** Имя базы данных для WordPress */
define( 'DB_NAME', 'rayvaigmig' );

/** Имя пользователя базы данных */
define( 'DB_USER', 'rayvaigmig' );

/** Пароль к базе данных */
define( 'DB_PASSWORD', '7Z5lZi4NW0uwCN7f7KSj' );

/** Имя сервера базы данных */
define( 'DB_HOST', 'localhost' );

/** Кодировка базы данных для создания таблиц. */
define( 'DB_CHARSET', 'utf8mb4' );

/** Схема сопоставления. Не меняйте, если не уверены. */
define( 'DB_COLLATE', '' );

/**#@+
 * Уникальные ключи и соли для аутентификации.
 *
 * Смените значение каждой константы на уникальную фразу. Можно сгенерировать их с помощью
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ сервиса ключей на WordPress.org}.
 *
 * Можно изменить их, чтобы сделать существующие файлы cookies недействительными.
 * Пользователям потребуется авторизоваться снова.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'I4&u|u?Q!!$d-i~PKD`>Xj_OW|%j9R$[3t*1> 3(!f%Yas*eS97qVsC/;w=Lp9e7' );
define( 'SECURE_AUTH_KEY',  'GOyI6ZDo+pPQ|2!/y!mFP/.~ KQ9SRF;)J*u4p?tp`)Fw{7!t.*hj#4vcvF4+qF*' );
define( 'LOGGED_IN_KEY',    'k{=sa#CyCcy*h_YkgS(a*we1%mg{@bsH(sh)5t,*|t4qc.!IE =R#RkM0.[/dp.:' );
define( 'NONCE_KEY',        'xI$]4mww?LjX*ROZ8@K`iY5QnY}5.W2Y8jA$o.5U6{(xNu^ G5*XP]FUC>Xb9T$T' );
define( 'AUTH_SALT',        'D^s8I##*!lZv9a(mZD=qD?r.dz,)0mSbC}:K@4P(!nH.`<6_j9+}m~+zSQVgTHsK' );
define( 'SECURE_AUTH_SALT', '={HI2SYXS^&kDhd(+2*,IBT`riP-wmq_hmf_<he{Hc0s4-Am9zz=|%D+)/.O,rH6' );
define( 'LOGGED_IN_SALT',   'Nd(}<kqiu7<e<,4y(>:9GanH*3=]c{l`=k>f$pn!V5%MQ)@:Rhjb-!c2VB;FTb0,' );
define( 'NONCE_SALT',       ':Q>PQKd,!x^WfwCY?Q,nx>B(e%/=mjxzxjMoS|*m|LixaNz5M1hyYNqwG1+)^V/^' );

/**#@-*/

/**
 * Префикс таблиц в базе данных WordPress.
 *
 * Можно установить несколько сайтов в одну базу данных, если использовать
 * разные префиксы. Пожалуйста, указывайте только цифры, буквы и знак подчеркивания.
 */
$table_prefix = 'defina_';

/**
 * Для разработчиков: Режим отладки WordPress.
 *
 * Измените это значение на true, чтобы включить отображение уведомлений при разработке.
 * Разработчикам плагинов и тем настоятельно рекомендуется использовать WP_DEBUG
 * в своём рабочем окружении.
 *
 * Информацию о других отладочных константах можно найти в документации.
 *
 * @link https://ru.wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Произвольные значения добавляйте между этой строкой и надписью "дальше не редактируем". */



/* Это всё, дальше не редактируем. Успехов! */

/** Абсолютный путь к директории WordPress. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Инициализирует переменные WordPress и подключает файлы. */
require_once ABSPATH . 'wp-settings.php';
