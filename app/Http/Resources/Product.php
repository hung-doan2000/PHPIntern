<?php


namespace App\Http\Resources;


class Product{
    public function toArray($request){
        return[
            'id'=>$this->id,
            'name'=>$this->name,
            'detail'=>$this->detail,
            'created_at' => $this->created_at->format('d/m/Y'),
            'updated_at' => $this->updated_at->format('d/m/Y'),
        ];
    }
}
