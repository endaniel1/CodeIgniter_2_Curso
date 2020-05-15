<?php //bloque php

$db = \Config\Database::connect(); //Cargamos la conexion a la BD
//Hacemos una consulta a la tabla posts
$query      = $db->query("SELECT * FROM posts WHERE show_home=1");
$resultpost = $query->getResult(); //Obtemos lo resultados de la consultaY Guardamos en una variable
//Hacemos otra consulta a la table categories
$query          = $db->query("SELECT * FROM categories");
$resultcategory = $query->getResult(); //Obtemos lo resultados de la consulta Y Guardamos en una variable
?>
   <!-- s-extra
    ================================================== -->
    <section class="s-extra">

        <div class="row">

            <div class="col-seven md-six tab-full popular">
                <h3>Post Populares</h3>
                <?php //Hacemos un foreach para obtener los resultados de los posts?>
                <?php foreach ($resultpost as $post): ?>
                <div class="block-1-2 block-m-full popular__posts">
                    <article class="col-block popular__post">
                        <a href="<?=base_url()?>/dashboard/post/<?=$post->slug?>/<?=$post->id?>" class="popular__thumb">
                            <img src="<?=base_url()?>/public/uploads/<?=$post->banner?>" alt="">
                        </a>
                        <h5><?=$post->title?></h5>
                        <section class="popular__meta">
                            <span class="popular__author"><span>By</span> <a href="#0">John Doe</a></span>
                            <span class="popular__date"><span>on</span> <time datetime="<?=$post->created_at?>"><?=date("d-m-Y", strtotime($post->created_at))?></time></span>
                        </section>
                    </article>
                </div> <!-- end popular_posts -->
                <?php endforeach?>
            </div> <!-- end popular -->

            <div class="col-four md-six tab-full end">
                <div class="row">
                    <div class="col-six md-six mob-full categories">
                        <h3>Categorias</h3>

                        <ul class="linklist">
                            <?php //Hacemos un foreach para obtener los resultados de las categorias ?>
                            <?php foreach ($resultcategory as $category): ?>
                            <li><a href="<?=base_url()?>/dashboard/category/<?=$category->id?> "><?=$category->name?></a></li>
                            <?php endforeach?>
                        </ul>
                    </div> <!-- end categories -->

                    <div class="col-six md-six mob-full sitelinks">
                        <h3>Site Links</h3>

                        <ul class="linklist">
                            <li><a href="<?=base_url()?>">Home</a></li>
                            <li><a href="<?=base_url()?>/dashboard/blog">Blog</a></li>
                        </ul>
                    </div> <!-- end sitelinks -->
                </div>
            </div>
        </div> <!-- end row -->

    </section> <!-- end s-extra -->


    <!-- s-footer
    ================================================== -->
    <footer class="s-footer">

        <div class="s-footer__main">
            <div class="row">

                <div class="col-six tab-full s-footer__about">

                    <h4>About Wordsmith</h4>

                    <p>Fugiat quas eveniet voluptatem natus. Placeat error temporibus magnam sunt optio aliquam. Ut ut occaecati placeat at.
                    Fuga fugit ea autem. Dignissimos voluptate repellat occaecati minima dignissimos mollitia consequatur.
                    Sit vel delectus amet officiis repudiandae est voluptatem. Tempora maxime provident nisi et fuga et enim exercitationem ipsam. Culpa error
                    temporibus magnam est voluptatem.</p>

                </div> <!-- end s-footer__about -->

                <div class="col-six tab-full s-footer__subscribe">

                    <h4>Our Newsletter</h4>

                    <p>Sit vel delectus amet officiis repudiandae est voluptatem. Tempora maxime provident nisi et fuga et enim exercitationem ipsam. Culpa consequatur occaecati.</p>

                    <div class="subscribe-form">
                        <form method="post" id="newsletter_form" class="group" novalidate="true">

                            <input type="email" value="" name="email" class="email" id="newsletter_input" placeholder="Email Address" required="">

                            <input type="button" id="enviar_newsletter" value="Enviar">

                            <label for="newsletter_input" class="subscribe-message"></label>

                        </form>
                    </div>

                </div> <!-- end s-footer__subscribe -->

            </div>
        </div> <!-- end s-footer__main -->

        <div class="s-footer__bottom">
            <div class="row">

                <div class="col-six">
                    <ul class="footer-social">
                        <li>
                            <a href="#0"><i class="fab fa-facebook"></i></a>
                        </li>
                        <li>
                            <a href="#0"><i class="fab fa-twitter"></i></a>
                        </li>
                        <li>
                            <a href="#0"><i class="fab fa-instagram"></i></a>
                        </li>
                        <li>
                            <a href="#0"><i class="fab fa-youtube"></i></a>
                        </li>
                        <li>
                            <a href="#0"><i class="fab fa-pinterest"></i></a>
                        </li>
                    </ul>
                </div>

                <div class="col-six">
                    <div class="s-footer__copyright">
                        <span><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                            Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        </span>
                    </div>
                </div>

            </div>
        </div> <!-- end s-footer__bottom -->

        <div class="go-top">
            <a class="smoothscroll" title="Back to Top" href="#top"></a>
        </div>

    </footer> <!-- end s-footer -->
    <?php //Vemos aqui si existe la vista uploadPost?>
    <?php if ($view != "uploadPost"): ?>
        <!-- Java Script
        ================================================== -->
        <script src="<?=base_url()?>/public/assets/js/jquery-3.2.1.min.js"></script>
        <script src="<?=base_url()?>/public/assets/js/plugins.js"></script>
        <script src="<?=base_url()?>/public/assets/js/main.js"></script>
    <?php endif?>
    <script type="text/javascript">
        var date=new Date();
        var fecha=date.getFullYear()+"-"+date.getMonth()+"-"+date.getDate()
        $("#newsletter_form").submit(function(e){
           e.preventDefault();
           envio_newsletter($("#newsletter_input").val());
        });
        $("#enviar_newsletter").click(function(e){
            envio_newsletter($("#newsletter_input").val());
        });
        function envio_newsletter(email) {
            $.post("<?=base_url()?>/dashboard/add_newsletter",{email:email,added_at:fecha}).done(function(data){
                $(".subscribe-message").text(data).css({
                    color: 'white',
                });
            });
        }
    </script>

</body>

</html>