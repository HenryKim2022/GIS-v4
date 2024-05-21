
@php
    $page = Session::get('page');
    $page_title = $page['page_title'];
@endphp

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>{{ env('APP_NAME') }} | {{ $page_title }}</title>
    <meta name="description" content="" />

    @include('css.v_cssheader_collections')

    @stack('scripts')

    @yield('head_page_cssjs')
    @yield('head_page_helper_js')
</head>
