<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Permitvetting
 * 
 * @property int $id
 * @property int $appId
 * @property int $vettedBy
 * @property int $vettedOn
 * @property string|null $comment
 * @property string|null $status
 *
 * @package App\Models
 */
class Permitvetting extends Model
{
	protected $table = 'permitvetting';
	public $timestamps = false;

	protected $casts = [
		'appId' => 'int',
		'vettedBy' => 'int',
		'vettedOn' => 'int'
	];

	protected $fillable = [
		'appId',
		'vettedBy',
		'vettedOn',
		'comment',
		'status'
	];
}
