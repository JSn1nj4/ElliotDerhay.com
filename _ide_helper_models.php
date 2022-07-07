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
 * App\Models\GithubEvent
 *
 * @property string $id
 * @property string $type
 * @property string|null $action
 * @property \Illuminate\Support\Carbon $date
 * @property int $user_id
 * @property string|null $source
 * @property string $repo
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\GithubUser|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|GithubEvent newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|GithubEvent newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|GithubEvent query()
 * @method static \Illuminate\Database\Eloquent\Builder|GithubEvent whereAction($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GithubEvent whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GithubEvent whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GithubEvent whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GithubEvent whereRepo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GithubEvent whereSource($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GithubEvent whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GithubEvent whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GithubEvent whereUserId($value)
 */
	class GithubEvent extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\GithubUser
 *
 * @property int $id
 * @property string $login
 * @property string $display_login
 * @property string $avatar_url
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\GithubEvent[] $events
 * @property-read int|null $events_count
 * @method static \Database\Factories\GithubUserFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|GithubUser newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|GithubUser newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|GithubUser query()
 * @method static \Illuminate\Database\Eloquent\Builder|GithubUser whereAvatarUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GithubUser whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GithubUser whereDisplayLogin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GithubUser whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GithubUser whereLogin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|GithubUser whereUpdatedAt($value)
 */
	class GithubUser extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Project
 *
 * @property int $id
 * @property string $name
 * @property string $link
 * @property string|null $demo_link
 * @property string $thumbnail
 * @property string $short_desc
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Project newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Project newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Project query()
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereDemoLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereShortDesc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereThumbnail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Project whereUpdatedAt($value)
 */
	class Project extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Token
 *
 * @property int $id
 * @property string $service
 * @property string $value
 * @property \Illuminate\Support\Carbon|null $expires_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Token expired()
 * @method static \Database\Factories\TokenFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Token newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Token newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Token query()
 * @method static \Illuminate\Database\Eloquent\Builder|Token valid()
 * @method static \Illuminate\Database\Eloquent\Builder|Token whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Token whereExpiresAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Token whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Token whereService($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Token whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Token whereValue($value)
 */
	class Token extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Tweet
 *
 * @property string $id
 * @property int $user_id
 * @property string $body
 * @property \Illuminate\Support\Carbon $date
 * @property int|null $sub_tweet_id
 * @property object $entities
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read string $formatted_body
 * @property-read string $url
 * @property-read \App\Models\TwitterUser|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|Tweet newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Tweet newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Tweet query()
 * @method static \Illuminate\Database\Eloquent\Builder|Tweet whereBody($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tweet whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tweet whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tweet whereEntities($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tweet whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tweet whereSubTweetId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tweet whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tweet whereUserId($value)
 */
	class Tweet extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\TwitterUser
 *
 * @property int $id
 * @property string $name
 * @property string $screen_name
 * @property string $profile_image_url_https
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read string $profile_url
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Tweet[] $tweets
 * @property-read int|null $tweets_count
 * @method static \Database\Factories\TwitterUserFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|TwitterUser newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TwitterUser newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TwitterUser query()
 * @method static \Illuminate\Database\Eloquent\Builder|TwitterUser whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TwitterUser whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TwitterUser whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TwitterUser whereProfileImageUrlHttps($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TwitterUser whereScreenName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TwitterUser whereUpdatedAt($value)
 */
	class TwitterUser extends \Eloquent {}
}

