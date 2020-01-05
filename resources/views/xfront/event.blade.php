@extends('layouts.front')

@section('main')
 



<body>

<div class="agenda">
  
 

  <!-- Home -->

  <div class="home">
    <div class="home_background parallax-window" data-parallax="scroll" data-image-src="/..media/event/event_01010.png"></div>
    <div class="home_content">
      <div class="home_title"></div>
    </div>
  </div>

  <!-- Blog -->

  <div class="blog">
    <div class="container">
      <div class="row">

        <!-- Blog Content -->

        <div class="col-lg-8">
          
          <div class="blog_post_container">

            <!-- Blog Post -->
       <?php foreach ($event as $key => $eve): ?>
            <div class="blog_post">
              <div class="blog_post_image">
                <img src="{{$eve->image}}" width="500px" height="250px">
                <div class="blog_post_date d-flex flex-column align-items-center justify-content-center">
                  <div class="blog_post_day"><?php echo "Today is"." | ".date('l')."<br/>"?></div>
                  <div class="blog_post_month">{{$eve->date_start}}</div>
                </div>
              </div>
              <div class="blog_post_meta">
                <ul>
                  <li class="blog_post_meta_item"><a href="">by Lore Papp</a></li>
                  <li class="blog_post_meta_item"><a href="">Uncategorized</a></li>
                  <li class="blog_post_meta_item"><a href="">3 Comments</a></li>
                </ul>
              </div>
              <div class="blog_post_title"><a href="#"><h2>{{$eve->nama}}</h2></a></div>
              <div class="blog_post_text">
                <p><?php echo $eve->description;?></p>
              </div>
              <div class="blog_post_link"><a href="#">read more</a></div>
             
            </div>

        <?php endforeach ?>
          </div>
        
          <div class="blog_navigation">
            <ul>
              <li class="blog_dot active"><div></div>01.</li>
              <li class="blog_dot"><div></div>02.</li>
              <li class="blog_dot"><div></div>03.</li>
            </ul>
          </div>
        </div>

        <!-- Blog Sidebar -->

        <div class="col-lg-4 sidebar_col">

          <!-- Sidebar Search -->
          <div class="sidebar_search">
            <form action="#">
              <input id="sidebar_search_input" type="search" class="sidebar_search_input" placeholder="" required="required">
              <button id="sidebar_search_button" type="submit" class="sidebar_search_button trans_300" value="Submit">
                <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                width="17px" height="17px" viewBox="0 0 512 512" enable-background="new 0 0 512 512" xml:space="preserve">
                  <g>
                    <g>
                      <g>
                        <path class="mag_glass" fill="#FFFFFF" d="M78.438,216.78c0,57.906,22.55,112.343,63.493,153.287c40.945,40.944,95.383,63.494,153.287,63.494
                        s112.344-22.55,153.287-63.494C489.451,329.123,512,274.686,512,216.78c0-57.904-22.549-112.342-63.494-153.286
                        C407.563,22.549,353.124,0,295.219,0c-57.904,0-112.342,22.549-153.287,63.494C100.988,104.438,78.439,158.876,78.438,216.78z
                        M119.804,216.78c0-96.725,78.69-175.416,175.415-175.416s175.418,78.691,175.418,175.416
                        c0,96.725-78.691,175.416-175.416,175.416C198.495,392.195,119.804,313.505,119.804,216.78z"/>
                      </g>
                    </g>
                    <g>
                      <g>
                        <path class="mag_glass" fill="#FFFFFF" d="M6.057,505.942c4.038,4.039,9.332,6.058,14.625,6.058s10.587-2.019,14.625-6.058L171.268,369.98
                        c8.076-8.076,8.076-21.172,0-29.248c-8.076-8.078-21.172-8.078-29.249,0L6.057,476.693
                        C-2.019,484.77-2.019,497.865,6.057,505.942z"/>
                      </g>
                    </g>
                  </g>
                </svg>
              </button>
            </form>
          </div>
          
          <!-- Sidebar Archives -->
          <div class="sidebar_archives">
            <div class="sidebar_title">Archives</div>
            <div class="sidebar_list">
              <ul>
                <li><a href="#">March 2017</a></li>
                <li><a href="#">April 2017</a></li>
                <li><a href="#">May 2017</a></li>
              </ul>
            </div>
          </div>
          
          <!-- Sidebar Archives -->
          <div class="sidebar_categories">
            <div class="sidebar_title">Categories</div>
            <div class="sidebar_list">
              <ul>
                <li><a href="#">Travel</a></li>
                <li><a href="#">Exotic Destinations</a></li>
                <li><a href="#">City Breaks</a></li>
                <li><a href="#">Travel Tips</a></li>
                <li><a href="#">Lifestyle & Travel</a></li>
                <li><a href="#">City Breaks</a></li>
                <li><a href="#">Uncategorized</a></li>
              </ul>
            </div>
          </div>

          <!-- Sidebar Latest Posts -->

          <div class="sidebar_latest_posts">
            <div class="sidebar_title">Latest Posts</div>
            <div class="latest_posts_container">
              <ul>

                <!-- Latest Post -->
                <li class="latest_post clearfix">
                  <div class="latest_post_image">
                    <a href="#"><img src="images/latest_1.jpg" alt=""></a>
                  </div>
                  <div class="latest_post_content">
                    <div class="latest_post_title trans_200"><a href="#">A simple blog post</a></div>
                    <div class="latest_post_meta">
                      <div class="latest_post_author trans_200"><a href="#">by Jane Smith</a></div>
                      <div class="latest_post_date trans_200"><a href="#">Aug 25, 2016</a></div>
                    </div>
                  </div>
                </li>

                <!-- Latest Post -->
                <li class="latest_post clearfix">
                  <div class="latest_post_image">
                    <a href="#"><img src="images/latest_2.jpg" alt=""></a>
                  </div>
                  <div class="latest_post_content">
                    <div class="latest_post_title trans_200"><a href="#">Dream destination for you</a></div>
                    <div class="latest_post_meta">
                      <div class="latest_post_author trans_200"><a href="#">by Jane Smith</a></div>
                      <div class="latest_post_date trans_200"><a href="#">Aug 25, 2016</a></div>
                    </div>
                  </div>
                </li>

                <!-- Latest Post -->
                <li class="latest_post clearfix">
                  <div class="latest_post_image">
                    <a href="#"><img src="images/latest_3.jpg" alt=""></a>
                  </div>
                  <div class="latest_post_content">
                    <div class="latest_post_title trans_200"><a href="#">Tips to travel light</a></div>
                    <div class="latest_post_meta">
                      <div class="latest_post_author trans_200"><a href="#">by Jane Smith</a></div>
                      <div class="latest_post_date trans_200"><a href="#">Aug 25, 2016</a></div>
                    </div>
                  </div>
                </li>

                <!-- Latest Post -->
                <li class="latest_post clearfix">
                  <div class="latest_post_image">
                    <a href="#"><img src="images/latest_4.jpg" alt=""></a>
                  </div>
                  <div class="latest_post_content">
                    <div class="latest_post_title trans_200"><a href="#">How to pick your vacation</a></div>
                    <div class="latest_post_meta">
                      <div class="latest_post_author trans_200"><a href="#">by Jane Smith</a></div>
                      <div class="latest_post_date trans_200"><a href="#">Aug 25, 2016</a></div>
                    </div>
                  </div>
                </li>

              </ul>
            </div>
          </div>

        
        </div>
      </div>
    </div>
  </div>

  <!-- Footer -->

  <footer class="footer">
    <div class="container">
      <div class="row">

        <!-- Footer Column -->
        <div class="col-lg-3 footer_column">
          <div class="footer_col">
            <div class="footer_content footer_about">
              <div class="logo_container footer_logo">
                <div class="logo"><a href="#"><img src="images/logo.png" alt="">travelix</a></div>
              </div>
              <p class="footer_about_text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus quis vu lputate eros, iaculis consequat nisl. Nunc et suscipit urna. Integer eleme ntum orci eu vehicula pretium.</p>
              <ul class="footer_social_list">
                <li class="footer_social_item"><a href="#"><i class="fa fa-pinterest"></i></a></li>
                <li class="footer_social_item"><a href="#"><i class="fa fa-facebook-f"></i></a></li>
                <li class="footer_social_item"><a href="#"><i class="fa fa-twitter"></i></a></li>
                <li class="footer_social_item"><a href="#"><i class="fa fa-dribbble"></i></a></li>
                <li class="footer_social_item"><a href="#"><i class="fa fa-behance"></i></a></li>
              </ul>
            </div>
          </div>
        </div>

        <!-- Footer Column -->
        <div class="col-lg-3 footer_column">
          <div class="footer_col">
            <div class="footer_title">blog posts</div>
            <div class="footer_content footer_blog">
              
              <!-- Footer blog item -->
              <div class="footer_blog_item clearfix">
                <div class="footer_blog_image"><img src="images/footer_blog_1.jpg" alt="https://unsplash.com/@avidenov"></div>
                <div class="footer_blog_content">
                  <div class="footer_blog_title"><a href="blog.html">Travel with us this year</a></div>
                  <div class="footer_blog_date">Nov 29, 2017</div>
                </div>
              </div>
              
              <!-- Footer blog item -->
              <div class="footer_blog_item clearfix">
                <div class="footer_blog_image"><img src="images/footer_blog_2.jpg" alt="https://unsplash.com/@deannaritchie"></div>
                <div class="footer_blog_content">
                  <div class="footer_blog_title"><a href="blog.html">New destinations for you</a></div>
                  <div class="footer_blog_date">Nov 29, 2017</div>
                </div>
              </div>

              <!-- Footer blog item -->
              <div class="footer_blog_item clearfix">
                <div class="footer_blog_image"><img src="images/footer_blog_3.jpg" alt="https://unsplash.com/@bergeryap87"></div>
                <div class="footer_blog_content">
                  <div class="footer_blog_title"><a href="blog.html">Travel with us this year</a></div>
                  <div class="footer_blog_date">Nov 29, 2017</div>
                </div>
              </div>

            </div>
          </div>
        </div>

        <!-- Footer Column -->
        <div class="col-lg-3 footer_column">
          <div class="footer_col">
            <div class="footer_title">tags</div>
            <div class="footer_content footer_tags">
              <ul class="tags_list clearfix">
                <li class="tag_item"><a href="#">design</a></li>
                <li class="tag_item"><a href="#">fashion</a></li>
                <li class="tag_item"><a href="#">music</a></li>
                <li class="tag_item"><a href="#">video</a></li>
                <li class="tag_item"><a href="#">party</a></li>
                <li class="tag_item"><a href="#">photography</a></li>
                <li class="tag_item"><a href="#">adventure</a></li>
                <li class="tag_item"><a href="#">travel</a></li>
              </ul>
            </div>
          </div>
        </div>

        <!-- Footer Column -->
        <div class="col-lg-3 footer_column">
          <div class="footer_col">
            <div class="footer_title">contact info</div>
            <div class="footer_content footer_contact">
              <ul class="contact_info_list">
                <li class="contact_info_item d-flex flex-row">
                  <div><div class="contact_info_icon"><img src="images/placeholder.svg" alt=""></div></div>
                  <div class="contact_info_text">4127 Raoul Wallenber 45b-c Gibraltar</div>
                </li>
                <li class="contact_info_item d-flex flex-row">
                  <div><div class="contact_info_icon"><img src="images/phone-call.svg" alt=""></div></div>
                  <div class="contact_info_text">2556-808-8613</div>
                </li>
                <li class="contact_info_item d-flex flex-row">
                  <div><div class="contact_info_icon"><img src="images/message.svg" alt=""></div></div>
                  <div class="contact_info_text"><a href="mailto:contactme@gmail.com?Subject=Hello" target="_top">contactme@gmail.com</a></div>
                </li>
                <li class="contact_info_item d-flex flex-row">
                  <div><div class="contact_info_icon"><img src="images/planet-earth.svg" alt=""></div></div>
                  <div class="contact_info_text"><a href="https://colorlib.com">www.colorlib.com</a></div>
                </li>
              </ul>
            </div>
          </div>
        </div>

      </div>
    </div>
  </footer>

  <!-- Copyright -->

  <div class="copyright">
    <div class="container">
      <div class="row">
        <div class="col-lg-3 order-lg-1 order-2  ">
          <div class="copyright_content d-flex flex-row align-items-center">
            <div><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></div>
          </div>
        </div>
        <div class="col-lg-9 order-lg-2 order-1">
          <div class="footer_nav_container d-flex flex-row align-items-center justify-content-lg-end">
            <div class="footer_nav">
              <ul class="footer_nav_list">
                <li class="footer_nav_item"><a href="index.html">home</a></li>
                <li class="footer_nav_item"><a href="about.html">about us</a></li>
                <li class="footer_nav_item"><a href="offers.html">offers</a></li>
                <li class="footer_nav_item"><a href="#">news</a></li>
                <li class="footer_nav_item"><a href="contact.html">contact</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>

<script src="js/jquery-3.2.1.min.js"></script>
<script src="styles/bootstrap4/popper.js"></script>
<script src="styles/bootstrap4/bootstrap.min.js"></script>
<script src="plugins/colorbox/jquery.colorbox-min.js"></script>
<script src="plugins/parallax-js-master/parallax.min.js"></script>
<script src="js/blog_custom.js"></script>

</body>

</html>


@endsection
@push('js')
@endpush