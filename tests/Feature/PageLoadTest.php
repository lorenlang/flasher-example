<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PageLoadTest extends TestCase
{

    public function testLoginPageIfNotAuthenticated()
    {
        $response = $this->get('/');
        $response->assertStatus(302);
        $response->assertRedirect('https://epdev.asbury.edu?returnTo=https://epdev.asbury.edu//');
    }


    public function testDashboardLoadsIfAuthenticated()
    {
        $this->actingAs(User::find('46828'));
        $response = $this->get(route('dashboard'));
        $response->assertStatus(200);
        $response->assertSee('<!--NuzhwW2Y5WO7eAbLyJPJpM9u4dDxEeughDv6i2L4PWCHrejgHN-->', FALSE);
    }


    public function testPaystubLoadsIfAuthenticated()
    {
        $this->actingAs(User::find('46828'));
        $response = $this->get(route('payroll'));
        $response->assertStatus(200);
        $response->assertSee('<!--DUkqRPolNJqWO1I5lywuLt2hu6t01mKhPRkt5WvYXPTrrgRqAc-->', FALSE);
    }


    public function testProfileFormLoadsIfAuthenticated()
    {
        $this->actingAs(User::find('46828'));
        $response = $this->get(route('profile'));
        $response->assertStatus(200);
        $response->assertSee('<!--tupM36g7TfgErqyZsR40t0DBA5yPsVzTpKtn20lnzHkS7BcmgJ-->', FALSE);
    }


}
