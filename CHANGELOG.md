# Changelog

### Release 1.8.2
Remove grave character accidentally slipped into Tailwind version number.

### Release 1.8.1
1. Try again to update previously-updated packages
2. Rename `heroku-postbuild` script to just `build`

### Release 1.8.0
1. Remove old Coming Soon page and related parts
2. Remove old Maintenance page and related parts
3. Add 503 error page for Laravel's own built-in maintenance mode
4. Add GA tracking allow/deny banner
    - Banner only shows if its user interaction cookie isn't set
    - If banner is showing, additional spacing will be added to the bottom of the page to ensure no content gets blocked.
5. Add global Vue event bus
6. Add conditional GA tracking code
    - Defaults to not tracking if user hasn't allowed it yet or has browser Do Not Track enabled
    - Will not track if DNT cookie is set to 1, will if set to 0
    - Listens for `allow_tracking` event via global event bus to let user select whether tracking will be allowed
7. No longer directly mutate props on Card component, as mentioned in Vue error message
    - See [Props: One-Way Data Flow][props-data-flow]
8. Remove catch-all route since Laravel will automatically handle 404s for non-existant routes
    - See [Routing: Fallback Routes][fallback-routes]
        >Typically, unhandled requests will automatically render a "404" page via your application's exception handler.
9. Make error code testing route more efficient
    - Use `where` routing method to ensure error route only serves requests for a specific pattern.
    - No longer check for `$code` being set or containing an empty string, since the route requires a specific pattern to even run.
    - Use `abort` helper to throw an error with the given error code, ensuring that the correct error message is set when rendering the related view.
10. Update some layout section names to avoid accidentally overriding section output further up view chain.
11. Redesign error page layout
12. Move footer copyright to its own partial
13. Tweak existing error pages
14. Add privacy policy page
15. Finish replacing `vue-loading-spinner` package
16. Configure package.json scripts for auto-build on Heroku

[props-data-flow]: https://vuejs.org/v2/guide/components-props.html#One-Way-Data-Flow
[fallback-routes]: https://laravel.com/docs/7.x/routing#fallback-routes

### Release 1.7.1
1. Use arrow function as callback for Cath-All web route
2. Adjust About columns
3. Update About text

### Release 1.7
1. Create Projects controllers and model for API use
2. Create migration and first seeder and factory
    - Seeder and factory are for generating dummy data
3. Create Projects grid on new Projects page
4. Update Card component somewhat for more flexibility
5. Update Projects page written content
6. Update how GitHub activity items use Card component
    - This is to fix a padding issue introduced by the Card component update
7. Update some packages
    - Manual package updates:
        - axios to version 0.19.0
        - cross-env to version 6.0.3
        - eslint to version 6.8.0
        - imagemin to version 7.0.1
        - vue to version 2.6.11
        - vue-template-compiler to version 2.6.11
    - Automatic updates (to manually-installed packages):
        - ajv to version 6.10.2
        - popper.js to version 1.16.0
        - tailwindcss to version 1.1.14
8. Fix vertical spacing difference issue in Vue card component
9. Explicitly set vertical margins for GitHub cards both client- and server-side
10. Upgrade from Laravel 5.8 to 7.x
11. Ensure both Yarn and NPM are using the same Node executable
12. Fully replace Sass with PostCSS—package changes:
    - Add postcss-mixins ^6.2.3
    - Add postcss-nested ^4.2.1
    - Add postcss-simple-vars ^5.0.2
    - Remove sass ^1.20.1
13. Move 'Made With' icon row to its own partial
14. Fix Vue.js icon title and alt text
15. Turn 'Made With' icon markup into template to loop over with similar icon data sets
    - Links: main offsite link and icon source
    - Text elements: resource name, and title/alt text for icon
    - Icon width and height
16. Completely remove 'Made With' content from homepage
    - I was starting to feel like this really didn't belong on the homepage, or that it was too big for what a section like this should be. May revisit in the future, but at least the markup is self-contained now.
17. Update to FontAwesome's new JS type kit
18. Add dev.to social icon to footer

### Release 1.6.1
1. Include required 'user' data in IssuesEvent payload
2. Rename a payload filtering method for consistency

### Release 1.6
1. Update Tailwind CSS -> 1.0.0-beta.8
2. Update moment -> 2.24.0
3. Update imagemin -> 6.1.0
4. Update ajv -> 6.10.0
5. Update vue & vue-template-compiler -> 2.6.10
6. Update cross-env -> 5.2.0
7. Update popper.js -> 1.15.0
8. Load tailwind directly in mix config and use as function in postcss plugins option
9. Disable CSS URL processing in postcss
10. Remove node-sass in favor of sass 1.20.1
11. Generate sourcemaps for debugging JS in production
12. Remove old comments from app.scss
13. Use `strlen()` to count string characters in PHP instead of `count()` :man_facepalming:

### Release 1.5.1
1. Update project version number
2. Regenerate public assets

### Release 1.5
1. Create new helper classes for GitHub activities and tweets
2. Add HelperServiceProvider class to automatically load all helper classes
3. Add Tweet helper methods for formatting data/content
4. Build out partials needed for displaying cards and timelines
5. Render tweets server-side
6. Update Tailwind to v1.0-beta.4
7. Render GitHub activities server-side
8. Remove duplicate computed properties from a couple of Vue components
9. Update Laravel framework: 5.7.* -> 5.8.*
    - This includes some boilerplate updates left over from the 5.6.* -> 5.7.* update
10. Fix an issue related to string interpolation and deeply nested objects
    - Only immediate children of a given object can be accessed during interpolation

### Release 1.4.8
1. Update Tailwind CSS: ^0.5.3 -> ^1.0.0-beta.3
2. Update local Tailwind config
3. Update classes in SCSS and template files as needed
4. Update documentation within several PHP classes

Tailwind upgrade guide can be found [here][1].
- Note: this is from any development release to any beta release. There may yet be more changes.

[1]: https://github.com/tailwindcss/tailwindcss/releases/tag/v1.0.0-beta.1

### Release 1.4.7
1. Add support for the `PullRequestEvent` GitHub event type
2. Refactor some GitHub event filtering methods
    - This is an attempt at inlining some event filtering logic
3. Update Vue and Vue Template Compiler
    - Both are updated to version 2.6.7, since they have to match
4. Add Node Sass as a direct dev dependency
    - I was previously using a version that I had installed globally.
    This probably isn't the best idea when working on a project across
    multiple OS installs.
5. Add basic support for the `PublicEvent` GitHub event type
    - The support is basic since I only need to mention that a repo
    was open-sourced. Will update if that changes.

### Release 1.4.6
Fix issue displaying create events for creating a repository.

### Release 1.4.5
Remove home from menu by default to switch header layouts.

### Release 1.4.4
1. Move 'About' content to homepage
2. Kill 'About' route since it's no longer needed
3. Remove 'About' menu item
4. Fix new spacing issues on homepage
5. Move tech logos to bottom, and add a heading
6. Update `.node-version` file to "8.12.0"

### Release 1.4.3
1. Update required node version to 8.11.2 for development
    - Trying to keep it the same between machines
2. Update laravel-mix to 3.0.0
3. Manually update har-validator to 5.1.3
    - NPM was looking for a slightly lower version that it couldn't find
4. Update Vue to 2.5.18
    - Fixes a version mismatch between it and `vue-template-compiler`
5. Update home banner image

### Release 1.4.2
1. Update Laravel Mix to version 2.1.14
2. Fix a number of vulnerabilities
3. Update Vue to version 2.5.17
4. Install `imagemin@^6.0.0`
5. Install `laravel-mix-purgecss@^3.0.0` to implement PurgeCSS
6. Scale down SVG logos on homepage

### Release 1.4.1
1. Split bloated GitHub event component into separate components
2. Implement dynamic imports for displaying GitHub events
3. Relocate new module chunks to specific public resource folder
4. Generate versioned hashes for front-end resources
    - This will force downloading new resource version when requested by the browser

### Release 1.4
1. Upgrade Laravel version 5.7
2. Extract third-party libraries into "vendor.js"
3. Add GitHub activity feed to website
4. Add a loading animation for Twitter/GitHub feeds
5. Setup email notifications for when new GitHub activity types are detected in feed
6. Show Vue logo on Homepage
7. Other homepage text changes
8. Rewrite About content
9. Work some more on Updates page (hidden for now)

### Release 1.3.1
Small change to bio text

### Release 1.3
1. Create Vue card component
2. Create timeline for displaying multiple cards
3. Create Twitter-specific cards
    - These make use of the generic card, but are used for rendering tweets
    - Parse tweet data for proper tweet display
4. Setup connection to Twitter API
5. Add support for displaying a single, specific tweet by ID
6. Add support for displaying single, newest tweet in timeline

### Release 1.2.1
1. Convert globally-registered components to locally-registered components
2. Rework event handling between button and menu
3. Make button event handler generic for reuse
4. Use root Vue instance in place of dedicated event dispatcher
5. Move Button and HeaderMenu components to their own files

### Release 1.2
1. Add border and text color transitions to buttons
2. Setup first Vue-based menu system

### Release 1.1
1. Fix issue causing `ERR_TOO_MANY_REDIRECTS`

The issue was basically an infinite loop of redirects back and forth between the home and Coming Soon pages. It was caused by flawed logic in the `MaintenanceMode::handle` method. This issue should now be resolved.

### Release 1.0
1. Move all currently-defined routes to default route group
2. Move remaining coming-soon and maintenance mode redirect logic to middlewares
3. Add catch-all route to ensure coming-soon and maintenance modes can't be circumvented
4. Add CHANGELOG link to README

### Release 0.4.1.1
1. Finally setup Changelog

### Release 0.4.1
1. Setup ComingSoon middleware
2. Setup MaintenanceMode middleware
3. Remove `if` statements that were supposed to check for the "Coming Soon" and "Maintenance" settings

### Release 0.4
1. Remove "Coming Soon" page view
2. Simplify routes
3. Disable 2 currently-unnecessary routes
4. Use environment var for enabling/disabling "Coming Soon" mode
5. Rework homepage
6. Update styles
7. Allow viewing splash pages on local dev when their related environment vars are set to false or unset

##### Notes
To clear up confusion about the "Coming Soon" changes above:

Early on, I was playing with the idea of a "Coming Soon" view for pages that were in the works. I decided later that showing a 404 page would be more normal; I wouldn't need to commit to having a specific page in this case, whereas showing a "Coming Soon" view feels more like a commitment.

The other "Coming Soon" mentioned above, however, is a splash page for the entire website.

### Release 0.3.1
1. Remove GitLab icon

### Release 0.3
1. Setup views for some HTTP errors
2. Add inline social icons
3. Add first hosted image file
4. Tweak homepage some more
5. Update general styles

### Release 0.2
1. Update website title
2. Use environment vars for Coming Soon and Maintenance splash pages
3. Finish initial work on header nav
4. Tweak homepage
5. Fix display of footer when page content is long
6. Begin working on error pages
7. Add base64-encoded favicon

### Release 0.1.1
1. Correct public-facing directory in Procfile

### Release 0.1
1. Setup first splash pages
2. Setup first routes
3. Remove a handful of default dependencies
4. First bit of work on menu items and general layout
5. Add Procfile

Most of this first release involves playing around with layout, routes, and Heroku-related settings. It contains more changes than necessary for the release, honestly. But I didn't worry about it since visitors would see a Coming Soon page anyway.
