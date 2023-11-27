<div class="sidebar">
   <a href="{{ Route('admin.dashboard') }}"><img src="{{ asset('public/assets/images/logo.png') }}" alt=""></a>
   <div class="menu-Bar">
      <span></span>
      <span></span>
      <span></span>
   </div>
   <div class="menuWrap">
      <ul class="sidebarmenu">
         <li class="active"><a href="{{ Route('admin.dashboard') }}"><i class="fad fa-th-large"></i></a></li>
         <li><a href="{{ Route('admin.add_new_user') }}"><i class="fa fa-user-plus"></i></a></li>
         <li><a href="{{ Route('admin.add_new_brand') }}"><i class="far fa-plus-square"></i></a></li>
         <li><a href="{{ Route('admin.get_customers') }}"><i class="fas fa-users"></i></a></li>
         <li><a href="{{ Route('admin.sales') }}"><i class="fas fa-hand-holding-usd"></i></a></li>
         <li>
             <a href="index.php">
                <form method="POST" action="{{ route('admin.logout') }}">
                    @csrf
                    <button style="background-color: transparent; border: none; outline: none; padding: 0%; margin: 0%">
                        <i class="fad fa-sign-out-alt"></i>
                    </button>
                </form>
            </a>
         </li>
      </ul>
   </div>
</div>
