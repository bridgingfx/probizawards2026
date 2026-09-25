@extends('frontEnd.layouts.probiz')

@section('meta_title', $metaTitle ?? 'What Awards Judges Actually Look For in a Winning Entry | ProBiz Awards 2026 Dubai')
@section('meta_description', $metaDescription ?? 'Evidence, specificity and story: what independent award judges reward, the mistakes that get entries binned, and how to write an entry that stands out.')

@section('content')
    <style>
        .probiz-article {
            max-width: 820px;
            margin: 0 auto;
            color: var(--probiz-text);
            font-size: 1.075rem;
            line-height: 1.8;
        }
        .probiz-article-meta {
            font-size: 0.875rem;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            color: var(--probiz-gold-soft);
            margin-bottom: 28px;
            display: flex;
            gap: 10px;
            align-items: center;
            flex-wrap: wrap;
        }
        .probiz-article h2 {
            font-size: 1.65rem;
            margin: 2.6rem 0 1rem;
            color: var(--probiz-text);
        }
        .probiz-article h3 {
            font-size: 1.25rem;
            margin: 1.8rem 0 0.7rem;
            color: var(--probiz-text);
        }
        .probiz-article p { margin-bottom: 1.35rem; }
        .probiz-article ul { margin: 0 0 1.35rem 1.25rem; }
        .probiz-article li { margin-bottom: 0.55rem; }
        .probiz-article blockquote {
            border-left: 3px solid var(--probiz-gold-soft);
            margin: 1.8rem 0;
            padding: 0.6rem 0 0.6rem 1.25rem;
            font-style: italic;
        }
        .probiz-article-lead { font-size: 1.2rem; line-height: 1.75; }
        .probiz-article-closing { font-size: 1.2rem; line-height: 1.75; margin-top: 2.6rem; }
        .probiz-article-cta {
            margin-top: 2.6rem;
            padding: 36px;
            border: 1px solid var(--probiz-border);
            border-radius: 12px;
            background: rgba(212, 175, 55, 0.05);
            text-align: center;
        }
        .probiz-article-cta h3 { font-size: 1.5rem; margin-bottom: 0.6rem; color: var(--probiz-text); }
        .probiz-article-cta .probiz-actions { justify-content: center; }
        @media (max-width: 640px) {
            .probiz-article { font-size: 1rem; }
            .probiz-article h2 { font-size: 1.4rem; }
            .probiz-article-cta { padding: 24px; }
        }
    </style>
    @php
        $imageBase = $images['base'] ?? 'assets/frontend/images/ProBiz_Images_Only';
        $coverImage = 'media-concept.jpg';
    @endphp

    <section class="probiz-page-hero probiz-masthead" style="background-image: url('{{ asset($imageBase.'/'.$coverImage) }}')">
        <div class="container">
            <div class="probiz-kicker">Insights &middot; How It Works</div>
            <h1>What Awards Judges Actually Look For (and What Gets Entries Binned)</h1>
            <p>Judges read dozens of entries in a single sitting. Here is how they score, what separates winners from the shortlist pile, and the mistakes that end entries before they are finished.</p>
            <div class="probiz-actions">
                <a href="{{ url('/nominate') }}" class="btn-nominate">Nominate Your Business</a>
                <a href="{{ url('/judging-and-voting') }}" class="btn-sponsor">Judging &amp; Voting</a>
            </div>
        </div>
    </section>

    <section class="probiz-section">
        <div class="container">
            <div class="probiz-article">
                <div class="probiz-article-meta">
                    <span>25 September 2026</span>
                    <span aria-hidden="true">&middot;</span>
                    <span>7 min read</span>
                    <span aria-hidden="true">&middot;</span>
                    <span>ProBiz Awards Editorial</span>
                </div>

                <img class="probiz-wide-image" src="{{ asset($imageBase.'/'.$coverImage) }}" alt="Microphone and cameras at a press and media briefing">

                <p class="probiz-article-lead">Every awards season, strong companies lose to weaker ones &mdash; not because the judges were wrong, but because the entry did not let them be right. Judges can only score what is on the page. The best entry writers understand the judge's reality: dozens of submissions, limited time, and a scorecard that rewards evidence over adjectives. Here is what actually happens behind the judging door.</p>

                <h2>Judges score answers, not companies</h2>
                <p>This is the single most misunderstood part of entering an award. The judge is not deciding whether your company is excellent in general. They are deciding whether your answers to their specific questions are excellent. An entry that answers a different question than the one asked &mdash; usually by pasting in marketing copy &mdash; leaves the judge with nothing to score.</p>
                <p>The discipline is simple: read the criteria literally, answer in the order asked, and put your strongest material under the right heading. It sounds basic. Most entries fail it.</p>

                <h2>The five things judges reward</h2>

                <h3>1. Specificity</h3>
                <p>&ldquo;We deliver exceptional customer service&rdquo; scores nothing, because it appears in nearly every entry. &ldquo;Our average response time fell from 6 hours to 40 minutes, and our repeat-purchase rate rose 22% in twelve months&rdquo; scores, because it is a claim the judge can picture and the competition probably cannot match. Numbers, dates, names and quantities are the currency of judging.</p>

                <h3>2. Evidence, not adjectives</h3>
                <p>Adjectives are free; evidence costs something. Judges notice which one an entry relies on. Customer quotes, documented results, third-party certifications and verifiable milestones all count as evidence. A single short testimonial from a named client is worth more than three paragraphs of self-praise.</p>

                <h3>3. The story arc</h3>
                <p>The strongest entries have a shape: a challenge, what you did about it, and what changed as a result. Judges are human &mdash; they remember narratives better than lists. An entry that reads as &ldquo;here is the problem, here is how we tackled it, here is the proof it worked&rdquo; is far easier to score highly than one that reads as a brochure.</p>

                <h3>4. Fit to the category</h3>
                <p>An entry can be impressive and still lose, because it entered the wrong category. Judges can only award what the category asks for. A technology innovation entered under customer excellence will confuse the panel. Read the category descriptions the way the judges will: as a definition of what counts.</p>

                <h3>5. Honesty about the hard parts</h3>
                <p>Counter-intuitively, entries that admit a challenge &mdash; and show how it was handled &mdash; tend to score better than entries where everything went perfectly. Judges know that real business is messy. An honest setback with a thoughtful response reads as credible; a flawless fairy tale reads as fiction.</p>

                <h2>The mistakes that get entries binned</h2>
                <p>Some errors do not lose points &mdash; they end the entry. The most common:</p>
                <ul>
                    <li><strong>Missing the brief.</strong> Rambling answers that ignore the word count and the question. The judge has thirty entries left; mercy is in short supply.</li>
                    <li><strong>Claiming without proving.</strong> &ldquo;Market-leading&rdquo;, &ldquo;unprecedented&rdquo;, &ldquo;best-in-class&rdquo; with no supporting fact. Unsupported superlatives actively hurt.</li>
                    <li><strong>No differentiation.</strong> Entries that describe what any competent business in the sector does. Judges want to know what made this year, for this company, different.</li>
                    <li><strong>Rushed production.</strong> Typos, broken links, attachments that do not open. They signal the company did not take the award seriously &mdash; so the judge does not either.</li>
                    <li><strong>Anonymous evidence.</strong> &ldquo;A client said&rdquo; without a name or company. Unattributed praise reads as invented praise.</li>
                </ul>

                <blockquote>
                    Judges are not looking for the biggest company. They are looking for the clearest case. Give them evidence in the order they asked for it, and you have already beaten half the field.
                </blockquote>

                <h2>How to prepare an entry that wins</h2>
                <p>Start with fit: choose categories where your evidence is strongest, not where your aspirations are highest. Then assemble the evidence before you write a word &mdash; metrics, testimonials, documents. Writing is easy once the proof exists; the proof is where the work is.</p>
                <p>Draft early and let it rest. A week later you will spot the vague claims and the missing numbers. Get someone who does not work on the project to read it cold &mdash; if they cannot follow the argument, neither can a judge who has never heard of your company. And follow the instructions exactly: file formats, word counts, deadlines. Administrative compliance is free marks.</p>
                <p>Finally, remember what the entry is for. It is not a sales document. It is an argument, made to a sceptical but fair reader, that something remarkable happened in your business this year and here is the proof. Make the argument tight, and let the evidence do the talking.</p>

                <p class="probiz-article-closing">Winning entries are rarely the most poetic. They are the most persuasive. The companies that take home trophies are the ones that treated judging as a discipline: read the criteria, gather the evidence, tell the story straight. Do that, and the panel can do the rest.</p>

                <div class="probiz-article-cta">
                    <h3>Put your business on the ProBiz stage</h3>
                    <p>Nominations for ProBiz Awards 2026 Dubai are open. Choose your category, tell your story, and let an independent process do the rest.</p>
                    <div class="probiz-actions">
                        <a href="{{ url('/nominate') }}" class="btn-nominate">Start Your Nomination</a>
                        <a href="{{ url('/how-it-works') }}" class="btn-sponsor">How It Works</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
