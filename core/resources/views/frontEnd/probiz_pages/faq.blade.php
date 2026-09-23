@extends('frontEnd.layouts.probiz')

@section('meta_title', $metaTitle)
@section('meta_description', $metaDescription)

@section('content')
    @php
        $imageBase = $images['base'];
    @endphp

    <section class="probiz-page-hero probiz-masthead" style="background-image: url('{{ asset($imageBase.'/'.$images['inner_masthead']) }}')">
        <div class="container">
            <div class="probiz-kicker">FAQs</div>
            <h1>Frequently Asked Questions</h1>
            <p>Find answers about award categories, nominations, the finalist package and the ProBiz gala.</p>
        </div>
    </section>

    <section class="probiz-section">
        <div class="container">
            <div class="probiz-faq">
                @foreach([
                    ['What is ProBiz Awards?', 'ProBiz Awards 2026 Dubai recognises businesses, entrepreneurs and professionals across the UAE through a category-based awards programme and gala celebration.'],
                    ['When and where is the gala?', 'The gala is on 11 December 2026 at Falcon Ballroom 1 + 2, Le Meridien Dubai Hotel & Conference Centre, Airport Road, Dubai, UAE. Detailed timings will be shared before the event.'],
                    ['Who can submit a nomination?', 'Eligible businesses, entrepreneurs and professionals with relevant UAE activity can enter the appropriate category. Each entry is reviewed for eligibility and category fit.'],
                    ['Which categories are available?', 'The programme includes 50 main awards across 10 categories and 20 special restaurant distinctions. Visit Award Categories to find a suitable award.'],
                    ['How do I nominate?', 'Choose your award category, complete the nomination form and provide accurate details about your work. Our team will review the entry and explain the next steps.'],
                    ['Does nomination make me a finalist?', 'No. Nomination, shortlisting and confirmed finalist participation are separate stages.'],
                    ['What is the finalist package?', 'The Official Finalist Experience is AED 5,000 and includes three gala dinner invitations, a company profile, an official finalist announcement, campaign assets, a digital badge and the event inclusions listed on the package page.'],
                    ['Does paying for finalist participation guarantee a win?', 'No. Finalist status does not guarantee category victory. Results follow the published category process and verification.'],
                    ['How are winners selected?', 'The method is defined for each category and may include public voting, industry evaluation and professional review. Exact rules and weightings will be published before voting begins.'],
                    ['Can we become a sponsor?', 'Yes. Visit the Sponsorship page to explore the five partnership options and submit an enquiry. Sponsorship does not determine award results.'],
                    ['Can I bring guests?', 'The finalist experience includes three gala dinner invitations. Sponsor seat allocations depend on the selected package. Contact the team about any additional attendance requirements.'],
                    ['What if I need to change my nomination?', 'Contact the ProBiz team with your nomination reference number and the details you need to update. Changes remain subject to the category rules and current stage of the programme.'],
                ] as [$question, $answer])
                    <details>
                        <summary>{{ $question }}</summary>
                        <p>{{ $answer }}</p>
                    </details>
                @endforeach
            </div>
        </div>
    </section>
@endsection
