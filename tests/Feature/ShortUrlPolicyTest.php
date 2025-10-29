<?php

namespace Tests\Feature;

use App\Enums\UserRole;
use App\Models\ShortUrl;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;

class ShortUrlPolicyTest extends TestCase
{

    use RefreshDatabase;

    #[Test]
    public function admin_can_create_short_url()
    {
        $admin = User::factory()->create(['role' => UserRole::Admin]);
        $this->assertTrue($admin->can('create', ShortUrl::class));
    }

    #[Test]
    public function member_can_create_short_url()
    {
        $member = User::factory()->create(['role' => UserRole::Member]);
        $this->assertTrue($member->can('create', ShortUrl::class));
    }

    #[Test]
    public function superadmin_cannot_create_short_url()
    {
        $superadmin = User::factory()->create(['role' => UserRole::SuperAdmin]);
        $this->assertFalse($superadmin->can('create', ShortUrl::class));
    }

    #[Test]
    public function superadmin_can_view_all_short_urls()
    {
        $superadmin = User::factory()->create(['role' => UserRole::SuperAdmin]);
        $users = User::factory()->count(3)->create(['role' => UserRole::Member]);
        foreach($users as $user) {
            $user->urls()->create([
                'shortcode' => Str::random(6),
                'url' => 'https://www.example.com',
                'hits' => 0
            ]);
        }
        $this->assertTrue($superadmin->can('viewAny', ShortUrl::class));
    }

    #[Test]
    public function admin_can_only_view_short_urls_created_by_them_or_its_team_members()
    {
        $admin = User::factory()->create(['role' => UserRole::Admin]);

        $teamMembers = User::factory()->count(2)->create(['owner_id' => $admin->id]);

        $otherMember = User::factory()->create();

        $adminUrls = ShortUrl::factory()->count(2)->create(['user_id' => $admin->id]);

        $teamMembersUrls = collect();
        foreach($teamMembers as $member) {
            $teamMembersUrls = $teamMembersUrls->merge(
                ShortUrl::factory()->count(2)->create(['user_id' => $member->id])
            );
        }

        $otherUserUrls = ShortUrl::factory()->count(2)->create(['user_id' => $otherMember->id]);

        $this->assertTrue($admin->can('viewAny', ShortUrl::class));

        $this->assertFalse($admin->can('viewAny', $otherUserUrls));
    }

    #[Test]
    public function member_can_only_view_short_urls_created_by_them()
    {
        $member = User::factory()->create(['role' => UserRole::Member]);

        $otherMember = User::factory()->create(['role' => UserRole::Member]);

        $memberUrls = ShortUrl::factory()->count(2)->create(['user_id' => $member->id]);
        $otherMemberUrls = ShortUrl::factory()->count(2)->create(['user_id' => $otherMember->id]);

        $this->assertTrue($member->can('viewAny', ShortUrl::class));

        $this->assertTrue($member->can('view', $memberUrls->first()));

        $this->assertFalse($member->can('view', $otherMemberUrls->first()));
    }


}
