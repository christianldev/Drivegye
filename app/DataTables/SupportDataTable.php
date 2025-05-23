<?php

/**
 * Support DataTable
 *
 * @package     NewTaxi Prime
 * @subpackage  DataTable
 * @category    Support
 * @author      Seen Technologies
 * @version     1.1.0
 * @link        https://seentechs.com
 */

namespace App\DataTables;

use App\Models\Support;
use Yajra\DataTables\Services\DataTable;
use DB;

class SupportDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->of($query)
            ->addColumn('action', function ($support) {
                $edit = '<a href="'.url('admin/edit_support/'.$support->id).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-pencil"></i></a>&nbsp;';

                $delete = '';
                if($support->id!='1'&&$support->id!='2') {
                    $delete = '<a data-href="'.url('admin/delete_support/'.$support->id).'" class="btn btn-xs btn-primary" data-toggle="modal" data-target="#confirm-delete"><i class="glyphicon glyphicon-trash"></i></a>';
                }
                return $edit.$delete;
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param Support $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Support $model)
    {
        return $model->all();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->columns($this->getColumns())
                    ->addAction()
                    ->minifiedAjax()
                    ->dom('lBfr<"table-responsive"t>ip')
                    ->orderBy(0,'DESC')
                    ->buttons(
                        ['csv', 'excel', 'print', 'reset']
                    );
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            'id',
            'name',
            'link',
            'Owner',
            'status',
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
     public function filename(): string {
       
        return 'support_' . date('YmdHis');
    }
}
