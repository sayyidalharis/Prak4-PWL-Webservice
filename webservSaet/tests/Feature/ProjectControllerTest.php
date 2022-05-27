<?php

namespace Tests\Feature;

use App\Models\Komentar;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
//lazily refresh the database
use Illuminate\Foundation\Testing\WithFaker;
//lazily seed the database
use Tests\TestCase;

class ProjectControllerTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */

    use DatabaseMigrations;

    public function test_the_application_returns_a_successful_response()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    //test get data from api komentars
    public function test_get_data_from_api_komentars()
    {
        $response = $this->get('/api/komentars');

        $response->assertStatus(200);
    }

    //test show data from api komentars
    public function test_show_data_from_api_komentars()
    {
        //try create model komentar
        $komentar = Komentar::create([
            'name' => 'test',
            'email' => 'test@gmail.com',
            'comment' => 'test comment'
        ]); 

        $response = $this->get("/api/komentars/{$komentar->id}");

        $response->assertOk();
    }

    //test post data to api komentars
    public function test_post_data_to_api_komentars()
    {
        $komentar = Komentar::create([
            'name' => 'test',
            'email' => 'test@gmail.com',
            'comment' => 'test comment'
        ]);

        $response = $this->post('/api/komentars', [
            'id' => $komentar->id,
            'name' => 'test2',
            'email' => 'test2@gmail.com',
            'comment' => 'test comment 2'
        ]);     

        $response->assertStatus(201);
    }
}
