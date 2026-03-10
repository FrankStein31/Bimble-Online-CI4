// app/Controllers/Pengajar.php
namespace App\Controllers;

class Pengajar extends BaseController
{
    public function dashboard()
    {
        return view('pengajar/dashboard');
    }
    public function kelas()
    {
        return view('pengajar/kelas');
    }
    public function absen()
    {
        // proses absen...
        return redirect()->to('/pengajar/dashboard');
    }
}
