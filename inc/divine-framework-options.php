<?php  
function divine_salon_logo(){
   $logo = get_custom_logo(); 
    if( !empty($logo) ){
        the_custom_logo();
       }else{ ?> 
      <a class="logo-text" href="<?php echo esc_url( home_url( '/' ) ); ?>"><span><?php bloginfo( 'name' ); ?></span></a>
   <?php } 
}   
// copyright text
function divine_salon_copyright_text(){
    $copy_text = get_theme_mod( 'v_copyright_text' );
    if(!empty($copy_text)){
    ?>
        <p><?php echo esc_html($copy_text); ?></p>
    <?php
    }else{
        $url2 =  esc_url('https://digitalcenturysf.com/templates/'); 
        $text =  esc_html__('Copyright &copy; 2018 ','divine-salon');
        $text2 =  get_bloginfo('name');
        $text3 =  ' |';
        $text4 = $text.$text2.$text3;
        $text5 =  esc_html__('WordPress Themes','divine-salon');
        printf( '<p>%s Powered by <a class="credits" href="%s">%s</a></p>', esc_html($text4), esc_url($url2), esc_html($text5) );
    }

}        
