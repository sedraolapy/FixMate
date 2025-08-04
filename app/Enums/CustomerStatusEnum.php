<?php

namespace App\Enums;

enum CustomerStatusEnum :string
{
    case ACTIVE = 'active' ;

    case INACTIVE = 'inactive';

    case SUSPENDED = 'suspended';


    public function translate(){
        return match($this){
            self::ACTIVE => trans('Active') ,
            self::INACTIVE => trans('Inactive'),
            self::SUSPENDED => trans('Suspended'),
        };
    }

    public static function asSelectArray(): array
    {
        return [
            self::ACTIVE->value => 'Active',
            self::INACTIVE->value => 'Inactive',
            self::SUSPENDED->value => 'Suspended',
        ];
    }
}
