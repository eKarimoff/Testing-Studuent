<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
   use HasFactory;

   protected $table = 'sessions';

   public function results()
   {
      return $this->hasMany(Result::class);
   }

   public function subject()
   {
      return  $this->belongsTo(Subject::class);
   }
   public function user()
   {
      return $this->belongsTo(User::class);
   }
   
   public function getPointAttribute()
   {
      if(count($this->results ) > 0)
      {
         $i = 0;
         $totalResult = 0;
         foreach($this->results as $result)
         {
            $totalResult = $totalResult + $result->answer->is_true;
            $i++;
         }
         return $totalResult.'/'.count($this->results);
      }
      else
      {
         return 'Incompleted';
      }
   }
}
