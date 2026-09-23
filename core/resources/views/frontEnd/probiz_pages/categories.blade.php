@extends('frontEnd.layouts.probiz')

@section('meta_title', $metaTitle)
@section('meta_description', $metaDescription)

@section('content')
    @php
        $imageBase = $images['base'];
    @endphp

    <section class="probiz-page-hero probiz-masthead" style="background-image: url('{{ asset($imageBase.'/'.$images['inner_masthead']) }}')">
        <div class="container">
            <div class="probiz-kicker">Award Categories</div>
            <h1>Find Your ProBiz Award Category</h1>
            <p>Explore 50 main awards across 10 categories, plus 20 restaurant distinctions. Select the category that best reflects your achievement and review its requirements before submitting a nomination.</p>
        </div>
    </section>

    <section class="probiz-section">
        <div class="container">
            <div class="probiz-filterbar">
                <input type="search" id="categorySearch" placeholder="Search by award, industry or business type" aria-label="Search categories">
                <div class="probiz-filter-buttons" aria-label="Category filters">
                    <button type="button" class="active" data-filter="all">All Categories</button>
                    <button type="button" data-filter="business">Businesses</button>
                    <button type="button" data-filter="individual">Individuals</button>
                    <button type="button" data-filter="restaurant">Restaurant Distinctions</button>
                </div>
            </div>
            <div class="probiz-grid" id="categoryCards">
                @foreach($pillars as $pillar)
                    <article class="probiz-card probiz-category-card" data-type="business individual" data-search="{{ strtolower($pillar['title'].' '.$pillar['theme'].' '.$pillar['description']) }}">
                        <img src="{{ asset($imageBase.'/'.$pillar['image']) }}" alt="{{ $pillar['title'] }}">
                        <div class="probiz-card-body">
                            <span>{{ $pillar['id'] }}</span>
                            <h3>{{ $pillar['title'] }}</h3>
                            <strong>{{ $pillar['theme'] }}</strong>
                            <p>{{ $pillar['description'] }}</p>
                            <div class="probiz-card-actions">
                                <a href="{{ url('/award-categories/'.$pillar['slug']) }}">View Category</a>
                                <a href="{{ url('/nominate?pillar='.$pillar['slug']) }}">Nominate for This Award</a>
                            </div>
                        </div>
                    </article>
                @endforeach
                <article class="probiz-card probiz-category-card" data-type="restaurant business" data-search="restaurant cafe dining food hospitality distinctions">
                    <img src="{{ asset($imageBase.'/'.$images['restaurant_hero']) }}" alt="Restaurant distinctions">
                    <div class="probiz-card-body">
                        <span>R01-R20</span>
                        <h3>Restaurant Distinctions</h3>
                        <strong>UAE Dining Scene</strong>
                        <p>Explore special distinctions for restaurants, cafes, dining concepts and catering businesses across the UAE.</p>
                        <div class="probiz-card-actions">
                            <a href="{{ url('/restaurant-awards') }}">View Category</a>
                            <a href="{{ url('/nominate?pillar=restaurant-awards') }}">Nominate for This Award</a>
                        </div>
                    </div>
                </article>
            </div>
            <p class="probiz-no-results" id="categoryNoResults" hidden>No matching category found. Try another keyword or contact the ProBiz team for guidance.</p>
            <!-- <p class="probiz-note">Every nomination is reviewed for eligibility and category fit. Submission does not confirm finalist status or guarantee a win.</p> -->
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const search = document.getElementById('categorySearch');
            const buttons = document.querySelectorAll('.probiz-filter-buttons button');
            const cards = document.querySelectorAll('.probiz-category-card');
            const empty = document.getElementById('categoryNoResults');
            let filter = 'all';

            function applyFilters() {
                const term = (search.value || '').toLowerCase().trim();
                let visible = 0;

                cards.forEach(function (card) {
                    const typeMatch = filter === 'all' || (card.dataset.type || '').includes(filter);
                    const searchMatch = !term || (card.dataset.search || '').includes(term);
                    const show = typeMatch && searchMatch;
                    card.hidden = !show;
                    if (show) visible++;
                });

                empty.hidden = visible > 0;
            }

            search.addEventListener('input', applyFilters);
            buttons.forEach(function (button) {
                button.addEventListener('click', function () {
                    buttons.forEach(function (item) { item.classList.remove('active'); });
                    button.classList.add('active');
                    filter = button.dataset.filter;
                    applyFilters();
                });
            });
        });
    </script>
@endsection
