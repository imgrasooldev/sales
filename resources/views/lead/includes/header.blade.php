<div class="container">
   <div class="row align-items-center">
      <div class="col-md-4">
         <div class="livedate">
            <img src="{{ asset('public/assets/images/cloud.png') }}" alt="">
            <h6>{{ date('D, d M Y') }}</h6>
         </div>
      </div>
      <div class="col-md-4">
         <form action="#">
            <span><i class="far fa-search"></i></span>
            <input type="search" placeholder="">
         </form>
      </div>
      <div class="col-md-4">
         <div class="mainuser">
            <a href="{{ Route('user_profile', Auth::user()->id) }}">
                <img src="{{ asset('public/profiles/'.Auth::user()->profile_image) }}" alt="{{ Auth::user()->name }} {{ Auth::user()->last_name }}">
            </a>
            <h6>{{ Auth::user()->name }} {{ Auth::user()->last_name }}<span>{{ Auth::user()->email }}</span></h6>
         </div>
      </div>
   </div>
</div>
