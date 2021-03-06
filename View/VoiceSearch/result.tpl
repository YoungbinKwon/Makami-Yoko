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
                <img src="<?php echo($results['image4'])?>" id="page-1-img" alt="Gallery">

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
                               

                                    <!-- gallery -->
                                    <section data-page-id="page-1" class="content content-gallery js-content">

                                          <header class="box box-green margin-b-20">
                                               <h2 class="box-text page-title-text"><img src="<?php echo($yoko_user['img'])?>" width=60><?php echo('The best course for ' . $user_info['name'] . ' '); ?><i class="wi wi-small-craft-advisory"></i></h2>
                                         </header>

                                         <div class="content-text content-text-gallery">
                                               <!-- <p>Credits go to <a rel="nofollow" href="http://unsplash.com">Unsplash</a> for images.</p> -->
                                               <table class="table" table-bordered>
                                                     <thread>
                                                          <tr>
                                                               <th>Date</th>
                                                               <th>Course name</th>
                                                               <th>Plan contents</th>
                                                               <th>Prefecture</th>
                                                               <th>Price</th>
                                                         </tr>
                                                   </thread>
                                                   <tbody>
                                                    <tr>
                                                         <th><?php echo(date('M,d (D)' ,strtotime($results['plan']['callInfo']['playDate']))) ?> <i class="wi wi-day-cloudy"></i></th>
                                                         <th><a  href="<?php echo('https://booking.gora.golf.rakuten.co.jp/guide/disp/c_id/' . $results['course']['Item']['golfCourseId']) ?>"><?php echo($results['course']['Item']['golfCourseName']) ?></a></th>
                                                         <th><a href="<?php echo('https://search.gora.golf.rakuten.co.jp//?menu=compe&act=detail&plan_id=' . $results['plan']['planId']) ?>"><?php echo($results['plan']['planName']) ?></a></th>
                                                         <th><?php echo(substr($results['course']['Item']['address'],0,9)) ?></th>
                                                         <th><?php echo(number_format($results['plan']['price']) . 'yen') ?></th>
                                                   </tr>
                                             </tbody>
                                       </table>
           <form action="/reserve/complete" method="post">
               <button type="submit" class="btn btn-success btn-lg center-block">Book NOW!</button>
               <input type="hidden" name="userid" id="userid" value="<?php echo($user_info['id']) ?>" />
           </form>
                                       <div class="flexslider-wrapper">

                                        <div id="slider" class="flexslider">
                                             <ul class="slides">
                                                  <li><img src="<?php echo($results['image1'])?>" alt="Slide 1" /></li>
                                                  <li><img src= "<?php echo($results['image2'])?>" /></li>
                                                  <li><img src="<?php echo($results['image3'])?>" /></li>
                                                  <li><img src="<?php echo($results['image4'])?>" /></li>
                                                  <li><img src="<?php echo($results['image5'])?>" /></li>
                                                  <li><img src="<?php echo($results['image6'])?>" /></li>
                                            </ul>
                                      </div> <!-- #slider -->

                                      <div id="carousel" class="flexslider">
                                       <ul class="slides">
                                           <li><img src="<?php echo($results['image1'])?>" alt="Thumbnail 1" /></li>
                                           <li><img src= "<?php echo($results['image2'])?>" alt="Thumbnail 2"/></li>
                                           <li><img src="<?php echo($results['image3'])?>" alt="Thumbnail 3"/></li>
                                           <li><img src="<?php echo($results['image4'])?>" alt="Thumbnail 4"/></li>
                                           <li><img src="<?php echo($results['image5'])?>" alt="Thumbnail 5"/></li>
                                           <li><img src="<?php echo($results['image6'])?>" /lt="Thumbnail 6"></li>
                                           
                                      </ul>
                                </div>  <!-- #carousel -->

                          </div>

                    </div>            

              </section> <!-- #gallery -->

            				</div>
            			</div>

            		</div>
            		<!-- footer row -->
            		<footer class="row footer js-footer">
            			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

            				<p class="copyright-text">Copyright &copy; Team B! 
            				</p>  

            			</div>                
            		</footer>

            	</div>  <!-- .container-fluid -->

<div id="audio"></div>
            	<div id="preloader">
            		<div id="status">&nbsp;</div>
            	</div><!-- /#preloader -->      

            	<!-- load JS files -->
            	<script src="/js/jquery-1.11.3.min.js"></script> <!-- jQuery -->
            	<script src="/js/jquery.flexslider-min.js"></script> <!-- Flex Slider -->
            	<script src="/js/jquery.backstretch.min.js"></script> <!-- Backstretch http://srobbin.com/jquery-plugins/backstretch/ -->
            	<script src="/js/templatemo-script.js"></script> <!-- Templatemo scripts -->
                     
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

            </body>

            </html>
