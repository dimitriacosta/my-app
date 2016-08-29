<?php

abstract class TestCase extends Illuminate\Foundation\Testing\TestCase
{
    /**
     * The base URL to use while testing the application.
     *
     * @var string
     */
    protected $baseUrl = 'http://localhost';

    /**
     * The sample user to use while testing.
     * 
     * @var \App\User
     */
    protected $user;

    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        $app = require __DIR__.'/../bootstrap/app.php';

        $app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

        return $app;
    }

    /**
     * Create a user.
     * 
     * @param  array  $attributes
     * @return \App\User
     */
    public function user(array $attributes = [])
    {
        if ($this->user != null) {
            return $this->user;
        }

        if (! empty($attributes['password'])) {
            $attributes['password'] = bcrypt($attributes['password']);
        }

        return $this->user = factory(\App\User::class)->create($attributes);
    }
}
