<?php

namespace App\Enums;

enum ServiceProviderStatusEnum : string
{
    case ACTIVE = 'active' ;

    case INACTIVE = 'inactive';

    case EXPIRED = 'expired';


    public function translate(){
        return match($this){
            self::ACTIVE => trans('Active') ,
            self::INACTIVE => trans('Inactive'),
            self::EXPIRED => trans('Expired'),
        };
    }

    public static function asSelectArray(): array
    {
        return [
            self::ACTIVE->value => 'Active',
            self::INACTIVE->value => 'Inactive',
            self::EXPIRED->value => 'Expired',
        ];
    }
}
