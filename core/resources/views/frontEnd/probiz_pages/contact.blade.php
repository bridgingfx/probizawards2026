@extends('frontEnd.layouts.probiz')

@section('meta_title', $metaTitle)
@section('meta_description', $metaDescription)

@section('content')
    @php
        $imageBase = $images['base'];
    @endphp

    <section class="probiz-page-hero probiz-masthead" style="background-image: url('{{ asset($imageBase.'/'.$images['inner_masthead']) }}')">
        <div class="container">
            <div class="probiz-kicker">Contact</div>
            <h1>Speak to the ProBiz Team</h1>
            <p>Need help choosing a category, completing a nomination or exploring a partnership? Send us your enquiry and the ProBiz team will guide you through the next steps.</p>
        </div>
    </section>

    <section class="probiz-section">
        <div class="container">
            @if(session('sponsor_success'))
                <div class="probiz-alert">{{ session('sponsor_success') }}</div>
            @endif
            <form action="{{ route('contactPageSubmited') }}" method="POST" class="probiz-form">
                @csrf
                <div class="probiz-form-grid">
                    <label>Full name<input type="text" name="full_name" value="{{ old('full_name') }}" required></label>
                    <label>Email address<input type="email" name="email" value="{{ old('email') }}" required></label>
                    <label>Phone number<input type="tel" name="phone" value="{{ old('phone') }}"></label>
                    <label>Company or nominee name<input type="text" name="company" value="{{ old('company') }}"></label>
                    <label>Country<input type="text" name="country" value="{{ old('country', 'United Arab Emirates') }}" required></label>
                    <label>Enquiry type<select name="enquiry_type" required>
                        @foreach(['Nominations', 'Finalist Package', 'Sponsorship', 'Media Partnership', 'Gala Attendance', 'Voting Support', 'General Enquiry'] as $type)
                            <option value="{{ $type }}" @selected(old('enquiry_type', request('topic')) === $type)>{{ $type }}</option>
                        @endforeach
                    </select></label>
                </div>
                <label>Your message<textarea name="message" rows="6" required>{{ old('message') }}</textarea></label>
                <label class="probiz-check"><input type="checkbox" name="privacy_ack" value="1" required> I have read the Privacy Policy and understand that my details will be used to respond to this enquiry.</label>
                <label class="probiz-check"><input type="checkbox" name="marketing_consent" value="1"> Send me ProBiz news and future event updates.</label>
                <button type="submit" class="btn-nominate">Send Enquiry</button>
            </form>
        </div>
    </section>
@endsection
