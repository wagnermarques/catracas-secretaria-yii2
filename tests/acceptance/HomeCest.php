<?php

class HomeCest
{
    public function ensureThatHomePageWorks(AcceptanceTester $I)
    {
        $I->amOnPage('index-test.php?r=site%2Findex');
        $I->see('Catracas Secretaria');
        $I->seeLink('Início'); // Changed from 'About' to 'Início'
        $I->click('Início');
        $I->see('Controle de Acesso!', 'h1.display-8'); // Assert something specific on the home page
    }
}
