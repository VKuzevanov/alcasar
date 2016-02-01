<?php
/**
 * The footer.php template for our theme
 *
 * @package WordPress
 * @subpackage pc-runa
 */
?>
</div>
        <div class="footer-wrap">
            <footer class="site-footer">
               <div class="dev-info">
                   <span>Разработка и дизайн сайта: 
                   </span>
                   <a class="dev-link
                   " href="#">ne-stndart.pro</a>
               </div> 
                   <span class="site-info">
                      © "<?php bloginfo('name'); ?> Официальный сайт. </br> Все права защищены. Краснодар, <?php echo date('Y'); ?> г.
               </span>
               <ul class="site-cont_list">
                  <li class="site-cont_item">
                       <a href="tel:+78612989898" class="site-cont_link tel-footer">
                           (861) 298-98-98
                       </a>
                   </li>
                   <li class="site-cont_item">
                       <a href="#" class="site-cont_link address-footer">
                           г. Краснодар, ул. 40 лет Победы, 34,  офис 704.
                       </a>
                   </li>
               </ul>
            </footer>
        </div>
        <div class="callback-btn">
            <a href="#callback" class="callback-link">Перезвонить Вам?</a>
        </div>
        <div class="popup-bg">
            <div id="close_popup"></div>
            <?php include 'popup-callback.php';?>
        </div>
       <!-- scripts after-->
        <?php wp_footer(); ?>                   
    </body>
</html>