?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends BaseController
{
    public function index(): string
    {
        return view('login'); // Menampilkan halaman login
    }
}
