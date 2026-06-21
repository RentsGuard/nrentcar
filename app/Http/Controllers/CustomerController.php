<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        $query = Customer::query()->with('verifikator');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama_customer', 'like', "%{$search}%")
                  ->orWhere('nik', 'like', "%{$search}%")
                  ->orWhere('no_hp', 'like', "%{$search}%");
            });
        }

        if ($request->filled('filter_verifikasi')) {
            match ($request->filter_verifikasi) {
                'belum' => $query->whereNull('status_verifikasi'),
                'disetujui' => $query->where('status_verifikasi', 'disetujui'),
                'ditolak' => $query->where('status_verifikasi', 'ditolak'),
                default => null,
            };
        }

        $customers = $query->latest()->paginate(15)->withQueryString();

        return view('customer.index', compact('customers'));
    }

    public function create()
    {
        return view('customer.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_customer' => 'required|string|max:255',
            'email' => 'nullable|email|max:255|unique:customers,email',
            'no_hp' => 'required|string|max:20|unique:customers,no_hp',
            'alamat_customer' => 'required|string',
            'nik' => 'required|digits:16|unique:customers,nik',
            'tempat_lahir' => 'nullable|string|max:255',
            'tanggal_lahir' => 'nullable|date',
            'jenis_kelamin' => 'nullable|in:L,P',
            'golongan_darah' => 'nullable|string|max:3',
            'rt_rw' => 'nullable|string|max:10',
            'kelurahan' => 'nullable|string|max:255',
            'kecamatan' => 'nullable|string|max:255',
            'kota_kabupaten' => 'nullable|string|max:255',
            'provinsi' => 'nullable|string|max:255',
            'agama' => 'nullable|in:Islam,Kristen,Katolik,Hindu,Buddha,Konghucu',
            'status_perkawinan' => 'nullable|in:Kawin,Belum Kawin,Cerai',
            'pekerjaan' => 'nullable|string|max:255',
            'kewarganegaraan' => 'nullable|string|max:10',
            'berlaku_hingga' => 'nullable|date',
            'foto_ktp' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('foto_ktp')) {
            $validated['foto_ktp'] = $request->file('foto_ktp')->store('foto_ktp', 'public');
        }

        if ($request->has('seumur_hidup')) {
            $validated['berlaku_hingga'] = null;
        }

        $customer = Customer::create($validated);

        activity()->performedOn($customer)->log("Customer {$customer->nama_customer} created");

        return redirect('/customer')
            ->with('success', 'Customer berhasil ditambahkan');
    }

    public function show($id)
    {
        $customer = Customer::findOrFail($id);

        return view('customer.show', compact('customer'));
    }

    public function edit($id)
    {
        $customer = Customer::findOrFail($id);

        return view('customer.edit', compact('customer'));
    }

    public function update(Request $request, $id)
    {
        $customer = Customer::findOrFail($id);

        $validated = $request->validate([
            'nama_customer' => 'required|string|max:255',
            'email' => 'nullable|email|max:255|unique:customers,email,'.$customer->id,
            'no_hp' => 'required|string|max:20|unique:customers,no_hp,'.$customer->id,
            'alamat_customer' => 'required|string',
            'nik' => 'required|digits:16|unique:customers,nik,'.$customer->id,
            'tempat_lahir' => 'nullable|string|max:255',
            'tanggal_lahir' => 'nullable|date',
            'jenis_kelamin' => 'nullable|in:L,P',
            'golongan_darah' => 'nullable|string|max:3',
            'rt_rw' => 'nullable|string|max:10',
            'kelurahan' => 'nullable|string|max:255',
            'kecamatan' => 'nullable|string|max:255',
            'kota_kabupaten' => 'nullable|string|max:255',
            'provinsi' => 'nullable|string|max:255',
            'agama' => 'nullable|in:Islam,Kristen,Katolik,Hindu,Buddha,Konghucu',
            'status_perkawinan' => 'nullable|in:Kawin,Belum Kawin,Cerai',
            'pekerjaan' => 'nullable|string|max:255',
            'kewarganegaraan' => 'nullable|string|max:10',
            'berlaku_hingga' => 'nullable|date',
            'foto_ktp' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'status_verifikasi' => 'nullable|in:disetujui,ditolak',
        ]);

        if (auth()->user()->role === 'admin' && $request->has('status_verifikasi')) {
            if ($request->filled('status_verifikasi')) {
                $validated['status_verifikasi'] = $request->status_verifikasi;
                $validated['verified_by'] = auth()->id();
                $validated['tanggal_verifikasi'] = now();
            } else {
                $validated['status_verifikasi'] = null;
                $validated['verified_by'] = null;
                $validated['tanggal_verifikasi'] = null;
            }
        }

        if ($request->has('seumur_hidup')) {
            $validated['berlaku_hingga'] = null;
        }

        if ($request->hasFile('foto_ktp')) {
            if ($customer->foto_ktp) {
                Storage::disk('public')->delete($customer->foto_ktp);
            }
            $validated['foto_ktp'] = $request->file('foto_ktp')->store('foto_ktp', 'public');
        }

        $customer->update($validated);

        activity()->performedOn($customer)->log("Customer {$customer->nama_customer} updated");

        return redirect('/customer')
            ->with('success', 'Data customer berhasil diupdate');
    }

    public function destroy($id)
    {
        $customer = Customer::withCount(['penyewaan as aktif_count' => function ($q) {
            $q->where('status', 'aktif');
        }])->findOrFail($id);

        if ($customer->aktif_count > 0) {
            return back()->with('error', 'Customer tidak dapat dihapus karena masih memiliki penyewaan aktif');
        }

        if ($customer->foto_ktp) {
            Storage::disk('public')->delete($customer->foto_ktp);
        }

        $name = $customer->nama_customer;
        $customer->delete();

        activity()->log("Customer {$name} deleted");

        return redirect('/customer')
            ->with('success', 'Data customer berhasil dihapus');
    }

    public function verify(Request $request, $id)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Hanya admin yang dapat memverifikasi customer');
        }

        $customer = Customer::findOrFail($id);

        $request->validate([
            'action' => 'nullable|in:disetujui,ditolak',
        ]);

        if ($request->filled('action')) {
            $customer->update([
                'status_verifikasi' => $request->action,
                'verified_by' => auth()->id(),
                'tanggal_verifikasi' => now(),
            ]);
        } else {
            $customer->update([
                'status_verifikasi' => null,
                'verified_by' => null,
                'tanggal_verifikasi' => null,
            ]);
        }

        $verb = $request->action ?? 'direset';
        activity()->performedOn($customer)->log("Customer {$customer->nama_customer} verifikasi: {$verb}");

        return redirect('/customer/'.$id)
            ->with('success', 'Status verifikasi berhasil diperbarui');
    }
}
