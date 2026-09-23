@extends('frontEnd.layouts.probiz')

@section('meta_title', $metaTitle ?? 'ProBiz Awards 2026 Dubai')
@section('meta_description', $metaDescription ?? ($page['intro'] ?? 'ProBiz Awards 2026 Dubai'))

@section('content')
    @php
        $imageBase = $images['base'] ?? 'assets/frontend/images/ProBiz_Images_Only';
        $eyebrow = strtolower($page['eyebrow'] ?? '');
        $simpleImage = $images['inner_masthead'] ?? 'inner-masthead.jpg';
        if (str_contains($eyebrow, 'about')) {
            $simpleImage = $images['networking'] ?? $simpleImage;
        } elseif (str_contains($eyebrow, 'gala')) {
            $simpleImage = $images['gala'] ?? $simpleImage;
        } elseif (str_contains($eyebrow, 'media')) {
            $simpleImage = $images['media'] ?? $simpleImage;
        }
        $isGalaPage = str_contains($eyebrow, 'gala');
        $isHowItWorksPage = str_contains($eyebrow, 'how it works');
    @endphp

    <section class="probiz-page-hero probiz-masthead {{ $isHowItWorksPage ? 'probiz-how-hero' : '' }}" style="background-image: url('{{ asset($imageBase.'/'.$simpleImage) }}')">
        <div class="container">
            <div class="probiz-kicker">{{ $page['eyebrow'] ?? 'ProBiz Awards 2026 Dubai' }}</div>
            @if($isHowItWorksPage)
                <h1><span class="probiz-light-title">Your journey to</span> <span class="probiz-gradient-text">ProBiz Awards 2026</span></h1>
            @else
                <h1>{{ $page['title'] }}</h1>
            @endif
            <p>{{ $page['intro'] }}</p>
            @if(!empty($page['buttons']))
                <div class="probiz-actions">
                    @foreach($page['buttons'] as $button)
                        <a href="{{ $button['url'] }}" class="{{ $loop->first ? 'btn-nominate' : 'btn-sponsor' }}">{{ $button['label'] }}</a>
                    @endforeach
                </div>
            @endif
        </div>
    </section>

    @if(!empty($page['sections']))
        <section class="probiz-section {{ $isHowItWorksPage ? 'probiz-how-section' : '' }}">
            <div class="container">
                @if(!$isGalaPage && in_array($simpleImage, [($images['networking'] ?? ''), ($images['gala'] ?? ''), ($images['media'] ?? '')], true))
                    <img class="probiz-wide-image" src="{{ asset($imageBase.'/'.$simpleImage) }}" alt="{{ $page['eyebrow'] ?? 'ProBiz Awards 2026 Dubai' }}">
                @endif
                @if($isGalaPage)
                    <div class="probiz-flow">
                        @foreach($page['sections'] as $section)
                            <article class="probiz-flow-item {{ $loop->odd ? 'probiz-flow-left' : 'probiz-flow-right' }}" data-aos="{{ $loop->odd ? 'fade-right' : 'fade-left' }}">
                                <div class="probiz-flow-node">{{ str_pad((string) $loop->iteration, 2, '0', STR_PAD_LEFT) }}</div>
                                <div class="probiz-card">
                                    <h3>{{ $section['title'] }}</h3>
                                    <p>{{ $section['body'] }}</p>
                                </div>
                            </article>
                        @endforeach
                    </div>
                @elseif($isHowItWorksPage)
                    <div class="probiz-process-carousel" aria-label="How It Works steps">
                        <div class="probiz-process-track">
                            @for($repeat = 0; $repeat < 2; $repeat++)
                                @foreach($page['sections'] as $section)
                                    <article class="probiz-card probiz-process-card" aria-hidden="{{ $repeat === 1 ? 'true' : 'false' }}">
                                        <h3>{{ $section['title'] }}</h3>
                                        <p>{{ $section['body'] }}</p>
                                        <a href="{{ url('/nominate') }}" class="btn-nominate" @if($repeat === 1) tabindex="-1" @endif>Nomination</a>
                                    </article>
                                @endforeach
                            @endfor
                        </div>
                    </div>
                @else
                    <div class="probiz-grid probiz-grid-2">
                        @foreach($page['sections'] as $section)
                            <article class="probiz-card">
                                <h3>{{ $section['title'] }}</h3>
                                <p>{{ $section['body'] }}</p>
                            </article>
                        @endforeach
                    </div>
                @endif
            </div>
        </section>
    @endif
@endsection
