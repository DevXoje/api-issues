<?php

namespace App\Models;

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
    ];
    protected $fillable = [
        'title' => 'required',
        'body' => 'required',
    ];

    protected $hidden = [];

    protected $casts = [
        'title' => 'string',
        'body' => 'string',
    ];

    public static function create($issue_data)
    {
        $status = 'pending';
        if (isset($issue_data['status'])) {
            $status = $issue_data['status'];
        }
        $issue = new Issue([
            'title' => $issue_data['title'],
            'body' => $issue_data['body'],
            'status' => $status,
        ]);
        $issue->save();
    }
}
