<?php

namespace App\Enums;

enum PermissionEnum: string
{
   // Category
   case VIEW_CATEGORY = 'view-category';
   case STORE_CATEGORY = 'store-category';
   case EDIT_CATEGORY = 'edit-category';
   case DESTROY_CATEGORY = 'destroy-category';

   // Subcategory
   case VIEW_SUBCATEGORY = 'view-subcategory';
   case STORE_SUBCATEGORY = 'store-subcategory';
   case EDIT_SUBCATEGORY = 'edit-subcategory';
   case DESTROY_SUBCATEGORY = 'destroy-subcategory';

   // Offer
   case VIEW_OFFER = 'view-offer';
   case STORE_OFFER = 'store-offer';
   case EDIT_OFFER = 'edit-offer';
   case DESTROY_OFFER = 'destroy-offer';

   // Slider
   case VIEW_SLIDER = 'view-slider';
   case STORE_SLIDER = 'store-slider';
   case EDIT_SLIDER = 'edit-slider';
   case DESTROY_SLIDER = 'destroy-slider';

   // Government Entity
   case VIEW_GOVERNMENT_ENTITY = 'view-government-entity';
   case STORE_GOVERNMENT_ENTITY = 'store-government-entity';
   case EDIT_GOVERNMENT_ENTITY = 'edit-government-entity';
   case DESTROY_GOVERNMENT_ENTITY = 'destroy-government-entity';

   // Service Provider
   case VIEW_SERVICE_PROVIDER = 'view-service-provider';
   case STORE_SERVICE_PROVIDER = 'store-service-provider';
   case EDIT_SERVICE_PROVIDER = 'edit-service-provider';
   case DESTROY_SERVICE_PROVIDER = 'destroy-service-provider';

   //settings
   case VIEW_PROFILE = 'view-profile';
   case EDIT_PROFILE = 'edit-profile';
   case MANAGE_NOTIFICATION = 'manage-notification';

    // Role Management
    case VIEW_ROLE = 'view-role';
    case VIEW_ANY_ROLE = 'view-any-role';
    case CREATE_ROLE = 'create-role';
    case UPDATE_ROLE = 'update-role';
    case DELETE_ROLE = 'delete-role';
    case DELETE_ANY_ROLE = 'delete-any-role';
    case FORCE_DELETE_ROLE = 'force-delete-role';
    case FORCE_DELETE_ANY_ROLE = 'force-delete-any-role';
    case RESTORE_ROLE = 'restore-role';
    case RESTORE_ANY_ROLE = 'restore-any-role';
    case REPLICATE_ROLE = 'replicate-role';
    case REORDER_ROLE = 'reorder-role';

    public function guard(){
        return match($this){

            // Category
            self::VIEW_CATEGORY => ['customer', 'service_provider','admin'],
            self::STORE_CATEGORY => ['admin'],
            self::EDIT_CATEGORY => ['admin'],
            self::DESTROY_CATEGORY => ['admin'],

            // Subcategory
            self::VIEW_SUBCATEGORY => ['customer', 'service_provider','admin'],
            self::STORE_SUBCATEGORY => ['admin'],
            self::EDIT_SUBCATEGORY => ['admin'],
            self::DESTROY_SUBCATEGORY => ['admin'],

            // Offer
            self::VIEW_OFFER => ['customer', 'service_provider','admin'],
            self::STORE_OFFER =>  ['service_provider','admin'],
            self::EDIT_OFFER =>  ['service_provider','admin'],
            self::DESTROY_OFFER =>  ['service_provider','admin'],

            // Slider
            self::VIEW_SLIDER => ['customer', 'service_provider','admin'],
            self::STORE_SLIDER => ['admin'],
            self::EDIT_SLIDER => ['admin'],
            self::DESTROY_SLIDER => ['admin'],

            // Government Entity
            self::VIEW_GOVERNMENT_ENTITY => ['customer', 'service_provider'],
            self::STORE_GOVERNMENT_ENTITY => ['admin'],
            self::EDIT_GOVERNMENT_ENTITY => ['admin'],
            self::DESTROY_GOVERNMENT_ENTITY => ['admin'],

            // Service Provider
            self::VIEW_SERVICE_PROVIDER => ['customer', 'service_provider','admin'],
            self::STORE_SERVICE_PROVIDER => ['admin'],
            self::EDIT_SERVICE_PROVIDER => ['admin'],
            self::DESTROY_SERVICE_PROVIDER => ['admin'],


             //settings
            self::VIEW_PROFILE => ['customer', 'service_provider','admin'],
            self::EDIT_PROFILE => ['customer', 'service_provider','admin'],
            self::MANAGE_NOTIFICATION => ['customer', 'service_provider','admin'],


            self::VIEW_ROLE,
            self::VIEW_ANY_ROLE,
            self::CREATE_ROLE,
            self::UPDATE_ROLE,
            self::DELETE_ROLE,
            self::DELETE_ANY_ROLE,
            self::FORCE_DELETE_ROLE,
            self::FORCE_DELETE_ANY_ROLE,
            self::RESTORE_ROLE,
            self::RESTORE_ANY_ROLE,
            self::REPLICATE_ROLE,
            self::REORDER_ROLE => ['admin'],

        };
    }
}