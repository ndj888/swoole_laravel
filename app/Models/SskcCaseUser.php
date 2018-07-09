<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 06 Jul 2018 09:57:21 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class SskcCaseUser
 * 
 * @property int $id
 * @property string $real_name
 * @property bool $sex
 * @property \Carbon\Carbon $birthday
 * @property string $descontet
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $user_id
 * @property string $mobile
 * 
 * @property \Illuminate\Database\Eloquent\Collection $sskc_case_comments
 * @property \Illuminate\Database\Eloquent\Collection $sskc_case_details
 * @property \Illuminate\Database\Eloquent\Collection $sskc_orders
 *
 * @package App\Models
 */
class SskcCaseUser extends Eloquent
{
	protected $table = 'sskc_case_user';

	protected $casts = [
		'sex' => 'bool'
	];

	protected $dates = [
		'birthday'
	];

	protected $fillable = [
		'real_name',
		'sex',
		'birthday',
		'descontet',
		'user_id',
		'mobile'
	];

	public function sskc_case_comments()
	{
		return $this->hasMany(\App\Models\SskcCaseComment::class, 'c_id');
	}

	public function sskc_case_details()
	{
		return $this->hasMany(\App\Models\SskcCaseDetail::class, 'cu_id');
	}

	public function sskc_orders()
	{
		return $this->hasMany(\App\Models\SskcOrder::class, 'case_user_id');
	}
}
