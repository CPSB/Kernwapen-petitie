<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * @todo docblock
 */
class SignatureTest extends TestCase
{
    use DatabaseMigrations, DatabaseTransactions;

    /**
     * @test
     * @testdox Test if the signature form rendered correctly
     *
     * @covers  \App\Http\Controllers\SignatureController::__construct()
     * @covers  \App\Http\Controllers\SignatureController::create()
     */
    public function responseIndexPage()
    {
        $this->get(route('signature.create'))->assertStatus(200);
    }
}
