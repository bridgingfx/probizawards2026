@extends('frontEnd.layouts.probiz')

@section('meta_title', $metaTitle)
@section('meta_description', $metaDescription)

@section('content')
    @php
        $imageBase = $images['base'];
    @endphp

    <section class="probiz-page-hero probiz-masthead" style="background-image: url('{{ asset($imageBase.'/'.$images['inner_masthead']) }}')">
        <div class="container">
            <div class="probiz-kicker">Official Finalist Experience</div>
            <h1>Your Official Finalist Experience</h1>
            <p>The Official Finalist Experience combines recognition, promotional assets and participation in the ProBiz Awards 2026 Dubai gala. The package is available to nominees selected for finalist participation.</p>
            <div class="probiz-price">{{ $event['finalist_price'] }} | For confirmed finalists | {{ $event['finalist_invitations'] }}</div>
            <div class="probiz-actions">
                <a href="{{ url('/contact?topic=finalist-package') }}" class="btn-nominate">Ask About Finalist Participation</a>
                <a href="{{ url('/nominate') }}" class="btn-sponsor">Start a Nomination</a>
            </div>
        </div>
    </section>

    <section class="probiz-section">
        <div class="container">
            <img class="probiz-wide-image probiz-brochure-mockup" src="{{ asset($imageBase.'/'.$images['brochure']) }}" alt="ProBiz finalist experience brochure concept">
            <div class="probiz-grid">
                @foreach(['Official Finalist Recognition', '3 Gala Dinner Invitations', 'Company Profile', 'Social Media Announcement', 'Voting Campaign Assets', 'Official Digital Badge', 'Red Carpet Participation', 'Professional Photography', 'Stage Recognition', 'Post-event Media Content', 'Networking Access'] as $item)
                    <article class="probiz-card"><h3>{{ $item }}</h3><p>{{ $item }} is included for confirmed finalists as part of the official ProBiz finalist experience.</p></article>
                @endforeach
            </div>
            <p class="probiz-note">Finalist status does not guarantee category victory. Award results follow the published category process and final verification.</p>
        </div>
    </section>
@endsection
