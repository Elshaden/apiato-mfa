<?php

namespace App\Containers\Vendor\Mfa\UI\API\Requests;

use App\Ship\Parents\Requests\Request;

class DeleteMfaKeyRequest extends Request
{
      /**
       * Define which Roles and/or Permissions has access to this request.
       */
      protected array $access = [
            'permissions' => '',
            'roles' => '',
      ];

      /**
       * Id's that needs decoding before applying the validation rules.
       */
      protected array $decode = [
//      'key',
      ];

      /**
       * Defining the URL parameters (e.g, `/user/{id}`) allows applying
       * validation rules on them and allows accessing them like request data.
       */
      protected array $urlParameters = [
            'key',
            'class',
      ];

      /**
       * Get the validation rules that apply to the request.
       */
      public function rules(): array
      {
            return [
                  'id' => 'required'
            ];
      }

      /**
       * Determine if the user is authorized to make this request.
       */
      public function authorize(): bool
      {
            return $this->check([
                  'hasAccess',
            ]);
      }
}
