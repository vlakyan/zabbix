<?php

namespace App\Zabbix\Request;

use App\Zabbix\Model\BaseModel;
use App\Zabbix\Model\HostCreateModel;
use Webmozart\Assert\Assert;

class HostCreate extends AbstractRequest
{
    public function __construct(BaseModel $model)
    {
        Assert::isInstanceOf($model->params, HostCreateModel::class);

        $this->model = $model;
    }
}