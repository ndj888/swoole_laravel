<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 06 Jul 2018 09:57:21 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class SskcSetting
 * 
 * @property int $id
 * @property string $key
 * @property string $remark
 * @property string $value
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @package App\Models
 */
class SskcSetting extends Eloquent
{
	protected $table = 'sskc_setting';

	protected $fillable = [
		'key',
		'remark',
		'value'
	];
}
