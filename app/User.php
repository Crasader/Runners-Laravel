<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Role;
use App\Group;
use App\Comment;
use App\RunDriver;
use App\Schedule;
use App\Run;
use App\Car;
use App\Attachment;
use App\Festival;
use Illuminate\Support\Facades\Auth;

/**
 * User
 * User model
 *
 * @author Bastien Nicoud
 * @package App
 */
class User extends Authenticatable
{
    use Notifiable, SoftDeletes;

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
    public function qrCode()
    {
        return $this->morphMany(Attachment::class, 'attachable')->where('type', 'qrcode');
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
        if (!$this->profilePictures()->exists()) {
            $driversLicence = new Attachment(['type' => 'licence', 'path' => 'licence/default.jpg']);
            $driversLicence->owner()->associate(Auth::user());
            $driversLicence->save();
            $this->attachments()->save($driversLicence);
        }
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
}
