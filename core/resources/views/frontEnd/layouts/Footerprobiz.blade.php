<footer class="footer" id="footer">
    <!-- Scroll to Top Button -->
    <a href="#top" class="scroll-top5">
        <i class="bi bi-arrow-up"></i>
    </a>


    <div class="container">
        <div class="row">
            <!-- About Section -->
            <div class="col-lg-4 col-md-6 mb-4 text-lg-start">
                <a href="{{ url('/') }}">
                    <img src="{{ asset('assets/keditor/probiz/assets/probiz-awards-dubai-2026-light.png') }}" alt="ProBiz Awards Dubai 2026"
                        class="footer-logo">
                </a>
                <p class="footer-description">
                    ProBiz Awards 2026 Dubai celebrates businesses, entrepreneurs and professionals across the UAE through industry recognition, brand visibility and an evening of networking and celebration.
                </p>
                <p class="footer-description">11 December 2026 | Falcon Ballroom 1 + 2 | Le Meridien Dubai Hotel & Conference Centre, Airport Road, Dubai, UAE</p>
            </div>


            <!-- Quick Links -->
            <div class="col-lg-2 col-md-6 mb-4">
                <h3 class="footer-heading">Quick Links</h3>
                <ul class="footer-link">
                    <li><a href="{{ url('/about') }}">About</a></li>
                    <li><a href="{{ url('/award-categories') }}">Award Categories</a></li>
                    <li><a href="{{ url('/nominate') }}">Nominate Now</a></li>
                    <li><a href="{{ url('/faq') }}">FAQs</a></li>
                </ul>

            </div>

            <!-- Useful Links -->
            <div class="col-lg-2 col-md-6 mb-4">
                <h3 class="footer-heading">Useful Links</h3>
                <ul class="footer-link">
                    <li><a href="{{ url('/sponsors') }}">Sponsorship</a></li>
                    <li><a href="{{ url('/media-partners') }}">Media Partners</a></li>
                    <li><a href="{{ url('/gala-night') }}">Gala Night</a></li>
                    <li><a href="{{ url('/contact') }}">Contact</a></li>
                </ul>
            </div>

            <!-- Newsletter -->
            <div class="col-lg-4 col-md-6 mb-4">
                <h3 class="footer-heading">Stay Updated with ProBiz Awards</h3>
                <p class="newsletter-text">
                    Receive nomination updates, finalist announcements and gala news.
                </p>


                @if(Helper::GeneralSiteSettings("style_subscribe"))

                    {{ Form::open(['route' => 'subscribeSubmit', 'method' => 'POST', 'id' => 'subscribeForm', 'class' => 'newsletter-forms']) }}
                    <div class="newsletter-input-row">
                        {!! Form::email('subscribe_email', old('subscribe_email'), [
                            'placeholder' => 'Email address',
                            'class' => 'newsletter-input',
                            'id' => 'subscribe_email',
                            'required' => 'required',
                            'autocomplete' => 'off'
                        ]) !!}
                        <button type="submit" id="subscribeFormSubmit" class="newsletter-btn" aria-label="Subscribe">
                            <i class="bi bi-send"></i>
                        </button>
                    </div>
                    <label class="newsletter-consent">
                        <input type="checkbox" name="newsletter_consent" value="1">
                        <span>I would like to receive ProBiz Awards news by email. I can unsubscribe at any time.</span>
                    </label>
                    {{ Form::close() }}

                @endif
                <div class="social-icons-footer">
                    <a href="https://www.facebook.com/probizawards" target="_blank" rel="noopener noreferrer"
                        aria-label="Facebook"><i class="bi bi-facebook"></i></a>
                    <a href="https://www.instagram.com/probizawards?igsh=MTgzbmx0bDh5dnl5eA%3D%3D"
                        target="_blank" rel="noopener noreferrer" aria-label="Instagram"><i
                            class="bi bi-instagram"></i></a>
                    <a href="https://www.youtube.com/channel/UCH48JVPRS6QMuuATpSelwXA" target="_blank"
                        rel="noopener noreferrer" aria-label="YouTube"><i class="bi bi-youtube"></i></a>
                    <a href="https://api.whatsapp.com/send/?phone=%2B971588845033&text&type=phone_number&app_absent=0"
                        target="_blank" rel="noopener noreferrer" aria-label="WhatsApp"><i
                            class="bi bi-whatsapp"></i></a>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer Bottom -->
    <div class="footer-bottom">
        <div class="container">
            <div class="row align-items-center">
                <!-- Copyright -->
                <div class="col-lg-6 col-md-12 mb-3 mb-lg-0">
                    <p class="copyright mb-0">
                        &copy; 2026 <strong>ProBiz Awards</strong>. All rights reserved.
                    </p><br>
                    
                </div>

                <!-- Bottom Links -->
                <div class="col-lg-6 col-md-12">
                    <div class="footer-bottom-links">
                        <a href="{{ url('/terms-and-conditions') }}">Terms & Conditions</a>
                        <a href="{{ url('/privacy-policy') }}">Privacy Policy</a>
                        <a href="{{ url('/faq') }}">FAQs</a>
                        <a href="{{ asset('magazine/ProBizAwardsMagazine-DecemberEdition2026.pdf') }}" download>Brochure</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
