<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class Vehiculo extends Model
{
    protected $fillable = ['marca', 'modelo', 'placa', 'foto', 'precio_dia', 'activo'];

    protected $appends = [
        'photo_url',
    ];

    public function updatePhoto(UploadedFile $photo, $storagePath = 'vehiculos'): void {
        tap($this->foto, function ($previous) use ($photo, $storagePath) {
            $this->forceFill([
                'foto' => $photo->storePublicly(
                    $storagePath, ['disk' => 'public']
                )
            ])->save();

            if ($previous) {
                Storage::disk('public')->delete($previous);
            }
        });
    }

    public function deletePhoto(): void {
        if (is_null($this->foto)) return;

        Storage::disk('public')->delete($this->foto);

        $this->forceFill(['foto' => null])->save();
    }

    public function photoUrl(): Attribute {
        return Attribute::get(function (): string {
            return $this->foto
                ? Storage::disk('public')->url($this->foto)
                : '/car_default.jpeg';
        });
    }
}
