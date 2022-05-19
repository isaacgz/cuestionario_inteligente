<!--begin::User-->
<div class="d-flex align-items-center ms-1 ms-lg-3" id="kt_header_user_menu_toggle">
    <!--begin::Menu wrapper-->
    <div class="cursor-pointer symbol symbol-30px symbol-md-40px" data-kt-menu-trigger="click" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
    <?php        
        if (Auth::user()->image != null) {
    ?>
                <img src="{{ asset("storage/".Auth::user()->image) }}" alt="user" />
    <?php
            }else{
                ?>
                <img src="{{ asset("assets/media/avatars/blank.png") }}" alt="user" />
    <?php
            }
            
    ?>
    </div>
    <!--begin::Menu-->
    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-primary fw-bold py-4 fs-6 w-275px" data-kt-menu="true">
        <!--begin::Menu item-->
        <div class="menu-item px-3">
            <div class="menu-content d-flex align-items-center px-3">
                <!--begin::Avatar-->
                <div class="symbol symbol-50px me-5">
                    <?php        
                        if (Auth::user()->image != null) {
                    ?>
                                <img src="{{ asset("storage/".Auth::user()->image) }}" alt="user" />
                    <?php
                            }else{
                                ?>
                                <img src="{{ asset("assets/media/avatars/blank.png") }}" alt="user" />
                    <?php
                            }
                            
                    ?>                    
                </div>
                <!--end::Avatar-->
                <!--begin::Username-->
                <div class="d-flex flex-column">
                   
                    <div class="fw-bolder d-flex align-items-center fs-5">{{ Auth::user()->name }}
                        
                    </div>
                    <a href="#" class="fw-bold text-muted text-hover-primary fs-7">{{ Auth::user()->email }}</a>                    
                </div>
                <!--end::Username-->
            </div>
        </div>
        <!--end::Menu item-->
        <!--begin::Menu separator-->
        <div class="separator my-2"></div>
        <!--end::Menu separator-->
        <!--begin::Menu item-->
        <div class="menu-item px-5">
            <a href="#" class="menu-link px-5">Mi Perfil</a>
        </div>
        <!--end::Menu item-->     
        <!--begin::Menu separator-->
        <div class="separator my-2"></div>
        <!--end::Menu separator-->
        <!--begin::Menu item-->
        <div class="menu-item px-5">
            <a href="{{ route('logout') }}" class="menu-link px-5">Cerrar Sesi&oacute;n</a>
        </div>
        <!--end::Menu item-->
        <!--begin::Menu separator-->
        <div class="separator my-2"></div>
        <!--end::Menu separator-->
        <!--begin::Menu item-->
        <div class="menu-item px-5">
            <div class="menu-content px-5">
                <label class="form-check form-switch form-check-custom form-check-solid pulse pulse-success" for="kt_user_menu_dark_mode_toggle">
                    <input @if(Auth::user()->dark_mode) checked @endif onchange="dark_mode({{ Auth::user()->id }})" class="form-check-input w-30px h-20px" type="checkbox" value="1" name="kt_user_menu_dark_mode_toggle" id="kt_user_menu_dark_mode_toggle" data-kt-url="#" />
                    <span class="pulse-ring ms-n1"></span>
                    <span class="form-check-label text-gray-600 fs-7">Modo Obscuro</span>
                </label>
            </div>
        </div>
        <!--end::Menu item-->
    </div>
    <!--end::Menu-->
    <!--end::Menu wrapper-->
</div>
<!--end::User -->