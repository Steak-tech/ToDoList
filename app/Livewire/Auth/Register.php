<?php
namespace App\Livewire\Auth;
use Livewire\Component;
use App\Actions\Fortify\RegistersUsers;

class Register extends Component
{
    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';


    public $name = '';
    public $email = '';
    public $password = '';
    public $password_confirmation = '';
    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8|confirmed',
    ];

    public function submit()
    {
        $this->validate();

        $user = $this->create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
        ]);

        auth()->login($user);

        return redirect($this->redirectTo);
    }

    public function render()
    {
        return view('auth.register');
    }
}