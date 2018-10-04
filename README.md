`php artisan serve` or `php artisan serve --port=8080`

# How I'd Like the Backend to look

## Conventional API
### User
[x] account creation
[x] password reset/change
[x] login
[] 'settings'
[] character creation
[] registration
[] deletion

## Webhook
### Actions
[] combat (manual & auto modes)
[] farming
[] hunting
[] foraging/mining
[] manufacturing (this can easily be split into many more parts)
[] travelling
[] talking
[] child birth (automatically)
[] waking up
[] aging

### States
[] location
[] weather
[] day/night
[] hunger/health

### Webhook Manager
[] GameStateManager
	[] wrapper around traditional db read/write methods that takes care of notifying user channels where necessary
	[] write to db
	[] notify necessary user channels
	[] record to db all notifications (successful and failed), for retrieval later if necessary.
[] User channel
	[] decides what to form sentences about (and tersity)
	[] sends sentences to user
[x] Sentence former
	[x] form readable sentences
	[x] avoid reading from db, all necessary data should be passed in
	[] uses classes to construct sentences about eg. character appearance, weather, events, speech, etc

### Cron Jobs
[] CronJobManager adds events to the game state manager when necessary (?? - requires more thought)

# How I will get there
[] Core functionality
	[x] account creation
	[x] Sentence former (basic) -> communicates with some kind of character class which contains needed descriptive words and so on. We need this to create descriptions of different characters.
	[x] character creation - FE missing
	[x] character 'speak' event (to start, this is the only event). start just pushing straight to relevent webhooks
	[x] GameStateManager as intermediary between speech and user alerts
	[] User channel priorities (basic)

[] Increasing user's available actions
	[] things characters can do to each other
	[] things characters can do to their surroundings
	[] there being more than one town! (travel)


# If You Forgot How to Spin Things Up:
Run three servers for the web hooks to be working properly:

1. The queue
	php artisan queue:work
2. The redis server
	redis-server
3. The socket.io server
	laravel-echo-server start

# If you Forget How to Query from Command Line:
```
$ php artisan tinker
>App\User::first()->tasks;
```

# If you Forget How to Do Database Migrations:
https://www.parthpatel.net/laravel-tutorial-for-beginner-5-4/
`php artisan migrate:rollback`
`php artisan migrate:rollback --step=5`
