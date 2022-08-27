<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDepartamentRequest;
use App\Http\Requests\UpdateDepartamentRequest;
use App\Models\Departament;
use Error;
use Illuminate\Http\Request;

class DepartamentController extends ApiController
{
    public function index()
    {
        if (!$departament = Departament::all()) {
            return $this->errorResponse('No departament found', 404);
        }
        return $this->successResponse("departament fetched", $departament);
    }

    public function store(StoreDepartamentRequest $request)
    {
        //Puede que falle
        if (!$validData = $request->validated()) {
            //errors() puede que no exista, buscar sustituto
            return $this->errorResponse('Validation error.', $request->errors(), 400);
        }

        try {
            $departament = Departament::create($validData);
            return $this->successResponse("Departament Created", $departament, 201);
        } catch (Error $e) {
            return $this->errorResponse('Error creating product.', $e->getMessage(), 400);
        }
    }

    public function show($id)
    {
        if (!$departament = Departament::find($id)) {
            return $this->errorResponse('Departament not found', 404);
        }
        return $this->successResponse("Departament Fetched", $departament);
    }

    public function update(UpdateDepartamentRequest $request, $id)
    {
        //Puede que falle
        if (!$validData = $request->validated()) {
            //errors() puede que no exista, buscar sustituto
            return $this->errorResponse('Validation error.', $request->errors());
        }

        if (!$departament = Departament::find($id)) {
            return $this->errorResponse('Departament not found', 404);
        }
        $old_departament = $departament->toArray();
        $departament->update($validData);
        return $this->successResponse("Departament Updated", [
            'old' => $old_departament,
            'updated' => $departament,
        ]);
    }

    public function destroy($id)
    {
        if (!$departament = Departament::find($id)) {
            return $this->errorResponse('Departament not found', 404);
        }
        $departament->delete();
        return $this->successResponse("Departament Deleted", $departament);
    }
}
