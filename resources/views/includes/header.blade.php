<div class="container">
   <div class="row align-items-center">
      <div class="col-md-4">
         <div class="livedate">
            <img src="{{ asset('public/assets/images/cloud.png') }}" alt="cloud">
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
<?php 
/**
             <img src="{{ asset('public/assets/images/user.png') }}" alt="{{ Auth::guard('admin')->user()->name }}">
            <h6>{{ Auth::guard('admin')->user()->name }}<span>{{ Auth::guard('admin')->user()->email }}</span></h6>
 * 
*/
?>
         </div>
      </div>
   </div>
</div>
