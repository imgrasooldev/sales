<div class="sidebar">
   <a href="{{ Route('home') }}"><img src="{{ Asset('public/assets/images/logo.png') }}" alt=""></a>
   <div class="menu-Bar">
      <span></span>
      <span></span>
      <span></span>
   </div>
   <div class="menuWrap">
      <ul class="sidebarmenu">
         <li><a href="{{ Route('home') }}"><i class="fad fa-th-large"></i></a></li>
         @can('user-create')
         <li><a href="{{ Route('users.create') }}"><i class="fa fa-user-plus"></i></a></li>
         @endcan
         @can('brand-create')
             <li><a href="{{ Route('brands.create') }}"><i class="far fa-plus-square"></i></a></li>
         @endcan
         @can('customer-list')
             <li><a href="{{ Route('customers.index') }}"><i  class="fas fa-users" aria-hidden="true"></i></a></li>
         @endcan
         @can('sale-list')
             <li><a href="{{ Route('sales.index') }}"><i  class="fas fa-hand-holding-usd" aria-hidden="true"></i></a></li>
         @endcan
         @can('user-create')
             <li><a href="{{ Route('users.index') }}"><i  class="fas fa-user" aria-hidden="true"></i></a></li>
         @endcan
         @can('role-list')
            <li><a href="{{ Route('roles.index') }}"><i  class="fas fa-user-edit" aria-hidden="true"></i></a></li>
         @endcan
         <li>
             <a href="index.php">
                <form method="POST" action="{{ route('logout') }}">
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
