<?php
namespace App\Services;

trait TrateRulesMessage {
    
    public function rulesData()
    {
         return $rules = [
           'description' => 'min:4',
           'image' => 'required|image|mimes:jpg,jpeg,png',
           'choose-category' => 'array|required'
           ];
    }
    
    public function messagesData()
    {
        return $messages = [
            'description.min' => 'Название должно содержать минимум :min символа.',
            'image.required' => 'Изображение загружать обязательно.',
            'image.image' => 'Вы загрузили не изображение.',
            'image.mimes' => 'Допустимые форматы: jpg, jpeg, png.',
            'choose-category.required' => 'Выберите категорию'
         ];
    }
  
}
