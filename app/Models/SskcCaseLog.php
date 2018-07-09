<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 06 Jul 2018 09:57:21 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class SskcCaseLog
 * 
 * @property int $id
 * @property int $comment_id
 * @property int $staff_id
 * @property int $type
 * @property string $old_comment
 * @property string $new_comment
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\Models\SskcCaseComment $sskc_case_comment
 * @property \App\Models\SskcStaff $sskc_staff
 *
 * @package App\Models
 */
class SskcCaseLog extends Eloquent
{
	protected $table = 'sskc_case_log';

	protected $casts = [
		'comment_id' => 'int',
		'staff_id' => 'int',
		'type' => 'int'
	];

	protected $fillable = [
		'comment_id',
		'staff_id',
		'type',
		'old_comment',
		'new_comment'
	];

	public function sskc_case_comment()
	{
		return $this->belongsTo(\App\Models\SskcCaseComment::class, 'comment_id');
	}

	public function sskc_staff()
	{
		return $this->belongsTo(\App\Models\SskcStaff::class, 'staff_id', 'admin_id');
	}
}
