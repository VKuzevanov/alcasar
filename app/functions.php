<?php
/**
 * The functions.php template for our theme
 *
 * @package WordPress
 * @subpackage Alcasar
 */
?>
<?php
//защищаем wp
remove_action( 'wp_head', 'wp_generator' );
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'rsd_link' );

// регистрируем файлы стилей и добавляем его в очередь
function register_styles() {
	wp_register_style( 'fonts', get_template_directory_uri().'/fonts/fonts.css');
	wp_enqueue_style( 'fonts');
	wp_register_style( 'main-style', get_stylesheet_uri());
	wp_enqueue_style( 'main-style');
}
add_action( 'wp_enqueue_scripts', 'register_styles' );

// переносим js в footer
function custom_clean_head() { 
	remove_action('wp_head', 'wp_print_scripts'); 
	remove_action('wp_head', 'wp_print_head_scripts', 9); 
	remove_action('wp_head', 'wp_enqueue_scripts', 1); 
} 
add_action( 'wp_enqueue_scripts', 'custom_clean_head' );  

// Подключаем jQuery из гугла
function my_load_scripts() {
	if( !is_admin() ) {
		wp_deregister_script( 'jquery-core' ); // отключаем только jquery без jquery-migrate
		wp_register_script( 'jquery-core', '//ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js', array(), null, true ); // регистрируем крайнюю версию из гугла
		add_filter( 'script_loader_src', 'jquery_local_loader', 10, 2 );  // вешаем на загрузку скрипта альтернативный jquery
		wp_enqueue_script( 'jquery' );
        
        wp_register_script('jq172',  '//code.jquery.com/jquery-1.7.2.min.js');
		wp_enqueue_script( 'jq172' );
       
        
        wp_register_script('mod+respond',  get_template_directory_uri().'/js/vendor/modernizr-2.8.3-respond-1.4.2.min.js');
		wp_enqueue_script( 'mod+respond' );
		wp_register_script('theme',  get_template_directory_uri().'/js/main.js');
		wp_enqueue_script( 'theme' );
	}	
}
add_action( 'wp_enqueue_scripts', 'my_load_scripts' );

//проверяем загрузилась библиотека и если нет грузим локальную из вордпресс
function jquery_local_loader( $src, $handle = null ) {
	static $add_jquery_fallback = false;
	if( $add_jquery_fallback ) {
		echo '<script>window.jQuery || document.write(\'<script src="' . includes_url() . 'js/jquery/jquery.js"><\/script>\')</script>' . "\n";
		$add_jquery_fallback = false;
	}
	if( $handle === 'jquery-core' ) {
		$add_jquery_fallback = true;
	}	
	return $src;	
}
add_action( 'wp_head', 'jquery_local_loader' );






// поддержка миниатюр
add_theme_support( 'post-thumbnails' );
set_post_thumbnail_size(272, 174);
	
// поддержка HTML5.
add_theme_support( 'html5', array(
	'comment-list',
	'search-form',
	'comment-form',
	'gallery',
));
// меняем функцию the_excerpt меняем коло-во символов  добовляем ...
function custom_excerpt_length( $length ) {
	return 36;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );
function new_excerpt_more( $more ) {
	return '...';
}
add_filter('excerpt_more', 'new_excerpt_more');

// регистрируем все меню темы
register_nav_menus( array(
	'panel_menu' => 'Меню в топ панели',
	'header_menu' => 'Меню в шапке',
));
// удаляем контейнеры меню
add_filter( 'wp_nav_menu_args', 'my_wp_nav_menu_args' );
function my_wp_nav_menu_args( $args = '' ){
	$args['container'] = false;
	return $args;
}

//регистрация сайдбара
register_sidebar(array( 
	'name' => 'Колонка справа',
	'id' => "right-sidebar",
	'description' => 'Cайдбар',
	'before_widget' => '<div id="%1$s" class="widget %2$s">',
	'after_widget' => "</div>\n",
	'before_title' => '<span class="widget__title">',
	'after_title' => "</span>\n",
));
//не должно быть в functions

//хлебные крошки
function kama_breadcrumbs( $sep = 0, $l10n = array(), $args = array() ){
	global $post, $wp_query, $wp_post_types;

	// Локализация
	$default_l10n = array(
		'home'       => 'Главная',
		'paged'      => 'Страница %s',
		'_404'       => 'Ошибка 404',
		'search'     => 'Результаты поиска по запросу - <b>%s</b>',
		'author'     => 'Архив автора: <b>%s</b>',
		'year'       => 'Архив за <b>%s</b> год',
		'month'      => 'Архив за: <b>%s</b>',
		'day'        => '',
		'attachment' => 'Медиа: %s',
		'tag'        => 'Записи по метке: <b>%s</b>',
		'tax_tag'    => '%s из "%s" по тегу: <b>%s</b>',
	);
	
	// Параметры по умолчанию
	$default_args = array(
		'on_front_page'   => true, // выводить крошки на главной странице
		'show_post_title' => true, // показывать ли название записи в конце (последний элемент). Для записей, страниц, вложений
		'sep'             => ' » ', // разделитель
	);
	
	// Фильтрует аргументы по умолчанию.
	$default_args = apply_filters('kama_breadcrumbs_default_args', $default_args );
	
	$loc  = (object) array_merge( $default_l10n, $l10n );
	$args = (object) array_merge( $default_args, $args );

	if( $sep === 0 ) $sep = $args->sep;

	$w1 = '<div class="kama_breadcrumbs" prefix="v: http://rdf.data-vocabulary.org/#">';
	$w2 = '</div>';
	$patt1 = '<span typeof="v:Breadcrumb"><a href="%s" rel="v:url" property="v:title">';
	$sep .= '</span>'; // закрываем span после разделителя!
	$linkpatt = $patt1.'%s</a>';
	
	
	// Вывод
	$pg_end = '';
	if( $paged = $wp_query->query_vars['paged'] ){
		$pg_patt = $patt1;
		$pg_end = '</a>'. $sep . sprintf( $loc->paged, $paged );
	}

	$out = '';
	if( is_front_page() ){
		return $args->on_front_page ? ( print $w1 .( $paged ? sprintf( $pg_patt, home_url() ) : '' ) . $loc->home . $pg_end . $w2 ) : '';
	}
	elseif( is_404() ){
		$out = $loc->_404; 
	}
	elseif( is_search() ){
		$out = sprintf( $loc->search, strip_tags( $GLOBALS['s'] ) );
	}
	elseif( is_author() ){
		$q_obj = &$wp_query->queried_object;
		$out = ( $paged ? sprintf( $pg_patt, get_author_posts_url( $q_obj->ID, $q_obj->user_nicename ) ):'') . sprintf( $loc->author, $q_obj->display_name ) . $pg_end;
	}
	elseif( is_year() || is_month() || is_day() ){
		$y_url  = get_year_link( $year=get_the_time('Y') );
		$m_url  = get_month_link( $year, get_the_time('m') );
		$y_link = sprintf( $linkpatt, $y_url, $year);
		$m_link = sprintf( $linkpatt, $m_url, get_the_time('F'));
		if( is_year() )
			$out = ( $paged?sprintf( $pg_patt, $y_url):'') . sprintf( $loc->year, $year ) . $pg_end;
		elseif( is_month() )
			$out = $y_link . $sep . ( $paged ? sprintf( $pg_patt, $m_url ) : '') . sprintf( $loc->month, get_the_time('F') ) . $pg_end;
		elseif( is_day() )
			$out = $y_link . $sep . $m_link . $sep . get_the_time('l');
	}

	// Страницы и древовидные типы записей
	elseif( is_singular() && $wp_post_types[ $post->post_type ]->hierarchical ){
		$parent = $post->post_parent;
		$crumbs = array();
		while( $parent ){
			$page = & get_post( $parent );
			$crumbs[] = sprintf( $linkpatt, get_permalink( $page->ID ), $page->post_title );
			$parent = $page->post_parent;
		}
		$crumbs = array_reverse( $crumbs );
		
		foreach( $crumbs as $crumb ) $out .= $crumb . $sep;
		
		$out = $out . ( $args->show_post_title ? $post->post_title : '');
	}
	// Таксономии, вложения и не древовидные типы записей
	else
	{
		// Определяем термины
		if( is_singular() ){
			if( ! $taxonomies ){
				$taxonomies = get_taxonomies( array('hierarchical' => true, 'public' => true) );
				if( count( $taxonomies ) == 1 ) $taxonomies = 'category';
			}
			if( $term = get_the_terms( $post->post_parent ? $post->post_parent : $post->ID, $taxonomies ) ){
				$term = array_shift( $term );
			}
		}
		else
			$term = $wp_query->get_queried_object();
		

		//if( ! $term && ! is_attachment() ) return print "Error: Taxonomy is not defined!"; 
		
		if( $term ){
			$term = apply_filters('kama_breadcrumbs_term', $term );
			
			$pg_term_start = ( $paged && $term->term_id ) ? sprintf( $pg_patt, get_term_link( (int) $term->term_id, $term->taxonomy ) ) : '';

			if( is_attachment() ){
				if( ! $post->post_parent )
					$out = sprintf( $loc->attachment, $post->post_title );
				else
					$out = __crumbs_tax( $term->term_id, $term->taxonomy, $sep, $linkpatt ) . sprintf( $linkpatt, get_permalink( $post->post_parent ), get_the_title( $post->post_parent ) ) . $sep . ( $args->show_post_title ? $post->post_title : '');
			}
			elseif( is_single() ){
				$out = __crumbs_tax( $term->parent, $term->taxonomy, $sep, $linkpatt ) . sprintf( $linkpatt, get_term_link( (int) $term->term_id, $term->taxonomy ), $term->name ). $sep . ( $args->show_post_title ? $post->post_title : '');
			// Метки, архивная страница типа записи, произвольные одноуровневые таксономии
			}
			elseif( ! is_taxonomy_hierarchical( $term->taxonomy ) ){
				// метка
				if( is_tag() )
					$out = $pg_term_start . sprintf( $loc->tag, $term->name ) . $pg_end;
				// таксономия
				elseif( is_tax() ){
					$post_label = $wp_post_types[ $post->post_type ]->labels->name;
					$tax_label = $GLOBALS['wp_taxonomies'][ $term->taxonomy ]->labels->name;
					$out = $pg_term_start . sprintf( $loc->tax_tag, $post_label, $tax_label, $term->name ) .  $pg_end;
				}
			}
			// Рубрики и таксономии
			else
				$out = __crumbs_tax( $term->parent, $term->taxonomy, $sep, $linkpatt ) . $pg_term_start . $term->name . $pg_end;
		}
	}

	// замена ссылки на архивную страницу для типа записи 
	$home_after = apply_filters('kama_breadcrumbs_home_after', false, $linkpatt, $sep );

	// ссылка на архивную страницу произвольно типа поста. Ссылку можно заменить с помощью хука 'kama_breadcrumbs_home_after'
	if( ! $home_after && isset( $post->post_type ) && ! in_array( $post->post_type, array('post','page','attachment') ) ){
		$pt_name = $wp_post_types[ $post->post_type ]->labels->name;
		$pt_url  = get_post_type_archive_link( $post->post_type );
		$home_after = ( is_post_type_archive() && ! $paged ) ? $pt_name : ( sprintf( $linkpatt, $pt_url, $pt_name ). ($pg_end?$pg_end:$sep) );
	}

	
	$home = sprintf( $linkpatt, home_url(), $loc->home ). $sep . $home_after;
	
	$out = $w1. $home . $out .$w2;

	return print apply_filters('kama_breadcrumbs', $out, $sep );
}
function __crumbs_tax( $term_id, $tax, $sep, $linkpatt ){
	$termlink = array();
	while( (int) $term_id ){
		$term2      = get_term( $term_id, $tax );
		$termlink[] = sprintf( $linkpatt, get_term_link( (int) $term2->term_id, $term2->taxonomy ), $term2->name ). $sep;
		$term_id    = (int) $term2->parent;
	}
	
	$termlinks = array_reverse( $termlink );
	
	return implode('', $termlinks );
}