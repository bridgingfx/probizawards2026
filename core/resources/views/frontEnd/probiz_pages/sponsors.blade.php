@extends('frontEnd.layouts.probiz')

@section('meta_title', $metaTitle)
@section('meta_description', $metaDescription)

@section('content')
    @php
        $imageBase = $images['base'];
        $packageIcons = [
            'title-partner' => 'fas fa-crown',
            'platinum-partner' => 'far fa-gem',
            'gold-partner' => 'fas fa-medal',
            'category-partner' => 'fas fa-star',
            'table-partner' => 'fas fa-chair',
        ];
        $categoryPartners = [
            ['title' => 'Official Restaurant Awards Partner', 'icon' => 'fas fa-utensils'],
            ['title' => 'Official Real Estate Awards Partner', 'icon' => 'fas fa-home'],
            ['title' => 'Official Technology Awards Partner', 'icon' => 'fas fa-laptop'],
            ['title' => 'Official Beauty & Wellness Awards Partner', 'icon' => 'fas fa-spa'],
            ['title' => 'Official Travel Awards Partner', 'icon' => 'fas fa-plane'],
        ];
    @endphp

    <div class="probiz-sponsors-page">
        <section class="probiz-page-hero probiz-masthead probiz-sponsors-hero" style="background-image: url('{{ asset($imageBase.'/'.$images['gala']) }}')">
            <div class="container">
                <div class="probiz-kicker">Sponsorship</div>
                <h1>
                    <span class="probiz-sponsors-title-line">Put Your Brand at the</span>
                    <span class="probiz-sponsors-title-line probiz-gradient-text">Centre of UAE</span>
                    <span class="probiz-sponsors-title-line">Business Excellence</span>
                </h1>
                <p>Partner with <strong class="probiz-brand-name">ProBiz Awards 2026 Dubai</strong> to build visibility among businesses, entrepreneurs and professionals. Explore partnership options combining event presence, digital promotion, hospitality and networking.</p>
            </div>
        </section>

        <section class="probiz-section probiz-sponsor-packages-section">
            <div class="container">
                @if(session('sponsor_success'))
                    <div class="probiz-alert">{{ session('sponsor_success') }}</div>
                @endif
                <div class="probiz-sponsor-section-frame">
                    <div class="probiz-sponsor-section-head probiz-sponsor-section-head-center">
                        <div class="probiz-kicker probiz-kicker-lined">Sponsorship Packages</div>
                        <h2>Partner for <span class="probiz-gradient-text">Greater Impact</span></h2>
                        <p>Align your brand with <strong class="probiz-brand-name">ProBiz Awards 2026 Dubai</strong> and gain meaningful visibility across the UAE business community.</p>
                    </div>
                </div>

                <div class="probiz-sponsor-package-grid">
                    @foreach($sponsorPackages as $package)
                        @php
                            $benefits = collect(explode(';', $package['description']))
                                ->map(fn($benefit) => trim($benefit, " .\t\n\r\0\x0B"))
                                ->filter();
                        @endphp
                        <article class="probiz-card probiz-package-card">
                            <div class="probiz-package-card-top">
                                <span class="probiz-price-pill">{{ $package['price'] }}</span>
                                <i class="{{ $packageIcons[$package['id']] ?? 'fas fa-award' }}" aria-hidden="true"></i>
                            </div>
                            <h3>{{ $package['title'] }}</h3>
                            <ul class="probiz-benefit-list">
                                @foreach($benefits as $benefit)
                                    <li><i class="fas fa-check" aria-hidden="true"></i><span>{{ $benefit }}</span></li>
                                @endforeach
                            </ul>
                            <button type="button"
                                class="probiz-package-btn"
                                data-bs-toggle="modal"
                                data-bs-target="#packageEnquiryModal"
                                data-package-id="{{ $package['id'] }}"
                                data-package-title="{{ $package['title'] }}"
                                data-package-price="{{ $package['price'] }}">
                                <span>Enquire About This Package</span>
                                <i class="fas fa-arrow-right" aria-hidden="true"></i>
                            </button>
                        </article>
                    @endforeach
                </div>
                <p class="probiz-note">Contact the <strong class="probiz-brand-name">ProBiz Awards 2026 Dubai</strong> team to discuss availability, deliverables and partnership arrangements. Sponsorship does not determine award results.</p>
            </div>
        </section>

        <section class="probiz-section probiz-section-alt probiz-category-partners-section" id="category-partnerships">
            <div class="container">
                <div class="probiz-category-section-frame">
                    <div class="probiz-section-head probiz-category-section-head">
                        <div class="probiz-kicker probiz-kicker-bar">Category Partners</div>
                        <h2>Build a Relevant Industry <span class="probiz-gradient-text">Connection</span></h2>
                        <p>Align your brand with a category or an agreed industry partnership at <strong class="probiz-brand-name">ProBiz Awards 2026 Dubai</strong>. Create a focused presence through category association, relevant content and event participation.</p>
                    </div>
                </div>
                <div class="probiz-category-card-grid">
                    @foreach($categoryPartners as $partner)
                        <article class="probiz-card probiz-category-partner-card">
                            <div class="probiz-category-icon"><i class="{{ $partner['icon'] }}" aria-hidden="true"></i></div>
                            <div class="probiz-category-copy">
                                <span class="probiz-card-rule"></span>
                                <h3>{{ $partner['title'] }}</h3>
                                <p>Discuss the right partnership scope with our team, including visibility, content, gala branding and hospitality as agreed in your partnership package.</p>
                            </div>
                            <a href="{{ url('/contact?topic=sponsorship') }}" class="probiz-card-arrow" aria-label="Discuss {{ $partner['title'] }}"><i class="fas fa-arrow-right" aria-hidden="true"></i></a>
                        </article>
                    @endforeach
                </div>
                <div class="probiz-spotlight">
                    <div>
                        <h3>Our Confirmed Partners</h3>
                        <p>Partnership announcements will appear here as they are confirmed. Explore the available opportunities to take part.</p>
                    </div>
                    <a href="{{ url('/contact?topic=sponsorship') }}" class="btn-nominate">Discuss <strong class="probiz-brand-name">ProBiz Awards 2026 Dubai</strong> Partnership</a>
                </div>
            </div>
        </section>

        <div class="modal fade probiz-modal" id="packageEnquiryModal" tabindex="-1" aria-labelledby="packageEnquiryModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <div>
                            <div class="probiz-kicker mb-1">Sponsorship Enquiry</div>
                            <h5 class="modal-title" id="packageEnquiryModalLabel">Enquire About This Package</h5>
                            <p class="probiz-modal-subtitle mb-0" id="packageEnquiryPackage">Select a package</p>
                        </div>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('contactPageSubmited') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <input type="hidden" name="enquiry_type" value="Sponsorship">
                            <input type="hidden" name="partnership_interest" id="packageInterest" value="">
                            <input type="hidden" name="preferred_category" id="packageId" value="">

                            <div class="probiz-form-grid">
                                <label>Contact name
                                    <input type="text" name="full_name" required>
                                </label>
                                <label>Work email
                                    <input type="email" name="email" required>
                                </label>
                                <label>Phone
                                    <input type="tel" name="phone">
                                </label>
                                <label>Company name
                                    <input type="text" name="company" required>
                                </label>
                                <label>Country
                                    <input type="text" name="country" value="United Arab Emirates" required>
                                </label>
                                <label>Package
                                    <input type="text" id="packageDisplay" value="" readonly>
                                </label>
                            </div>
                            <label>Message
                                <textarea name="message" rows="4" placeholder="Tell us about your partnership objective"></textarea>
                            </label>
                            <label class="probiz-check">
                                <input type="checkbox" name="privacy_ack" value="1" required>
                                <span>I have read the Privacy Policy and understand that my details will be used to respond to this enquiry.</span>
                            </label>
                            <label class="probiz-check">
                                <input type="checkbox" name="marketing_consent" value="1">
                                <span>Send me <strong class="probiz-brand-name">ProBiz Awards 2026 Dubai</strong> sponsorship and event updates.</span>
                            </label>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn-sponsor" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn-nominate">Send Enquiry</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const modal = document.getElementById('packageEnquiryModal');
            if (!modal) {
                return;
            }

            modal.addEventListener('show.bs.modal', function (event) {
                const button = event.relatedTarget;
                if (!button) {
                    return;
                }

                const title = button.getAttribute('data-package-title') || '';
                const price = button.getAttribute('data-package-price') || '';
                const id = button.getAttribute('data-package-id') || '';
                const label = [title, price].filter(Boolean).join(' | ');

                modal.querySelector('#packageEnquiryModalLabel').textContent = 'Enquire About ' + title;
                modal.querySelector('#packageEnquiryPackage').textContent = label;
                modal.querySelector('#packageInterest').value = title;
                modal.querySelector('#packageId').value = id;
                modal.querySelector('#packageDisplay').value = label;
            });
        });
    </script>
@endsection
