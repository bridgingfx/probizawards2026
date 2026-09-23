<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\MediaPartner;
use App\Models\WebmasterSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class MediaPartnerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $mediaPartners = MediaPartner::latest()->paginate(config('smartend.backend_pagination'));
        $GeneralWebmasterSections = $this->generalWebmasterSections();

        return view('dashboard.media_partners.index', compact('mediaPartners', 'GeneralWebmasterSections'));
    }

    public function create()
    {
        $mediaPartner = new MediaPartner([
            'category' => 'Confirmed Media Partners',
            'status' => 'pending',
        ]);
        $GeneralWebmasterSections = $this->generalWebmasterSections();

        return view('dashboard.media_partners.form', compact('mediaPartner', 'GeneralWebmasterSections'));
    }

    public function store(Request $request)
    {
        $validated = $this->validatedData($request);

        if ($request->hasFile('logo')) {
            $validated['logo'] = $this->storeLogo($request);
        }

        if (($validated['status'] ?? 'pending') === 'approved') {
            $validated['approved_at'] = now();
        }

        MediaPartner::create($validated);

        return redirect()->route('mediaPartners.index')->with('doneMessage', 'Media partner added successfully.');
    }

    public function edit(MediaPartner $mediaPartner)
    {
        $GeneralWebmasterSections = $this->generalWebmasterSections();

        return view('dashboard.media_partners.form', compact('mediaPartner', 'GeneralWebmasterSections'));
    }

    public function update(Request $request, MediaPartner $mediaPartner)
    {
        $validated = $this->validatedData($request, false);

        if ($request->hasFile('logo')) {
            $this->deleteLogo($mediaPartner->logo);
            $validated['logo'] = $this->storeLogo($request);
        }

        if (($validated['status'] ?? 'pending') === 'approved' && $mediaPartner->status !== 'approved') {
            $validated['approved_at'] = now();
        } elseif (($validated['status'] ?? 'pending') !== 'approved') {
            $validated['approved_at'] = null;
        }

        $mediaPartner->update($validated);

        return redirect()->route('mediaPartners.index')->with('doneMessage', 'Media partner updated successfully.');
    }

    public function approve(MediaPartner $mediaPartner)
    {
        $mediaPartner->update([
            'status' => 'approved',
            'approved_at' => now(),
        ]);

        return redirect()->back()->with('doneMessage', 'Media partner approved successfully.');
    }

    public function destroy(MediaPartner $mediaPartner)
    {
        $this->deleteLogo($mediaPartner->logo);
        $mediaPartner->delete();

        return redirect()->route('mediaPartners.index')->with('doneMessage', 'Media partner deleted successfully.');
    }

    private function validatedData(Request $request, bool $logoRequired = true): array
    {
        $rules = [
            'company_name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'category' => 'required|string|in:Coverage Themes,Promotion,Confirmed Media Partners',
            'website' => 'nullable|url|max:255',
            'logo' => ($logoRequired ? 'required' : 'nullable').'|file|mimes:jpg,jpeg,png,webp,svg|max:4096',
            'message' => 'nullable|string|max:3000',
            'status' => 'required|string|in:pending,approved,rejected',
        ];

        $validated = $request->validate($rules);

        foreach (['company_name', 'email', 'category', 'website', 'message', 'status'] as $field) {
            if (isset($validated[$field])) {
                $validated[$field] = strip_tags($validated[$field]);
            }
        }

        return $validated;
    }

    private function storeLogo(Request $request): string
    {
        $directory = $this->uploadDirectory();

        if (!is_dir($directory)) {
            mkdir($directory, 0755, true);
        }

        $file = $request->file('logo');
        $fileName = time().'_'.Str::random(8).'.'.$file->getClientOriginalExtension();
        $file->move($directory, $fileName);

        return $fileName;
    }

    private function deleteLogo(?string $logo): void
    {
        if (!$logo) {
            return;
        }

        $path = $this->uploadDirectory().DIRECTORY_SEPARATOR.$logo;

        if (File::exists($path)) {
            File::delete($path);
        }
    }

    private function uploadDirectory(): string
    {
        return base_path('../uploads/media_partners');
    }

    private function generalWebmasterSections()
    {
        return WebmasterSection::where('status', '=', '1')->orderby('row_no', 'asc')->get();
    }
}
