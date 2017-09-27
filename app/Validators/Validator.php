<?php

namespace App\Validators;

use Illuminate\Support\Facades\Validator as BaseValidator;

class Validator
{
    // Validation rules
    public $rules = [
        'productName'=> 'sometimes|required|string|unique:products,name',
        'productId'=> 'sometimes|integer|min:1',
        'costPrice'=> 'sometimes|required|numeric',
        'markedPrice'=> 'sometimes|required|numeric',
        'description'=> 'sometimes|string|nullable',
        'categoryName'=> 'sometimes|required|string|unique:categories,name',
        'categoryId'=> 'sometimes|integer|min:1',
        'quantity'=> 'sometimes|required|integer|min:1',
        're-orderQuantity'=> 'sometimes|required|integer',
    ];
    // Custom validation messages
    private $messages = [
        'productName.unique'=> 'This product already exists.',
        'productId.min'=> 'You have not selected a product.',
        'categoryName.required'=> 'You have not entered a name for the category.',
        'categoryName.unique'=> 'This category already exists.',
        'categoryId.min'=> 'You have not selected a category for this product.',
        'quantity.required'=> 'You have not entered the number of items.',
    ];
    // Validation errors
    private $errors;

    public function validate($data)
    {
        $validator = BaseValidator::make($data, $this->rules, $this->messages);
        if($validator->fails())
        {
            // Validation fails
            $this->errors = $validator->errors();
            return false;
        }
        // Validation passes
        return true;
    }

    public function errors()
    {
        // Get validation errors
        return $this->errors;
    }
}
