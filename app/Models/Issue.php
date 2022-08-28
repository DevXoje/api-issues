<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Issue extends Model
{
    use HasFactory;
    protected $table = 'issues';
    protected $primaryKey = 'issue_id';
    protected $attributes = [
        'issue_id' => false,
        'title' => false,
        'body' => false,
        'state' => false,
    ];
    protected $fillable = [
        'title' => 'required',
        'body' => 'required',
        'state' => 'required',
    ];
    public static $states = [
        'open',
        'in process',
        'complete'
    ];
    protected $hidden = [];

    protected $casts = [
        'title' => 'string',
        'body' => 'string',
        'state' => 'string',
    ];

    public static function create($issue_data)
    {
        $status = 'pending';
        if (isset($issue_data['state'])) {
            $status = $issue_data['state'];
        }
        if (!$departament = Departament::find($issue_data['departament_id'])) {
            throw new Exception("departament not found", 1);
        }
        $issue = new Issue([
            'title' => $issue_data['title'],
            'body' => $issue_data['body'],
            'status' => $status,
            'departament' => $departament,
        ]);
        $issue->save();
    }

    public function departament()
    {
        return $this->belongsTo(Departament::class);
    }
}
