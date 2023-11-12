<?php

namespace App\Http\Controllers;

use App\Mail\WelcomeEmail;
use App\Models\Registration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class RegistrationController extends Controller
{
    public function index()
    {
        return view('registration.index');
    }

    public function store(Request $request)
    {
        $messages = [
            'required' => ':attribute harus diisi',
            'min' => ':attribute harus diisi minimal :min karakter',
            'max' => ':attribute harus diisi maksimal :max karakter',
            'email' => ':attribute tidak valid',
            'unique' => ':attribute sudah terdaftar'
        ];
        $this->validate($request, [
            'nama' => 'bail|required|min:2',
            'email' => 'bail|required|email:rfc,dns|unique:registrations',
            'alamat' => 'bail|required|min:5',
        ], $messages);

        $registration = Registration::create([
            'nama' => strip_tags($request->nama),
            'email' => $request->email,
            'alamat' => strip_tags($request->alamat),
        ]);

        Mail::to($registration->email)->send(new WelcomeEmail($registration));

        return redirect()->route('all')->with([
            'message' => 'Data pendaftaran berhasil ditambahkan dan email notifikasi sudah dikirimkan ke email yang terdaftar. Terima kasih.',
            'type' => 'create'
        ]);
    }

    public function all()
    {
        $registrations = Registration::all();
        return view('registration.all', compact('registrations'));
    }

    public function update(Request $request, $id)
    {
        $messages = [
            'required' => ':attribute harus diisi',
            'min' => ':attribute harus diisi minimal :min karakter',
            'max' => ':attribute harus diisi maksimal :max karakter',
            'email' => ':attribute tidak valid',
            'unique' => ':attribute sudah terdaftar'
        ];
        $validated = $this->validate($request, [
            'nama' => 'bail|required|min:2',
            'email' => 'bail|required|email:rfc,dns|unique:registrations,email,' . $id,
            'alamat' => 'bail|required|min:5',
        ], $messages);
        Registration::find($id)->update([
            'nama' => strip_tags($request->nama),
            'email' => $request->email,
            'alamat' => strip_tags($request->alamat),
        ]);
        return redirect()->route('all')->with([
            'message' => 'Data berhasil diedit.',
            'type' => 'success'
        ]);
    }

    public function destroy($id)
    {
        $registration = Registration::find($id);
        $registration->delete();
        return redirect()->route('all')->with([
            'message' => 'Data pendaftaran berhasil dihapus.',
            'type' => 'success'
        ]);
    }
}
