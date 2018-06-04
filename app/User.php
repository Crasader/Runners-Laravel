<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

use App\Run;
use App\Car;
use App\Role;
use App\Group;
use App\Kiela;
use App\Comment;
use App\Festival;
use App\Schedule;
use App\RunDriver;
use App\Attachment;
use BaconQrCode\Writer;
use Illuminate\Support\Facades\Auth;
use \BaconQrCode\Renderer\Image\Png;
use App\Extensions\Filters\Filterable;
use Illuminate\Support\Facades\Storage;

/**
 * User
 * User model
 *
 * @author Bastien Nicoud
 * @package App
 */
class User extends Authenticatable
{
    use Notifiable, SoftDeletes, Filterable;

    /**
     * MODEL PROPERTY
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'firstname', 'lastname', 'phone_number', 'sex', 'status'
    ];

    /**
     * MODEL PROPERTY
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * MODEL PROPERTY
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'deleted_at'
    ];

    /**
     * MODEL PROPERTY
     * Default value for attribute
     *
     * @var array
     */
    protected $attributes = [
        'name' => ''
    ];

    /**
     * MODEL RELATION
     * The roles that belong to the user.
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    /**
     * MODEL RELATION
     * The paleo festival editions who the user have participed
     */
    public function festivals()
    {
        return $this->belongsToMany(Festival::class);
    }

    /**
     * MODEL RELATION
     * The group that belong to the user.
     */
    public function groups()
    {
        return $this->belongsToMany(Group::class);
    }

    /**
     * MODEL RELATION
     * The comments that belong to the user (posted by this user).
     */
    public function commentsOwner()
    {
        return $this->hasMany(Comment::class, 'user_id');
    }

    /**
     * MODEL RELATION
     * The attachments that belong to the user (posted by this user).
     */
    public function attachmentsOwner()
    {
        return $this->hasMany(Attachment::class, 'user_id');
    }

    /**
     * MODEL RELATION
     * The runs who this user is mandated
     */
    public function runs()
    {
        return $this->belongsToMany(Run::class, 'run_drivers')->using(RunDriver::class);
    }

    /**
     * MODEL RELATION
     * The cars who this user drives (vie run_driver)
     */
    public function cars()
    {
        return $this->belongsToMany(Car::class, 'run_drivers')->using(RunDriver::class);
    }

    /**
     * MODEL RELATION
     * Get all of the comments on this profile (not the comments who belongs to this user)
     */
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    /**
     * MODEL RELATION
     * Gets the driver license for this user
     */
    public function attachments()
    {
        return $this->morphMany(Attachment::class, 'attachable');
    }

    /**
     * MODEL RELATION
     * Gets the profile picture for this user
     */
    public function profilePictures()
    {
        return $this->morphMany(Attachment::class, 'attachable')->where('type', 'profile');
    }

    /**
     * MODEL RELATION
     * Gets the driver license for this user
     */
    public function licencePictures()
    {
        return $this->morphMany(Attachment::class, 'attachable')->where('type', 'licence');
    }

    /**
     * MODEL RELATION
     * Gets the driver qrcode
     */
    public function qrCodes()
    {
        return $this->morphMany(Attachment::class, 'attachable')->where('type', 'qrcode');
    }

    /**
     * MODEL RELATION
     * The kielas that belong to the user.
     */
    public function kielas()
    {
        return $this->hasMany(Kiela::class);
    }

    /**
     * MODEL ACCESSOR
     * Get the user's full name.
     *
     * @return string
     */
    public function getFullNameAttribute()
    {
        return "{$this->firstname} {$this->lastname}";
    }

    /**
     * MODEL ACCESSOR
     * Get the user's slug
     *
     * @return string
     */
    public function getSlugAttribute()
    {
        return str_slug("{$this->firstname} {$this->lastname}");
    }

    /**
     * MODEL METHOD
     * Checks a specific user permission
     *
     * @return string
     */
    public function may($permission)
    {
        foreach ($this->roles as $role) {
            if ($role->may($permission)) {
                return true;
            }
        }
        return false;
    }

    /**
     * MODEL METHOD
     * Checks if the user belongs to a role
     *
     * @return string
     */
    public function is($roleSlug)
    {
        return $this->roles()->where('slug', $roleSlug)->count() == 1;
    }

    /**
     * MODEL METHOD
     * Generates a name if its not specified
     *
     * @return string
     */
    public function generateName()
    {
        if (empty($this->name)) {
            $this->name = str_replace(' ', '', strtolower("{$this->firstname} {$this->lastname}"));
        }
    }

    /**
     * MODEL METHOD
     * Generates the default set of pictures for new users
     *
     * @return string
     */
    public function generateDefaultPictures()
    {
        // Generate a record with default profile picture
        if (!$this->profilePictures()->exists()) {
            $profilePicture = new Attachment(['type' => 'profile', 'path' => 'profiles/default.jpg']);
            $profilePicture->owner()->associate(Auth::user());
            $profilePicture->save();
            $this->attachments()->save($profilePicture);
        }

        // Generate a new record with default liscence picture
        if (!$this->licencePictures()->exists()) {
            $driversLicence = new Attachment(['type' => 'licence', 'path' => 'licences/default.jpg']);
            $driversLicence->owner()->associate(Auth::user());
            $driversLicence->save();
            $this->attachments()->save($driversLicence);
        }
    }

    /**
     * MODEL METHOD
     * Generates a fresh api token for the user
     *
     * @return string
     */
    public function addRole($roleSlug = null)
    {
        // If no role slug passed
        if ($roleSlug === null) {
            $this->roles()->attach(Role::where('slug', 'runner')->first());
        } else {
            $this->roles()->sync([Role::where('slug', $roleSlug)->first()->id]);
        }
    }

    /**
     * MODEL METHOD
     * Generates a fresh api token for the user
     *
     * @return string
     */
    public function generateFreshApiToken()
    {
        $this->api_token = str_random(60);
        $this->save();
    }

    /**
     * MODEL METHOD
     * Generates a fresh qr code and save it to the storage
     *
     * @return string
     */
    public function generateQrCode()
    {
        // Delete the old qr code
        if ($this->qrCodes()->exists()) {
            Storage::delete('public/' . $this->qrCodes->first()->path);
            $this->qrCodes()->delete();
        }

        // Regenerate the api token (for security reasons we re-generate the api token each new qr code versions)
        $this->generateFreshApiToken();

        // Generate the filename
        $filename = 'qrcodes/' . $this->slug . str_random(20) . '.png';

        // Generate the QR code
        $renderer = new Png();
        $renderer->setHeight(256);
        $renderer->setWidth(256);
        $writer = new Writer($renderer);
        $writer->writeFile($this->api_token, '../storage/app/public/' . $filename);

        // Attach it to the user
        $qrcode = new Attachment(['type' => 'qrcode', 'path' => $filename]);
        $qrcode->owner()->associate(Auth::user());
        $qrcode->save();
        $this->attachments()->save($qrcode);
    }

    /**
     * MODEL METHOD
     * Removes the current user qr-code
     *
     * @return string
     */
    public function deleteQrCode()
    {
        // Delete the old qr code
        if ($this->qrCodes()->exists()) {
            Storage::delete('public/' . $this->qrCodes->first()->path);
            $this->qrCodes()->delete();
            $this->api_token = '';
            $this->save();
        }
    }
}
