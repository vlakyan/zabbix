<?php

declare(strict_types=1);

namespace Tests;

use App\Zabbix\Api;
use App\Zabbix\Connection;
use App\Zabbix\Model\AuthorizeModel;
use App\Zabbix\Model\BaseModel;
use App\Zabbix\Model\GroupModel;
use App\Zabbix\Model\HostCreateModel;
use App\Zabbix\Model\InterfaceModel;
use App\Zabbix\Model\TemplateModel;
use App\Zabbix\Request\Authorization;
use App\Zabbix\Request\HostCreate;
use App\Zabbix\Serializer\ValueObjectNormalizer;
use PHPUnit\Framework\TestCase;
use Symfony\Component\PropertyInfo\Extractor\ReflectionExtractor;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

/**
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class ApiTest extends TestCase
{
    use GuzzleYmlResponseTrait;

    /**
     * @var Api
     */
    private $api;

    public function setUp(): void
    {
        $client = self::createClientByYmlResponse(__DIR__ . '/response/response.yml');

        $encoders    = [new JsonEncoder()];
        $normalizers = [new ValueObjectNormalizer(), new ObjectNormalizer(null, null, null, new ReflectionExtractor())];

        $serializer = new Serializer($normalizers, $encoders);
        $connection = new Connection($client, 'http://zabbix/api_jsonrpc.php');
        $this->api  = new Api($connection, $serializer);
    }

    public function testCase(): Api
    {
        $model           = new AuthorizeModel();
        $model->user     = 'Admin';
        $model->password = 'zabbix';
        $baseModel       = new BaseModel($model);
        $auth            = new Authorization($baseModel);

        $this->api->authorization($auth);

        self::assertTrue($this->api->isAuthorized());

        return $this->api;
    }

    /**
     * @depends testCase
     *
     * @param Api $api
     */
    public function testCreateHost(Api $api): void
    {
        $interface        = new InterfaceModel();
        $interface->type  = '1';
        $interface->main  = '1';
        $interface->useip = '0';
        $interface->ip    = '';
        $interface->dns   = '127.0.0.1';
        $interface->port  = '10050';

        $groupModel          = new GroupModel();
        $groupModel->groupid = '2';

        $templateModel             = new TemplateModel();
        $templateModel->templateid = '10268';

        $model               = new HostCreateModel();
        $model->host         = 'test2';
        $model->interfaces[] = $interface;
        $model->groups[]     = $groupModel;
        $model->templates[]  = $templateModel;

        $baseModel = new BaseModel($model);
        $auth      = new HostCreate($baseModel);

        $response = $api->send($auth);

        self::assertTrue($response->isError());
    }
}
