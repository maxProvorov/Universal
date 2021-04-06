<?php
/*
Template Name: Страница контакты
Template Post Type: page
*/
get_header();?>

<section class="section-dark">
    <div class="container">
        <h1 class="page-title">Свяжитесь с нами</h1>
        <div class="contacts-wrapper">
            <div class="left">
                <h2 class="contacts-title">Через форму обратной связи</h2>
                <form action="#" class="contacts-form" method="POST">
                    <input name="contact_name" type="text" class="input contacts-input" placeholder="<?php _e( 'Your name' , 'universal')?>"> 
                    <input name="contact_email" type="email" class="input contacts-input" placeholder="<?php _e( 'Your email' , 'universal')?>">
                    <textarea name="contact_comment" id="" class="textarea contacts-textarea" placeholder="<?php _e( 'Your question' , 'universal')?>"></textarea>
                    <button type="submit" class="button more">Отправить</button>
                </form>
                <?php echo do_shortcode( '[contact-form-7 id="267" title="Контактная форма"]' ) ?>
            </div>
            <div class="right">
                <h2 class="contacts-title">Или по этим контактам</h2>               
                <a href="mailto: <?php the_field('email')?>" class=""> <?php the_field('email')?></a>  
                 <span><?php the_field('address');?></span>                 
                 <?php $phone = get_post_meta(get_the_ID(), 'phone', true);
                if($phone){echo '<a href= tel:"' . $phone . '" class="">' . $phone . '</a>';}    
                ?>
                
            </div>
        </div>
        <?php  ?>
    </div>
</section>

<?php get_footer();?>