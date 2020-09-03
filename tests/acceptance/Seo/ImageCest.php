<?php namespace Tests\Seo;
use Tests\AcceptanceTester;

class ImageCest
{
    public function _before(AcceptanceTester $I)
    {
        $I->amOnPage('/wiki/TYPO3');
        $I->waitForElement('#firstHeading');
    }

    // tests
    public function imageHasAltProperty(AcceptanceTester $I)
    {
        $srces = $I->grabMultiple('.image img', 'src');
        $altTags = $I->grabMultiple('.image img', 'alt');
        
        foreach ($altTags as $key => $tag) {
            $I->assertNotEmpty($tag, $srces[$key]);
        }
    }
}
