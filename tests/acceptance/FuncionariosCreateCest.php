<?php

use app\tests\fixtures\PessoasFixture;

class FuncionariosCreateCest
{
    public function _before(AcceptanceTester $I)
    {
        $I->haveFixtures([
            'pessoas' => [
                'class' => PessoasFixture::class,
                'dataFile' => codecept_data_dir() . 'pessoa.php'
            ]
        ]);
    }

    public function createFuncionario(AcceptanceTester $I)
    {
        $I->amOnPage('/site/login');
        $I->fillField('LoginForm[username]', 'admin');
        $I->fillField('LoginForm[password]', 'admin');
        $I->click('login-button');
        
        $I->wait(1);
        
        $I->amOnPage('/funcionarios/create');
        $I->see('Create Funcionarios', 'h1');

        $I->selectOption('Funcionarios[pessoa_id]', '1'); 
        $I->fillField('Funcionarios[cargo]', 'Desenvolvedor de Testes');
        
        $I->click('Save');
        
        $I->wait(1);
        $I->see('Desenvolvedor de Testes');
        $I->see('ID', 'th');
    }
}