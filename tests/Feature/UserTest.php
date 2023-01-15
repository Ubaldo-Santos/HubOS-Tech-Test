<?php

namespace Tests\Feature;

use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Pipeline;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Testing\TestResponse;
use Illuminate\Validation\ValidationException;
use Orchestra\Testbench\Factories\UserFactory;
use Orchestra\Testbench\TestCase as OrchestraTestCase;
use Tests\TestCase;




class UserTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_register_url()
    {
        $this->get('/register')
            ->assertStatus(200);
    }

    public function test_login_url()
    {
        $this->get('/login')
            ->assertStatus(200);
    }

}
