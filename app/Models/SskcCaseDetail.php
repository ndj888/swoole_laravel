<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 06 Jul 2018 09:57:21 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class SskcCaseDetail
 * 
 * @property int $id
 * @property int $cu_id
 * @property string $imgurl
 * @property string $remark
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * 
 * @property \App\Models\SskcCaseUser $sskc_case_user
 *
 * @package App\Models
 */
class SskcCaseDetail extends Eloquent
{
	protected $table = 'sskc_case_detail';

	protected $casts = [
		'cu_id' => 'int'
	];

	protected $fillable = [
		'cu_id',
		'imgurl',
		'remark'
	];

	public function sskc_case_user()
	{
		return $this->belongsTo(\App\Models\SskcCaseUser::class, 'cu_id');
	}
}
