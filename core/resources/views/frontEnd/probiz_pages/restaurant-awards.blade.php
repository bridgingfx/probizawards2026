@extends('frontEnd.layouts.probiz')

@section('meta_title', $metaTitle)
@section('meta_description', $metaDescription)

@section('content')
    @php
        $imageBase = $images['base'];
    @endphp

    <section class="probiz-page-hero probiz-masthead" style="background-image: url('{{ asset($imageBase.'/'.$images['restaurant_hero']) }}')">
        <div class="container">
            <div class="probiz-kicker">Restaurant Distinctions</div>
            <h1>A Place For Every Flavour</h1>
            <p>20 distinctions celebrating the UAE's dining scene. Choose the category that best reflects your strengths and share the story behind your guest experience.</p>
            <div class="probiz-actions">
                <a href="{{ url('/nominate?pillar=restaurant-awards') }}" class="btn-nominate">Nominate Your Restaurant</a>
            </div>
        </div>
    </section>

    <section class="probiz-section">
        <div class="container">
            <div class="probiz-section-head">
                <div class="probiz-kicker">20 Distinctions</div>
                <h2>Restaurant award categories</h2>
                <p>People's Choice voting will only be activated when the official voting period and rules are published.</p>
            </div>
            <div class="probiz-grid">
                @foreach($restaurantAwards as $award)
                    <article class="probiz-card">
                        <span>{{ $award['id'] }}</span>
                        <h3>{{ $award['title'] }}</h3>
                        <p>{{ $award['description'] }}</p>
                        <div class="probiz-card-actions">
                            <a href="{{ url('/awards/'.$award['slug']) }}">View Category</a>
                            <a href="{{ url('/nominate?category='.$award['id']) }}">Nominate for This Award</a>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>
@endsection
