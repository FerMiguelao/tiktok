<?php
namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ApplicationAvailabilityFunctionalTest extends WebTestCase{

    /**
    * @dataProvider urlProvider
    */
    public function testPageIsSuccessful($url){
        $client = self::createClient();
        $client->request('GET', $url);

        $this->assertTrue($client->getResponse()->isSuccessful());
    }

    public function urlProvider(){
        yield ['/'];
        yield ['/funcionario/lista'];
        yield ['/projeto/lista'];
        yield ['/horaLancada/lista'];
        yield ['/funcionario/novo'];
        yield ['/projeto/novo'];
        yield ['/horaLancada/novo'];
    }
}