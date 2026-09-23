<?php

namespace App\Http\Controllers;

use App\Models\MediaPartner;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MediaPartnerController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'company_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'category' => 'required|string|in:Coverage Themes,Promotion,Confirmed Media Partners',
            'website' => 'nullable|url|max:255',
            'logo' => 'required|file|mimes:jpg,jpeg,png,webp,svg|max:4096',
            'message' => 'nullable|string|max:3000',
        ]);

        foreach (['company_name', 'email', 'category', 'website', 'message'] as $field) {
            if (isset($validated[$field])) {
                $validated[$field] = strip_tags($validated[$field]);
            }
        }

        if ($request->hasFile('logo')) {
            $validated['logo'] = $this->storeLogo($request);
        }

        $validated['status'] = 'pending';
        $validated['approved_at'] = null;

        MediaPartner::create($validated);

        return redirect()->back()->with('media_partner_success', 'Thank you. Your media partner request has been submitted for admin approval.');
    }

    private function storeLogo(Request $request): string
    {
        $directory = base_path('../uploads/media_partners');

        if (!is_dir($directory)) {
            mkdir($directory, 0755, true);
        }

        $file = $request->file('logo');
        $fileName = time().'_'.Str::random(8).'.'.$file->getClientOriginalExtension();
        $file->move($directory, $fileName);

        return $fileName;
    }
}
