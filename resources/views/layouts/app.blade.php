<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="{{ $description ?? 'Brightlane is a modern, customizable digital studio website starter.' }}">
    <meta name="theme-color" content="#101b2d">
    <title>{{ isset($title) ? $title.' · '.config('app.name') : config('app.name') }}</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <a class="skip-link" href="#main-content">Skip to content</a>
    <header class="site-header">
        <div class="container nav-wrap">
            <a class="brand" href="{{ route('home') }}" aria-label="{{ config('app.name') }} home">
                <span class="brand-mark" aria-hidden="true">B<span>.</span></span>
                <span>{{ config('app.name', 'Brightlane') }}</span>
            </a>
            <button class="nav-toggle" type="button" aria-expanded="false" aria-controls="main-nav" aria-label="Toggle navigation" onclick="const n=document.getElementById('main-nav');const o=this.getAttribute('aria-expanded')==='true';this.setAttribute('aria-expanded',String(!o));n.classList.toggle('open',!o);">☰</button>
            <nav id="main-nav" class="main-nav" aria-label="Main navigation">
                <a href="{{ route('home') }}" @class(['active' => request()->routeIs('home')])>Home</a>
                <a href="{{ route('about') }}" @class(['active' => request()->routeIs('about')])>About</a>
                <a href="{{ route('services') }}" @class(['active' => request()->routeIs('services')])>Services</a>
                <a class="nav-cta" href="{{ route('contact') }}" @class(['active' => request()->routeIs('contact')])>Let's talk <span aria-hidden="true">↗</span></a>
            </nav>
        </div>
    </header>

    <main id="main-content">
        @yield('content')
    </main>

    <footer class="site-footer">
        <div class="container footer-top">
            <div>
                <a class="brand footer-brand" href="{{ route('home') }}">
                    <span class="brand-mark" aria-hidden="true">B<span>.</span></span>
                    <span>{{ config('app.name', 'Brightlane') }}</span>
                </a>
                <p class="footer-note">A flexible starter for thoughtful digital work.</p>
            </div>
            <div class="footer-links">
                <a href="{{ route('about') }}">About</a>
                <a href="{{ route('services') }}">Services</a>
                <a href="{{ route('contact') }}">Contact</a>
            </div>
        </div>
        <div class="container footer-bottom">
            <span>© {{ date('Y') }} {{ config('app.name', 'Brightlane') }}.</span>
            <span>Built with Laravel · CI/CD ready</span>
        </div>
    </footer>
</body>
</html>
