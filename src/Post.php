<?php
namespace Romalytvynenko\Blog;

use App\User;
use Caouecs\Sirtrevorjs\SirTrevorJs;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    const STATUS_PUBLISHED = 'published';
    const STATUS_DRAFT = 'draft';
    const STATUS_TRASH = 'trash';

    /**
     * Default status is draft
     *
     * @var array
     */
    protected $attributes = array(
        'status' => self::STATUS_DRAFT,
    );

    protected $fillable = [
        'title',
        'content',
    ];

    public function author()
    {
        // implement this in your post
    }

    public function getDate()
    {
        return $this->created_at->toFormattedDateString();
    }

    /**
     * Set the posts's status.
     *
     * @param  string  $value
     * @return string
     */
    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = $this->transliterate(strtolower($value));
    }

    /**
     * Render content
     *
     * @return string
     */
    public function render()
    {
        return SirTrevorJs::render($this->content);
    }

    /**
     * Transliterate
     *
     * @param $str
     * @return string
     */
    function transliterate($str)
    {
        $tr = array(
            "А"=>"a", "Б"=>"b", "В"=>"v", "Г"=>"g", "Д"=>"d",
            "Е"=>"e", "Ё"=>"yo", "Ж"=>"zh", "З"=>"z", "И"=>"i",
            "Й"=>"j", "К"=>"k", "Л"=>"l", "М"=>"m", "Н"=>"n",
            "О"=>"o", "П"=>"p", "Р"=>"r", "С"=>"s", "Т"=>"t",
            "У"=>"u", "Ф"=>"f", "Х"=>"kh", "Ц"=>"ts", "Ч"=>"ch",
            "Ш"=>"sh", "Щ"=>"sch", "Ъ"=>"", "Ы"=>"y", "Ь"=>"",
            "Э"=>"e", "Ю"=>"yu", "Я"=>"ya", "а"=>"a", "б"=>"b",
            "в"=>"v", "г"=>"g", "д"=>"d", "е"=>"e", "ё"=>"yo",
            "ж"=>"zh", "з"=>"z", "і"=>"i",
            "и"=>"y", "й"=>"j", "к"=>"k", "ї" => "yi",
            "л"=>"l", "м"=>"m", "н"=>"n", "о"=>"o", "п"=>"p",
            "р"=>"r", "с"=>"s", "т"=>"t", "у"=>"u", "ф"=>"f",
            "х"=>"kh", "ц"=>"ts", "ч"=>"ch", "ш"=>"sh", "щ"=>"sch",
            "ъ"=>"", "ы"=>"y", "ь"=>"", "э"=>"e", "ю"=>"yu",
            "я"=>"ya", " "=>"-", "."=>"", ","=>"", "/"=>"-",
            ":"=>"", ";"=>"","—"=>"", "–"=>"-"
        );
        return strtr($str,$tr);
    }

}