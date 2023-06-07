@extends('Frontend.layouts.app')
@section('title', 'category')
@section('content')
<main class="page-wrapper">
        
          
        
    <!-- ***** categories-welcome-section Start ***** -->
    
    <section class="section-style stores-section categories-welcome-section ">
    
        <div class="container custom-container">
        
            <div class="categories-welcome-area">
            
                <div class="category-banner" style="background-image: {{asset('img/pexels-daian-gan-102129.webp')}}">
                
                    <p class="banner-text">{{$category->title}}</p>
                
                </div>
                <div class="stores-area top-stores-area">
            
                    <div class="main-title sub-title text-center mb-alt">

                        <h1 class="title">المتاجر </h1>

                    </div>

                    <div class="scroll-boxes">

                        <div class="row target-row row-cols-lg-6 row-cols-md-5 justify-content-md-center gx-3">

                            @foreach($sellers as $index=>$seller)
                            <div class="store-wrap">
                                
                                <a href="{{route('store',$seller->id)}}" class="store-item">

                                    <div class="store-img">
                                        <img class="img-fluid" src="{{asset('img/store.svg')}}" alt="storeName">
                                    </div>
                                    <div class="store-texts">
                                        <span class="store-name">{{$seller->name}}</span>
                                    </div>
                                </a>

                            </div>  
                            @if(($index+1)% 6 == 0)
                            <div class="divider d-none d-md-block col-12"></div>
                            @endif
                        @endforeach


                        </div>


                    </div>

                    <div class="show-more-wrap">

                           <a class="show-more" href="all-stores.html">


                                <span class="loader-text">عرض كل المتاجر </span>

                            </a>

                    </div>

            
                </div>
        
            </div>
            
        </div>
    
    </section>
    
    <!-- ***** categories-welcome-section End ***** -->
    
    

     <!-- ***** products-categories-section Start ***** -->
    
     <section class="section-style products-categories-section ">
    
        <div class="container custom-container">
        
            <div class="products-area">
            
                <div class="main-title">
                
                    <h1 class="title">#المنتجات</h1>
                
                </div>
                
                
                <div class="products-wrapper products-categories">
                    
                    <div class="row-categories">
                        
                        <div class="flex-head">

                              <div class="main-title sub-title gray-clr">

                                  <h1 class="title ">مضاف حديثا</h1>

                             </div>
                              <a class="more-link hvr-underline-from-right" href="products.html">عرض الكل</a>


                         </div>
                        <div class="row-container slider-container product-slider-container">

                            <div class="swiper product-slider duplicated-products-slider scroll-row">

                                <div class="swiper-wrapper target-row">

                                    <div class="swiper-slide product-wrap">

                                           <div class="product-item">

                                                <div class="product-img">

                                                    <a href="product-default.html">

                                                        <span class="tt-img">

                                                           <img class="img-fluid" src="{{asset('img/p1.png')}}" alt="productName">

                                                       </span>
                                                        <div class="product-code">كود : 543215114</div>

                                                    </a>

                                                </div>
                                                <div class="product-body">

                                                    <div class="price-info">

                                                        <p class="price-val">

                                                            <span>1.000.000 </span>
                                                            دولارًا

                                                        </p>

                                                        <p class="price-points">


                                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="13.945" height="13" viewBox="0 0 13.945 13"><defs><clipPath id="clip-path"><rect id="Rectangle_35" data-name="Rectangle 35" width="13.946" height="13" transform="translate(1149.69 2020)" fill="#fff"/></clipPath></defs><g id="Group_16" data-name="Group 16" transform="translate(-1149.69 -2020)" clip-path="url(#clip-path)"><path id="Path_89" data-name="Path 89" d="M1163.64,2026.5a6.3,6.3,0,0,1-1.88,4.44,7.116,7.116,0,0,1-5.1,1.95,6.543,6.543,0,0,1-6.84-6.39,6.186,6.186,0,0,1,2.08-4.75,7.215,7.215,0,0,1,4.76-1.75A6.756,6.756,0,0,1,1163.64,2026.5Z" fill="#ffd05b"/><path id="Path_90" data-name="Path 90" d="M1156.66,2031.74a5.253,5.253,0,1,0-5.62-5.24A5.448,5.448,0,0,0,1156.66,2031.74Z" fill="#ffeaa5"/><path id="Path_91" data-name="Path 91" d="M1161.39,2026.5a4.208,4.208,0,0,1-1.19,2.92,4.793,4.793,0,0,1-3.54,1.37,4.337,4.337,0,0,1-4.56-4.29,4.1,4.1,0,0,1,1.43-3.29,4.892,4.892,0,0,1,3.13-1.11,4.575,4.575,0,0,1,4.73,4.4Z" fill="#ffe077"/><path id="Path_92" data-name="Path 92" d="M1157.79,2026.71l-.92-2.22a.231.231,0,0,0-.42,0l-.91,2.22-1.18-.83-.15.19.93,2.58,3.46-.26.78-2.32a.224.224,0,0,0-.35-.23Z" fill="#ffc244"/><path id="Path_93" data-name="Path 93" d="M1157,2032.69a6.747,6.747,0,0,1-6.97-6.5,6.255,6.255,0,0,1,1.87-4.44,6.3,6.3,0,0,0-2.21,4.75,6.747,6.747,0,0,0,6.97,6.5,7.2,7.2,0,0,0,5.1-2.06,7.266,7.266,0,0,1-4.76,1.75Z" fill="#ffc244"/><path id="Path_94" data-name="Path 94" d="M1157.06,2030.54a4.577,4.577,0,0,1-4.73-4.41,4.191,4.191,0,0,1,1.2-2.92,4.253,4.253,0,0,0-1.59,3.29,4.567,4.567,0,0,0,4.72,4.4,4.876,4.876,0,0,0,3.54-1.48,4.948,4.948,0,0,1-3.14,1.12Z" fill="#ffd05b"/><path id="Path_95" data-name="Path 95" d="M1155,2027.8l-.64-1.92-.06-.04c-.18-.12-.42.04-.35.23l.82,2.44a.432.432,0,0,0,.42.3h2.94a.445.445,0,0,0,.43-.3l.04-.12h-2.74a.894.894,0,0,1-.86-.59Z" fill="#ffaa5a"/></g></svg>

                                                            5160

                                                        </p>

                                                    </div>

                                                    <div class="product-desc">

                                                        <a href="product-default.html">

                                                            بنطلون جينز رجالي ضيق مثال
                                                            بقصة ضيقة 
                                                             بنطلون جينز رجالي ضيق مثال

                                                        </a>

                                                    </div>

                                                    <div class="product-actions">

                                                        <div class="cart-action ">

                                                            <a class="btn-cart loading-btn" href="#">

                                                                <p class="add-to-cart">
                                                                    <span>إضافة للسلة </span>
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="21.5" height="21.5" viewBox="0 0 21.5 21.5"><path id="Path_4843" data-name="Path 4843" d="M394,733.5a1.5,1.5,0,1,1-1.5-1.5A1.5,1.5,0,0,1,394,733.5Z" transform="translate(-384.25 -714.25)" fill="none" stroke="#fff" stroke-width="1.5"/><path id="Path_4844" data-name="Path 4844" d="M403,733.5a1.5,1.5,0,1,1-1.5-1.5A1.5,1.5,0,0,1,403,733.5Z" transform="translate(-384.25 -714.25)" fill="none" stroke="#fff" stroke-width="1.5"/><path id="Path_4846" data-name="Path 4846" d="M389,717h12a4,4,0,0,1,4,4v5a4,4,0,0,1-4,4h-8a4,4,0,0,1-4-4Zm0,0a2,2,0,0,0-2-2h-2" transform="translate(-384.25 -714.25)" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/></svg>

                                                                </p>

                                                                <p class="added">

                                                                    <span>في السلة </span>
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="21.5" height="21.5" viewBox="0 0 21.5 21.5"><path id="Path_4843" data-name="Path 4843" d="M394,733.5a1.5,1.5,0,1,1-1.5-1.5A1.5,1.5,0,0,1,394,733.5Z" transform="translate(-384.25 -714.25)" fill="none" stroke="#fff" stroke-width="1.5"/><path id="Path_4844" data-name="Path 4844" d="M403,733.5a1.5,1.5,0,1,1-1.5-1.5A1.5,1.5,0,0,1,403,733.5Z" transform="translate(-384.25 -714.25)" fill="none" stroke="#fff" stroke-width="1.5"/><path id="Path_4845" data-name="Path 4845" d="M394,724l1.753,1.4a1,1,0,0,0,1.377-.122L400,722" transform="translate(-384.25 -714.25)" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/><path id="Path_4846" data-name="Path 4846" d="M389,717h12a4,4,0,0,1,4,4v5a4,4,0,0,1-4,4h-8a4,4,0,0,1-4-4Zm0,0a2,2,0,0,0-2-2h-2" transform="translate(-384.25 -714.25)" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/></svg>

                                                                </p> 

                                                            </a>

                                                        </div>
                                                        <div class="counter-wrap ">

                                                            <div class="count-wrap form-group">

                                                                <button type="button" class="count-btn count-add" data-type="plus">

                                                                    <span class="count-icon add-icon">

                                                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" width="45px" height="45px" viewBox="0 0 45 45" style="enable-background:new 0 0 45 45;" xml:space="preserve"><g><path d="M41.267,18.557H26.832V4.134C26.832,1.851,24.99,0,22.707,0c-2.283,0-4.124,1.851-4.124,4.135v14.432H4.141   c-2.283,0-4.139,1.851-4.138,4.135c-0.001,1.141,0.46,2.187,1.207,2.934c0.748,0.749,1.78,1.222,2.92,1.222h14.453V41.27   c0,1.142,0.453,2.176,1.201,2.922c0.748,0.748,1.777,1.211,2.919,1.211c2.282,0,4.129-1.851,4.129-4.133V26.857h14.435   c2.283,0,4.134-1.867,4.133-4.15C45.399,20.425,43.548,18.557,41.267,18.557z"></path></g></svg>

                                                                    </span>

                                                                </button>

                                                                <input type="text" class="count-num form-control " value="1" step="1" inputmode="tel" min="1" max="1000" autocomplete="off">

                                                                <button type="button" class="count-btn count-sub disabled" data-type="minus">

                                                                    <span class="count-icon sub-icon">

                                                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 42 42" style="enable-background:new 0 0 42 42;" xml:space="preserve"><path d="M37.059,16H26H16H4.941C2.224,16,0,18.282,0,21s2.224,5,4.941,5H16h10h11.059C39.776,26,42,23.718,42,21  S39.776,16,37.059,16z"></path></svg>

                                                                    </span>

                                                                </button>

                                                            </div>

                                                        </div>

                                                    </div>


                                                </div>


                                            </div>


                                    </div>
                                    <div class="swiper-slide product-wrap">

                                           <div class="product-item">

                                                <div class="product-img">

                                                    <a href="product-default.html">

                                                        <span class="tt-img">

                                                           <img class="img-fluid" src="{{asset('img/p1.png')}}" alt="productName">

                                                       </span>
                                                        <div class="product-code">كود : 543215114</div>

                                                    </a>

                                                </div>
                                                <div class="product-body">

                                                    <div class="price-info">

                                                        <p class="price-val">

                                                            <span>1.000.000 </span>
                                                            دولارًا

                                                        </p>

                                                        <p class="price-points">


                                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="13.945" height="13" viewBox="0 0 13.945 13"><defs><clipPath id="clip-path"><rect id="Rectangle_35" data-name="Rectangle 35" width="13.946" height="13" transform="translate(1149.69 2020)" fill="#fff"/></clipPath></defs><g id="Group_16" data-name="Group 16" transform="translate(-1149.69 -2020)" clip-path="url(#clip-path)"><path id="Path_89" data-name="Path 89" d="M1163.64,2026.5a6.3,6.3,0,0,1-1.88,4.44,7.116,7.116,0,0,1-5.1,1.95,6.543,6.543,0,0,1-6.84-6.39,6.186,6.186,0,0,1,2.08-4.75,7.215,7.215,0,0,1,4.76-1.75A6.756,6.756,0,0,1,1163.64,2026.5Z" fill="#ffd05b"/><path id="Path_90" data-name="Path 90" d="M1156.66,2031.74a5.253,5.253,0,1,0-5.62-5.24A5.448,5.448,0,0,0,1156.66,2031.74Z" fill="#ffeaa5"/><path id="Path_91" data-name="Path 91" d="M1161.39,2026.5a4.208,4.208,0,0,1-1.19,2.92,4.793,4.793,0,0,1-3.54,1.37,4.337,4.337,0,0,1-4.56-4.29,4.1,4.1,0,0,1,1.43-3.29,4.892,4.892,0,0,1,3.13-1.11,4.575,4.575,0,0,1,4.73,4.4Z" fill="#ffe077"/><path id="Path_92" data-name="Path 92" d="M1157.79,2026.71l-.92-2.22a.231.231,0,0,0-.42,0l-.91,2.22-1.18-.83-.15.19.93,2.58,3.46-.26.78-2.32a.224.224,0,0,0-.35-.23Z" fill="#ffc244"/><path id="Path_93" data-name="Path 93" d="M1157,2032.69a6.747,6.747,0,0,1-6.97-6.5,6.255,6.255,0,0,1,1.87-4.44,6.3,6.3,0,0,0-2.21,4.75,6.747,6.747,0,0,0,6.97,6.5,7.2,7.2,0,0,0,5.1-2.06,7.266,7.266,0,0,1-4.76,1.75Z" fill="#ffc244"/><path id="Path_94" data-name="Path 94" d="M1157.06,2030.54a4.577,4.577,0,0,1-4.73-4.41,4.191,4.191,0,0,1,1.2-2.92,4.253,4.253,0,0,0-1.59,3.29,4.567,4.567,0,0,0,4.72,4.4,4.876,4.876,0,0,0,3.54-1.48,4.948,4.948,0,0,1-3.14,1.12Z" fill="#ffd05b"/><path id="Path_95" data-name="Path 95" d="M1155,2027.8l-.64-1.92-.06-.04c-.18-.12-.42.04-.35.23l.82,2.44a.432.432,0,0,0,.42.3h2.94a.445.445,0,0,0,.43-.3l.04-.12h-2.74a.894.894,0,0,1-.86-.59Z" fill="#ffaa5a"/></g></svg>

                                                            5160

                                                        </p>

                                                    </div>

                                                    <div class="product-desc">

                                                        <a href="product-default.html">

                                                            بنطلون جينز رجالي ضيق مثال
                                                            بقصة ضيقة 
                                                             بنطلون جينز رجالي ضيق مثال

                                                        </a>

                                                    </div>

                                                    <div class="product-actions">

                                                        <div class="cart-action ">

                                                            <a class="btn-cart loading-btn" href="#">

                                                                <p class="add-to-cart">
                                                                    <span>إضافة للسلة </span>
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="21.5" height="21.5" viewBox="0 0 21.5 21.5"><path id="Path_4843" data-name="Path 4843" d="M394,733.5a1.5,1.5,0,1,1-1.5-1.5A1.5,1.5,0,0,1,394,733.5Z" transform="translate(-384.25 -714.25)" fill="none" stroke="#fff" stroke-width="1.5"/><path id="Path_4844" data-name="Path 4844" d="M403,733.5a1.5,1.5,0,1,1-1.5-1.5A1.5,1.5,0,0,1,403,733.5Z" transform="translate(-384.25 -714.25)" fill="none" stroke="#fff" stroke-width="1.5"/><path id="Path_4846" data-name="Path 4846" d="M389,717h12a4,4,0,0,1,4,4v5a4,4,0,0,1-4,4h-8a4,4,0,0,1-4-4Zm0,0a2,2,0,0,0-2-2h-2" transform="translate(-384.25 -714.25)" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/></svg>

                                                                </p>

                                                                <p class="added">

                                                                    <span>في السلة </span>
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="21.5" height="21.5" viewBox="0 0 21.5 21.5"><path id="Path_4843" data-name="Path 4843" d="M394,733.5a1.5,1.5,0,1,1-1.5-1.5A1.5,1.5,0,0,1,394,733.5Z" transform="translate(-384.25 -714.25)" fill="none" stroke="#fff" stroke-width="1.5"/><path id="Path_4844" data-name="Path 4844" d="M403,733.5a1.5,1.5,0,1,1-1.5-1.5A1.5,1.5,0,0,1,403,733.5Z" transform="translate(-384.25 -714.25)" fill="none" stroke="#fff" stroke-width="1.5"/><path id="Path_4845" data-name="Path 4845" d="M394,724l1.753,1.4a1,1,0,0,0,1.377-.122L400,722" transform="translate(-384.25 -714.25)" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/><path id="Path_4846" data-name="Path 4846" d="M389,717h12a4,4,0,0,1,4,4v5a4,4,0,0,1-4,4h-8a4,4,0,0,1-4-4Zm0,0a2,2,0,0,0-2-2h-2" transform="translate(-384.25 -714.25)" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/></svg>

                                                                </p> 

                                                            </a>

                                                        </div>
                                                        <div class="counter-wrap ">

                                                            <div class="count-wrap form-group">

                                                                <button type="button" class="count-btn count-add" data-type="plus">

                                                                    <span class="count-icon add-icon">

                                                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" width="45px" height="45px" viewBox="0 0 45 45" style="enable-background:new 0 0 45 45;" xml:space="preserve"><g><path d="M41.267,18.557H26.832V4.134C26.832,1.851,24.99,0,22.707,0c-2.283,0-4.124,1.851-4.124,4.135v14.432H4.141   c-2.283,0-4.139,1.851-4.138,4.135c-0.001,1.141,0.46,2.187,1.207,2.934c0.748,0.749,1.78,1.222,2.92,1.222h14.453V41.27   c0,1.142,0.453,2.176,1.201,2.922c0.748,0.748,1.777,1.211,2.919,1.211c2.282,0,4.129-1.851,4.129-4.133V26.857h14.435   c2.283,0,4.134-1.867,4.133-4.15C45.399,20.425,43.548,18.557,41.267,18.557z"></path></g></svg>

                                                                    </span>

                                                                </button>

                                                                <input type="text" class="count-num form-control " value="1" step="1" inputmode="tel" min="1" max="1000" autocomplete="off">

                                                                <button type="button" class="count-btn count-sub disabled" data-type="minus">

                                                                    <span class="count-icon sub-icon">

                                                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 42 42" style="enable-background:new 0 0 42 42;" xml:space="preserve"><path d="M37.059,16H26H16H4.941C2.224,16,0,18.282,0,21s2.224,5,4.941,5H16h10h11.059C39.776,26,42,23.718,42,21  S39.776,16,37.059,16z"></path></svg>

                                                                    </span>

                                                                </button>

                                                            </div>

                                                        </div>

                                                    </div>


                                                </div>


                                            </div>


                                    </div>
                                    <div class="swiper-slide product-wrap">

                                           <div class="product-item">

                                                <div class="product-img">

                                                    <a href="product-default.html">

                                                        <span class="tt-img">

                                                           <img class="img-fluid" src="{{asset('img/p1.png')}}" alt="productName">

                                                       </span>
                                                        <div class="product-code">كود : 543215114</div>

                                                    </a>

                                                </div>
                                                <div class="product-body">

                                                    <div class="price-info">

                                                        <p class="price-val">

                                                            <span>1.000.000 </span>
                                                            دولارًا

                                                        </p>

                                                        <p class="price-points">


                                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="13.945" height="13" viewBox="0 0 13.945 13"><defs><clipPath id="clip-path"><rect id="Rectangle_35" data-name="Rectangle 35" width="13.946" height="13" transform="translate(1149.69 2020)" fill="#fff"/></clipPath></defs><g id="Group_16" data-name="Group 16" transform="translate(-1149.69 -2020)" clip-path="url(#clip-path)"><path id="Path_89" data-name="Path 89" d="M1163.64,2026.5a6.3,6.3,0,0,1-1.88,4.44,7.116,7.116,0,0,1-5.1,1.95,6.543,6.543,0,0,1-6.84-6.39,6.186,6.186,0,0,1,2.08-4.75,7.215,7.215,0,0,1,4.76-1.75A6.756,6.756,0,0,1,1163.64,2026.5Z" fill="#ffd05b"/><path id="Path_90" data-name="Path 90" d="M1156.66,2031.74a5.253,5.253,0,1,0-5.62-5.24A5.448,5.448,0,0,0,1156.66,2031.74Z" fill="#ffeaa5"/><path id="Path_91" data-name="Path 91" d="M1161.39,2026.5a4.208,4.208,0,0,1-1.19,2.92,4.793,4.793,0,0,1-3.54,1.37,4.337,4.337,0,0,1-4.56-4.29,4.1,4.1,0,0,1,1.43-3.29,4.892,4.892,0,0,1,3.13-1.11,4.575,4.575,0,0,1,4.73,4.4Z" fill="#ffe077"/><path id="Path_92" data-name="Path 92" d="M1157.79,2026.71l-.92-2.22a.231.231,0,0,0-.42,0l-.91,2.22-1.18-.83-.15.19.93,2.58,3.46-.26.78-2.32a.224.224,0,0,0-.35-.23Z" fill="#ffc244"/><path id="Path_93" data-name="Path 93" d="M1157,2032.69a6.747,6.747,0,0,1-6.97-6.5,6.255,6.255,0,0,1,1.87-4.44,6.3,6.3,0,0,0-2.21,4.75,6.747,6.747,0,0,0,6.97,6.5,7.2,7.2,0,0,0,5.1-2.06,7.266,7.266,0,0,1-4.76,1.75Z" fill="#ffc244"/><path id="Path_94" data-name="Path 94" d="M1157.06,2030.54a4.577,4.577,0,0,1-4.73-4.41,4.191,4.191,0,0,1,1.2-2.92,4.253,4.253,0,0,0-1.59,3.29,4.567,4.567,0,0,0,4.72,4.4,4.876,4.876,0,0,0,3.54-1.48,4.948,4.948,0,0,1-3.14,1.12Z" fill="#ffd05b"/><path id="Path_95" data-name="Path 95" d="M1155,2027.8l-.64-1.92-.06-.04c-.18-.12-.42.04-.35.23l.82,2.44a.432.432,0,0,0,.42.3h2.94a.445.445,0,0,0,.43-.3l.04-.12h-2.74a.894.894,0,0,1-.86-.59Z" fill="#ffaa5a"/></g></svg>

                                                            5160

                                                        </p>

                                                    </div>

                                                    <div class="product-desc">

                                                        <a href="product-default.html">

                                                            بنطلون جينز رجالي ضيق مثال
                                                            بقصة ضيقة 
                                                             بنطلون جينز رجالي ضيق مثال

                                                        </a>

                                                    </div>

                                                    <div class="product-actions">

                                                        <div class="cart-action ">

                                                            <a class="btn-cart loading-btn" href="#">

                                                                <p class="add-to-cart">
                                                                    <span>إضافة للسلة </span>
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="21.5" height="21.5" viewBox="0 0 21.5 21.5"><path id="Path_4843" data-name="Path 4843" d="M394,733.5a1.5,1.5,0,1,1-1.5-1.5A1.5,1.5,0,0,1,394,733.5Z" transform="translate(-384.25 -714.25)" fill="none" stroke="#fff" stroke-width="1.5"/><path id="Path_4844" data-name="Path 4844" d="M403,733.5a1.5,1.5,0,1,1-1.5-1.5A1.5,1.5,0,0,1,403,733.5Z" transform="translate(-384.25 -714.25)" fill="none" stroke="#fff" stroke-width="1.5"/><path id="Path_4846" data-name="Path 4846" d="M389,717h12a4,4,0,0,1,4,4v5a4,4,0,0,1-4,4h-8a4,4,0,0,1-4-4Zm0,0a2,2,0,0,0-2-2h-2" transform="translate(-384.25 -714.25)" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/></svg>

                                                                </p>

                                                                <p class="added">

                                                                    <span>في السلة </span>
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="21.5" height="21.5" viewBox="0 0 21.5 21.5"><path id="Path_4843" data-name="Path 4843" d="M394,733.5a1.5,1.5,0,1,1-1.5-1.5A1.5,1.5,0,0,1,394,733.5Z" transform="translate(-384.25 -714.25)" fill="none" stroke="#fff" stroke-width="1.5"/><path id="Path_4844" data-name="Path 4844" d="M403,733.5a1.5,1.5,0,1,1-1.5-1.5A1.5,1.5,0,0,1,403,733.5Z" transform="translate(-384.25 -714.25)" fill="none" stroke="#fff" stroke-width="1.5"/><path id="Path_4845" data-name="Path 4845" d="M394,724l1.753,1.4a1,1,0,0,0,1.377-.122L400,722" transform="translate(-384.25 -714.25)" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/><path id="Path_4846" data-name="Path 4846" d="M389,717h12a4,4,0,0,1,4,4v5a4,4,0,0,1-4,4h-8a4,4,0,0,1-4-4Zm0,0a2,2,0,0,0-2-2h-2" transform="translate(-384.25 -714.25)" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/></svg>

                                                                </p> 

                                                            </a>

                                                        </div>
                                                        <div class="counter-wrap ">

                                                            <div class="count-wrap form-group">

                                                                <button type="button" class="count-btn count-add" data-type="plus">

                                                                    <span class="count-icon add-icon">

                                                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" width="45px" height="45px" viewBox="0 0 45 45" style="enable-background:new 0 0 45 45;" xml:space="preserve"><g><path d="M41.267,18.557H26.832V4.134C26.832,1.851,24.99,0,22.707,0c-2.283,0-4.124,1.851-4.124,4.135v14.432H4.141   c-2.283,0-4.139,1.851-4.138,4.135c-0.001,1.141,0.46,2.187,1.207,2.934c0.748,0.749,1.78,1.222,2.92,1.222h14.453V41.27   c0,1.142,0.453,2.176,1.201,2.922c0.748,0.748,1.777,1.211,2.919,1.211c2.282,0,4.129-1.851,4.129-4.133V26.857h14.435   c2.283,0,4.134-1.867,4.133-4.15C45.399,20.425,43.548,18.557,41.267,18.557z"></path></g></svg>

                                                                    </span>

                                                                </button>

                                                                <input type="text" class="count-num form-control " value="1" step="1" inputmode="tel" min="1" max="1000" autocomplete="off">

                                                                <button type="button" class="count-btn count-sub disabled" data-type="minus">

                                                                    <span class="count-icon sub-icon">

                                                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 42 42" style="enable-background:new 0 0 42 42;" xml:space="preserve"><path d="M37.059,16H26H16H4.941C2.224,16,0,18.282,0,21s2.224,5,4.941,5H16h10h11.059C39.776,26,42,23.718,42,21  S39.776,16,37.059,16z"></path></svg>

                                                                    </span>

                                                                </button>

                                                            </div>

                                                        </div>

                                                    </div>


                                                </div>


                                            </div>


                                    </div>
                                    <div class="swiper-slide product-wrap">

                                           <div class="product-item">

                                                <div class="product-img">

                                                    <a href="product-default.html">

                                                        <span class="tt-img">

                                                           <img class="img-fluid" src="{{asset('img/p1.png')}}" alt="productName">

                                                       </span>
                                                        <div class="product-code">كود : 543215114</div>

                                                    </a>

                                                </div>
                                                <div class="product-body">

                                                    <div class="price-info">

                                                        <p class="price-val">

                                                            <span>1.000.000 </span>
                                                            دولارًا

                                                        </p>

                                                        <p class="price-points">


                                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="13.945" height="13" viewBox="0 0 13.945 13"><defs><clipPath id="clip-path"><rect id="Rectangle_35" data-name="Rectangle 35" width="13.946" height="13" transform="translate(1149.69 2020)" fill="#fff"/></clipPath></defs><g id="Group_16" data-name="Group 16" transform="translate(-1149.69 -2020)" clip-path="url(#clip-path)"><path id="Path_89" data-name="Path 89" d="M1163.64,2026.5a6.3,6.3,0,0,1-1.88,4.44,7.116,7.116,0,0,1-5.1,1.95,6.543,6.543,0,0,1-6.84-6.39,6.186,6.186,0,0,1,2.08-4.75,7.215,7.215,0,0,1,4.76-1.75A6.756,6.756,0,0,1,1163.64,2026.5Z" fill="#ffd05b"/><path id="Path_90" data-name="Path 90" d="M1156.66,2031.74a5.253,5.253,0,1,0-5.62-5.24A5.448,5.448,0,0,0,1156.66,2031.74Z" fill="#ffeaa5"/><path id="Path_91" data-name="Path 91" d="M1161.39,2026.5a4.208,4.208,0,0,1-1.19,2.92,4.793,4.793,0,0,1-3.54,1.37,4.337,4.337,0,0,1-4.56-4.29,4.1,4.1,0,0,1,1.43-3.29,4.892,4.892,0,0,1,3.13-1.11,4.575,4.575,0,0,1,4.73,4.4Z" fill="#ffe077"/><path id="Path_92" data-name="Path 92" d="M1157.79,2026.71l-.92-2.22a.231.231,0,0,0-.42,0l-.91,2.22-1.18-.83-.15.19.93,2.58,3.46-.26.78-2.32a.224.224,0,0,0-.35-.23Z" fill="#ffc244"/><path id="Path_93" data-name="Path 93" d="M1157,2032.69a6.747,6.747,0,0,1-6.97-6.5,6.255,6.255,0,0,1,1.87-4.44,6.3,6.3,0,0,0-2.21,4.75,6.747,6.747,0,0,0,6.97,6.5,7.2,7.2,0,0,0,5.1-2.06,7.266,7.266,0,0,1-4.76,1.75Z" fill="#ffc244"/><path id="Path_94" data-name="Path 94" d="M1157.06,2030.54a4.577,4.577,0,0,1-4.73-4.41,4.191,4.191,0,0,1,1.2-2.92,4.253,4.253,0,0,0-1.59,3.29,4.567,4.567,0,0,0,4.72,4.4,4.876,4.876,0,0,0,3.54-1.48,4.948,4.948,0,0,1-3.14,1.12Z" fill="#ffd05b"/><path id="Path_95" data-name="Path 95" d="M1155,2027.8l-.64-1.92-.06-.04c-.18-.12-.42.04-.35.23l.82,2.44a.432.432,0,0,0,.42.3h2.94a.445.445,0,0,0,.43-.3l.04-.12h-2.74a.894.894,0,0,1-.86-.59Z" fill="#ffaa5a"/></g></svg>

                                                            5160

                                                        </p>

                                                    </div>

                                                    <div class="product-desc">

                                                        <a href="product-default.html">

                                                            بنطلون جينز رجالي ضيق مثال
                                                            بقصة ضيقة 
                                                             بنطلون جينز رجالي ضيق مثال

                                                        </a>

                                                    </div>

                                                    <div class="product-actions">

                                                        <div class="cart-action ">

                                                            <a class="btn-cart loading-btn" href="#">

                                                                <p class="add-to-cart">
                                                                    <span>إضافة للسلة </span>
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="21.5" height="21.5" viewBox="0 0 21.5 21.5"><path id="Path_4843" data-name="Path 4843" d="M394,733.5a1.5,1.5,0,1,1-1.5-1.5A1.5,1.5,0,0,1,394,733.5Z" transform="translate(-384.25 -714.25)" fill="none" stroke="#fff" stroke-width="1.5"/><path id="Path_4844" data-name="Path 4844" d="M403,733.5a1.5,1.5,0,1,1-1.5-1.5A1.5,1.5,0,0,1,403,733.5Z" transform="translate(-384.25 -714.25)" fill="none" stroke="#fff" stroke-width="1.5"/><path id="Path_4846" data-name="Path 4846" d="M389,717h12a4,4,0,0,1,4,4v5a4,4,0,0,1-4,4h-8a4,4,0,0,1-4-4Zm0,0a2,2,0,0,0-2-2h-2" transform="translate(-384.25 -714.25)" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/></svg>

                                                                </p>

                                                                <p class="added">

                                                                    <span>في السلة </span>
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="21.5" height="21.5" viewBox="0 0 21.5 21.5"><path id="Path_4843" data-name="Path 4843" d="M394,733.5a1.5,1.5,0,1,1-1.5-1.5A1.5,1.5,0,0,1,394,733.5Z" transform="translate(-384.25 -714.25)" fill="none" stroke="#fff" stroke-width="1.5"/><path id="Path_4844" data-name="Path 4844" d="M403,733.5a1.5,1.5,0,1,1-1.5-1.5A1.5,1.5,0,0,1,403,733.5Z" transform="translate(-384.25 -714.25)" fill="none" stroke="#fff" stroke-width="1.5"/><path id="Path_4845" data-name="Path 4845" d="M394,724l1.753,1.4a1,1,0,0,0,1.377-.122L400,722" transform="translate(-384.25 -714.25)" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/><path id="Path_4846" data-name="Path 4846" d="M389,717h12a4,4,0,0,1,4,4v5a4,4,0,0,1-4,4h-8a4,4,0,0,1-4-4Zm0,0a2,2,0,0,0-2-2h-2" transform="translate(-384.25 -714.25)" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/></svg>

                                                                </p> 

                                                            </a>

                                                        </div>
                                                        <div class="counter-wrap ">

                                                            <div class="count-wrap form-group">

                                                                <button type="button" class="count-btn count-add" data-type="plus">

                                                                    <span class="count-icon add-icon">

                                                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" width="45px" height="45px" viewBox="0 0 45 45" style="enable-background:new 0 0 45 45;" xml:space="preserve"><g><path d="M41.267,18.557H26.832V4.134C26.832,1.851,24.99,0,22.707,0c-2.283,0-4.124,1.851-4.124,4.135v14.432H4.141   c-2.283,0-4.139,1.851-4.138,4.135c-0.001,1.141,0.46,2.187,1.207,2.934c0.748,0.749,1.78,1.222,2.92,1.222h14.453V41.27   c0,1.142,0.453,2.176,1.201,2.922c0.748,0.748,1.777,1.211,2.919,1.211c2.282,0,4.129-1.851,4.129-4.133V26.857h14.435   c2.283,0,4.134-1.867,4.133-4.15C45.399,20.425,43.548,18.557,41.267,18.557z"></path></g></svg>

                                                                    </span>

                                                                </button>

                                                                <input type="text" class="count-num form-control " value="1" step="1" inputmode="tel" min="1" max="1000" autocomplete="off">

                                                                <button type="button" class="count-btn count-sub disabled" data-type="minus">

                                                                    <span class="count-icon sub-icon">

                                                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 42 42" style="enable-background:new 0 0 42 42;" xml:space="preserve"><path d="M37.059,16H26H16H4.941C2.224,16,0,18.282,0,21s2.224,5,4.941,5H16h10h11.059C39.776,26,42,23.718,42,21  S39.776,16,37.059,16z"></path></svg>

                                                                    </span>

                                                                </button>

                                                            </div>

                                                        </div>

                                                    </div>


                                                </div>


                                            </div>


                                    </div>
                                    <div class="swiper-slide product-wrap">

                                           <div class="product-item">

                                                <div class="product-img">

                                                    <a href="product-default.html">

                                                        <span class="tt-img">

                                                           <img class="img-fluid" src="{{asset('img/p1.png')}}" alt="productName">

                                                       </span>
                                                        <div class="product-code">كود : 543215114</div>

                                                    </a>

                                                </div>
                                                <div class="product-body">

                                                    <div class="price-info">

                                                        <p class="price-val">

                                                            <span>1.000.000 </span>
                                                            دولارًا

                                                        </p>

                                                        <p class="price-points">


                                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="13.945" height="13" viewBox="0 0 13.945 13"><defs><clipPath id="clip-path"><rect id="Rectangle_35" data-name="Rectangle 35" width="13.946" height="13" transform="translate(1149.69 2020)" fill="#fff"/></clipPath></defs><g id="Group_16" data-name="Group 16" transform="translate(-1149.69 -2020)" clip-path="url(#clip-path)"><path id="Path_89" data-name="Path 89" d="M1163.64,2026.5a6.3,6.3,0,0,1-1.88,4.44,7.116,7.116,0,0,1-5.1,1.95,6.543,6.543,0,0,1-6.84-6.39,6.186,6.186,0,0,1,2.08-4.75,7.215,7.215,0,0,1,4.76-1.75A6.756,6.756,0,0,1,1163.64,2026.5Z" fill="#ffd05b"/><path id="Path_90" data-name="Path 90" d="M1156.66,2031.74a5.253,5.253,0,1,0-5.62-5.24A5.448,5.448,0,0,0,1156.66,2031.74Z" fill="#ffeaa5"/><path id="Path_91" data-name="Path 91" d="M1161.39,2026.5a4.208,4.208,0,0,1-1.19,2.92,4.793,4.793,0,0,1-3.54,1.37,4.337,4.337,0,0,1-4.56-4.29,4.1,4.1,0,0,1,1.43-3.29,4.892,4.892,0,0,1,3.13-1.11,4.575,4.575,0,0,1,4.73,4.4Z" fill="#ffe077"/><path id="Path_92" data-name="Path 92" d="M1157.79,2026.71l-.92-2.22a.231.231,0,0,0-.42,0l-.91,2.22-1.18-.83-.15.19.93,2.58,3.46-.26.78-2.32a.224.224,0,0,0-.35-.23Z" fill="#ffc244"/><path id="Path_93" data-name="Path 93" d="M1157,2032.69a6.747,6.747,0,0,1-6.97-6.5,6.255,6.255,0,0,1,1.87-4.44,6.3,6.3,0,0,0-2.21,4.75,6.747,6.747,0,0,0,6.97,6.5,7.2,7.2,0,0,0,5.1-2.06,7.266,7.266,0,0,1-4.76,1.75Z" fill="#ffc244"/><path id="Path_94" data-name="Path 94" d="M1157.06,2030.54a4.577,4.577,0,0,1-4.73-4.41,4.191,4.191,0,0,1,1.2-2.92,4.253,4.253,0,0,0-1.59,3.29,4.567,4.567,0,0,0,4.72,4.4,4.876,4.876,0,0,0,3.54-1.48,4.948,4.948,0,0,1-3.14,1.12Z" fill="#ffd05b"/><path id="Path_95" data-name="Path 95" d="M1155,2027.8l-.64-1.92-.06-.04c-.18-.12-.42.04-.35.23l.82,2.44a.432.432,0,0,0,.42.3h2.94a.445.445,0,0,0,.43-.3l.04-.12h-2.74a.894.894,0,0,1-.86-.59Z" fill="#ffaa5a"/></g></svg>

                                                            5160

                                                        </p>

                                                    </div>

                                                    <div class="product-desc">

                                                        <a href="product-default.html">

                                                            بنطلون جينز رجالي ضيق مثال
                                                            بقصة ضيقة 
                                                             بنطلون جينز رجالي ضيق مثال

                                                        </a>

                                                    </div>

                                                    <div class="product-actions">

                                                        <div class="cart-action ">

                                                            <a class="btn-cart loading-btn" href="#">

                                                                <p class="add-to-cart">
                                                                    <span>إضافة للسلة </span>
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="21.5" height="21.5" viewBox="0 0 21.5 21.5"><path id="Path_4843" data-name="Path 4843" d="M394,733.5a1.5,1.5,0,1,1-1.5-1.5A1.5,1.5,0,0,1,394,733.5Z" transform="translate(-384.25 -714.25)" fill="none" stroke="#fff" stroke-width="1.5"/><path id="Path_4844" data-name="Path 4844" d="M403,733.5a1.5,1.5,0,1,1-1.5-1.5A1.5,1.5,0,0,1,403,733.5Z" transform="translate(-384.25 -714.25)" fill="none" stroke="#fff" stroke-width="1.5"/><path id="Path_4846" data-name="Path 4846" d="M389,717h12a4,4,0,0,1,4,4v5a4,4,0,0,1-4,4h-8a4,4,0,0,1-4-4Zm0,0a2,2,0,0,0-2-2h-2" transform="translate(-384.25 -714.25)" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/></svg>

                                                                </p>

                                                                <p class="added">

                                                                    <span>في السلة </span>
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="21.5" height="21.5" viewBox="0 0 21.5 21.5"><path id="Path_4843" data-name="Path 4843" d="M394,733.5a1.5,1.5,0,1,1-1.5-1.5A1.5,1.5,0,0,1,394,733.5Z" transform="translate(-384.25 -714.25)" fill="none" stroke="#fff" stroke-width="1.5"/><path id="Path_4844" data-name="Path 4844" d="M403,733.5a1.5,1.5,0,1,1-1.5-1.5A1.5,1.5,0,0,1,403,733.5Z" transform="translate(-384.25 -714.25)" fill="none" stroke="#fff" stroke-width="1.5"/><path id="Path_4845" data-name="Path 4845" d="M394,724l1.753,1.4a1,1,0,0,0,1.377-.122L400,722" transform="translate(-384.25 -714.25)" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/><path id="Path_4846" data-name="Path 4846" d="M389,717h12a4,4,0,0,1,4,4v5a4,4,0,0,1-4,4h-8a4,4,0,0,1-4-4Zm0,0a2,2,0,0,0-2-2h-2" transform="translate(-384.25 -714.25)" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/></svg>

                                                                </p> 

                                                            </a>

                                                        </div>
                                                        <div class="counter-wrap ">

                                                            <div class="count-wrap form-group">

                                                                <button type="button" class="count-btn count-add" data-type="plus">

                                                                    <span class="count-icon add-icon">

                                                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" width="45px" height="45px" viewBox="0 0 45 45" style="enable-background:new 0 0 45 45;" xml:space="preserve"><g><path d="M41.267,18.557H26.832V4.134C26.832,1.851,24.99,0,22.707,0c-2.283,0-4.124,1.851-4.124,4.135v14.432H4.141   c-2.283,0-4.139,1.851-4.138,4.135c-0.001,1.141,0.46,2.187,1.207,2.934c0.748,0.749,1.78,1.222,2.92,1.222h14.453V41.27   c0,1.142,0.453,2.176,1.201,2.922c0.748,0.748,1.777,1.211,2.919,1.211c2.282,0,4.129-1.851,4.129-4.133V26.857h14.435   c2.283,0,4.134-1.867,4.133-4.15C45.399,20.425,43.548,18.557,41.267,18.557z"></path></g></svg>

                                                                    </span>

                                                                </button>

                                                                <input type="text" class="count-num form-control " value="1" step="1" inputmode="tel" min="1" max="1000" autocomplete="off">

                                                                <button type="button" class="count-btn count-sub disabled" data-type="minus">

                                                                    <span class="count-icon sub-icon">

                                                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 42 42" style="enable-background:new 0 0 42 42;" xml:space="preserve"><path d="M37.059,16H26H16H4.941C2.224,16,0,18.282,0,21s2.224,5,4.941,5H16h10h11.059C39.776,26,42,23.718,42,21  S39.776,16,37.059,16z"></path></svg>

                                                                    </span>

                                                                </button>

                                                            </div>

                                                        </div>

                                                    </div>


                                                </div>


                                            </div>


                                    </div>
                                    

                                </div>

                            </div>

                            <div class="slider-arrow prev-btn">

                                  <i class="fas fa-chevron-right "></i>

                              </div>

                            <div class="slider-arrow next-btn" >


                                  <i class="fas fa-chevron-left "></i>
                            </div>


                        </div>

                    </div>
                    <div class="row-categories">
                        
                        <div class="flex-head">

                              <div class="main-title sub-title gray-clr">

                                  <h1 class="title ">منتجات النقاط</h1>

                             </div>
                              <a class="more-link hvr-underline-from-right" href="products.html">عرض الكل</a>


                         </div>
                        <div class="row-container slider-container product-slider-container">

                            <div class="swiper product-slider duplicated-products-slider scroll-row">

                                <div class="swiper-wrapper target-row">

                                    <div class="swiper-slide product-wrap">

                                           <div class="product-item">

                                                <div class="product-img">

                                                    <a href="product-default.html">

                                                        <span class="tt-img">

                                                           <img class="img-fluid" src="{{asset('img/p1.png')}}" alt="productName">

                                                       </span>
                                                        <div class="product-code">كود : 543215114</div>

                                                    </a>

                                                </div>
                                                <div class="product-body">

                                                    <div class="price-info">

                                                        <p class="price-val">

                                                            <span>1.000.000 </span>
                                                            دولارًا

                                                        </p>

                                                        <p class="price-points w__bg">


                                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="13.945" height="13" viewBox="0 0 13.945 13"><defs><clipPath id="clip-path"><rect id="Rectangle_35" data-name="Rectangle 35" width="13.946" height="13" transform="translate(1149.69 2020)" fill="#fff"/></clipPath></defs><g id="Group_16" data-name="Group 16" transform="translate(-1149.69 -2020)" clip-path="url(#clip-path)"><path id="Path_89" data-name="Path 89" d="M1163.64,2026.5a6.3,6.3,0,0,1-1.88,4.44,7.116,7.116,0,0,1-5.1,1.95,6.543,6.543,0,0,1-6.84-6.39,6.186,6.186,0,0,1,2.08-4.75,7.215,7.215,0,0,1,4.76-1.75A6.756,6.756,0,0,1,1163.64,2026.5Z" fill="#ffd05b"/><path id="Path_90" data-name="Path 90" d="M1156.66,2031.74a5.253,5.253,0,1,0-5.62-5.24A5.448,5.448,0,0,0,1156.66,2031.74Z" fill="#ffeaa5"/><path id="Path_91" data-name="Path 91" d="M1161.39,2026.5a4.208,4.208,0,0,1-1.19,2.92,4.793,4.793,0,0,1-3.54,1.37,4.337,4.337,0,0,1-4.56-4.29,4.1,4.1,0,0,1,1.43-3.29,4.892,4.892,0,0,1,3.13-1.11,4.575,4.575,0,0,1,4.73,4.4Z" fill="#ffe077"/><path id="Path_92" data-name="Path 92" d="M1157.79,2026.71l-.92-2.22a.231.231,0,0,0-.42,0l-.91,2.22-1.18-.83-.15.19.93,2.58,3.46-.26.78-2.32a.224.224,0,0,0-.35-.23Z" fill="#ffc244"/><path id="Path_93" data-name="Path 93" d="M1157,2032.69a6.747,6.747,0,0,1-6.97-6.5,6.255,6.255,0,0,1,1.87-4.44,6.3,6.3,0,0,0-2.21,4.75,6.747,6.747,0,0,0,6.97,6.5,7.2,7.2,0,0,0,5.1-2.06,7.266,7.266,0,0,1-4.76,1.75Z" fill="#ffc244"/><path id="Path_94" data-name="Path 94" d="M1157.06,2030.54a4.577,4.577,0,0,1-4.73-4.41,4.191,4.191,0,0,1,1.2-2.92,4.253,4.253,0,0,0-1.59,3.29,4.567,4.567,0,0,0,4.72,4.4,4.876,4.876,0,0,0,3.54-1.48,4.948,4.948,0,0,1-3.14,1.12Z" fill="#ffd05b"/><path id="Path_95" data-name="Path 95" d="M1155,2027.8l-.64-1.92-.06-.04c-.18-.12-.42.04-.35.23l.82,2.44a.432.432,0,0,0,.42.3h2.94a.445.445,0,0,0,.43-.3l.04-.12h-2.74a.894.894,0,0,1-.86-.59Z" fill="#ffaa5a"/></g></svg>

                                                            5160

                                                        </p>

                                                    </div>

                                                    <div class="product-desc">

                                                        <a href="product-default.html">

                                                            بنطلون جينز رجالي ضيق مثال
                                                            بقصة ضيقة 
                                                             بنطلون جينز رجالي ضيق مثال

                                                        </a>

                                                    </div>

                                                    <div class="product-actions">

                                                        <div class="cart-action ">

                                                            <a class="btn-cart loading-btn" href="#">

                                                                <p class="add-to-cart">
                                                                    <span>إضافة للسلة </span>
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="21.5" height="21.5" viewBox="0 0 21.5 21.5"><path id="Path_4843" data-name="Path 4843" d="M394,733.5a1.5,1.5,0,1,1-1.5-1.5A1.5,1.5,0,0,1,394,733.5Z" transform="translate(-384.25 -714.25)" fill="none" stroke="#fff" stroke-width="1.5"/><path id="Path_4844" data-name="Path 4844" d="M403,733.5a1.5,1.5,0,1,1-1.5-1.5A1.5,1.5,0,0,1,403,733.5Z" transform="translate(-384.25 -714.25)" fill="none" stroke="#fff" stroke-width="1.5"/><path id="Path_4846" data-name="Path 4846" d="M389,717h12a4,4,0,0,1,4,4v5a4,4,0,0,1-4,4h-8a4,4,0,0,1-4-4Zm0,0a2,2,0,0,0-2-2h-2" transform="translate(-384.25 -714.25)" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/></svg>

                                                                </p>

                                                                <p class="added">

                                                                    <span>في السلة </span>
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="21.5" height="21.5" viewBox="0 0 21.5 21.5"><path id="Path_4843" data-name="Path 4843" d="M394,733.5a1.5,1.5,0,1,1-1.5-1.5A1.5,1.5,0,0,1,394,733.5Z" transform="translate(-384.25 -714.25)" fill="none" stroke="#fff" stroke-width="1.5"/><path id="Path_4844" data-name="Path 4844" d="M403,733.5a1.5,1.5,0,1,1-1.5-1.5A1.5,1.5,0,0,1,403,733.5Z" transform="translate(-384.25 -714.25)" fill="none" stroke="#fff" stroke-width="1.5"/><path id="Path_4845" data-name="Path 4845" d="M394,724l1.753,1.4a1,1,0,0,0,1.377-.122L400,722" transform="translate(-384.25 -714.25)" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/><path id="Path_4846" data-name="Path 4846" d="M389,717h12a4,4,0,0,1,4,4v5a4,4,0,0,1-4,4h-8a4,4,0,0,1-4-4Zm0,0a2,2,0,0,0-2-2h-2" transform="translate(-384.25 -714.25)" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/></svg>

                                                                </p> 

                                                            </a>

                                                        </div>
                                                        <div class="counter-wrap ">

                                                            <div class="count-wrap form-group">

                                                                <button type="button" class="count-btn count-add" data-type="plus">

                                                                    <span class="count-icon add-icon">

                                                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" width="45px" height="45px" viewBox="0 0 45 45" style="enable-background:new 0 0 45 45;" xml:space="preserve"><g><path d="M41.267,18.557H26.832V4.134C26.832,1.851,24.99,0,22.707,0c-2.283,0-4.124,1.851-4.124,4.135v14.432H4.141   c-2.283,0-4.139,1.851-4.138,4.135c-0.001,1.141,0.46,2.187,1.207,2.934c0.748,0.749,1.78,1.222,2.92,1.222h14.453V41.27   c0,1.142,0.453,2.176,1.201,2.922c0.748,0.748,1.777,1.211,2.919,1.211c2.282,0,4.129-1.851,4.129-4.133V26.857h14.435   c2.283,0,4.134-1.867,4.133-4.15C45.399,20.425,43.548,18.557,41.267,18.557z"></path></g></svg>

                                                                    </span>

                                                                </button>

                                                                <input type="text" class="count-num form-control " value="1" step="1" inputmode="tel" min="1" max="1000" autocomplete="off">

                                                                <button type="button" class="count-btn count-sub disabled" data-type="minus">

                                                                    <span class="count-icon sub-icon">

                                                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 42 42" style="enable-background:new 0 0 42 42;" xml:space="preserve"><path d="M37.059,16H26H16H4.941C2.224,16,0,18.282,0,21s2.224,5,4.941,5H16h10h11.059C39.776,26,42,23.718,42,21  S39.776,16,37.059,16z"></path></svg>

                                                                    </span>

                                                                </button>

                                                            </div>

                                                        </div>

                                                    </div>


                                                </div>


                                            </div>


                                    </div>
                                    <div class="swiper-slide product-wrap">

                                           <div class="product-item">

                                                <div class="product-img">

                                                    <a href="product-default.html">

                                                        <span class="tt-img">

                                                           <img class="img-fluid" src="{{asset('img/p1.png')}}" alt="productName">

                                                       </span>
                                                        <div class="product-code">كود : 543215114</div>

                                                    </a>

                                                </div>
                                                <div class="product-body">

                                                    <div class="price-info">

                                                        <p class="price-val">

                                                            <span>1.000.000 </span>
                                                            دولارًا

                                                        </p>

                                                        <p class="price-points w__bg">


                                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="13.945" height="13" viewBox="0 0 13.945 13"><defs><clipPath id="clip-path"><rect id="Rectangle_35" data-name="Rectangle 35" width="13.946" height="13" transform="translate(1149.69 2020)" fill="#fff"/></clipPath></defs><g id="Group_16" data-name="Group 16" transform="translate(-1149.69 -2020)" clip-path="url(#clip-path)"><path id="Path_89" data-name="Path 89" d="M1163.64,2026.5a6.3,6.3,0,0,1-1.88,4.44,7.116,7.116,0,0,1-5.1,1.95,6.543,6.543,0,0,1-6.84-6.39,6.186,6.186,0,0,1,2.08-4.75,7.215,7.215,0,0,1,4.76-1.75A6.756,6.756,0,0,1,1163.64,2026.5Z" fill="#ffd05b"/><path id="Path_90" data-name="Path 90" d="M1156.66,2031.74a5.253,5.253,0,1,0-5.62-5.24A5.448,5.448,0,0,0,1156.66,2031.74Z" fill="#ffeaa5"/><path id="Path_91" data-name="Path 91" d="M1161.39,2026.5a4.208,4.208,0,0,1-1.19,2.92,4.793,4.793,0,0,1-3.54,1.37,4.337,4.337,0,0,1-4.56-4.29,4.1,4.1,0,0,1,1.43-3.29,4.892,4.892,0,0,1,3.13-1.11,4.575,4.575,0,0,1,4.73,4.4Z" fill="#ffe077"/><path id="Path_92" data-name="Path 92" d="M1157.79,2026.71l-.92-2.22a.231.231,0,0,0-.42,0l-.91,2.22-1.18-.83-.15.19.93,2.58,3.46-.26.78-2.32a.224.224,0,0,0-.35-.23Z" fill="#ffc244"/><path id="Path_93" data-name="Path 93" d="M1157,2032.69a6.747,6.747,0,0,1-6.97-6.5,6.255,6.255,0,0,1,1.87-4.44,6.3,6.3,0,0,0-2.21,4.75,6.747,6.747,0,0,0,6.97,6.5,7.2,7.2,0,0,0,5.1-2.06,7.266,7.266,0,0,1-4.76,1.75Z" fill="#ffc244"/><path id="Path_94" data-name="Path 94" d="M1157.06,2030.54a4.577,4.577,0,0,1-4.73-4.41,4.191,4.191,0,0,1,1.2-2.92,4.253,4.253,0,0,0-1.59,3.29,4.567,4.567,0,0,0,4.72,4.4,4.876,4.876,0,0,0,3.54-1.48,4.948,4.948,0,0,1-3.14,1.12Z" fill="#ffd05b"/><path id="Path_95" data-name="Path 95" d="M1155,2027.8l-.64-1.92-.06-.04c-.18-.12-.42.04-.35.23l.82,2.44a.432.432,0,0,0,.42.3h2.94a.445.445,0,0,0,.43-.3l.04-.12h-2.74a.894.894,0,0,1-.86-.59Z" fill="#ffaa5a"/></g></svg>

                                                            5160

                                                        </p>

                                                    </div>

                                                    <div class="product-desc">

                                                        <a href="product-default.html">

                                                            بنطلون جينز رجالي ضيق مثال
                                                            بقصة ضيقة 
                                                             بنطلون جينز رجالي ضيق مثال

                                                        </a>

                                                    </div>

                                                    <div class="product-actions">

                                                        <div class="cart-action ">

                                                            <a class="btn-cart loading-btn" href="#">

                                                                <p class="add-to-cart">
                                                                    <span>إضافة للسلة </span>
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="21.5" height="21.5" viewBox="0 0 21.5 21.5"><path id="Path_4843" data-name="Path 4843" d="M394,733.5a1.5,1.5,0,1,1-1.5-1.5A1.5,1.5,0,0,1,394,733.5Z" transform="translate(-384.25 -714.25)" fill="none" stroke="#fff" stroke-width="1.5"/><path id="Path_4844" data-name="Path 4844" d="M403,733.5a1.5,1.5,0,1,1-1.5-1.5A1.5,1.5,0,0,1,403,733.5Z" transform="translate(-384.25 -714.25)" fill="none" stroke="#fff" stroke-width="1.5"/><path id="Path_4846" data-name="Path 4846" d="M389,717h12a4,4,0,0,1,4,4v5a4,4,0,0,1-4,4h-8a4,4,0,0,1-4-4Zm0,0a2,2,0,0,0-2-2h-2" transform="translate(-384.25 -714.25)" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/></svg>

                                                                </p>

                                                                <p class="added">

                                                                    <span>في السلة </span>
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="21.5" height="21.5" viewBox="0 0 21.5 21.5"><path id="Path_4843" data-name="Path 4843" d="M394,733.5a1.5,1.5,0,1,1-1.5-1.5A1.5,1.5,0,0,1,394,733.5Z" transform="translate(-384.25 -714.25)" fill="none" stroke="#fff" stroke-width="1.5"/><path id="Path_4844" data-name="Path 4844" d="M403,733.5a1.5,1.5,0,1,1-1.5-1.5A1.5,1.5,0,0,1,403,733.5Z" transform="translate(-384.25 -714.25)" fill="none" stroke="#fff" stroke-width="1.5"/><path id="Path_4845" data-name="Path 4845" d="M394,724l1.753,1.4a1,1,0,0,0,1.377-.122L400,722" transform="translate(-384.25 -714.25)" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/><path id="Path_4846" data-name="Path 4846" d="M389,717h12a4,4,0,0,1,4,4v5a4,4,0,0,1-4,4h-8a4,4,0,0,1-4-4Zm0,0a2,2,0,0,0-2-2h-2" transform="translate(-384.25 -714.25)" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/></svg>

                                                                </p> 

                                                            </a>

                                                        </div>
                                                        <div class="counter-wrap ">

                                                            <div class="count-wrap form-group">

                                                                <button type="button" class="count-btn count-add" data-type="plus">

                                                                    <span class="count-icon add-icon">

                                                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" width="45px" height="45px" viewBox="0 0 45 45" style="enable-background:new 0 0 45 45;" xml:space="preserve"><g><path d="M41.267,18.557H26.832V4.134C26.832,1.851,24.99,0,22.707,0c-2.283,0-4.124,1.851-4.124,4.135v14.432H4.141   c-2.283,0-4.139,1.851-4.138,4.135c-0.001,1.141,0.46,2.187,1.207,2.934c0.748,0.749,1.78,1.222,2.92,1.222h14.453V41.27   c0,1.142,0.453,2.176,1.201,2.922c0.748,0.748,1.777,1.211,2.919,1.211c2.282,0,4.129-1.851,4.129-4.133V26.857h14.435   c2.283,0,4.134-1.867,4.133-4.15C45.399,20.425,43.548,18.557,41.267,18.557z"></path></g></svg>

                                                                    </span>

                                                                </button>

                                                                <input type="text" class="count-num form-control " value="1" step="1" inputmode="tel" min="1" max="1000" autocomplete="off">

                                                                <button type="button" class="count-btn count-sub disabled" data-type="minus">

                                                                    <span class="count-icon sub-icon">

                                                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 42 42" style="enable-background:new 0 0 42 42;" xml:space="preserve"><path d="M37.059,16H26H16H4.941C2.224,16,0,18.282,0,21s2.224,5,4.941,5H16h10h11.059C39.776,26,42,23.718,42,21  S39.776,16,37.059,16z"></path></svg>

                                                                    </span>

                                                                </button>

                                                            </div>

                                                        </div>

                                                    </div>


                                                </div>


                                            </div>


                                    </div>
                                    <div class="swiper-slide product-wrap">

                                           <div class="product-item">

                                                <div class="product-img">

                                                    <a href="product-default.html">

                                                        <span class="tt-img">

                                                           <img class="img-fluid" src="{{asset('img/p1.png')}}" alt="productName">

                                                       </span>
                                                        <div class="product-code">كود : 543215114</div>

                                                    </a>

                                                </div>
                                                <div class="product-body">

                                                    <div class="price-info">

                                                        <p class="price-val">

                                                            <span>1.000.000 </span>
                                                            دولارًا

                                                        </p>

                                                        <p class="price-points w__bg">


                                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="13.945" height="13" viewBox="0 0 13.945 13"><defs><clipPath id="clip-path"><rect id="Rectangle_35" data-name="Rectangle 35" width="13.946" height="13" transform="translate(1149.69 2020)" fill="#fff"/></clipPath></defs><g id="Group_16" data-name="Group 16" transform="translate(-1149.69 -2020)" clip-path="url(#clip-path)"><path id="Path_89" data-name="Path 89" d="M1163.64,2026.5a6.3,6.3,0,0,1-1.88,4.44,7.116,7.116,0,0,1-5.1,1.95,6.543,6.543,0,0,1-6.84-6.39,6.186,6.186,0,0,1,2.08-4.75,7.215,7.215,0,0,1,4.76-1.75A6.756,6.756,0,0,1,1163.64,2026.5Z" fill="#ffd05b"/><path id="Path_90" data-name="Path 90" d="M1156.66,2031.74a5.253,5.253,0,1,0-5.62-5.24A5.448,5.448,0,0,0,1156.66,2031.74Z" fill="#ffeaa5"/><path id="Path_91" data-name="Path 91" d="M1161.39,2026.5a4.208,4.208,0,0,1-1.19,2.92,4.793,4.793,0,0,1-3.54,1.37,4.337,4.337,0,0,1-4.56-4.29,4.1,4.1,0,0,1,1.43-3.29,4.892,4.892,0,0,1,3.13-1.11,4.575,4.575,0,0,1,4.73,4.4Z" fill="#ffe077"/><path id="Path_92" data-name="Path 92" d="M1157.79,2026.71l-.92-2.22a.231.231,0,0,0-.42,0l-.91,2.22-1.18-.83-.15.19.93,2.58,3.46-.26.78-2.32a.224.224,0,0,0-.35-.23Z" fill="#ffc244"/><path id="Path_93" data-name="Path 93" d="M1157,2032.69a6.747,6.747,0,0,1-6.97-6.5,6.255,6.255,0,0,1,1.87-4.44,6.3,6.3,0,0,0-2.21,4.75,6.747,6.747,0,0,0,6.97,6.5,7.2,7.2,0,0,0,5.1-2.06,7.266,7.266,0,0,1-4.76,1.75Z" fill="#ffc244"/><path id="Path_94" data-name="Path 94" d="M1157.06,2030.54a4.577,4.577,0,0,1-4.73-4.41,4.191,4.191,0,0,1,1.2-2.92,4.253,4.253,0,0,0-1.59,3.29,4.567,4.567,0,0,0,4.72,4.4,4.876,4.876,0,0,0,3.54-1.48,4.948,4.948,0,0,1-3.14,1.12Z" fill="#ffd05b"/><path id="Path_95" data-name="Path 95" d="M1155,2027.8l-.64-1.92-.06-.04c-.18-.12-.42.04-.35.23l.82,2.44a.432.432,0,0,0,.42.3h2.94a.445.445,0,0,0,.43-.3l.04-.12h-2.74a.894.894,0,0,1-.86-.59Z" fill="#ffaa5a"/></g></svg>

                                                            5160

                                                        </p>

                                                    </div>

                                                    <div class="product-desc">

                                                        <a href="product-default.html">

                                                            بنطلون جينز رجالي ضيق مثال
                                                            بقصة ضيقة 
                                                             بنطلون جينز رجالي ضيق مثال

                                                        </a>

                                                    </div>

                                                    <div class="product-actions">

                                                        <div class="cart-action ">

                                                            <a class="btn-cart loading-btn" href="#">

                                                                <p class="add-to-cart">
                                                                    <span>إضافة للسلة </span>
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="21.5" height="21.5" viewBox="0 0 21.5 21.5"><path id="Path_4843" data-name="Path 4843" d="M394,733.5a1.5,1.5,0,1,1-1.5-1.5A1.5,1.5,0,0,1,394,733.5Z" transform="translate(-384.25 -714.25)" fill="none" stroke="#fff" stroke-width="1.5"/><path id="Path_4844" data-name="Path 4844" d="M403,733.5a1.5,1.5,0,1,1-1.5-1.5A1.5,1.5,0,0,1,403,733.5Z" transform="translate(-384.25 -714.25)" fill="none" stroke="#fff" stroke-width="1.5"/><path id="Path_4846" data-name="Path 4846" d="M389,717h12a4,4,0,0,1,4,4v5a4,4,0,0,1-4,4h-8a4,4,0,0,1-4-4Zm0,0a2,2,0,0,0-2-2h-2" transform="translate(-384.25 -714.25)" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/></svg>

                                                                </p>

                                                                <p class="added">

                                                                    <span>في السلة </span>
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="21.5" height="21.5" viewBox="0 0 21.5 21.5"><path id="Path_4843" data-name="Path 4843" d="M394,733.5a1.5,1.5,0,1,1-1.5-1.5A1.5,1.5,0,0,1,394,733.5Z" transform="translate(-384.25 -714.25)" fill="none" stroke="#fff" stroke-width="1.5"/><path id="Path_4844" data-name="Path 4844" d="M403,733.5a1.5,1.5,0,1,1-1.5-1.5A1.5,1.5,0,0,1,403,733.5Z" transform="translate(-384.25 -714.25)" fill="none" stroke="#fff" stroke-width="1.5"/><path id="Path_4845" data-name="Path 4845" d="M394,724l1.753,1.4a1,1,0,0,0,1.377-.122L400,722" transform="translate(-384.25 -714.25)" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/><path id="Path_4846" data-name="Path 4846" d="M389,717h12a4,4,0,0,1,4,4v5a4,4,0,0,1-4,4h-8a4,4,0,0,1-4-4Zm0,0a2,2,0,0,0-2-2h-2" transform="translate(-384.25 -714.25)" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/></svg>

                                                                </p> 

                                                            </a>

                                                        </div>
                                                        <div class="counter-wrap ">

                                                            <div class="count-wrap form-group">

                                                                <button type="button" class="count-btn count-add" data-type="plus">

                                                                    <span class="count-icon add-icon">

                                                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" width="45px" height="45px" viewBox="0 0 45 45" style="enable-background:new 0 0 45 45;" xml:space="preserve"><g><path d="M41.267,18.557H26.832V4.134C26.832,1.851,24.99,0,22.707,0c-2.283,0-4.124,1.851-4.124,4.135v14.432H4.141   c-2.283,0-4.139,1.851-4.138,4.135c-0.001,1.141,0.46,2.187,1.207,2.934c0.748,0.749,1.78,1.222,2.92,1.222h14.453V41.27   c0,1.142,0.453,2.176,1.201,2.922c0.748,0.748,1.777,1.211,2.919,1.211c2.282,0,4.129-1.851,4.129-4.133V26.857h14.435   c2.283,0,4.134-1.867,4.133-4.15C45.399,20.425,43.548,18.557,41.267,18.557z"></path></g></svg>

                                                                    </span>

                                                                </button>

                                                                <input type="text" class="count-num form-control " value="1" step="1" inputmode="tel" min="1" max="1000" autocomplete="off">

                                                                <button type="button" class="count-btn count-sub disabled" data-type="minus">

                                                                    <span class="count-icon sub-icon">

                                                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 42 42" style="enable-background:new 0 0 42 42;" xml:space="preserve"><path d="M37.059,16H26H16H4.941C2.224,16,0,18.282,0,21s2.224,5,4.941,5H16h10h11.059C39.776,26,42,23.718,42,21  S39.776,16,37.059,16z"></path></svg>

                                                                    </span>

                                                                </button>

                                                            </div>

                                                        </div>

                                                    </div>


                                                </div>


                                            </div>


                                    </div>
                                    <div class="swiper-slide product-wrap">

                                           <div class="product-item">

                                                <div class="product-img">

                                                    <a href="product-default.html">

                                                        <span class="tt-img">

                                                           <img class="img-fluid" src="{{asset('img/p1.png')}}" alt="productName">

                                                       </span>
                                                        <div class="product-code">كود : 543215114</div>

                                                    </a>

                                                </div>
                                                <div class="product-body">

                                                    <div class="price-info">

                                                        <p class="price-val">

                                                            <span>1.000.000 </span>
                                                            دولارًا

                                                        </p>

                                                        <p class="price-points w__bg">


                                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="13.945" height="13" viewBox="0 0 13.945 13"><defs><clipPath id="clip-path"><rect id="Rectangle_35" data-name="Rectangle 35" width="13.946" height="13" transform="translate(1149.69 2020)" fill="#fff"/></clipPath></defs><g id="Group_16" data-name="Group 16" transform="translate(-1149.69 -2020)" clip-path="url(#clip-path)"><path id="Path_89" data-name="Path 89" d="M1163.64,2026.5a6.3,6.3,0,0,1-1.88,4.44,7.116,7.116,0,0,1-5.1,1.95,6.543,6.543,0,0,1-6.84-6.39,6.186,6.186,0,0,1,2.08-4.75,7.215,7.215,0,0,1,4.76-1.75A6.756,6.756,0,0,1,1163.64,2026.5Z" fill="#ffd05b"/><path id="Path_90" data-name="Path 90" d="M1156.66,2031.74a5.253,5.253,0,1,0-5.62-5.24A5.448,5.448,0,0,0,1156.66,2031.74Z" fill="#ffeaa5"/><path id="Path_91" data-name="Path 91" d="M1161.39,2026.5a4.208,4.208,0,0,1-1.19,2.92,4.793,4.793,0,0,1-3.54,1.37,4.337,4.337,0,0,1-4.56-4.29,4.1,4.1,0,0,1,1.43-3.29,4.892,4.892,0,0,1,3.13-1.11,4.575,4.575,0,0,1,4.73,4.4Z" fill="#ffe077"/><path id="Path_92" data-name="Path 92" d="M1157.79,2026.71l-.92-2.22a.231.231,0,0,0-.42,0l-.91,2.22-1.18-.83-.15.19.93,2.58,3.46-.26.78-2.32a.224.224,0,0,0-.35-.23Z" fill="#ffc244"/><path id="Path_93" data-name="Path 93" d="M1157,2032.69a6.747,6.747,0,0,1-6.97-6.5,6.255,6.255,0,0,1,1.87-4.44,6.3,6.3,0,0,0-2.21,4.75,6.747,6.747,0,0,0,6.97,6.5,7.2,7.2,0,0,0,5.1-2.06,7.266,7.266,0,0,1-4.76,1.75Z" fill="#ffc244"/><path id="Path_94" data-name="Path 94" d="M1157.06,2030.54a4.577,4.577,0,0,1-4.73-4.41,4.191,4.191,0,0,1,1.2-2.92,4.253,4.253,0,0,0-1.59,3.29,4.567,4.567,0,0,0,4.72,4.4,4.876,4.876,0,0,0,3.54-1.48,4.948,4.948,0,0,1-3.14,1.12Z" fill="#ffd05b"/><path id="Path_95" data-name="Path 95" d="M1155,2027.8l-.64-1.92-.06-.04c-.18-.12-.42.04-.35.23l.82,2.44a.432.432,0,0,0,.42.3h2.94a.445.445,0,0,0,.43-.3l.04-.12h-2.74a.894.894,0,0,1-.86-.59Z" fill="#ffaa5a"/></g></svg>

                                                            5160

                                                        </p>

                                                    </div>

                                                    <div class="product-desc">

                                                        <a href="product-default.html">

                                                            بنطلون جينز رجالي ضيق مثال
                                                            بقصة ضيقة 
                                                             بنطلون جينز رجالي ضيق مثال

                                                        </a>

                                                    </div>

                                                    <div class="product-actions">

                                                        <div class="cart-action ">

                                                            <a class="btn-cart loading-btn" href="#">

                                                                <p class="add-to-cart">
                                                                    <span>إضافة للسلة </span>
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="21.5" height="21.5" viewBox="0 0 21.5 21.5"><path id="Path_4843" data-name="Path 4843" d="M394,733.5a1.5,1.5,0,1,1-1.5-1.5A1.5,1.5,0,0,1,394,733.5Z" transform="translate(-384.25 -714.25)" fill="none" stroke="#fff" stroke-width="1.5"/><path id="Path_4844" data-name="Path 4844" d="M403,733.5a1.5,1.5,0,1,1-1.5-1.5A1.5,1.5,0,0,1,403,733.5Z" transform="translate(-384.25 -714.25)" fill="none" stroke="#fff" stroke-width="1.5"/><path id="Path_4846" data-name="Path 4846" d="M389,717h12a4,4,0,0,1,4,4v5a4,4,0,0,1-4,4h-8a4,4,0,0,1-4-4Zm0,0a2,2,0,0,0-2-2h-2" transform="translate(-384.25 -714.25)" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/></svg>

                                                                </p>

                                                                <p class="added">

                                                                    <span>في السلة </span>
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="21.5" height="21.5" viewBox="0 0 21.5 21.5"><path id="Path_4843" data-name="Path 4843" d="M394,733.5a1.5,1.5,0,1,1-1.5-1.5A1.5,1.5,0,0,1,394,733.5Z" transform="translate(-384.25 -714.25)" fill="none" stroke="#fff" stroke-width="1.5"/><path id="Path_4844" data-name="Path 4844" d="M403,733.5a1.5,1.5,0,1,1-1.5-1.5A1.5,1.5,0,0,1,403,733.5Z" transform="translate(-384.25 -714.25)" fill="none" stroke="#fff" stroke-width="1.5"/><path id="Path_4845" data-name="Path 4845" d="M394,724l1.753,1.4a1,1,0,0,0,1.377-.122L400,722" transform="translate(-384.25 -714.25)" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/><path id="Path_4846" data-name="Path 4846" d="M389,717h12a4,4,0,0,1,4,4v5a4,4,0,0,1-4,4h-8a4,4,0,0,1-4-4Zm0,0a2,2,0,0,0-2-2h-2" transform="translate(-384.25 -714.25)" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/></svg>

                                                                </p> 

                                                            </a>

                                                        </div>
                                                        <div class="counter-wrap ">

                                                            <div class="count-wrap form-group">

                                                                <button type="button" class="count-btn count-add" data-type="plus">

                                                                    <span class="count-icon add-icon">

                                                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" width="45px" height="45px" viewBox="0 0 45 45" style="enable-background:new 0 0 45 45;" xml:space="preserve"><g><path d="M41.267,18.557H26.832V4.134C26.832,1.851,24.99,0,22.707,0c-2.283,0-4.124,1.851-4.124,4.135v14.432H4.141   c-2.283,0-4.139,1.851-4.138,4.135c-0.001,1.141,0.46,2.187,1.207,2.934c0.748,0.749,1.78,1.222,2.92,1.222h14.453V41.27   c0,1.142,0.453,2.176,1.201,2.922c0.748,0.748,1.777,1.211,2.919,1.211c2.282,0,4.129-1.851,4.129-4.133V26.857h14.435   c2.283,0,4.134-1.867,4.133-4.15C45.399,20.425,43.548,18.557,41.267,18.557z"></path></g></svg>

                                                                    </span>

                                                                </button>

                                                                <input type="text" class="count-num form-control " value="1" step="1" inputmode="tel" min="1" max="1000" autocomplete="off">

                                                                <button type="button" class="count-btn count-sub disabled" data-type="minus">

                                                                    <span class="count-icon sub-icon">

                                                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 42 42" style="enable-background:new 0 0 42 42;" xml:space="preserve"><path d="M37.059,16H26H16H4.941C2.224,16,0,18.282,0,21s2.224,5,4.941,5H16h10h11.059C39.776,26,42,23.718,42,21  S39.776,16,37.059,16z"></path></svg>

                                                                    </span>

                                                                </button>

                                                            </div>

                                                        </div>

                                                    </div>


                                                </div>


                                            </div>


                                    </div>
                                    
                                    

                                </div>

                            </div>

                            <div class="slider-arrow prev-btn">

                                  <i class="fas fa-chevron-right "></i>

                              </div>

                            <div class="slider-arrow next-btn" >


                                  <i class="fas fa-chevron-left "></i>
                            </div>


                        </div>

                    </div>
                    <div class="row-categories">
                        
                        <div class="flex-head">

                              <div class="main-title sub-title gray-clr">

                                  <h1 class="title ">قسم للمعارض </h1>

                             </div>
                              <a class="more-link hvr-underline-from-right" href="products.html">عرض الكل</a>


                         </div>
                        <div class="row-container slider-container product-slider-container">

                            <div class="swiper product-slider duplicated-products-slider scroll-row">

                                <div class="swiper-wrapper target-row">

                                    <div class="swiper-slide product-wrap">

                                           <div class="product-item">

                                                <div class="product-img">

                                                    <a href="product-default.html">

                                                        <span class="tt-img">

                                                           <img class="img-fluid" src="{{asset('img/p1.png')}}" alt="productName">

                                                       </span>
                                                        <div class="product-code">كود : 543215114</div>

                                                    </a>

                                                </div>
                                                <div class="product-body">

                                                    <div class="price-info">

                                                        <p class="price-val">

                                                            <span>1.000.000 </span>
                                                            دولارًا

                                                        </p>

                                                        <p class="price-points">


                                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="13.945" height="13" viewBox="0 0 13.945 13"><defs><clipPath id="clip-path"><rect id="Rectangle_35" data-name="Rectangle 35" width="13.946" height="13" transform="translate(1149.69 2020)" fill="#fff"/></clipPath></defs><g id="Group_16" data-name="Group 16" transform="translate(-1149.69 -2020)" clip-path="url(#clip-path)"><path id="Path_89" data-name="Path 89" d="M1163.64,2026.5a6.3,6.3,0,0,1-1.88,4.44,7.116,7.116,0,0,1-5.1,1.95,6.543,6.543,0,0,1-6.84-6.39,6.186,6.186,0,0,1,2.08-4.75,7.215,7.215,0,0,1,4.76-1.75A6.756,6.756,0,0,1,1163.64,2026.5Z" fill="#ffd05b"/><path id="Path_90" data-name="Path 90" d="M1156.66,2031.74a5.253,5.253,0,1,0-5.62-5.24A5.448,5.448,0,0,0,1156.66,2031.74Z" fill="#ffeaa5"/><path id="Path_91" data-name="Path 91" d="M1161.39,2026.5a4.208,4.208,0,0,1-1.19,2.92,4.793,4.793,0,0,1-3.54,1.37,4.337,4.337,0,0,1-4.56-4.29,4.1,4.1,0,0,1,1.43-3.29,4.892,4.892,0,0,1,3.13-1.11,4.575,4.575,0,0,1,4.73,4.4Z" fill="#ffe077"/><path id="Path_92" data-name="Path 92" d="M1157.79,2026.71l-.92-2.22a.231.231,0,0,0-.42,0l-.91,2.22-1.18-.83-.15.19.93,2.58,3.46-.26.78-2.32a.224.224,0,0,0-.35-.23Z" fill="#ffc244"/><path id="Path_93" data-name="Path 93" d="M1157,2032.69a6.747,6.747,0,0,1-6.97-6.5,6.255,6.255,0,0,1,1.87-4.44,6.3,6.3,0,0,0-2.21,4.75,6.747,6.747,0,0,0,6.97,6.5,7.2,7.2,0,0,0,5.1-2.06,7.266,7.266,0,0,1-4.76,1.75Z" fill="#ffc244"/><path id="Path_94" data-name="Path 94" d="M1157.06,2030.54a4.577,4.577,0,0,1-4.73-4.41,4.191,4.191,0,0,1,1.2-2.92,4.253,4.253,0,0,0-1.59,3.29,4.567,4.567,0,0,0,4.72,4.4,4.876,4.876,0,0,0,3.54-1.48,4.948,4.948,0,0,1-3.14,1.12Z" fill="#ffd05b"/><path id="Path_95" data-name="Path 95" d="M1155,2027.8l-.64-1.92-.06-.04c-.18-.12-.42.04-.35.23l.82,2.44a.432.432,0,0,0,.42.3h2.94a.445.445,0,0,0,.43-.3l.04-.12h-2.74a.894.894,0,0,1-.86-.59Z" fill="#ffaa5a"/></g></svg>

                                                            5160

                                                        </p>

                                                    </div>

                                                    <div class="product-desc">

                                                        <a href="product-default.html">

                                                            بنطلون جينز رجالي ضيق مثال
                                                            بقصة ضيقة 
                                                             بنطلون جينز رجالي ضيق مثال

                                                        </a>

                                                    </div>

                                                    <div class="product-actions">

                                                        <div class="cart-action ">

                                                            <a class="btn-cart loading-btn" href="#">

                                                                <p class="add-to-cart">
                                                                    <span>إضافة للسلة </span>
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="21.5" height="21.5" viewBox="0 0 21.5 21.5"><path id="Path_4843" data-name="Path 4843" d="M394,733.5a1.5,1.5,0,1,1-1.5-1.5A1.5,1.5,0,0,1,394,733.5Z" transform="translate(-384.25 -714.25)" fill="none" stroke="#fff" stroke-width="1.5"/><path id="Path_4844" data-name="Path 4844" d="M403,733.5a1.5,1.5,0,1,1-1.5-1.5A1.5,1.5,0,0,1,403,733.5Z" transform="translate(-384.25 -714.25)" fill="none" stroke="#fff" stroke-width="1.5"/><path id="Path_4846" data-name="Path 4846" d="M389,717h12a4,4,0,0,1,4,4v5a4,4,0,0,1-4,4h-8a4,4,0,0,1-4-4Zm0,0a2,2,0,0,0-2-2h-2" transform="translate(-384.25 -714.25)" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/></svg>

                                                                </p>

                                                                <p class="added">

                                                                    <span>في السلة </span>
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="21.5" height="21.5" viewBox="0 0 21.5 21.5"><path id="Path_4843" data-name="Path 4843" d="M394,733.5a1.5,1.5,0,1,1-1.5-1.5A1.5,1.5,0,0,1,394,733.5Z" transform="translate(-384.25 -714.25)" fill="none" stroke="#fff" stroke-width="1.5"/><path id="Path_4844" data-name="Path 4844" d="M403,733.5a1.5,1.5,0,1,1-1.5-1.5A1.5,1.5,0,0,1,403,733.5Z" transform="translate(-384.25 -714.25)" fill="none" stroke="#fff" stroke-width="1.5"/><path id="Path_4845" data-name="Path 4845" d="M394,724l1.753,1.4a1,1,0,0,0,1.377-.122L400,722" transform="translate(-384.25 -714.25)" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/><path id="Path_4846" data-name="Path 4846" d="M389,717h12a4,4,0,0,1,4,4v5a4,4,0,0,1-4,4h-8a4,4,0,0,1-4-4Zm0,0a2,2,0,0,0-2-2h-2" transform="translate(-384.25 -714.25)" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/></svg>

                                                                </p> 

                                                            </a>

                                                        </div>
                                                        <div class="counter-wrap ">

                                                            <div class="count-wrap form-group">

                                                                <button type="button" class="count-btn count-add" data-type="plus">

                                                                    <span class="count-icon add-icon">

                                                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" width="45px" height="45px" viewBox="0 0 45 45" style="enable-background:new 0 0 45 45;" xml:space="preserve"><g><path d="M41.267,18.557H26.832V4.134C26.832,1.851,24.99,0,22.707,0c-2.283,0-4.124,1.851-4.124,4.135v14.432H4.141   c-2.283,0-4.139,1.851-4.138,4.135c-0.001,1.141,0.46,2.187,1.207,2.934c0.748,0.749,1.78,1.222,2.92,1.222h14.453V41.27   c0,1.142,0.453,2.176,1.201,2.922c0.748,0.748,1.777,1.211,2.919,1.211c2.282,0,4.129-1.851,4.129-4.133V26.857h14.435   c2.283,0,4.134-1.867,4.133-4.15C45.399,20.425,43.548,18.557,41.267,18.557z"></path></g></svg>

                                                                    </span>

                                                                </button>

                                                                <input type="text" class="count-num form-control " value="1" step="1" inputmode="tel" min="1" max="1000" autocomplete="off">

                                                                <button type="button" class="count-btn count-sub disabled" data-type="minus">

                                                                    <span class="count-icon sub-icon">

                                                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 42 42" style="enable-background:new 0 0 42 42;" xml:space="preserve"><path d="M37.059,16H26H16H4.941C2.224,16,0,18.282,0,21s2.224,5,4.941,5H16h10h11.059C39.776,26,42,23.718,42,21  S39.776,16,37.059,16z"></path></svg>

                                                                    </span>

                                                                </button>

                                                            </div>

                                                        </div>

                                                    </div>


                                                </div>


                                            </div>


                                    </div>
                                    <div class="swiper-slide product-wrap">

                                           <div class="product-item">

                                                <div class="product-img">

                                                    <a href="product-default.html">

                                                        <span class="tt-img">

                                                           <img class="img-fluid" src="{{asset('img/p1.png')}}" alt="productName">

                                                       </span>
                                                        <div class="product-code">كود : 543215114</div>

                                                    </a>

                                                </div>
                                                <div class="product-body">

                                                    <div class="price-info">

                                                        <p class="price-val">

                                                            <span>1.000.000 </span>
                                                            دولارًا

                                                        </p>

                                                        <p class="price-points">


                                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="13.945" height="13" viewBox="0 0 13.945 13"><defs><clipPath id="clip-path"><rect id="Rectangle_35" data-name="Rectangle 35" width="13.946" height="13" transform="translate(1149.69 2020)" fill="#fff"/></clipPath></defs><g id="Group_16" data-name="Group 16" transform="translate(-1149.69 -2020)" clip-path="url(#clip-path)"><path id="Path_89" data-name="Path 89" d="M1163.64,2026.5a6.3,6.3,0,0,1-1.88,4.44,7.116,7.116,0,0,1-5.1,1.95,6.543,6.543,0,0,1-6.84-6.39,6.186,6.186,0,0,1,2.08-4.75,7.215,7.215,0,0,1,4.76-1.75A6.756,6.756,0,0,1,1163.64,2026.5Z" fill="#ffd05b"/><path id="Path_90" data-name="Path 90" d="M1156.66,2031.74a5.253,5.253,0,1,0-5.62-5.24A5.448,5.448,0,0,0,1156.66,2031.74Z" fill="#ffeaa5"/><path id="Path_91" data-name="Path 91" d="M1161.39,2026.5a4.208,4.208,0,0,1-1.19,2.92,4.793,4.793,0,0,1-3.54,1.37,4.337,4.337,0,0,1-4.56-4.29,4.1,4.1,0,0,1,1.43-3.29,4.892,4.892,0,0,1,3.13-1.11,4.575,4.575,0,0,1,4.73,4.4Z" fill="#ffe077"/><path id="Path_92" data-name="Path 92" d="M1157.79,2026.71l-.92-2.22a.231.231,0,0,0-.42,0l-.91,2.22-1.18-.83-.15.19.93,2.58,3.46-.26.78-2.32a.224.224,0,0,0-.35-.23Z" fill="#ffc244"/><path id="Path_93" data-name="Path 93" d="M1157,2032.69a6.747,6.747,0,0,1-6.97-6.5,6.255,6.255,0,0,1,1.87-4.44,6.3,6.3,0,0,0-2.21,4.75,6.747,6.747,0,0,0,6.97,6.5,7.2,7.2,0,0,0,5.1-2.06,7.266,7.266,0,0,1-4.76,1.75Z" fill="#ffc244"/><path id="Path_94" data-name="Path 94" d="M1157.06,2030.54a4.577,4.577,0,0,1-4.73-4.41,4.191,4.191,0,0,1,1.2-2.92,4.253,4.253,0,0,0-1.59,3.29,4.567,4.567,0,0,0,4.72,4.4,4.876,4.876,0,0,0,3.54-1.48,4.948,4.948,0,0,1-3.14,1.12Z" fill="#ffd05b"/><path id="Path_95" data-name="Path 95" d="M1155,2027.8l-.64-1.92-.06-.04c-.18-.12-.42.04-.35.23l.82,2.44a.432.432,0,0,0,.42.3h2.94a.445.445,0,0,0,.43-.3l.04-.12h-2.74a.894.894,0,0,1-.86-.59Z" fill="#ffaa5a"/></g></svg>

                                                            5160

                                                        </p>

                                                    </div>

                                                    <div class="product-desc">

                                                        <a href="product-default.html">

                                                            بنطلون جينز رجالي ضيق مثال
                                                            بقصة ضيقة 
                                                             بنطلون جينز رجالي ضيق مثال

                                                        </a>

                                                    </div>

                                                    <div class="product-actions">

                                                        <div class="cart-action ">

                                                            <a class="btn-cart loading-btn" href="#">

                                                                <p class="add-to-cart">
                                                                    <span>إضافة للسلة </span>
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="21.5" height="21.5" viewBox="0 0 21.5 21.5"><path id="Path_4843" data-name="Path 4843" d="M394,733.5a1.5,1.5,0,1,1-1.5-1.5A1.5,1.5,0,0,1,394,733.5Z" transform="translate(-384.25 -714.25)" fill="none" stroke="#fff" stroke-width="1.5"/><path id="Path_4844" data-name="Path 4844" d="M403,733.5a1.5,1.5,0,1,1-1.5-1.5A1.5,1.5,0,0,1,403,733.5Z" transform="translate(-384.25 -714.25)" fill="none" stroke="#fff" stroke-width="1.5"/><path id="Path_4846" data-name="Path 4846" d="M389,717h12a4,4,0,0,1,4,4v5a4,4,0,0,1-4,4h-8a4,4,0,0,1-4-4Zm0,0a2,2,0,0,0-2-2h-2" transform="translate(-384.25 -714.25)" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/></svg>

                                                                </p>

                                                                <p class="added">

                                                                    <span>في السلة </span>
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="21.5" height="21.5" viewBox="0 0 21.5 21.5"><path id="Path_4843" data-name="Path 4843" d="M394,733.5a1.5,1.5,0,1,1-1.5-1.5A1.5,1.5,0,0,1,394,733.5Z" transform="translate(-384.25 -714.25)" fill="none" stroke="#fff" stroke-width="1.5"/><path id="Path_4844" data-name="Path 4844" d="M403,733.5a1.5,1.5,0,1,1-1.5-1.5A1.5,1.5,0,0,1,403,733.5Z" transform="translate(-384.25 -714.25)" fill="none" stroke="#fff" stroke-width="1.5"/><path id="Path_4845" data-name="Path 4845" d="M394,724l1.753,1.4a1,1,0,0,0,1.377-.122L400,722" transform="translate(-384.25 -714.25)" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/><path id="Path_4846" data-name="Path 4846" d="M389,717h12a4,4,0,0,1,4,4v5a4,4,0,0,1-4,4h-8a4,4,0,0,1-4-4Zm0,0a2,2,0,0,0-2-2h-2" transform="translate(-384.25 -714.25)" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/></svg>

                                                                </p> 

                                                            </a>

                                                        </div>
                                                        <div class="counter-wrap ">

                                                            <div class="count-wrap form-group">

                                                                <button type="button" class="count-btn count-add" data-type="plus">

                                                                    <span class="count-icon add-icon">

                                                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" width="45px" height="45px" viewBox="0 0 45 45" style="enable-background:new 0 0 45 45;" xml:space="preserve"><g><path d="M41.267,18.557H26.832V4.134C26.832,1.851,24.99,0,22.707,0c-2.283,0-4.124,1.851-4.124,4.135v14.432H4.141   c-2.283,0-4.139,1.851-4.138,4.135c-0.001,1.141,0.46,2.187,1.207,2.934c0.748,0.749,1.78,1.222,2.92,1.222h14.453V41.27   c0,1.142,0.453,2.176,1.201,2.922c0.748,0.748,1.777,1.211,2.919,1.211c2.282,0,4.129-1.851,4.129-4.133V26.857h14.435   c2.283,0,4.134-1.867,4.133-4.15C45.399,20.425,43.548,18.557,41.267,18.557z"></path></g></svg>

                                                                    </span>

                                                                </button>

                                                                <input type="text" class="count-num form-control " value="1" step="1" inputmode="tel" min="1" max="1000" autocomplete="off">

                                                                <button type="button" class="count-btn count-sub disabled" data-type="minus">

                                                                    <span class="count-icon sub-icon">

                                                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 42 42" style="enable-background:new 0 0 42 42;" xml:space="preserve"><path d="M37.059,16H26H16H4.941C2.224,16,0,18.282,0,21s2.224,5,4.941,5H16h10h11.059C39.776,26,42,23.718,42,21  S39.776,16,37.059,16z"></path></svg>

                                                                    </span>

                                                                </button>

                                                            </div>

                                                        </div>

                                                    </div>


                                                </div>


                                            </div>


                                    </div>
                                    <div class="swiper-slide product-wrap">

                                           <div class="product-item">

                                                <div class="product-img">

                                                    <a href="product-default.html">

                                                        <span class="tt-img">

                                                           <img class="img-fluid" src="{{asset('img/p1.png')}}" alt="productName">

                                                       </span>
                                                        <div class="product-code">كود : 543215114</div>

                                                    </a>

                                                </div>
                                                <div class="product-body">

                                                    <div class="price-info">

                                                        <p class="price-val">

                                                            <span>1.000.000 </span>
                                                            دولارًا

                                                        </p>

                                                        <p class="price-points">


                                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="13.945" height="13" viewBox="0 0 13.945 13"><defs><clipPath id="clip-path"><rect id="Rectangle_35" data-name="Rectangle 35" width="13.946" height="13" transform="translate(1149.69 2020)" fill="#fff"/></clipPath></defs><g id="Group_16" data-name="Group 16" transform="translate(-1149.69 -2020)" clip-path="url(#clip-path)"><path id="Path_89" data-name="Path 89" d="M1163.64,2026.5a6.3,6.3,0,0,1-1.88,4.44,7.116,7.116,0,0,1-5.1,1.95,6.543,6.543,0,0,1-6.84-6.39,6.186,6.186,0,0,1,2.08-4.75,7.215,7.215,0,0,1,4.76-1.75A6.756,6.756,0,0,1,1163.64,2026.5Z" fill="#ffd05b"/><path id="Path_90" data-name="Path 90" d="M1156.66,2031.74a5.253,5.253,0,1,0-5.62-5.24A5.448,5.448,0,0,0,1156.66,2031.74Z" fill="#ffeaa5"/><path id="Path_91" data-name="Path 91" d="M1161.39,2026.5a4.208,4.208,0,0,1-1.19,2.92,4.793,4.793,0,0,1-3.54,1.37,4.337,4.337,0,0,1-4.56-4.29,4.1,4.1,0,0,1,1.43-3.29,4.892,4.892,0,0,1,3.13-1.11,4.575,4.575,0,0,1,4.73,4.4Z" fill="#ffe077"/><path id="Path_92" data-name="Path 92" d="M1157.79,2026.71l-.92-2.22a.231.231,0,0,0-.42,0l-.91,2.22-1.18-.83-.15.19.93,2.58,3.46-.26.78-2.32a.224.224,0,0,0-.35-.23Z" fill="#ffc244"/><path id="Path_93" data-name="Path 93" d="M1157,2032.69a6.747,6.747,0,0,1-6.97-6.5,6.255,6.255,0,0,1,1.87-4.44,6.3,6.3,0,0,0-2.21,4.75,6.747,6.747,0,0,0,6.97,6.5,7.2,7.2,0,0,0,5.1-2.06,7.266,7.266,0,0,1-4.76,1.75Z" fill="#ffc244"/><path id="Path_94" data-name="Path 94" d="M1157.06,2030.54a4.577,4.577,0,0,1-4.73-4.41,4.191,4.191,0,0,1,1.2-2.92,4.253,4.253,0,0,0-1.59,3.29,4.567,4.567,0,0,0,4.72,4.4,4.876,4.876,0,0,0,3.54-1.48,4.948,4.948,0,0,1-3.14,1.12Z" fill="#ffd05b"/><path id="Path_95" data-name="Path 95" d="M1155,2027.8l-.64-1.92-.06-.04c-.18-.12-.42.04-.35.23l.82,2.44a.432.432,0,0,0,.42.3h2.94a.445.445,0,0,0,.43-.3l.04-.12h-2.74a.894.894,0,0,1-.86-.59Z" fill="#ffaa5a"/></g></svg>

                                                            5160

                                                        </p>

                                                    </div>

                                                    <div class="product-desc">

                                                        <a href="product-default.html">

                                                            بنطلون جينز رجالي ضيق مثال
                                                            بقصة ضيقة 
                                                             بنطلون جينز رجالي ضيق مثال

                                                        </a>

                                                    </div>

                                                    <div class="product-actions">

                                                        <div class="cart-action ">

                                                            <a class="btn-cart loading-btn" href="#">

                                                                <p class="add-to-cart">
                                                                    <span>إضافة للسلة </span>
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="21.5" height="21.5" viewBox="0 0 21.5 21.5"><path id="Path_4843" data-name="Path 4843" d="M394,733.5a1.5,1.5,0,1,1-1.5-1.5A1.5,1.5,0,0,1,394,733.5Z" transform="translate(-384.25 -714.25)" fill="none" stroke="#fff" stroke-width="1.5"/><path id="Path_4844" data-name="Path 4844" d="M403,733.5a1.5,1.5,0,1,1-1.5-1.5A1.5,1.5,0,0,1,403,733.5Z" transform="translate(-384.25 -714.25)" fill="none" stroke="#fff" stroke-width="1.5"/><path id="Path_4846" data-name="Path 4846" d="M389,717h12a4,4,0,0,1,4,4v5a4,4,0,0,1-4,4h-8a4,4,0,0,1-4-4Zm0,0a2,2,0,0,0-2-2h-2" transform="translate(-384.25 -714.25)" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/></svg>

                                                                </p>

                                                                <p class="added">

                                                                    <span>في السلة </span>
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="21.5" height="21.5" viewBox="0 0 21.5 21.5"><path id="Path_4843" data-name="Path 4843" d="M394,733.5a1.5,1.5,0,1,1-1.5-1.5A1.5,1.5,0,0,1,394,733.5Z" transform="translate(-384.25 -714.25)" fill="none" stroke="#fff" stroke-width="1.5"/><path id="Path_4844" data-name="Path 4844" d="M403,733.5a1.5,1.5,0,1,1-1.5-1.5A1.5,1.5,0,0,1,403,733.5Z" transform="translate(-384.25 -714.25)" fill="none" stroke="#fff" stroke-width="1.5"/><path id="Path_4845" data-name="Path 4845" d="M394,724l1.753,1.4a1,1,0,0,0,1.377-.122L400,722" transform="translate(-384.25 -714.25)" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/><path id="Path_4846" data-name="Path 4846" d="M389,717h12a4,4,0,0,1,4,4v5a4,4,0,0,1-4,4h-8a4,4,0,0,1-4-4Zm0,0a2,2,0,0,0-2-2h-2" transform="translate(-384.25 -714.25)" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/></svg>

                                                                </p> 

                                                            </a>

                                                        </div>
                                                        <div class="counter-wrap ">

                                                            <div class="count-wrap form-group">

                                                                <button type="button" class="count-btn count-add" data-type="plus">

                                                                    <span class="count-icon add-icon">

                                                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" width="45px" height="45px" viewBox="0 0 45 45" style="enable-background:new 0 0 45 45;" xml:space="preserve"><g><path d="M41.267,18.557H26.832V4.134C26.832,1.851,24.99,0,22.707,0c-2.283,0-4.124,1.851-4.124,4.135v14.432H4.141   c-2.283,0-4.139,1.851-4.138,4.135c-0.001,1.141,0.46,2.187,1.207,2.934c0.748,0.749,1.78,1.222,2.92,1.222h14.453V41.27   c0,1.142,0.453,2.176,1.201,2.922c0.748,0.748,1.777,1.211,2.919,1.211c2.282,0,4.129-1.851,4.129-4.133V26.857h14.435   c2.283,0,4.134-1.867,4.133-4.15C45.399,20.425,43.548,18.557,41.267,18.557z"></path></g></svg>

                                                                    </span>

                                                                </button>

                                                                <input type="text" class="count-num form-control " value="1" step="1" inputmode="tel" min="1" max="1000" autocomplete="off">

                                                                <button type="button" class="count-btn count-sub disabled" data-type="minus">

                                                                    <span class="count-icon sub-icon">

                                                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 42 42" style="enable-background:new 0 0 42 42;" xml:space="preserve"><path d="M37.059,16H26H16H4.941C2.224,16,0,18.282,0,21s2.224,5,4.941,5H16h10h11.059C39.776,26,42,23.718,42,21  S39.776,16,37.059,16z"></path></svg>

                                                                    </span>

                                                                </button>

                                                            </div>

                                                        </div>

                                                    </div>


                                                </div>


                                            </div>


                                    </div>
                                    <div class="swiper-slide product-wrap">

                                           <div class="product-item">

                                                <div class="product-img">

                                                    <a href="product-default.html">

                                                        <span class="tt-img">

                                                           <img class="img-fluid" src="{{asset('img/p1.png')}}" alt="productName">

                                                       </span>
                                                        <div class="product-code">كود : 543215114</div>

                                                    </a>

                                                </div>
                                                <div class="product-body">

                                                    <div class="price-info">

                                                        <p class="price-val">

                                                            <span>1.000.000 </span>
                                                            دولارًا

                                                        </p>

                                                        <p class="price-points">


                                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="13.945" height="13" viewBox="0 0 13.945 13"><defs><clipPath id="clip-path"><rect id="Rectangle_35" data-name="Rectangle 35" width="13.946" height="13" transform="translate(1149.69 2020)" fill="#fff"/></clipPath></defs><g id="Group_16" data-name="Group 16" transform="translate(-1149.69 -2020)" clip-path="url(#clip-path)"><path id="Path_89" data-name="Path 89" d="M1163.64,2026.5a6.3,6.3,0,0,1-1.88,4.44,7.116,7.116,0,0,1-5.1,1.95,6.543,6.543,0,0,1-6.84-6.39,6.186,6.186,0,0,1,2.08-4.75,7.215,7.215,0,0,1,4.76-1.75A6.756,6.756,0,0,1,1163.64,2026.5Z" fill="#ffd05b"/><path id="Path_90" data-name="Path 90" d="M1156.66,2031.74a5.253,5.253,0,1,0-5.62-5.24A5.448,5.448,0,0,0,1156.66,2031.74Z" fill="#ffeaa5"/><path id="Path_91" data-name="Path 91" d="M1161.39,2026.5a4.208,4.208,0,0,1-1.19,2.92,4.793,4.793,0,0,1-3.54,1.37,4.337,4.337,0,0,1-4.56-4.29,4.1,4.1,0,0,1,1.43-3.29,4.892,4.892,0,0,1,3.13-1.11,4.575,4.575,0,0,1,4.73,4.4Z" fill="#ffe077"/><path id="Path_92" data-name="Path 92" d="M1157.79,2026.71l-.92-2.22a.231.231,0,0,0-.42,0l-.91,2.22-1.18-.83-.15.19.93,2.58,3.46-.26.78-2.32a.224.224,0,0,0-.35-.23Z" fill="#ffc244"/><path id="Path_93" data-name="Path 93" d="M1157,2032.69a6.747,6.747,0,0,1-6.97-6.5,6.255,6.255,0,0,1,1.87-4.44,6.3,6.3,0,0,0-2.21,4.75,6.747,6.747,0,0,0,6.97,6.5,7.2,7.2,0,0,0,5.1-2.06,7.266,7.266,0,0,1-4.76,1.75Z" fill="#ffc244"/><path id="Path_94" data-name="Path 94" d="M1157.06,2030.54a4.577,4.577,0,0,1-4.73-4.41,4.191,4.191,0,0,1,1.2-2.92,4.253,4.253,0,0,0-1.59,3.29,4.567,4.567,0,0,0,4.72,4.4,4.876,4.876,0,0,0,3.54-1.48,4.948,4.948,0,0,1-3.14,1.12Z" fill="#ffd05b"/><path id="Path_95" data-name="Path 95" d="M1155,2027.8l-.64-1.92-.06-.04c-.18-.12-.42.04-.35.23l.82,2.44a.432.432,0,0,0,.42.3h2.94a.445.445,0,0,0,.43-.3l.04-.12h-2.74a.894.894,0,0,1-.86-.59Z" fill="#ffaa5a"/></g></svg>

                                                            5160

                                                        </p>

                                                    </div>

                                                    <div class="product-desc">

                                                        <a href="product-default.html">

                                                            بنطلون جينز رجالي ضيق مثال
                                                            بقصة ضيقة 
                                                             بنطلون جينز رجالي ضيق مثال

                                                        </a>

                                                    </div>

                                                    <div class="product-actions">

                                                        <div class="cart-action ">

                                                            <a class="btn-cart loading-btn" href="#">

                                                                <p class="add-to-cart">
                                                                    <span>إضافة للسلة </span>
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="21.5" height="21.5" viewBox="0 0 21.5 21.5"><path id="Path_4843" data-name="Path 4843" d="M394,733.5a1.5,1.5,0,1,1-1.5-1.5A1.5,1.5,0,0,1,394,733.5Z" transform="translate(-384.25 -714.25)" fill="none" stroke="#fff" stroke-width="1.5"/><path id="Path_4844" data-name="Path 4844" d="M403,733.5a1.5,1.5,0,1,1-1.5-1.5A1.5,1.5,0,0,1,403,733.5Z" transform="translate(-384.25 -714.25)" fill="none" stroke="#fff" stroke-width="1.5"/><path id="Path_4846" data-name="Path 4846" d="M389,717h12a4,4,0,0,1,4,4v5a4,4,0,0,1-4,4h-8a4,4,0,0,1-4-4Zm0,0a2,2,0,0,0-2-2h-2" transform="translate(-384.25 -714.25)" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/></svg>

                                                                </p>

                                                                <p class="added">

                                                                    <span>في السلة </span>
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="21.5" height="21.5" viewBox="0 0 21.5 21.5"><path id="Path_4843" data-name="Path 4843" d="M394,733.5a1.5,1.5,0,1,1-1.5-1.5A1.5,1.5,0,0,1,394,733.5Z" transform="translate(-384.25 -714.25)" fill="none" stroke="#fff" stroke-width="1.5"/><path id="Path_4844" data-name="Path 4844" d="M403,733.5a1.5,1.5,0,1,1-1.5-1.5A1.5,1.5,0,0,1,403,733.5Z" transform="translate(-384.25 -714.25)" fill="none" stroke="#fff" stroke-width="1.5"/><path id="Path_4845" data-name="Path 4845" d="M394,724l1.753,1.4a1,1,0,0,0,1.377-.122L400,722" transform="translate(-384.25 -714.25)" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/><path id="Path_4846" data-name="Path 4846" d="M389,717h12a4,4,0,0,1,4,4v5a4,4,0,0,1-4,4h-8a4,4,0,0,1-4-4Zm0,0a2,2,0,0,0-2-2h-2" transform="translate(-384.25 -714.25)" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/></svg>

                                                                </p> 

                                                            </a>

                                                        </div>
                                                        <div class="counter-wrap ">

                                                            <div class="count-wrap form-group">

                                                                <button type="button" class="count-btn count-add" data-type="plus">

                                                                    <span class="count-icon add-icon">

                                                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" width="45px" height="45px" viewBox="0 0 45 45" style="enable-background:new 0 0 45 45;" xml:space="preserve"><g><path d="M41.267,18.557H26.832V4.134C26.832,1.851,24.99,0,22.707,0c-2.283,0-4.124,1.851-4.124,4.135v14.432H4.141   c-2.283,0-4.139,1.851-4.138,4.135c-0.001,1.141,0.46,2.187,1.207,2.934c0.748,0.749,1.78,1.222,2.92,1.222h14.453V41.27   c0,1.142,0.453,2.176,1.201,2.922c0.748,0.748,1.777,1.211,2.919,1.211c2.282,0,4.129-1.851,4.129-4.133V26.857h14.435   c2.283,0,4.134-1.867,4.133-4.15C45.399,20.425,43.548,18.557,41.267,18.557z"></path></g></svg>

                                                                    </span>

                                                                </button>

                                                                <input type="text" class="count-num form-control " value="1" step="1" inputmode="tel" min="1" max="1000" autocomplete="off">

                                                                <button type="button" class="count-btn count-sub disabled" data-type="minus">

                                                                    <span class="count-icon sub-icon">

                                                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 42 42" style="enable-background:new 0 0 42 42;" xml:space="preserve"><path d="M37.059,16H26H16H4.941C2.224,16,0,18.282,0,21s2.224,5,4.941,5H16h10h11.059C39.776,26,42,23.718,42,21  S39.776,16,37.059,16z"></path></svg>

                                                                    </span>

                                                                </button>

                                                            </div>

                                                        </div>

                                                    </div>


                                                </div>


                                            </div>


                                    </div>
                                    <div class="swiper-slide product-wrap">

                                           <div class="product-item">

                                                <div class="product-img">

                                                    <a href="product-default.html">

                                                        <span class="tt-img">

                                                           <img class="img-fluid" src="{{asset('img/p1.png')}}" alt="productName">

                                                       </span>
                                                        <div class="product-code">كود : 543215114</div>

                                                    </a>

                                                </div>
                                                <div class="product-body">

                                                    <div class="price-info">

                                                        <p class="price-val">

                                                            <span>1.000.000 </span>
                                                            دولارًا

                                                        </p>

                                                        <p class="price-points">


                                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="13.945" height="13" viewBox="0 0 13.945 13"><defs><clipPath id="clip-path"><rect id="Rectangle_35" data-name="Rectangle 35" width="13.946" height="13" transform="translate(1149.69 2020)" fill="#fff"/></clipPath></defs><g id="Group_16" data-name="Group 16" transform="translate(-1149.69 -2020)" clip-path="url(#clip-path)"><path id="Path_89" data-name="Path 89" d="M1163.64,2026.5a6.3,6.3,0,0,1-1.88,4.44,7.116,7.116,0,0,1-5.1,1.95,6.543,6.543,0,0,1-6.84-6.39,6.186,6.186,0,0,1,2.08-4.75,7.215,7.215,0,0,1,4.76-1.75A6.756,6.756,0,0,1,1163.64,2026.5Z" fill="#ffd05b"/><path id="Path_90" data-name="Path 90" d="M1156.66,2031.74a5.253,5.253,0,1,0-5.62-5.24A5.448,5.448,0,0,0,1156.66,2031.74Z" fill="#ffeaa5"/><path id="Path_91" data-name="Path 91" d="M1161.39,2026.5a4.208,4.208,0,0,1-1.19,2.92,4.793,4.793,0,0,1-3.54,1.37,4.337,4.337,0,0,1-4.56-4.29,4.1,4.1,0,0,1,1.43-3.29,4.892,4.892,0,0,1,3.13-1.11,4.575,4.575,0,0,1,4.73,4.4Z" fill="#ffe077"/><path id="Path_92" data-name="Path 92" d="M1157.79,2026.71l-.92-2.22a.231.231,0,0,0-.42,0l-.91,2.22-1.18-.83-.15.19.93,2.58,3.46-.26.78-2.32a.224.224,0,0,0-.35-.23Z" fill="#ffc244"/><path id="Path_93" data-name="Path 93" d="M1157,2032.69a6.747,6.747,0,0,1-6.97-6.5,6.255,6.255,0,0,1,1.87-4.44,6.3,6.3,0,0,0-2.21,4.75,6.747,6.747,0,0,0,6.97,6.5,7.2,7.2,0,0,0,5.1-2.06,7.266,7.266,0,0,1-4.76,1.75Z" fill="#ffc244"/><path id="Path_94" data-name="Path 94" d="M1157.06,2030.54a4.577,4.577,0,0,1-4.73-4.41,4.191,4.191,0,0,1,1.2-2.92,4.253,4.253,0,0,0-1.59,3.29,4.567,4.567,0,0,0,4.72,4.4,4.876,4.876,0,0,0,3.54-1.48,4.948,4.948,0,0,1-3.14,1.12Z" fill="#ffd05b"/><path id="Path_95" data-name="Path 95" d="M1155,2027.8l-.64-1.92-.06-.04c-.18-.12-.42.04-.35.23l.82,2.44a.432.432,0,0,0,.42.3h2.94a.445.445,0,0,0,.43-.3l.04-.12h-2.74a.894.894,0,0,1-.86-.59Z" fill="#ffaa5a"/></g></svg>

                                                            5160

                                                        </p>

                                                    </div>

                                                    <div class="product-desc">

                                                        <a href="product-default.html">

                                                            بنطلون جينز رجالي ضيق مثال
                                                            بقصة ضيقة 
                                                             بنطلون جينز رجالي ضيق مثال

                                                        </a>

                                                    </div>

                                                    <div class="product-actions">

                                                        <div class="cart-action ">

                                                            <a class="btn-cart loading-btn" href="#">

                                                                <p class="add-to-cart">
                                                                    <span>إضافة للسلة </span>
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="21.5" height="21.5" viewBox="0 0 21.5 21.5"><path id="Path_4843" data-name="Path 4843" d="M394,733.5a1.5,1.5,0,1,1-1.5-1.5A1.5,1.5,0,0,1,394,733.5Z" transform="translate(-384.25 -714.25)" fill="none" stroke="#fff" stroke-width="1.5"/><path id="Path_4844" data-name="Path 4844" d="M403,733.5a1.5,1.5,0,1,1-1.5-1.5A1.5,1.5,0,0,1,403,733.5Z" transform="translate(-384.25 -714.25)" fill="none" stroke="#fff" stroke-width="1.5"/><path id="Path_4846" data-name="Path 4846" d="M389,717h12a4,4,0,0,1,4,4v5a4,4,0,0,1-4,4h-8a4,4,0,0,1-4-4Zm0,0a2,2,0,0,0-2-2h-2" transform="translate(-384.25 -714.25)" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/></svg>

                                                                </p>

                                                                <p class="added">

                                                                    <span>في السلة </span>
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="21.5" height="21.5" viewBox="0 0 21.5 21.5"><path id="Path_4843" data-name="Path 4843" d="M394,733.5a1.5,1.5,0,1,1-1.5-1.5A1.5,1.5,0,0,1,394,733.5Z" transform="translate(-384.25 -714.25)" fill="none" stroke="#fff" stroke-width="1.5"/><path id="Path_4844" data-name="Path 4844" d="M403,733.5a1.5,1.5,0,1,1-1.5-1.5A1.5,1.5,0,0,1,403,733.5Z" transform="translate(-384.25 -714.25)" fill="none" stroke="#fff" stroke-width="1.5"/><path id="Path_4845" data-name="Path 4845" d="M394,724l1.753,1.4a1,1,0,0,0,1.377-.122L400,722" transform="translate(-384.25 -714.25)" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/><path id="Path_4846" data-name="Path 4846" d="M389,717h12a4,4,0,0,1,4,4v5a4,4,0,0,1-4,4h-8a4,4,0,0,1-4-4Zm0,0a2,2,0,0,0-2-2h-2" transform="translate(-384.25 -714.25)" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/></svg>

                                                                </p> 

                                                            </a>

                                                        </div>
                                                        <div class="counter-wrap ">

                                                            <div class="count-wrap form-group">

                                                                <button type="button" class="count-btn count-add" data-type="plus">

                                                                    <span class="count-icon add-icon">

                                                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" width="45px" height="45px" viewBox="0 0 45 45" style="enable-background:new 0 0 45 45;" xml:space="preserve"><g><path d="M41.267,18.557H26.832V4.134C26.832,1.851,24.99,0,22.707,0c-2.283,0-4.124,1.851-4.124,4.135v14.432H4.141   c-2.283,0-4.139,1.851-4.138,4.135c-0.001,1.141,0.46,2.187,1.207,2.934c0.748,0.749,1.78,1.222,2.92,1.222h14.453V41.27   c0,1.142,0.453,2.176,1.201,2.922c0.748,0.748,1.777,1.211,2.919,1.211c2.282,0,4.129-1.851,4.129-4.133V26.857h14.435   c2.283,0,4.134-1.867,4.133-4.15C45.399,20.425,43.548,18.557,41.267,18.557z"></path></g></svg>

                                                                    </span>

                                                                </button>

                                                                <input type="text" class="count-num form-control " value="1" step="1" inputmode="tel" min="1" max="1000" autocomplete="off">

                                                                <button type="button" class="count-btn count-sub disabled" data-type="minus">

                                                                    <span class="count-icon sub-icon">

                                                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 42 42" style="enable-background:new 0 0 42 42;" xml:space="preserve"><path d="M37.059,16H26H16H4.941C2.224,16,0,18.282,0,21s2.224,5,4.941,5H16h10h11.059C39.776,26,42,23.718,42,21  S39.776,16,37.059,16z"></path></svg>

                                                                    </span>

                                                                </button>

                                                            </div>

                                                        </div>

                                                    </div>


                                                </div>


                                            </div>


                                    </div>
                                    

                                </div>

                            </div>

                            <div class="slider-arrow prev-btn">

                                  <i class="fas fa-chevron-right "></i>

                              </div>

                            <div class="slider-arrow next-btn" >


                                  <i class="fas fa-chevron-left "></i>
                            </div>


                        </div>

                    </div>
                    <div class="row-categories">
                        
                        <div class="flex-head">

                              <div class="main-title sub-title gray-clr">

                                  <h1 class="title ">قسم المنتجات المميزة</h1>

                             </div>
                              <a class="more-link hvr-underline-from-right" href="products.html">عرض الكل</a>


                         </div>
                        <div class="row-container slider-container product-slider-container">

                            <div class="swiper product-slider duplicated-products-slider scroll-row">

                                <div class="swiper-wrapper target-row">

                                    <div class="swiper-slide product-wrap">

                                           <div class="product-item">

                                                <div class="product-img">

                                                    <a href="product-default.html">

                                                        <span class="tt-img">

                                                           <img class="img-fluid" src="{{asset('img/p1.png')}}" alt="productName">

                                                       </span>
                                                        <div class="product-code">كود : 543215114</div>

                                                    </a>

                                                </div>
                                                <div class="product-body">

                                                    <div class="price-info">

                                                        <p class="price-val">

                                                            <span>1.000.000 </span>
                                                            دولارًا

                                                        </p>

                                                        <p class="price-points">


                                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="13.945" height="13" viewBox="0 0 13.945 13"><defs><clipPath id="clip-path"><rect id="Rectangle_35" data-name="Rectangle 35" width="13.946" height="13" transform="translate(1149.69 2020)" fill="#fff"/></clipPath></defs><g id="Group_16" data-name="Group 16" transform="translate(-1149.69 -2020)" clip-path="url(#clip-path)"><path id="Path_89" data-name="Path 89" d="M1163.64,2026.5a6.3,6.3,0,0,1-1.88,4.44,7.116,7.116,0,0,1-5.1,1.95,6.543,6.543,0,0,1-6.84-6.39,6.186,6.186,0,0,1,2.08-4.75,7.215,7.215,0,0,1,4.76-1.75A6.756,6.756,0,0,1,1163.64,2026.5Z" fill="#ffd05b"/><path id="Path_90" data-name="Path 90" d="M1156.66,2031.74a5.253,5.253,0,1,0-5.62-5.24A5.448,5.448,0,0,0,1156.66,2031.74Z" fill="#ffeaa5"/><path id="Path_91" data-name="Path 91" d="M1161.39,2026.5a4.208,4.208,0,0,1-1.19,2.92,4.793,4.793,0,0,1-3.54,1.37,4.337,4.337,0,0,1-4.56-4.29,4.1,4.1,0,0,1,1.43-3.29,4.892,4.892,0,0,1,3.13-1.11,4.575,4.575,0,0,1,4.73,4.4Z" fill="#ffe077"/><path id="Path_92" data-name="Path 92" d="M1157.79,2026.71l-.92-2.22a.231.231,0,0,0-.42,0l-.91,2.22-1.18-.83-.15.19.93,2.58,3.46-.26.78-2.32a.224.224,0,0,0-.35-.23Z" fill="#ffc244"/><path id="Path_93" data-name="Path 93" d="M1157,2032.69a6.747,6.747,0,0,1-6.97-6.5,6.255,6.255,0,0,1,1.87-4.44,6.3,6.3,0,0,0-2.21,4.75,6.747,6.747,0,0,0,6.97,6.5,7.2,7.2,0,0,0,5.1-2.06,7.266,7.266,0,0,1-4.76,1.75Z" fill="#ffc244"/><path id="Path_94" data-name="Path 94" d="M1157.06,2030.54a4.577,4.577,0,0,1-4.73-4.41,4.191,4.191,0,0,1,1.2-2.92,4.253,4.253,0,0,0-1.59,3.29,4.567,4.567,0,0,0,4.72,4.4,4.876,4.876,0,0,0,3.54-1.48,4.948,4.948,0,0,1-3.14,1.12Z" fill="#ffd05b"/><path id="Path_95" data-name="Path 95" d="M1155,2027.8l-.64-1.92-.06-.04c-.18-.12-.42.04-.35.23l.82,2.44a.432.432,0,0,0,.42.3h2.94a.445.445,0,0,0,.43-.3l.04-.12h-2.74a.894.894,0,0,1-.86-.59Z" fill="#ffaa5a"/></g></svg>

                                                            5160

                                                        </p>

                                                    </div>

                                                    <div class="product-desc">

                                                        <a href="product-default.html">

                                                            بنطلون جينز رجالي ضيق مثال
                                                            بقصة ضيقة 
                                                             بنطلون جينز رجالي ضيق مثال

                                                        </a>

                                                    </div>

                                                    <div class="product-actions">

                                                        <div class="cart-action ">

                                                            <a class="btn-cart loading-btn" href="#">

                                                                <p class="add-to-cart">
                                                                    <span>إضافة للسلة </span>
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="21.5" height="21.5" viewBox="0 0 21.5 21.5"><path id="Path_4843" data-name="Path 4843" d="M394,733.5a1.5,1.5,0,1,1-1.5-1.5A1.5,1.5,0,0,1,394,733.5Z" transform="translate(-384.25 -714.25)" fill="none" stroke="#fff" stroke-width="1.5"/><path id="Path_4844" data-name="Path 4844" d="M403,733.5a1.5,1.5,0,1,1-1.5-1.5A1.5,1.5,0,0,1,403,733.5Z" transform="translate(-384.25 -714.25)" fill="none" stroke="#fff" stroke-width="1.5"/><path id="Path_4846" data-name="Path 4846" d="M389,717h12a4,4,0,0,1,4,4v5a4,4,0,0,1-4,4h-8a4,4,0,0,1-4-4Zm0,0a2,2,0,0,0-2-2h-2" transform="translate(-384.25 -714.25)" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/></svg>

                                                                </p>

                                                                <p class="added">

                                                                    <span>في السلة </span>
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="21.5" height="21.5" viewBox="0 0 21.5 21.5"><path id="Path_4843" data-name="Path 4843" d="M394,733.5a1.5,1.5,0,1,1-1.5-1.5A1.5,1.5,0,0,1,394,733.5Z" transform="translate(-384.25 -714.25)" fill="none" stroke="#fff" stroke-width="1.5"/><path id="Path_4844" data-name="Path 4844" d="M403,733.5a1.5,1.5,0,1,1-1.5-1.5A1.5,1.5,0,0,1,403,733.5Z" transform="translate(-384.25 -714.25)" fill="none" stroke="#fff" stroke-width="1.5"/><path id="Path_4845" data-name="Path 4845" d="M394,724l1.753,1.4a1,1,0,0,0,1.377-.122L400,722" transform="translate(-384.25 -714.25)" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/><path id="Path_4846" data-name="Path 4846" d="M389,717h12a4,4,0,0,1,4,4v5a4,4,0,0,1-4,4h-8a4,4,0,0,1-4-4Zm0,0a2,2,0,0,0-2-2h-2" transform="translate(-384.25 -714.25)" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/></svg>

                                                                </p> 

                                                            </a>

                                                        </div>
                                                        <div class="counter-wrap ">

                                                            <div class="count-wrap form-group">

                                                                <button type="button" class="count-btn count-add" data-type="plus">

                                                                    <span class="count-icon add-icon">

                                                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" width="45px" height="45px" viewBox="0 0 45 45" style="enable-background:new 0 0 45 45;" xml:space="preserve"><g><path d="M41.267,18.557H26.832V4.134C26.832,1.851,24.99,0,22.707,0c-2.283,0-4.124,1.851-4.124,4.135v14.432H4.141   c-2.283,0-4.139,1.851-4.138,4.135c-0.001,1.141,0.46,2.187,1.207,2.934c0.748,0.749,1.78,1.222,2.92,1.222h14.453V41.27   c0,1.142,0.453,2.176,1.201,2.922c0.748,0.748,1.777,1.211,2.919,1.211c2.282,0,4.129-1.851,4.129-4.133V26.857h14.435   c2.283,0,4.134-1.867,4.133-4.15C45.399,20.425,43.548,18.557,41.267,18.557z"></path></g></svg>

                                                                    </span>

                                                                </button>

                                                                <input type="text" class="count-num form-control " value="1" step="1" inputmode="tel" min="1" max="1000" autocomplete="off">

                                                                <button type="button" class="count-btn count-sub disabled" data-type="minus">

                                                                    <span class="count-icon sub-icon">

                                                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 42 42" style="enable-background:new 0 0 42 42;" xml:space="preserve"><path d="M37.059,16H26H16H4.941C2.224,16,0,18.282,0,21s2.224,5,4.941,5H16h10h11.059C39.776,26,42,23.718,42,21  S39.776,16,37.059,16z"></path></svg>

                                                                    </span>

                                                                </button>

                                                            </div>

                                                        </div>

                                                    </div>


                                                </div>


                                            </div>


                                    </div>
                                    <div class="swiper-slide product-wrap">

                                           <div class="product-item">

                                                <div class="product-img">

                                                    <a href="product-default.html">

                                                        <span class="tt-img">

                                                           <img class="img-fluid" src="{{asset('img/p1.png')}}" alt="productName">

                                                       </span>
                                                        <div class="product-code">كود : 543215114</div>

                                                    </a>

                                                </div>
                                                <div class="product-body">

                                                    <div class="price-info">

                                                        <p class="price-val">

                                                            <span>1.000.000 </span>
                                                            دولارًا

                                                        </p>

                                                        <p class="price-points">


                                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="13.945" height="13" viewBox="0 0 13.945 13"><defs><clipPath id="clip-path"><rect id="Rectangle_35" data-name="Rectangle 35" width="13.946" height="13" transform="translate(1149.69 2020)" fill="#fff"/></clipPath></defs><g id="Group_16" data-name="Group 16" transform="translate(-1149.69 -2020)" clip-path="url(#clip-path)"><path id="Path_89" data-name="Path 89" d="M1163.64,2026.5a6.3,6.3,0,0,1-1.88,4.44,7.116,7.116,0,0,1-5.1,1.95,6.543,6.543,0,0,1-6.84-6.39,6.186,6.186,0,0,1,2.08-4.75,7.215,7.215,0,0,1,4.76-1.75A6.756,6.756,0,0,1,1163.64,2026.5Z" fill="#ffd05b"/><path id="Path_90" data-name="Path 90" d="M1156.66,2031.74a5.253,5.253,0,1,0-5.62-5.24A5.448,5.448,0,0,0,1156.66,2031.74Z" fill="#ffeaa5"/><path id="Path_91" data-name="Path 91" d="M1161.39,2026.5a4.208,4.208,0,0,1-1.19,2.92,4.793,4.793,0,0,1-3.54,1.37,4.337,4.337,0,0,1-4.56-4.29,4.1,4.1,0,0,1,1.43-3.29,4.892,4.892,0,0,1,3.13-1.11,4.575,4.575,0,0,1,4.73,4.4Z" fill="#ffe077"/><path id="Path_92" data-name="Path 92" d="M1157.79,2026.71l-.92-2.22a.231.231,0,0,0-.42,0l-.91,2.22-1.18-.83-.15.19.93,2.58,3.46-.26.78-2.32a.224.224,0,0,0-.35-.23Z" fill="#ffc244"/><path id="Path_93" data-name="Path 93" d="M1157,2032.69a6.747,6.747,0,0,1-6.97-6.5,6.255,6.255,0,0,1,1.87-4.44,6.3,6.3,0,0,0-2.21,4.75,6.747,6.747,0,0,0,6.97,6.5,7.2,7.2,0,0,0,5.1-2.06,7.266,7.266,0,0,1-4.76,1.75Z" fill="#ffc244"/><path id="Path_94" data-name="Path 94" d="M1157.06,2030.54a4.577,4.577,0,0,1-4.73-4.41,4.191,4.191,0,0,1,1.2-2.92,4.253,4.253,0,0,0-1.59,3.29,4.567,4.567,0,0,0,4.72,4.4,4.876,4.876,0,0,0,3.54-1.48,4.948,4.948,0,0,1-3.14,1.12Z" fill="#ffd05b"/><path id="Path_95" data-name="Path 95" d="M1155,2027.8l-.64-1.92-.06-.04c-.18-.12-.42.04-.35.23l.82,2.44a.432.432,0,0,0,.42.3h2.94a.445.445,0,0,0,.43-.3l.04-.12h-2.74a.894.894,0,0,1-.86-.59Z" fill="#ffaa5a"/></g></svg>

                                                            5160

                                                        </p>

                                                    </div>

                                                    <div class="product-desc">

                                                        <a href="product-default.html">

                                                            بنطلون جينز رجالي ضيق مثال
                                                            بقصة ضيقة 
                                                             بنطلون جينز رجالي ضيق مثال

                                                        </a>

                                                    </div>

                                                    <div class="product-actions">

                                                        <div class="cart-action ">

                                                            <a class="btn-cart loading-btn" href="#">

                                                                <p class="add-to-cart">
                                                                    <span>إضافة للسلة </span>
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="21.5" height="21.5" viewBox="0 0 21.5 21.5"><path id="Path_4843" data-name="Path 4843" d="M394,733.5a1.5,1.5,0,1,1-1.5-1.5A1.5,1.5,0,0,1,394,733.5Z" transform="translate(-384.25 -714.25)" fill="none" stroke="#fff" stroke-width="1.5"/><path id="Path_4844" data-name="Path 4844" d="M403,733.5a1.5,1.5,0,1,1-1.5-1.5A1.5,1.5,0,0,1,403,733.5Z" transform="translate(-384.25 -714.25)" fill="none" stroke="#fff" stroke-width="1.5"/><path id="Path_4846" data-name="Path 4846" d="M389,717h12a4,4,0,0,1,4,4v5a4,4,0,0,1-4,4h-8a4,4,0,0,1-4-4Zm0,0a2,2,0,0,0-2-2h-2" transform="translate(-384.25 -714.25)" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/></svg>

                                                                </p>

                                                                <p class="added">

                                                                    <span>في السلة </span>
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="21.5" height="21.5" viewBox="0 0 21.5 21.5"><path id="Path_4843" data-name="Path 4843" d="M394,733.5a1.5,1.5,0,1,1-1.5-1.5A1.5,1.5,0,0,1,394,733.5Z" transform="translate(-384.25 -714.25)" fill="none" stroke="#fff" stroke-width="1.5"/><path id="Path_4844" data-name="Path 4844" d="M403,733.5a1.5,1.5,0,1,1-1.5-1.5A1.5,1.5,0,0,1,403,733.5Z" transform="translate(-384.25 -714.25)" fill="none" stroke="#fff" stroke-width="1.5"/><path id="Path_4845" data-name="Path 4845" d="M394,724l1.753,1.4a1,1,0,0,0,1.377-.122L400,722" transform="translate(-384.25 -714.25)" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/><path id="Path_4846" data-name="Path 4846" d="M389,717h12a4,4,0,0,1,4,4v5a4,4,0,0,1-4,4h-8a4,4,0,0,1-4-4Zm0,0a2,2,0,0,0-2-2h-2" transform="translate(-384.25 -714.25)" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/></svg>

                                                                </p> 

                                                            </a>

                                                        </div>
                                                        <div class="counter-wrap ">

                                                            <div class="count-wrap form-group">

                                                                <button type="button" class="count-btn count-add" data-type="plus">

                                                                    <span class="count-icon add-icon">

                                                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" width="45px" height="45px" viewBox="0 0 45 45" style="enable-background:new 0 0 45 45;" xml:space="preserve"><g><path d="M41.267,18.557H26.832V4.134C26.832,1.851,24.99,0,22.707,0c-2.283,0-4.124,1.851-4.124,4.135v14.432H4.141   c-2.283,0-4.139,1.851-4.138,4.135c-0.001,1.141,0.46,2.187,1.207,2.934c0.748,0.749,1.78,1.222,2.92,1.222h14.453V41.27   c0,1.142,0.453,2.176,1.201,2.922c0.748,0.748,1.777,1.211,2.919,1.211c2.282,0,4.129-1.851,4.129-4.133V26.857h14.435   c2.283,0,4.134-1.867,4.133-4.15C45.399,20.425,43.548,18.557,41.267,18.557z"></path></g></svg>

                                                                    </span>

                                                                </button>

                                                                <input type="text" class="count-num form-control " value="1" step="1" inputmode="tel" min="1" max="1000" autocomplete="off">

                                                                <button type="button" class="count-btn count-sub disabled" data-type="minus">

                                                                    <span class="count-icon sub-icon">

                                                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 42 42" style="enable-background:new 0 0 42 42;" xml:space="preserve"><path d="M37.059,16H26H16H4.941C2.224,16,0,18.282,0,21s2.224,5,4.941,5H16h10h11.059C39.776,26,42,23.718,42,21  S39.776,16,37.059,16z"></path></svg>

                                                                    </span>

                                                                </button>

                                                            </div>

                                                        </div>

                                                    </div>


                                                </div>


                                            </div>


                                    </div>
                                    <div class="swiper-slide product-wrap">

                                           <div class="product-item">

                                                <div class="product-img">

                                                    <a href="product-default.html">

                                                        <span class="tt-img">

                                                           <img class="img-fluid" src="{{asset('img/p1.png')}}" alt="productName">

                                                       </span>
                                                        <div class="product-code">كود : 543215114</div>

                                                    </a>

                                                </div>
                                                <div class="product-body">

                                                    <div class="price-info">

                                                        <p class="price-val">

                                                            <span>1.000.000 </span>
                                                            دولارًا

                                                        </p>

                                                        <p class="price-points">


                                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="13.945" height="13" viewBox="0 0 13.945 13"><defs><clipPath id="clip-path"><rect id="Rectangle_35" data-name="Rectangle 35" width="13.946" height="13" transform="translate(1149.69 2020)" fill="#fff"/></clipPath></defs><g id="Group_16" data-name="Group 16" transform="translate(-1149.69 -2020)" clip-path="url(#clip-path)"><path id="Path_89" data-name="Path 89" d="M1163.64,2026.5a6.3,6.3,0,0,1-1.88,4.44,7.116,7.116,0,0,1-5.1,1.95,6.543,6.543,0,0,1-6.84-6.39,6.186,6.186,0,0,1,2.08-4.75,7.215,7.215,0,0,1,4.76-1.75A6.756,6.756,0,0,1,1163.64,2026.5Z" fill="#ffd05b"/><path id="Path_90" data-name="Path 90" d="M1156.66,2031.74a5.253,5.253,0,1,0-5.62-5.24A5.448,5.448,0,0,0,1156.66,2031.74Z" fill="#ffeaa5"/><path id="Path_91" data-name="Path 91" d="M1161.39,2026.5a4.208,4.208,0,0,1-1.19,2.92,4.793,4.793,0,0,1-3.54,1.37,4.337,4.337,0,0,1-4.56-4.29,4.1,4.1,0,0,1,1.43-3.29,4.892,4.892,0,0,1,3.13-1.11,4.575,4.575,0,0,1,4.73,4.4Z" fill="#ffe077"/><path id="Path_92" data-name="Path 92" d="M1157.79,2026.71l-.92-2.22a.231.231,0,0,0-.42,0l-.91,2.22-1.18-.83-.15.19.93,2.58,3.46-.26.78-2.32a.224.224,0,0,0-.35-.23Z" fill="#ffc244"/><path id="Path_93" data-name="Path 93" d="M1157,2032.69a6.747,6.747,0,0,1-6.97-6.5,6.255,6.255,0,0,1,1.87-4.44,6.3,6.3,0,0,0-2.21,4.75,6.747,6.747,0,0,0,6.97,6.5,7.2,7.2,0,0,0,5.1-2.06,7.266,7.266,0,0,1-4.76,1.75Z" fill="#ffc244"/><path id="Path_94" data-name="Path 94" d="M1157.06,2030.54a4.577,4.577,0,0,1-4.73-4.41,4.191,4.191,0,0,1,1.2-2.92,4.253,4.253,0,0,0-1.59,3.29,4.567,4.567,0,0,0,4.72,4.4,4.876,4.876,0,0,0,3.54-1.48,4.948,4.948,0,0,1-3.14,1.12Z" fill="#ffd05b"/><path id="Path_95" data-name="Path 95" d="M1155,2027.8l-.64-1.92-.06-.04c-.18-.12-.42.04-.35.23l.82,2.44a.432.432,0,0,0,.42.3h2.94a.445.445,0,0,0,.43-.3l.04-.12h-2.74a.894.894,0,0,1-.86-.59Z" fill="#ffaa5a"/></g></svg>

                                                            5160

                                                        </p>

                                                    </div>

                                                    <div class="product-desc">

                                                        <a href="product-default.html">

                                                            بنطلون جينز رجالي ضيق مثال
                                                            بقصة ضيقة 
                                                             بنطلون جينز رجالي ضيق مثال

                                                        </a>

                                                    </div>

                                                    <div class="product-actions">

                                                        <div class="cart-action ">

                                                            <a class="btn-cart loading-btn" href="#">

                                                                <p class="add-to-cart">
                                                                    <span>إضافة للسلة </span>
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="21.5" height="21.5" viewBox="0 0 21.5 21.5"><path id="Path_4843" data-name="Path 4843" d="M394,733.5a1.5,1.5,0,1,1-1.5-1.5A1.5,1.5,0,0,1,394,733.5Z" transform="translate(-384.25 -714.25)" fill="none" stroke="#fff" stroke-width="1.5"/><path id="Path_4844" data-name="Path 4844" d="M403,733.5a1.5,1.5,0,1,1-1.5-1.5A1.5,1.5,0,0,1,403,733.5Z" transform="translate(-384.25 -714.25)" fill="none" stroke="#fff" stroke-width="1.5"/><path id="Path_4846" data-name="Path 4846" d="M389,717h12a4,4,0,0,1,4,4v5a4,4,0,0,1-4,4h-8a4,4,0,0,1-4-4Zm0,0a2,2,0,0,0-2-2h-2" transform="translate(-384.25 -714.25)" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/></svg>

                                                                </p>

                                                                <p class="added">

                                                                    <span>في السلة </span>
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="21.5" height="21.5" viewBox="0 0 21.5 21.5"><path id="Path_4843" data-name="Path 4843" d="M394,733.5a1.5,1.5,0,1,1-1.5-1.5A1.5,1.5,0,0,1,394,733.5Z" transform="translate(-384.25 -714.25)" fill="none" stroke="#fff" stroke-width="1.5"/><path id="Path_4844" data-name="Path 4844" d="M403,733.5a1.5,1.5,0,1,1-1.5-1.5A1.5,1.5,0,0,1,403,733.5Z" transform="translate(-384.25 -714.25)" fill="none" stroke="#fff" stroke-width="1.5"/><path id="Path_4845" data-name="Path 4845" d="M394,724l1.753,1.4a1,1,0,0,0,1.377-.122L400,722" transform="translate(-384.25 -714.25)" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/><path id="Path_4846" data-name="Path 4846" d="M389,717h12a4,4,0,0,1,4,4v5a4,4,0,0,1-4,4h-8a4,4,0,0,1-4-4Zm0,0a2,2,0,0,0-2-2h-2" transform="translate(-384.25 -714.25)" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/></svg>

                                                                </p> 

                                                            </a>

                                                        </div>
                                                        <div class="counter-wrap ">

                                                            <div class="count-wrap form-group">

                                                                <button type="button" class="count-btn count-add" data-type="plus">

                                                                    <span class="count-icon add-icon">

                                                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" width="45px" height="45px" viewBox="0 0 45 45" style="enable-background:new 0 0 45 45;" xml:space="preserve"><g><path d="M41.267,18.557H26.832V4.134C26.832,1.851,24.99,0,22.707,0c-2.283,0-4.124,1.851-4.124,4.135v14.432H4.141   c-2.283,0-4.139,1.851-4.138,4.135c-0.001,1.141,0.46,2.187,1.207,2.934c0.748,0.749,1.78,1.222,2.92,1.222h14.453V41.27   c0,1.142,0.453,2.176,1.201,2.922c0.748,0.748,1.777,1.211,2.919,1.211c2.282,0,4.129-1.851,4.129-4.133V26.857h14.435   c2.283,0,4.134-1.867,4.133-4.15C45.399,20.425,43.548,18.557,41.267,18.557z"></path></g></svg>

                                                                    </span>

                                                                </button>

                                                                <input type="text" class="count-num form-control " value="1" step="1" inputmode="tel" min="1" max="1000" autocomplete="off">

                                                                <button type="button" class="count-btn count-sub disabled" data-type="minus">

                                                                    <span class="count-icon sub-icon">

                                                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 42 42" style="enable-background:new 0 0 42 42;" xml:space="preserve"><path d="M37.059,16H26H16H4.941C2.224,16,0,18.282,0,21s2.224,5,4.941,5H16h10h11.059C39.776,26,42,23.718,42,21  S39.776,16,37.059,16z"></path></svg>

                                                                    </span>

                                                                </button>

                                                            </div>

                                                        </div>

                                                    </div>


                                                </div>


                                            </div>


                                    </div>
                                    <div class="swiper-slide product-wrap">

                                           <div class="product-item">

                                                <div class="product-img">

                                                    <a href="product-default.html">

                                                        <span class="tt-img">

                                                           <img class="img-fluid" src="{{asset('img/p1.png')}}" alt="productName">

                                                       </span>
                                                        <div class="product-code">كود : 543215114</div>

                                                    </a>

                                                </div>
                                                <div class="product-body">

                                                    <div class="price-info">

                                                        <p class="price-val">

                                                            <span>1.000.000 </span>
                                                            دولارًا

                                                        </p>

                                                        <p class="price-points">


                                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="13.945" height="13" viewBox="0 0 13.945 13"><defs><clipPath id="clip-path"><rect id="Rectangle_35" data-name="Rectangle 35" width="13.946" height="13" transform="translate(1149.69 2020)" fill="#fff"/></clipPath></defs><g id="Group_16" data-name="Group 16" transform="translate(-1149.69 -2020)" clip-path="url(#clip-path)"><path id="Path_89" data-name="Path 89" d="M1163.64,2026.5a6.3,6.3,0,0,1-1.88,4.44,7.116,7.116,0,0,1-5.1,1.95,6.543,6.543,0,0,1-6.84-6.39,6.186,6.186,0,0,1,2.08-4.75,7.215,7.215,0,0,1,4.76-1.75A6.756,6.756,0,0,1,1163.64,2026.5Z" fill="#ffd05b"/><path id="Path_90" data-name="Path 90" d="M1156.66,2031.74a5.253,5.253,0,1,0-5.62-5.24A5.448,5.448,0,0,0,1156.66,2031.74Z" fill="#ffeaa5"/><path id="Path_91" data-name="Path 91" d="M1161.39,2026.5a4.208,4.208,0,0,1-1.19,2.92,4.793,4.793,0,0,1-3.54,1.37,4.337,4.337,0,0,1-4.56-4.29,4.1,4.1,0,0,1,1.43-3.29,4.892,4.892,0,0,1,3.13-1.11,4.575,4.575,0,0,1,4.73,4.4Z" fill="#ffe077"/><path id="Path_92" data-name="Path 92" d="M1157.79,2026.71l-.92-2.22a.231.231,0,0,0-.42,0l-.91,2.22-1.18-.83-.15.19.93,2.58,3.46-.26.78-2.32a.224.224,0,0,0-.35-.23Z" fill="#ffc244"/><path id="Path_93" data-name="Path 93" d="M1157,2032.69a6.747,6.747,0,0,1-6.97-6.5,6.255,6.255,0,0,1,1.87-4.44,6.3,6.3,0,0,0-2.21,4.75,6.747,6.747,0,0,0,6.97,6.5,7.2,7.2,0,0,0,5.1-2.06,7.266,7.266,0,0,1-4.76,1.75Z" fill="#ffc244"/><path id="Path_94" data-name="Path 94" d="M1157.06,2030.54a4.577,4.577,0,0,1-4.73-4.41,4.191,4.191,0,0,1,1.2-2.92,4.253,4.253,0,0,0-1.59,3.29,4.567,4.567,0,0,0,4.72,4.4,4.876,4.876,0,0,0,3.54-1.48,4.948,4.948,0,0,1-3.14,1.12Z" fill="#ffd05b"/><path id="Path_95" data-name="Path 95" d="M1155,2027.8l-.64-1.92-.06-.04c-.18-.12-.42.04-.35.23l.82,2.44a.432.432,0,0,0,.42.3h2.94a.445.445,0,0,0,.43-.3l.04-.12h-2.74a.894.894,0,0,1-.86-.59Z" fill="#ffaa5a"/></g></svg>

                                                            5160

                                                        </p>

                                                    </div>

                                                    <div class="product-desc">

                                                        <a href="product-default.html">

                                                            بنطلون جينز رجالي ضيق مثال
                                                            بقصة ضيقة 
                                                             بنطلون جينز رجالي ضيق مثال

                                                        </a>

                                                    </div>

                                                    <div class="product-actions">

                                                        <div class="cart-action ">

                                                            <a class="btn-cart loading-btn" href="#">

                                                                <p class="add-to-cart">
                                                                    <span>إضافة للسلة </span>
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="21.5" height="21.5" viewBox="0 0 21.5 21.5"><path id="Path_4843" data-name="Path 4843" d="M394,733.5a1.5,1.5,0,1,1-1.5-1.5A1.5,1.5,0,0,1,394,733.5Z" transform="translate(-384.25 -714.25)" fill="none" stroke="#fff" stroke-width="1.5"/><path id="Path_4844" data-name="Path 4844" d="M403,733.5a1.5,1.5,0,1,1-1.5-1.5A1.5,1.5,0,0,1,403,733.5Z" transform="translate(-384.25 -714.25)" fill="none" stroke="#fff" stroke-width="1.5"/><path id="Path_4846" data-name="Path 4846" d="M389,717h12a4,4,0,0,1,4,4v5a4,4,0,0,1-4,4h-8a4,4,0,0,1-4-4Zm0,0a2,2,0,0,0-2-2h-2" transform="translate(-384.25 -714.25)" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/></svg>

                                                                </p>

                                                                <p class="added">

                                                                    <span>في السلة </span>
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="21.5" height="21.5" viewBox="0 0 21.5 21.5"><path id="Path_4843" data-name="Path 4843" d="M394,733.5a1.5,1.5,0,1,1-1.5-1.5A1.5,1.5,0,0,1,394,733.5Z" transform="translate(-384.25 -714.25)" fill="none" stroke="#fff" stroke-width="1.5"/><path id="Path_4844" data-name="Path 4844" d="M403,733.5a1.5,1.5,0,1,1-1.5-1.5A1.5,1.5,0,0,1,403,733.5Z" transform="translate(-384.25 -714.25)" fill="none" stroke="#fff" stroke-width="1.5"/><path id="Path_4845" data-name="Path 4845" d="M394,724l1.753,1.4a1,1,0,0,0,1.377-.122L400,722" transform="translate(-384.25 -714.25)" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/><path id="Path_4846" data-name="Path 4846" d="M389,717h12a4,4,0,0,1,4,4v5a4,4,0,0,1-4,4h-8a4,4,0,0,1-4-4Zm0,0a2,2,0,0,0-2-2h-2" transform="translate(-384.25 -714.25)" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/></svg>

                                                                </p> 

                                                            </a>

                                                        </div>
                                                        <div class="counter-wrap ">

                                                            <div class="count-wrap form-group">

                                                                <button type="button" class="count-btn count-add" data-type="plus">

                                                                    <span class="count-icon add-icon">

                                                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" width="45px" height="45px" viewBox="0 0 45 45" style="enable-background:new 0 0 45 45;" xml:space="preserve"><g><path d="M41.267,18.557H26.832V4.134C26.832,1.851,24.99,0,22.707,0c-2.283,0-4.124,1.851-4.124,4.135v14.432H4.141   c-2.283,0-4.139,1.851-4.138,4.135c-0.001,1.141,0.46,2.187,1.207,2.934c0.748,0.749,1.78,1.222,2.92,1.222h14.453V41.27   c0,1.142,0.453,2.176,1.201,2.922c0.748,0.748,1.777,1.211,2.919,1.211c2.282,0,4.129-1.851,4.129-4.133V26.857h14.435   c2.283,0,4.134-1.867,4.133-4.15C45.399,20.425,43.548,18.557,41.267,18.557z"></path></g></svg>

                                                                    </span>

                                                                </button>

                                                                <input type="text" class="count-num form-control " value="1" step="1" inputmode="tel" min="1" max="1000" autocomplete="off">

                                                                <button type="button" class="count-btn count-sub disabled" data-type="minus">

                                                                    <span class="count-icon sub-icon">

                                                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 42 42" style="enable-background:new 0 0 42 42;" xml:space="preserve"><path d="M37.059,16H26H16H4.941C2.224,16,0,18.282,0,21s2.224,5,4.941,5H16h10h11.059C39.776,26,42,23.718,42,21  S39.776,16,37.059,16z"></path></svg>

                                                                    </span>

                                                                </button>

                                                            </div>

                                                        </div>

                                                    </div>


                                                </div>


                                            </div>


                                    </div>
                                    <div class="swiper-slide product-wrap">

                                           <div class="product-item">

                                                <div class="product-img">

                                                    <a href="product-default.html">

                                                        <span class="tt-img">

                                                           <img class="img-fluid" src="{{asset('img/p1.png')}}" alt="productName">

                                                       </span>
                                                        <div class="product-code">كود : 543215114</div>

                                                    </a>

                                                </div>
                                                <div class="product-body">

                                                    <div class="price-info">

                                                        <p class="price-val">

                                                            <span>1.000.000 </span>
                                                            دولارًا

                                                        </p>

                                                        <p class="price-points">


                                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="13.945" height="13" viewBox="0 0 13.945 13"><defs><clipPath id="clip-path"><rect id="Rectangle_35" data-name="Rectangle 35" width="13.946" height="13" transform="translate(1149.69 2020)" fill="#fff"/></clipPath></defs><g id="Group_16" data-name="Group 16" transform="translate(-1149.69 -2020)" clip-path="url(#clip-path)"><path id="Path_89" data-name="Path 89" d="M1163.64,2026.5a6.3,6.3,0,0,1-1.88,4.44,7.116,7.116,0,0,1-5.1,1.95,6.543,6.543,0,0,1-6.84-6.39,6.186,6.186,0,0,1,2.08-4.75,7.215,7.215,0,0,1,4.76-1.75A6.756,6.756,0,0,1,1163.64,2026.5Z" fill="#ffd05b"/><path id="Path_90" data-name="Path 90" d="M1156.66,2031.74a5.253,5.253,0,1,0-5.62-5.24A5.448,5.448,0,0,0,1156.66,2031.74Z" fill="#ffeaa5"/><path id="Path_91" data-name="Path 91" d="M1161.39,2026.5a4.208,4.208,0,0,1-1.19,2.92,4.793,4.793,0,0,1-3.54,1.37,4.337,4.337,0,0,1-4.56-4.29,4.1,4.1,0,0,1,1.43-3.29,4.892,4.892,0,0,1,3.13-1.11,4.575,4.575,0,0,1,4.73,4.4Z" fill="#ffe077"/><path id="Path_92" data-name="Path 92" d="M1157.79,2026.71l-.92-2.22a.231.231,0,0,0-.42,0l-.91,2.22-1.18-.83-.15.19.93,2.58,3.46-.26.78-2.32a.224.224,0,0,0-.35-.23Z" fill="#ffc244"/><path id="Path_93" data-name="Path 93" d="M1157,2032.69a6.747,6.747,0,0,1-6.97-6.5,6.255,6.255,0,0,1,1.87-4.44,6.3,6.3,0,0,0-2.21,4.75,6.747,6.747,0,0,0,6.97,6.5,7.2,7.2,0,0,0,5.1-2.06,7.266,7.266,0,0,1-4.76,1.75Z" fill="#ffc244"/><path id="Path_94" data-name="Path 94" d="M1157.06,2030.54a4.577,4.577,0,0,1-4.73-4.41,4.191,4.191,0,0,1,1.2-2.92,4.253,4.253,0,0,0-1.59,3.29,4.567,4.567,0,0,0,4.72,4.4,4.876,4.876,0,0,0,3.54-1.48,4.948,4.948,0,0,1-3.14,1.12Z" fill="#ffd05b"/><path id="Path_95" data-name="Path 95" d="M1155,2027.8l-.64-1.92-.06-.04c-.18-.12-.42.04-.35.23l.82,2.44a.432.432,0,0,0,.42.3h2.94a.445.445,0,0,0,.43-.3l.04-.12h-2.74a.894.894,0,0,1-.86-.59Z" fill="#ffaa5a"/></g></svg>

                                                            5160

                                                        </p>

                                                    </div>

                                                    <div class="product-desc">

                                                        <a href="product-default.html">

                                                            بنطلون جينز رجالي ضيق مثال
                                                            بقصة ضيقة 
                                                             بنطلون جينز رجالي ضيق مثال

                                                        </a>

                                                    </div>

                                                    <div class="product-actions">

                                                        <div class="cart-action ">

                                                            <a class="btn-cart loading-btn" href="#">

                                                                <p class="add-to-cart">
                                                                    <span>إضافة للسلة </span>
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="21.5" height="21.5" viewBox="0 0 21.5 21.5"><path id="Path_4843" data-name="Path 4843" d="M394,733.5a1.5,1.5,0,1,1-1.5-1.5A1.5,1.5,0,0,1,394,733.5Z" transform="translate(-384.25 -714.25)" fill="none" stroke="#fff" stroke-width="1.5"/><path id="Path_4844" data-name="Path 4844" d="M403,733.5a1.5,1.5,0,1,1-1.5-1.5A1.5,1.5,0,0,1,403,733.5Z" transform="translate(-384.25 -714.25)" fill="none" stroke="#fff" stroke-width="1.5"/><path id="Path_4846" data-name="Path 4846" d="M389,717h12a4,4,0,0,1,4,4v5a4,4,0,0,1-4,4h-8a4,4,0,0,1-4-4Zm0,0a2,2,0,0,0-2-2h-2" transform="translate(-384.25 -714.25)" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/></svg>

                                                                </p>

                                                                <p class="added">

                                                                    <span>في السلة </span>
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="21.5" height="21.5" viewBox="0 0 21.5 21.5"><path id="Path_4843" data-name="Path 4843" d="M394,733.5a1.5,1.5,0,1,1-1.5-1.5A1.5,1.5,0,0,1,394,733.5Z" transform="translate(-384.25 -714.25)" fill="none" stroke="#fff" stroke-width="1.5"/><path id="Path_4844" data-name="Path 4844" d="M403,733.5a1.5,1.5,0,1,1-1.5-1.5A1.5,1.5,0,0,1,403,733.5Z" transform="translate(-384.25 -714.25)" fill="none" stroke="#fff" stroke-width="1.5"/><path id="Path_4845" data-name="Path 4845" d="M394,724l1.753,1.4a1,1,0,0,0,1.377-.122L400,722" transform="translate(-384.25 -714.25)" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/><path id="Path_4846" data-name="Path 4846" d="M389,717h12a4,4,0,0,1,4,4v5a4,4,0,0,1-4,4h-8a4,4,0,0,1-4-4Zm0,0a2,2,0,0,0-2-2h-2" transform="translate(-384.25 -714.25)" fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/></svg>

                                                                </p> 

                                                            </a>

                                                        </div>
                                                        <div class="counter-wrap ">

                                                            <div class="count-wrap form-group">

                                                                <button type="button" class="count-btn count-add" data-type="plus">

                                                                    <span class="count-icon add-icon">

                                                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" width="45px" height="45px" viewBox="0 0 45 45" style="enable-background:new 0 0 45 45;" xml:space="preserve"><g><path d="M41.267,18.557H26.832V4.134C26.832,1.851,24.99,0,22.707,0c-2.283,0-4.124,1.851-4.124,4.135v14.432H4.141   c-2.283,0-4.139,1.851-4.138,4.135c-0.001,1.141,0.46,2.187,1.207,2.934c0.748,0.749,1.78,1.222,2.92,1.222h14.453V41.27   c0,1.142,0.453,2.176,1.201,2.922c0.748,0.748,1.777,1.211,2.919,1.211c2.282,0,4.129-1.851,4.129-4.133V26.857h14.435   c2.283,0,4.134-1.867,4.133-4.15C45.399,20.425,43.548,18.557,41.267,18.557z"></path></g></svg>

                                                                    </span>

                                                                </button>

                                                                <input type="text" class="count-num form-control " value="1" step="1" inputmode="tel" min="1" max="1000" autocomplete="off">

                                                                <button type="button" class="count-btn count-sub disabled" data-type="minus">

                                                                    <span class="count-icon sub-icon">

                                                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 42 42" style="enable-background:new 0 0 42 42;" xml:space="preserve"><path d="M37.059,16H26H16H4.941C2.224,16,0,18.282,0,21s2.224,5,4.941,5H16h10h11.059C39.776,26,42,23.718,42,21  S39.776,16,37.059,16z"></path></svg>

                                                                    </span>

                                                                </button>

                                                            </div>

                                                        </div>

                                                    </div>


                                                </div>


                                            </div>


                                    </div>
                                    

                                </div>

                            </div>

                            <div class="slider-arrow prev-btn">

                                  <i class="fas fa-chevron-right "></i>

                              </div>

                            <div class="slider-arrow next-btn" >


                                  <i class="fas fa-chevron-left "></i>
                            </div>


                        </div>

                    </div>
                    <div class="show-more-wrap ">

                       <a class="show-more show-more-loading d-none" href="#">

                                <span class="up-loader-inline fa-spin ">

                                        <img class="img-fluid" src="{{asset('img/loading.svg')}}" alt="loaderIcon">
                                </span>
                                <span class="loader-text">عرض المزيد</span>

                        </a>
                       <a class="show-more show-more-loading no-more d-none " href="#">

                                <span class="up-loader-inline fa-spin ">

                                        <img class="img-fluid" src="{{asset('img/loading.svg')}}" alt="loaderIcon">
                                </span>
                                <span class="loader-text">لايوجد منتجات أخري</span>

                        </a>
                       <a class="show-more" href="products.html">


                                <span class="loader-text">عرض كل المنتجات </span>

                        </a>

                    </div>
                
                </div>
            
            </div>
        
        </div>
    
    </section>
    
    <!-- ***** products-categories-section End ***** -->
            
    

</main>
 
 <!-- jquery 3.5.1   -->
 <script src="{{asset('js/jquery-3.5.1.min.js')}}"></script>
    
 <!-- bootstrap v5   -->
<script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
 
<!-- matchHeight jquery plugin   -->
<script src="{{asset('js/jquery.matchHeight-min.js')}}"></script>

<!-- swiper js   -->
<script src="{{asset('js/swiper.js')}}"></script>

 <!-- rateit js   -->
 <script src="{{asset('js/jquery.rateit.min.js')}}"></script>
  
 <!-- main style js   -->
<script src="{{asset('js/main.js')}}"></script>

<script>
    

    /*------------- #duplicated-products-slider  --------------*/
    $(function(){
       
        if (window.matchMedia('(min-width: 576px)').matches){
            
            $(".duplicated-products-slider").each(function(index, element){
                var $this = $(this);
                $this.addClass("instance-" + index);
                $this.parent().find(".prev-btn").addClass("prev-btn-" + index);
                $this.parent().find(".next-btn").addClass("next-btn-" + index);
                var swiper = new Swiper(".instance-" + index, {

                    slidesPerView: 1,
                    spaceBetween: 24,
                    grabCursor: true,
                    a11y: false,
                    loop:false,
                    loopFillGroupWithBlank: false,
                    initialSlide: 0,
                    navigation: {

                      prevEl: ".prev-btn-" + index ,
                      nextEl: ".next-btn-" + index ,

                    },
                    breakpoints: {

                        576: {
                            slidesPerView: 2,
                            slidesPerGroup: 2,
                            spaceBetween: 16,
                        },
                        768: {
                            slidesPerView: 3,
                            slidesPerGroup: 3,
                            spaceBetween: 12,
                        },
                        992: {
                            slidesPerView: 3,
                            slidesPerGroup: 3,
                            spaceBetween: 16,
                        },
                        
                        1024: {
                            slidesPerView: 4,
                            slidesPerGroup: 4,
                            spaceBetween: 16,
                        },

                        1200: {
                            slidesPerView: 4,
                            slidesPerGroup: 4,
                            spaceBetween: 24,
                        },

                    },


                });

            });
    
            
        }
        
    });
    
    /*------------- #categories-slider  --------------*/
    function free_mode(){
        

        if ((window.matchMedia('(max-width: 575.98px)').matches) && $('.swiper').parents(".slider-container").hasClass("free-mode-slider")){

          return true ;
        }else{

            return false ;
        }

    }
    $(function(){
       
        if (window.matchMedia('(min-width: 576px)').matches){
            
           var swiper = new Swiper(".categories-slider", {

                slidesPerView: 3,
                spaceBetween: 12,
                grabCursor: true,
                a11y: false,
                loop:false,
                loopFillGroupWithBlank: false,
                initialSlide: 0,
                freeMode: free_mode(),
                navigation: {

                      prevEl: ".categories-slider-container .prev-btn" ,
                      nextEl: ".categories-slider-container .next-btn" ,

                },
                breakpoints: {

                  0:{

                      slidesPerView: "auto",
                      spaceBetween: 0,
                      speed: 300,
                  },
                  576: {
                    slidesPerView: 6,
                    slidesPerGroup: 6,  
                    spaceBetween: 12,

                  },
                  768: {
                    slidesPerView: 8,
                    slidesPerGroup: 8,  
                    spaceBetween: 12,

                  },
                  992: {
                    slidesPerView: 10,
                    slidesPerGroup: 10,  
                    spaceBetween: 12,
                  },
                  1200: {
                    slidesPerView: 12,
                    slidesPerGroup: 12,  
                    spaceBetween: 12,
                  },
                  1400: {
                    slidesPerView: 14,
                    slidesPerGroup: 14,  
                    spaceBetween: 12,
                  },

                },


           });

            
        }
        
    });
   

</script>
    
    <!-- ***** footer-section End ***** -->
    
    


@endsection