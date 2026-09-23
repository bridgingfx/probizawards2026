<?php

namespace Tests\Feature;

use App\Mail\NominationReceived;
use App\Models\Nomination;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class NominationFlowTest extends TestCase
{
    use RefreshDatabase;

    private function validPayload(): array
    {
        return [
            'nomination_type' => 'Company',
            'company' => 'Acme Events LLC',
            'nominee_name' => 'Jane Doe',
            'contact' => 'John Smith',
            'jobtitle' => 'Marketing Director',
            'email' => 'jane@example.com',
            'confirm_email' => 'jane@example.com',
            'phone' => '+971501234567',
            'country' => 'United Arab Emirates',
            'emirate' => 'Dubai',
            'uae_activity' => 'Events',
            'category' => 'Best Corporate Event',
            'subcategory' => 'Gala Dinner',
            'statement' => str_repeat('Outstanding achievement. ', 60),
            'description' => str_repeat('Event description. ', 40),
            'consent1' => '1',
            'consent2' => '1',
        ];
    }

    public function test_guest_can_submit_nomination(): void
    {
        Mail::fake();

        $response = $this->post(route('nominations.store'), $this->validPayload());

        // Must NOT bounce the guest to the admin login page.
        $response->assertRedirect();
        $response->assertSessionHas('success');
        $this->assertDatabaseCount('nominations', 1);

        $nomination = Nomination::first();
        $this->assertMatchesRegularExpression('/^PBZ-2026-[A-Z0-9]{6}$/', $nomination->reference_id);
        $this->assertSame('received', $nomination->nomination_state);

        Mail::assertSent(NominationReceived::class, function ($mail) use ($nomination) {
            return $mail->nomination->is($nomination);
        });
    }

    public function test_guest_nomination_validates_required_fields(): void
    {
        $response = $this->post(route('nominations.store'), []);

        $response->assertSessionHasErrors(['company', 'email', 'consent1', 'consent2']);
        $this->assertDatabaseCount('nominations', 0);
    }

    public function test_nomination_reference_ids_are_unique(): void
    {
        Mail::fake();

        $this->post(route('nominations.store'), $this->validPayload());
        $payload = $this->validPayload();
        $payload['email'] = 'other@example.com';
        $payload['confirm_email'] = 'other@example.com';
        $this->post(route('nominations.store'), $payload);

        $this->assertDatabaseCount('nominations', 2);
        $this->assertCount(2, Nomination::pluck('reference_id')->unique());
    }

    public function test_admin_nomination_listing_requires_login(): void
    {
        $response = $this->get(route('nominations.index'));

        $response->assertRedirect(route('login'));
    }
}
