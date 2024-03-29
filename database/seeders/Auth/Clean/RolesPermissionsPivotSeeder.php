<?php

namespace Database\Seeders\Auth\Clean;

use App\Models\Clean\Permission;
use App\Models\Clean\Role;
use Illuminate\Database\Seeder;

class RolesPermissionsPivotSeeder extends Seeder
{
    /**
     * Get the permission entity by the slug value
     *
     * @param  string  $slug
     *
     * @return Permission|null
     */
    protected function getPermissionBySlug(string $slug): ?Permission
    {
        return Permission::where('slug', $slug)->firstOrFail();
    }


    /**
     * Get the role entity by the slug value
     *
     * @param  string  $slug
     *
     * @return Role|null
     */
    protected function getRoleBySlug(string $slug): ?Role
    {
        return Role::where('slug', $slug)->firstOrFail();
    }


    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Permission ids
        $users = $this->getPermissionBySlug('manage-users')->id;
        $account = $this->getPermissionBySlug('manage-account')->id;
        $roles = $this->getPermissionBySlug('manage-roles')->id;
        $permissions = $this->getPermissionBySlug('manage-permissions')->id;

        $categories = $this->getPermissionBySlug('manage-categories')->id;
        $posts = $this->getPermissionBySlug('manage-posts')->id;
        $tags = $this->getPermissionBySlug('manage-tags')->id;
        $documents = $this->getPermissionBySlug('manage-documents')->id;
        $jobs = $this->getPermissionBySlug('manage-jobs')->id;


        // Add permissions to the superadmin
        $admin = $this->getRoleBySlug('super-administrator');
        $admin->permissions()->sync([
            $account, $users, $roles, $permissions, $categories, $posts, $tags, $documents, $jobs
        ]);

        // Add permissions to the admin
        $admin2 = $this->getRoleBySlug('administrator');
        $admin2->permissions()->sync([$account, $categories, $posts, $tags]);

        // Add permissions to the admin
        $customer = $this->getRoleBySlug('customer');
        $customer->permissions()->sync([$account]);

    }
}
