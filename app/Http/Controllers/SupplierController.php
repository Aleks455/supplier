<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    
    public function index()
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
            foreach ($importData_arr as $importData_row) {
                
                $supplier_name [] = $importData_row[0]; //Get supplier name
                $days_valid = $importData_row[1]; 
                $prority = $importData_row[2]; 
                $part_number = $importData_row[3]; 
                $part_description = $importData_row[4]; 
                $quantity = $importData_row[5]; 
                $price = $importData_row[6]; 
                $condition = $importData_row[7]; 
                $category = $importData_row[8]; 
                // echo $supplier_name;
                // echo "<br>";

                $j++;
                
               
                // supplier_name,days_valid,priority,part_number,part_desc,quantity,price,condition,category

            }

            $supplier_name_arr = array_unique($supplier_name);

            $supp_names = [];
            foreach ($supplier_name_arr as $supplier_name) {
                if (strlen($supplier_name) > 0 ){
                    array_push($supp_names, $supplier_name);
                }
            }

            foreach ($supp_names as $supp_name) {

                // If the name does not exist, insert it in a table 
                if ($this->find($supp_name) == NULL){
                    Supplier::create([
                        'supplier_name' => $supp_name,
                        ]);
                } 
                                
            }
                    
        }

    }

    public function find($name)
    {
        return Supplier::where('supplier_name', $name)->first();
    }

    


    


    
}
