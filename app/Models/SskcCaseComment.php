<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 06 Jul 2018 09:57:20 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class SskcCaseComment
 * 
 * @property int $id
 * @property int $s_id
 * @property int $c_id
 * @property string $content
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property int $status
 * 
 * @property \App\Models\SskcCaseUser $sskc_case_user
 * @property \App\Models\SskcStaff $sskc_staff
 * @property \Illuminate\Database\Eloquent\Collection $sskc_case_logs
 *
 * @package App\Models
 */
class SskcCaseComment extends Eloquent
{
	protected $table = 'sskc_case_comment';

	protected $casts = [
		's_id' => 'int',
		'c_id' => 'int',
		'status' => 'int'
	];

	protected $fillable = [
		's_id',
		'c_id',
		'content',
		'status'
	];

	public function sskc_case_user()
	{
		return $this->belongsTo(\App\Models\SskcCaseUser::class, 'c_id');
	}

	public function sskc_staff()
	{
		return $this->belongsTo(\App\Models\SskcStaff::class, 's_id', 'admin_id');
	}

	public function sskc_case_logs()
	{
		return $this->hasMany(\App\Models\SskcCaseLog::class, 'comment_id');
	}
}
