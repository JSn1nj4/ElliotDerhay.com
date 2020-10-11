<?php

namespace App\Http\Clients;

// use Carbon\Carbon;
// use Exception;
// use Illuminate\Support\Facades\Http;

class TwitterClient
{
    /**
     * The base Twitter API URL
     *
     * @property string         $api_url
     * @access private
     */
    private $api_url = 'https://api.twitter.com';

    /**
     * The token used for retrieving tweet information from the Twitter API
     *
     * @property string         $token
     * @access private
     */
    private $token;

    /**
     * The API key used for generating the token
     *
     * @property string         $key
     * @access private
     */
    private $key;

    /**
     * The API secret key part used for generating the token
     *
     * @property string         $secret
     * @access private
     */
    private $secret;

    /**
     * Create a new instance of the Tweet model
     *
     * @method                  __construct
     * @access public
     *
     * @param array             $attributes
     *
     * @return void
     *
     * This is necessary to initialize some properties that can't otherwise be
     * initialized. Initializing properties outside of a constrctor requires
     * that the initial values be static.
     */
    public function __construct()
    {
        $this->token = config('services.twitter.token', false);
        $this->key = config('services.twitter.key', false);
        $this->secret = config('services.twitter.secret', false);
    }

    /**
     * Get the Twitter API token
     *
     * Generate a new one if necessary.
     *
     * @method                  getToken
     * @access public
     *
     * @return void
     *
     * The 'if' in this case has to do with whether Twitter already has a token
     * for use. If the token hasn't been generated previously or if the previous
     * token was revoked, then this function will be used to ask Twitter for a
     * new one.
     *
     * This method will also only be called if the token doesn't already exist
     * in the environment.
     */
    public function getToken()
    {
        if ($this->token) {
            return true;
        }

        if (!$this->key || !$this->secret) {
            abort(500);
        }

        $post_url = "$this->api_url/oauth2/token";

        $twitter_str = base64_encode(urlencode($this->key) . ':' . urlencode($this->secret));

        $ch = curl_init();

        curl_setopt_array($ch, [
            CURLOPT_URL => $post_url,
            CURLOPT_POST => 1,
            CURLOPT_HTTPHEADER => [
                "Authorization: Basic $twitter_str",
                "Content-Type: application/x-www-form-urlencoded;charset=UTF-8"
            ],
            CURLOPT_POSTFIELDS => "grant_type=client_credentials",
            CURLOPT_RETURNTRANSFER => true
        ]);

        $result = json_decode(curl_exec($ch));
        curl_close($ch);

        if (isset($result->errors)) {
            abort(500);
        }

        $this->token = $result->access_token;
    }

    /**
     * Get tweets from the Twitter API
     *
     * The argument for `$since` must be an ID because this is what the
     * Twitter API requires to find tweets after a certain point.
     */
    public function getTweets(string $username, ?string $since = null, bool $retweets = true, ?int $count = null)
    {
        $url = "{$this->api_url}/1.1/statuses/user_timeline.json?" .
               ($count ? "count={$count}&" : "") .
               ($since ? "since_id={$since}" : "") .
               "screen_name={$username}&include_rts={$retweets}";

        $ch = curl_init();

        curl_setopt_array($ch, [
            CURLOPT_URL => $url,
            CURLOPT_HTTPHEADER => [
                "Authorization: Bearer {$this->getToken()}"
            ],
            CURLOPT_RETURNTRANSFER => true
        ]);

        $tweets = curl_exec($ch);

        if (isset(json_decode($tweets)->errors)) {
            abort(500);
        }

        curl_close($ch);

        return $tweets;
    }
}
