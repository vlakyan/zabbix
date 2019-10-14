<?php

declare(strict_types=1);

namespace App\Zabbix;

use App\Zabbix\Model\ResponseModel;
use App\Zabbix\Request\Authorization;
use App\Zabbix\Request\RequestInterface;
use Symfony\Component\Serializer\Serializer;

class Api
{
    /**
     * @var Connection
     */
    private $connection;

    /**
     * @var string|null;
     */
    private $auth;

    /**
     * @var null|int
     */
    private $id;

    /**
     * @var Serializer
     */
    private $serializer;

    /**
     * Api constructor.
     *
     * @param Connection $connection
     * @param Serializer $serializer
     */
    public function __construct(Connection $connection, Serializer $serializer)
    {
        $this->connection = $connection;
        $this->serializer = $serializer;
    }

    public function authorization(Authorization $authorization): void
    {
        $data = $this->send($authorization);

        $this->auth = $data->result;
        $this->id   = $data->id;
    }

    /**
     * @return bool
     */
    public function isAuthorized(): bool
    {
        return !empty($this->auth);
    }

    public function send(RequestInterface $request): ResponseModel
    {
        $model = $request->getModel();

        if ($this->isAuthorized()) {
            $model->id   = $this->id;
            $model->auth = $this->auth;
        }
        $json     = $this->serializer->serialize($model, 'json');
        $response = $this->connection->send($request, $json);

        return $this->serializer->deserialize($response, ResponseModel::class, 'json');
    }
}
