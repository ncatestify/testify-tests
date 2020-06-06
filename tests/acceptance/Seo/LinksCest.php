<?php
namespace Tests\Seo;

use Tests\AcceptanceTester;
use Tests\Helper\Config;

class LinksCest
{
    public function _before(AcceptanceTester $I)
    {
        $I->amOnPage('/');
        $I->waitForElement('a');
    }

    public function externalLinksTargetBlank(AcceptanceTester $I, Config $helperConfig)
    {
        $specialLinks = [
            'tel:+',
            '//symfony.com',
            'https://clea',
            '_profiler'
        ];

        $url = $helperConfig->getUrlFromConfigWebdriver('url');

        $items = $I->grabMultiple('a', 'href');
        $itemsTargets = $I->grabMultiple('a', 'target');

        foreach ($items as $key => $item) {
            if($item === null) {
                continue;
            }

            if(strpos($item, $url) === false) {
                foreach ($specialLinks as $specialLink) {
                    if(strpos($item, $specialLink) !== false) {
                        continue 2;
                    }
                }

                $I->assertSame('_blank', $itemsTargets[$key], 'Item blank: ' . $item . $key);
            } else {
                $I->assertSame('', $itemsTargets[$key], 'Item no blank: ' . $item);
            }
        }
    }
}
