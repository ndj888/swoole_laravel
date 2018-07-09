<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 06 Jul 2018 09:57:21 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class SskcOrder
 * 
 * @property int $id
 * @property int $case_user_id
 * @property int $coupon_id
 * @property float $order_amount
 * @property float $pay_amount
 * @property int $pay_method
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property int $order_status
 * @property string $order_sn
 * 
 * @property \App\Models\SskcCaseUser $sskc_case_user
 *
 * @package App\Models
 */
class SskcOrder extends Eloquent
{
	protected $table = 'sskc_order';

	protected $casts = [
		'case_user_id' => 'int',
		'coupon_id' => 'int',
		'order_amount' => 'float',
		'pay_amount' => 'float',
		'pay_method' => 'int',
		'order_status' => 'int'
	];

	protected $fillable = [
		'case_user_id',
		'coupon_id',
		'order_amount',
		'pay_amount',
		'pay_method',
		'order_status',
		'order_sn'
	];

	public function sskc_case_user()
	{
		return $this->belongsTo(\App\Models\SskcCaseUser::class, 'case_user_id');
	}
}
