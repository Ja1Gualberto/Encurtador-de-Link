<?php

namespace App\Modules\Link\dto;

use Illuminate\Foundation\Http\FormRequest;

class CreateLink extends FormRequest
{
  public function authorize(): bool
  {
    return true;
  }

  /**
   * @return array<string, string>
   */
  public function rules(): array
  {
    return [
      'url_original' => 'required|string|',
      'alias' => 'nullable|string',
      'data_expira' => 'nullable|date|after_or_equal:today',
    ];
  }

  public function messages(): array
  {
    return [
      'data.after_or_equal' => 'Não é possível criar uma vaga com data anterior ao dia de hoje.'
    ];
  }
}
