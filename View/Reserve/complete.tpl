<!DOCTYPE html>
      <html lang="en">
      <head>
      	<meta charset="utf-8">
      	<meta http-equiv="X-UA-Compatible" content="IE=edge">
      	<meta name="viewport" content="width=device-width, initial-scale=1">

      	<title>Makami Yoko-chan</title>
      <!--
      The Story Theme
      http://www.templatemo.com/tm-480-story
-->
<!-- load stylesheets -->
<link href="https://fonts.googleapis.com/css?family=Bungee+Shade|Neucha|Sigmar+One|Basic" rel="stylesheet">
<link href="https://fonts.googleapis.com/earlyaccess/notosansjapanese.css" rel="stylesheet" />
<link rel="stylesheet" href="/css/bootstrap.min.css">                                                <!-- Bootstrap style -->
<link rel="stylesheet" href="/css/flexslider.css">                                                   <!-- Flexslider style -->       
<link rel="stylesheet" href="/css/templatemo-style.css">                                             <!-- Templatemo style -->
<link rel="stylesheet" href="/css/animations.css">                                             <!-- Animation style -->
<link rel="stylesheet" href="/css/weather-icons.min.css">
<!-- font list is here https://erikflowers.github.io/weather-icons/ -->

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
              <!--[if lt IE 9]>
                <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
                <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
                <![endif]-->
          </head>

          <body class="page">


           <!-- background images -->
           <div class="page-bg-imgs-list">
                <img src="/img/golf-1758094_960_720.jpg" id="page-1-img" class="main-img" alt="About">
                <img src="https://gora.golf.rakuten.co.jp/img/golf/80027/img/c1/01_01.jpg" id="page-2-img" alt="Gallery">
          </div>

          <div class="container-fluid">

                <div class="row">
                     <div class="col-xs-12 col-sm-12 col-md-12 col-lg-5 col-xl-5">

                          <div class="header">

                               <!-- site title -->
                               <header class="box box-darkgreen">
                                    <a href="javascript:void(0)" class="js-site-title">
                                         <h1 class="box-text site-title-text"><font face='Bungee Shade' size=16px >Makami Yoko-chan</font></h1>    
                                   </a>            
                             </header>

                              </div> <!-- .header -->

                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-7 col-xl-7">
                          <div class="content-wrapper js-content-wrapper">
                               <!-- about -->
                               <section data-page-id="page-1" class="content js-content">
<!--
            						<header class="box box-black margin-b-20">
                                                -->
                                                <header class="box box-green margin-b-20">
                                                     <h2 class="box-text page-title-text">Thank you for your reservation!</h2>
                                               </header>
                                               <div class="content-text chose-user">
                                                <div class="row">
                                                      <div class="margin-t-50 col-xs-3 user" width=100>
                                                            <img src="<?php echo($yoko_user['img'])?>" class="user-img margin-b-20" width=100>
                                                      </div>
                                                      <div class="margin-t-50 col-xs-3 user-info" width=400>
                                                            <canvas id="myCanvas" style="margin-left: 50px"></canvas>
                                                      </div>
                                                </div>
                                          </div>            

                                    </section> <!-- #about -->



                                    <!-- gallery -->
                                    <section data-page-id="page-2" class="content content-gallery js-content">

                                          <header class="box box-green margin-b-20">
                                               <h2 class="box-text page-title-text"><img src="/img/baby_1.png" width=60>The best course for Keisei <i class="wi wi-small-craft-advisory"></i></h2>
                                         </header>

                                         <div class="content-text content-text-gallery">
                                               <!-- <p>Credits go to <a rel="nofollow" href="http://unsplash.com">Unsplash</a> for images.</p> -->
                                               <table class="table" table-bordered>
                                                     <thread>
                                                          <tr>
                                                               <th>Date</th>
                                                               <th>Cource name</th>
                                                               <th>Plan contents</th>
                                                               <th>Start time</th>
                                                               <th>Price</th>
                                                         </tr>
                                                   </thread>
                                                   <tbody>
                                                    <tr>
                                                         <th>17th Mar (Fri) <i class="wi wi-day-cloudy"></i></th>
                                                         <th><a  href="https://gora.golf.rakuten.co.jp">island golf course</a></th>
                                                         <th><a href="https://gora.golf.rakuten.co.jp">Special plan</a></th>
                                                         <th>9:37</th>
                                                         <th>4,000yen</th>
                                                   </tr>
                                             </tbody>
                                       </table>
                                       <button type="button" class="btn btn-success btn-lg center-block">Book NOW!</button>

                                       <div class="flexslider-wrapper">

                                        <div id="slider" class="flexslider">
                                             <ul class="slides">
                                                  <li><img src="https://gora.golf.rakuten.co.jp/img/golf/80027/img/c0/01.jpg" alt="Slide 1" /></li>
                                                  <li><img src="https://gora.golf.rakuten.co.jp/img/golf/80027/img/c0/05.jpg" /></li>
                                                  <li><img src="https://gora.golf.rakuten.co.jp/img/golf/80027/img/c1/01_03.jpg" /></li>
                                                  <li><img src="https://gora.golf.rakuten.co.jp/img/golf/80027/img/c1/02_02.jpg" /></li>
                                                  <li><img src="https://gora.golf.rakuten.co.jp/img/golf/80027/img/c1/04_03.jpg" /></li>
                                                  <li><img src="https://gora.golf.rakuten.co.jp/img/golf/80027/img/c1/06_01.jpg" /></li>
                                            </ul>
                                      </div> <!-- #slider -->

                                      <div id="carousel" class="flexslider">
                                       <ul class="slides">
                                            <li><img src="https://gora.golf.rakuten.co.jp/img/golf/80027/img/c0/01.jpg" alt="Thumbnail 1" /></li>
                                            <li><img src="https://gora.golf.rakuten.co.jp/img/golf/80027/img/c0/05.jpg" alt="Thumbnail 2" /></li>
                                            <li><img src="https://gora.golf.rakuten.co.jp/img/golf/80027/img/c1/01_03.jpg" alt="Thumbnail 3" /></li>
                                            <li><img src="https://gora.golf.rakuten.co.jp/img/golf/80027/img/c1/02_02.jpg" alt="Thumbnail 4" /></li>
                                            <li><img src="https://gora.golf.rakuten.co.jp/img/golf/80027/img/c1/04_03.jpg" alt="Thumbnail 5" /></li>
                                            <li><img src="https://gora.golf.rakuten.co.jp/img/golf/80027/img/c1/06_01.jpg" alt="Thumbnail 6" /></li>
                                      </ul>
                                </div>  <!-- #carousel -->

                          </div>

                    </div>            

              </section> <!-- #gallery -->

            				</div>
            			</div>
<div id='audio'></div>
 
            		</div>
            		<!-- footer row -->
            		<footer class="row footer js-footer">
            			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

            				<p class="copyright-text">Copyright &copy; Team B! 
            				</p>  

            			</div>                
            		</footer>

            	</div>  <!-- .container-fluid -->

            	<div id="preloader">
            		<div id="status">&nbsp;</div>
            	</div><!-- /#preloader -->      
            	<!-- load JS files -->
            	<script src="/js/jquery-1.11.3.min.js"></script> <!-- jQuery -->
            	<script src="/js/jquery.flexslider-min.js"></script> <!-- Flex Slider -->
            	<script src="/js/jquery.backstretch.min.js"></script> <!-- Backstretch http://srobbin.com/jquery-plugins/backstretch/ -->
            	<script src="/js/templatemo-script.js"></script> <!-- Templatemo scripts -->
                <script type="text/javascript" src="/js/canvas.js"></script>

                  <script>
                    setTimeout(function() {
                        var audio = $("<audio autoplay></audio>", {
                                });
                        var source = $("<source>", {
                                "src" : "<?php echo $result_text; ?>",
                                "type" : "audio/wav"
                                    });
                        audio.append(source);
                        $('#audio').append(audio);
                    }, 1500);
                  </script>


                  <script>
                        mokoReserveDraw();
                        setTimeout(function(){
                            window.location.href = '/';
                        }, 6000);
                  </script>

            </body>
            </html>
