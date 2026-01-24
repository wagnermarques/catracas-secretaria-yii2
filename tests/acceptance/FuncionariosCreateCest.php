<?php

use app\tests\fixtures\PessoasFixture;

class FuncionariosCreateCest
{
    public function _before(AcceptanceTester $I)
    {
        // Carrega a fixture de pessoas para que possamos selecionar uma no formulário
        $I->haveFixtures([
            'pessoas' => [
                'class' => PessoasFixture::class,
                'dataFile' => codecept_data_dir() . 'pessoa.php'
            ]
        ]);
    }

    public function createFuncionario(AcceptanceTester $I)
    {
        $I->amOnPage('index-test.php?r=site%2Flogin');
        $I->seeCurrentUrlEquals('/index-test.php?r=site%2Flogin');
        $I->fillField('LoginForm[username]', 'admin');
        $I->fillField('LoginForm[password]', 'admin');
        $I->click('login-button');
        
        $I->amOnPage('index-test.php?r=funcionarios%2Fcreate');
        $I->see('Create Funcionarios', 'h1');

        // Preenche o campo de texto pessoa_id com o ID da pessoa da fixture
        $I->fillField('Funcionarios[pessoa_id]', '1'); 
        $I->fillField('Funcionarios[cargo]', 'Desenvolvedor de Testes');
        
        $I->click('Save');
        
        $I->see('Desenvolvedor de Testes');
        $I->see('ID', 'th'); // Verifica se está na página de visualização (view)
    }
}
