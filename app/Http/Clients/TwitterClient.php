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
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->token = config('services.twitter.token', false);
        $this->key = config('services.twitter.key', false);
        $this->secret = config('services.twitter.secret', false);
    }

    /**
     * Generate a new Twitter API token if one doesn't exist
     *
     * @method                  createToken
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
    public function createToken()
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

    public function getTweets(string $username, ?string $since = null, ?int $count = null)
    {
        //
    }
}
