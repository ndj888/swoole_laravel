<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 06 Jul 2018 09:57:21 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class SskcStaff
 * 
 * @property int $id
 * @property int $admin_id
 * @property string $name
 * @property string $level
 * @property string $mobile
 * @property bool $sex
 * @property int $type
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \Illuminate\Database\Eloquent\Collection $sskc_case_comments
 * @property \Illuminate\Database\Eloquent\Collection $sskc_case_logs
 *
 * @package App\Models
 */
class SskcStaff extends Eloquent
{
	protected $table = 'sskc_staff';

	protected $casts = [
		'admin_id' => 'int',
		'sex' => 'bool',
		'type' => 'int'
	];

	protected $fillable = [
		'admin_id',
		'name',
		'level',
		'mobile',
		'sex',
		'type'
	];

	public function sskc_case_comments()
	{
		return $this->hasMany(\App\Models\SskcCaseComment::class, 's_id', 'admin_id');
	}

	public function sskc_case_logs()
	{
		return $this->hasMany(\App\Models\SskcCaseLog::class, 'staff_id', 'admin_id');
	}
}
