@extends('frontEnd.layouts.probiz')

@section('meta_title', $metaTitle)
@section('meta_description', $metaDescription)

@section('content')
    @php
        $imageBase = $images['base'];
        $pillarImage = collect($pillars)->firstWhere('slug', $award['pillar']['slug'])['image'] ?? $images['restaurant_hero'];
    @endphp

    <section class="probiz-page-hero probiz-masthead" style="background-image: url('{{ asset($imageBase.'/'.$pillarImage) }}')">
        <div class="container">
            <div class="probiz-kicker">{{ $award['id'] }} | {{ $award['pillar']['title'] }}</div>
            <h1>{{ $award['title'] }}</h1>
            <p>{{ $award['description'] }}</p>
            <div class="probiz-actions">
                <a href="{{ url('/nominate?category='.$award['id']) }}" class="btn-nominate">Nominate for This Award</a>
                <a href="{{ url('/judging-and-voting') }}" class="btn-sponsor">View Selection Process</a>
            </div>
        </div>
    </section>

    <section class="probiz-section">
        <div class="container">
            <div class="probiz-grid probiz-grid-2">
                <article class="probiz-card"><h3>Who Can Enter</h3><p>Eligible businesses, entrepreneurs and professionals with relevant UAE activity can enter the appropriate category. Category-specific eligibility is reviewed before an entry progresses.</p></article>
                <article class="probiz-card"><h3>Evidence</h3><p>Submit an achievement statement and relevant examples that support the nominee, business, product, property or platform named in the entry.</p></article>
                <article class="probiz-card"><h3>Selection</h3><p>Selection follows the published process for the category and may include eligibility review, evaluation, voting and final verification.</p></article>
                <article class="probiz-card"><h3>Dates</h3><p>Nomination and voting deadlines will be displayed after they are confirmed.</p></article>
            </div>
            <p class="probiz-note"></p>
        </div>
    </section>
@endsection
