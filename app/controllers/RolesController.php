<?php



/**
 * rolesController Class
 *
 * Implements actions regarding role management
 */
class RolesController extends Controller
{


    /**
    * display a list of system roles
    */
    public function index(){

        $roles = Role::all();

        return View::make('roles.index')->with('roles', $roles);
    }


    /**
    * display the edit page
    */
    public function edit($id){
        $roleperm = array();
        $role = Role::find($id);
        $permissions = Permission::all();
        $categories = DB::table('permissions')->select('category')->distinct()->get();

        foreach ($role->perms()->get() as $p) {
            $roleperm[] = $p->name;
        }
        
       return View::make('roles.edit', compact('role', 'permissions', 'categories', 'roleperm'));
    }



     /**
    * updates the role
    */
    public function update($id){

        $perms = Input::get('permission');

        $role = Role::find($id);

        $role->name = Input::get('name');
       
        $role->update();
        
        $role->perms()->sync($perms);

        

        return Redirect::to('roles/show/'.$role->id);
    }




    /**
     * Displays the form for account creation
     *
     * @return  Illuminate\Http\Response
     */
    public function create()
    {

        $categories = DB::table('permissions')->select('category')->distinct()->get();
        $permissions = Permission::all();
        
        
        return View::make('roles.create', compact('permissions', 'categories'));
    }

    /**
     * Stores new account
     *
     * @return  Illuminate\Http\Response
     */
    public function store()
    {

        

        $perms = Input::get('permission');

        
        
        $role = new Role;

        $role->name = Input::get('name');

        $role->save();

        $role->perms()->sync($perms);

        return Redirect::route('roles.index');

        

        


    }





    /**
    * Delete the role
    *
    */

    public function destroy($id){

        $role = Role::find($id);

        
        $role->delete();

        return Redirect::to('roles');
    }



    public function show($id){

        $role = Role::find($id);
        $permissions = Permission::all();
        $categories = DB::table('permissions')->select('category')->distinct()->get();
        $roleperm = array();
        foreach ($role->perms()->get() as $p) {
            $roleperm[] = $p->name;
        }
        
       return View::make('roles.show', compact('role', 'permissions', 'categories', 'roleperm'));
    }


  











  



    



 



}
