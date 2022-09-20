<?php

namespace App\Http\Requests\Dashboard\Admin;

use App\Models\User;
use App\Models\UserData;
use App\Models\UserRole;
use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
{
    protected $user;

    protected $user_data;

    protected $user_role;

    public function __construct()
    {
        $this->user = new User();

        $this->user_data = new UserData();

        $this->user_role = new UserRole();
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'email' => ['required', 'email', 'unique:users,email', 'string', 'max:64'],
            'nik' => ['required', 'integer', 'unique:users,nik'],
            'name' => ['required', 'string', 'max:128'],
            'password' => ['required', 'string', 'min:6'],
            'position' => ['required'],
            'sex' => ['required'],
        ];
    }

    public function store()
    {
        $user = $this->user->create([
            'nik' => $this->nik,
            'name' => $this->name,
            'email' => str($this->email)->lower(),
            'password' => bcrypt($this->password),
        ]);

        $this->user_data->create([
            'user_id' => $user->id,
            'position_id' => $this->position,
            'sex' => $this->sex,
        ]);

        switch ($this->position) {
            case 1:
                $role = 2;
                break;

            case 2:
                $role = 3;
                break;

            default:
                $role = 4;
                break;
        }

        $this->user_role->create([
            'role_id' => $role,
            'user_id' => $user->id,
        ]);
    }
}
