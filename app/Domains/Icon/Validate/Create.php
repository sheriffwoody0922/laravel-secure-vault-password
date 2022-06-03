<?php declare(strict_types=1);

namespace App\Domains\Icon\Validate;

use App\Domains\Shared\Validate\ValidateAbstract;

class Create extends ValidateAbstract
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => ['bail', 'required', 'string'],
            'icon' => ['bail', 'required', 'file', 'mimetypes:image/png'],
        ];
    }
}
