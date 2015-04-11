<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<!--[if IE 7 ]><html class="ie ie7" lang="en"><![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"><![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="en"><!--<![endif]-->
<head>

    <!-- Basic Page Needs
    ================================================== -->
    <meta charset="utf-8">
    <title><?php echo ( isset($meta_title) ? $meta_title.' - ' : '' ) ?>云脉365</title>

    <!-- Mobile Specific
    ================================================== -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- CSS
    ================================================== -->
    <link rel="stylesheet" type="text/css" href="/Public/home/css/style.css" />
    <link rel="stylesheet" type="text/css" href="/Public/home/css/boxed.css" />
    <link rel="stylesheet" type="text/css" href="/Public/home/css/colors/green.css" />

    <!-- Java Script
    ================================================== -->
    <script type="text/javascript" src="/Public/home/js/jquery.min.js"></script>
    <script type="text/javascript" src="/Public/home/js/custom.js"></script>
    <script type="text/javascript" src="/Public/home/js/selectnav.js"></script>
    <script type="text/javascript" src="/Public/home/js/flexslider.js"></script>
    <script type="text/javascript" src="/Public/home/js/twitter.js"></script>
    <script type="text/javascript" src="/Public/home/js/tooltip.js"></script>
    <script type="text/javascript" src="/Public/home/js/effects.js"></script>
    <script type="text/javascript" src="/Public/home/js/fancybox.js"></script>
    <script type="text/javascript" src="/Public/home/js/carousel.js"></script>
    <script type="text/javascript" src="/Public/home/js/isotope.js"></script>


</head>
<body>

<!-- Wrapper Start -->
<div id="wrapper">


    <!-- Header
    ================================================== -->

    <!-- 960 Container -->
    <div class="container ie-dropdown-fix">

        <!-- Header -->
        <div id="header">

            <!-- Logo -->
            <div class="eight columns">
                <div id="logo">
                    <a href="#"><img src="/Public/home/images/logo.png" alt="logo" /></a>
                    <div id="tagline">It's time to impress your visitors!</div>
                    <div class="clear"></div>
                </div>
            </div>

            <!-- Social / Contact -->
            <div class="eight columns">

                <!-- Social Icons -->
                <ul class="social-icons">
                    <li class="facebook"><a href="#">Facebook</a></li>
                    <li class="twitter"><a href="#">Twitter</a></li>
                    <li class="dribbble"><a href="#">Dribbble</a></li>
                    <li class="linkedin"><a href="#">LinkedIn</a></li>
                    <li class="pintrest"><a href="#">Pintrest</a></li>
                </ul>

                <div class="clear"></div>

                <!-- Contact Details -->
                <div id="contact-details">
                    <ul>
                        <li><i class="mini-ico-envelope"></i><a href="mailto:services@yunmai365.com">services@yunmai365.com</a></li>
                        <li><i class="mini-ico-user"></i>+86-22-58654945</li>
                    </ul>
                </div>

            </div>

        </div>
        <!-- Header / End -->

        <!-- Navigation -->
        <div class="sixteen columns">

            <div id="navigation">
                <ul id="nav">

                    <li><a href="<?php echo U('Index/index')?>">首页</a></li>

                    <li><a href="#">企业简介</a>
                        <ul>
                            <li><a href="full_width.html">企业简介</a></li>
                            <li><a href="about.html">企业新闻</a></li>
                            <li><a href="services.html">企业产品</a></li>
                            <li><a href="pricing_tables.html">公司招聘</a></li>

                            <li><a href="#">联系我们</a>
                                <ul>
                                    <li><a href="sidebar_right.html">Sidebar Right</a></li>
                                    <li><a href="sidebar_left.html">Sidebar Left</a></li>
                                    <li><a href="blog_post.html">Single Post</a></li>
                                    <li><a href="single_project.html">Single Project</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>

                    <li><a href="shortcodes.html">企业新闻</a></li>

                    <li><a href="#">企业产品</a>
                        <ul>
                            <li><a href="portfolio_2.html">2 Columns</a></li>
                            <li><a href="portfolio_3.html">3 Columns</a></li>
                            <li><a href="portfolio_4.html">4 Columns</a></li>
                            <li><a href="single_project.html">Single Project</a></li>
                        </ul>
                    </li>

                    <li><a href="blog.html">公司招聘</a></li>
                    <li><a href="contact.html">联系我们</a></li>

                </ul>

                <!-- Search Form -->
                <div class="search-form">
                    <form method="get" action="#">
                        <input type="text" class="search-text-box" />
                    </form>
                </div>

            </div>
            <div class="clear"></div>

        </div>
        <!-- Navigation / End -->

    </div>
    <!-- 960 Container / End -->


    <!-- Content
    ================================================== -->

    <!-- 960 Container -->
    <div class="container">

    <!-- Flexslider -->
    <div class="sixteen columns">
        <section class="slider">
            <div class="flexslider home">
                <ul class="slides">

                    <li>
                        <img src="/Public/home/images/slider-img-01.jpg" alt="" />
                        <div class="slide-caption">
                            <h3>This is a caption</h3>
                            <p>Donec scelerisque aliquet mi, non venenatis urnas iaculis. Utea id nila ante. Cras est massa, interdum  ateal imperdiet etean, gravida eu quame. Aeneana volutpat hendrerit posuere.</p>
                        </div>
                    </li>

                    <li>
                        <img src="/Public/home/images/slider-img-02.jpg" alt="" />
                        <div class="slide-caption">
                            <h3>This is a caption</h3>
                            <p>Donec scelerisque aliquet mi, non venenatis urnas iaculis. Utea id nila ante. Cras est massa, interdum  ateal imperdiet etean, gravida eu quame. Aeneana volutpat hendrerit posuere.</p>
                        </div>
                    </li>

                    <li>
                        <img src="/Public/home/images/slider-img-03.jpg" alt="" />
                    </li>

                </ul>
            </div>
        </section>
    </div>
    <!-- Flexslider / End -->

</div>
<!-- 960 Container / End -->
<div class="copyrights">Collect from <a href="http://www.cssmoban.com/"  title="网站模板">网站模板</a></div>

<!-- 960 Container -->
<div class="container">

    <!-- Icon Boxes -->
    <div class="icon-box-container">

        <!-- Icon Box Start -->
        <div class="one-third column">
            <div class="icon-box">
                <i class="ico-display" style="margin-left: -10px;"></i>
                <h3>Fresh &amp; Clean Design</h3>
                <p>Proin iaculis purus consequat sem cure digni ssim. Donec porttitora entum suscipit aenean rhoncus posuere odio in tincidunt.</p>
            </div>
        </div>
        <!-- Icon Box End -->

        <!-- Icon Box Start -->
        <div class="one-third column">
            <div class="icon-box">
                <i class="ico-cogwheel"></i>
                <h3>Easily Customization</h3>
                <p>Nam aliquam volutpat leo vel bibendum nunc elit purus, tempus pulvinare rhoncus egestas nibh volutpat leo.</p>
            </div>
        </div>
        <!-- Icon Box End -->

        <!-- Icon Box Start -->
        <div class="one-third column">
            <div class="icon-box">
                <i class="ico-iphone"></i>
                <h3>Fully Responsive</h3>
                <p>Fusce porttitor turpis quis molestie costant equat. Nam purus, tincidunt sedeat dapibus ugravida ut dui. Fusce et magna libero.</p>
            </div>
        </div>
        <!-- Icon Box End -->

    </div>
    <!-- Icon Boxes / End -->

</div>
<!-- 960 Container / End -->

<!-- 960 Container -->
<div class="container">

    <div class="sixteen columns">
        <!-- Headline -->
        <div class="headline no-margin"><h3>Recent Work</h3></div>
    </div>

    <!-- Project -->
    <div class="four columns">
        <div class="picture"><a href="single_project.html"><img src="images/portfolio/portoflio-09.jpg" alt=""/><div class="image-overlay-link"></div></a></div>
        <div class="item-description">
            <h5><a href="#">Touch Gestures</a></h5>
            <p>Mauris sit amet ligula est, eget conseact etur lectus maecenas hendrerit suscipit.</p>
        </div>
    </div>

    <!-- Project -->
    <div class="four columns">
        <div class="picture"><a href="images/portfolio/portoflio-08-large.jpg" rel="image" title="Coffee Time"><img src="images/portfolio/portoflio-08.jpg" alt=""/><div class="image-overlay-zoom"></div></a></div>
        <div class="item-description">
            <h5><a href="#">Coffee Time</a></h5>
            <p>Amet sit lorem ligula est, eget conseact etur lectus hendrerit suscipit maecenas.</p>
        </div>
    </div>

    <!-- Project -->
    <div class="four columns">
        <div class="picture"><a href="single_project.html"><img src="images/portfolio/portoflio-10.jpg" alt=""/><div class="image-overlay-link"></div></a></div>
        <div class="item-description">
            <h5><a href="#">Surfing The Web</a></h5>
            <p>Lorem sit amet ligula est, eget conseact etur lectus maecenas hendrerit suscipit.</p>
        </div>
    </div>

    <!-- Project -->
    <div class="four columns">
        <div class="picture"><a href="single_project.html"><img src="images/portfolio/portoflio-07.jpg" alt=""/><div class="image-overlay-link"></div></a></div>
        <div class="item-description">
            <h5><a href="#">Wireless Keyboard</a></h5>
            <p>Ligula mauris sit amet est eget consat etur lectus maecenas hendrerit suscipit.</p>
        </div>
    </div>

</div>
<!-- 960 Container / End -->


<!-- 960 Container -->
<div class="container">
    <div class="sixteen columns">

        <!-- Headline -->
        <div class="headline no-margin"><h3>Our Clients</h3></div>

        <ul class="client-list">
            <li><img src="images/logo-01.png" alt=""/></li>
            <li><img src="images/logo-02.png" alt=""/></li>
            <li><img src="images/logo-03.png" alt=""/></li>
            <li><img src="images/logo-04.png" alt=""/></li>
            <li><img src="images/logo-05.png" alt=""/></li>
        </ul>

    </div>
</div>
    <!-- 960 Container / End -->

</div>
<!-- Wrapper / End -->


<!-- Footer
================================================== -->

<!-- Footer Start -->
<div id="footer">
    <!-- 960 Container -->
    <div class="container">

        <!-- About -->
        <div class="four columns">
            <div class="footer-headline"><h4>关于我们</h4></div>
            <p>Lorem sequat ipsum dolor lorem sit amet, consectetur adipiscing dolor elit. Aenean nisl orci, condimentum.</p>
            <p>Consectetur adipiscing elit aeneane lorem lipsum, condimentum ultrices consequat eu, vehicula mauris lipsum adipiscing lipsum aenean orci lorem.</p>
        </div>

        <!-- Useful Links -->
        <div class="four columns">
            <div class="footer-headline"><h4>Useful Links</h4></div>
            <ul class="links-list">
                <li><a href="#">Service Updates</a></li>
                <li><a href="#">Community Forum</a></li>
                <li><a href="#">Help Desk</a></li>
                <li><a href="#">Terms of Use</a></li>
                <li><a href="#">Validate License</a></li>
                <li><a href="#">Privacy Policy</a></li>
                <li><a href="#">Knowledgebase</a></li>
            </ul>
        </div>

        <!-- Photo Stream -->
        <div class="four columns">
            <div class="footer-headline"><h4>Photo Stream</h4></div>

        </div>

        <!-- Latest Tweets -->
        <div class="four columns">
            <div class="footer-headline"><h4>Latest Tweets</h4></div>

            <div class="clear"></div>
        </div>

        <!-- Footer / Bottom -->
        <div class="sixteen columns">
            <div id="footer-bottom">
                © Copyright 2014 Cloud Nexus 365. All rights reserved.
                <div id="scroll-top-top"><a href="#"></a></div>
            </div>
        </div>

    </div>
    <!-- 960 Container / End -->

</div>
<!-- Footer / End -->




</body>
</html>