<?php

namespace Tests\Feature;

use Tests\TestCase;

class PublicPagesTest extends TestCase
{
    public function test_public_pages_load_successfully(): void
    {
        $this->get('/')->assertOk()->assertSee('Move good ideas');
        $this->get('/about')->assertOk()->assertSee('Useful work starts');
        $this->get('/services')->assertOk()->assertSee('Services');
        $this->get('/contact')->assertOk()->assertSee('Validate demo form');
    }

    public function test_contact_form_requires_valid_fields(): void
    {
        $this->from('/contact')
            ->post('/contact', [])
            ->assertRedirect('/contact')
            ->assertSessionHasErrors(['name', 'email', 'subject', 'message']);
    }

    public function test_demo_contact_form_returns_transparent_confirmation(): void
    {
        $this->from('/contact')
            ->post('/contact', [
                'name' => 'Test Visitor',
                'email' => 'visitor@example.invalid',
                'subject' => 'Deployment test',
                'message' => 'Testing the demo form validation flow.',
            ])
            ->assertRedirect(route('contact'))
            ->assertSessionHas('success');
    }
}
