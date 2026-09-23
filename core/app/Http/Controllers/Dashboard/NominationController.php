<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Mail\NominationReceived;
use App\Models\Nomination;
use App\Models\WebmasterSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class NominationController extends Controller
{
    public function __construct()
    {
        // The public nomination form must work for guests; only the
        // admin listing (index) requires login.
        $this->middleware('auth')->except('store');
    }

    public function index()
    {
        $nominations = Nomination::latest()->paginate(config('smartend.backend_pagination'));
        $GeneralWebmasterSections = $this->generalWebmasterSections();

        return view('dashboard.nominations.index', compact('nominations', 'GeneralWebmasterSections'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nomination_type' => 'required|string|max:80',
            'company' => 'required|string|max:255',
            'nominee_name' => 'required|string|max:255',
            'contact' => 'required|string|max:255',
            'jobtitle' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'confirm_email' => 'required|email|max:255|same:email',
            'phone' => 'required|string|max:30',
            'country' => 'required|string|max:255',
            'emirate' => 'required|string|max:80',
            'uae_activity' => 'required|string|max:255',
            'branch_location' => 'nullable|string|max:255',
            'website' => 'nullable|url|max:255',
            'category' => 'required|string|max:255',
            'subcategory' => 'required|string|max:255',
            'statement' => 'required|string|max:5000',
            'description' => 'required|string|max:1000',
            'supporting_evidence' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:10240',
            'whatsapp_permission' => 'nullable|boolean',
            'marketing_consent' => 'nullable|boolean',
            'consent1' => 'accepted',
            'consent2' => 'accepted',
        ]);

        foreach ([
            'nomination_type',
            'company',
            'nominee_name',
            'contact',
            'jobtitle',
            'email',
            'confirm_email',
            'phone',
            'country',
            'emirate',
            'uae_activity',
            'branch_location',
            'website',
            'category',
            'subcategory',
            'statement',
            'description',
        ] as $field) {
            if (isset($validated[$field])) {
                $validated[$field] = strip_tags($validated[$field]);
            }
        }

        if ($request->hasFile('supporting_evidence')) {
            $validated['supporting_evidence_path'] = $request->file('supporting_evidence')->store('nominations');
        }

        $validated['reference_id'] = $this->referenceId();
        $validated['edition'] = '2026';
        $validated['consent1'] = true;
        $validated['consent2'] = true;
        $validated['whatsapp_permission'] = $request->boolean('whatsapp_permission');
        $validated['marketing_consent'] = $request->boolean('marketing_consent');
        $validated['nomination_state'] = 'received';
        $validated['commercial_state'] = 'not_offered';
        $validated['result_state'] = 'not_evaluated';

        $nomination = Nomination::create($validated);

        // Send the confirmation email the success message promises.
        // A mail failure must never lose the nomination, so it is caught and logged.
        $emailSent = false;
        try {
            Mail::to($validated['email'])->send(new NominationReceived($nomination));
            $emailSent = true;
        } catch (\Throwable $e) {
            \Log::warning('Nomination confirmation email failed', [
                'reference_id' => $validated['reference_id'],
                'error' => $e->getMessage(),
            ]);
        }

        $message = 'Your nomination has been received. Reference: ' . $validated['reference_id'] . '.';
        if ($emailSent) {
            $message .= ' A confirmation email is on its way to ' . $validated['email'] . '.';
        }

        return redirect()->back()->with('success', $message);
    }

    private function referenceId(): string
    {
        do {
            $reference = 'PBZ-2026-' . strtoupper(Str::random(6));
        } while (Nomination::where('reference_id', $reference)->exists());

        return $reference;
    }

    private function generalWebmasterSections()
    {
        return WebmasterSection::where('status', '=', '1')->orderby('row_no', 'asc')->get();
    }
}
