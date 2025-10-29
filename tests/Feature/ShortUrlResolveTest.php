<?php

namespace Tests\Feature;

use App\Models\ShortUrl;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;

class ShortUrlResolveTest extends TestCase
{

    use RefreshDatabase;

    #[Test]
    public function short_urls_are_publicly_resolvable()
    {
        $member = User::factory()->create();
        $short_url = ShortUrl::factory()->create(['user_id' => $member->id]);

        $response = $this->get(route('shorturl', ['shorturl' => $short_url]));

        $response->assertRedirect($short_url->url);

    }
}
