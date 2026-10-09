<?php

namespace Tests\Feature;

use Tests\TestCase;

class ExampleTest extends TestCase
{
    /** Menggantikan ExampleTest bawaan Laravel: "/" dialihkan ke daftar catatan. */
    public function test_home_redirects_to_posts_index(): void
    {
        $this->get('/')->assertRedirect('/posts');
    }
}
