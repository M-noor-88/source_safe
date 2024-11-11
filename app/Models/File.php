<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;


    protected $fillable = ['name', 'path', 'status', 'checked_out_by', 'checked_out_at', 'group_id'];
    protected $table = 'files';
    public function groups()
    {
        return $this->belongsToMany(Group::class, 'files_groups_pivot');
    }

    public function checkedOutBy()
    {
        return $this->belongsTo(User::class, 'checked_out_by');
    }

    public function checkouts()
    {
        return $this->hasMany(Checkout::class);
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    public function backups()
    {
        return $this->hasMany(Backup::class);
    }

    public function auditTrails()
    {
        return $this->hasMany(AuditTrail::class);
    }

    public function operationsLogs()
    {
        return $this->hasMany(OperationsLog::class);
    }
}
