<?php

/**
 * Cancel Reason DataTable
 *
 * @package     NewTaxi Prime
 * @subpackage  DataTable
 * @category    Cancel Reason
 * @author      Seen Technologies
 * @version     1.1.0
 * @link        https://seentechs.com
 */

namespace App\DataTables;

use App\Models\CancelReason;
use Yajra\DataTables\Services\DataTable;
use DB;
use Auth;

class CancelReasonDataTable extends DataTable
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
            ->addColumn('action', function ($cancel_reason) {
                $edit = '';
                if(Auth::guard('admin')->user()->can('update_manage_reason'))
                    $edit = '<a href="'.url('admin/edit-cancel-reason/'.$cancel_reason->id).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-pencil"></i></a>&nbsp;';

                return $edit;
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param CancelReason $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(CancelReason $model)
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
            'reason',
            'cancelled_by',
            'status'
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
     public function filename(): string {
       
        return 'cancel_reasons_' . date('YmdHis');
    }
}