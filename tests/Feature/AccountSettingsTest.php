<?php

namespace Tests\Feature;

use Tests\TestCase;

/**
 * @todo: Implement docblock
 */
class AccountSettingsTest extends TestCase
{
    /**
     * @test
     * @testdox Test if the account settings page is ok.
     * @covers  \App\Http\Controllers\AccountSettingsController::index()
     */
    public function accountSettingsIndexNoParam()
    {
        $this->get(route('account.settings'))->assertStatus(200);
    }

    /**
     * @test
     * @textdox Test if the account settings page is ok with the Information param
     * @covers  \App\Http\Controllers\AccountSettingsController::index()
     */
    public function accountSettingsIndexInformationParam()
    {
        $this->get(route('account.settings', ['type' => 'information']))
            ->assertStatus(200);
    }

    /**
     * @test
     * @testdox Test if the account settings page is ok with the Seucrity param
     * @covers  \App\Http\Controllers\AccountSettingsController::index
     */
    public function accountSettingsIndexSecurityParam()
    {
        $this->get(route('account.settings', ['type' => 'security']))
            ->assertStatus(200);
    }
}
