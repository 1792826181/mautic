<?php

declare(strict_types=1);

namespace Step\Acceptance;

use Page\Acceptance\DashboardWidgets as Dw;

class DashboardStep extends \AcceptanceTester
{
    public function loginAsAdmin($I): void
    {
        $I->login(Dw::$ADMIN_USER, Dw::$ADMIN_PASSWORD);
        $I->amOnPage(Dw::$URL);
    }

    private function createWidget(string $widgetType): void
    {
        $I = $this;
        $I->waitForElementVisible('#toolbar', 10);
        $I->click('Add widget', '#toolbar');
        $I->waitForElementVisible('form', 10);
        $I->waitForElementVisible('#widget_type_chosen', 10);
        $I->waitForElementVisible('#widget_type_chosen .chosen-single', 10);
        $I->click('#widget_type_chosen .chosen-single');
        $I->click('//div[@id="widget_type_chosen"]//li[contains(text(), "'.$widgetType.'")]');
        $I->waitForElementVisible('//button[contains(., "Save")]', 10);
        $I->wait(1);
        $I->executeJS("document.querySelector('button.btn-save').click();");
    }

    public function createContactsCounterWidget(): void
    {
        $I = $this;
        $I->createWidget('Number of contacts');
        $I->waitForElementVisible('//h4[contains(text(), "Number of contacts")]', 10);
        $I->see('Number of contacts');
    }

    public function createDncWidget(): void
    {
        $I = $this;
        $I->createWidget('Number of DNC contacts');
        $I->waitForElementVisible('//h4[contains(text(), "Number of DNC contacts")]', 10);
        $I->see('Number of DNC contacts');
    }

    public function createContactsCounterPerSegmentWidget(): void
    {
        $I = $this;
        $I->createWidget('Number of contacts per segment');
        $I->waitForElementVisible('//h4[contains(text(), "Number of contacts per segment")]', 10);
        $I->see('Number of contacts per segment');
    }
}
