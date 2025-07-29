<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Bank
 * 
 * @property int $id
 * @property string $name
 * @property string $full_name
 * @property string $created_by
 * @property string $created_on
 * @property int|null $brc_id
 *
 * @package App\Models
 */
class Bank extends Model
{
	protected $table = 'bank';
	public $timestamps = false;

	protected $casts = [
		'brc_id' => 'int'
	];

	protected $fillable = [
		'name',
		'full_name',
		'created_by',
		'created_on',
		'brc_id'
	];
}
