<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="ltr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>@yield('title', 'Multi Languages Gateway')</title>
<meta name="description" content="@yield('description')">
<meta name="theme-color" content="#0D1B3E">

@yield('og')

<link rel="canonical" href="{{ url()->current() }}">
<link rel="alternate" hreflang="en" href="{{ url()->current() }}">
<link rel="alternate" hreflang="bn" href="{{ url()->current() }}">
<meta property="og:url" content="{{ url()->current() }}">
<meta property="og:site_name" content="{{ \App\Support\Site::get('site_name', 'Multi Languages Gateway') }}">
<meta property="og:image" content="{{ asset('assets/img/glm-logo-132.png') }}">
<meta name="twitter:card" content="summary">

<link rel="icon" href="{{ asset('assets/img/glm-logo-132.png') }}" type="image/png">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Zen+Kaku+Gothic+New:wght@500;700;900&family=Hind+Siliguri:wght@400;500;600;700&display=swap">
<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

@stack('schema')
</head>
<body>

<a class="skip-link" href="#main">Skip to content</a>

@include('partials.topbar')
@include('partials.header')

<main id="main">
@yield('content')
</main>

@include('partials.footer')

<script src="{{ asset('assets/js/main.js') }}" defer></script>
</body>
</html>
