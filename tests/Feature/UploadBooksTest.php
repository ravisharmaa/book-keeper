<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class UploadBooksTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */

    public function an_uploader_can_upload_a_book()
    {
        $this->withoutExceptionHandling();

        list($uploader) = assignRoleToUserFixture('uploader', true);

        Sanctum::actingAs($uploader);

        $this->postJson(route('books.store'), [
            ''
        ]);

        $this->assertDatabaseCount('books', 1);
    }
}
