<header class="header" id="header">

<div class="top-nav">

    <div class="container custom-container h-100">

        <div class="nav-content">

            <div class="content-pull">

                <div class="nav-toggler mobile-item panel-responsive-btn panel-responsive-open" data-target="mobile-menu-wrapper">

                    <svg height="384pt" viewBox="0 -53 384 384" width="384pt" xmlns="http://www.w3.org/2000/svg"><path d="m368 154.667969h-352c-8.832031 0-16-7.167969-16-16s7.167969-16 16-16h352c8.832031 0 16 7.167969 16 16s-7.167969 16-16 16zm0 0"></path><path d="m368 32h-352c-8.832031 0-16-7.167969-16-16s7.167969-16 16-16h352c8.832031 0 16 7.167969 16 16s-7.167969 16-16 16zm0 0"></path><path d="m368 277.332031h-352c-8.832031 0-16-7.167969-16-16s7.167969-16 16-16h352c8.832031 0 16 7.167969 16 16s-7.167969 16-16 16zm0 0"></path></svg>

                </div>

                <div class="nav-logo">

                    <a class="d-block" href="index.html">

                        <img class="img-fluid" src="{{asset('img/logo.svg')}}" alt="GrandUp">

                    </a>

                </div>

                <ul class="nav-list " id="navList">

                    <li class="list-item">

                        <a class="item-link hvr-underline-from-right" href="{{route('welcome')}}">الرئيسية</a>

                    </li>
                    <li class="list-item">

                        <a class="item-link hvr-underline-from-right" href="{{route('allstores')}}">المتاجر</a>

                    </li>
                    <li class="list-item">

                        <a class="item-link hvr-underline-from-right" href="{{route('about')}}">من نحن</a>

                    </li>
                    <li class="list-item">

                        <a class="item-link hvr-underline-from-right" href="{{route('contact')}}">إتصل بنا</a>

                    </li>
                    <li class="list-item">

                        <a class="item-link hvr-underline-from-right" href="{{route('search')}}">بحث</a>

                    </li>

                </ul>

            </div>

            <div class="content-pull">

                <div class="nav-additionals">

                    @guest
                    <div class="sign-btns">

                        <a class="sign-btn sign-in " href="{{ route('login') }}">تسجيل الدخول</a>

                        <a class="sign-btn sign-up " href="{{ route('register') }}">انضم الينا</a>

                    </div>
                    @else
                    <div class="user-logined ">

                        <a class="action-btn notfy-btn active" href="notifications.html">

                            <span class="icon">

                                <svg id="noun_notification_3187825" xmlns="http://www.w3.org/2000/svg" width="23.831" height="27.911" viewBox="0 0 23.831 27.911" style="stroke: none;"> <g id="Group_11766" data-name="Group 11766" transform="translate(0 0)"><path id="Path_4037" data-name="Path 4037" d="M24.643,18.919l-.355-.363a4.7,4.7,0,0,1-1.32-2.931l-.4-5.377a7.747,7.747,0,0,0-6.729-7.322v-1a.911.911,0,1,0-1.821,0v1a7.737,7.737,0,0,0-6.729,7.3l-.4,5.4a4.7,4.7,0,0,1-1.32,2.931l-.355.363A4.233,4.233,0,0,0,4,21.9v.5a2.762,2.762,0,0,0,2.732,2.791h4.553a3.643,3.643,0,1,0,7.285,0h4.553A2.762,2.762,0,0,0,25.854,22.4v-.5A4.233,4.233,0,0,0,24.643,18.919ZM14.927,27.05a1.841,1.841,0,0,1-1.821-1.861h3.642A1.841,1.841,0,0,1,14.927,27.05ZM24.033,22.4a.921.921,0,0,1-.911.93H6.732a.921.921,0,0,1-.911-.93v-.5A2.371,2.371,0,0,1,6.5,20.23l.355-.363a6.577,6.577,0,0,0,1.821-4.112L9.108,10.3a5.822,5.822,0,0,1,11.637,0l.4,5.4a6.577,6.577,0,0,0,1.821,4.112l.355.363a2.37,2.37,0,0,1,.71,1.721Z" transform="translate(-2.989 -1)"></path></g></svg>
                            </span>

                            <span class="text">الاشعارات</span>

                        </a>

                        <a class="action-btn cart-btn " href="cart.html">

                            <span class="icon">

                                <svg xmlns="http://www.w3.org/2000/svg" width="21.5" height="21.5" viewBox="0 0 21.5 21.5"><path id="Path_4843" data-name="Path 4843" d="M394,733.5a1.5,1.5,0,1,1-1.5-1.5A1.5,1.5,0,0,1,394,733.5Z" transform="translate(-384.25 -714.25)" fill="none"  stroke-width="1.5"></path><path id="Path_4844" data-name="Path 4844" d="M403,733.5a1.5,1.5,0,1,1-1.5-1.5A1.5,1.5,0,0,1,403,733.5Z" transform="translate(-384.25 -714.25)" fill="none" stroke-width="1.5"></path><path id="Path_4846" data-name="Path 4846" d="M389,717h12a4,4,0,0,1,4,4v5a4,4,0,0,1-4,4h-8a4,4,0,0,1-4-4Zm0,0a2,2,0,0,0-2-2h-2" transform="translate(-384.25 -714.25)" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"></path></svg>

                            </span>
                            <span class="text">السلة</span>


                        </a>

                        <a class="user-account" href="dashboard">

                            <div class="user-img">

                                <img class="img-fluid" src="{{asset('img/user.svg')}}" alt="userName">

                            </div>
                            <div class="user-info">

                                <p class="user-name">محمد احمد</p>
                                <p class="user-points">

                                    <span>1982</span> نقطة

                                </p>
                            </div>

                        </a>

                    </div>
                    @endguest


                </div>

            </div>

        </div>

    </div>

</div>

<div class="bottom-nav">

    <div class="container custom-container h-100">


        <ul class="bottom-nav-ul draggable-list scroll-list">

            <li class="list-item">

                <a class="item-link" href="{{route('offer')}}">العروض</a>

            </li>

            @foreach ($cats as $category)
            <li class="list-item">
                <a class="item-link" href="{{route('category',$category->id)}}"> {{$category->title}}</a>
            </li>
            @endforeach
           
           

            <li class="list-item">
                <a class="item-link" href="category.html">المزيد</a>
            </li>


        </ul>



    </div>

</div>

<div class="mobile-menu-wrapper panel-responsive-item noScroll">

    <div class="mobile-menu-container tabs-content-area">

        <div class="mobile-search">

            <input type="text" class="form-control" placeholder="ابحث عما تريد ">
            <button type="submit">
                <i class="fas fa-search"></i>	
            </button>
        </div>

        <div class="mobile-nav-tabs">

            <div class="mobile-tab tab-btn active" data-target="mobile-main-menu">
                القائمة
            </div>
            <div class="mobile-tab tab-btn" data-target="mobile-categories-menu">
                الأقسام
            </div>

        </div>

        <div class="mobile-menu-tabs-content">

            <div class="mobile-menu-tab-pane tab-content mobile-main-menu active">

                <ul class="mobile-menu">

                    <li class="mobile-menu-item">

                        <a class="mobile-menu-link" href="index.html">الرئيسية</a>


                    </li>
                    <li class="mobile-menu-item d-none">

                        <a class="mobile-menu-link" href="dashboard-home.html">حسابي</a>


                    </li>
                    <li class="mobile-menu-item">

                        <a class="mobile-menu-link" href="all-stores.html">المتاجر</a>


                    </li>
                    <li class="mobile-menu-item">

                        <a class="mobile-menu-link" href="offers.html">العروض</a>


                    </li>

                    <li class="mobile-menu-item">

                        <a class="mobile-menu-link" href="about.html">من نحن</a>


                    </li>

                    <li class="mobile-menu-item">

                        <a class="mobile-menu-link" href="contact.html">إتصل بنا</a>


                    </li>

                    <li class="mobile-menu-item d-none">

                        <a class="mobile-menu-link" href="sign-up.html">

                            <i class="fa-solid fa-user-plus"></i> انضم الينا

                        </a>


                    </li>
                    <li class="mobile-menu-item ">

                        <a class="mobile-menu-link" href="#" data-target="logout">

                            <i class="fa-solid fa-right-from-bracket"></i> تسجيل خروج

                        </a>


                    </li>




                </ul>

            </div>
            <div class="mobile-menu-tab-pane tab-content mobile-categories-menu">

                <ul class="mobile-menu">


                    <li class="mobile-menu-item">

                        <a class="mobile-menu-link" href="category.html">التلفزيونات</a>


                    </li>
                    <li class="mobile-menu-item">

                        <a class="mobile-menu-link" href="category.html">الاجهزة الصوتية</a>


                    </li>
                    <li class="mobile-menu-item">

                        <a class="mobile-menu-link" href="category.html">الاجهزة الكهربائية</a>


                    </li>
                    <li class="mobile-menu-item">

                        <a class="mobile-menu-link" href="category.html">الكترونيات</a>


                    </li>

                    <li class="mobile-menu-item">

                        <a class="mobile-menu-link" href="category.html">هواتف</a>


                    </li>
                    <li class="mobile-menu-item">

                        <a class="mobile-menu-link" href="category.html">ساعات</a>


                    </li>
                    <li class="mobile-menu-item">

                        <a class="mobile-menu-link" href="category.html">سماعات</a>


                    </li>
                    <li class="mobile-menu-item">

                        <a class="mobile-menu-link" href="category.html">ملابس</a>


                    </li>




                </ul>


            </div>
        </div>

    </div>

    <div class="mobile-menu-overlay panel-responsive-btn panel-responsive-close" data-target="mobile-menu-wrapper"></div>

    <a href="#" class="mobile-menu-close panel-responsive-btn panel-responsive-close" data-target="mobile-menu-wrapper"><i class="fas fa-times"></i></a>

</div>

</header>

<div class="tool-bar">

<div class="tool">

    <a class="tool-link" href="index.html">

        <div class="tool-icon">

            <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
                <g>
                    <g>
                        <path d="M506.555,208.064L263.859,30.367c-4.68-3.426-11.038-3.426-15.716,0L5.445,208.064
                            c-5.928,4.341-7.216,12.665-2.875,18.593s12.666,7.214,18.593,2.875L256,57.588l234.837,171.943c2.368,1.735,5.12,2.57,7.848,2.57
                            c4.096,0,8.138-1.885,10.744-5.445C513.771,220.729,512.483,212.405,506.555,208.064z"></path>
                    </g>
                </g>
                <g>
                    <g>
                        <path d="M442.246,232.543c-7.346,0-13.303,5.956-13.303,13.303v211.749H322.521V342.009c0-36.68-29.842-66.52-66.52-66.52
                            s-66.52,29.842-66.52,66.52v115.587H83.058V245.847c0-7.347-5.957-13.303-13.303-13.303s-13.303,5.956-13.303,13.303v225.053
                            c0,7.347,5.957,13.303,13.303,13.303h133.029c6.996,0,12.721-5.405,13.251-12.267c0.032-0.311,0.052-0.651,0.052-1.036v-128.89
                            c0-22.009,17.905-39.914,39.914-39.914s39.914,17.906,39.914,39.914v128.89c0,0.383,0.02,0.717,0.052,1.024
                            c0.524,6.867,6.251,12.279,13.251,12.279h133.029c7.347,0,13.303-5.956,13.303-13.303V245.847
                            C455.549,238.499,449.593,232.543,442.246,232.543z"></path>
                    </g>
                </g>
                </svg>



        </div>

        <span>

            الرئيسية

        </span>

    </a>


</div>

<div class="tool">

    <a class="tool-link nav-toggler" href="all-stores.html">


        <div class="tool-icon">

            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 36 36" version="1.1" preserveAspectRatio="xMidYMid meet"><path class="clr-i-outline clr-i-outline-path-1" d="M28,30H16V22H14v8H8V22H6v8a2,2,0,0,0,2,2H28a2,2,0,0,0,2-2V22H28Z"/><path class="clr-i-outline clr-i-outline-path-2" d="M33.79,13.27,29.71,5.11A2,2,0,0,0,27.92,4H8.08A2,2,0,0,0,6.29,5.11L2.21,13.27a2,2,0,0,0-.21.9v3.08a2,2,0,0,0,.46,1.28A4.67,4.67,0,0,0,6,20.13a4.72,4.72,0,0,0,3-1.07,4.73,4.73,0,0,0,6,0,4.73,4.73,0,0,0,6,0,4.73,4.73,0,0,0,6,0,4.72,4.72,0,0,0,6.53-.52A2,2,0,0,0,34,17.26V14.17A2,2,0,0,0,33.79,13.27ZM30,18.13A2.68,2.68,0,0,1,27.82,17L27,15.88,26.19,17a2.71,2.71,0,0,1-4.37,0L21,15.88,20.19,17a2.71,2.71,0,0,1-4.37,0L15,15.88,14.19,17a2.71,2.71,0,0,1-4.37,0L9,15.88,8.18,17A2.68,2.68,0,0,1,6,18.13a2.64,2.64,0,0,1-2-.88V14.17L8.08,6H27.92L32,14.16v.67l0,2.39A2.67,2.67,0,0,1,30,18.13Z"/><rect x="0" y="0" width="36" height="36" fill-opacity="0"/></svg>

        </div>

        <span>

             المتاجر  

        </span>

    </a>



</div>

<div class="tool">

    <a class="tool-link active" href="cart.html">

        <div class="tool-icon">

            <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 450.391 450.391" style="enable-background:new 0 0 450.391 450.391;" xml:space="preserve"><g><g><g><path d="M143.673,350.322c-25.969,0-47.02,21.052-47.02,47.02c0,25.969,21.052,47.02,47.02,47.02c25.969,0,47.02-21.052,47.02-47.02C190.694,371.374,169.642,350.322,143.673,350.322z M143.673,423.465c-14.427,0-26.122-11.695-26.122-26.122c0-14.427,11.695-26.122,26.122-26.122c14.427,0,26.122,11.695,26.122,26.122C169.796,411.77,158.1,423.465,143.673,423.465z"></path><path d="M342.204,350.322c-25.969,0-47.02,21.052-47.02,47.02c0,25.969,21.052,47.02,47.02,47.02s47.02-21.052,47.02-47.02C389.224,371.374,368.173,350.322,342.204,350.322z M342.204,423.465c-14.427,0-26.122-11.695-26.122-26.122c0-14.427,11.695-26.122,26.122-26.122s26.122,11.695,26.122,26.122C368.327,411.77,356.631,423.465,342.204,423.465z"></path><path d="M448.261,76.037c-2.176-2.377-5.153-3.865-8.359-4.18L99.788,67.155L90.384,38.42C83.759,19.211,65.771,6.243,45.453,6.028H10.449C4.678,6.028,0,10.706,0,16.477s4.678,10.449,10.449,10.449h35.004c11.361,0.251,21.365,7.546,25.078,18.286l66.351,200.098l-5.224,12.016c-5.827,15.026-4.077,31.938,4.702,45.453c8.695,13.274,23.323,21.466,39.184,21.943h203.233c5.771,0,10.449-4.678,10.449-10.449c0-5.771-4.678-10.449-10.449-10.449H175.543c-8.957-0.224-17.202-4.936-21.943-12.539c-4.688-7.51-5.651-16.762-2.612-25.078l4.18-9.404l219.951-22.988c24.16-2.661,44.034-20.233,49.633-43.886l25.078-105.012C450.96,81.893,450.36,78.492,448.261,76.037z M404.376,185.228c-3.392,15.226-16.319,26.457-31.869,27.69l-217.339,22.465L106.58,88.053l320.261,4.702L404.376,185.228z"></path></g></g></g></svg>

        </div>

        <span>

            السلة

        </span>

    </a>



</div>

<div class="tool">

    <a class="tool-link" href="dashboard-home.html">

        <div class="tool-icon">

            <svg viewBox="-42 0 512 512.001" xmlns="http://www.w3.org/2000/svg"><path d="m210.351562 246.632812c33.882813 0 63.21875-12.152343 87.195313-36.128906 23.96875-23.972656 36.125-53.304687 36.125-87.191406 0-33.875-12.152344-63.210938-36.128906-87.191406-23.976563-23.96875-53.3125-36.121094-87.191407-36.121094-33.886718 0-63.21875 12.152344-87.191406 36.125s-36.128906 53.308594-36.128906 87.1875c0 33.886719 12.15625 63.222656 36.128906 87.195312 23.980469 23.96875 53.316406 36.125 87.191406 36.125zm-65.972656-189.292968c18.394532-18.394532 39.972656-27.335938 65.972656-27.335938 25.996094 0 47.578126 8.941406 65.976563 27.335938 18.394531 18.398437 27.339844 39.980468 27.339844 65.972656 0 26-8.945313 47.578125-27.339844 65.976562-18.398437 18.398438-39.980469 27.339844-65.976563 27.339844-25.992187 0-47.570312-8.945312-65.972656-27.339844-18.398437-18.394531-27.34375-39.976562-27.34375-65.976562 0-25.992188 8.945313-47.574219 27.34375-65.972656zm0 0"></path><path d="m426.128906 393.703125c-.691406-9.976563-2.089844-20.859375-4.148437-32.351563-2.078125-11.578124-4.753907-22.523437-7.957031-32.527343-3.3125-10.339844-7.808594-20.550781-13.375-30.335938-5.769532-10.15625-12.550782-19-20.160157-26.277343-7.957031-7.613282-17.699219-13.734376-28.964843-18.199219-11.226563-4.441407-23.667969-6.691407-36.976563-6.691407-5.226563 0-10.28125 2.144532-20.042969 8.5-6.007812 3.917969-13.035156 8.449219-20.878906 13.460938-6.707031 4.273438-15.792969 8.277344-27.015625 11.902344-10.949219 3.542968-22.066406 5.339844-33.042969 5.339844-10.96875 0-22.085937-1.796876-33.042968-5.339844-11.210938-3.621094-20.300782-7.625-26.996094-11.898438-7.769532-4.964844-14.800782-9.496094-20.898438-13.46875-9.753906-6.355468-14.808594-8.5-20.035156-8.5-13.3125 0-25.75 2.253906-36.972656 6.699219-11.257813 4.457031-21.003906 10.578125-28.96875 18.199219-7.609375 7.28125-14.390625 16.121094-20.15625 26.273437-5.558594 9.785157-10.058594 19.992188-13.371094 30.339844-3.199219 10.003906-5.875 20.945313-7.953125 32.523437-2.0625 11.476563-3.457031 22.363282-4.148437 32.363282-.679688 9.777344-1.023438 19.953125-1.023438 30.234375 0 26.726562 8.496094 48.363281 25.25 64.320312 16.546875 15.746094 38.4375 23.730469 65.066406 23.730469h246.53125c26.621094 0 48.511719-7.984375 65.0625-23.730469 16.757813-15.945312 25.253906-37.589843 25.253906-64.324219-.003906-10.316406-.351562-20.492187-1.035156-30.242187zm-44.90625 72.828125c-10.933594 10.40625-25.449218 15.464844-44.378906 15.464844h-246.527344c-18.933594 0-33.449218-5.058594-44.378906-15.460938-10.722656-10.207031-15.933594-24.140625-15.933594-42.585937 0-9.59375.316406-19.066407.949219-28.160157.617187-8.921874 1.878906-18.722656 3.75-29.136718 1.847656-10.285156 4.199219-19.9375 6.996094-28.675782 2.683593-8.378906 6.34375-16.675781 10.882812-24.667968 4.332031-7.617188 9.316407-14.152344 14.816407-19.417969 5.144531-4.925781 11.628906-8.957031 19.269531-11.980469 7.066406-2.796875 15.007812-4.328125 23.628906-4.558594 1.050781.558594 2.921875 1.625 5.953125 3.601563 6.167969 4.019531 13.277344 8.605469 21.136719 13.625 8.859375 5.648437 20.273437 10.75 33.910156 15.152344 13.941406 4.507812 28.160156 6.796875 42.273437 6.796875 14.113282 0 28.335938-2.289063 42.269532-6.792969 13.648437-4.410156 25.058594-9.507813 33.929687-15.164063 8.042969-5.140624 14.953125-9.59375 21.121094-13.617187 3.03125-1.972656 4.902344-3.042969 5.953125-3.601563 8.625.230469 16.566406 1.761719 23.636719 4.558594 7.636719 3.023438 14.121093 7.058594 19.265625 11.980469 5.5 5.261719 10.484375 11.796875 14.816406 19.421875 4.542969 7.988281 8.207031 16.289062 10.886719 24.660156 2.800781 8.75 5.15625 18.398438 7 28.675782 1.867187 10.433593 3.132812 20.238281 3.75 29.144531v.007812c.636719 9.058594.957031 18.527344.960937 28.148438-.003906 18.449219-5.214844 32.378906-15.9375 42.582031zm0 0"></path></svg>


        </div>

        <span>

            حسابي

        </span>

    </a>



</div>

<div class="tool">

    <a class="tool-link" href="search.html">

        <div class="tool-icon">

            <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve"><g><g><path d="M508.875,493.792L353.089,338.005c32.358-35.927,52.245-83.296,52.245-135.339C405.333,90.917,314.417,0,202.667,0S0,90.917,0,202.667s90.917,202.667,202.667,202.667c52.043,0,99.411-19.887,135.339-52.245l155.786,155.786c2.083,2.083,4.813,3.125,7.542,3.125c2.729,0,5.458-1.042,7.542-3.125C513.042,504.708,513.042,497.958,508.875,493.792zM202.667,384c-99.979,0-181.333-81.344-181.333-181.333S102.688,21.333,202.667,21.333S384,102.677,384,202.667S302.646,384,202.667,384z"></path></g></g></svg>

        </div>

        <span>

            بحث

        </span>

    </a>

</div>


</div>
