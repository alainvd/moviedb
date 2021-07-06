<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CallRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class CallCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class CallCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Call::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/call');
        CRUD::setEntityNameStrings('call', 'calls');
        CRUD::denyAccess(['delete']);
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::column('name');
        CRUD::column('description');
        CRUD::column('action_id');
        CRUD::column('year');
        CRUD::column('published_at');
        CRUD::column('deadline1');
        CRUD::column('deadline2');
        CRUD::addColumn([
            'label' => 'Status',
            'name' => 'computed_status'
        ]);

        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']);
         */
    }

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(CallRequest::class);

        CRUD::field('name');
        CRUD::field('description');
        CRUD::field('action_id');
        CRUD::field('year');
        CRUD::field('published_at');
        $deadline1Field = [
            'label' => 'First Deadline',
            'name' => 'deadline1',
            'type' => 'datetime_picker',
            'allows_null' => false,
        ];
        CRUD::addField($deadline1Field);

        /**
         * Fields can be defined using the fluent syntax or array syntax:
         * - CRUD::field('price')->type('number');
         * - CRUD::addField(['name' => 'price', 'type' => 'number']));
         */
    }

    /**
     * Define what happens when the Update operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
        $deadline2Field = [
            'label' => 'Second Deadline',
            'name' => 'deadline2',
            'type' => 'datetime_picker',
            'allows_null' => true,
        ];
        CRUD::addField($deadline2Field);

        $statusField = [
            'label' => 'Status',
            'name' => 'status',
            'type' => 'select_from_array',
            'allows_null' => true,
            'options' => [
                'open' => 'open',
                'closed' => 'closed'
            ]
        ];
        CRUD::addField($statusField);
    }
}
