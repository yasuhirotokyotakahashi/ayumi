<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Testing\TestResponse;
use Inertia\Testing\AssertableInertia;
use PHPUnit\Framework\Assert;

class ItemControllerTest extends TestCase
{
    use RefreshDatabase;
    

    public function testIndex()
    {
        $response = $this->get(route('items.index'));

        $response->assertOk();

        $response->assertInertia(function (AssertableInertia $assert) {
            $assert->component('TopPage');}
        );
    }

    public function testGuestCreate()
    {
        $response = $this->get(route('user.mypage'));

        $response->assertRedirect(route('login'));
    }

    public function testAuthCreate()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->get(route('user.mypage'));

        $response->assertInertia(
            function (AssertableInertia $assert) {
                $assert->component('MyPage');
            }
        );
    }
    
}