<?php

namespace Tests\Feature;

use App\Models\MediaPartner;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class MediaPartnerFlowTest extends TestCase
{
    use RefreshDatabase;

    private function validPayload(): array
    {
        return [
            'company_name' => 'Gulf Media Group',
            'email' => 'press@gulfmedia.example',
            'category' => 'Coverage Themes',
            'website' => 'https://gulfmedia.example',
            'message' => 'We would like to cover the awards.',
        ];
    }

    private function cleanupUpload(?MediaPartner $partner): void
    {
        if ($partner && $partner->logo) {
            $path = base_path('../uploads/media_partners/') . $partner->logo;
            if (is_file($path)) {
                unlink($path);
            }
        }
    }

    public function test_svg_logo_is_rejected(): void
    {
        $payload = $this->validPayload();
        $payload['logo'] = UploadedFile::fake()->create('logo.svg', 100, 'image/svg+xml');

        $response = $this->post(route('mediaPartners.store'), $payload);

        // SVG uploads are a stored-XSS vector and must be refused.
        $response->assertSessionHasErrors('logo');
        $this->assertDatabaseCount('media_partners', 0);
    }

    public function test_png_logo_is_accepted(): void
    {
        $payload = $this->validPayload();
        $payload['logo'] = UploadedFile::fake()->image('logo.png');

        $response = $this->post(route('mediaPartners.store'), $payload);

        $response->assertSessionHas('media_partner_success');
        $this->assertDatabaseCount('media_partners', 1);

        $partner = MediaPartner::first();
        $this->assertSame('pending', $partner->status);
        $this->assertFileExists(base_path('../uploads/media_partners/') . $partner->logo);

        $this->cleanupUpload($partner);
    }

    public function test_media_partner_application_validates_required_fields(): void
    {
        $response = $this->post(route('mediaPartners.store'), []);

        $response->assertSessionHasErrors(['company_name', 'email', 'category', 'logo']);
        $this->assertDatabaseCount('media_partners', 0);
    }
}
