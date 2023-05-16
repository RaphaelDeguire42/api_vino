<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


    class CellierQuery {
        protected $champsPermis = [
            'id' => ['eq'],
            'id_user' => ['eq'],
            'nom' => ['eq'],
            'id_couleur' => ['eq'],
        ];

    protected $operateursMap = [
        'eq'    => '=',
    ];

    public function transform(Request $request){
        $eloquentArray = [];

        foreach ($this->champsPermis as $col => $operators) {
            $query = $request->query($col);
            
            if(!isset($query)) { continue; }
           
            $column = $col;

            foreach ($operators as $operator){
                if (isset($query[$operator])) 
                {
                    $eloquentArray[] = [$column, $this->operateursMap[$operator], $query[$operator]];
                }
            }
        }

        return $eloquentArray;
}



    }



