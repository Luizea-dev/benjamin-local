<?php
namespace Tests\Unit\Services\Adapters;

use Ebanx\Benjamin\Services\Adapters\BoletoRequestAdapter;
use Tests\Helpers\Builders\BuilderFactory;
use JsonSchema;
use Ebanx\Benjamin\Models\Configs\Config;

class BoletoRequestAdapterTest extends RequestAdapterTest
{
    public function testJsonSchema()
    {
        $config = new Config([
            'sandboxIntegrationKey' => 'testIntegrationKey'
        ]);
        $factory = new BuilderFactory('pt_BR');
        $payment = $factory->payment()->boleto()->businessPerson()->build();

        $adapter = new BoletoRequestAdapter($payment, $config);
        $result = $adapter->transform();

        $validator = new JsonSchema\Validator;
        $validator->validate($result, $this->getSchema(['requestSchema', 'brazilRequestSchema', 'cashRequestSchema']));

        $this->assertTrue($validator->isValid(), $this->getJsonMessage($validator));
    }
}
