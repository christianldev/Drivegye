<?php

/**
 * Paypal Payout Service
 *
 * @package     NewTaxi Prime
 * @subpackage  Services\Payouts
 * @category    Paypal
 * @author      Seen Technologies
 * @version     1.1.0
 * @link        https://seentechs.com
*/

namespace App\Services\Payouts;

use App\Models\Country;

class BankTransferPayout
{
    /**
     * validate Request
     *
     * @param Request $[request]
     * @return Mixed
     */
    public function validateRequest($request)
    {
        $rules = array(
            'account_holder_name' => 'required',
            'account_number'=> 'required',
            'bank_name'     => 'required',
            'bank_code'     => 'required',
            'bank_location' => 'required',
        );

        $messages = array(
            'required' => ':attribute '.trans('messages.home.field_is_required'),
        );
        $validator = \Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            if(isApiRequest()) {
                return response()->json([
                    'status_code' => '0',
                    'status_message' => $validator->messages()->first(),
                ]);
            }
            return back()->withErrors($validator)->withInput();
        }
        return false;
    }

    public function createPayoutPreference($request)
    {
        $recipient['email'] = $request->account_number;
        $recipient['id'] = $request->account_number;
    	return array(
    		'status'			=> true,
    		'recipient' 		=> arrayToObject($recipient),
    	);
    }

    public function makePayout($payout_account,$pay_data)
    {
        return array(
            'status' => true,
            'status_message' => 'Payout status updated successfully',
            'transaction_id' => '',
        );
    }
}