@extends('layouts.app', ['title' => 'Contact', 'description' => 'Try the Brightlane demo contact form. This starter does not store or email submissions.'])

@section('content')
<section class="page-hero page-hero-compact"><div class="container page-hero-inner"><p class="eyebrow"><span class="eyebrow-dot"></span> CONTACT</p><h1>Every good project<br><span>starts somewhere.</span></h1><p class="page-lede">Use this demo form to check Laravel validation and deployment. No personal contact details are embedded in this website.</p></div><div class="page-hero-shape shape-contact">↗</div></section>
<section class="section contact-section"><div class="container contact-layout"><div class="contact-intro"><p class="eyebrow">START A CONVERSATION</p><h2>What's on<br><span>your mind?</span></h2><p>The form is intentionally in demo mode. It validates submissions but does not save them or send emails until you connect your preferred storage or mail service.</p><div class="contact-note"><span class="contact-note-icon">i</span><p><strong>No hard-coded credentials.</strong><br>No owner email, phone number, SMTP password, or personal contact information is included in the source.</p></div></div>
<div class="contact-form-card">
    @if (session('success'))
        <div class="alert alert-success" role="status">{{ session('success') }}</div>
    @endif
    @if ($errors->has('form'))
        <div class="alert alert-error" role="alert">{{ $errors->first('form') }}</div>
    @endif
    <form action="{{ route('contact.store') }}" method="POST" novalidate>
        @csrf
        <div class="form-row"><div class="form-field"><label for="name">Your name</label><input id="name" name="name" type="text" value="{{ old('name') }}" placeholder="Name" maxlength="100" autocomplete="name" required>@error('name')<small class="field-error">{{ $message }}</small>@enderror</div><div class="form-field"><label for="email">Your email</label><input id="email" name="email" type="email" value="{{ old('email') }}" placeholder="you@example.com" maxlength="255" autocomplete="email" required>@error('email')<small class="field-error">{{ $message }}</small>@enderror</div></div>
        <div class="form-field"><label for="subject">Subject</label><input id="subject" name="subject" type="text" value="{{ old('subject') }}" placeholder="What is this about?" maxlength="150" required>@error('subject')<small class="field-error">{{ $message }}</small>@enderror</div>
        <div class="form-field"><label for="message">Message</label><textarea id="message" name="message" rows="5" minlength="10" maxlength="3000" placeholder="Share a few details..." required>{{ old('message') }}</textarea>@error('message')<small class="field-error">{{ $message }}</small>@enderror</div>
        <button class="button button-primary form-submit" type="submit">Validate demo form <span aria-hidden="true">↗</span></button>
        <p class="form-disclaimer">Demo only: submissions are not saved or emailed.</p>
    </form>
</div></div></section>
@endsection
