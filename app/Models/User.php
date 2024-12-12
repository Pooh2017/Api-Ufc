<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\UploadedFile;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'foto'
    ];

    protected $appends = [
        'photo_url',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array {
        return [
            'email_verified_at' => 'datetime',
            'password'          => 'hashed',
        ];
    }

    public function updatePhoto(UploadedFile $photo, $storagePath = 'users'): void {
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
                : env('APP_URL') . '/car_default.jpeg';
        });
    }
}
