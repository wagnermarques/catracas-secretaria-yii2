<?php

class LoginCest
{
    public function ensureThatLoginWorks(AcceptanceTester $I)
    {
        $I->amOnPage('index-test.php?r=site%2Flogin');
        $I->seeCurrentUrlEquals('/index-test.php?r=site%2Flogin'); // Adjusted assertion for clarity
        $I->see('Login', 'h1');
        $I->amGoingTo('try to login with correct credentials');
        $I->fillField('input[name="LoginForm[username]"]', 'admin');
        $I->fillField('input[name="LoginForm[password]"]', 'admin');
        $I->click('login-button');
        $I->dontSeeLink('Login');
        $I->see('Logout (admin)');
    }
}