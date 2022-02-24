<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Supplier;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\DB;

class SupplierController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function store()
    {

        $importData_arr = array();
        $i = 0;
        // $row = 1;
        if (($handle = fopen($this->file_name, "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                $num = count($data);            
                             // print_r($data);
                // echo "<p> $num fields in line $row: <br /></p>\n";
                // $row++;
                // for ($c=0; $c < $num; $c++) {
                //     echo $data[$c] . "<br />\n";
                // }

                if ($i == 0) {
                    $i++;
                    continue;
                }
                for ($c=0; $c < $num; $c++) {
                    $importData_arr[$i][] = $data[$c];
                }
                $i++;
            }
            fclose($handle);

            // print_r($importData_arr[1]); // array of arrays. each array is one row-array.

            $j = 0;
            $supplier_array = [];
            $cat_array = [];
            foreach ($importData_arr as $importData_row) {
                
                if( array_search($importData_row[0], $supplier_array, true) === false && $importData_row[0] > 0) {
                    array_push($supplier_array, $importData_row[0]);
                }

                $days_valid = $importData_row[1]; 
                $prority = $importData_row[2]; 
                $part_number = $importData_row[3]; 
                $part_description = $importData_row[4]; 
                $quantity = $importData_row[5]; 
                $price = $importData_row[6]; 
                $condition = $importData_row[7]; 
            
                if(array_search($importData_row[8], $cat_array, true) === false && $importData_row[8] > 0) {
                    array_push($cat_array, $importData_row[8]);
                }

                $j++;
            }
            // print_r($supplier_array);
            // die();

            foreach ($supplier_array as $supp_name) {

                // If the name does not exist, insert it in a table 
                if ($this->findSupplier($supp_name) == NULL){
                    Supplier::create([
                        'supplier_name' => $supp_name,
                    ]);
                }                    
            }    
        }

        foreach ($cat_array as $category) {
            if ($this->findCategory($category) == NULL){
                Category::create([
                    'category' => $category,
                ]);
            }   
        }

        return redirect()->route('suppliers.all');

    }

    public function findCategory($name)
    {
        return Category::where('category', $name)->first();
    }

    public function findSupplier($name)
    {
        return Supplier::where('supplier_name', $name)->first();
    }

    public function showAll()
    {
        $suppliers = Supplier::all()->sortBy('supplier_name');

        return view('suppliers.index', [
            'suppliers' => $suppliers
        ]); 
    }

    public function destroy(Request $request)
    {
        $supplier = Supplier::find($request->id);

        $supplier->delete();

        return redirect()->route('suppliers.all');
    }

    public function edit(Supplier $supplier)
    {
        return view('suppliers.edit', ['supplier' => $supplier]);
    }

    public function update(Request $request)
    {
        $this->validate($request,[
            'supplier_name' => 'required|max:225',
        ]);
        $data = Supplier::find($request->id);
        $data->supplier_name = $request->supplier_name;
        $data->save();

        return redirect()->route('suppliers.all');

    }


    
    
}
