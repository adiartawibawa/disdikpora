<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use BezhanSalleh\FilamentShield\Support\Utils;
use Spatie\Permission\PermissionRegistrar;

class ShieldSeeder extends Seeder
{
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        Role::firstOrCreate(['name' => 'user']);

        $rolesWithPermissions = '[
            {"name":"super_admin","guard_name":"web","permissions":["view_desa","view_any_desa","create_desa","update_desa","restore_desa","restore_any_desa","replicate_desa","reorder_desa","delete_desa","delete_any_desa","force_delete_desa","force_delete_any_desa","view_guru::tendik","view_any_guru::tendik","create_guru::tendik","update_guru::tendik","restore_guru::tendik","restore_any_guru::tendik","replicate_guru::tendik","reorder_guru::tendik","delete_guru::tendik","delete_any_guru::tendik","force_delete_guru::tendik","force_delete_any_guru::tendik","view_guru::tendik::kebutuhan","view_any_guru::tendik::kebutuhan","create_guru::tendik::kebutuhan","update_guru::tendik::kebutuhan","restore_guru::tendik::kebutuhan","restore_any_guru::tendik::kebutuhan","replicate_guru::tendik::kebutuhan","reorder_guru::tendik::kebutuhan","delete_guru::tendik::kebutuhan","delete_any_guru::tendik::kebutuhan","force_delete_guru::tendik::kebutuhan","force_delete_any_guru::tendik::kebutuhan","view_kabupaten","view_any_kabupaten","create_kabupaten","update_kabupaten","restore_kabupaten","restore_any_kabupaten","replicate_kabupaten","reorder_kabupaten","delete_kabupaten","delete_any_kabupaten","force_delete_kabupaten","force_delete_any_kabupaten","view_kecamatan","view_any_kecamatan","create_kecamatan","update_kecamatan","restore_kecamatan","restore_any_kecamatan","replicate_kecamatan","reorder_kecamatan","delete_kecamatan","delete_any_kecamatan","force_delete_kecamatan","force_delete_any_kecamatan","view_kegiatan","view_any_kegiatan","create_kegiatan","update_kegiatan","restore_kegiatan","restore_any_kegiatan","replicate_kegiatan","reorder_kegiatan","delete_kegiatan","delete_any_kegiatan","force_delete_kegiatan","force_delete_any_kegiatan","view_layanan","view_any_layanan","create_layanan","update_layanan","restore_layanan","restore_any_layanan","replicate_layanan","reorder_layanan","delete_layanan","delete_any_layanan","force_delete_layanan","force_delete_any_layanan","view_provinsi","view_any_provinsi","create_provinsi","update_provinsi","restore_provinsi","restore_any_provinsi","replicate_provinsi","reorder_provinsi","delete_provinsi","delete_any_provinsi","force_delete_provinsi","force_delete_any_provinsi","view_role","view_any_role","create_role","update_role","delete_role","delete_any_role","view_sarpras::bangunan","view_any_sarpras::bangunan","create_sarpras::bangunan","update_sarpras::bangunan","restore_sarpras::bangunan","restore_any_sarpras::bangunan","replicate_sarpras::bangunan","reorder_sarpras::bangunan","delete_sarpras::bangunan","delete_any_sarpras::bangunan","force_delete_sarpras::bangunan","force_delete_any_sarpras::bangunan","view_sarpras::ruang","view_any_sarpras::ruang","create_sarpras::ruang","update_sarpras::ruang","restore_sarpras::ruang","restore_any_sarpras::ruang","replicate_sarpras::ruang","reorder_sarpras::ruang","delete_sarpras::ruang","delete_any_sarpras::ruang","force_delete_sarpras::ruang","force_delete_any_sarpras::ruang","view_sarpras::tanah","view_any_sarpras::tanah","create_sarpras::tanah","update_sarpras::tanah","restore_sarpras::tanah","restore_any_sarpras::tanah","replicate_sarpras::tanah","reorder_sarpras::tanah","delete_sarpras::tanah","delete_any_sarpras::tanah","force_delete_sarpras::tanah","force_delete_any_sarpras::tanah","view_sekolah","view_any_sekolah","create_sekolah","update_sekolah","restore_sekolah","restore_any_sekolah","replicate_sekolah","reorder_sekolah","delete_sekolah","delete_any_sekolah","force_delete_sekolah","force_delete_any_sekolah","view_user","view_any_user","create_user","update_user","restore_user","restore_any_user","replicate_user","reorder_user","delete_user","delete_any_user","force_delete_user","force_delete_any_user"]},
            {"name":"panel_user","guard_name":"web","permissions":["view_guru::tendik","view_any_guru::tendik","create_guru::tendik","update_guru::tendik","restore_guru::tendik","restore_any_guru::tendik","replicate_guru::tendik","reorder_guru::tendik","delete_guru::tendik","delete_any_guru::tendik","force_delete_guru::tendik","force_delete_any_guru::tendik","view_guru::tendik::kebutuhan","view_any_guru::tendik::kebutuhan","create_guru::tendik::kebutuhan","update_guru::tendik::kebutuhan","restore_guru::tendik::kebutuhan","restore_any_guru::tendik::kebutuhan","replicate_guru::tendik::kebutuhan","reorder_guru::tendik::kebutuhan","delete_guru::tendik::kebutuhan","delete_any_guru::tendik::kebutuhan","force_delete_guru::tendik::kebutuhan","force_delete_any_guru::tendik::kebutuhan","view_kegiatan","view_any_kegiatan","create_kegiatan","update_kegiatan","restore_kegiatan","restore_any_kegiatan","replicate_kegiatan","reorder_kegiatan","delete_kegiatan","delete_any_kegiatan","force_delete_kegiatan","force_delete_any_kegiatan","view_layanan","view_any_layanan","create_layanan","update_layanan","restore_layanan","restore_any_layanan","replicate_layanan","reorder_layanan","delete_layanan","delete_any_layanan","force_delete_layanan","force_delete_any_layanan","view_sarpras::bangunan","view_any_sarpras::bangunan","create_sarpras::bangunan","update_sarpras::bangunan","restore_sarpras::bangunan","restore_any_sarpras::bangunan","replicate_sarpras::bangunan","reorder_sarpras::bangunan","delete_sarpras::bangunan","delete_any_sarpras::bangunan","force_delete_sarpras::bangunan","force_delete_any_sarpras::bangunan","view_sarpras::ruang","view_any_sarpras::ruang","create_sarpras::ruang","update_sarpras::ruang","restore_sarpras::ruang","restore_any_sarpras::ruang","replicate_sarpras::ruang","reorder_sarpras::ruang","delete_sarpras::ruang","delete_any_sarpras::ruang","force_delete_sarpras::ruang","force_delete_any_sarpras::ruang","view_sarpras::tanah","view_any_sarpras::tanah","create_sarpras::tanah","update_sarpras::tanah","restore_sarpras::tanah","restore_any_sarpras::tanah","replicate_sarpras::tanah","reorder_sarpras::tanah","delete_sarpras::tanah","delete_any_sarpras::tanah","force_delete_sarpras::tanah","force_delete_any_sarpras::tanah","view_sekolah","view_any_sekolah","create_sekolah","update_sekolah","restore_sekolah","restore_any_sekolah","replicate_sekolah","reorder_sekolah","delete_sekolah","delete_any_sekolah","force_delete_sekolah","force_delete_any_sekolah","view_user","view_any_user","create_user","update_user","restore_user","restore_any_user","replicate_user","reorder_user"]},
            {"name":"user","guard_name":"web","permissions":[]},
            ]';
        $directPermissions = '[]';

        static::makeRolesWithPermissions($rolesWithPermissions);
        static::makeDirectPermissions($directPermissions);

        $this->command->info('Shield Seeding Completed.');
    }

    protected static function makeRolesWithPermissions(string $rolesWithPermissions): void
    {
        if (!blank($rolePlusPermissions = json_decode($rolesWithPermissions, true))) {
            /** @var Model $roleModel */
            $roleModel = Utils::getRoleModel();
            /** @var Model $permissionModel */
            $permissionModel = Utils::getPermissionModel();

            foreach ($rolePlusPermissions as $rolePlusPermission) {
                $role = $roleModel::firstOrCreate([
                    'name' => $rolePlusPermission['name'],
                    'guard_name' => $rolePlusPermission['guard_name'],
                ]);

                if (!blank($rolePlusPermission['permissions'])) {
                    $permissionModels = collect($rolePlusPermission['permissions'])
                        ->map(fn ($permission) => $permissionModel::firstOrCreate([
                            'name' => $permission,
                            'guard_name' => $rolePlusPermission['guard_name'],
                        ]))
                        ->all();

                    $role->syncPermissions($permissionModels);
                }
            }
        }
    }

    public static function makeDirectPermissions(string $directPermissions): void
    {
        if (!blank($permissions = json_decode($directPermissions, true))) {
            /** @var Model $permissionModel */
            $permissionModel = Utils::getPermissionModel();

            foreach ($permissions as $permission) {
                if ($permissionModel::whereName($permission)->doesntExist()) {
                    $permissionModel::create([
                        'name' => $permission['name'],
                        'guard_name' => $permission['guard_name'],
                    ]);
                }
            }
        }
    }
}
