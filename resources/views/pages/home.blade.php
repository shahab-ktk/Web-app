@extends('layouts.app', ['title' => 'Digital work, delivered well', 'description' => 'A clean, responsive digital studio website built with Laravel and prepared for GitHub Actions CI/CD.'])

@section('content')
<section class="hero-section">
    <div class="container hero-grid">
        <div class="hero-copy">
            <p class="eyebrow"><span class="eyebrow-dot"></span> DESIGN · ENGINEERING · DELIVERY</p>
            <h1>Move good ideas <span>forward.</span></h1>
            <p class="hero-lede">A modern digital studio starter for turning thoughtful ideas into clear, useful web experiences — with a smoother path from first draft to launch.</p>
            <div class="hero-actions">
                <a class="button button-primary" href="{{ route('services') }}">Explore services <span aria-hidden="true">↗</span></a>
                <a class="button button-quiet" href="{{ route('about') }}">How we work <span aria-hidden="true">→</span></a>
            </div>
            <div class="hero-note"><span class="note-check">✓</span><span>Responsive by design. Easy to customize. Ready to deploy.</span></div>
        </div>
        <div class="hero-art" aria-label="Illustration of a simple digital delivery workflow" role="img">
            <div class="art-orbit orbit-one"></div><div class="art-orbit orbit-two"></div>
            <div class="floating-tag tag-top"><span class="tag-icon tag-violet">✳</span><span><strong>Thoughtful design</strong><small>Start with the why</small></span></div>
            <div class="workflow-card">
                <div class="workflow-head"><span class="workflow-label">THE DELIVERY LOOP</span><span class="status-pill"><i></i> In motion</span></div>
                <div class="workflow-step"><span class="step-number">01</span><span class="step-copy"><strong>Shape the idea</strong><small>Goals, audience, direction</small></span><span class="step-state done">✓</span></div>
                <div class="workflow-connector"></div>
                <div class="workflow-step"><span class="step-number">02</span><span class="step-copy"><strong>Build with purpose</strong><small>Design, code, refine</small></span><span class="step-state done">✓</span></div>
                <div class="workflow-connector"></div>
                <div class="workflow-step current"><span class="step-number">03</span><span class="step-copy"><strong>Ship with confidence</strong><small>Test, release, improve</small></span><span class="step-state live">↗</span></div>
                <div class="workflow-footer"><span>One clear step at a time</span><span class="footer-spark">✦</span></div>
            </div>
            <div class="floating-tag tag-bottom"><span class="tag-icon tag-green">↗</span><span><strong>Small steps. Real progress.</strong><small>Keep moving forward</small></span></div>
            <span class="art-decoration decoration-a">✳</span><span class="art-decoration decoration-b">✦</span>
        </div>
    </div>
</section>

<section class="principles-strip">
    <div class="container principles-grid">
        <div><span class="principle-index">01 / CLARITY</span><strong>Make it make sense</strong><p>Simple journeys and thoughtful details.</p></div>
        <div><span class="principle-index">02 / CRAFT</span><strong>Build for real use</strong><p>Reliable foundations, not just a pretty screen.</p></div>
        <div><span class="principle-index">03 / MOMENTUM</span><strong>Improve continuously</strong><p>Good work gets better with feedback.</p></div>
    </div>
</section>

<section class="section section-services-preview">
    <div class="container">
        <div class="section-heading split-heading"><div><p class="eyebrow">WHAT WE CAN BUILD</p><h2>From first thought<br><span>to shipped product.</span></h2></div><p class="heading-description">Use this starter as a foundation for a studio site, software portfolio, or small business presence. The content is intentionally generic and ready to personalize.</p></div>
        <div class="service-grid">
            <article class="service-card"><span class="service-icon icon-lilac">◈</span><span class="card-number">01</span><h3>Web experiences</h3><p>Accessible, responsive websites that communicate clearly and feel effortless to use.</p><a href="{{ route('services') }}" class="text-link">Explore service <span>→</span></a></article>
            <article class="service-card featured-card"><span class="service-icon icon-mint">⌘</span><span class="card-number">02</span><h3>Web applications</h3><p>Useful application foundations built around maintainability, clear flows, and real needs.</p><a href="{{ route('services') }}" class="text-link">Explore service <span>→</span></a></article>
            <article class="service-card"><span class="service-icon icon-peach">⟳</span><span class="card-number">03</span><h3>Delivery automation</h3><p>Repeatable checks and releases that help teams ship changes with confidence.</p><a href="{{ route('services') }}" class="text-link">Explore service <span>→</span></a></article>
        </div>
    </div>
</section>

<section class="cta-band"><div class="container cta-content"><div><p class="eyebrow eyebrow-light">YOUR NEXT CHAPTER STARTS HERE</p><h2>Make room for the next good idea.</h2></div><a href="{{ route('contact') }}" class="button button-light">Start a conversation <span aria-hidden="true">↗</span></a></div></section>
@endsection
