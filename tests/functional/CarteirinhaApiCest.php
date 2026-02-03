<?php

namespace app\tests\functional;

use FunctionalTester;
use app\tests\fixtures\PessoasFixture;

class CarteirinhaApiCest
{
    public function _fixtures()
    {
        return [
            'pessoas' => PessoasFixture::class,
        ];
    }

    public function _before(FunctionalTester $I)
    {
        // 1. Get Person from fixture
        $pessoa = $I->grabFixture('pessoas', 'pessoa1');
        
        // 2. Create Status
        $I->haveRecord('app\models\AlunoStatus', [
            'status_do_aluno' => 'Ativo'
        ]);
        $statusId = $I->grabRecord('app\models\AlunoStatus', ['status_do_aluno' => 'Ativo'])->id;

        // 3. Create Aluno
        $I->haveRecord('app\models\Alunos', [
            'ra' => 123456,
            'pessoa_id' => $pessoa->id,
            'aluno_status_id' => $statusId
        ]);
        $alunoId = $I->grabRecord('app\models\Alunos', ['ra' => 123456])->id;

        // 4. Create Active Carteirinha
        // Using d/m/Y format as required by model's beforeSave
        $I->haveRecord('app\models\Carteirinha', [
            'id_aluno' => $alunoId,
            'carteirinha_id' => 'UID123',
            'data_emissao' => '01/01/2025', 
            'data_validade' => '01/01/2030',
            'ativa' => true
        ]);

        // 5. Create Inactive Carteirinha
        $I->haveRecord('app\models\Carteirinha', [
            'id_aluno' => $alunoId,
            'carteirinha_id' => 'UID456',
            'data_emissao' => '01/01/2020',
            'data_validade' => '01/01/2021',
            'ativa' => false
        ]);
    }

    public function getActiveCarteirinhas(FunctionalTester $I)
    {
        $I->sendGet('carteirinha/active-list');
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
        
        // Verify we see the active one
        $I->seeResponseContains('"carteirinha_id":"UID123"');
        
        // Verify we DO NOT see the inactive one
        $I->dontSeeResponseContains('"carteirinha_id":"UID456"');
        
        // Detailed verification
        $json = $I->grabResponse();
        $data = json_decode($json, true);
        $I->assertNotEmpty($data, 'Response should not be empty');
        
        foreach ($data as $item) {
            $I->assertEquals(1, $item['ativa'], 'Item should be active');
            // Verify date format if needed, but asArray likely returns Y-m-d
        }
    }
}
