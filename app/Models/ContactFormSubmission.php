<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactFormSubmission extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'email',
        'name',
        'message'
    ];

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'read' => false
    ];

    /**
     * Set the read token prior to saving.
     *
     * @return bool
     */
    public function save(...$args)
    {
        if (!$this->read_token) {
            $this->read_token = bin2hex(random_bytes(8));
        }
        return parent::save(...$args);
    }

    /**
     * Return the message as an array split on newlines.
     *
     * @return array
     */
    public function lines(): array
    {
        return array_map(
            function ($line) { return trim($line); },
            explode("\n", $this->message)
        );
    }
}
