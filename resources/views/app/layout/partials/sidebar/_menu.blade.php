<div id="#kt_app_sidebar_menu" data-kt-menu="true" data-kt-menu-expand="false"
    class="app-sidebar-menu-primary menu menu-column menu-rounded menu-sub-indention menu-state-bullet-primary px-3 mb-5">
    @if (Auth::user()->user_type == 'admin')
        <div  data-kt-menu-trigger="click" class="menu-item">
            <a class="menu-link active" href="/">
                <span class="menu-icon"><i class="ki-outline ki-home-2 fs-2"></i></span><span class="menu-title">Dashboard</span>  
            </a>
        </div>
        <div  data-kt-menu-trigger="click"  class="menu-item here show menu-accordion" >
            <span class="menu-link"><span class="menu-icon"><i class="ki-outline ki-book fs-2"></i></span><span class="menu-title">Pages</span><span class="menu-arrow"></span></span>
            <div  class="menu-sub menu-sub-accordion">
                <div class="menu-item" ><a class="menu-link" href="/users"><span class="menu-bullet" ><i class="ki-solid ki-profile-user"></i></span><span class="menu-title">User Management</span></a></div>
                <div class="menu-item" ><a class="menu-link" href="/roles"><span class="menu-bullet"><span class="ki-solid ki-user"></span></span><span class="menu-title">Roles Management</span></a></div>
                <div class="menu-item" ><a class="menu-link" href="/polls"><span class="menu-bullet"><span class="ki-solid ki-book-square"></span></span><span class="menu-title">Polls Management</span></a></div>
            </div>    
        </div>
    @else
        <div  data-kt-menu-trigger="click" class="menu-item">
            <a class="menu-link active" href="/app/home">
                <span class="menu-icon"><i class="ki-outline ki-home-2 fs-2"></i></span><span class="menu-title">Home</span>  
            </a>
        </div>
        <div  data-kt-menu-trigger="click"  class="menu-item here show menu-accordion" >
            <span class="menu-link"><span class="menu-icon"><i class="ki-outline ki-book fs-2"></i></span><span class="menu-title">Pages</span><span class="menu-arrow"></span></span>
            <div  class="menu-sub menu-sub-accordion">
                <div class="menu-item" ><a class="menu-link" href="#"><span class="menu-bullet"><span class="ki-solid ki-user"></span></span><span class="menu-title">Roles Management</span></a></div>
                <div class="menu-item" ><a class="menu-link" href="#"><span class="menu-bullet"><span class="ki-solid ki-book-square"></span></span><span class="menu-title">Polls Management</span></a></div>
            </div>    
        </div>
    @endif
</div>