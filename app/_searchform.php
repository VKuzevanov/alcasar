<?php
/**
 * The searchform.php template for our theme
 *
 * @package WordPress
 * @subpackage pc-runa
 */
?>
<form method="get" action="<?php bloginfo('url'); ?>/" class="search">  

  <input type="search" value="<?php the_search_query(); ?>" placeholder="Поиск..." name="s" class="search__input" />
  <i class="search__icon fa fa-search"></i>
  <input type="submit" value="" class="search__submit" />

</form>
