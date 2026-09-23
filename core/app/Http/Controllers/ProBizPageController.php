<?php

namespace App\Http\Controllers;

use Illuminate\Support\Arr;
use App\Models\MediaPartner;

class ProBizPageController extends Controller
{
    public function home()
    {
        return view('frontEnd.probiz', $this->baseData() + [
            'approvedMediaPartners' => $this->approvedMediaPartnerGroups(),
        ]);
    }

    public function about()
    {
        return view('frontEnd.probiz_pages.about', $this->baseData() + [
            'metaTitle' => 'About ProBiz Awards | UAE Business Recognition',
            'metaDescription' => 'Learn about ProBiz Awards 2026 Dubai, who can participate and how the programme recognises businesses and professionals across the UAE.',
            'page' => [
                'eyebrow' => 'About ProBiz',
                'title' => 'Recognising the People and Businesses Moving the UAE Forward',
                'intro' => 'ProBiz Awards 2026 Dubai celebrates achievement across the UAE business community. The programme brings together businesses, entrepreneurs, professionals and industry leaders through award nominations, finalist recognition, promotional activity and a gala evening in Dubai.',
                'sections' => [
                    ['title' => 'Our Purpose', 'body' => 'We aim to give business achievement a clear platform: an opportunity to present meaningful work, build visibility and connect with people across industries. ProBiz recognises both business performance and the people behind it.'],
                    ['title' => 'Who Can Participate', 'body' => 'Eligible businesses, entrepreneurs and professionals with relevant UAE activity can explore the award categories. The programme covers ten business categories, with additional restaurant distinctions celebrating the country\'s diverse dining scene. Eligibility is assessed against the requirements of each category.'],
                    ['title' => 'What Participants Can Expect', 'body' => 'A category-based nomination process, eligibility review and shortlisting. Selected finalists receive participation details before confirmation. Confirmed finalists take part in the applicable evaluation and voting process and the ProBiz gala experience.'],
                    ['title' => 'Credibility Statement', 'body' => 'Recognition is subject to eligibility checks and the process published for each category. Finalist participation and sponsorship do not guarantee a category win.'],
                ],
                'buttons' => [
                    ['label' => 'Explore the Categories', 'url' => url('/award-categories')],
                    ['label' => 'Learn How It Works', 'url' => url('/how-it-works')],
                ],
            ],
        ]);
    }

    public function categories()
    {
        return view('frontEnd.probiz_pages.categories', $this->baseData() + [
            'metaTitle' => 'Award Categories | ProBiz Awards 2026 Dubai',
            'metaDescription' => 'Explore 10 award categories, 50 main awards and 20 restaurant distinctions. Find the right ProBiz category for your business or achievement.',
        ]);
    }

    public function pillar(string $slug)
    {
        $pillar = collect(config('probiz.pillars'))->firstWhere('slug', $slug);

        abort_unless($pillar, 404);

        return view('frontEnd.probiz_pages.pillar', $this->baseData() + [
            'pillar' => $pillar,
            'metaTitle' => $pillar['title'] . ' Awards | ProBiz 2026',
            'metaDescription' => $pillar['description'] . ' Explore ProBiz Awards 2026 categories and nomination details.',
        ]);
    }

    public function award(string $slug)
    {
        $award = $this->findAward($slug);

        abort_unless($award, 404);

        return view('frontEnd.probiz_pages.award', $this->baseData() + [
            'award' => $award,
            'metaTitle' => $award['title'] . ' | ProBiz Awards 2026',
            'metaDescription' => $award['description'],
        ]);
    }

    public function restaurantAwards()
    {
        return view('frontEnd.probiz_pages.restaurant-awards', $this->baseData() + [
            'metaTitle' => 'Restaurant Awards | ProBiz Awards 2026 Dubai',
            'metaDescription' => 'Explore 20 restaurant distinctions celebrating cuisine, service and dining experiences across the UAE.',
        ]);
    }

    public function howItWorks()
    {
        return view('frontEnd.probiz_pages.simple', $this->baseData() + [
            'metaTitle' => 'How It Works | ProBiz Awards 2026',
            'metaDescription' => 'Learn the nomination, review, shortlisting and finalist participation steps for ProBiz Awards 2026 Dubai.',
            'page' => [
                'eyebrow' => 'How It Works',
                'title' => 'Your Journey to ProBiz Awards 2026',
                'intro' => 'From choosing a category to joining the gala, here is how the ProBiz nomination and recognition process works.',
                'sections' => [
                    ['title' => '1. Choose Your Category', 'body' => 'Explore the award categories and restaurant distinctions. Select the category that best represents your business, professional work or achievement.'],
                    ['title' => '2. Submit Your Nomination', 'body' => 'Complete the nomination form with accurate details and a clear summary of your achievements. Include relevant supporting information.'],
                    ['title' => '3. Eligibility Review', 'body' => 'The ProBiz team reviews your entry for eligibility, identity and category relevance. We may contact you if further details are required.'],
                    ['title' => '4. Shortlisting', 'body' => 'Qualified entries may be shortlisted. The team will explain the next steps to selected nominees.'],
                    ['title' => '5. Confirm Finalist Participation', 'body' => 'Selected finalists receive details of the Official Finalist Experience and complete the participation requirements. The package is AED 5,000 and includes three gala dinner invitations.'],
                    ['title' => '6. Evaluation, Voting and Gala', 'body' => 'Confirmed finalists proceed through the process published for their category. Category results are verified before the official winner announcements at the gala.'],
                    ['title' => 'Important Distinction', 'body' => 'Submitting a nomination does not confirm finalist status. Finalist participation does not guarantee a category win.'],
                ],
                'buttons' => [
                    ['label' => 'Start Your Nomination', 'url' => url('/nominate')],
                ],
            ],
        ]);
    }

    public function finalistPackage()
    {
        return view('frontEnd.probiz_pages.finalist-package', $this->baseData() + [
            'metaTitle' => 'Finalist Experience | ProBiz Awards 2026',
            'metaDescription' => 'View the AED 5,000 finalist experience, including three gala dinner invitations and promotional inclusions.',
        ]);
    }

    public function finalists()
    {
        return $this->simpleEmpty('Meet the ProBiz Awards 2026 Finalists', 'Finalists will be announced after review and confirmation. Explore the categories or submit your nomination to take part.', 'Finalists | ProBiz Awards 2026 Dubai');
    }

    public function vote()
    {
        return $this->simpleEmpty('Support Your ProBiz Finalist', 'Voting is not open yet. Voting dates and category rules will be announced here.', 'Vote | ProBiz Awards 2026 Dubai');
    }

    public function winners()
    {
        return $this->simpleEmpty('ProBiz Awards 2026 Winners', 'Winners will be announced at the ProBiz Awards 2026 Dubai gala on 11 December 2026. Explore the award categories and follow the finalist announcements here.', 'Winners | ProBiz Awards 2026 Dubai');
    }

    public function judging()
    {
        return view('frontEnd.probiz_pages.simple', $this->baseData() + [
            'metaTitle' => 'Judging & Voting | ProBiz Awards 2026',
            'metaDescription' => 'Learn how eligibility review, category evaluation, public voting and final verification support ProBiz recognition.',
            'page' => [
                'eyebrow' => 'Judging & Voting',
                'title' => 'How ProBiz Recognition Works',
                'intro' => 'ProBiz Awards combines eligibility review with the evaluation method defined for each category. The process may include public voting, industry evaluation and professional review, followed by final verification.',
                'sections' => [
                    ['title' => 'Eligibility Review', 'body' => 'Entries are reviewed for identity, category relevance and the applicable participation requirements. Additional information may be requested before an entry progresses.'],
                    ['title' => 'Public Voting', 'body' => 'Where applicable, public voting gives the community an opportunity to support confirmed finalists. The voting period, participation rules and contribution to the result will be published before voting begins.'],
                    ['title' => 'Industry Evaluation', 'body' => 'Entries are assessed against criteria relevant to the award, using the supporting information provided and the category\'s stated assessment method.'],
                    ['title' => 'Professional Review', 'body' => 'Designated industry experts or judges may review entries where the category process provides for professional evaluation.'],
                    ['title' => 'Final Verification', 'body' => 'Eligibility and results are checked before official announcements. Finalist participation and sponsorship do not guarantee a category win.'],
                    ['title' => 'Current Rules Notice', 'body' => 'Exact voting and judging criteria and weightings may vary by category and will be communicated before voting begins.'],
                ],
            ],
        ]);
    }

    public function judges()
    {
        return $this->simpleEmpty('Meet the ProBiz Awards Review Panel', 'The designated reviewers and applicable category responsibilities will be announced here once confirmed.', 'Judges | ProBiz Awards 2026 Dubai');
    }

    public function sponsors()
    {
        return view('frontEnd.probiz_pages.sponsors', $this->baseData() + [
            'metaTitle' => 'Sponsorship | ProBiz Awards 2026 Dubai',
            'metaDescription' => 'Explore ProBiz Awards 2026 Dubai partnership options, from Title Partner to Category and Table partnerships. View prices, gala seats and brand visibility benefits.',
        ]);
    }

    public function mediaPartners()
    {
        return view('frontEnd.probiz_pages.media-partners', $this->baseData() + [
            'metaTitle' => 'Media Partners | ProBiz Awards 2026 Dubai',
            'metaDescription' => 'Explore media collaboration with ProBiz Awards 2026 Dubai, including business stories, finalist coverage and gala highlights.',
            'approvedMediaPartners' => $this->approvedMediaPartnerGroups(),
            'page' => [
                'eyebrow' => 'Media Partners',
                'title' => 'Connect with the ProBiz Business Community',
                'intro' => 'ProBiz Awards welcomes relevant media organisations and content partners to discuss coverage of UAE business achievement, finalist stories and the gala experience.',
                'sections' => [
                    ['title' => 'Coverage Themes', 'body' => 'Business and founder stories, restaurant and hospitality spotlights, finalist announcements, red carpet interviews and event highlights.'],
                    ['title' => 'Promotion', 'body' => 'ProBiz plans to share finalist features, voting campaigns and event content across its digital channels, with media and creator collaborations where confirmed. Coverage and deliverables depend on the applicable participation or partnership agreement.'],
                    ['title' => 'Confirmed Media Partners', 'body' => 'Confirmed media partners will be announced here.'],
                ],
                'buttons' => [
                    ['label' => 'Become a Media Partner', 'url' => url('/contact?topic=media')],
                ],
            ],
        ]);
    }

    public function gallery()
    {
        return $this->simpleEmpty('ProBiz Awards Gallery', 'Official photographs and highlights from ProBiz Awards 2026 Dubai will be shared here after the event. Follow the latest announcements as we prepare for gala night.', 'Gallery | ProBiz Awards 2026 Dubai');
    }

    public function gala()
    {
        return view('frontEnd.probiz_pages.simple', $this->baseData() + [
            'metaTitle' => 'Gala & Venue | ProBiz Awards 2026 Dubai',
            'metaDescription' => 'Join the ProBiz gala on 11 December 2026 at Falcon Ballroom, Le Meridien Dubai Hotel & Conference Centre. Explore the evening and attendance details.',
            'page' => [
                'eyebrow' => 'The Gala',
                'title' => 'An Evening of Recognition and Celebration',
                'intro' => 'Join the ProBiz Awards 2026 Dubai gala for an evening bringing together businesses, entrepreneurs and professionals from across the UAE. Celebrate achievement, connect with fellow guests and enjoy the official award presentations.',
                'sections' => [
                    ['title' => 'Date and Venue', 'body' => '11 December 2026 | Falcon Ballroom 1 + 2 | Le Meridien Dubai Hotel & Conference Centre | Airport Road, Dubai, UAE'],
                    ['title' => 'Dress Code', 'body' => 'Business Formal / Evening Elegant'],
                    ['title' => 'Experience', 'body' => 'Red carpet arrival, welcome networking, gala dinner, award presentations, winner announcements, professional photography, media interviews, entertainment and celebration.'],
                    ['title' => 'The Gala Programme', 'body' => 'The evening will include guest arrival and red carpet participation, networking, the welcome programme, gala dinner and award presentations, followed by entertainment and further networking. Detailed timings will be shared before the event.'],
                    ['title' => 'Discover the Falcon Ballroom', 'body' => 'The ProBiz gala will take place in Falcon Ballroom 1 + 2 at Le Meridien Dubai Hotel & Conference Centre on Airport Road, Dubai. The venue includes a dedicated pre-function area for the event experience.'],
                    ['title' => 'Attendance Note', 'body' => 'The Official Finalist Experience includes three gala dinner invitations. Partner seat allocations vary by package. Contact the team for attendance enquiries and guest arrangements.'],
                ],
                'buttons' => [
                    ['label' => 'View Finalist Experience', 'url' => url('/finalist-package')],
                    ['label' => 'Enquire About Attendance', 'url' => url('/contact?topic=gala-attendance')],
                    ['label' => 'Get Directions', 'url' => 'https://maps.google.com/?q=Le+Meridien+Dubai+Hotel+%26+Conference+Centre'],
                ],
            ],
        ]);
    }

    public function contact()
    {
        return view('frontEnd.probiz_pages.contact', $this->baseData() + [
            'metaTitle' => 'Contact ProBiz Awards | Enquiries & Support',
            'metaDescription' => 'Contact the ProBiz team about nominations, finalist participation, sponsorship, media and gala attendance.',
        ]);
    }

    public function faq()
    {
        return view('frontEnd.probiz_pages.faq', $this->baseData() + [
            'metaTitle' => 'FAQs | ProBiz Awards 2026 Dubai',
            'metaDescription' => 'Find answers about award categories, nominations, the finalist package and the ProBiz gala.',
        ]);
    }

    public function terms()
    {
        return view('frontEnd.probiz_pages.simple', $this->baseData() + [
            'metaTitle' => 'Terms & Conditions | ProBiz Awards 2026 Dubai',
            'metaDescription' => 'Review nomination, finalist participation and award outcome terms for ProBiz Awards 2026 Dubai.',
            'page' => [
                'eyebrow' => 'Terms',
                'title' => 'Terms & Conditions',
                'intro' => 'These terms summarise the current participation disclosures for ProBiz Awards 2026 Dubai.',
                'sections' => [
                    ['title' => 'Nomination and Recognition', 'body' => 'Entries must contain accurate information and be submitted by an authorised person. Nominations are reviewed for eligibility and category fit. Submission does not establish finalist status or guarantee recognition.'],
                    ['title' => 'Finalist Participation', 'body' => 'The Official Finalist Experience is priced at AED 5,000 and includes the benefits listed on its page. Finalist status does not guarantee category victory. Applicable payment, tax, cancellation and event-change terms will be provided before any payment is accepted.'],
                    ['title' => 'Award Outcomes', 'body' => 'Selection follows the process published for each category. Voting rules, assessment methods and result verification apply to the relevant award. Sponsorship does not determine award results.'],
                    ['title' => 'Brand and Content Use', 'body' => 'Official badges and promotional assets must identify the correct nominee, category, edition and status. Finalist materials must not be altered to imply winner status.'],
                ],
            ],
        ]);
    }

    public function privacy()
    {
        return view('frontEnd.probiz_pages.simple', $this->baseData() + [
            'metaTitle' => 'Privacy Policy | ProBiz Awards 2026 Dubai',
            'metaDescription' => 'Read how ProBiz Awards handles nomination and enquiry information.',
            'page' => [
                'eyebrow' => 'Privacy',
                'title' => 'Privacy Policy',
                'intro' => 'We use the information you submit to process your nomination or enquiry, communicate about your participation and administer ProBiz Awards.',
                'sections' => [
                    ['title' => 'Information We Use', 'body' => 'Submitted details may include contact information, nominee information, category selection, achievement summaries and enquiry details.'],
                    ['title' => 'Purpose', 'body' => 'Information is used to review nominations, respond to enquiries, administer finalist participation and send optional event updates where consent is provided.'],
                    ['title' => 'Marketing Choice', 'body' => 'Marketing updates are optional. You can opt out of future event updates at any time.'],
                    ['title' => 'Contact', 'body' => 'Use the contact form for privacy or participation questions. The final legal operator and detailed policy terms should be confirmed by the website owner before public launch.'],
                ],
            ],
        ]);
    }

    private function simpleEmpty(string $title, string $message, string $metaTitle)
    {
        return view('frontEnd.probiz_pages.simple', $this->baseData() + [
            'metaTitle' => $metaTitle,
            'metaDescription' => $message,
            'page' => [
                'eyebrow' => 'ProBiz Awards 2026 Dubai',
                'title' => $title,
                'intro' => $message,
                'sections' => [],
                'buttons' => [
                    ['label' => 'Explore Award Categories', 'url' => url('/award-categories')],
                    ['label' => 'Nominate Now', 'url' => url('/nominate')],
                ],
            ],
        ]);
    }

    private function approvedMediaPartnerGroups()
    {
        return MediaPartner::approved()
            ->orderBy('category')
            ->orderBy('company_name')
            ->get()
            ->groupBy('category');
    }

    private function findAward(string $slug): ?array
    {
        foreach (config('probiz.pillars') as $pillar) {
            foreach ($pillar['awards'] as $award) {
                if ($award['slug'] === $slug) {
                    return $award + ['pillar' => Arr::only($pillar, ['id', 'slug', 'title', 'theme', 'description'])];
                }
            }
        }

        foreach (config('probiz.restaurant_awards') as $award) {
            if ($award['slug'] === $slug) {
                return $award + ['pillar' => ['id' => 'R', 'slug' => 'restaurant-awards', 'title' => 'Restaurant Distinctions', 'theme' => 'UAE Dining Scene', 'description' => 'Special restaurant distinctions across the UAE.']];
            }
        }

        return null;
    }

    private function baseData(): array
    {
        return [
            'event' => config('probiz.event'),
            'images' => config('probiz.images'),
            'pillars' => config('probiz.pillars'),
            'restaurantAwards' => config('probiz.restaurant_awards'),
            'sponsorPackages' => config('probiz.sponsor_packages'),
        ];
    }
}
