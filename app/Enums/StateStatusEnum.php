<?php

namespace App\Enums;

enum StateStatusEnum : string
{
    case ACTIVE = 'active' ;

    case INACTIVE = 'inactive';

    public function translate(){
        return match($this){
            self::ACTIVE => trans('Active') ,
            self::INACTIVE => trans('Inactive')
        };
    }

    public static function asSelectArray(): array
{
    return [
        self::ACTIVE->value => 'Active',
        self::INACTIVE->value => 'Inactive',
    ];
}

}
