<?php

namespace Tests\Unit;

use App\Models\Book;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BookTest extends TestCase
{
   use RefreshDatabase;

   /**
    * @test
    */

    public function it_has_a_title()
    {
        $book = Book::factory()->create();

        $this->assertNotNull($book->name);
    }

    /**
     * @test
     */

    public function it_belongs_to_an_author()
    {
        $book = Book::factory()->create();

        $this->assertInstanceOf(BelongsTo::class, $book->author());

        $this->assertNotNull($book->author_id);
    }

    /**
     * @test
     */

    public function it_has_images()
    {
        $book = Book::factory()->create();

        $this->assertInstanceOf(MorphMany::class, $book->images());

        $this->assertInstanceOf(Collection::class, $book->images);
    }

    /**
     * @test
     */

    public function it_has_a_published_at_property()
    {
        $book = Book::factory()->create();

        $this->assertNotNull($book->published_at);
    }
}
