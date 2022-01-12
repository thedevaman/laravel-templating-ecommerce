
<?php include('header.php'); ?>


<!-- Start Bradcaump area -->
        <div class="ht__bradcaump__area bg-image--24">
            <div class="ht__bradcaump__wrap d-flex align-items-center">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="bradcaump__inner text-center brad__white">
                                <h2 class="bradcaump-title">contact us</h2>
                                <nav class="bradcaump-inner">
                                  <a class="breadcrumb-item" href="index.html">Home</a>
                                  <span class="brd-separetor"><i class="zmdi zmdi-long-arrow-right"></i></span>
                                  <span class="breadcrumb-item active">contact us</span>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Bradcaump area --> 
        <!-- Start Contact Map -->
        <div class="contact__map__area">
            <div class="contact__map__wrapper">
                <div class="contact__map__left">
                    <div class="map__thumb">
                        <img src="images/banner/contact/1.jpg" alt="images">
                    </div>
                </div>
                <div class="contact__map__right">
                    <div class="htc__google__map">
                        <div class="map-contacts">
                            <div id="googlemap"><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d6060.591282620186!2d83.2112507259766!3d25.416552668328404!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x398e218166ffe0ab%3A0x74619c765f72f323!2sChahaniya%20Market!5e0!3m2!1sen!2sin!4v1612783495262!5m2!1sen!2sin" width="100%" height="100%" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Contact Map -->
        <!-- Start Address -->
        <div class="food__contact">
            <div class="food__contact__wrapper d-flex flex-wrap flex-lg-nowrap">
                <!-- Start Single Contact -->
                <div class="contact">
                    <div class="ct__icon">
                        <i class="zmdi zmdi-phone"></i>
                    </div>
                    <div class="ct__address">
                        <p><a href="tel:8181876566">+91-818-187-6566</a></p>
                        <p><a href="tel:9793053289">+91-979-305-3289</a></p>
                    </div>
                </div>
                <!-- End Single Contact -->
                <!-- Start Single Contact -->
                <div class="contact">
                    <div class="ct__icon">
                        <i class="zmdi zmdi-home"></i>
                    </div>
                    <div class="ct__address">
                        <p>Sakaldiha Road Chahniya <br>Chandauli</p>
                    </div>
                </div>
                <!-- End Single Contact -->
                <!-- Start Single Contact -->
                <div class="contact">
                    <div class="ct__icon">
                        <i class="zmdi zmdi-globe-alt"></i>
                    </div>
                    <div class="ct__address">
                        <p><a href="#">www.kashirestaurant.com</a></p>
                       <!--  <p><a href="#">Aahar@e-mail.com</a></p> -->
                    </div>
                </div>
                <!-- End Single Contact -->
            </div>
        </div>
        <!-- End Address -->
        <section class="food__contact__form bg--white section-padding--lg">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="contact__form__wrap">
                            <h2>Get In Touch With Kashi</h2>
                            <div class="contact__form__inner">
                                <form id="contact-form" action="mail.php" method="post">
                                    <div class="single-contact-form">
                                        <div class="contact-box name d-flex flex-wrap flex-md-nowrap flex-lg-nowrap justify-content-between">
                                            <input type="text" name="name" placeholder="Your Name">
                                            <input type="email" name="email" placeholder="E-mail">
                                            <input type="text" name="phone" placeholder="Phone">
                                        </div>
                                    </div>
                                    <div class="single-contact-form">
                                        <div class="contact-box message">
                                            <textarea name="message"  placeholder="Message*"></textarea>
                                        </div>
                                    </div>
                                    <div class="contact-btn">
                                        <button type="submit" class="food__btn">submit</button>
                                    </div>
                                </form>
                            </div>
                            <div class="form-output">
                                <p class="form-messege"></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <?php include('footer.php'); ?>