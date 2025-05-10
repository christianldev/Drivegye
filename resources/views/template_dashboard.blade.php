@include('common.head_v1')
@include('common.dashboard_header')

<main id="main">
@include('common.dashboard_side_menu')
@yield('main')
</main>


@include('common.footer_v1')
@include('common.foot')
