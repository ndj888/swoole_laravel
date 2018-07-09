<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 06 Jul 2018 09:57:21 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class SskcCoupon
 * 
 * @property int $id
 * @property string $user_id
 * @property float $coupon_money
 * @property bool $status
 * @property \Carbon\Carbon $exptime
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @package App\Models
 */
class SskcCoupon extends Eloquent
{
	protected $table = 'sskc_coupon';

	protected $casts = [
		'coupon_money' => 'float',
		'status' => 'bool'
	];

	protected $dates = [
		'exptime'
	];

	protected $fillable = [
		'user_id',
		'coupon_money',
		'status',
		'exptime'
	];
}
