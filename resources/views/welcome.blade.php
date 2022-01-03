<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Health Record Management and Inventory System </title>
    <!-- custom css -->
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="{{asset('css/responsive.css')}}">
    <link rel="stylesheet" href="{{asset('css/utility.css')}}">
    <!-- font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="icon" href="{{asset('custom-img/logo.png')}}">
    <link rel="stylesheet" href="{{URL:: asset('slick-1.8.1/slick/slick-theme.css')}}">
    <link rel="stylesheet" href="{{URL:: asset('slick-1.8.1/slick/slick.css')}}">
</head>
<body>
    <!-- header -->
    <header>
        <div class="header-top-info">
             <div class="row container">
                 <div>
                     <p class="text" style="margin-right: 1rem;">Pangasinan State University </p>
                        <span><i class="fas fa-map-marker-alt"></i> Alaminos City, Pangasinan, Philippines</span>
                     <span><i class="fas fa-envelope"></i>prpio@psu.edu.ph</span>
                     </div>
             
                    <div> 
                        @if (Route::has('login'))
                            @auth
                                <a href="{{ url('/dashboard') }}" type="button" class="btn login-btn">Dashboard</a>
                            @else
                                <a href="{{ route('login') }}" type="button" class="btn login-btn">LOGIN</a>
                            @endauth
                        @endif
                    </div>
            </div>
        </div>

        <nav class="navbar">
            <div class="row container">
                <a href="#" class="navbar-brand">
                <img src="{{asset('custom-img/logo.png')}}" alt="Pangasinan State University logo">
                <span>Pangasinan State University</span>
                </a>    
                <button type="button" class="navbar-show-btn">
                    <i class="fas fa-bars"></i>
                </button>            
            </div>

            <div class="navbar-collapse">
                <button class="navbar-hide-btn" type="button">
                    <i class="fas fa-times"></i>
                </button>
                <ul class="navbar-nav">
                    <li><a href="#home">Home</a></li>
                    <li><a href="#about">About</a></li>
                </ul>
            </div>
        </nav>

        <div class="hero-content">
            <div class="container">
                <div class="hero-slider">
                    <!-- items -->
                    <div class="hero-slider-item">
                        <h1 class="hero-title">Educating Students for success</h1>
                        <p class="text">Pangasinan State University are being held as one of trusted and choice HEI's in Western Pangasinan.
                            Making sure that the Vision, Mission and Quality Policy will be aligned in educating and making students to be professionals.
                        </p>
                        <a href="#home" class="hero-btn">Learn More</a>
                    </div>
                    <!-- end of item -->
                    <!-- items -->
                    <div class="hero-slider-item">
                        <h1 class="hero-title">Together with the students, we make difference</h1>
                        <p class="text">With the collaboration of the students and faculties, anything can be done easily.  </p>
                        <a href="#about" class="hero-btn">Learn More</a>
                    </div>
                    <!-- end of item -->
                </div>
            </div>
        </div>
    </header>
    <!-- end of header -->

    <!-- why section -->
    <section class="why" id="home">
        <div class="container">
            <div class="title title-md">
                <h3>Why Choose PSU-ACC?</h3>
                <div class="line"></div>
            </div>
            <p class="text">PSU - ACC is one of HEI's choice in Western Pangasinan because of
                <strong>Pangasinan State University</strong> brand of quality education</p>

            <div class="row">
                <div class="item">
                    <img src="{{asset('custom-img/why-img-1.png')}}" alt="">
                    <h3 class="lg-text">Producer of Professionals</h3>
                    <p class="text">The university was recognized as one of the Top Performing State Univerities and Colleges in the country by AACCUP.</p>
                </div>
                <div class="item">
                    <img src="{{asset('custom-img/why-img-2.png')}}" alt="">
                    <h3 class="lg-text">Support Students</h3>
                    <p class="text">In this time of pandemic, students have much more problems at home; therefore, staff of PSU - ACC have launched a bayanihan to assist those students in need.
                    </p>
                </div>
                <div class="item">
                    <img src="{{asset('custom-img/why-img-3.png')}}" alt="">
                    <h3 class="lg-text">Home of Topnotch Researchers</h3>
                    <p class="text">PSU - ACC faculty research has reached a new level, as other faculties publish their research papers at national and worldwide conferences.</p>
                </div>
            </div>
        </div>
    </section>
    <!-- end of why section -->

    <!-- skill section -->
    <section class="skill" id="about">
        <div class="container">
            <div class="title title-md">
                <h3>PSU - Alaminos City Campus</h3>
                <div class="line"></div>
            </div>
            <div class="row">
                <div>
                    <div class="title title-sm">
                        <h3>Home of Health and Wellness</h3>
                    </div>
                    <p class="text">Exercising is one of the practice in Alaminos City Campus. Making a relaxing workplace, PSU-ACC is renowed for its PSU ACCelerate.</p>
                    <p class="text">Yoga, Zumba and other activities are help for employees to be relaxed in this time of pandemic. </p>
                </div>

                <div>
                    <div class="img-container">
                        <img src="custom-img/health-scaled.jpg" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end of skill section -->

    <!-- footer -->
    <footer>
        <div class="row container">
            <div>
                <img src="custom-img/logo.png" alt="">
                <p class="text">Pangasinan State University, 
                    commonly referred to as PSU is a state university in the Philippines notable for its many locations 
                    throughout the province of Pangasinan. It is mandated to provide advanced instruction in the arts, 
                    agricultural and natural sciences as well as in technological and professional fields. 
                    Its main campus is located in Lingayen, Pangasinan.
                    Other campuses are located in Alaminos City, Asingan, 
                    Bayambang, Binmaley, Infanta, San Carlos City, Santa Maria, and Urdaneta City. </p>
                <ul class="footer-social-links">
                    <li class="flex">
                        <a href="https://www.facebook.com/psualaminos"><i class="fab fa-facebook-f"></i></a>
                    </li>
                </ul>
            </div>

            <div>
                <h3 class="lg-text">PSU - Alaminos Courses</h3>
                <div class="footer-links">
                    <a href="#">Business Administration</a>
                    <a href="#">Information Technology</a>
                    <a href="#">Hospitality Management</a>
                    <a href="#">Secondary Education</a>
                </div>
            </div>

            <div>
                <h3 class="lg-text">Pangasinan State University - Main Campus </h3>
                <div class="footer-contact-info">
                    <div>
                        <span><i class="fas fa-map-marker-alt"></i></span>
                        <span>Lingayen, Pangasinan, Philippines</span>
                    </div>

                    <div>
                        <span><i class="fas fa-paper-plane"></i></span>
                        <span>psu.edu.ph</span>
                    </div>
                </div>
            </div>
        </div>
        <p class="footer-text">Copyright &copy; 2021</p>
    </footer>
    <!-- end of footer -->
    <!-- jquery cdn -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- slick js -->
    <script src="{{asset ('../slick-1.8.1/slick/slick.js') }}"></script>
    <!-- cutom js -->
    <script src="{{asset('../js/jscript.js')}}"></script>

    <script>
        var botmanWidget = {
            aboutText: 'Write Something',
            introMessage: "Say Hi ✋ to start conversation! ",
            title: "Chat Bot",
            mainColor: '#ffda27',
            };
    </script>
    <script src='https://cdn.jsdelivr.net/npm/botman-web-widget@0/build/js/widget.js'></script>
</body>
</html>