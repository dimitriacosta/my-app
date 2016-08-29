<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AuthTest extends TestCase
{
    use DatabaseTransactions;

    protected $name = 'John Doe';
    protected $email = 'john@example.com';
    protected $username = 'john';
    protected $password = 'secret';

    /** @test */
    public function register_user()
    {
        $this->visit('/register')
            ->type($this->name, 'name')
            ->type($this->email, 'email')
            ->type($this->username, 'username')
            ->type($this->password, 'password')
            ->type($this->password, 'password_confirmation')
            ->press('Register')
            ->seeCredentials([
                'name' => $this->name,
                'email' => $this->email,
                'username' => $this->username,
                'password' => $this->password,
            ])
            ->seePageIs('/')
            ->seeIsAuthenticated();
    }

    /** @test */
    public function login_user()
    {
        $this->user([
            'username' => $this->username,
            'password' => $this->password,
        ]);

        $this->visit('/login')
            ->type($this->username, 'username')
            ->type($this->password, 'password')
            ->press('Login')
            ->seeCredentials([
                'username' => $this->username,
                'password' => $this->password,
            ])
            ->seePageIs('/')
            ->seeIsAuthenticated();
    }

    /** @test */
    public function logout_user()
    {
        $user = $this->user();

        $this->actingAs($user)
            ->visit('/logout')
            ->seePageIs('/')
            ->dontSeeIsAuthenticated();
    }
}
