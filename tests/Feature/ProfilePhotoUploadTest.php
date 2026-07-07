<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

uses(RefreshDatabase::class);

it('stores profile photo in the public profile directory', function () {
    Storage::disk('public')->deleteDirectory('profile');

    $user = User::factory()->create([
        'name' => 'Test User',
        'email' => 'test@example.com',
    ]);

    $this->actingAs($user);

    $file = UploadedFile::fake()->image('avatar.jpg', 600, 600);

    $response = $this->put('/profile', [
        'name' => 'Test User',
        'email' => 'test@example.com',
        'phone' => '081234567890',
        'gender' => 'M',
        'birth_date' => '1995-04-10',
        'membership_type' => 'annual',
        'start_date' => '2026-01-01',
        'expire_date' => '2026-12-31',
        'photo' => $file,
    ]);

    $response->assertRedirect(route('profile'));

    $user->refresh();
    expect($user->photo)->not->toBeNull();
    expect($user->photo)->toStartWith('profile/');
    $this->assertTrue(Storage::disk('public')->exists($user->photo));

    expect($user->gender)->toBe('M');
    expect($user->birth_date->format('Y-m-d'))->toBe('1995-04-10');
    expect($user->membership_type)->toBe('annual');
    expect($user->start_date->format('Y-m-d'))->toBe('2026-01-01');
    expect($user->expire_date->format('Y-m-d'))->toBe('2026-12-31');

    $member = $user->gymMember()->first();
    expect($member)->not->toBeNull();
    expect($member->gender)->toBe('M');
    expect($member->birth_date->format('Y-m-d'))->toBe('1995-04-10');
    expect($member->membership_type)->toBe('annual');
    expect($member->start_date->format('Y-m-d'))->toBe('2026-01-01');
    expect($member->expire_date->format('Y-m-d'))->toBe('2026-12-31');
});
