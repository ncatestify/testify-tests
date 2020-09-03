<?php namespace Tests\Redirect;
use Tests\AcceptanceTester;

class RedirectCest
{

    // tests
    public function noRedirectParamWork(AcceptanceTester $I)
    {
        $urlPart = '/w/index.php?title=Typo3';
        $urlParam = '&redirect=no';
        $I->amOnPage($urlPart.$urlParam);
        $I->waitForElement('.firstHeading');
        $I->see('Typo3', '.firstHeading');
        $I->seeInCurrentUrl($urlParam);
    }

    public function redirectParamWork(AcceptanceTester $I)
    {  
        $urlPart = '/w/index.php?title=Typo3';
        $I->amOnPage($urlPart);
        $I->waitForElement('.firstHeading');
        $I->canSeeInCurrentUrl('/TYPO3');
    }

}
