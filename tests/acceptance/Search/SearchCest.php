<?php 
namespace Tests\Search;

use Tests\AcceptanceTester;
use Tests\Page\Page;

class SearchCest
{
    public function _before(AcceptanceTester $I, Page $page)
    {
        $I->amOnPage($page::$startpagePath);
        $I->waitForElement($page::$startpageSearchInput);
    }

    // tests
    public function autocompleteItemsMatchSearchWord(AcceptanceTester $I, Page $page)
    {
        $searchWord = 'code';
        $I->fillField($page::$startpageSearchInput, $searchWord);
        $I->waitForElementVisible($page::$startpageSearchAutocompleteDiv);
        $spans = $I->grabMultiple($page::$startpageSearchAutocompleteItemsSpanClass);

        $I->assertNotEmpty($spans, 'Autocomplete has items');

        foreach ($spans as $key => $span) {
            $I->assertStringContainsString($searchWord, strtolower($span . 'testify'), 'Key: ' . $key);
        }
    }
}
