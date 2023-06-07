@extends('Frontend.layouts.app')
@section('title', 'Stores')
@section('content')

<section class="section-style stores-section categories-welcome-section ">
        <div class="container custom-container">
        
            <div class="categories-welcome-area">

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
    
    
    <!-- ***** top-stores-section Start ***** -->
    
    <section class="section-style stores-section top-stores-section ">
    
        <div class="container custom-container">
        
            <div class="stores-area top-stores-area">
            
                <div class="main-title sub-title text-center mb-alt">
                
                    <h1 class="title">المتاجر الاكثر تقيما</h1>
                
                </div>
                
                <div class="scroll-boxes">
                    
                    <div class="row target-row row-cols-lg-6 row-cols-md-5 justify-content-md-center gx-3">

                        <div class="store-wrap">

                            <a href="{{route('store')}}" class="store-item">

                                <div class="store-img">

                                    <img class="img-fluid" src="{{asset('img/store.svg')}}" alt="storeName">

                                </div>
                                <div class="store-texts">

                                    <span class="store-name">اسم المتجر</span>


                                </div>

                            </a>

                        </div>
                        <div class="store-wrap">

                            <a href="{{route('store')}}" class="store-item">

                                <div class="store-img">

                                    <img class="img-fluid" src="{{asset('img/store.svg')}}" alt="storeName">

                                </div>
                                <div class="store-texts">

                                    <span class="store-name">اسم المتجر</span>


                                </div>

                            </a>

                        </div>
                        <div class="store-wrap">

                            <a href="{{route('store')}}" class="store-item">

                                <div class="store-img">

                                    <img class="img-fluid" src="{{asset('img/store.svg')}}" alt="storeName">

                                </div>
                                <div class="store-texts">

                                    <span class="store-name">اسم المتجر</span>


                                </div>

                            </a>

                        </div>
                        <div class="store-wrap">

                            <a href="{{route('store')}}" class="store-item">

                                <div class="store-img">

                                    <img class="img-fluid" src="{{asset('img/store.svg')}}" alt="storeName">

                                </div>
                                <div class="store-texts">

                                    <span class="store-name">اسم المتجر</span>


                                </div>

                            </a>

                        </div>
                        <div class="store-wrap">

                            <a href="{{route('store')}}" class="store-item">

                                <div class="store-img">

                                    <img class="img-fluid" src="{{asset('img/store.svg')}}" alt="storeName">

                                </div>
                                <div class="store-texts">

                                    <span class="store-name">اسم المتجر</span>


                                </div>

                            </a>

                        </div>
                        <div class="store-wrap">

                            <a href="{{route('store')}}" class="store-item">

                                <div class="store-img">

                                    <img class="img-fluid" src="{{asset('img/store.svg')}}" alt="storeName">

                                </div>
                                <div class="store-texts">

                                    <span class="store-name">اسم المتجر</span>


                                </div>

                            </a>

                        </div>

                        <div class="divider d-none d-md-block col-12"></div>
                    
                        
                        <div class="store-wrap">

                            <a href="{{route('store')}}" class="store-item">

                                <div class="store-img">

                                    <img class="img-fluid" src="{{asset('img/store.svg')}}" alt="storeName">

                                </div>
                                <div class="store-texts">

                                    <span class="store-name">اسم المتجر</span>


                                </div>

                            </a>

                        </div>
                        <div class="store-wrap">

                            <a href="{{route('store')}}" class="store-item">

                                <div class="store-img">

                                    <img class="img-fluid" src="{{asset('img/store.svg')}}" alt="storeName">

                                </div>
                                <div class="store-texts">

                                    <span class="store-name">اسم المتجر</span>


                                </div>

                            </a>

                        </div>
                        <div class="store-wrap">

                            <a href="{{route('store')}}" class="store-item">

                                <div class="store-img">

                                    <img class="img-fluid" src="{{asset('img/store.svg')}}" alt="storeName">

                                </div>
                                <div class="store-texts">

                                    <span class="store-name">اسم المتجر</span>


                                </div>

                            </a>

                        </div>
                        <div class="store-wrap">

                            <a href="{{route('store')}}" class="store-item">

                                <div class="store-img">

                                    <img class="img-fluid" src="{{asset('img/store.svg')}}" alt="storeName">

                                </div>
                                <div class="store-texts">

                                    <span class="store-name">اسم المتجر</span>


                                </div>

                            </a>

                        </div>
                        <div class="store-wrap">

                            <a href="{{route('store')}}" class="store-item">

                                <div class="store-img">

                                    <img class="img-fluid" src="{{asset('img/store.svg')}}" alt="storeName">

                                </div>
                                <div class="store-texts">

                                    <span class="store-name">اسم المتجر</span>


                                </div>

                            </a>

                        </div>
                        <div class="store-wrap">

                            <a href="{{route('store')}}" class="store-item">

                                <div class="store-img">

                                    <img class="img-fluid" src="{{asset('img/store.svg')}}" alt="storeName">

                                </div>
                                <div class="store-texts">

                                    <span class="store-name">اسم المتجر</span>


                                </div>

                            </a>

                        </div>


                    </div>
                    

                </div>
                
                <div class="show-more-wrap">

                       <a class="show-more" href="all-stores.html">


                            <span class="loader-text">عرض كل المتاجر </span>

                        </a>

                </div>
                
            
            </div>
        
        </div>
    
    </section>
    
    <!-- ***** top-stores-section End ***** -->
    
    
    
    <!-- ***** all-stores Start ***** -->
    
    <section class="section-style all-stores-section  ">
    
        <div class="container custom-container">
        
            <div class="stores-area all-stores-area">
            
                <div class="main-title">
                
                    <h1 class="title">#جميع المتاجر</h1>
                
                </div>
                <div class="stores-boxes">
                
                    <div class="row row-cols-lg-3  row-cols-md-2 gx-xl-4 gx-md-3">
                    
                        <div class="box-wrap">
                        
                            <a href="{{route('store')}}" class="store-box">
                            
                                <div  class="store-item">

                                    <div class="store-img">

                                        <img class="img-fluid" src="{{asset('img/store.svg')}}" alt="storeName">

                                    </div>
                                    <div class="store-info">

                                        <div class="store-texts">
                                        
                                            <p class="store-name">اسم المتجر</p>
                                        
                                        </div>
                                        <div class="rate-wrap">
                                             <p class="rate-text">التقيم</p>
                                             <div class="store-rate star-rating">
                                                <div class="rateit" 
                                                     data-rateit-mode="font"
                                                     data-rateit-step=".5" 
                                                     data-rateit-value="4.5" 
                                                     data-rateit-ispreset="true" 
                                                     data-rateit-readonly="true">
                                                </div>

                                            </div>
                                          
                                            
                                            
                                        </div>
                            

                                    </div>

                                </div>
                                
                               
                            </a>
                        
                        </div>
                        <div class="box-wrap">
                        
                            <a href="{{route('store')}}" class="store-box">
                            
                                <div  class="store-item">

                                    <div class="store-img">

                                        <img class="img-fluid" src="{{asset('img/store.svg')}}" alt="storeName">

                                    </div>
                                    <div class="store-info">

                                        <div class="store-texts">
                                        
                                            <p class="store-name">اسم المتجر</p>
                                        
                                        </div>
                                        <div class="rate-wrap">
                                             <p class="rate-text">التقيم</p>
                                             <div class="store-rate star-rating">
                                                <div class="rateit" 
                                                     data-rateit-mode="font"
                                                     data-rateit-step=".5" 
                                                     data-rateit-value="5" 
                                                     data-rateit-ispreset="true" 
                                                     data-rateit-readonly="true">
                                                </div>

                                            </div>
                                          
                                            
                                            
                                        </div>
                            

                                    </div>

                                </div>
                                
                               
                            </a>
                        
                        </div>
                        <div class="box-wrap">
                        
                            <a href="{{route('store')}}" class="store-box">
                            
                                <div  class="store-item">

                                    <div class="store-img">

                                        <img class="img-fluid" src="{{asset('img/store.svg')}}" alt="storeName">

                                    </div>
                                    <div class="store-info">

                                        <div class="store-texts">
                                        
                                            <p class="store-name">اسم المتجر</p>
                                        
                                        </div>
                                        <div class="rate-wrap">
                                             <p class="rate-text">التقيم</p>
                                             <div class="store-rate star-rating">
                                                <div class="rateit" 
                                                     data-rateit-mode="font"
                                                     data-rateit-step=".5" 
                                                     data-rateit-value="4.25" 
                                                     data-rateit-ispreset="true" 
                                                     data-rateit-readonly="true">
                                                </div>

                                            </div>
                                          
                                            
                                            
                                        </div>
                            

                                    </div>

                                </div>
                                
                               
                            </a>
                        
                        </div>
                        <div class="box-wrap">
                        
                            <a href="{{route('store')}}" class="store-box">
                            
                                <div  class="store-item">

                                    <div class="store-img">

                                        <img class="img-fluid" src="{{asset('img/store.svg')}}" alt="storeName">

                                    </div>
                                    <div class="store-info">

                                        <div class="store-texts">
                                        
                                            <p class="store-name">اسم المتجر</p>
                                        
                                        </div>
                                        <div class="rate-wrap">
                                             <p class="rate-text">التقيم</p>
                                             <div class="store-rate star-rating">
                                                <div class="rateit" 
                                                     data-rateit-mode="font"
                                                     data-rateit-step=".5" 
                                                     data-rateit-value="3.5" 
                                                     data-rateit-ispreset="true" 
                                                     data-rateit-readonly="true">
                                                </div>

                                            </div>
                                          
                                            
                                            
                                        </div>
                            

                                    </div>

                                </div>
                                
                               
                            </a>
                        
                        </div>
                        <div class="box-wrap">
                        
                            <a href="{{route('store')}}" class="store-box">
                            
                                <div  class="store-item">

                                    <div class="store-img">

                                        <img class="img-fluid" src="{{asset('img/store.svg')}}" alt="storeName">

                                    </div>
                                    <div class="store-info">

                                        <div class="store-texts">
                                        
                                            <p class="store-name">اسم المتجر</p>
                                        
                                        </div>
                                        <div class="rate-wrap">
                                             <p class="rate-text">التقيم</p>
                                             <div class="store-rate star-rating">
                                                <div class="rateit" 
                                                     data-rateit-mode="font"
                                                     data-rateit-step=".5" 
                                                     data-rateit-value="4" 
                                                     data-rateit-ispreset="true" 
                                                     data-rateit-readonly="true">
                                                </div>

                                            </div>
                                          
                                            
                                            
                                        </div>
                            

                                    </div>

                                </div>
                                
                               
                            </a>
                        
                        </div>
                        <div class="box-wrap">
                        
                            <a href="{{route('store')}}" class="store-box">
                            
                                <div  class="store-item">

                                    <div class="store-img">

                                        <img class="img-fluid" src="{{asset('img/store.svg')}}" alt="storeName">

                                    </div>
                                    <div class="store-info">

                                        <div class="store-texts">
                                        
                                            <p class="store-name">اسم المتجر</p>
                                        
                                        </div>
                                        <div class="rate-wrap">
                                             <p class="rate-text">التقيم</p>
                                             <div class="store-rate star-rating">
                                                <div class="rateit" 
                                                     data-rateit-mode="font"
                                                     data-rateit-step=".5" 
                                                     data-rateit-value="3" 
                                                     data-rateit-ispreset="true" 
                                                     data-rateit-readonly="true">
                                                </div>

                                            </div>
                                          
                                            
                                            
                                        </div>
                            

                                    </div>

                                </div>
                                
                               
                            </a>
                        
                        </div>
                        <div class="box-wrap">
                        
                            <a href="{{route('store')}}" class="store-box">
                            
                                <div  class="store-item">

                                    <div class="store-img">

                                        <img class="img-fluid" src="{{asset('img/store.svg')}}" alt="storeName">

                                    </div>
                                    <div class="store-info">

                                        <div class="store-texts">
                                        
                                            <p class="store-name">اسم المتجر</p>
                                        
                                        </div>
                                        <div class="rate-wrap">
                                             <p class="rate-text">التقيم</p>
                                             <div class="store-rate star-rating">
                                                <div class="rateit" 
                                                     data-rateit-mode="font"
                                                     data-rateit-step=".5" 
                                                     data-rateit-value="3.5" 
                                                     data-rateit-ispreset="true" 
                                                     data-rateit-readonly="true">
                                                </div>

                                            </div>
                                          
                                            
                                            
                                        </div>
                            

                                    </div>

                                </div>
                                
                               
                            </a>
                        
                        </div>
                        <div class="box-wrap">
                        
                            <a href="{{route('store')}}" class="store-box">
                            
                                <div  class="store-item">

                                    <div class="store-img">

                                        <img class="img-fluid" src="{{asset('img/store.svg')}}" alt="storeName">

                                    </div>
                                    <div class="store-info">

                                        <div class="store-texts">
                                        
                                            <p class="store-name">اسم المتجر</p>
                                        
                                        </div>
                                        <div class="rate-wrap">
                                             <p class="rate-text">التقيم</p>
                                             <div class="store-rate star-rating">
                                                <div class="rateit" 
                                                     data-rateit-mode="font"
                                                     data-rateit-step=".5" 
                                                     data-rateit-value="4" 
                                                     data-rateit-ispreset="true" 
                                                     data-rateit-readonly="true">
                                                </div>

                                            </div>
                                          
                                            
                                            
                                        </div>
                            

                                    </div>

                                </div>
                                
                               
                            </a>
                        
                        </div>
                        <div class="box-wrap">
                        
                            <a href="{{route('store')}}" class="store-box">
                            
                                <div  class="store-item">

                                    <div class="store-img">

                                        <img class="img-fluid" src="{{asset('img/store.svg')}}" alt="storeName">

                                    </div>
                                    <div class="store-info">

                                        <div class="store-texts">
                                        
                                            <p class="store-name">اسم المتجر</p>
                                        
                                        </div>
                                        <div class="rate-wrap">
                                             <p class="rate-text">التقيم</p>
                                             <div class="store-rate star-rating">
                                                <div class="rateit" 
                                                     data-rateit-mode="font"
                                                     data-rateit-step=".5" 
                                                     data-rateit-value="3" 
                                                     data-rateit-ispreset="true" 
                                                     data-rateit-readonly="true">
                                                </div>

                                            </div>
                                          
                                            
                                            
                                        </div>
                            

                                    </div>

                                </div>
                                
                               
                            </a>
                        
                        </div>
                        <div class="box-wrap">
                        
                            <a href="{{route('store')}}" class="store-box">
                            
                                <div  class="store-item">

                                    <div class="store-img">

                                        <img class="img-fluid" src="{{asset('img/store.svg')}}" alt="storeName">

                                    </div>
                                    <div class="store-info">

                                        <div class="store-texts">
                                        
                                            <p class="store-name">اسم المتجر</p>
                                        
                                        </div>
                                        <div class="rate-wrap">
                                             <p class="rate-text">التقيم</p>
                                             <div class="store-rate star-rating">
                                                <div class="rateit" 
                                                     data-rateit-mode="font"
                                                     data-rateit-step=".5" 
                                                     data-rateit-value="3.5" 
                                                     data-rateit-ispreset="true" 
                                                     data-rateit-readonly="true">
                                                </div>

                                            </div>
                                          
                                            
                                            
                                        </div>
                            

                                    </div>

                                </div>
                                
                               
                            </a>
                        
                        </div>
                        <div class="box-wrap">
                        
                            <a href="{{route('store')}}" class="store-box">
                            
                                <div  class="store-item">

                                    <div class="store-img">

                                        <img class="img-fluid" src="{{asset('img/store.svg')}}" alt="storeName">

                                    </div>
                                    <div class="store-info">

                                        <div class="store-texts">
                                        
                                            <p class="store-name">اسم المتجر</p>
                                        
                                        </div>
                                        <div class="rate-wrap">
                                             <p class="rate-text">التقيم</p>
                                             <div class="store-rate star-rating">
                                                <div class="rateit" 
                                                     data-rateit-mode="font"
                                                     data-rateit-step=".5" 
                                                     data-rateit-value="4" 
                                                     data-rateit-ispreset="true" 
                                                     data-rateit-readonly="true">
                                                </div>

                                            </div>
                                          
                                            
                                            
                                        </div>
                            

                                    </div>

                                </div>
                                
                               
                            </a>
                        
                        </div>
                        <div class="box-wrap">
                        
                            <a href="{{route('store')}}" class="store-box">
                            
                                <div  class="store-item">

                                    <div class="store-img">

                                        <img class="img-fluid" src="{{asset('img/store.svg')}}" alt="storeName">

                                    </div>
                                    <div class="store-info">

                                        <div class="store-texts">
                                        
                                            <p class="store-name">اسم المتجر</p>
                                        
                                        </div>
                                        <div class="rate-wrap">
                                             <p class="rate-text">التقيم</p>
                                             <div class="store-rate star-rating">
                                                <div class="rateit" 
                                                     data-rateit-mode="font"
                                                     data-rateit-step=".5" 
                                                     data-rateit-value="3" 
                                                     data-rateit-ispreset="true" 
                                                     data-rateit-readonly="true">
                                                </div>

                                            </div>
                                          
                                            
                                            
                                        </div>
                            

                                    </div>

                                </div>
                                
                               
                            </a>
                        
                        </div>
                        <div class="box-wrap">
                        
                            <a href="{{route('store')}}" class="store-box">
                            
                                <div  class="store-item">

                                    <div class="store-img">

                                        <img class="img-fluid" src="{{asset('img/store.svg')}}" alt="storeName">

                                    </div>
                                    <div class="store-info">

                                        <div class="store-texts">
                                        
                                            <p class="store-name">اسم المتجر</p>
                                        
                                        </div>
                                        <div class="rate-wrap">
                                             <p class="rate-text">التقيم</p>
                                             <div class="store-rate star-rating">
                                                <div class="rateit" 
                                                     data-rateit-mode="font"
                                                     data-rateit-step=".5" 
                                                     data-rateit-value="3.5" 
                                                     data-rateit-ispreset="true" 
                                                     data-rateit-readonly="true">
                                                </div>

                                            </div>
                                          
                                            
                                            
                                        </div>
                            

                                    </div>

                                </div>
                                
                               
                            </a>
                        
                        </div>
                        <div class="box-wrap">
                        
                            <a href="{{route('store')}}" class="store-box">
                            
                                <div  class="store-item">

                                    <div class="store-img">

                                        <img class="img-fluid" src="{{asset('img/store.svg')}}" alt="storeName">

                                    </div>
                                    <div class="store-info">

                                        <div class="store-texts">
                                        
                                            <p class="store-name">اسم المتجر</p>
                                        
                                        </div>
                                        <div class="rate-wrap">
                                             <p class="rate-text">التقيم</p>
                                             <div class="store-rate star-rating">
                                                <div class="rateit" 
                                                     data-rateit-mode="font"
                                                     data-rateit-step=".5" 
                                                     data-rateit-value="4" 
                                                     data-rateit-ispreset="true" 
                                                     data-rateit-readonly="true">
                                                </div>

                                            </div>
                                          
                                            
                                            
                                        </div>
                            

                                    </div>

                                </div>
                                
                               
                            </a>
                        
                        </div>
                        <div class="box-wrap">
                        
                            <a href="{{route('store')}}" class="store-box">
                            
                                <div  class="store-item">

                                    <div class="store-img">

                                        <img class="img-fluid" src="{{asset('img/store.svg')}}" alt="storeName">

                                    </div>
                                    <div class="store-info">

                                        <div class="store-texts">
                                        
                                            <p class="store-name">اسم المتجر</p>
                                        
                                        </div>
                                        <div class="rate-wrap">
                                             <p class="rate-text">التقيم</p>
                                             <div class="store-rate star-rating">
                                                <div class="rateit" 
                                                     data-rateit-mode="font"
                                                     data-rateit-step=".5" 
                                                     data-rateit-value="3" 
                                                     data-rateit-ispreset="true" 
                                                     data-rateit-readonly="true">
                                                </div>

                                            </div>
                                          
                                            
                                            
                                        </div>
                            

                                    </div>

                                </div>
                                
                               
                            </a>
                        
                        </div>
                        
                    
                    
                    </div>
                    
                    <div class="show-more-wrap mt-alt">

                       <a class="show-more show-more-loading" href="#">

                                <span class="up-loader-inline fa-spin ">

                                        <img class="img-fluid" src="{{asset('img/loading.svg')}}" alt="loaderIcon">
                                </span>
                                <span class="loader-text">عرض المزيد</span>

                        </a>
                       
                    </div>
                    
                
                </div>
                
            </div>
        
        </div>
    
    </section>
    
    <!-- ***** all-stores End ***** -->
    
    
    
    <!-- ***** favorite-stores-section Start ***** -->
    
    <section class="section-style favorite-stores-section  ">
    
        <div class="container custom-container">
        
            <div class="stores-area favorite-stores-area">
            
               
                <div class="stores-boxes">

                    <div class="row row-cols-lg-3  row-cols-md-2 gx-xl-4 gx-md-3">

                        <div class="box-wrap">

                            <div class="store-box">

                                <a href="{{route('store')}}" class="store-item">

                                    <div class="store-img">

                                        <img class="img-fluid" src="{{asset('img/store.svg')}}" alt="storeName">

                                    </div>
                                    <div class="store-texts">

                                        <p class="store-name">اسم المتجر</p>
                                        <span class="store-num">453453453</span>


                                    </div>

                                </a>
                                <div class="favourite-action">

                                            <button class="btn-wishlist active" data-bs-toggle="modal" data-bs-target="#confirmDeletemodalStore">

                                                <svg xmlns="http://www.w3.org/2000/svg" width="21.5" height="19.321" viewBox="0 0 21.5 19.321"><path id="Path_4867" data-name="Path 4867" d="M772.88,286.31a2.181,2.181,0,0,0,1.24,0c2.9-.99,9.38-5.12,9.38-12.12a5.574,5.574,0,0,0-5.56-5.59,5.515,5.515,0,0,0-4.44,2.24,5.547,5.547,0,0,0-10,3.35C763.5,281.19,769.98,285.32,772.88,286.31Z" transform="translate(-762.75 -267.85)"  stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/></svg>


                                            </button>

                                        </div>


                            </div>

                        </div>
                        <div class="box-wrap">

                            <div class="store-box">

                                <a href="{{route('store')}}" class="store-item">

                                    <div class="store-img">

                                        <img class="img-fluid" src="{{asset('img/store.svg')}}" alt="storeName">

                                    </div>
                                    <div class="store-texts">

                                        <p class="store-name">اسم المتجر</p>
                                        <span class="store-num">453453453</span>


                                    </div>

                                </a>
                                <div class="favourite-action">

                                            <button class="btn-wishlist active" data-bs-toggle="modal" data-bs-target="#confirmDeletemodalStore">

                                                <svg xmlns="http://www.w3.org/2000/svg" width="21.5" height="19.321" viewBox="0 0 21.5 19.321"><path id="Path_4867" data-name="Path 4867" d="M772.88,286.31a2.181,2.181,0,0,0,1.24,0c2.9-.99,9.38-5.12,9.38-12.12a5.574,5.574,0,0,0-5.56-5.59,5.515,5.515,0,0,0-4.44,2.24,5.547,5.547,0,0,0-10,3.35C763.5,281.19,769.98,285.32,772.88,286.31Z" transform="translate(-762.75 -267.85)"  stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/></svg>


                                            </button>

                                        </div>


                            </div>

                        </div>
                        <div class="box-wrap">

                            <div class="store-box">

                                <a href="{{route('store')}}" class="store-item">

                                    <div class="store-img">

                                        <img class="img-fluid" src="{{asset('img/store.svg')}}" alt="storeName">

                                    </div>
                                    <div class="store-texts">

                                        <p class="store-name">اسم المتجر</p>
                                        <span class="store-num">453453453</span>


                                    </div>

                                </a>
                                <div class="favourite-action">

                                            <button class="btn-wishlist active" data-bs-toggle="modal" data-bs-target="#confirmDeletemodalStore">

                                                <svg xmlns="http://www.w3.org/2000/svg" width="21.5" height="19.321" viewBox="0 0 21.5 19.321"><path id="Path_4867" data-name="Path 4867" d="M772.88,286.31a2.181,2.181,0,0,0,1.24,0c2.9-.99,9.38-5.12,9.38-12.12a5.574,5.574,0,0,0-5.56-5.59,5.515,5.515,0,0,0-4.44,2.24,5.547,5.547,0,0,0-10,3.35C763.5,281.19,769.98,285.32,772.88,286.31Z" transform="translate(-762.75 -267.85)"  stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/></svg>


                                            </button>

                                        </div>


                            </div>

                        </div>
                        <div class="box-wrap">

                            <div class="store-box">

                                <a href="{{route('store')}}" class="store-item">

                                    <div class="store-img">

                                        <img class="img-fluid" src="{{asset('img/store.svg')}}" alt="storeName">

                                    </div>
                                    <div class="store-texts">

                                        <p class="store-name">اسم المتجر</p>
                                        <span class="store-num">453453453</span>


                                    </div>

                                </a>
                                <div class="favourite-action">

                                            <button class="btn-wishlist active" data-bs-toggle="modal" data-bs-target="#confirmDeletemodalStore">

                                                <svg xmlns="http://www.w3.org/2000/svg" width="21.5" height="19.321" viewBox="0 0 21.5 19.321"><path id="Path_4867" data-name="Path 4867" d="M772.88,286.31a2.181,2.181,0,0,0,1.24,0c2.9-.99,9.38-5.12,9.38-12.12a5.574,5.574,0,0,0-5.56-5.59,5.515,5.515,0,0,0-4.44,2.24,5.547,5.547,0,0,0-10,3.35C763.5,281.19,769.98,285.32,772.88,286.31Z" transform="translate(-762.75 -267.85)"  stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/></svg>


                                            </button>

                                        </div>


                            </div>

                        </div>
                        <div class="box-wrap">

                            <div class="store-box">

                                <a href="{{route('store')}}" class="store-item">

                                    <div class="store-img">

                                        <img class="img-fluid" src="{{asset('img/store.svg')}}" alt="storeName">

                                    </div>
                                    <div class="store-texts">

                                        <p class="store-name">اسم المتجر</p>
                                        <span class="store-num">453453453</span>


                                    </div>

                                </a>
                                <div class="favourite-action">

                                            <button class="btn-wishlist active" data-bs-toggle="modal" data-bs-target="#confirmDeletemodalStore">

                                                <svg xmlns="http://www.w3.org/2000/svg" width="21.5" height="19.321" viewBox="0 0 21.5 19.321"><path id="Path_4867" data-name="Path 4867" d="M772.88,286.31a2.181,2.181,0,0,0,1.24,0c2.9-.99,9.38-5.12,9.38-12.12a5.574,5.574,0,0,0-5.56-5.59,5.515,5.515,0,0,0-4.44,2.24,5.547,5.547,0,0,0-10,3.35C763.5,281.19,769.98,285.32,772.88,286.31Z" transform="translate(-762.75 -267.85)"  stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/></svg>


                                            </button>

                                        </div>


                            </div>

                        </div>
                        <div class="box-wrap">

                            <div class="store-box">

                                <a href="{{route('store')}}" class="store-item">

                                    <div class="store-img">

                                        <img class="img-fluid" src="{{asset('img/store.svg')}}" alt="storeName">

                                    </div>
                                    <div class="store-texts">

                                        <p class="store-name">اسم المتجر</p>
                                        <span class="store-num">453453453</span>


                                    </div>

                                </a>
                                <div class="favourite-action">

                                            <button class="btn-wishlist active" data-bs-toggle="modal" data-bs-target="#confirmDeletemodalStore">

                                                <svg xmlns="http://www.w3.org/2000/svg" width="21.5" height="19.321" viewBox="0 0 21.5 19.321"><path id="Path_4867" data-name="Path 4867" d="M772.88,286.31a2.181,2.181,0,0,0,1.24,0c2.9-.99,9.38-5.12,9.38-12.12a5.574,5.574,0,0,0-5.56-5.59,5.515,5.515,0,0,0-4.44,2.24,5.547,5.547,0,0,0-10,3.35C763.5,281.19,769.98,285.32,772.88,286.31Z" transform="translate(-762.75 -267.85)"  stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"/></svg>


                                            </button>

                                        </div>


                            </div>

                        </div>


                    </div>


                </div>

            </div>
        
        </div>
    
    </section>
    
    <!-- ***** favorite-stores-section End ***** -->
   
   
    <!-- ***** store-section Start ***** -->
    
    <section class="section-style store-section ">
    
        <div class="container custom-container">
        
            <div class="store-area">
            
                <div class="store-about-wrapper">
                
                    <div class="row ">
                    
                        <div class="col-xl-5 col-lg-5">
                        
                            <div class="store-info">
                            
                                <div class="store-img">
                                
                                    <img class="img-fluid" src="{{asset('img/store.svg')}}" alt="storeName">
                                    
                                
                                </div>
                                <div class="store-details">
                                
                                    <h2 class="store-name ">
                                    
                                        متجر امير على
                                        <span>
                                        
                                            <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M6.4875 16.875L5.0625 14.4375L2.23125 13.8563L2.55 11.1L0.75 9L2.55 6.91875L2.23125 4.1625L5.0625 3.58125L6.4875 1.125L9 2.2875L11.5125 1.125L12.9562 3.58125L15.7687 4.1625L15.45 6.91875L17.25 9L15.45 11.1L15.7687 13.8563L12.9562 14.4375L11.5125 16.875L9 15.7125L6.4875 16.875ZM8.19375 11.4937L12.45 7.275L11.6063 6.50625L8.19375 9.88125L6.4125 8.025L5.55 8.86875L8.19375 11.4937Z" fill="#00DC3E"/></svg>

                                        
                                        </span>
                                    
                                    </h2>
                                    
                                    <p class="store-num">453453453</p>
                                    
                                    <div class="store-flex">
                                    
                                        <div class="store-users">
                                        
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M22 12C22 6.49 17.51 2 12 2C6.49 2 2 6.49 2 12C2 14.9 3.25 17.51 5.23 19.34C5.23 19.35 5.23 19.35 5.22 19.36C5.32 19.46 5.44 19.54 5.54 19.63C5.6 19.68 5.65 19.73 5.71 19.77C5.89 19.92 6.09 20.06 6.28 20.2L6.48 20.34C6.67 20.47 6.87 20.59 7.08 20.7C7.15 20.74 7.23 20.79 7.3 20.83C7.5 20.94 7.71 21.04 7.93 21.13C8.01 21.17 8.09 21.21 8.17 21.24C8.39 21.33 8.61 21.41 8.83 21.48C8.91 21.51 8.99 21.54 9.07 21.56C9.31 21.63 9.55 21.69 9.79 21.75C9.86 21.77 9.93 21.79 10.01 21.8C10.29 21.86 10.57 21.9 10.86 21.93C10.9 21.93 10.94 21.94 10.98 21.95C11.32 21.98 11.66 22 12 22C12.34 22 12.68 21.98 13.01 21.95C13.05 21.95 13.09 21.94 13.13 21.93C13.42 21.9 13.7 21.86 13.98 21.8C14.05 21.79 14.12 21.76 14.2 21.75C14.44 21.69 14.69 21.64 14.92 21.56C15 21.53 15.08 21.5 15.16 21.48C15.38 21.4 15.61 21.33 15.82 21.24C15.9 21.21 15.98 21.17 16.06 21.13C16.27 21.04 16.48 20.94 16.69 20.83C16.77 20.79 16.84 20.74 16.91 20.7C17.11 20.58 17.31 20.47 17.51 20.34C17.58 20.3 17.64 20.25 17.71 20.2C17.91 20.06 18.1 19.92 18.28 19.77C18.34 19.72 18.39 19.67 18.45 19.63C18.56 19.54 18.67 19.45 18.77 19.36C18.77 19.35 18.77 19.35 18.76 19.34C20.75 17.51 22 14.9 22 12ZM16.94 16.97C14.23 15.15 9.79 15.15 7.06 16.97C6.62 17.26 6.26 17.6 5.96 17.97C4.38481 16.3823 3.50064 14.2365 3.5 12C3.5 7.31 7.31 3.5 12 3.5C16.69 3.5 20.5 7.31 20.5 12C20.5 14.32 19.56 16.43 18.04 17.97C17.75 17.6 17.38 17.26 16.94 16.97Z" fill="#0083BE"/><path d="M12 6.92993C9.93 6.92993 8.25 8.60993 8.25 10.6799C8.25 12.7099 9.84 14.3599 11.95 14.4199H12.13C13.1007 14.388 14.021 13.98 14.6965 13.2822C15.372 12.5843 15.7497 11.6512 15.75 10.6799C15.75 8.60993 14.07 6.92993 12 6.92993Z" fill="#0083BE"/></svg>
                                            
                                            <span>238</span>

                                        
                                        </div>
                                        <div class="rate-wrap">
                                            
                                            <div class="store-rate star-rating">

                                                <div class="rateit meduim" 
                                                     data-rateit-mode="font"
                                                     data-rateit-step=".5" 
                                                     data-rateit-value="5" 
                                                     data-rateit-ispreset="true" 
                                                     data-rateit-readonly="true">
                                                </div>
                                                

                                            </div>
                                            <a class="rate-btn" href="#">كم نجمه يتسحق ! </a>

                                        </div>
                                    
                                    
                                    </div>
                                    
                                    <div class="store-actions">
                                    
                                        <div class="actions-btns">
                                        
                                            <button class="action-btn share-btn active_toggle_item ">
                                            
                                                <svg width="21" height="25" viewBox="0 0 21 25" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M16.5 11C18.9844 11 21 8.98438 21 6.5C21 4.01562 18.9844 2 16.5 2C14.0156 2 12 4.01562 12 6.5C12 6.6875 12.0094 6.875 12.0328 7.05781L7.62188 9.26094C6.81563 8.47812 5.71406 8 4.5 8C2.01562 8 0 10.0156 0 12.5C0 14.9844 2.01562 17 4.5 17C5.71406 17 6.81563 16.5219 7.62188 15.7391L12.0328 17.9422C12.0094 18.125 12 18.3078 12 18.5C12 20.9844 14.0156 23 16.5 23C18.9844 23 21 20.9844 21 18.5C21 16.0156 18.9844 14 16.5 14C15.2859 14 14.1844 14.4781 13.3781 15.2609L8.96719 13.0578C8.99063 12.875 9 12.6922 9 12.5C9 12.3078 8.99063 12.125 8.96719 11.9422L13.3781 9.73906C14.1844 10.5219 15.2859 11 16.5 11Z" fill="white"/></svg>

                                            
                                            </button>
                                        
                                            <button class="action-btn btn-wishlist active_toggle_item ">
                                            
                                                <svg xmlns="http://www.w3.org/2000/svg" width="21.5" height="19.321" viewBox="0 0 21.5 19.321"><path id="Path_4867" data-name="Path 4867" d="M772.88,286.31a2.181,2.181,0,0,0,1.24,0c2.9-.99,9.38-5.12,9.38-12.12a5.574,5.574,0,0,0-5.56-5.59,5.515,5.515,0,0,0-4.44,2.24,5.547,5.547,0,0,0-10,3.35C763.5,281.19,769.98,285.32,772.88,286.31Z" transform="translate(-762.75 -267.85)" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"></path></svg>
                                            
                                            </button>
                                            
                                            
                                        </div>
                                        <button class="duplicated-btn action-lg-btn main-btn add-btn">
                                            
                                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12 2C9.37996 2 7.24996 4.13 7.24996 6.75C7.24996 9.32 9.25996 11.4 11.88 11.49C11.96 11.48 12.04 11.48 12.1 11.49H12.17C13.3993 11.449 14.5645 10.9315 15.4192 10.0469C16.274 9.16234 16.7512 7.98004 16.75 6.75C16.75 4.13 14.62 2 12 2ZM17.08 14.149C14.29 12.289 9.73996 12.289 6.92996 14.149C5.65996 14.999 4.95996 16.149 4.95996 17.379C4.95996 18.609 5.65996 19.749 6.91996 20.589C8.31996 21.529 10.16 21.999 12 21.999C13.84 21.999 15.68 21.529 17.08 20.589C18.34 19.739 19.04 18.599 19.04 17.359C19.03 16.129 18.34 14.989 17.08 14.149ZM14 18.129H12.75V19.379C12.75 19.789 12.41 20.129 12 20.129C11.59 20.129 11.25 19.789 11.25 19.379V18.129H9.99996C9.58996 18.129 9.24996 17.789 9.24996 17.379C9.24996 16.969 9.58996 16.629 9.99996 16.629H11.25V15.379C11.25 14.969 11.59 14.629 12 14.629C12.41 14.629 12.75 14.969 12.75 15.379V16.629H14C14.41 16.629 14.75 16.969 14.75 17.379C14.75 17.789 14.41 18.129 14 18.129Z" fill="white"/></svg>
                                                 <span>اضافة</span>
                                                
                                            
                                            </button>
                                        <button class="duplicated-btn action-lg-btn sub-btn remove-btn d-none">
                                            
                                                <svg width="16" height="20" viewBox="0 0 16 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M7.99999 0C5.37999 0 3.24999 2.13 3.24999 4.75C3.24999 7.32 5.25999 9.4 7.87999 9.49C7.95999 9.48 8.03999 9.48 8.09999 9.49H8.16999C9.39935 9.44898 10.5646 8.93148 11.4193 8.04691C12.274 7.16234 12.7512 5.98004 12.75 4.75C12.75 2.13 10.62 0 7.99999 0ZM13.08 12.149C10.29 10.289 5.73999 10.289 2.92999 12.149C1.65999 12.999 0.959991 14.149 0.959991 15.379C0.959991 16.609 1.65999 17.749 2.91999 18.589C4.31999 19.529 6.15999 19.999 7.99999 19.999C9.83999 19.999 11.68 19.529 13.08 18.589C14.34 17.739 15.04 16.599 15.04 15.359C15.03 14.129 14.34 12.989 13.08 12.149ZM9.93999 16.259C10.23 16.549 10.23 17.029 9.93999 17.319C9.78999 17.469 9.59999 17.539 9.40999 17.539C9.21999 17.539 9.02999 17.469 8.87999 17.319L7.99999 16.439L7.11999 17.319C6.96999 17.469 6.77999 17.539 6.58999 17.539C6.39999 17.539 6.20999 17.469 6.05999 17.319C5.92075 17.1777 5.8427 16.9874 5.8427 16.789C5.8427 16.5906 5.92075 16.4003 6.05999 16.259L6.93999 15.379L6.05999 14.499C5.92075 14.3577 5.8427 14.1674 5.8427 13.969C5.8427 13.7706 5.92075 13.5803 6.05999 13.439C6.34999 13.149 6.82999 13.149 7.11999 13.439L7.99999 14.319L8.87999 13.439C9.16999 13.149 9.64999 13.149 9.93999 13.439C10.23 13.729 10.23 14.209 9.93999 14.499L9.05999 15.379L9.93999 16.259Z" fill="#FF4B37"/></svg>
                                                <span>إزالة</span>

                                            
                                            </button>
                                    
                                    </div>
                                
                                </div>
                            
                            </div>
                        
                        </div>
                        <div class="col-xl-7 col-lg-7">
                        
                            <div class="store-more">
                            
                                <div class="store-loaction">
                                
                                    <p class="loaction-text">
                                    
                                        
                                       العنوان هذا النص هو مثال
                                       العنوان هذا النص هو مثال
                                       العنوان هذا النص هو مثال
                                       العنوان هذا النص هو مثال
                                    </p>
                                    <div class="contact-btns">
                                    
                                        <a class="contact-btn" href="#">
                                        
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M10.6022 15.1854L8.44928 17.3383C7.99543 17.7921 7.27393 17.7921 6.80844 17.3499C6.68043 17.2219 6.55242 17.1056 6.42441 16.9775C5.24762 15.7929 4.16225 14.5208 3.17763 13.1722C2.22338 11.8455 1.45532 10.5189 0.896737 9.20389C0.349789 7.87725 0.0704956 6.60879 0.0704956 5.39853C0.0704956 4.6072 0.210142 3.85078 0.489435 3.15254C0.768728 2.44268 1.21094 1.79099 1.82771 1.20913C2.57249 0.475988 3.3871 0.115234 4.24825 0.115234C4.57409 0.115234 4.89994 0.185058 5.19087 0.324704C5.49343 0.464351 5.76109 0.67382 5.97056 0.976388L8.67039 4.78175C8.87986 5.07268 9.03114 5.34034 9.13588 5.59636C9.24061 5.84074 9.2988 6.08512 9.2988 6.30623C9.2988 6.58552 9.21734 6.86481 9.05442 7.13247C8.90313 7.40012 8.68203 7.67942 8.40273 7.95871L7.51831 8.87805C7.3903 9.00606 7.33211 9.15734 7.33211 9.34354C7.33211 9.43664 7.34375 9.5181 7.36702 9.61119C7.40194 9.70429 7.43685 9.77411 7.46012 9.84394C7.66959 10.228 8.03034 10.7284 8.54238 11.3335C9.06605 11.9386 9.62464 12.5554 10.2298 13.1722C10.3461 13.2886 10.4742 13.4049 10.5905 13.5213C11.056 13.9751 11.0677 14.7199 10.6022 15.1854ZM23.31 19.1188C23.3085 19.558 23.2091 19.9913 23.0191 20.3872C22.8212 20.8062 22.5652 21.2019 22.2277 21.5742C21.6575 22.2027 21.0291 22.6565 20.3192 22.9474C20.3076 22.9474 20.296 22.9591 20.2843 22.9591C19.5977 23.2384 18.8529 23.3896 18.05 23.3896C16.863 23.3896 15.5945 23.1104 14.2562 22.5401C12.918 21.9699 11.5797 21.2019 10.253 20.236C9.7992 19.8985 9.34535 19.561 8.91477 19.2003L12.7201 15.3949C13.046 15.6393 13.3369 15.8255 13.5813 15.9535C13.6395 15.9767 13.7093 16.0117 13.7908 16.0466C13.8839 16.0815 13.977 16.0931 14.0817 16.0931C14.2795 16.0931 14.4308 16.0233 14.5588 15.8953L15.4432 15.0225C15.7342 14.7316 16.0135 14.5105 16.2811 14.3708C16.5488 14.2079 16.8164 14.1264 17.1074 14.1264C17.3285 14.1264 17.5612 14.173 17.8172 14.2777C18.0733 14.3824 18.3409 14.5337 18.6318 14.7316L22.4838 17.4663C22.7863 17.6758 22.9958 17.9202 23.1238 18.2111C23.2402 18.502 23.31 18.7929 23.31 19.1188Z" fill="#0083BE"/></svg>

                                        
                                        </a>
                                        
                                        <a class="contact-btn" href="#">
                                        
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0.332094 23.3896L1.90544 17.6083C0.868729 15.8311 0.324059 13.8099 0.327439 11.7524C0.327439 5.32521 5.53742 0.115234 11.9646 0.115234C18.3919 0.115234 23.6018 5.32521 23.6018 11.7524C23.6018 18.1797 18.3919 23.3896 11.9646 23.3896C9.90809 23.393 7.88773 22.8487 6.11113 21.8128L0.332094 23.3896ZM7.76478 6.29226C7.6145 6.30159 7.46765 6.34118 7.33304 6.40863C7.2068 6.48012 7.09156 6.56949 6.9909 6.67396C6.85126 6.80546 6.77212 6.91951 6.68717 7.03006C6.25707 7.58981 6.02572 8.27689 6.02967 8.98278C6.032 9.55301 6.18095 10.1081 6.4137 10.6271C6.88966 11.6768 7.67284 12.7881 8.70739 13.818C8.95643 14.0659 9.19964 14.315 9.46148 14.5465C10.7455 15.677 12.2757 16.4923 13.9302 16.9275L14.5923 17.0287C14.8076 17.0404 15.0229 17.0241 15.2394 17.0136C15.5783 16.9961 15.9092 16.9044 16.2087 16.7448C16.4019 16.6424 16.4927 16.5912 16.6544 16.4888C16.6544 16.4888 16.7045 16.4562 16.7999 16.384C16.957 16.2677 17.0536 16.1851 17.1839 16.0489C17.2805 15.9488 17.3643 15.8313 17.4283 15.6975C17.5191 15.5078 17.6099 15.1458 17.6471 14.8444C17.675 14.614 17.6669 14.4883 17.6634 14.4104C17.6587 14.2859 17.5552 14.1567 17.4423 14.102L16.765 13.7983C16.765 13.7983 15.7526 13.3572 15.1346 13.0756C15.0695 13.0472 14.9996 13.031 14.9286 13.0279C14.849 13.0197 14.7686 13.0287 14.6927 13.0542C14.6168 13.0796 14.5473 13.1211 14.4888 13.1757V13.1733C14.4829 13.1733 14.405 13.2397 13.5636 14.2591C13.5153 14.324 13.4488 14.373 13.3725 14.4C13.2962 14.4269 13.2137 14.4305 13.1353 14.4104C13.0595 14.3901 12.9852 14.3644 12.9131 14.3336C12.7688 14.2731 12.7187 14.2498 12.6198 14.2067L12.614 14.2044C11.9482 13.9137 11.3318 13.5211 10.787 13.0407C10.6403 12.9127 10.5042 12.773 10.3645 12.638C9.90669 12.1996 9.5077 11.7036 9.17753 11.1624L9.10887 11.0519C9.05956 10.9776 9.01969 10.8975 8.99017 10.8133C8.94595 10.6423 9.06116 10.5049 9.06116 10.5049C9.06116 10.5049 9.34395 10.1954 9.47545 10.0278C9.58494 9.88853 9.6871 9.74365 9.7815 9.59374C9.91882 9.37263 9.96188 9.14571 9.88973 8.96998C9.56389 8.174 9.22641 7.38151 8.87962 6.59483C8.81096 6.43889 8.60731 6.32717 8.42228 6.30506C8.35944 6.29808 8.2966 6.2911 8.23376 6.28644C8.07748 6.27868 7.92087 6.28023 7.76478 6.2911V6.29226Z" fill="#44EA62"/></svg>

                                        
                                        </a>
                                    
                                    </div>
                                
                                </div>
                                <div class="store-map">
                                
                                     <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d106456.52297212993!2d36.35293563530624!3d33.50745579455878!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1518e6dc413cc6a7%3A0x6b9f66ebd1e394f2!2z2K_Zhdi02YLYjCDYs9mI2LHZitin!5e0!3m2!1sar!2seg!4v1651797159238!5m2!1sar!2seg" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>

                                
                                </div>
                            
                            </div>
                        
                        </div>
                    
                    </div>
                
                </div>
                
                <div class="categories-wrapper">
                    
                    <div class="slider-container categories-slider-container free-mode-slider">

                        <div class="flex-head">
                    
                            <div class="main-title sub-title gray-clr">

                                <h1 class="title">التصنيفات</h1>

                            </div>
                            <div class="slider-arrows">

                                <div class="slider-arrow prev-btn">

                                      <i class="fas fa-chevron-right "></i>

                            </div>

                                <div class="slider-arrow next-btn" >


                                      <i class="fas fa-chevron-left "></i>
                            </div>


                            </div>

                        </div>
                        <div class="swiper categories-slider scroll-row">

                            <div class="swiper-wrapper target-row">

                                <div class="swiper-slide">

                                    <a href="category.html" class="category-item active">

                                        <div class="item-icon">

                                            <svg xmlns="http://www.w3.org/2000/svg" width="33.34" height="33.34" viewBox="0 0 33.34 33.34"><path id="Path_2435" data-name="Path 2435" d="M2820.07,404.3h-.67l-5.63-5.633a1.188,1.188,0,0,0-.83-.338,1.164,1.164,0,0,0-.82.338,1.177,1.177,0,0,0,0,1.65l3.98,3.983h-16.2l3.98-3.983a1.177,1.177,0,0,0,0-1.65,1.164,1.164,0,0,0-.82-.338,1.188,1.188,0,0,0-.83.338l-5.61,5.633h-.67c-1.5,0-4.62,0-4.62,4.267a4.541,4.541,0,0,0,1.04,3.383,2.67,2.67,0,0,0,1.4.75,6.411,6.411,0,0,0,1.5.134h25.46a6.991,6.991,0,0,0,1.47-.134c1.4-.333,2.47-1.333,2.47-4.133,0-4.267-3.12-4.267-4.6-4.267Zm-.32,10.7h-23.63a1.659,1.659,0,0,0-1.65,1.933l1.4,8.567c.46,2.867,1.71,6.167,7.26,6.167h9.35c5.62,0,6.62-2.817,7.22-5.967l1.68-8.717a1.63,1.63,0,0,0-.02-.728,1.609,1.609,0,0,0-.9-1.1,1.652,1.652,0,0,0-.71-.158Zm-14.07,10.75a1.19,1.19,0,0,1-.31.86,1.172,1.172,0,0,1-1.69,0,1.19,1.19,0,0,1-.31-.86v-5.5a1.165,1.165,0,0,1,1.16-1.167,1.157,1.157,0,0,1,1.15,1.167v5.5Zm7.14,0a1.163,1.163,0,0,1-1.17,1.167,1.175,1.175,0,0,1-1.17-1.167v-5.5a1.187,1.187,0,0,1,1.17-1.167,1.173,1.173,0,0,1,1.17,1.167Z" transform="translate(-2791.33 -398.327)" /></svg>


                                        </div>
                                        <span class="item-text">الكل</span>

                                    </a>

                                </div>
                                <div class="swiper-slide">

                                    <a href="category.html" class="category-item">

                                        <div class="item-icon">

                                            <svg xmlns="http://www.w3.org/2000/svg" width="33.34" height="33.34" viewBox="0 0 33.34 33.34"><path id="Path_2435" data-name="Path 2435" d="M2820.07,404.3h-.67l-5.63-5.633a1.188,1.188,0,0,0-.83-.338,1.164,1.164,0,0,0-.82.338,1.177,1.177,0,0,0,0,1.65l3.98,3.983h-16.2l3.98-3.983a1.177,1.177,0,0,0,0-1.65,1.164,1.164,0,0,0-.82-.338,1.188,1.188,0,0,0-.83.338l-5.61,5.633h-.67c-1.5,0-4.62,0-4.62,4.267a4.541,4.541,0,0,0,1.04,3.383,2.67,2.67,0,0,0,1.4.75,6.411,6.411,0,0,0,1.5.134h25.46a6.991,6.991,0,0,0,1.47-.134c1.4-.333,2.47-1.333,2.47-4.133,0-4.267-3.12-4.267-4.6-4.267Zm-.32,10.7h-23.63a1.659,1.659,0,0,0-1.65,1.933l1.4,8.567c.46,2.867,1.71,6.167,7.26,6.167h9.35c5.62,0,6.62-2.817,7.22-5.967l1.68-8.717a1.63,1.63,0,0,0-.02-.728,1.609,1.609,0,0,0-.9-1.1,1.652,1.652,0,0,0-.71-.158Zm-14.07,10.75a1.19,1.19,0,0,1-.31.86,1.172,1.172,0,0,1-1.69,0,1.19,1.19,0,0,1-.31-.86v-5.5a1.165,1.165,0,0,1,1.16-1.167,1.157,1.157,0,0,1,1.15,1.167v5.5Zm7.14,0a1.163,1.163,0,0,1-1.17,1.167,1.175,1.175,0,0,1-1.17-1.167v-5.5a1.187,1.187,0,0,1,1.17-1.167,1.173,1.173,0,0,1,1.17,1.167Z" transform="translate(-2791.33 -398.327)" /></svg>


                                        </div>
                                        <span class="item-text">ملابس</span>

                                    </a>

                                </div>
                                <div class="swiper-slide">

                                    <a href="category.html" class="category-item">

                                        <div class="item-icon">

                                            <svg xmlns="http://www.w3.org/2000/svg" width="33.34" height="33.34" viewBox="0 0 33.34 33.34"><path id="Path_2435" data-name="Path 2435" d="M2820.07,404.3h-.67l-5.63-5.633a1.188,1.188,0,0,0-.83-.338,1.164,1.164,0,0,0-.82.338,1.177,1.177,0,0,0,0,1.65l3.98,3.983h-16.2l3.98-3.983a1.177,1.177,0,0,0,0-1.65,1.164,1.164,0,0,0-.82-.338,1.188,1.188,0,0,0-.83.338l-5.61,5.633h-.67c-1.5,0-4.62,0-4.62,4.267a4.541,4.541,0,0,0,1.04,3.383,2.67,2.67,0,0,0,1.4.75,6.411,6.411,0,0,0,1.5.134h25.46a6.991,6.991,0,0,0,1.47-.134c1.4-.333,2.47-1.333,2.47-4.133,0-4.267-3.12-4.267-4.6-4.267Zm-.32,10.7h-23.63a1.659,1.659,0,0,0-1.65,1.933l1.4,8.567c.46,2.867,1.71,6.167,7.26,6.167h9.35c5.62,0,6.62-2.817,7.22-5.967l1.68-8.717a1.63,1.63,0,0,0-.02-.728,1.609,1.609,0,0,0-.9-1.1,1.652,1.652,0,0,0-.71-.158Zm-14.07,10.75a1.19,1.19,0,0,1-.31.86,1.172,1.172,0,0,1-1.69,0,1.19,1.19,0,0,1-.31-.86v-5.5a1.165,1.165,0,0,1,1.16-1.167,1.157,1.157,0,0,1,1.15,1.167v5.5Zm7.14,0a1.163,1.163,0,0,1-1.17,1.167,1.175,1.175,0,0,1-1.17-1.167v-5.5a1.187,1.187,0,0,1,1.17-1.167,1.173,1.173,0,0,1,1.17,1.167Z" transform="translate(-2791.33 -398.327)" /></svg>


                                        </div>
                                        <span class="item-text">هواتف</span>

                                    </a>

                                </div>
                                <div class="swiper-slide">

                                    <a href="category.html" class="category-item">

                                        <div class="item-icon">

                                            <svg xmlns="http://www.w3.org/2000/svg" width="33.34" height="33.34" viewBox="0 0 33.34 33.34"><path id="Path_2435" data-name="Path 2435" d="M2820.07,404.3h-.67l-5.63-5.633a1.188,1.188,0,0,0-.83-.338,1.164,1.164,0,0,0-.82.338,1.177,1.177,0,0,0,0,1.65l3.98,3.983h-16.2l3.98-3.983a1.177,1.177,0,0,0,0-1.65,1.164,1.164,0,0,0-.82-.338,1.188,1.188,0,0,0-.83.338l-5.61,5.633h-.67c-1.5,0-4.62,0-4.62,4.267a4.541,4.541,0,0,0,1.04,3.383,2.67,2.67,0,0,0,1.4.75,6.411,6.411,0,0,0,1.5.134h25.46a6.991,6.991,0,0,0,1.47-.134c1.4-.333,2.47-1.333,2.47-4.133,0-4.267-3.12-4.267-4.6-4.267Zm-.32,10.7h-23.63a1.659,1.659,0,0,0-1.65,1.933l1.4,8.567c.46,2.867,1.71,6.167,7.26,6.167h9.35c5.62,0,6.62-2.817,7.22-5.967l1.68-8.717a1.63,1.63,0,0,0-.02-.728,1.609,1.609,0,0,0-.9-1.1,1.652,1.652,0,0,0-.71-.158Zm-14.07,10.75a1.19,1.19,0,0,1-.31.86,1.172,1.172,0,0,1-1.69,0,1.19,1.19,0,0,1-.31-.86v-5.5a1.165,1.165,0,0,1,1.16-1.167,1.157,1.157,0,0,1,1.15,1.167v5.5Zm7.14,0a1.163,1.163,0,0,1-1.17,1.167,1.175,1.175,0,0,1-1.17-1.167v-5.5a1.187,1.187,0,0,1,1.17-1.167,1.173,1.173,0,0,1,1.17,1.167Z" transform="translate(-2791.33 -398.327)" /></svg>


                                        </div>
                                        <span class="item-text">ساعات</span>

                                    </a>

                                </div>
                                <div class="swiper-slide">

                                    <a href="category.html" class="category-item">

                                        <div class="item-icon">

                                            <svg xmlns="http://www.w3.org/2000/svg" width="33.34" height="33.34" viewBox="0 0 33.34 33.34"><path id="Path_2435" data-name="Path 2435" d="M2820.07,404.3h-.67l-5.63-5.633a1.188,1.188,0,0,0-.83-.338,1.164,1.164,0,0,0-.82.338,1.177,1.177,0,0,0,0,1.65l3.98,3.983h-16.2l3.98-3.983a1.177,1.177,0,0,0,0-1.65,1.164,1.164,0,0,0-.82-.338,1.188,1.188,0,0,0-.83.338l-5.61,5.633h-.67c-1.5,0-4.62,0-4.62,4.267a4.541,4.541,0,0,0,1.04,3.383,2.67,2.67,0,0,0,1.4.75,6.411,6.411,0,0,0,1.5.134h25.46a6.991,6.991,0,0,0,1.47-.134c1.4-.333,2.47-1.333,2.47-4.133,0-4.267-3.12-4.267-4.6-4.267Zm-.32,10.7h-23.63a1.659,1.659,0,0,0-1.65,1.933l1.4,8.567c.46,2.867,1.71,6.167,7.26,6.167h9.35c5.62,0,6.62-2.817,7.22-5.967l1.68-8.717a1.63,1.63,0,0,0-.02-.728,1.609,1.609,0,0,0-.9-1.1,1.652,1.652,0,0,0-.71-.158Zm-14.07,10.75a1.19,1.19,0,0,1-.31.86,1.172,1.172,0,0,1-1.69,0,1.19,1.19,0,0,1-.31-.86v-5.5a1.165,1.165,0,0,1,1.16-1.167,1.157,1.157,0,0,1,1.15,1.167v5.5Zm7.14,0a1.163,1.163,0,0,1-1.17,1.167,1.175,1.175,0,0,1-1.17-1.167v-5.5a1.187,1.187,0,0,1,1.17-1.167,1.173,1.173,0,0,1,1.17,1.167Z" transform="translate(-2791.33 -398.327)" /></svg>


                                        </div>
                                        <span class="item-text">سماعات</span>

                                    </a>

                                </div>
                                
                                
                                <div class="swiper-slide">

                                    <a href="category.html" class="category-item">

                                        <div class="item-icon">

                                            <svg xmlns="http://www.w3.org/2000/svg" width="33.34" height="33.34" viewBox="0 0 33.34 33.34"><path id="Path_2435" data-name="Path 2435" d="M2820.07,404.3h-.67l-5.63-5.633a1.188,1.188,0,0,0-.83-.338,1.164,1.164,0,0,0-.82.338,1.177,1.177,0,0,0,0,1.65l3.98,3.983h-16.2l3.98-3.983a1.177,1.177,0,0,0,0-1.65,1.164,1.164,0,0,0-.82-.338,1.188,1.188,0,0,0-.83.338l-5.61,5.633h-.67c-1.5,0-4.62,0-4.62,4.267a4.541,4.541,0,0,0,1.04,3.383,2.67,2.67,0,0,0,1.4.75,6.411,6.411,0,0,0,1.5.134h25.46a6.991,6.991,0,0,0,1.47-.134c1.4-.333,2.47-1.333,2.47-4.133,0-4.267-3.12-4.267-4.6-4.267Zm-.32,10.7h-23.63a1.659,1.659,0,0,0-1.65,1.933l1.4,8.567c.46,2.867,1.71,6.167,7.26,6.167h9.35c5.62,0,6.62-2.817,7.22-5.967l1.68-8.717a1.63,1.63,0,0,0-.02-.728,1.609,1.609,0,0,0-.9-1.1,1.652,1.652,0,0,0-.71-.158Zm-14.07,10.75a1.19,1.19,0,0,1-.31.86,1.172,1.172,0,0,1-1.69,0,1.19,1.19,0,0,1-.31-.86v-5.5a1.165,1.165,0,0,1,1.16-1.167,1.157,1.157,0,0,1,1.15,1.167v5.5Zm7.14,0a1.163,1.163,0,0,1-1.17,1.167,1.175,1.175,0,0,1-1.17-1.167v-5.5a1.187,1.187,0,0,1,1.17-1.167,1.173,1.173,0,0,1,1.17,1.167Z" transform="translate(-2791.33 -398.327)" /></svg>


                                        </div>
                                        <span class="item-text">الكل</span>

                                    </a>

                                </div>
                                <div class="swiper-slide">

                                    <a href="category.html" class="category-item">

                                        <div class="item-icon">

                                            <svg xmlns="http://www.w3.org/2000/svg" width="33.34" height="33.34" viewBox="0 0 33.34 33.34"><path id="Path_2435" data-name="Path 2435" d="M2820.07,404.3h-.67l-5.63-5.633a1.188,1.188,0,0,0-.83-.338,1.164,1.164,0,0,0-.82.338,1.177,1.177,0,0,0,0,1.65l3.98,3.983h-16.2l3.98-3.983a1.177,1.177,0,0,0,0-1.65,1.164,1.164,0,0,0-.82-.338,1.188,1.188,0,0,0-.83.338l-5.61,5.633h-.67c-1.5,0-4.62,0-4.62,4.267a4.541,4.541,0,0,0,1.04,3.383,2.67,2.67,0,0,0,1.4.75,6.411,6.411,0,0,0,1.5.134h25.46a6.991,6.991,0,0,0,1.47-.134c1.4-.333,2.47-1.333,2.47-4.133,0-4.267-3.12-4.267-4.6-4.267Zm-.32,10.7h-23.63a1.659,1.659,0,0,0-1.65,1.933l1.4,8.567c.46,2.867,1.71,6.167,7.26,6.167h9.35c5.62,0,6.62-2.817,7.22-5.967l1.68-8.717a1.63,1.63,0,0,0-.02-.728,1.609,1.609,0,0,0-.9-1.1,1.652,1.652,0,0,0-.71-.158Zm-14.07,10.75a1.19,1.19,0,0,1-.31.86,1.172,1.172,0,0,1-1.69,0,1.19,1.19,0,0,1-.31-.86v-5.5a1.165,1.165,0,0,1,1.16-1.167,1.157,1.157,0,0,1,1.15,1.167v5.5Zm7.14,0a1.163,1.163,0,0,1-1.17,1.167,1.175,1.175,0,0,1-1.17-1.167v-5.5a1.187,1.187,0,0,1,1.17-1.167,1.173,1.173,0,0,1,1.17,1.167Z" transform="translate(-2791.33 -398.327)" /></svg>


                                        </div>
                                        <span class="item-text">ملابس</span>

                                    </a>

                                </div>
                                <div class="swiper-slide">

                                    <a href="category.html" class="category-item">

                                        <div class="item-icon">

                                            <svg xmlns="http://www.w3.org/2000/svg" width="33.34" height="33.34" viewBox="0 0 33.34 33.34"><path id="Path_2435" data-name="Path 2435" d="M2820.07,404.3h-.67l-5.63-5.633a1.188,1.188,0,0,0-.83-.338,1.164,1.164,0,0,0-.82.338,1.177,1.177,0,0,0,0,1.65l3.98,3.983h-16.2l3.98-3.983a1.177,1.177,0,0,0,0-1.65,1.164,1.164,0,0,0-.82-.338,1.188,1.188,0,0,0-.83.338l-5.61,5.633h-.67c-1.5,0-4.62,0-4.62,4.267a4.541,4.541,0,0,0,1.04,3.383,2.67,2.67,0,0,0,1.4.75,6.411,6.411,0,0,0,1.5.134h25.46a6.991,6.991,0,0,0,1.47-.134c1.4-.333,2.47-1.333,2.47-4.133,0-4.267-3.12-4.267-4.6-4.267Zm-.32,10.7h-23.63a1.659,1.659,0,0,0-1.65,1.933l1.4,8.567c.46,2.867,1.71,6.167,7.26,6.167h9.35c5.62,0,6.62-2.817,7.22-5.967l1.68-8.717a1.63,1.63,0,0,0-.02-.728,1.609,1.609,0,0,0-.9-1.1,1.652,1.652,0,0,0-.71-.158Zm-14.07,10.75a1.19,1.19,0,0,1-.31.86,1.172,1.172,0,0,1-1.69,0,1.19,1.19,0,0,1-.31-.86v-5.5a1.165,1.165,0,0,1,1.16-1.167,1.157,1.157,0,0,1,1.15,1.167v5.5Zm7.14,0a1.163,1.163,0,0,1-1.17,1.167,1.175,1.175,0,0,1-1.17-1.167v-5.5a1.187,1.187,0,0,1,1.17-1.167,1.173,1.173,0,0,1,1.17,1.167Z" transform="translate(-2791.33 -398.327)" /></svg>


                                        </div>
                                        <span class="item-text">هواتف</span>

                                    </a>

                                </div>
                                <div class="swiper-slide">

                                    <a href="category.html" class="category-item">

                                        <div class="item-icon">

                                            <svg xmlns="http://www.w3.org/2000/svg" width="33.34" height="33.34" viewBox="0 0 33.34 33.34"><path id="Path_2435" data-name="Path 2435" d="M2820.07,404.3h-.67l-5.63-5.633a1.188,1.188,0,0,0-.83-.338,1.164,1.164,0,0,0-.82.338,1.177,1.177,0,0,0,0,1.65l3.98,3.983h-16.2l3.98-3.983a1.177,1.177,0,0,0,0-1.65,1.164,1.164,0,0,0-.82-.338,1.188,1.188,0,0,0-.83.338l-5.61,5.633h-.67c-1.5,0-4.62,0-4.62,4.267a4.541,4.541,0,0,0,1.04,3.383,2.67,2.67,0,0,0,1.4.75,6.411,6.411,0,0,0,1.5.134h25.46a6.991,6.991,0,0,0,1.47-.134c1.4-.333,2.47-1.333,2.47-4.133,0-4.267-3.12-4.267-4.6-4.267Zm-.32,10.7h-23.63a1.659,1.659,0,0,0-1.65,1.933l1.4,8.567c.46,2.867,1.71,6.167,7.26,6.167h9.35c5.62,0,6.62-2.817,7.22-5.967l1.68-8.717a1.63,1.63,0,0,0-.02-.728,1.609,1.609,0,0,0-.9-1.1,1.652,1.652,0,0,0-.71-.158Zm-14.07,10.75a1.19,1.19,0,0,1-.31.86,1.172,1.172,0,0,1-1.69,0,1.19,1.19,0,0,1-.31-.86v-5.5a1.165,1.165,0,0,1,1.16-1.167,1.157,1.157,0,0,1,1.15,1.167v5.5Zm7.14,0a1.163,1.163,0,0,1-1.17,1.167,1.175,1.175,0,0,1-1.17-1.167v-5.5a1.187,1.187,0,0,1,1.17-1.167,1.173,1.173,0,0,1,1.17,1.167Z" transform="translate(-2791.33 -398.327)" /></svg>


                                        </div>
                                        <span class="item-text">ساعات</span>

                                    </a>

                                </div>
                                <div class="swiper-slide">

                                    <a href="category.html" class="category-item">

                                        <div class="item-icon">

                                            <svg xmlns="http://www.w3.org/2000/svg" width="33.34" height="33.34" viewBox="0 0 33.34 33.34"><path id="Path_2435" data-name="Path 2435" d="M2820.07,404.3h-.67l-5.63-5.633a1.188,1.188,0,0,0-.83-.338,1.164,1.164,0,0,0-.82.338,1.177,1.177,0,0,0,0,1.65l3.98,3.983h-16.2l3.98-3.983a1.177,1.177,0,0,0,0-1.65,1.164,1.164,0,0,0-.82-.338,1.188,1.188,0,0,0-.83.338l-5.61,5.633h-.67c-1.5,0-4.62,0-4.62,4.267a4.541,4.541,0,0,0,1.04,3.383,2.67,2.67,0,0,0,1.4.75,6.411,6.411,0,0,0,1.5.134h25.46a6.991,6.991,0,0,0,1.47-.134c1.4-.333,2.47-1.333,2.47-4.133,0-4.267-3.12-4.267-4.6-4.267Zm-.32,10.7h-23.63a1.659,1.659,0,0,0-1.65,1.933l1.4,8.567c.46,2.867,1.71,6.167,7.26,6.167h9.35c5.62,0,6.62-2.817,7.22-5.967l1.68-8.717a1.63,1.63,0,0,0-.02-.728,1.609,1.609,0,0,0-.9-1.1,1.652,1.652,0,0,0-.71-.158Zm-14.07,10.75a1.19,1.19,0,0,1-.31.86,1.172,1.172,0,0,1-1.69,0,1.19,1.19,0,0,1-.31-.86v-5.5a1.165,1.165,0,0,1,1.16-1.167,1.157,1.157,0,0,1,1.15,1.167v5.5Zm7.14,0a1.163,1.163,0,0,1-1.17,1.167,1.175,1.175,0,0,1-1.17-1.167v-5.5a1.187,1.187,0,0,1,1.17-1.167,1.173,1.173,0,0,1,1.17,1.167Z" transform="translate(-2791.33 -398.327)" /></svg>


                                        </div>
                                        <span class="item-text">سماعات</span>

                                    </a>

                                </div>
                                
                                
                                <div class="swiper-slide">

                                    <a href="category.html" class="category-item">

                                        <div class="item-icon">

                                            <svg xmlns="http://www.w3.org/2000/svg" width="33.34" height="33.34" viewBox="0 0 33.34 33.34"><path id="Path_2435" data-name="Path 2435" d="M2820.07,404.3h-.67l-5.63-5.633a1.188,1.188,0,0,0-.83-.338,1.164,1.164,0,0,0-.82.338,1.177,1.177,0,0,0,0,1.65l3.98,3.983h-16.2l3.98-3.983a1.177,1.177,0,0,0,0-1.65,1.164,1.164,0,0,0-.82-.338,1.188,1.188,0,0,0-.83.338l-5.61,5.633h-.67c-1.5,0-4.62,0-4.62,4.267a4.541,4.541,0,0,0,1.04,3.383,2.67,2.67,0,0,0,1.4.75,6.411,6.411,0,0,0,1.5.134h25.46a6.991,6.991,0,0,0,1.47-.134c1.4-.333,2.47-1.333,2.47-4.133,0-4.267-3.12-4.267-4.6-4.267Zm-.32,10.7h-23.63a1.659,1.659,0,0,0-1.65,1.933l1.4,8.567c.46,2.867,1.71,6.167,7.26,6.167h9.35c5.62,0,6.62-2.817,7.22-5.967l1.68-8.717a1.63,1.63,0,0,0-.02-.728,1.609,1.609,0,0,0-.9-1.1,1.652,1.652,0,0,0-.71-.158Zm-14.07,10.75a1.19,1.19,0,0,1-.31.86,1.172,1.172,0,0,1-1.69,0,1.19,1.19,0,0,1-.31-.86v-5.5a1.165,1.165,0,0,1,1.16-1.167,1.157,1.157,0,0,1,1.15,1.167v5.5Zm7.14,0a1.163,1.163,0,0,1-1.17,1.167,1.175,1.175,0,0,1-1.17-1.167v-5.5a1.187,1.187,0,0,1,1.17-1.167,1.173,1.173,0,0,1,1.17,1.167Z" transform="translate(-2791.33 -398.327)" /></svg>


                                        </div>
                                        <span class="item-text">الكل</span>

                                    </a>

                                </div>
                                <div class="swiper-slide">

                                    <a href="category.html" class="category-item">

                                        <div class="item-icon">

                                            <svg xmlns="http://www.w3.org/2000/svg" width="33.34" height="33.34" viewBox="0 0 33.34 33.34"><path id="Path_2435" data-name="Path 2435" d="M2820.07,404.3h-.67l-5.63-5.633a1.188,1.188,0,0,0-.83-.338,1.164,1.164,0,0,0-.82.338,1.177,1.177,0,0,0,0,1.65l3.98,3.983h-16.2l3.98-3.983a1.177,1.177,0,0,0,0-1.65,1.164,1.164,0,0,0-.82-.338,1.188,1.188,0,0,0-.83.338l-5.61,5.633h-.67c-1.5,0-4.62,0-4.62,4.267a4.541,4.541,0,0,0,1.04,3.383,2.67,2.67,0,0,0,1.4.75,6.411,6.411,0,0,0,1.5.134h25.46a6.991,6.991,0,0,0,1.47-.134c1.4-.333,2.47-1.333,2.47-4.133,0-4.267-3.12-4.267-4.6-4.267Zm-.32,10.7h-23.63a1.659,1.659,0,0,0-1.65,1.933l1.4,8.567c.46,2.867,1.71,6.167,7.26,6.167h9.35c5.62,0,6.62-2.817,7.22-5.967l1.68-8.717a1.63,1.63,0,0,0-.02-.728,1.609,1.609,0,0,0-.9-1.1,1.652,1.652,0,0,0-.71-.158Zm-14.07,10.75a1.19,1.19,0,0,1-.31.86,1.172,1.172,0,0,1-1.69,0,1.19,1.19,0,0,1-.31-.86v-5.5a1.165,1.165,0,0,1,1.16-1.167,1.157,1.157,0,0,1,1.15,1.167v5.5Zm7.14,0a1.163,1.163,0,0,1-1.17,1.167,1.175,1.175,0,0,1-1.17-1.167v-5.5a1.187,1.187,0,0,1,1.17-1.167,1.173,1.173,0,0,1,1.17,1.167Z" transform="translate(-2791.33 -398.327)" /></svg>


                                        </div>
                                        <span class="item-text">ملابس</span>

                                    </a>

                                </div>
                                <div class="swiper-slide">

                                    <a href="category.html" class="category-item">

                                        <div class="item-icon">

                                            <svg xmlns="http://www.w3.org/2000/svg" width="33.34" height="33.34" viewBox="0 0 33.34 33.34"><path id="Path_2435" data-name="Path 2435" d="M2820.07,404.3h-.67l-5.63-5.633a1.188,1.188,0,0,0-.83-.338,1.164,1.164,0,0,0-.82.338,1.177,1.177,0,0,0,0,1.65l3.98,3.983h-16.2l3.98-3.983a1.177,1.177,0,0,0,0-1.65,1.164,1.164,0,0,0-.82-.338,1.188,1.188,0,0,0-.83.338l-5.61,5.633h-.67c-1.5,0-4.62,0-4.62,4.267a4.541,4.541,0,0,0,1.04,3.383,2.67,2.67,0,0,0,1.4.75,6.411,6.411,0,0,0,1.5.134h25.46a6.991,6.991,0,0,0,1.47-.134c1.4-.333,2.47-1.333,2.47-4.133,0-4.267-3.12-4.267-4.6-4.267Zm-.32,10.7h-23.63a1.659,1.659,0,0,0-1.65,1.933l1.4,8.567c.46,2.867,1.71,6.167,7.26,6.167h9.35c5.62,0,6.62-2.817,7.22-5.967l1.68-8.717a1.63,1.63,0,0,0-.02-.728,1.609,1.609,0,0,0-.9-1.1,1.652,1.652,0,0,0-.71-.158Zm-14.07,10.75a1.19,1.19,0,0,1-.31.86,1.172,1.172,0,0,1-1.69,0,1.19,1.19,0,0,1-.31-.86v-5.5a1.165,1.165,0,0,1,1.16-1.167,1.157,1.157,0,0,1,1.15,1.167v5.5Zm7.14,0a1.163,1.163,0,0,1-1.17,1.167,1.175,1.175,0,0,1-1.17-1.167v-5.5a1.187,1.187,0,0,1,1.17-1.167,1.173,1.173,0,0,1,1.17,1.167Z" transform="translate(-2791.33 -398.327)" /></svg>


                                        </div>
                                        <span class="item-text">هواتف</span>

                                    </a>

                                </div>
                                <div class="swiper-slide">

                                    <a href="category.html" class="category-item">

                                        <div class="item-icon">

                                            <svg xmlns="http://www.w3.org/2000/svg" width="33.34" height="33.34" viewBox="0 0 33.34 33.34"><path id="Path_2435" data-name="Path 2435" d="M2820.07,404.3h-.67l-5.63-5.633a1.188,1.188,0,0,0-.83-.338,1.164,1.164,0,0,0-.82.338,1.177,1.177,0,0,0,0,1.65l3.98,3.983h-16.2l3.98-3.983a1.177,1.177,0,0,0,0-1.65,1.164,1.164,0,0,0-.82-.338,1.188,1.188,0,0,0-.83.338l-5.61,5.633h-.67c-1.5,0-4.62,0-4.62,4.267a4.541,4.541,0,0,0,1.04,3.383,2.67,2.67,0,0,0,1.4.75,6.411,6.411,0,0,0,1.5.134h25.46a6.991,6.991,0,0,0,1.47-.134c1.4-.333,2.47-1.333,2.47-4.133,0-4.267-3.12-4.267-4.6-4.267Zm-.32,10.7h-23.63a1.659,1.659,0,0,0-1.65,1.933l1.4,8.567c.46,2.867,1.71,6.167,7.26,6.167h9.35c5.62,0,6.62-2.817,7.22-5.967l1.68-8.717a1.63,1.63,0,0,0-.02-.728,1.609,1.609,0,0,0-.9-1.1,1.652,1.652,0,0,0-.71-.158Zm-14.07,10.75a1.19,1.19,0,0,1-.31.86,1.172,1.172,0,0,1-1.69,0,1.19,1.19,0,0,1-.31-.86v-5.5a1.165,1.165,0,0,1,1.16-1.167,1.157,1.157,0,0,1,1.15,1.167v5.5Zm7.14,0a1.163,1.163,0,0,1-1.17,1.167,1.175,1.175,0,0,1-1.17-1.167v-5.5a1.187,1.187,0,0,1,1.17-1.167,1.173,1.173,0,0,1,1.17,1.167Z" transform="translate(-2791.33 -398.327)" /></svg>


                                        </div>
                                        <span class="item-text">ساعات</span>

                                    </a>

                                </div>
                                <div class="swiper-slide">

                                    <a href="category.html" class="category-item">

                                        <div class="item-icon">

                                            <svg xmlns="http://www.w3.org/2000/svg" width="33.34" height="33.34" viewBox="0 0 33.34 33.34"><path id="Path_2435" data-name="Path 2435" d="M2820.07,404.3h-.67l-5.63-5.633a1.188,1.188,0,0,0-.83-.338,1.164,1.164,0,0,0-.82.338,1.177,1.177,0,0,0,0,1.65l3.98,3.983h-16.2l3.98-3.983a1.177,1.177,0,0,0,0-1.65,1.164,1.164,0,0,0-.82-.338,1.188,1.188,0,0,0-.83.338l-5.61,5.633h-.67c-1.5,0-4.62,0-4.62,4.267a4.541,4.541,0,0,0,1.04,3.383,2.67,2.67,0,0,0,1.4.75,6.411,6.411,0,0,0,1.5.134h25.46a6.991,6.991,0,0,0,1.47-.134c1.4-.333,2.47-1.333,2.47-4.133,0-4.267-3.12-4.267-4.6-4.267Zm-.32,10.7h-23.63a1.659,1.659,0,0,0-1.65,1.933l1.4,8.567c.46,2.867,1.71,6.167,7.26,6.167h9.35c5.62,0,6.62-2.817,7.22-5.967l1.68-8.717a1.63,1.63,0,0,0-.02-.728,1.609,1.609,0,0,0-.9-1.1,1.652,1.652,0,0,0-.71-.158Zm-14.07,10.75a1.19,1.19,0,0,1-.31.86,1.172,1.172,0,0,1-1.69,0,1.19,1.19,0,0,1-.31-.86v-5.5a1.165,1.165,0,0,1,1.16-1.167,1.157,1.157,0,0,1,1.15,1.167v5.5Zm7.14,0a1.163,1.163,0,0,1-1.17,1.167,1.175,1.175,0,0,1-1.17-1.167v-5.5a1.187,1.187,0,0,1,1.17-1.167,1.173,1.173,0,0,1,1.17,1.167Z" transform="translate(-2791.33 -398.327)" /></svg>


                                        </div>
                                        <span class="item-text">سماعات</span>

                                    </a>

                                </div>
                                
                                
                                
                                <div class="swiper-slide">

                                    <a href="category.html" class="category-item">

                                        <div class="item-icon">

                                            <svg xmlns="http://www.w3.org/2000/svg" width="33.34" height="33.34" viewBox="0 0 33.34 33.34"><path id="Path_2435" data-name="Path 2435" d="M2820.07,404.3h-.67l-5.63-5.633a1.188,1.188,0,0,0-.83-.338,1.164,1.164,0,0,0-.82.338,1.177,1.177,0,0,0,0,1.65l3.98,3.983h-16.2l3.98-3.983a1.177,1.177,0,0,0,0-1.65,1.164,1.164,0,0,0-.82-.338,1.188,1.188,0,0,0-.83.338l-5.61,5.633h-.67c-1.5,0-4.62,0-4.62,4.267a4.541,4.541,0,0,0,1.04,3.383,2.67,2.67,0,0,0,1.4.75,6.411,6.411,0,0,0,1.5.134h25.46a6.991,6.991,0,0,0,1.47-.134c1.4-.333,2.47-1.333,2.47-4.133,0-4.267-3.12-4.267-4.6-4.267Zm-.32,10.7h-23.63a1.659,1.659,0,0,0-1.65,1.933l1.4,8.567c.46,2.867,1.71,6.167,7.26,6.167h9.35c5.62,0,6.62-2.817,7.22-5.967l1.68-8.717a1.63,1.63,0,0,0-.02-.728,1.609,1.609,0,0,0-.9-1.1,1.652,1.652,0,0,0-.71-.158Zm-14.07,10.75a1.19,1.19,0,0,1-.31.86,1.172,1.172,0,0,1-1.69,0,1.19,1.19,0,0,1-.31-.86v-5.5a1.165,1.165,0,0,1,1.16-1.167,1.157,1.157,0,0,1,1.15,1.167v5.5Zm7.14,0a1.163,1.163,0,0,1-1.17,1.167,1.175,1.175,0,0,1-1.17-1.167v-5.5a1.187,1.187,0,0,1,1.17-1.167,1.173,1.173,0,0,1,1.17,1.167Z" transform="translate(-2791.33 -398.327)" /></svg>


                                        </div>
                                        <span class="item-text">الكل</span>

                                    </a>

                                </div>
                                <div class="swiper-slide">

                                    <a href="category.html" class="category-item">

                                        <div class="item-icon">

                                            <svg xmlns="http://www.w3.org/2000/svg" width="33.34" height="33.34" viewBox="0 0 33.34 33.34"><path id="Path_2435" data-name="Path 2435" d="M2820.07,404.3h-.67l-5.63-5.633a1.188,1.188,0,0,0-.83-.338,1.164,1.164,0,0,0-.82.338,1.177,1.177,0,0,0,0,1.65l3.98,3.983h-16.2l3.98-3.983a1.177,1.177,0,0,0,0-1.65,1.164,1.164,0,0,0-.82-.338,1.188,1.188,0,0,0-.83.338l-5.61,5.633h-.67c-1.5,0-4.62,0-4.62,4.267a4.541,4.541,0,0,0,1.04,3.383,2.67,2.67,0,0,0,1.4.75,6.411,6.411,0,0,0,1.5.134h25.46a6.991,6.991,0,0,0,1.47-.134c1.4-.333,2.47-1.333,2.47-4.133,0-4.267-3.12-4.267-4.6-4.267Zm-.32,10.7h-23.63a1.659,1.659,0,0,0-1.65,1.933l1.4,8.567c.46,2.867,1.71,6.167,7.26,6.167h9.35c5.62,0,6.62-2.817,7.22-5.967l1.68-8.717a1.63,1.63,0,0,0-.02-.728,1.609,1.609,0,0,0-.9-1.1,1.652,1.652,0,0,0-.71-.158Zm-14.07,10.75a1.19,1.19,0,0,1-.31.86,1.172,1.172,0,0,1-1.69,0,1.19,1.19,0,0,1-.31-.86v-5.5a1.165,1.165,0,0,1,1.16-1.167,1.157,1.157,0,0,1,1.15,1.167v5.5Zm7.14,0a1.163,1.163,0,0,1-1.17,1.167,1.175,1.175,0,0,1-1.17-1.167v-5.5a1.187,1.187,0,0,1,1.17-1.167,1.173,1.173,0,0,1,1.17,1.167Z" transform="translate(-2791.33 -398.327)" /></svg>


                                        </div>
                                        <span class="item-text">ملابس</span>

                                    </a>

                                </div>
                                <div class="swiper-slide">

                                    <a href="category.html" class="category-item">

                                        <div class="item-icon">

                                            <svg xmlns="http://www.w3.org/2000/svg" width="33.34" height="33.34" viewBox="0 0 33.34 33.34"><path id="Path_2435" data-name="Path 2435" d="M2820.07,404.3h-.67l-5.63-5.633a1.188,1.188,0,0,0-.83-.338,1.164,1.164,0,0,0-.82.338,1.177,1.177,0,0,0,0,1.65l3.98,3.983h-16.2l3.98-3.983a1.177,1.177,0,0,0,0-1.65,1.164,1.164,0,0,0-.82-.338,1.188,1.188,0,0,0-.83.338l-5.61,5.633h-.67c-1.5,0-4.62,0-4.62,4.267a4.541,4.541,0,0,0,1.04,3.383,2.67,2.67,0,0,0,1.4.75,6.411,6.411,0,0,0,1.5.134h25.46a6.991,6.991,0,0,0,1.47-.134c1.4-.333,2.47-1.333,2.47-4.133,0-4.267-3.12-4.267-4.6-4.267Zm-.32,10.7h-23.63a1.659,1.659,0,0,0-1.65,1.933l1.4,8.567c.46,2.867,1.71,6.167,7.26,6.167h9.35c5.62,0,6.62-2.817,7.22-5.967l1.68-8.717a1.63,1.63,0,0,0-.02-.728,1.609,1.609,0,0,0-.9-1.1,1.652,1.652,0,0,0-.71-.158Zm-14.07,10.75a1.19,1.19,0,0,1-.31.86,1.172,1.172,0,0,1-1.69,0,1.19,1.19,0,0,1-.31-.86v-5.5a1.165,1.165,0,0,1,1.16-1.167,1.157,1.157,0,0,1,1.15,1.167v5.5Zm7.14,0a1.163,1.163,0,0,1-1.17,1.167,1.175,1.175,0,0,1-1.17-1.167v-5.5a1.187,1.187,0,0,1,1.17-1.167,1.173,1.173,0,0,1,1.17,1.167Z" transform="translate(-2791.33 -398.327)" /></svg>


                                        </div>
                                        <span class="item-text">هواتف</span>

                                    </a>

                                </div>
                                <div class="swiper-slide">

                                    <a href="category.html" class="category-item">

                                        <div class="item-icon">

                                            <svg xmlns="http://www.w3.org/2000/svg" width="33.34" height="33.34" viewBox="0 0 33.34 33.34"><path id="Path_2435" data-name="Path 2435" d="M2820.07,404.3h-.67l-5.63-5.633a1.188,1.188,0,0,0-.83-.338,1.164,1.164,0,0,0-.82.338,1.177,1.177,0,0,0,0,1.65l3.98,3.983h-16.2l3.98-3.983a1.177,1.177,0,0,0,0-1.65,1.164,1.164,0,0,0-.82-.338,1.188,1.188,0,0,0-.83.338l-5.61,5.633h-.67c-1.5,0-4.62,0-4.62,4.267a4.541,4.541,0,0,0,1.04,3.383,2.67,2.67,0,0,0,1.4.75,6.411,6.411,0,0,0,1.5.134h25.46a6.991,6.991,0,0,0,1.47-.134c1.4-.333,2.47-1.333,2.47-4.133,0-4.267-3.12-4.267-4.6-4.267Zm-.32,10.7h-23.63a1.659,1.659,0,0,0-1.65,1.933l1.4,8.567c.46,2.867,1.71,6.167,7.26,6.167h9.35c5.62,0,6.62-2.817,7.22-5.967l1.68-8.717a1.63,1.63,0,0,0-.02-.728,1.609,1.609,0,0,0-.9-1.1,1.652,1.652,0,0,0-.71-.158Zm-14.07,10.75a1.19,1.19,0,0,1-.31.86,1.172,1.172,0,0,1-1.69,0,1.19,1.19,0,0,1-.31-.86v-5.5a1.165,1.165,0,0,1,1.16-1.167,1.157,1.157,0,0,1,1.15,1.167v5.5Zm7.14,0a1.163,1.163,0,0,1-1.17,1.167,1.175,1.175,0,0,1-1.17-1.167v-5.5a1.187,1.187,0,0,1,1.17-1.167,1.173,1.173,0,0,1,1.17,1.167Z" transform="translate(-2791.33 -398.327)" /></svg>


                                        </div>
                                        <span class="item-text">ساعات</span>

                                    </a>

                                </div>
                                <div class="swiper-slide">

                                    <a href="category.html" class="category-item">

                                        <div class="item-icon">

                                            <svg xmlns="http://www.w3.org/2000/svg" width="33.34" height="33.34" viewBox="0 0 33.34 33.34"><path id="Path_2435" data-name="Path 2435" d="M2820.07,404.3h-.67l-5.63-5.633a1.188,1.188,0,0,0-.83-.338,1.164,1.164,0,0,0-.82.338,1.177,1.177,0,0,0,0,1.65l3.98,3.983h-16.2l3.98-3.983a1.177,1.177,0,0,0,0-1.65,1.164,1.164,0,0,0-.82-.338,1.188,1.188,0,0,0-.83.338l-5.61,5.633h-.67c-1.5,0-4.62,0-4.62,4.267a4.541,4.541,0,0,0,1.04,3.383,2.67,2.67,0,0,0,1.4.75,6.411,6.411,0,0,0,1.5.134h25.46a6.991,6.991,0,0,0,1.47-.134c1.4-.333,2.47-1.333,2.47-4.133,0-4.267-3.12-4.267-4.6-4.267Zm-.32,10.7h-23.63a1.659,1.659,0,0,0-1.65,1.933l1.4,8.567c.46,2.867,1.71,6.167,7.26,6.167h9.35c5.62,0,6.62-2.817,7.22-5.967l1.68-8.717a1.63,1.63,0,0,0-.02-.728,1.609,1.609,0,0,0-.9-1.1,1.652,1.652,0,0,0-.71-.158Zm-14.07,10.75a1.19,1.19,0,0,1-.31.86,1.172,1.172,0,0,1-1.69,0,1.19,1.19,0,0,1-.31-.86v-5.5a1.165,1.165,0,0,1,1.16-1.167,1.157,1.157,0,0,1,1.15,1.167v5.5Zm7.14,0a1.163,1.163,0,0,1-1.17,1.167,1.175,1.175,0,0,1-1.17-1.167v-5.5a1.187,1.187,0,0,1,1.17-1.167,1.173,1.173,0,0,1,1.17,1.167Z" transform="translate(-2791.33 -398.327)" /></svg>


                                        </div>
                                        <span class="item-text">سماعات</span>

                                    </a>

                                </div>
                                
                                
                                
                                
                            </div>

                        </div>
                        
                    </div>

                </div>
            
            </div>
            
        </div>
    
    </section>
    @endsection