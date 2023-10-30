<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role; //para la cracion de roles
use Spatie\Permission\Models\Permission; //importando para el uso 

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // creando los roles para poder usarlos 
        $role0 = Role::create(['name'=>'administrador']);
        $role1 = Role::create(['name'=>'gerente propietario']);
        $role2 = Role::create(['name'=>'gerente de area']);
        $role3 = Role::create(['name'=>'supervisor']);
        $role4 = Role::create(['name'=>'empleado']);
        $role5 = Role::create(['name'=>'pasante']);
        // creando variable y posterios personalizarlo

        // creando permisos ejemplo ese link
        // Permission::create(['name' => 'lisalis.admin']);

        //esto es para un permiso con un rol
        // Permission::create(['name' => 'lisalis.admin'])->assignRole($role1);

        //esto para un permiso con mas de un role y en la documentacion de de un roll mas permisos y ojo en un array

        // permisos para alimentos
        Permission::create(['name' => 'alimentos.index','description' => 'Ver listado de los alimentos '])->assignRole([$role0,$role1,$role2,$role3]);
        Permission::create(['name' => 'alimentos.create','description' => 'Crear alimentos'])->assignRole([$role0,$role1,$role2,$role3]);
        Permission::create(['name' => 'alimentos.edit','description' => 'Editar alimentos'])->assignRole([$role0,$role1,$role2,$role3]);
        Permission::create(['name' => 'alimentos.destroy','description' => 'Eliminar alimentos'])->assignRole([$role0,$role1,$role2,$role3,$role4]);

         // permisos para areas
        Permission::create(['name' => 'areas.index','description' => 'Ver listado de las areas'])->assignRole([$role0,$role1,$role2,$role3]);
        Permission::create(['name' => 'areas.create','description' => 'Crear areas'])->assignRole([$role0,$role1,$role2,$role3]);
        Permission::create(['name' => 'areas.edit','description' => 'Editar areas'])->assignRole([$role0,$role1,$role2,$role3]);
        Permission::create(['name' => 'areas.destroy','description' => 'Eliminar areas'])->assignRole([$role0]);
        
        // permisos para calendarios
        Permission::create(['name' => 'calendarios.index','description' => 'Ver listado del calendarios'])->assignRole([$role0,$role1,$role2,$role3,$role4,$role5]);
        Permission::create(['name' => 'calendarios.edit','description' => 'Editar calendarios'])->assignRole([$role0,$role1,$role2,$role3,$role4,$role5]);
        Permission::create(['name' => 'calendarios.show','description' => 'Mostrar calendarios'])->assignRole([$role0,$role1,$role2,$role3,$role4,$role5]);

         // permisos para cargos
        Permission::create(['name' => 'cargos.index','description' => 'Ver listado de los cargos'])->assignRole([$role0,$role1,$role2 ]);
        Permission::create(['name' => 'cargos.create','description' => 'Crear cargos'])->assignRole([$role0,$role1,$role2 ]);
        Permission::create(['name' => 'cargos.edit','description' => 'Editar cargos'])->assignRole([$role0,$role1,$role2 ]);
        Permission::create(['name' => 'cargos.destroy','description' => 'Eliminar cargos'])->assignRole([$role0 ]);

          // permisos para clientes
        Permission::create(['name' => 'clientes.index','description' => 'Ver listado de los clientes'])->assignRole([$role0,$role1,$role2,$role3]);
        Permission::create(['name' => 'clientes.create','description' => 'Crear clientes'])->assignRole([$role0,$role1,$role2,$role3]);
        Permission::create(['name' => 'clientes.edit','description' => 'Editar clientes'])->assignRole([$role0,$role1,$role2,$role3]);
        Permission::create(['name' => 'clientes.destroy','description' => 'Eliminar clientes'])->assignRole([$role0]);
        Permission::create(['name' => 'clientes.show','description' => 'Mostrar clientes'])->assignRole([$role0,$role1,$role2,$role3,$role4,$role5]);

         // permisos para descuentos 
        Permission::create(['name' => 'descuentos.index','description' => 'Ver listado de los descuentos'])->assignRole([$role0,$role1,$role2 ]);
        Permission::create(['name' => 'descuentos.create','description' => 'Crear descuentos'])->assignRole([$role0,$role1,$role2 ]);
        Permission::create(['name' => 'descuentos.edit','description' => 'Editar descuentos'])->assignRole([$role0,$role1,$role2 ]);
        Permission::create(['name' => 'descuentos.destroy','description' => 'Eliminar descuentos'])->assignRole([$role0 ]);

          // permisos para destinos
        Permission::create(['name' => 'destinos.index','description' => 'Ver listado de los destinos'])->assignRole([$role0,$role1,$role2,$role3]);
        Permission::create(['name' => 'destinos.create','description' => 'Crear destinos'])->assignRole([$role0,$role1,$role2,$role3]);
        Permission::create(['name' => 'destinos.edit','description' => 'Editar destinos'])->assignRole([$role0,$role1,$role2,$role3]);
        Permission::create(['name' => 'destinos.destroy','description' => 'Eliminar destinos'])->assignRole([$role0 ]);
        Permission::create(['name' => 'destinos.show','description' => 'Mostrar destinos'])->assignRole([$role0,$role1,$role2,$role3]);

          // permisos para empleados
        Permission::create(['name' => 'empleados.index','description' => 'Ver listado de los empleados'])->assignRole([$role0,$role1,$role2 ]);
        Permission::create(['name' => 'empleados.create','description' => 'Crear empleados'])->assignRole([$role0,$role1,$role2 ]);
        Permission::create(['name' => 'empleados.edit','description' => 'Editar empleados'])->assignRole([$role0,$role1,$role2 ]);
        Permission::create(['name' => 'empleados.destroy','description' => 'Eliminar empleados'])->assignRole([$role0,$role1,$role2 ]);
        Permission::create(['name' => 'empleados.show','description' => 'Mostrar empleados'])->assignRole([$role0,$role1,$role2 ]);
        
        // permisos para foto_tours
        Permission::create(['name' => 'foto_tours.index','description' => 'Ver listado de las foto tours'])->assignRole([$role0,$role1,$role2,$role3,$role4,$role5]);
        Permission::create(['name' => 'foto_tours.create','description' => 'Crear foto tours'])->assignRole([$role0,$role1,$role2,$role3,$role4,$role5]);
        Permission::create(['name' => 'foto_tours.edit','description' => 'Editar foto tours'])->assignRole([$role0,$role1,$role2,$role3]);
        Permission::create(['name' => 'foto_tours.destroy','description' => 'Eliminar foto tours'])->assignRole([$role0 ]);
        

        // permisos para hospedajes
        Permission::create(['name' => 'hospedajes.index','description' => 'Ver listado de las hospedajes'])->assignRole([$role0,$role1,$role2,$role3,$role4]);
        Permission::create(['name' => 'hospedajes.create','description' => 'Crear hospedajes hospedajes'])->assignRole([$role0,$role1,$role2,$role3,$role4]);
        Permission::create(['name' => 'hospedajes.edit','description' => 'Editar hospedajes'])->assignRole([$role0,$role1,$role2,$role3,$role4]);
        Permission::create(['name' => 'hospedajes.destroy','description' => 'Eliminar hospedajes'])->assignRole([$role0,$role1,$role2,$role3]);
        Permission::create(['name' => 'hospedajes.show','description' => 'Mostrar hospedajes'])->assignRole([$role0,$role1,$role2,$role3,$role4]);

        // permisos para lisalis
        Permission::create(['name' => 'lisalis.index','description' => 'Ver listado de las lista de alimientos'])->assignRole([$role0,$role1,$role2,$role3,$role4]);
        Permission::create(['name' => 'lisalis.create','description' => 'Crear lista de alimientos'])->assignRole([$role0,$role1,$role2,$role3,$role4]);
        Permission::create(['name' => 'lisalis.destroy','description' => 'Eliminar lista de alimientos'])->assignRole([$role0,$role1,$role2,$role3]);
        Permission::create(['name' => 'lisalis.show','description' => 'Mostrar lista de alimientos'])->assignRole([$role0,$role1,$role2,$role3,$role4]);

        // permisos para n_jerarquicos 
        Permission::create(['name' => 'n_jerarquicos.index','description' => 'Ver listado de las nivel jerarquico'])->assignRole([$role0,$role1]);
        Permission::create(['name' => 'n_jerarquicos.create','description' => 'Crear nivel jerarquico'])->assignRole([$role0,$role1 ]);
        Permission::create(['name' => 'n_jerarquicos.edit','description' => 'Editar nivel jerarquico'])->assignRole([$role0,$role1 ]);
        Permission::create(['name' => 'n_jerarquicos.destroy','description' => 'Eliminar nivel jerarquico'])->assignRole([$role0,$role1]);
       

        // permisos para obs_noincludes
        Permission::create(['name' => 'obs_noincludes.index','description' => 'Ver listado de las objetos que no incluye el tour '])->assignRole([$role0,$role1,$role2,$role3,$role4,$role5]);
        Permission::create(['name' => 'obs_noincludes.create','description' => 'Crear objetos que no incluye el tour'])->assignRole([$role0,$role1,$role2,$role3,$role4,$role5]);
        Permission::create(['name' => 'obs_noincludes.edit','description' => 'Editar objetos que no incluye el tour'])->assignRole([$role0,$role1,$role2,$role3]);
        Permission::create(['name' => 'obs_noincludes.destroy','description' => 'Eliminar objetos no que incluye el tour'])->assignRole([$role0 ]);
         

        // permisos para obs_includes
        Permission::create(['name' => 'obs_includes.index','description' => 'Ver listado de las objetos que incluye el tour'])->assignRole([$role0,$role1,$role2,$role3,$role4,$role5]);
        Permission::create(['name' => 'obs_includes.create','description' => 'Crear objetos que incluye el tour'])->assignRole([$role0,$role1,$role2,$role3,$role4,$role5]);
        Permission::create(['name' => 'obs_includes.edit','description' => 'Editar objetos que incluye el tour'])->assignRole([$role0,$role1,$role2,$role3]);
        Permission::create(['name' => 'obs_includes.destroy','description' => 'Eliminar objetos que incluye el tour'])->assignRole([$role0 ]);
         

        // permisos para productos
        Permission::create(['name' => 'productos.index','description' => 'Ver listado de las productos'])->assignRole([$role0,$role1,$role2,$role3,$role4,$role5]);
        Permission::create(['name' => 'productos.create','description' => 'Crear productos'])->assignRole([$role0,$role1,$role2,$role3,$role4,$role5]);
        Permission::create(['name' => 'productos.edit','description' => 'Editar productos'])->assignRole([$role0,$role1,$role2,$role3]);
        Permission::create(['name' => 'productos.destroy','description' => 'Eliminar productos'])->assignRole([$role0,$role1,$role2,$role3]);
        Permission::create(['name' => 'productos.show','description' => 'Mostrar productos'])->assignRole([$role0,$role1,$role2,$role3,$role4,$role5]);

    

        // permisos para recibos
        Permission::create(['name' => 'recibos.index','description' => 'Ver listado de las recibos'])->assignRole([$role0,$role1,$role2,$role3,$role4,$role5]);
        Permission::create(['name' => 'recibos.create','description' => 'Crear recibos'])->assignRole([$role0,$role1,$role2,$role3,$role4,$role5]);
        Permission::create(['name' => 'recibos.edit','description' => 'Editar recibos'])->assignRole([$role0,$role1,$role2,$role3,$role4,$role5]);
        Permission::create(['name' => 'recibos.destroy','description' => 'Eliminar recibos'])->assignRole([$role0 ]);
        Permission::create(['name' => 'recibos.show','description' => 'Mostrar recibos'])->assignRole([$role0,$role1,$role2,$role3,$role4,$role5]);

        // permisos para reservas
        Permission::create(['name' => 'reservas.index','description' => 'Ver listado de las reservas'])->assignRole([$role0,$role1,$role2,$role3,$role4,$role5]);
        Permission::create(['name' => 'reservas.create','description' => 'Crear reservas'])->assignRole([$role0,$role1,$role2,$role3,$role4,$role5]);
        Permission::create(['name' => 'reservas.edit','description' => 'Editar reservas'])->assignRole([$role0,$role1,$role2,$role3,$role4,$role5]);
        Permission::create(['name' => 'reservas.destroy','description' => 'Eliminar reservas'])->assignRole([$role0 ]);
        Permission::create(['name' => 'reservas.show','description' => 'Mostrar reservas'])->assignRole([$role0,$role1,$role2,$role3,$role4,$role5]);

         // permisos para tours
         Permission::create(['name' => 'tours.index','description' => 'Ver listado de las tours'])->assignRole([$role0,$role1,$role2,$role3,$role4,$role5]);
         Permission::create(['name' => 'tours.create','description' => 'Crear tours'])->assignRole([$role0,$role1,$role2,$role3,$role4,$role5]);
         Permission::create(['name' => 'tours.edit','description' => 'Editar tours'])->assignRole([$role0,$role1,$role2,$role3,$role4,$role5]);
         Permission::create(['name' => 'tours.destroy','description' => 'Eliminar tours'])->assignRole([$role0,$role1,$role2]);
         Permission::create(['name' => 'tours.show','description' => 'Mostrar tours'])->assignRole([$role0,$role1,$role2,$role3,$role4,$role5]);

        // permisos para transportes
        Permission::create(['name' => 'transportes.index','description' => 'Ver listado de las transportes'])->assignRole([$role0,$role1,$role2,$role3,$role4 ]);
        Permission::create(['name' => 'transportes.create','description' => 'Crear transportes'])->assignRole([$role0,$role1,$role2,$role3,$role4,$role5]);
        Permission::create(['name' => 'transportes.edit','description' => 'Editar transportes'])->assignRole([$role0,$role1,$role2,$role3, ]);
        Permission::create(['name' => 'transportes.destroy','description' => 'Eliminar transportes'])->assignRole([$role0,$role1,$role2,$role3 ]);
        Permission::create(['name' => 'transportes.show','description' => 'Mostrar transportes'])->assignRole([$role0,$role1,$role2,$role3,$role4 ]);

        // permisos para usuarios
        Permission::create(['name' => 'usuarios.index','description' => 'Ver listado de las usuarios'])->assignRole([$role0,$role1 ]);
        Permission::create(['name' => 'usuarios.create','description' => 'Crear usuarios'])->assignRole([$role0,$role1 ]);
        Permission::create(['name' => 'usuarios.edit','description' => 'Editar usuarios'])->assignRole([$role0,$role1 ]);
        Permission::create(['name' => 'usuarios.destroy','description' => 'Eliminar usuarios'])->assignRole([$role0,$role1]);
        Permission::create(['name' => 'usuarios.show','description' => 'Mostrar usuarios'])->assignRole([$role0,$role1 ]);

         // permisos para estadisticas
         Permission::create(['name' => 'estadisticas.index','description' => 'Ver estadisticas'])->assignRole([$role0,$role1,$role2,$role3,$role4 ]);
         Permission::create(['name' => 'estadisticas.create','description' => 'Crear reporte'])->assignRole([$role0,$role1,$role2,$role3,$role4 ]);

    }
}
