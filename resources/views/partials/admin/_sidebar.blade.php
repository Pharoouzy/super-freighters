<!-- BEGIN: Main Menu-->
<div
class="main-menu menu-fixed menu-dark menu-accordion menu-shadow"
data-scroll-to-active="true"
>
<div class="main-menu-content">
  <ul
    class="navigation navigation-main"
    id="main-menu-navigation"
    data-menu="menu-navigation"
  >
    <li class="navigation-header">
      <span>General</span
      ><i
        class="feather icon-minus"
        data-toggle="tooltip"
        data-placement="right"
        data-original-title="General"
      ></i>
    </li>
    <li class="nav-item @yield('countries')">
        <a href="{{ route('countries.index') }}"
          ><i class="feather icon-flag"></i
          ><span class="menu-title" data-i18n="Countries"
            >Countries</span
          ></a
        >
    </li>
    <li class="nav-item @yield('modes')">
        <a href="{{ route('modes.index') }}"
          ><i class="feather icon-truck"></i
          ><span class="menu-title" data-i18n="Modes of Transportation"
            >Modes of Transport</span
          ></a
        >
    </li>
    <li class="nav-item @yield('orders')">
        <a href="{{ route('orders.index') }}"
          ><i class="feather icon-shopping-cart"></i
          ><span class="menu-title" data-i18n="Dashboard"
            >Orders</span
          ></a
        >
    </li>
    <li class="nav-item @yield('settings')">
        <a href="{{ route('settings.index') }}"
          ><i class="feather icon-settings"></i
          ><span class="menu-title" data-i18n="App Settings"
            >App Settings</span
          ></a
        >
    </li>
  </ul>
</div>
</div>
<!-- END: Main Menu-->
