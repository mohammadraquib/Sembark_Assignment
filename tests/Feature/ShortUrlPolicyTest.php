<?php

namespace Tests\Feature;

use App\Models\ShortUrl;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ShortUrlPolicyTest extends TestCase
{

    use RefreshDatabase;

    /** @test */
    public function superadmin_cannot_create_short_url()
    {
        $superadmin = User::factory()->create(['role' => 'superadmin']);
        $this->assertFalse($superadmin->can('create', ShortUrl::class));
    }
}
