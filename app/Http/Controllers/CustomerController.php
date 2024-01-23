<?php

namespace App\Http\Controllers;

use App\Exceptions\ConflictException;
use App\Http\Requests\CustomerFormRequest;
use App\Models\Customer;
use App\Traits\RestResponse;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    use RestResponse;

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $sort = isset($request->sort) ? $request->sort : 'id';
        $type_sort = isset($request->type_sort) ? $request->type_sort : 'desc';
        $size = isset($request->size) ? $request->size : 100;

        $customer = Customer::select();
        $query =  $customer->orderBy($sort, $type_sort)->paginate($size);

        return $this->success($query);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CustomerFormRequest $request)
    {
        DB::beginTransaction();
        try {

            $customer = new Customer($request->all());
            $customer->save();
            DB::commit();
            return $this->success($customer);
        } catch (\Exception $ex) {
            DB::rollBack();
            throw new ConflictException($ex->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        $query = new Customer();

        return $query->findOrFail($customer->id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CustomerFormRequest $request, Customer $customer)
    {
        DB::beginTransaction();
        try {
            $customer->fill($request->all());
            $customer->save();

            DB::commit();
            return $this->success($customer);
        } catch (Exception $ex) {
            DB::rollBack();
            throw new ConflictException($ex->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        DB::beginTransaction();
        try {
            $customer->fill($customer->toArray());
          
            $customer->delete();

            DB::commit();

            return $this->success($customer);
        } catch (Exception $ex) {
            DB::rollBack();
            throw new ConflictException($ex->getMessage());
        }
    }
}
