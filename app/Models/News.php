<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class News
 * 
 * @property int $newsID
 * @property string|null $newsTitle
 * @property string|null $newsImage
 * @property string|null $newsArticle
 * @property string|null $newsSource
 * @property Carbon|null $newsDate
 * @property string|null $newsType
 *
 * @package App\Models
 */
class News extends Model
{
	protected $table = 'news';
	protected $primaryKey = 'newsID';
	public $timestamps = false;

	protected $casts = [
		'newsDate' => 'datetime'
	];

	protected $fillable = [
		'newsTitle',
		'newsImage',
		'newsArticle',
		'newsSource',
		'newsDate',
		'newsType'
	];
}
