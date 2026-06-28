import React, { useEffect, useState } from 'react';
import { useParams, useNavigate } from 'react-router-dom';
import { ArrowLeft, Upload, X, Image as ImageIcon } from 'lucide-react';
import { Button, Input, Select, Card, CardContent } from '../components/ui';
import { mockCars } from '../data/mockData';
import { toast } from 'sonner';
export function CarForm() {
  const { id } = useParams();
  const navigate = useNavigate();
  const isEdit = Boolean(id);
  const [formData, setFormData] = useState({
    name: '',
    plate: '',
    year: new Date().getFullYear().toString(),
    type: 'MPV',
    capacity: '7',
    price: '',
    fuel: 'Bensin',
    status: 'Tersedia',
    image: ''
  });
  const [errors, setErrors] = useState<Record<string, string>>({});
  const [previewUrl, setPreviewUrl] = useState<string | null>(null);
  useEffect(() => {
    if (isEdit && id) {
      const car = mockCars.find((c) => c.id === id);
      if (car) {
        setFormData({
          name: car.name,
          plate: car.plate,
          year: car.year.toString(),
          type: car.type,
          capacity: car.capacity.toString(),
          price: car.price.toString(),
          fuel: car.fuel,
          status: car.status,
          image: car.image
        });
        setPreviewUrl(car.image);
      } else {
        toast.error('Mobil tidak ditemukan');
        navigate('/cars');
      }
    }
  }, [id, isEdit, navigate]);
  const handleChange = (
  e: React.ChangeEvent<HTMLInputElement | HTMLSelectElement>) =>
  {
    const { name, value } = e.target;
    setFormData((prev) => ({
      ...prev,
      [name]: value
    }));
    if (errors[name]) {
      setErrors((prev) => ({
        ...prev,
        [name]: ''
      }));
    }
  };
  const handleImageChange = (e: React.ChangeEvent<HTMLInputElement>) => {
    const file = e.target.files?.[0];
    if (file) {
      // Create a local preview URL
      const url = URL.createObjectURL(file);
      setPreviewUrl(url);
      // In a real app, we would upload this file to a server
      setFormData((prev) => ({
        ...prev,
        image: url
      }));
    }
  };
  const removeImage = () => {
    setPreviewUrl(null);
    setFormData((prev) => ({
      ...prev,
      image: ''
    }));
  };
  const validate = () => {
    const newErrors: Record<string, string> = {};
    if (!formData.name) newErrors.name = 'Nama mobil wajib diisi';
    if (!formData.plate) newErrors.plate = 'Plat nomor wajib diisi';
    if (!formData.year || isNaN(Number(formData.year)))
    newErrors.year = 'Tahun tidak valid';
    if (!formData.capacity || isNaN(Number(formData.capacity)))
    newErrors.capacity = 'Kapasitas tidak valid';
    if (!formData.price || isNaN(Number(formData.price)))
    newErrors.price = 'Harga tidak valid';
    if (!previewUrl) newErrors.image = 'Foto mobil wajib diunggah';
    setErrors(newErrors);
    return Object.keys(newErrors).length === 0;
  };
  const handleSubmit = (e: React.FormEvent) => {
    e.preventDefault();
    if (validate()) {
      toast.success(
        isEdit ?
        'Data mobil berhasil diperbarui' :
        'Mobil baru berhasil ditambahkan'
      );
      navigate('/cars');
    } else {
      toast.error('Mohon lengkapi semua field yang wajib');
    }
  };
  return (
    <div className="space-y-6 max-w-4xl mx-auto">
      <div className="flex items-center gap-4">
        <Button variant="ghost" size="icon" onClick={() => navigate('/cars')}>
          <ArrowLeft className="w-5 h-5" />
        </Button>
        <div>
          <h1 className="text-2xl font-bold text-white tracking-tight">
            {isEdit ? 'Edit Mobil' : 'Tambah Mobil'}
          </h1>
          <p className="text-white/50 text-sm mt-1">
            {isEdit ?
            'Perbarui informasi armada kendaraan.' :
            'Tambahkan armada kendaraan baru ke sistem.'}
          </p>
        </div>
      </div>

      <form onSubmit={handleSubmit}>
        <Card>
          <CardContent className="p-6 space-y-8">
            {/* Photo Upload Section */}
            <div>
              <label className="block text-sm font-medium text-white/80 mb-4">
                Foto Mobil
              </label>
              <div
                className={`relative border-2 border-dashed rounded-xl p-8 text-center transition-colors ${errors.image ? 'border-red-500/50 bg-red-500/5' : 'border-white/20 hover:border-white/40 bg-white/[0.02]'}`}>
                
                {previewUrl ?
                <div className="relative w-full max-w-md mx-auto aspect-video rounded-lg overflow-hidden bg-black/50">
                    <img
                    src={previewUrl}
                    alt="Preview"
                    className="w-full h-full object-cover" />
                  
                    <button
                    type="button"
                    onClick={removeImage}
                    className="absolute top-2 right-2 p-1.5 bg-black/60 hover:bg-red-500/80 text-white rounded-md backdrop-blur-sm transition-colors">
                    
                      <X className="w-4 h-4" />
                    </button>
                  </div> :

                <div className="flex flex-col items-center justify-center py-8">
                    <div className="w-16 h-16 rounded-full bg-white/[0.05] flex items-center justify-center mb-4">
                      <ImageIcon className="w-8 h-8 text-white/40" />
                    </div>
                    <p className="text-white font-medium mb-1">
                      Klik untuk mengunggah foto
                    </p>
                    <p className="text-white/50 text-sm mb-4">
                      atau seret dan lepas file di sini (PNG, JPG, max 5MB)
                    </p>
                    <Button
                    type="button"
                    variant="secondary"
                    onClick={() =>
                    document.getElementById('photo-upload')?.click()
                    }>
                    
                      <Upload className="w-4 h-4 mr-2" /> Pilih File
                    </Button>
                  </div>
                }
                <input
                  id="photo-upload"
                  type="file"
                  accept="image/*"
                  className="hidden"
                  onChange={handleImageChange} />
                
                {errors.image &&
                <p className="mt-2 text-sm text-red-400">{errors.image}</p>
                }
              </div>
            </div>

            <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
              <div className="space-y-2">
                <label className="text-sm font-medium text-white/80">
                  Nama Mobil
                </label>
                <Input
                  name="name"
                  value={formData.name}
                  onChange={handleChange}
                  placeholder="Contoh: Toyota Avanza"
                  error={errors.name} />
                
              </div>

              <div className="space-y-2">
                <label className="text-sm font-medium text-white/80">
                  Plat Nomor
                </label>
                <Input
                  name="plate"
                  value={formData.plate}
                  onChange={handleChange}
                  placeholder="Contoh: B 1234 ABC"
                  error={errors.plate} />
                
              </div>

              <div className="space-y-2">
                <label className="text-sm font-medium text-white/80">
                  Tahun Mobil
                </label>
                <Input
                  name="year"
                  type="number"
                  value={formData.year}
                  onChange={handleChange}
                  placeholder="Contoh: 2023"
                  error={errors.year} />
                
              </div>

              <div className="space-y-2">
                <label className="text-sm font-medium text-white/80">
                  Tipe Mobil
                </label>
                <Select
                  name="type"
                  value={formData.type}
                  onChange={handleChange}>
                  
                  <option value="MPV">MPV</option>
                  <option value="SUV">SUV</option>
                  <option value="Sedan">Sedan</option>
                  <option value="Hatchback">Hatchback</option>
                  <option value="City Car">City Car</option>
                  <option value="Pickup">Pickup</option>
                </Select>
              </div>

              <div className="space-y-2">
                <label className="text-sm font-medium text-white/80">
                  Kapasitas (Kursi)
                </label>
                <Input
                  name="capacity"
                  type="number"
                  value={formData.capacity}
                  onChange={handleChange}
                  placeholder="Contoh: 7"
                  error={errors.capacity} />
                
              </div>

              <div className="space-y-2">
                <label className="text-sm font-medium text-white/80">
                  Harga Sewa per Hari (Rp)
                </label>
                <div className="relative">
                  <span className="absolute left-3 top-1/2 -translate-y-1/2 text-white/50 text-sm">
                    Rp
                  </span>
                  <Input
                    name="price"
                    type="number"
                    value={formData.price}
                    onChange={handleChange}
                    placeholder="350000"
                    className="pl-9"
                    error={errors.price} />
                  
                </div>
              </div>

              <div className="space-y-2">
                <label className="text-sm font-medium text-white/80">
                  Bahan Bakar
                </label>
                <Select
                  name="fuel"
                  value={formData.fuel}
                  onChange={handleChange}>
                  
                  <option value="Bensin">Bensin</option>
                  <option value="Diesel">Diesel</option>
                  <option value="Hybrid">Hybrid</option>
                  <option value="Listrik">Listrik</option>
                </Select>
              </div>

              <div className="space-y-2">
                <label className="text-sm font-medium text-white/80">
                  Status Mobil
                </label>
                <Select
                  name="status"
                  value={formData.status}
                  onChange={handleChange}>
                  
                  <option value="Tersedia">Tersedia</option>
                  <option value="Disewa">Disewa</option>
                  <option value="Maintenance">Maintenance</option>
                </Select>
              </div>
            </div>

            <div className="pt-6 border-t border-white/[0.05] flex justify-end gap-3">
              <Button
                type="button"
                variant="ghost"
                onClick={() => navigate('/cars')}>
                
                Batal
              </Button>
              <Button type="submit" variant="primary">
                Simpan Data Mobil
              </Button>
            </div>
          </CardContent>
        </Card>
      </form>
    </div>);

}