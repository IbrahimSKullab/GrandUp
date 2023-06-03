@extends('Frontend.layouts.app')
@section('title', 'search')
@section('content')
<main class="page-wrapper">
          
        
    <!-- ***** search-section Start ***** -->
    
    <section class="section-style search-section ">
    
        <div class="container custom-container">
        
            <div class="search-area">
            
                <div class="feedback-box search-box">
                
                    <form class="search-form w-100" action="#" method="post">
                        
                        <div class="box-icon">

                            <img class="img-fluid" src="{{asset('img/search.png')}}" alt="iconDesc">

                        </div>
                        
                        <div class="search-group form-group">
                        
                            <input class="form-control input-focus" type="search" placeholder="بحث">
                            
                            <span class="search-icon float-btn"><i class="fa-solid fa-magnifying-glass"></i></span>
                            
                            <button class="more-btn float-btn" type="button"><i class="fa-solid fa-sliders"></i></button>
                            
                        
                        </div>

                        <button class="duplicated-btn box-btn main-btn submit-btn " type="submit">بحث</button>
                        
                        
                    </form>    
                    
                
                </div>
                
            </div>
        
        </div>
    
    </section>
    

    
    <!-- ***** footer-section End ***** -->
</main>
@endsection