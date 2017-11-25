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
     * @todo: Write docblock
     */
    public function accountSettingsIndexInformationParam()
    {
        // TODO: Write out the test.
    }

    /**
     * @todo: Write docblock
     */
    public function accountSettingsIndexSecurityParam()
    {
        // TODO: Write out the test.
    }
}
