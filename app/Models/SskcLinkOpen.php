<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 06 Jul 2018 09:57:21 +0000.
 */

namespace App\Models;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class SskcLinkOpen
 * 
 * @property int $id
 * @property string $user_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @package App\Models
 */
class SskcLinkOpen extends Eloquent
{
	protected $table = 'sskc_link_open';

	protected $fillable = [
		'user_id'
	];
}
