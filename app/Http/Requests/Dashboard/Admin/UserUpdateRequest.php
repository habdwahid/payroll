<?php

namespace App\Http\Requests\Dashboard\Admin;

use App\Models\User;
use App\Models\UserData;
use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
{
    protected $user;

    protected $user_data;

    public function __construct()
    {
        $this->user = new User();

        $this->user_data = new UserData();
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
        $user = $this->user->where('nik', $this->nik)->first();

        return [
            'nik' => ['required', 'integer', 'unique:users,nik,' . $user->id],
            'name' => ['required', 'string', 'max:128'],
            'email' => ['required', 'email', 'unique:users,email,' . $user->id],
            'position' => ['required'],
            'sex' => ['required'],
        ];
    }

    public function update($user)
    {
        $user->update([
            'nik' => $this->nik,
            'name' => $this->name,
            'email' => $this->email,
        ]);

        if ($this->password) {
            $user->update([
                'password' => bcrypt($this->password),
            ]);
        }

        $this->user_data
            ->where('user_id', $user->id)
            ->update([
                'sex' => $this->sex,
                'position_id' => $this->position,
            ]);
    }
}
