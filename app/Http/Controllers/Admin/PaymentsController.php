<?php

/**
 * Payments Controller
 *
 * @package     NewTaxi Prime
 * @subpackage  Controller
 * @category    Payments
 * @author      Seen Technologies
 * @version     1.1.0
 * @link        https://seentechs.com
 */

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\PaymentsDataTable;

class PaymentsController extends Controller
{
    /**
     * Load Datatable for Rating
     *
     * @param array $dataTable  Instance of PaymentsDataTable
     * @return datatable
     */
    public function index(PaymentsDataTable $dataTable)
    {
        return $dataTable->render('admin.payments.payments');
    }
}