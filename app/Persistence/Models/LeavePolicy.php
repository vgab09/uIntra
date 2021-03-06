<?php
/**
 * Created by PhpStorm.
 * User: g09
 * Date: 2018.10.28.
 * Time: 13:13
 */

namespace App\Persistence\Models;


use App\Traits\ValidatableModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class LeavePolicy
 * @package App\Persistence\Models
 *
 * @property int id_leave_policy
 * @property int id_leave_type
 * @property string name
 * @property int days
 * @property string description
 * @property bool active
 */
class LeavePolicy extends Model implements ValidatableModelInterface
{
    use ValidatableModel;

    protected $primaryKey = 'id_leave_policy';

    protected $fillable = ['id_leave_type','name','days','description','active'];

    protected $dates = ['deleted_at'];

    public function getValidationRules(): array
    {
        return [
            'id_leave_type' => 'required|int|exists:leave_types',
            'name' => 'required|string',
            'days' => 'required|int',
            'description' => 'nullable|string',
            'active' => 'required|boolean',
        ];
    }

    public function leaveType(){
        return $this->belongsTo(LeaveType::class,'id_leave_type','id_leave_type',LeavePolicy::class);
    }

    public function leaveRequests(){
        return $this->belongsTo(LeaveRequest::class,'id_leave_policy','id_leave_policy',LeavePolicy::class);
    }

    public function employees(){
        return $this->belongsToMany(Employee::class,'employee_has_leave_policies','id_leave_policy','id_employee',null,null,LeavePolicy::class);
    }

}