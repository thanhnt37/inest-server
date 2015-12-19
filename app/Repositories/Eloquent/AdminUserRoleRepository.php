<?php namespace App\Repositories\Eloquent;

use App\Repositories\AdminUserRoleRepositoryInterface;
use App\Models\AdminUserRole;

class AdminUserRoleRepository extends CompositeKeyModelRepository implements AdminUserRoleRepositoryInterface
{

    public function getBlankModel()
    {
        return new AdminUserRole();
    }

    public function rules()
    {
        return [
        ];
    }

    public function create($input)
    {
        $role = array_get($input, 'role', '');
        if (!array_key_exists($role, \Config::get('admin_user.roles', []))) {
            return null;
        }
        return parent::create($input);
    }

    public function deleteByAdminUserId($id)
    {
        $modelClass = $this->getModelClassName();
        $modelClass::where('admin_user_id', $id)->delete();
        return true;
    }

}