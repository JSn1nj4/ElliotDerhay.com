<?php

namespace App\Http\Controllers;

use App\Models\Tweet;

class TweetController extends Controller
{
    /**
     * Used for interacting with the Twitter API
     *
     * @property App\Models\TweetOld      $tweets
     * @access private
     */
    private $tweets;

    /**
     * Store instance of App\Tseet on controller instantiation
     *
     * @method                  __construct
     * @access public
     *
     * @return void
     */
    public function __construct()
    {
        $this->tweets = new Tweet;
    }

    /**
     * Get a list of tweets for display in a timeline-like view
     *
     * @method                  index
     * @access public
     *
     * @param integer           $count
     *
     * @return object
     */
    public function index(int $count = 5)
    {
        return Tweet::with('user')
                ->latest('date')
                ->take($count)
                ->get();
    }
}
