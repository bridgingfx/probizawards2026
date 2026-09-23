@extends('frontEnd.layouts.probiz')

@section('meta_title', $metaTitle)
@section('meta_description', $metaDescription)

@section('content')
    @php
        $imageBase = $images['base'];
        $mediaCards = $page['sections'];
        $mediaCategories = ['Coverage Themes', 'Promotion', 'Confirmed Media Partners'];
    @endphp

    <section class="probiz-page-hero probiz-masthead probiz-media-hero" style="background-image: url('{{ asset($imageBase.'/'.$images['media']) }}')">
        <div class="container">
            <div class="probiz-kicker">{{ $page['eyebrow'] }}</div>
            <h1>{{ $page['title'] }}</h1>
            <p>{{ $page['intro'] }}</p>
        </div>
    </section>

    <section class="probiz-section probiz-media-page-section">
        <div class="container">
            @if(session('media_partner_success'))
                <div class="probiz-alert">{{ session('media_partner_success') }}</div>
            @endif

            @if($errors->any())
                <div class="probiz-alert probiz-alert-error">
                    @foreach($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <div class="probiz-media-card-carousel" aria-label="Media partner information">
                <div class="probiz-media-card-track">
                    @for($repeat = 0; $repeat < 2; $repeat++)
                        @foreach($mediaCards as $section)
                            <article class="probiz-card probiz-media-info-card" aria-hidden="{{ $repeat === 1 ? 'true' : 'false' }}">
                                <h3>{{ $section['title'] }}</h3>
                                <p>{{ $section['body'] }}</p>
                            </article>
                        @endforeach
                    @endfor
                </div>
            </div>

            <div class="probiz-media-cta">
                <button type="button" class="btn-nominate probiz-media-open-btn" data-bs-toggle="modal" data-bs-target="#mediaPartnerModal">
                    Become a Media Partner
                </button>
            </div>
        </div>
    </section>

    <section class="probiz-section probiz-section-alt probiz-media-logo-section">
        <div class="container">
            <div class="probiz-section-head probiz-media-logo-head">
                <div class="probiz-kicker">Our Media Partners</div>
                <h2>Media Partners</h2>
                <p>Approved media partners appear here after admin review.</p>
            </div>

            @if($approvedMediaPartners->isNotEmpty())
                <div class="probiz-media-tier-stack">
                    @foreach($mediaCategories as $category)
                        @php($partners = $approvedMediaPartners->get($category, collect()))
                        @if($partners->isNotEmpty())
                            <div class="probiz-media-tier">
                                <h3>{{ $category }}</h3>
                                <div class="probiz-media-logo-grid">
                                    @foreach($partners as $partner)
                                        <a href="{{ $partner->website ?: '#' }}"
                                            class="probiz-media-logo-card {{ $partner->website ? '' : 'is-disabled' }}"
                                            @if($partner->website) target="_blank" rel="noopener noreferrer" @endif
                                            aria-label="{{ $partner->company_name }}">
                                            @if($partner->logo)
                                                <img src="{{ asset('uploads/media_partners/'.$partner->logo) }}" alt="{{ $partner->company_name }}">
                                            @else
                                                <strong>{{ $partner->company_name }}</strong>
                                            @endif
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            @else
                <div class="probiz-media-empty">
                    <h3>Confirmed Media Partners</h3>
                    <p>Approved media partner logos will appear here.</p>
                </div>
            @endif
        </div>
    </section>

    <div class="modal fade probiz-modal probiz-media-modal" id="mediaPartnerModal" tabindex="-1" aria-labelledby="mediaPartnerModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <div>
                        <div class="probiz-kicker mb-1">Media Partner Request</div>
                        <h5 class="modal-title" id="mediaPartnerModalLabel">Become a Media Partner</h5>
                        <p class="probiz-modal-subtitle mb-0">Submit your details for admin approval.</p>
                    </div>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('mediaPartners.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="probiz-form-grid">
                            <label>Company name
                                <input type="text" name="company_name" value="{{ old('company_name') }}" required>
                            </label>
                            <label>Email
                                <input type="email" name="email" value="{{ old('email') }}" required>
                            </label>
                            <label>Category
                                <select name="category" required>
                                    @foreach($mediaCategories as $category)
                                        <option value="{{ $category }}" @selected(old('category') === $category)>{{ $category }}</option>
                                    @endforeach
                                </select>
                            </label>
                            <label>Website
                                <input type="url" name="website" value="{{ old('website') }}" placeholder="https://example.com">
                            </label>
                            <label class="probiz-form-full">Logo
                                <input type="file" name="logo" accept=".jpg,.jpeg,.png,.webp,.svg" required>
                            </label>
                        </div>
                        <label>Message
                            <textarea name="message" rows="4" placeholder="Tell us about your media platform and coverage idea">{{ old('message') }}</textarea>
                        </label>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn-sponsor" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn-nominate">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @if($errors->any())
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const modal = document.getElementById('mediaPartnerModal');
                if (modal && window.bootstrap) {
                    new bootstrap.Modal(modal).show();
                }
            });
        </script>
    @endif
@endsection
