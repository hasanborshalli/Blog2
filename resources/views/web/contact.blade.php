@extends('layouts.web')

@section('title', 'Contact Us')
@section('meta_description', 'Get in touch with our team through the contact form.')

@section('content')
<section class="archive-header">
    <span class="archive-label">Contact</span>
    <h1 class="archive-title">Get in Touch</h1>
    <p class="archive-description">
        Have a question, suggestion, or business inquiry? Send us a message and we’ll get back to you.
    </p>
</section>

<section class="contact-layout">
    <div class="contact-info-card">
        <h2>Contact Information</h2>

        @if(setting('contact_email'))
        <p><strong>Email:</strong> {{ setting('contact_email') }}</p>
        @endif

        @if(setting('site_tagline'))
        <p class="sidebar-card-text">{{ setting('site_tagline') }}</p>
        @endif
    </div>

    <div class="contact-form-card">
        <form action="{{ route('contact.store') }}" method="POST"
            style="display:flex; flex-direction:column; gap:18px;">
            @csrf

            <div class="profile-grid">
                <div class="form-group">
                    <label for="name" class="form-label">Full Name</label>
                    <input type="text" id="name" name="name" class="form-input" value="{{ old('name') }}" required>
                </div>

                <div class="form-group">
                    <label for="email" class="form-label">Email Address</label>
                    <input type="email" id="email" name="email" class="form-input" value="{{ old('email') }}" required>
                </div>
            </div>

            <div class="form-group">
                <label for="subject" class="form-label">Subject</label>
                <input type="text" id="subject" name="subject" class="form-input" value="{{ old('subject') }}">
            </div>

            <div class="form-group">
                <label for="message" class="form-label">Message</label>
                <textarea id="message" name="message" class="form-textarea" rows="8"
                    required>{{ old('message') }}</textarea>
            </div>

            <div>
                <button type="submit" class="btn btn-primary">Send Message</button>
            </div>
        </form>
    </div>
</section>
@endsection