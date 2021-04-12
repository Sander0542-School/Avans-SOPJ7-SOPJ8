<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\Domain
 *
 * @property int $id
 * @property string $name
 * @property string $color
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Subject[] $subjects
 * @property-read int|null $subjects_count
 * @method static \Illuminate\Database\Eloquent\Builder|Domain newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Domain newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Domain query()
 * @method static \Illuminate\Database\Eloquent\Builder|Domain whereColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Domain whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Domain whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Domain whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Domain whereUpdatedAt($value)
 */
	class Domain extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Layer
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property string $content
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|Layer[] $childLayers
 * @property-read int|null $child_layers_count
 * @property-read Layer|null $parentLayer
 * @property-read \App\Models\Subject|null $subject
 * @method static \Illuminate\Database\Eloquent\Builder|Layer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Layer newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Layer query()
 * @method static \Illuminate\Database\Eloquent\Builder|Layer whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Layer whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Layer whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Layer whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Layer whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Layer whereUpdatedAt($value)
 */
	class Layer extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\LayerChoice
 *
 * @property int $id
 * @property int $parent_layer_id
 * @property int $child_layer_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Layer|null $childLayer
 * @property-read \App\Models\Layer|null $parentLayer
 * @method static \Illuminate\Database\Eloquent\Builder|LayerChoice newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LayerChoice newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LayerChoice query()
 * @method static \Illuminate\Database\Eloquent\Builder|LayerChoice whereChildLayerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LayerChoice whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LayerChoice whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LayerChoice whereParentLayerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LayerChoice whereUpdatedAt($value)
 */
	class LayerChoice extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Subject
 *
 * @property int $id
 * @property int $domain_id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $order
 * @property-read \App\Models\Domain|null $domain
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Layer[] $layers
 * @property-read int|null $layers_count
 * @method static \Illuminate\Database\Eloquent\Builder|Subject newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Subject newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Subject query()
 * @method static \Illuminate\Database\Eloquent\Builder|Subject whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subject whereDomainId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subject whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subject whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subject whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subject whereUpdatedAt($value)
 */
	class Subject extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\SubjectChoice
 *
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property string|null $icon
 * @property int $subject_id
 * @property int $layer_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Layer|null $layer
 * @property-read \App\Models\Subject|null $subject
 * @method static \Illuminate\Database\Eloquent\Builder|SubjectChoice newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SubjectChoice newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SubjectChoice query()
 * @method static \Illuminate\Database\Eloquent\Builder|SubjectChoice whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubjectChoice whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubjectChoice whereIcon($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubjectChoice whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubjectChoice whereLayerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubjectChoice whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubjectChoice whereSubjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubjectChoice whereUpdatedAt($value)
 */
	class SubjectChoice extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $two_factor_secret
 * @property string|null $two_factor_recovery_codes
 * @property string|null $remember_token
 * @property int|null $current_team_id
 * @property string|null $profile_photo_path
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read string $profile_photo_url
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Permission\Models\Permission[] $permissions
 * @property-read int|null $permissions_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Permission\Models\Role[] $roles
 * @property-read int|null $roles_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Sanctum\PersonalAccessToken[] $tokens
 * @property-read int|null $tokens_count
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User permission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User role($roles, $guard = null)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCurrentTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereProfilePhotoPath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereTwoFactorRecoveryCodes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereTwoFactorSecret($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

