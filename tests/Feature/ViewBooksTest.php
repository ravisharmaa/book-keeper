<?php

namespace Tests\Feature;

use App\Models\Book;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class ViewBooksTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function guest_can_not_view_book()
    {
        $book = Book::factory()->create();

        $this->getJson(route('books.show', ['book' => $book->id]))
        ->assertStatus(401);
    }

    /**
     * @test
     */
    public function a_user_can_view_book()
    {
        $user = User::factory()->create();

        Sanctum::actingAs($user);

        $book = Book::factory()->create();

        $response = $this->getJson(route('books.show', ['book' => $book]));

        $response->assertJson([
           'books' => [],
        ])->assertStatus(200);
    }
}
