<div class="bg-light border-end p-3 h-100">
    <div class="sidebar-header mb-4">
            {{-- Logo and Title --}}
        <img src="{{asset('public/images/logo-img.jpg')}}" width="80" class="logo-icon-2" alt="">
        <h4 class="logo-text text-secondary">HansVet</h4>
    </div> 
    <div class="">
        @include('dashboard.admin.partials.sidebar-menu')
    </div>
</div>
