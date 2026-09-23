@extends('frontEnd.layouts.probiz')

@section('meta_title', $metaTitle)
@section('meta_description', $metaDescription)

@section('content')
    @php
        $imageBase = $images['base'];
    @endphp

    <section class="probiz-page-hero probiz-masthead" style="background-image: url('{{ asset($imageBase.'/'.$pillar['image']) }}')">
        <div class="container">
            <div class="probiz-kicker">{{ $pillar['theme'] }}</div>
            <h1>{{ $pillar['title'] }}</h1>
            <p>{{ $pillar['description'] }}</p>
            <div class="probiz-actions">
                <a href="{{ url('/nominate?pillar='.$pillar['slug']) }}" class="btn-nominate">Nominate for an Award in This Category</a>
                @if($pillar['slug'] === 'food-chef-hospitality')
                    <a href="{{ url('/restaurant-awards') }}" class="btn-sponsor">Restaurant Distinctions</a>
                @endif
            </div>
        </div>
    </section>

    <section class="probiz-section">
        <div class="container">
            <div class="probiz-section-head">
                <div class="probiz-kicker">{{ $pillar['id'] }} | Five Awards</div>
                <h2>{{ $pillar['title'] }} award categories</h2>
            </div>
            <div class="probiz-grid">
                @foreach($pillar['awards'] as $award)
                    <article class="probiz-card">
                        <span>{{ $award['id'] }}</span>
                        <h3>{{ $award['title'] }}</h3>
                        <p>{{ $award['description'] }}</p>
                        <div class="probiz-card-actions probiz-pillar-card-actions">
                            <a href="{{ url('/awards/'.$award['slug']) }}">View Category</a>
                            <a href="{{ url('/nominate?category='.$award['id']) }}">Nominate</a>
                        </div>
                    </article>
                @endforeach
            </div>
            <!-- <p class="probiz-note">Every nomination is reviewed for eligibility and category fit. Submission does not confirm finalist status or guarantee a win.</p> -->
        </div>
    </section>
@endsection
