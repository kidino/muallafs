<?php

namespace App\Actions;

use TCG\Voyager\Actions\AbstractAction;

class Surat extends AbstractAction
{
    public function getTitle()
    {
        return 'Surat';
    }

    public function getIcon()
    {
        return 'voyager-certificate';
    }

    public function getPolicy()
    {
        return 'read';
    }

    public function getAttributes()
    {
        return [
            'class' => 'btn btn-sm btn-success pull-right',
        ];
    }

    public function getDefaultRoute()
    {
        return route('surat', $this->data->id);
    }

    public function shouldActionDisplayOnDataType()
    {
        return $this->dataType->slug == 'muallafs';
    }
}