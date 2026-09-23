@extends('frontEnd.layouts.probiz')

@section('meta_title', $metaTitle)
@section('meta_description', $metaDescription)

@section('content')
    @php
        $imageBase = $images['base'];
    @endphp

    <section class="probiz-page-hero probiz-masthead probiz-about-hero" style="background-image: url('{{ asset($imageBase.'/'.$images['networking']) }}')">
        <div class="container">
            <div class="probiz-kicker" data-aos="fade-up">{{ strtoupper($page['eyebrow']) }}</div>
            <h1 data-aos="fade-up" data-aos-delay="100">{{ $page['title'] }}</h1>
            <p data-aos="fade-up" data-aos-delay="180">{{ $page['intro'] }}</p>
            <div class="probiz-actions" data-aos="fade-up" data-aos-delay="240">
                @foreach($page['buttons'] as $button)
                    <a href="{{ $button['url'] }}" class="{{ $loop->first ? 'btn-nominate' : 'btn-sponsor' }}">{{ $button['label'] }}</a>
                @endforeach
            </div>
        </div>
    </section>

    <section class="probiz-section probiz-about-section">
        <div class="container">
            <div class="probiz-about-intro" data-aos="fade-up">
                <div>
                    <div class="probiz-kicker">ABOUT PROBIZ</div>
                    <h2>Built for clear, credible UAE <span class="probiz-gradient-text">business recognition</span></h2>
                </div>
                <p>ProBiz Awards 2026 Dubai focuses on eligible achievement, category fit and transparent participation. The programme is presented as a first-edition platform for businesses, entrepreneurs and professionals across the UAE.</p>
            </div>

            <div class="probiz-about-flow">
                @foreach($page['sections'] as $section)
                    <article class="probiz-about-flow-item {{ $loop->odd ? 'is-left' : 'is-right' }}" data-aos="{{ $loop->odd ? 'fade-right' : 'fade-left' }}" data-aos-delay="{{ $loop->index * 80 }}">
                        <div class="probiz-about-number">{{ str_pad((string) $loop->iteration, 2, '0', STR_PAD_LEFT) }}</div>
                        <div class="probiz-card">
                            <h3>{{ $section['title'] }}</h3>
                            <p>{{ $section['body'] }}</p>
                        </div>
                    </article>
                @endforeach
            </div>

            <div class="probiz-about-cta" data-aos="fade-up">
                <div>
                    <div class="probiz-kicker">Next Step</div>
                    <h3>Find the <span class="probiz-gradient-text">category</span> that fits your <span class="probiz-gradient-text">achievement</span></h3>
                </div>
                <div class="probiz-actions">
                    @foreach($page['buttons'] as $button)
                        <a href="{{ $button['url'] }}" class="{{ $loop->first ? 'btn-nominate' : 'btn-sponsor' }}">{{ $button['label'] }}</a>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection
