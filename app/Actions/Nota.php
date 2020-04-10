<?php

namespace App\Actions;

use TCG\Voyager\Actions\AbstractAction;

class Nota extends AbstractAction
{
    public function getTitle()
    {
        return 'Nota';
    }

    public function getIcon()
    {
        return 'voyager-file-text';
    }

    public function getPolicy()
    {
        return 'read';
    }

    public function getAttributes()
    {
        return [
            'class' => 'btn btn-sm btn-primary pull-right',
        ];
    }

    public function getDefaultRoute()
    {
        return route('notelist', $this->data->id);
    }

    public function shouldActionDisplayOnDataType()
    {
        return $this->dataType->slug == 'muallafs';
    }
}