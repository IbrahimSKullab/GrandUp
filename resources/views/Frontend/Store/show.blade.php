@extends('Frontend.layouts.app')
@section('title', 'Stores')
@section('content')
    
<main class="page-wrapper">        
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
                                    {{$seller->name}}
                                        <span>
                                        
                                            <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M6.4875 16.875L5.0625 14.4375L2.23125 13.8563L2.55 11.1L0.75 9L2.55 6.91875L2.23125 4.1625L5.0625 3.58125L6.4875 1.125L9 2.2875L11.5125 1.125L12.9562 3.58125L15.7687 4.1625L15.45 6.91875L17.25 9L15.45 11.1L15.7687 13.8563L12.9562 14.4375L11.5125 16.875L9 15.7125L6.4875 16.875ZM8.19375 11.4937L12.45 7.275L11.6063 6.50625L8.19375 9.88125L6.4125 8.025L5.55 8.86875L8.19375 11.4937Z" fill="#00DC3E"/></svg>

                                        
                                        </span>
                                    
                                    </h2>
                                    
                                    <p class="store-num">{{$seller->username}}</p>
                                    
                                    <div class="store-flex">
                                    
                                        <div class="store-users">
                                        
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M22 12C22 6.49 17.51 2 12 2C6.49 2 2 6.49 2 12C2 14.9 3.25 17.51 5.23 19.34C5.23 19.35 5.23 19.35 5.22 19.36C5.32 19.46 5.44 19.54 5.54 19.63C5.6 19.68 5.65 19.73 5.71 19.77C5.89 19.92 6.09 20.06 6.28 20.2L6.48 20.34C6.67 20.47 6.87 20.59 7.08 20.7C7.15 20.74 7.23 20.79 7.3 20.83C7.5 20.94 7.71 21.04 7.93 21.13C8.01 21.17 8.09 21.21 8.17 21.24C8.39 21.33 8.61 21.41 8.83 21.48C8.91 21.51 8.99 21.54 9.07 21.56C9.31 21.63 9.55 21.69 9.79 21.75C9.86 21.77 9.93 21.79 10.01 21.8C10.29 21.86 10.57 21.9 10.86 21.93C10.9 21.93 10.94 21.94 10.98 21.95C11.32 21.98 11.66 22 12 22C12.34 22 12.68 21.98 13.01 21.95C13.05 21.95 13.09 21.94 13.13 21.93C13.42 21.9 13.7 21.86 13.98 21.8C14.05 21.79 14.12 21.76 14.2 21.75C14.44 21.69 14.69 21.64 14.92 21.56C15 21.53 15.08 21.5 15.16 21.48C15.38 21.4 15.61 21.33 15.82 21.24C15.9 21.21 15.98 21.17 16.06 21.13C16.27 21.04 16.48 20.94 16.69 20.83C16.77 20.79 16.84 20.74 16.91 20.7C17.11 20.58 17.31 20.47 17.51 20.34C17.58 20.3 17.64 20.25 17.71 20.2C17.91 20.06 18.1 19.92 18.28 19.77C18.34 19.72 18.39 19.67 18.45 19.63C18.56 19.54 18.67 19.45 18.77 19.36C18.77 19.35 18.77 19.35 18.76 19.34C20.75 17.51 22 14.9 22 12ZM16.94 16.97C14.23 15.15 9.79 15.15 7.06 16.97C6.62 17.26 6.26 17.6 5.96 17.97C4.38481 16.3823 3.50064 14.2365 3.5 12C3.5 7.31 7.31 3.5 12 3.5C16.69 3.5 20.5 7.31 20.5 12C20.5 14.32 19.56 16.43 18.04 17.97C17.75 17.6 17.38 17.26 16.94 16.97Z" fill="#0083BE"/><path d="M12 6.92993C9.93 6.92993 8.25 8.60993 8.25 10.6799C8.25 12.7099 9.84 14.3599 11.95 14.4199H12.13C13.1007 14.388 14.021 13.98 14.6965 13.2822C15.372 12.5843 15.7497 11.6512 15.75 10.6799C15.75 8.60993 14.07 6.92993 12 6.92993Z" fill="#0083BE"/></svg>
                                            
                                            <span>{{count($friendRequest)}}</span>

                                        
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
                                            <a class="rate-btn" href="#" data-bs-toggle="modal"  data-bs-target="#addRatemodal">كم نجمه يتسحق ! </a>

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
                                        <a href="store-page-friend.html" class="duplicated-btn action-lg-btn main-btn add-btn">
                                            
                                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12 2C9.37996 2 7.24996 4.13 7.24996 6.75C7.24996 9.32 9.25996 11.4 11.88 11.49C11.96 11.48 12.04 11.48 12.1 11.49H12.17C13.3993 11.449 14.5645 10.9315 15.4192 10.0469C16.274 9.16234 16.7512 7.98004 16.75 6.75C16.75 4.13 14.62 2 12 2ZM17.08 14.149C14.29 12.289 9.73996 12.289 6.92996 14.149C5.65996 14.999 4.95996 16.149 4.95996 17.379C4.95996 18.609 5.65996 19.749 6.91996 20.589C8.31996 21.529 10.16 21.999 12 21.999C13.84 21.999 15.68 21.529 17.08 20.589C18.34 19.739 19.04 18.599 19.04 17.359C19.03 16.129 18.34 14.989 17.08 14.149ZM14 18.129H12.75V19.379C12.75 19.789 12.41 20.129 12 20.129C11.59 20.129 11.25 19.789 11.25 19.379V18.129H9.99996C9.58996 18.129 9.24996 17.789 9.24996 17.379C9.24996 16.969 9.58996 16.629 9.99996 16.629H11.25V15.379C11.25 14.969 11.59 14.629 12 14.629C12.41 14.629 12.75 14.969 12.75 15.379V16.629H14C14.41 16.629 14.75 16.969 14.75 17.379C14.75 17.789 14.41 18.129 14 18.129Z" fill="white"/></svg>
                                                 <span>اضافة</span>
                                                
                                            
                                        </a>
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
                                        {{$seller->location}}                                     
                                    </p>
                                    <div class="contact-btns">
                                    
                                        <a class="contact-btn" href="#" data-bs-toggle="modal" data-bs-target="#merchantOrdermodal">
                                        
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

                                @foreach ($categories as $category)
                                <div class="swiper-slide">
                                    
                                    <a href="/store/{{$id}}?cat={{$category->id}}" class="category-item">

                                        <div class="item-icon">

                                            <svg xmlns="http://www.w3.org/2000/svg" width="33.34" height="33.34" viewBox="0 0 33.34 33.34"><path id="Path_2435" data-name="Path 2435" d="M2820.07,404.3h-.67l-5.63-5.633a1.188,1.188,0,0,0-.83-.338,1.164,1.164,0,0,0-.82.338,1.177,1.177,0,0,0,0,1.65l3.98,3.983h-16.2l3.98-3.983a1.177,1.177,0,0,0,0-1.65,1.164,1.164,0,0,0-.82-.338,1.188,1.188,0,0,0-.83.338l-5.61,5.633h-.67c-1.5,0-4.62,0-4.62,4.267a4.541,4.541,0,0,0,1.04,3.383,2.67,2.67,0,0,0,1.4.75,6.411,6.411,0,0,0,1.5.134h25.46a6.991,6.991,0,0,0,1.47-.134c1.4-.333,2.47-1.333,2.47-4.133,0-4.267-3.12-4.267-4.6-4.267Zm-.32,10.7h-23.63a1.659,1.659,0,0,0-1.65,1.933l1.4,8.567c.46,2.867,1.71,6.167,7.26,6.167h9.35c5.62,0,6.62-2.817,7.22-5.967l1.68-8.717a1.63,1.63,0,0,0-.02-.728,1.609,1.609,0,0,0-.9-1.1,1.652,1.652,0,0,0-.71-.158Zm-14.07,10.75a1.19,1.19,0,0,1-.31.86,1.172,1.172,0,0,1-1.69,0,1.19,1.19,0,0,1-.31-.86v-5.5a1.165,1.165,0,0,1,1.16-1.167,1.157,1.157,0,0,1,1.15,1.167v5.5Zm7.14,0a1.163,1.163,0,0,1-1.17,1.167,1.175,1.175,0,0,1-1.17-1.167v-5.5a1.187,1.187,0,0,1,1.17-1.167,1.173,1.173,0,0,1,1.17,1.167Z" transform="translate(-2791.33 -398.327)" /></svg>


                                        </div>
                                        <span class="item-text">{{$category->title}}</span>

                                    </a>

                                </div>  
                                @endforeach

                                

                                
                                
                                
                                
                            </div>

                        </div>
                        
                    </div>

                </div>
            
            </div>
            
        </div>
    
    </section>
    
    <!-- ***** store-section End ***** -->
    
    
     <!-- ***** products-categories-section Start ***** -->
    
     <section class="section-style products-categories-section pt-0">
    
        <div class="container custom-container">
        
            <div class="products-area">
            
                <div class="main-title">
                
                    <h1 class="title">#كل المنتجات</h1>
                
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
                                    @foreach ($newProducts as $product)
                                    <div class="swiper-slide product-wrap">

                                        <div class="product-item">

                                             <div class="product-img">

                                                 <a href="product-default.html">

                                                     <span class="tt-img">

                                                        <img class="img-fluid" src="{{asset('img/p1.png')}}" alt="productName">

                                                    </span>
                                                     <div class="product-code">كود : {{$product->code}}</div>

                                                 </a>

                                             </div>
                                             <div class="product-body">

                                                 <div class="price-info">

                                                     <p class="price-val">

                                                         <span>{{$product->price}} </span>
                                                         دولارًا

                                                     </p>

                                                     <p class="price-points">


                                                         <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="13.945" height="13" viewBox="0 0 13.945 13"><defs><clipPath id="clip-path"><rect id="Rectangle_35" data-name="Rectangle 35" width="13.946" height="13" transform="translate(1149.69 2020)" fill="#fff"/></clipPath></defs><g id="Group_16" data-name="Group 16" transform="translate(-1149.69 -2020)" clip-path="url(#clip-path)"><path id="Path_89" data-name="Path 89" d="M1163.64,2026.5a6.3,6.3,0,0,1-1.88,4.44,7.116,7.116,0,0,1-5.1,1.95,6.543,6.543,0,0,1-6.84-6.39,6.186,6.186,0,0,1,2.08-4.75,7.215,7.215,0,0,1,4.76-1.75A6.756,6.756,0,0,1,1163.64,2026.5Z" fill="#ffd05b"/><path id="Path_90" data-name="Path 90" d="M1156.66,2031.74a5.253,5.253,0,1,0-5.62-5.24A5.448,5.448,0,0,0,1156.66,2031.74Z" fill="#ffeaa5"/><path id="Path_91" data-name="Path 91" d="M1161.39,2026.5a4.208,4.208,0,0,1-1.19,2.92,4.793,4.793,0,0,1-3.54,1.37,4.337,4.337,0,0,1-4.56-4.29,4.1,4.1,0,0,1,1.43-3.29,4.892,4.892,0,0,1,3.13-1.11,4.575,4.575,0,0,1,4.73,4.4Z" fill="#ffe077"/><path id="Path_92" data-name="Path 92" d="M1157.79,2026.71l-.92-2.22a.231.231,0,0,0-.42,0l-.91,2.22-1.18-.83-.15.19.93,2.58,3.46-.26.78-2.32a.224.224,0,0,0-.35-.23Z" fill="#ffc244"/><path id="Path_93" data-name="Path 93" d="M1157,2032.69a6.747,6.747,0,0,1-6.97-6.5,6.255,6.255,0,0,1,1.87-4.44,6.3,6.3,0,0,0-2.21,4.75,6.747,6.747,0,0,0,6.97,6.5,7.2,7.2,0,0,0,5.1-2.06,7.266,7.266,0,0,1-4.76,1.75Z" fill="#ffc244"/><path id="Path_94" data-name="Path 94" d="M1157.06,2030.54a4.577,4.577,0,0,1-4.73-4.41,4.191,4.191,0,0,1,1.2-2.92,4.253,4.253,0,0,0-1.59,3.29,4.567,4.567,0,0,0,4.72,4.4,4.876,4.876,0,0,0,3.54-1.48,4.948,4.948,0,0,1-3.14,1.12Z" fill="#ffd05b"/><path id="Path_95" data-name="Path 95" d="M1155,2027.8l-.64-1.92-.06-.04c-.18-.12-.42.04-.35.23l.82,2.44a.432.432,0,0,0,.42.3h2.94a.445.445,0,0,0,.43-.3l.04-.12h-2.74a.894.894,0,0,1-.86-.59Z" fill="#ffaa5a"/></g></svg>

                                                         {{$product->points}}

                                                     </p>

                                                 </div>

                                                 <div class="product-desc">

                                                     <a href="product-default.html">

                                                         {{$product->title}}

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
                                    @endforeach
                                                                

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
                                    @foreach ($productPoints as $product)
                                        <div class="swiper-slide product-wrap">

                                            <div class="product-item">

                                                <div class="product-img">

                                                    <a href="product-default.html">

                                                        <span class="tt-img">

                                                            <img class="img-fluid" src="{{asset('img/p1.png')}}" alt="productName">

                                                        </span>
                                                        <div class="product-code">كود : {{$product->code}}</div>

                                                    </a>

                                                </div>
                                                <div class="product-body">

                                                    <div class="price-info">

                                                        <p class="price-val">

                                                            <span>{{$product->price}} </span>
                                                            دولارًا

                                                        </p>

                                                        <p class="price-points">


                                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="13.945" height="13" viewBox="0 0 13.945 13"><defs><clipPath id="clip-path"><rect id="Rectangle_35" data-name="Rectangle 35" width="13.946" height="13" transform="translate(1149.69 2020)" fill="#fff"/></clipPath></defs><g id="Group_16" data-name="Group 16" transform="translate(-1149.69 -2020)" clip-path="url(#clip-path)"><path id="Path_89" data-name="Path 89" d="M1163.64,2026.5a6.3,6.3,0,0,1-1.88,4.44,7.116,7.116,0,0,1-5.1,1.95,6.543,6.543,0,0,1-6.84-6.39,6.186,6.186,0,0,1,2.08-4.75,7.215,7.215,0,0,1,4.76-1.75A6.756,6.756,0,0,1,1163.64,2026.5Z" fill="#ffd05b"/><path id="Path_90" data-name="Path 90" d="M1156.66,2031.74a5.253,5.253,0,1,0-5.62-5.24A5.448,5.448,0,0,0,1156.66,2031.74Z" fill="#ffeaa5"/><path id="Path_91" data-name="Path 91" d="M1161.39,2026.5a4.208,4.208,0,0,1-1.19,2.92,4.793,4.793,0,0,1-3.54,1.37,4.337,4.337,0,0,1-4.56-4.29,4.1,4.1,0,0,1,1.43-3.29,4.892,4.892,0,0,1,3.13-1.11,4.575,4.575,0,0,1,4.73,4.4Z" fill="#ffe077"/><path id="Path_92" data-name="Path 92" d="M1157.79,2026.71l-.92-2.22a.231.231,0,0,0-.42,0l-.91,2.22-1.18-.83-.15.19.93,2.58,3.46-.26.78-2.32a.224.224,0,0,0-.35-.23Z" fill="#ffc244"/><path id="Path_93" data-name="Path 93" d="M1157,2032.69a6.747,6.747,0,0,1-6.97-6.5,6.255,6.255,0,0,1,1.87-4.44,6.3,6.3,0,0,0-2.21,4.75,6.747,6.747,0,0,0,6.97,6.5,7.2,7.2,0,0,0,5.1-2.06,7.266,7.266,0,0,1-4.76,1.75Z" fill="#ffc244"/><path id="Path_94" data-name="Path 94" d="M1157.06,2030.54a4.577,4.577,0,0,1-4.73-4.41,4.191,4.191,0,0,1,1.2-2.92,4.253,4.253,0,0,0-1.59,3.29,4.567,4.567,0,0,0,4.72,4.4,4.876,4.876,0,0,0,3.54-1.48,4.948,4.948,0,0,1-3.14,1.12Z" fill="#ffd05b"/><path id="Path_95" data-name="Path 95" d="M1155,2027.8l-.64-1.92-.06-.04c-.18-.12-.42.04-.35.23l.82,2.44a.432.432,0,0,0,.42.3h2.94a.445.445,0,0,0,.43-.3l.04-.12h-2.74a.894.894,0,0,1-.86-.59Z" fill="#ffaa5a"/></g></svg>

                                                            {{$product->points}}

                                                        </p>

                                                    </div>

                                                    <div class="product-desc">

                                                        <a href="product-default.html">

                                                            {{$product->title}}

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
                                    @endforeach
                                    
                                   
                                    
                                    

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
                                    @foreach ($offerProducts as $product)
                                    <div class="swiper-slide product-wrap">

                                        <div class="product-item">

                                            <div class="product-img">

                                                <a href="product-default.html">

                                                    <span class="tt-img">

                                                        <img class="img-fluid" src="{{asset('img/p1.png')}}" alt="productName">

                                                    </span>
                                                    <div class="product-code">كود : {{$product->code}}</div>

                                                </a>

                                            </div>
                                            <div class="product-body">

                                                <div class="price-info">

                                                    <p class="price-val">

                                                        <span>{{$product->price}} </span>
                                                        دولارًا

                                                    </p>

                                                    <p class="price-points">


                                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="13.945" height="13" viewBox="0 0 13.945 13"><defs><clipPath id="clip-path"><rect id="Rectangle_35" data-name="Rectangle 35" width="13.946" height="13" transform="translate(1149.69 2020)" fill="#fff"/></clipPath></defs><g id="Group_16" data-name="Group 16" transform="translate(-1149.69 -2020)" clip-path="url(#clip-path)"><path id="Path_89" data-name="Path 89" d="M1163.64,2026.5a6.3,6.3,0,0,1-1.88,4.44,7.116,7.116,0,0,1-5.1,1.95,6.543,6.543,0,0,1-6.84-6.39,6.186,6.186,0,0,1,2.08-4.75,7.215,7.215,0,0,1,4.76-1.75A6.756,6.756,0,0,1,1163.64,2026.5Z" fill="#ffd05b"/><path id="Path_90" data-name="Path 90" d="M1156.66,2031.74a5.253,5.253,0,1,0-5.62-5.24A5.448,5.448,0,0,0,1156.66,2031.74Z" fill="#ffeaa5"/><path id="Path_91" data-name="Path 91" d="M1161.39,2026.5a4.208,4.208,0,0,1-1.19,2.92,4.793,4.793,0,0,1-3.54,1.37,4.337,4.337,0,0,1-4.56-4.29,4.1,4.1,0,0,1,1.43-3.29,4.892,4.892,0,0,1,3.13-1.11,4.575,4.575,0,0,1,4.73,4.4Z" fill="#ffe077"/><path id="Path_92" data-name="Path 92" d="M1157.79,2026.71l-.92-2.22a.231.231,0,0,0-.42,0l-.91,2.22-1.18-.83-.15.19.93,2.58,3.46-.26.78-2.32a.224.224,0,0,0-.35-.23Z" fill="#ffc244"/><path id="Path_93" data-name="Path 93" d="M1157,2032.69a6.747,6.747,0,0,1-6.97-6.5,6.255,6.255,0,0,1,1.87-4.44,6.3,6.3,0,0,0-2.21,4.75,6.747,6.747,0,0,0,6.97,6.5,7.2,7.2,0,0,0,5.1-2.06,7.266,7.266,0,0,1-4.76,1.75Z" fill="#ffc244"/><path id="Path_94" data-name="Path 94" d="M1157.06,2030.54a4.577,4.577,0,0,1-4.73-4.41,4.191,4.191,0,0,1,1.2-2.92,4.253,4.253,0,0,0-1.59,3.29,4.567,4.567,0,0,0,4.72,4.4,4.876,4.876,0,0,0,3.54-1.48,4.948,4.948,0,0,1-3.14,1.12Z" fill="#ffd05b"/><path id="Path_95" data-name="Path 95" d="M1155,2027.8l-.64-1.92-.06-.04c-.18-.12-.42.04-.35.23l.82,2.44a.432.432,0,0,0,.42.3h2.94a.445.445,0,0,0,.43-.3l.04-.12h-2.74a.894.894,0,0,1-.86-.59Z" fill="#ffaa5a"/></g></svg>

                                                        {{$product->points}}

                                                    </p>

                                                </div>

                                                <div class="product-desc">

                                                    <a href="product-default.html">

                                                        {{$product->title}}

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
                                    @endforeach
                                   
                                  
                                    

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

                                                           <img class="img-fluid" src="img/p1.png" alt="productName">

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

                                                           <img class="img-fluid" src="img/p1.png" alt="productName">

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

                                                           <img class="img-fluid" src="img/p1.png" alt="productName">

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

                                                           <img class="img-fluid" src="img/p1.png" alt="productName">

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

                                                           <img class="img-fluid" src="img/p1.png" alt="productName">

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

                                        <img class="img-fluid" src="img/loading.svg" alt="loaderIcon">
                                </span>
                                <span class="loader-text">عرض المزيد</span>

                        </a>
                       <a class="show-more show-more-loading no-more d-none " href="#">

                                <span class="up-loader-inline fa-spin ">

                                        <img class="img-fluid" src="img/loading.svg" alt="loaderIcon">
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
            
    
   
    
    <!-- ***** footer-section Start ***** -->
    
    <footer class="footer-section">
    
        <div class="top-footer">
        
            <div class="container custom-container">
            
                <div class="help-wrapper">
                
                    <div class="help-texts">
                    
                        <h4 class="help-title">تحتاج للمساعدة؟</h4>
                        <p class="help-text">لا تتردد في التواصل معنا فى اي وقت</p>
                    
                    </div>
                    <div class="newsletter-contact">
                    
                        <form class="newsletter-form" method="post"  action="#">
                            
                            <div class="form-group">
                            
                                <input type="email" class="form-control input-focus" placeholder="اشتراك في النشرة  البريدية">
                                <button type="submit" class="submit-btn">اشتراك</button>
                            
                            </div>

                        </form>
                    
                    </div>
                    
                </div>
                <div class="contact-row">
                
                    <div class="row row-cols-xl-auto justify-content-xl-between flex-xl-nowrap row-cols-md-3 row-cols-sm-2 gx-3">
                    
                        <div class="row-col">
                        
                            <a class="contact-item" href="#">
                            
                                <div class="item-icon">
                                    
                                    <img class="img-fluid" src="img/Path%20467.svg">
                                </div>
                                <div class="item-texts">
                                
                                    <p class="item-title">صفحة الاعلانات</p>
                                    <span class="item-desc">متاحة لاستلام الاعلانات الخاصه بكم</span>
                                
                                </div>
                            
                            </a>
                        
                        </div>
                        <div class="row-col">
                        
                            <a class="contact-item" href="#">
                            
                                <div class="item-icon">
                                    
                                   <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 50 50"><g id="Group_599" data-name="Group 599" transform="translate(12292.61 13686)"><path id="Path_478" data-name="Path 478" d="M1033.39,3499h-30a10,10,0,0,0-10,10v30a10,10,0,0,0,10,10h30a10,10,0,0,0,10-10v-30A10,10,0,0,0,1033.39,3499Z" transform="translate(-13286 -17185)" fill="#1bd741"/><path id="Path_479" data-name="Path 479" d="M1006.27,3536.14l1.7-6.05a12.078,12.078,0,1,1,4.52,4.45Zm6.53-3.81.38.23a10.035,10.035,0,1,0-3.24-3.16l.26.39-.98,3.47Z" transform="translate(-13286 -17185)" fill="#fff" fill-rule="evenodd"/><path id="Path_480" data-name="Path 480" d="M1015.01,3518.34l-.8-.05a1.088,1.088,0,0,0-.67.23,3.766,3.766,0,0,0-1.18,1.8,5.367,5.367,0,0,0,.17,2.29,5.593,5.593,0,0,0,1.11,2.01,12.648,12.648,0,0,0,6.87,4.98,3.244,3.244,0,0,0,1.45.14,3.288,3.288,0,0,0,1.38-.5,2.511,2.511,0,0,0,1.1-1.59l.13-.59a.519.519,0,0,0-.05-.27.413.413,0,0,0-.18-.19l-2.65-1.21a.455.455,0,0,0-.28-.03.511.511,0,0,0-.23.15l-1.03,1.34a.328.328,0,0,1-.15.11.251.251,0,0,1-.19-.01,8.248,8.248,0,0,1-4.42-3.78.32.32,0,0,1-.02-.17.292.292,0,0,1,.07-.16l.98-1.16a.435.435,0,0,0,.1-.19.533.533,0,0,0-.02-.22l-1.16-2.67a.291.291,0,0,0-.12-.18.345.345,0,0,0-.21-.08Z" transform="translate(-13286 -17185)" fill="#fff" fill-rule="evenodd"/></g></svg>

                                </div>
                                <div class="item-texts">
                                
                                    <p class="item-title">واتساب</p>
                                    <span class="item-desc"> 
                                        
                                        متاح الحديث معنا خلال  
                                        24
                                        ساعة 
                                    
                                    </span>
                                
                                </div>
                            
                            </a>
                        
                        </div>
                        <div class="row-col">
                        
                            <a class="contact-item" href="#">
                            
                                <div class="item-icon">
                                    
                                    <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 50 50"><g id="Group_598" data-name="Group 598" transform="translate(12542 13686)"><path id="Path_470" data-name="Path 470" d="M784,3499H754a10,10,0,0,0-10,10v30a10,10,0,0,0,10,10h30a10,10,0,0,0,10-10v-30A10,10,0,0,0,784,3499Z" transform="translate(-13286 -17185)" fill="#039be5"/><path id="Path_471" data-name="Path 471" d="M756.164,3522.08l22.171-8.97c1.029-.39,1.928.26,1.594,1.9l0-.01-3.775,18.67c-.28,1.33-1.029,1.65-2.077,1.02l-5.749-4.44-2.773,2.8a1.429,1.429,0,0,1-1.159.59l.408-6.14,10.655-10.1c.463-.43-.1-.67-.715-.24l-13.167,8.7L755.9,3524c-1.232-.41-1.259-1.29.261-1.92Z" transform="translate(-13286 -17185)" fill="#fff"/></g></svg>

                                </div>
                                <div class="item-texts">
                                
                                    <p class="item-title">قناة تلجرام</p>
                                    <span class="item-desc">ننتظرك فى القناه اشترك الان!</span>
                                
                                </div>
                            
                            </a>
                        
                        </div>
                        <div class="row-col">
                        
                            <a class="contact-item" href="#">
                            
                                <div class="item-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 50 50"><g id="Group_597" data-name="Group 597" transform="translate(12785 13686)"><path id="Path_483" data-name="Path 483" d="M541,3499H511a10,10,0,0,0-10,10v30a10,10,0,0,0,10,10h30a10,10,0,0,0,10-10v-30A10,10,0,0,0,541,3499Z" transform="translate(-13286 -17185)" fill="#6f3faa"/><path id="Path_484" data-name="Path 484" d="M538.906,3516.58v-.03a7.982,7.982,0,0,0-2.067-3.46,8.653,8.653,0,0,0-4.1-2.48h-.03a34.574,34.574,0,0,0-12.906,0h-.03a9.145,9.145,0,0,0-6.179,5.94v.03a25.3,25.3,0,0,0,0,10.88v.03a9.081,9.081,0,0,0,3.89,4.95,7.367,7.367,0,0,0,1.94.9v2.89a1.143,1.143,0,0,0,.2.64,1.209,1.209,0,0,0,.526.43,1.293,1.293,0,0,0,.674.06,1.227,1.227,0,0,0,.593-.33l2.924-3.04c.632.04,1.27.06,1.9.06a34.078,34.078,0,0,0,6.453-.62h.03a9.118,9.118,0,0,0,6.169-5.93v-.03a25.3,25.3,0,0,0,.013-10.89Zm-2.314,10.35a6.933,6.933,0,0,1-4.356,4.17,32.245,32.245,0,0,1-6.864.56.143.143,0,0,0-.065.01.132.132,0,0,0-.054.04l-2.135,2.19-2.271,2.33a.248.248,0,0,1-.135.08.277.277,0,0,1-.155-.02.273.273,0,0,1-.12-.09.29.29,0,0,1-.046-.15v-4.78a.173.173,0,0,0-.038-.11.18.18,0,0,0-.1-.06,4.291,4.291,0,0,1-1.041-.39,7.032,7.032,0,0,1-3.315-3.78,22.932,22.932,0,0,1,0-9.84,6.939,6.939,0,0,1,4.353-4.16,31.769,31.769,0,0,1,11.982,0,6.464,6.464,0,0,1,2.912,1.84,5.687,5.687,0,0,1,1.444,2.33,22.917,22.917,0,0,1,0,9.83Z" transform="translate(-13286 -17185)" fill="#fff"/><path id="Path_485" data-name="Path 485" d="M532.3,3527.18a3.668,3.668,0,0,1-1.584,1.74,4.056,4.056,0,0,1-.685.22c-.266-.08-.52-.14-.747-.23a18.881,18.881,0,0,1-5.2-3.07,13.149,13.149,0,0,1-1.3-1.27,17,17,0,0,1-2.49-3.8c-.319-.65-.588-1.33-.862-2a1.745,1.745,0,0,1,.5-1.7,3.945,3.945,0,0,1,1.338-.99.858.858,0,0,1,1.073.25,13.74,13.74,0,0,1,1.674,2.32,1.1,1.1,0,0,1,.143.81,1.087,1.087,0,0,1-.455.68,3.838,3.838,0,0,0-.356.29,1.158,1.158,0,0,0-.269.28.779.779,0,0,0-.06.69,6.5,6.5,0,0,0,2.3,3.2,5.958,5.958,0,0,0,1.185.65,1.743,1.743,0,0,0,.892.22c.543-.06.722-.66,1.1-.97a1.059,1.059,0,0,1,.613-.24,1.02,1.02,0,0,1,.632.18c.4.25.792.53,1.18.8s.755.55,1.109.85a.878.878,0,0,1,.276,1.09Z" transform="translate(-13286 -17185)" fill="#fff"/><path id="Path_486" data-name="Path 486" d="M526.961,3515.24h0Z" transform="translate(-13286 -17185)" fill="#fff"/><path id="Path_487" data-name="Path 487" d="M532.473,3522.71c-.249,0-.371-.21-.389-.45-.032-.45-.057-.91-.119-1.36a5.564,5.564,0,0,0-.782-2.16,5.719,5.719,0,0,0-1.638-1.72,5.543,5.543,0,0,0-2.2-.91c-.358-.07-.724-.08-1.085-.12-.23-.03-.531-.04-.581-.32a.413.413,0,0,1,.013-.17.376.376,0,0,1,.08-.14.37.37,0,0,1,.132-.1.454.454,0,0,1,.161-.04h.18a6.519,6.519,0,0,1,6.42,5.4c.1.54.13,1.1.172,1.64a.367.367,0,0,1-.009.16.342.342,0,0,1-.074.15.53.53,0,0,1-.127.1.418.418,0,0,1-.156.04Z" transform="translate(-13286 -17185)" fill="#fff"/><path id="Path_488" data-name="Path 488" d="M531.126,3521.54a.955.955,0,0,1-.03.22.343.343,0,0,1-.331.26.32.32,0,0,1-.213-.05.373.373,0,0,1-.144-.17,1.054,1.054,0,0,1-.037-.31,3.989,3.989,0,0,0-.324-1.62c-.05-.11-.1-.22-.167-.33a3.678,3.678,0,0,0-1.521-1.43,4.649,4.649,0,0,0-1.211-.37c-.184-.03-.368-.05-.553-.07a.338.338,0,0,1-.138-.04.3.3,0,0,1-.112-.09.262.262,0,0,1-.068-.12.351.351,0,0,1-.013-.14.32.32,0,0,1,.03-.14.3.3,0,0,1,.086-.12.308.308,0,0,1,.126-.07.354.354,0,0,1,.144-.02,5.121,5.121,0,0,1,2.1.55,4.227,4.227,0,0,1,1.855,1.83,4.856,4.856,0,0,1,.458,1.47,1.9,1.9,0,0,1,.03.21c.013.15.018.29.03.48C531.123,3521.49,531.126,3521.51,531.126,3521.54Z" transform="translate(-13286 -17185)" fill="#fff"/><path id="Path_489" data-name="Path 489" d="M529.419,3521.2a.379.379,0,0,1-.094.17.35.35,0,0,1-.17.08H529.1a.462.462,0,0,1-.231-.06.387.387,0,0,1-.147-.19.426.426,0,0,1-.03-.13,3.828,3.828,0,0,0-.075-.5,1.449,1.449,0,0,0-.533-.83,1.641,1.641,0,0,0-.431-.21c-.2-.06-.4-.04-.6-.09a.379.379,0,0,1-.238-.15.362.362,0,0,1-.061-.27.39.39,0,0,1,.145-.24.4.4,0,0,1,.261-.07,2.165,2.165,0,0,1,2.211,1.85,2.84,2.84,0,0,1,.048.34,1.007,1.007,0,0,1,0,.3Z" transform="translate(-13286 -17185)" fill="#fff"/></g></svg>

                                </div>
                                <div class="item-texts">
                                
                                    <p class="item-title">الفايبر</p>
                                    <span class="item-desc">ننتظرك فى القناه اشترك الان!</span>
                                
                                </div>
                            
                            </a>
                        
                        </div>
                        <div class="row-col">
                        
                            <a class="contact-item" href="#">
                            
                                <div class="item-icon">
                                    
                                    <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 50 50"><g id="Group_596" data-name="Group 596" transform="translate(13023 13686)"><path id="Path_474" data-name="Path 474" d="M303,3499H273a10,10,0,0,0-10,10v30a10,10,0,0,0,10,10h30a10,10,0,0,0,10-10v-30A10,10,0,0,0,303,3499Z" transform="translate(-13286 -17185)" fill="#ffc107"/><path id="Path_475" data-name="Path 475" d="M286.242,3525.95l-1.85,1.85a1,1,0,0,1-1.41.01c-.11-.11-.22-.21-.33-.32a28.512,28.512,0,0,1-2.79-3.27,17.826,17.826,0,0,1-1.96-3.41,8.586,8.586,0,0,1-.71-3.27,5.173,5.173,0,0,1,.36-1.93,4.6,4.6,0,0,1,1.15-1.67,2.93,2.93,0,0,1,2.08-.94,1.881,1.881,0,0,1,.81.18,1.631,1.631,0,0,1,.67.56l2.32,3.27a3.423,3.423,0,0,1,.4.7,1.58,1.58,0,0,1,.14.61,1.357,1.357,0,0,1-.21.71,3.4,3.4,0,0,1-.56.71l-.76.79a.535.535,0,0,0-.16.4.905.905,0,0,0,.03.23c.03.08.06.14.08.2a8.3,8.3,0,0,0,.93,1.28c.45.52.93,1.05,1.45,1.58.1.1.21.2.31.3a1,1,0,0,1,.01,1.43Zm10.92,3.38a2.528,2.528,0,0,1-.25,1.09,4.12,4.12,0,0,1-.68,1.02,4.508,4.508,0,0,1-1.64,1.18c-.01,0-.02.01-.03.01a5.047,5.047,0,0,1-1.92.37,8.334,8.334,0,0,1-3.26-.73,17.56,17.56,0,0,1-3.44-1.98c-.39-.29-.78-.58-1.15-.89l3.27-3.27a5.613,5.613,0,0,0,.74.48c.05.02.11.05.18.08a.69.69,0,0,0,.25.04.551.551,0,0,0,.41-.17l.76-.75a3.071,3.071,0,0,1,.72-.56,1.332,1.332,0,0,1,.71-.21,1.6,1.6,0,0,1,.61.13,3.864,3.864,0,0,1,.7.39l3.31,2.35a1.518,1.518,0,0,1,.55.64,2.052,2.052,0,0,1,.16.78Z" transform="translate(-13286 -17185)" fill="#fff"/></g></svg>

                                </div>
                                <div class="item-texts">
                                
                                    <p class="item-title"> الهاتف</p>
                                    <span class="item-desc">اتصل الان للدعم</span>
                                
                                </div>
                            
                            </a>
                        
                        </div>
                        
                    
                    </div>
                
                </div>
            
            </div>
        
        </div>
        
        <div class="bottom-footer">
        
            <div class="container custom-container">
            
                <div class="row gx-lg-5">
                
                    <div class="col-lg-5 col-12">
                    
                        <div class="footer-menu">
                        
                            <div class="footer-about">
                            
                                <a class="about-logo" href="index.html">
                                
                                    <img class="img-fluid" src="img/logo.svg" alt="Grand Up">
                                    <span>اسم التطبيق</span>
                                
                                </a>
                                
                                <p class="about-desc">
                                
                                    حمل التطبيق الان من ابل ستور او جوجل بلاي واستمتع بتجربة استخدام مميزه حمل التطبيق الان من ابل ستور او جوجل بلاي واستمتع بتجربة استخدام مميزه حمل التطبيق الان من ابل ستور او جوجل بلاي واستمتع بتجربة استخدام مميزه حمل التطبيق الان من ابل ستور او جوجل بلاي واستمتع 
                                
                                </p>
                                
                            
                            </div>
                        
                        </div>
                    
                    </div>
                    
                    <div class="col-md">
                    
                        <div class="menus-wrap">
                        
                            <div class="row justify-content-between gx-md-4 gx-3">
                            
                                <div class="col-lg col-md ">
                    
                    
                                    <div class="footer-menu">

                                        <h6 class="menu-title">ابرز الصفحات</h6>
                                        <ul class="menu-list">

                                            <li class="list-item">

                                                <a class="item-link" href="category.html">ملابس</a>

                                            </li>
                                             <li class="list-item">

                                                <a class="item-link" href="category.html">هواتف</a>

                                            </li>
                                             <li class="list-item">

                                                <a class="item-link" href="category.html">ساعات</a>

                                            </li>
                                             <li class="list-item">

                                                <a class="item-link" href="category.html">سماعات</a>

                                            </li>
                                             <li class="list-item">

                                                <a class="item-link" href="category.html">ملابس</a>

                                            </li>
                                            <li class="list-item">

                                                <a class="item-link" href="category.html">هواتف</a>

                                            </li>


                                        </ul>

                                    </div>

                                </div>
                    
                                <div class="col-lg  col-md">

                                    <div class="footer-menu">

                                        <h6 class="menu-title">من نحن</h6>
                                        <ul class="menu-list">

                                            <li class="list-item">

                                                <a class="item-link" href="terms.html">سياسة الخصوصية</a>

                                            </li>
                                             <li class="list-item">

                                                <a class="item-link" href="terms.html">شروط الاستخدام</a>

                                            </li>
                                             <li class="list-item">

                                                <a class="item-link" href="terms.html">سياسة الانضمام لدينا</a>

                                            </li>


                                        </ul>

                                    </div>



                                </div>

                                <div class="col-lg  col-md">

                                    <div class="footer-menu">

                                        <h6 class="menu-title">تابعنا عبر</h6>
                                        <ul class="menu-list">

                                            <li class="list-item">

                                                <a class="item-link" href="#">تابعنا عبر فيسبوك</a>

                                            </li>
                                             <li class="list-item">

                                                <a class="item-link" href="#">تابعنا عبر تويتر</a>

                                            </li>
                                             <li class="list-item">

                                                <a class="item-link" href="#">تابعنا عبر واتساب</a>

                                            </li>


                                        </ul>

                                    </div>


                                </div>

                            
                            </div>
                        
                        </div>
                    
                    </div>
                    
                    <div class="col-12">
                    
                        <p class="copy-rights">
                        
                            ©  
                            جميع الحقوق محفوظة
                            جراند اب
                            <span><script>document.write(new Date().getFullYear());</script></span> 
                        
                        </p>
                    
                    </div>
                    
                    
                </div>
            
            </div>
        
        </div>
    
    </footer>
    
    <!-- ***** footer-section End ***** -->
    
    

</main>

<!-- ***** page-wrapper End ***** -->




<!-- merchant-order-modal -->

<div class="modal fade custom-modal merchant-order-modal" id="merchantOrdermodal" tabindex="-1"  aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
          
        <button type="button" class="btn__close" data-bs-dismiss="modal" aria-label="Close">
            <i class="fa-solid fa-xmark"></i>
        </button>
        <div class="modal-body">
           
            <div class="body-container">
            
                <div class="modal-area">
                
                    <div class="store-info">
                    
                        <img class="img-fluid" src="img/store.svg" alt="storeName">
                        <span>اسم المتجر</span>
                    
                    </div>
                    
                    <div class="area-texts">
                    
                        <p class="modal-text">رائع تم قبول طلبك الان من التاجر</p>
                        
                    </div>
                    
                    <div class="modal-btns">
                    
                        <a href="#" class="duplicated-btn modal-btn main-btn">تصفح منتجات المتجر</a>
                        <button type="button" class="duplicated-btn modal-btn sub-btn" data-bs-dismiss="modal" aria-label="Close">اغلاق</button>
                    
                    </div>
                
                </div>
            
            </div>
            
        </div>
          
      </div>
    </div>
  </div>
  
  <!-- merchant-order-modal -->


<!-- add-rate-modal -->
<div class="modal fade custom-modal add-rate-modal" id="addRatemodal" tabindex="-1"  aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            
        <button type="button" class="btn__close" data-bs-dismiss="modal" aria-label="Close">
            <i class="fa-solid fa-xmark"></i>
        </button>
        <div class="modal-body">
            
            <div class="body-container">
            
                <form class="add-rate-form modal-area">
                      
                        <div class="area-texts">

                            <p class="modal-text">نشكرك مقدماً على إضافة تقييمك</p>


                        </div>
                         <div class="add-rate-area">
                        
                            <div class="star-rating justify-content-center">
                                    <div class="rateit in-modal w-set star-xl" 
                                        data-rateit-mode="font"
                                        data-rateit-step=".5">
                                    </div>
                                    <span class="rate-info rate-val"></span>
                            </div>
                        
                        </div> 
                        <div class="modal-btns">

                            <button type="submit" class="duplicated-btn modal-btn main-btn">إرسال</button>

                        </div>
                        

                
                </form>
            
            </div>
            
        </div>
            
        </div>
    </div>
</div>
<!-- add-rate-modal -->

      




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

@endsection