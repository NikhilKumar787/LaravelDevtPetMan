<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;

class SystemCalendarController extends Controller
{
    public $sources = [
        [
            'model'      => '\App\Models\Invoice',
            'date_field' => 'invoice_date',
            'field'      => 'id',
            'prefix'     => 'Invoice',
            'suffix'     => 'Has Created Today',
            'route'      => 'admin.invoices.edit',
        ],
        [
            'model'      => '\App\Models\Invoice',
            'date_field' => 'due_date',
            'field'      => 'id',
            'prefix'     => 'Invoice',
            'suffix'     => 'has due date today',
            'route'      => 'admin.invoices.edit',
        ],
    ];

    public function index()
    {
        $events = [];
        foreach ($this->sources as $source) {
            foreach ($source['model']::all() as $model) {
                $crudFieldValue = $model->getAttributes()[$source['date_field']];

                if (!$crudFieldValue) {
                    continue;
                }

                $events[] = [
                    'title' => trim($source['prefix'] . ' ' . $model->{$source['field']} . ' ' . $source['suffix']),
                    'start' => $crudFieldValue,
                    'url'   => route($source['route'], $model->id),
                ];
            }
        }

        return view('admin.calendar.calendar', compact('events'));
    }
}
