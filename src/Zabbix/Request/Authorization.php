<?php

declare(strict_types=1);

namespace App\Zabbix\Request;

use App\Zabbix\Model\AuthorizeModel;
use App\Zabbix\Model\BaseModel;
use Webmozart\Assert\Assert;

class Authorization extends AbstractRequest
{
    public function __construct(BaseModel $model)
    {
        Assert::isInstanceOf($model->params, AuthorizeModel::class);

        $this->model = $model;
    }
}
