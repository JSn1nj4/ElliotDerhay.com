# Changelog

## Version 2.7.0

### New

- [#166][is_166]: Start using Postmark for emails ([#168][pr_168])
- [#167][is_167]: Create and schedule weekly report email ([#169][pr_169])

### Development

- Regenerate IDE helper markup on models

[is_166]: https://github.com/JSn1nj4/ElliotDerhay.com/issues/166

[is_167]: https://github.com/JSn1nj4/ElliotDerhay.com/issues/167

[pr_168]: https://github.com/JSn1nj4/ElliotDerhay.com/pull/168

[pr_169]: https://github.com/JSn1nj4/ElliotDerhay.com/pull/169

## Version 2.6.4

### New

- Add a PublishPostToX Pennant feature for more control over posting condition
- [#158][is_158]: Add an optional image caption for post images ([#159][pr_159])

### Changes

- Update to Node install process in Lando
- Dump dedicated phpMyAdmin container for port-forwarding DB container
- Include post title in default X publishing text

### Fixes

- Mitigate random ImageFactory failures

[is_158]: https://github.com/JSn1nj4/ElliotDerhay.com/issues/158

[pr_159]: https://github.com/JSn1nj4/ElliotDerhay.com/pull/159

## Version 2.6.3

### Fixes

- Fix XMetaDTO usage for posts that have no image
- Revert from Yarn Berry to Yarn 1.22.x to fix issue with Shiki code highlighting

## Version 2.6.2

### New

- [#135][is_135]: Post to X when publishing posts ([#155][pr_155])

[is_135]: https://github.com/JSn1nj4/ElliotDerhay.com/issues/135

[pr_155]: https://github.com/JSn1nj4/ElliotDerhay.com/pull/155

### Fixes

- Tweak formatting rules

## Version 2.6.1

### New

- [#150][is_150]: Implement X (Twitter) Card markup ([#151][pr_151])
- Finally configure ESLint and Prettier for automatic formatting

### Fixes

- Fix issue preventing sending pre-built lists of categories and tags to Categories and Tags blog widgets.
- [#152][is_152]: Fix incorrect rendering of GitHub Create and Delete events

[is_150]: https://github.com/JSn1nj4/ElliotDerhay.com/issues/150

[is_152]: https://github.com/JSn1nj4/ElliotDerhay.com/issues/152

[pr_151]: https://github.com/JSn1nj4/ElliotDerhay.com/pull/151

Add Twitter Card markup for posts (#151)

## Version 2.6.0

### New

- [#140][is_140]: Try State Pattern on posts ([#145][pr_145])
- [#136][is_136]: Schema.org / Open Graph metadata for blog posts ([#147][pr_147])

### Changes

- [#138][is_138]: Ended up just doing some related tidying + removing unused code... I like my buttons with icons.

[is_136]: https://github.com/JSn1nj4/ElliotDerhay.com/issues/136

[is_138]: https://github.com/JSn1nj4/ElliotDerhay.com/issues/138

[is_140]: https://github.com/JSn1nj4/ElliotDerhay.com/issues/140

[pr_145]: https://github.com/JSn1nj4/ElliotDerhay.com/pull/145

[pr_147]: https://github.com/JSn1nj4/ElliotDerhay.com/pull/147

## Version 2.5.0

### Changes

- [#114][is_114]: Upgrade yarn version ([#142][pr_142])

### Fixes

- [#143][is_143]: Remove leftover 'published' call from sitemap config
- Dang it Cloudflare... Trust 'all proxies', since Cloudflare's IPs can change too much...

[is_114]: https://github.com/JSn1nj4/ElliotDerhay.com/issues/114

[is_143]: https://github.com/JSn1nj4/ElliotDerhay.com/issues/143

[pr_142]: https://github.com/JSn1nj4/ElliotDerhay.com/pull/142

## Version 2.4.7

### Fixes

- [#139][is_139]: Fix leaking draft posts ([#141][pr_141])

[is_139]: https://github.com/JSn1nj4/ElliotDerhay.com/issues/139

[pr_141]: https://github.com/JSn1nj4/ElliotDerhay.com/pull/141

## Version 2.4.6

### Fixes

- Remove forgotten JS debugging line...

## Version 2.4.5

### Fixes

- [#134][is_134]: Popup and DNT cookies weren't sticking
- Add missing analytics tracker script
- [#137][is_137]: Fix sitemap including unpublished posts

[is_134]: https://github.com/JSn1nj4/ElliotDerhay.com/issues/134

[is_137]: https://github.com/JSn1nj4/ElliotDerhay.com/issues/137

## Version 2.4.4

### New

- Add 'View Live' action for posts
- [#133][is_133]: Add counter badges to multiple resources

### Changes

- Add icons to action buttons
- Post status as colorized badges

[is_133]: https://github.com/JSn1nj4/ElliotDerhay.com/issues/133

## Version 2.4.3

### Changes

- Collapse some form sections when empty
- Require confirmation for publishing and unpublishing posts

### Fixes

- [#131][is_131]: Fix EditPost save issue
- [#132][is_132]: Fix dark mode switcher

[is_131]: https://github.com/JSn1nj4/ElliotDerhay.com/issues/131

[is_132]: https://github.com/JSn1nj4/ElliotDerhay.com/issues/132

## Version 2.4.2

### Fixes

- Try forcing HTTPS URL scheme in production

## Version 2.4.1

### Fixes

- Add missing requirements for Filament access
- Reorder some messy parts of the User model

## Version 2.4.0

### New

- [#125][pr_125]: Replace admin dashboard with Filament
- [#129][is_129]: Implement global search
- [#113][is_113]: Implement post draft / published features in [#130][pr_130]

### Changes

- Remove `Feature::toggleForEveryone` macro now that the default scope is everyone

### Fixes

- Fix/add Changelog issue/PR links
- Make project startup script more bulletproof
- Fix font issue caused by Tailwind config ([#128][is_128])

[is_113]: https://github.com/JSn1nj4/ElliotDerhay.com/issues/113

[pr_125]: https://github.com/JSn1nj4/ElliotDerhay.com/pull/125

[is_128]: https://github.com/JSn1nj4/ElliotDerhay.com/issues/128

[is_129]: https://github.com/JSn1nj4/ElliotDerhay.com/issues/129

[pr_130]: https://github.com/JSn1nj4/ElliotDerhay.com/pull/130

## Version 2.3.0

### New

- [#94][gh_94]: Add SEO-related features - page title and meta description
- [#106][gh_106]: Add tagging UI for posts to admin dashboard
- [#107][gh_107]: Add admin category UI to posts
- [#104][gh_104]: Add Sitemap

### Updates

- Seed an admin user during development
- Bring exception handler in line with parent
- Use lightbox in project and image manager admin views
- [#111][gh_111]: Generate Markdown heading links
- Update dependencies

### Fixes

- Broken PSR7 autoloader dependency for Sentry
- Add missing image store job on Post update
- Center text in link buttons
- Make header `<figure>` elements `inline-block` like Markdown-rendered images
- [#122][gh_122]: Posts generating meta description from body break response
- Unable to import types
- Fix minor post header image display issue on hover

[gh_94]: https://github.com/JSn1nj4/ElliotDerhay.com/issues/94

[gh_104]: https://github.com/JSn1nj4/ElliotDerhay.com/issues/104

[gh_106]: https://github.com/JSn1nj4/ElliotDerhay.com/issues/106

[gh_107]: https://github.com/JSn1nj4/ElliotDerhay.com/issues/107

[gh_111]: https://github.com/JSn1nj4/ElliotDerhay.com/issues/111

[gh_122]: https://github.com/JSn1nj4/ElliotDerhay.com/issues/122

## Version 2.2.1

### Updates

- [#116][gh_116]: Speed up Lightbox transitions

[gh_116]: https://github.com/JSn1nj4/ElliotDerhay.com/issues/116

## Version 2.2.0

### New

- [#88][gh_88]: Create image lightbox modal that can be used on blog posts

[gh_88]: https://github.com/JSn1nj4/ElliotDerhay.com/issues/88

### Updates

- [#102][gh_102]: Make cookie popup more mobile-friendly
- [#103][gh_103]: Make Pennant features global-only by default
- [#110][gh_110]: Move lang folder to root, in line with latest Laravel defaults

[gh_102]: https://github.com/JSn1nj4/ElliotDerhay.com/issues/102

[gh_103]: https://github.com/JSn1nj4/ElliotDerhay.com/issues/103

[gh_110]: https://github.com/JSn1nj4/ElliotDerhay.com/issues/110

## Version 2.1.3

### New

- #100: add "View Public" links on admin content view/edit pages

### Fixes

- Fix [#92][gh_92]: support state restore in cached config objects
- Fix [#101][gh_101]: content slice/dupe bug during editing

[gh_92]: https://github.com/JSn1nj4/ElliotDerhay.com/issues/92

[gh_101]: https://github.com/JSn1nj4/ElliotDerhay.com/issues/101

## Version 2.1.2

### Fixes

- Hide empty sidebar widgets
- Add more light/dark color updates for admin
- Fix code block theme name
- Display latest blog post on homepage

### Updates

- Display GitHub feed differently on homepage
- Dark/light colors for inline code

## Version 2.1.1

### Fixed

- Space a type-hinting comment in a Blade file to fix "undefined constant php" error on Heroku platform.

## Version 2.1.0

### New

- AdminLogin feature via Laravel Pennant
- Commands to toggle admin login feature and check its status
- Add command to flush sessions
- Set up toggleable GitHub feed Pennant feature

### Updates

- Minor refactoring

### Fixes

- Some tables were missing foreign key constraints

## Version 2.0.5

### Fixes

- Use raw S3 asset URLs in Production for now

## Version 2.0.4

### Fixes

- Missed HOME route constant

## Version 2.0.3

### Fixes

- Move another set of forgotten routes

## Version 2.0.2

### Fixes

- Move some dev routes created for new features
- Fix service config model references

## Version 2.0.1

### Fixes

- Fix Node build script

## Version 2.0.0

### New

- Command to get fresh Twitter user data
- `HttpMethod` enum
- `CreateMode` enum to aid in dynamically selecting model create mode
- `TwitterService::call()` method for calling endpoints via dedicated endpoint classes
- `TwitterService::checkForErrors()` method to check responses for errors
- `TwitterService::getUsers()` method to fetch Twitter user data
- Twitter user data update event
- Command to get fresh GitHub user data
- GitHub user data update event
- `GithubService::call()` method for calling endpoints
- `GithubService::checkforErrors()` method to check responses for errors
- `GithubService::getUser()` method to fetch GitHub user data
- `GithubService::getUsers()` method to call `GithubService::getUser()` for multiple users
- GitHub user data factory for imitating GitHub API data
- Twitter user data factory for imitating Twitter API data
- Factory for generating fake Twitter user entities
- Factory for generating testing tokens
- Configure Vite
- Configure phpMyAdmin and Mailhog in Lando
- Configure Cron in Lando
- Configure GitHub Actions
- Implement blog
- Implement basic Admin dashboard
- Implement admin command runner
- Implement polymorphic image relationship

### Updates

- Pass token to Twitter Service constructor
- Restructure Twitter service to use dedicated Endpoint classes
- Modify `TwitterUser::fromDTO()` to dynamically choose model create/update methods using `CreateMode` enum
- Schedule new user update commands weekly
- Restructure `GithubService` a bit to use dedicated Endpoint classes
- Add endpoint tests
- Add Pest to Composer's allowed plugins
- Increase background task frequency
- Finish Projects implementation
- Remove Dusk
- Group DB seeders
- Upgrade packages
- Regen IDE helpers
- Move some config files
- Update tests
- Housekeeping

### Bug fixes

- Fix [#47][gh_47]: token "expires_at" issue
	- Check for `null` value for tokens that don't have an expiration date
	- Conversely, ensure value is _not_ `null` as part of expiration check

[gh_47]: https://github.com/JSn1nj4/ElliotDerhay.com/issues/47

## Version 1.12.1

### Bug fixes

- Fix `CreateEvent` and `DeleteEvent` not supporting created/deleted repos

## Version 1.12.0

### Major changes

- Upgrade environment dependencies
	- Node 16.14.0
	- Yarn 1.22.17
- Upgrade Yarn dependencies
	- vue@^3.2.30
	- vue-loader@^17.0.0
- Remove vue-template-compiler
- Upgrade composer dependencies
	- fruitcake/laravel-cors@^2.0.5
	- guzzlehttp/guzzle@^7.2
	- laravel/framework@^9.0
	- laravel/tinker@^2.7
	- nunomaduro/collision@^6.1
	- phpunit/phpunit@^9.5.10
- Replace facade/ignition@^2.5 with spatie/laravel-ignition@^1.0
- Remove fideloper/proxy@^4.4
- Remove cross-env@^7.0.2
- Remove eslint@^8.1.0
- Add missing peer dependencies
	- @babel/core@^7.15.8
	- @babel/plugin-proposal-object-rest-spread@^7.15.6
	- @babel/plugin-syntax-dynamic-import@^7.8.3
	- @babel/plugin-transform-runtime@^7.15.8
	- @babel/preset-env@^7.15.8
	- autoprefixer@^10.0.2
	- webpack@^5.60.0
	- webpack-cli@^4.9.1
- Update some Vue code
- Remove some unused Vue templates

### Minor changes

- Add `lando pull_content` to get latest remote content easily
- Tweak single "post-install-cmd" script
- Minor code tweaks
- Add new Dusk testing directory

## Version 1.11.0

### Main changes

- Add command to run multiple other artisan commands in bulk

## Version 1.10.2

### Tweaks

- Attempt to limit automatic migrations only to development environment

## Version 1.10.1

### Main Changes

- Require PHP 8.1
- Require Node 16
- Require Yarn 1.22.5
- Include ASDF tool versions instead of nodenv config
- Upgrade Yarn dependencies:
	- axios@^0.25.0
	- postcss-mixins@^9.0.1
	- tailwindcss@^3.0.18
- Upgrade Composer dependencies:
	- laravel/framework@^8.82
	- sentry/sentry-laravel@^2.11
	- laravel/dusk@^6.22
	- pestphp/pest@^1.21
	- pestphp/pest-plugin-laravel@^1.2

### Tweaks

- Tweak Tailwind config to be more v3-friendly

## Version 1.10.0

### Main Changes

- Add dev routes
	- See ["Develop faster by adding dev routes file in a Laravel app"][1_10_0-dev_routes]
- Add Lando config
- Update PHP requirement to PHP 8
- Update all dependencies
- Update Laravel boilerplate, mostly
- Replace GithubClient with GithubService + tests
- Replace TwitterClient with TwitterService + tests
- Add PrivatePropertyAccessor reflection class for use in testing
- Add dark/light mode feature
- Overhaul homepage
- Convert some Blade partials to Laravel components
- Replace some nested Blade yields with [stacks][blade_stacks]
- Update license

### Tweaks

- Minor privacy policy updates
- Font changes
- Add .env.testing (PR #21 by @zach2825)
- Other initial testing setup tweaks (PR #21 by @zach2825)
- Reorganize some Blade partials
- Code cleanup

[1_10_0-dev_routes]: https://freek.dev/1976-develop-faster-by-adding-dev-routes-file-in-a-laravel-app

[blade_stacks]: https://laravel.com/docs/8.x/blade#stacks

### Tweaks

- Force Yaml to use spaces for indentation
- Add a missing message to the `github:event:pull` command

## Version 1.9.6

Updates installed packages.

### Changes

- Update laravel/framework @^8.40 to address [GHSA-4mg9-vhxq-vm7j][GHSA-4mg9-vhxq-vm7j]
- Update laravel-mix to @6.0.19 to address [GHSA-7r28-3m3f-r2pr][GHSA-7r28-3m3f-r2pr]
	- This also indirectly updates lodash to [4.17.21][lodash_4.17.21] to fix
	  a [command injection issue][lodash_pr_5085]
- Update "sentry/sentry-laravel" to ^2.5

[GHSA-4mg9-vhxq-vm7j]: https://github.com/advisories/GHSA-4mg9-vhxq-vm7j

[GHSA-7r28-3m3f-r2pr]: https://github.com/advisories/GHSA-7r28-3m3f-r2pr

[lodash_4.17.21]: https://github.com/lodash/lodash/releases/tag/4.17.21

[lodash_pr_5085]: https://github.com/lodash/lodash/pull/5085

## Version 1.9.5

A few bug fixes:

- Fix how a given tweet's URL was being generated
- Fix how repo URLs were being generated
- Fix source URLs for Pull Request and Issue Comment events

## Version 1.9.4

Fix incorrect column type in "github_events_table"

## Version 1.9.3

Fix incorrect column type in "tweets" table.

## Version 1.9.2

### Changes

1. Force migration script to run in production
2. Update composer dependencies and update lock file

## Version 1.9.1

Small maintenance release

1. Plug leak in custom error pages
2. Run migrations after composer install
3. Remove default user migration, factory, and model

## Version 1.9

Large maintenance release

### Major changes

1. Update to Laravel 8
2. Convert completely from SCSS to PostCSS
3. Create dedicated HTTP clients for Twitter and GitHub
4. Create storage for Tweets, GitHub events, and tokens
	- This removes the need to call these APIs every time the site is loaded
5. Configure commands to fetch Tweet and GitHub event data as well as prune old data
6. Register events and event handlers related to fetching and pruning data storage
7. Remove Vue components and related JS modules for tweets, GitHub events, and another upcoming feature
	- These were overkill for parts of the page that are unlikely to update after page load in the future
8. Update Laravel Mix to version 6
9. Update Tailwind CSS to v2
10. Update Axios to v0.21.1
11. Convert a large number of blade partials to components
12. Remove helper classes, provider, and registration
	- These became unnecessary while switching some blade partials to components

### Minor changes

1. Add Xdebug config for VS Code
2. Configure Sentry for catching issues in Production
3. Mass-rename GitHub-related modules, HTML classes, and some related wording
	- Even though GitHub's events API is related to GitHub user activity, the data being worked with is called "events"
	  and should be referred to that way
4. Remove some dependencies and configuration related to Vue code that has been trimmed
5. Remove an old icon stylesheet
6. Switch to using ES6 `import` to load Vue into bootstrap.js
7. Disable Axios code in "bootstrap.js"
8. Fix various minor issues
9. Minor config tweaks

## Version 1.8.3

Update accidentally-outdated yarn.lock file

## Version 1.8.2

Remove grave character accidentally slipped into Tailwind version number.

## Version 1.8.1

1. Try again to update previously-updated packages
2. Rename `heroku-postbuild` script to just `build`

## Version 1.8.0

1. Remove old Coming Soon page and related parts
2. Remove old Maintenance page and related parts
3. Add 503 error page for Laravel's own built-in maintenance mode
4. Add GA tracking allow/deny banner
	- Banner only shows if its user interaction cookie isn't set
	- If banner is showing, additional spacing will be added to the bottom of the page to ensure no content gets
	  blocked.
5. Add global Vue event bus
6. Add conditional GA tracking code
	- Defaults to not tracking if user hasn't allowed it yet or has browser Do Not Track enabled
	- Will not track if DNT cookie is set to 1, will if set to 0
	- Listens for `allow_tracking` event via global event bus to let user select whether tracking will be allowed
7. No longer directly mutate props on Card component, as mentioned in Vue error message
	- See [Props: One-Way Data Flow][props-data-flow]
8. Remove catch-all route since Laravel will automatically handle 404s for non-existant routes
	- See [Routing: Fallback Routes][fallback-routes]
	  > Typically, unhandled requests will automatically render a "404" page via your application's exception handler.
9. Make error code testing route more efficient
	- Use `where` routing method to ensure error route only serves requests for a specific pattern.
	- No longer check for `$code` being set or containing an empty string, since the route requires a specific pattern
	  to even run.
	- Use `abort` helper to throw an error with the given error code, ensuring that the correct error message is set
	  when rendering the related view.
10. Update some layout section names to avoid accidentally overriding section output further up view chain.
11. Redesign error page layout
12. Move footer copyright to its own partial
13. Tweak existing error pages
14. Add privacy policy page
15. Finish replacing `vue-loading-spinner` package
16. Configure package.json scripts for auto-build on Heroku

[props-data-flow]: https://vuejs.org/v2/guide/components-props.html#One-Way-Data-Flow

[fallback-routes]: https://laravel.com/docs/7.x/routing#fallback-routes

## Version 1.7.1

1. Use arrow function as callback for Cath-All web route
2. Adjust About columns
3. Update About text

## Version 1.7

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
	- I was starting to feel like this really didn't belong on the homepage, or that it was too big for what a section
	  like this should be. May revisit in the future, but at least the markup is self-contained now.
17. Update to FontAwesome's new JS type kit
18. Add dev.to social icon to footer

## Version 1.6.1

1. Include required 'user' data in IssuesEvent payload
2. Rename a payload filtering method for consistency

## Version 1.6

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

## Version 1.5.1

1. Update project version number
2. Regenerate public assets

## Version 1.5

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

## Version 1.4.8

1. Update Tailwind CSS: ^0.5.3 -> ^1.0.0-beta.3
2. Update local Tailwind config
3. Update classes in SCSS and template files as needed
4. Update documentation within several PHP classes

Tailwind upgrade guide can be found [here][1].

- Note: this is from any development release to any beta release. There may yet be more changes.

[1]: https://github.com/tailwindcss/tailwindcss/releases/tag/v1.0.0-beta.1

## Version 1.4.7

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

## Version 1.4.6

Fix issue displaying create events for creating a repository.

## Version 1.4.5

Remove home from menu by default to switch header layouts.

## Version 1.4.4

1. Move 'About' content to homepage
2. Kill 'About' route since it's no longer needed
3. Remove 'About' menu item
4. Fix new spacing issues on homepage
5. Move tech logos to bottom, and add a heading
6. Update `.node-version` file to "8.12.0"

## Version 1.4.3

1. Update required node version to 8.11.2 for development
	- Trying to keep it the same between machines
2. Update laravel-mix to 3.0.0
3. Manually update har-validator to 5.1.3
	- NPM was looking for a slightly lower version that it couldn't find
4. Update Vue to 2.5.18
	- Fixes a version mismatch between it and `vue-template-compiler`
5. Update home banner image

## Version 1.4.2

1. Update Laravel Mix to version 2.1.14
2. Fix a number of vulnerabilities
3. Update Vue to version 2.5.17
4. Install `imagemin@^6.0.0`
5. Install `laravel-mix-purgecss@^3.0.0` to implement PurgeCSS
6. Scale down SVG logos on homepage

## Version 1.4.1

1. Split bloated GitHub event component into separate components
2. Implement dynamic imports for displaying GitHub events
3. Relocate new module chunks to specific public resource folder
4. Generate versioned hashes for front-end resources
	- This will force downloading new resource version when requested by the browser

## Version 1.4

1. Upgrade Laravel version 5.7
2. Extract third-party libraries into "vendor.js"
3. Add GitHub activity feed to website
4. Add a loading animation for Twitter/GitHub feeds
5. Setup email notifications for when new GitHub activity types are detected in feed
6. Show Vue logo on Homepage
7. Other homepage text changes
8. Rewrite About content
9. Work some more on Updates page (hidden for now)

## Version 1.3.1

Small change to bio text

## Version 1.3

1. Create Vue card component
2. Create timeline for displaying multiple cards
3. Create Twitter-specific cards
	- These make use of the generic card, but are used for rendering tweets
	- Parse tweet data for proper tweet display
4. Setup connection to Twitter API
5. Add support for displaying a single, specific tweet by ID
6. Add support for displaying single, newest tweet in timeline

## Version 1.2.1

1. Convert globally-registered components to locally-registered components
2. Rework event handling between button and menu
3. Make button event handler generic for reuse
4. Use root Vue instance in place of dedicated event dispatcher
5. Move Button and HeaderMenu components to their own files

## Version 1.2

1. Add border and text color transitions to buttons
2. Setup first Vue-based menu system

## Version 1.1

1. Fix issue causing `ERR_TOO_MANY_REDIRECTS`

The issue was basically an infinite loop of redirects back and forth between the home and Coming Soon pages. It was
caused by flawed logic in the `MaintenanceMode::handle` method. This issue should now be resolved.

## Version 1.0

1. Move all currently-defined routes to default route group
2. Move remaining coming-soon and maintenance mode redirect logic to middlewares
3. Add catch-all route to ensure coming-soon and maintenance modes can't be circumvented
4. Add CHANGELOG link to README

## Version 0.4.1.1

1. Finally setup Changelog

## Version 0.4.1

1. Setup ComingSoon middleware
2. Setup MaintenanceMode middleware
3. Remove `if` statements that were supposed to check for the "Coming Soon" and "Maintenance" settings

## Version 0.4

1. Remove "Coming Soon" page view
2. Simplify routes
3. Disable 2 currently-unnecessary routes
4. Use environment var for enabling/disabling "Coming Soon" mode
5. Rework homepage
6. Update styles
7. Allow viewing splash pages on local dev when their related environment vars are set to false or unset

### Notes

To clear up confusion about the "Coming Soon" changes above:

Early on, I was playing with the idea of a "Coming Soon" view for pages that were in the works. I decided later that
showing a 404 page would be more normal; I wouldn't need to commit to having a specific page in this case, whereas
showing a "Coming Soon" view feels more like a commitment.

The other "Coming Soon" mentioned above, however, is a splash page for the entire website.

## Version 0.3.1

1. Remove GitLab icon

## Version 0.3

1. Setup views for some HTTP errors
2. Add inline social icons
3. Add first hosted image file
4. Tweak homepage some more
5. Update general styles

## Version 0.2

1. Update website title
2. Use environment vars for Coming Soon and Maintenance splash pages
3. Finish initial work on header nav
4. Tweak homepage
5. Fix display of footer when page content is long
6. Begin working on error pages
7. Add base64-encoded favicon

## Version 0.1.1

1. Correct public-facing directory in Procfile

## Version 0.1

1. Setup first splash pages
2. Setup first routes
3. Remove a handful of default dependencies
4. First bit of work on menu items and general layout
5. Add Procfile

Most of this first release involves playing around with layout, routes, and Heroku-related settings. It contains more
changes than necessary for the release, honestly. But I didn't worry about it since visitors would see a Coming Soon
page anyway.
