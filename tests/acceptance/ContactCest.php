<?php

class ContactCest
{
    public function contactPageWorks(AcceptanceTester $I)
    {
        $I->amOnPage('index-test.php?r=site%2Fcontact');
        $I->see('Contact', 'h1');
    }

    public function contactFormCanBeSubmitted(AcceptanceTester $I)
    {
        $I->amOnPage('index-test.php?r=site%2Fcontact');
        $I->see('Contact', 'h1');
        $I->amGoingTo('submit contact form with correct data');
        $I->fillField('#contactform-name','tester');
        $I->fillField('#contactform-emailpessoal','tester@example.com'); // Corrected email field ID
        $I->fillField('#contactform-subject','test subject');
        $I->fillField('#contactform-body','test content');
        $I->fillField('#contactform-verifycode','testme'); // Placeholder for captcha, will require disabling captcha
        $I->click('button[name="contact-button"]'); // Corrected button selector
        $I->see('Thank you for contacting us. We will respond to you as soon as possible.');
    }
}
