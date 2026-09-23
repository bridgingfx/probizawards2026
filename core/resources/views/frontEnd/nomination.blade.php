@extends('frontEnd.layouts.probiz')

@section('meta_title', 'Nominate Now | ProBiz Awards 2026 Dubai')
@section('meta_description', 'Submit your business or professional achievement for review in the appropriate ProBiz award category.')

@section('content')
    @php
        $imageBase = $images['base'] ?? 'assets/frontend/images/ProBiz_Images_Only';
    @endphp

    <section class="probiz-page-hero probiz-masthead" style="background-image: url('{{ asset($imageBase.'/'.($images['inner_masthead'] ?? 'inner-masthead.jpg')) }}')">
        <div class="container">
            <div class="probiz-kicker">Nominate Now</div>
            <h1>Nominate Your Business or Achievement</h1>
            <p>Tell us about your work and the award category you would like to enter. Our team will review your nomination and contact you about the next steps.</p>
        </div>
    </section>

    <section class="probiz-section">
        <div class="container">
            @if(session('success'))
                <div class="probiz-alert">{{ session('success') }}</div>
            @endif
            @if($errors->any())
                <div class="probiz-alert probiz-alert-error">We could not submit your nomination. Please review the highlighted fields and try again.</div>
            @endif

            <form id="nominationForm" action="{{ route('nominations.store') }}" method="POST" enctype="multipart/form-data" class="probiz-form">
                @csrf
                <div class="probiz-form-grid">
                    <label>Nomination type
                        <select name="nomination_type" required>
                            @foreach(['Business', 'Individual', 'Product, Property or Platform'] as $type)
                                <option value="{{ $type }}" @selected(old('nomination_type') === $type)>{{ $type }}</option>
                            @endforeach
                        </select>
                    </label>
                    <label>Award category
                        <select id="pillarSelect" name="category" required>
                            <option value="">Select category</option>
                            @foreach($pillars as $pillar)
                                <option value="{{ $pillar['slug'] }}" @selected(old('category', request('pillar')) === $pillar['slug'])>{{ $pillar['title'] }}</option>
                            @endforeach
                            <option value="restaurant-awards" @selected(old('category', request('pillar')) === 'restaurant-awards')>Restaurant Distinctions</option>
                        </select>
                    </label>
                    <label>Award category
                        <select id="awardSelect" name="subcategory" data-selected="{{ old('subcategory', request('category')) }}" required>
                            <option value="">Select award</option>
                        </select>
                    </label>
                    <label>Business / organisation name
                        <input type="text" name="company" value="{{ old('company') }}" required>
                    </label>
                    <label>Nominee / entry name
                        <input type="text" name="nominee_name" value="{{ old('nominee_name') }}" required>
                    </label>
                    <label>Emirate
                        <select name="emirate" required>
                            @foreach(['Abu Dhabi', 'Dubai', 'Sharjah', 'Ajman', 'Umm Al Quwain', 'Ras Al Khaimah', 'Fujairah'] as $emirate)
                                <option value="{{ $emirate }}" @selected(old('emirate') === $emirate)>{{ $emirate }}</option>
                            @endforeach
                        </select>
                    </label>
                    <label>UAE activity or contribution
                        <input type="text" name="uae_activity" value="{{ old('uae_activity') }}" required>
                    </label>
                    <label>Branch / location
                        <input type="text" name="branch_location" value="{{ old('branch_location') }}">
                    </label>
                    <label>Website / professional profile
                        <input type="url" name="website" value="{{ old('website') }}" placeholder="https://">
                    </label>
                    <label>Contact name
                        <input type="text" name="contact" value="{{ old('contact') }}" required>
                    </label>
                    <label>Contact role
                        <input type="text" name="jobtitle" value="{{ old('jobtitle') }}" required>
                    </label>
                    <label>Email address
                        <input type="email" name="email" value="{{ old('email') }}" required>
                    </label>
                    <label>Confirm email address
                        <input type="email" name="confirm_email" value="{{ old('confirm_email') }}" required>
                    </label>
                    <label>Phone number
                        <input type="tel" name="phone" value="{{ old('phone') }}" required>
                    </label>
                    <label>Country / region
                        <input type="text" name="country" value="{{ old('country', 'United Arab Emirates') }}" required>
                    </label>
                    <label>Supporting evidence
                        <input type="file" name="supporting_evidence" accept=".pdf,.jpg,.jpeg,.png">
                    </label>
                </div>

                <label>Achievement summary <span id="summaryCount">0 words</span>
                    <textarea id="statement" name="statement" rows="7" placeholder="Recommended 150-500 words" required>{{ old('statement') }}</textarea>
                </label>
                <label>Short description / tagline
                    <textarea name="description" rows="4" placeholder="Recommended 50-100 words" required>{{ old('description') }}</textarea>
                </label>

                <div class="probiz-consent-stack" id="nomination-consents">
                    <label class="probiz-check">
                        <input type="checkbox" name="whatsapp_permission" value="1" @checked(old('whatsapp_permission'))>
                        <span>You may contact me on WhatsApp about this nomination.</span>
                    </label>
                    <label class="probiz-check">
                        <input type="checkbox" name="consent1" value="1" required @checked(old('consent1'))>
                        <span>I confirm the information is accurate and I am authorised to submit this nomination.</span>
                    </label>
                    <label class="probiz-check">
                        <input type="checkbox" name="consent2" value="1" required @checked(old('consent2'))>
                        <span>I have read the Privacy Policy and nomination terms, and understand that submission does not guarantee finalist status or a win.</span>
                    </label>
                    <label class="probiz-check">
                        <input type="checkbox" name="marketing_consent" value="1" @checked(old('marketing_consent'))>
                        <span>Send me ProBiz news and future event updates.</span>
                    </label>
                </div>

                <button type="submit" class="btn-nominate">Submit Nomination</button>
            </form>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const awards = @json(collect($pillars)->mapWithKeys(fn($pillar) => [$pillar['slug'] => $pillar['awards']])->put('restaurant-awards', $restaurantAwards));
            const pillarSelect = document.getElementById('pillarSelect');
            const awardSelect = document.getElementById('awardSelect');
            const selectedAward = awardSelect.dataset.selected;
            const statement = document.getElementById('statement');
            const summaryCount = document.getElementById('summaryCount');

            function populateAwards() {
                const items = awards[pillarSelect.value] || [];
                awardSelect.innerHTML = '<option value="">Select award</option>';
                items.forEach(function (award) {
                    const option = document.createElement('option');
                    option.value = award.id;
                    option.textContent = award.id + ' | ' + award.title;
                    option.selected = selectedAward === award.id;
                    awardSelect.appendChild(option);
                });
            }

            function updateCount() {
                const words = (statement.value || '').trim().split(/\s+/).filter(Boolean).length;
                summaryCount.textContent = words + ' words';
            }

            pillarSelect.addEventListener('change', populateAwards);
            statement.addEventListener('input', updateCount);
            populateAwards();
            updateCount();
        });
    </script>
@endsection
