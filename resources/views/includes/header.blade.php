<div class="container">
   <div class="row align-items-center">
      <div class="col-md-4">
         <div class="livedate">
            <img src="{{ Asset('public/assets/images/cloud.png') }}" alt="cloud">
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
            <img src="{{ Asset('public/assets/images/user.png') }}" alt="{{ Auth::user()->name }}">
            <h6>{{ Auth::user()->name }}<span>{{Auth::user()->email }}</span></h6>
         </div>
      </div>
   </div>
</div>
