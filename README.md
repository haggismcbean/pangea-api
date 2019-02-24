`php artisan serve` or `php artisan serve --port=8080`

# How I'd Like the Backend to look

## Conventional API
### User
- [x] account creation
- [x] password reset/change
- [x] login
- [ ] 'settings'
- [x] character creation
- [x] registration
- [ ] deletion

### Embark Process
- [ ] fresh embark
- [ ] join existing community
	+ Community size
	+ Communities provide history
	+ Regular embarks once every x days
	+ Note communities can close their doors at any time.
	+ Note we need to disable some wonky form of 'fast travel' through spawn points.

## Webhook
### Actions
- [x] talking
- [x] foraging
- [x] travelling
- [x] combat (manual & auto modes) - it should be pretty trivially easy to instantly kill a sleeping person. It should be pretty hard to kill an awake person by yourself. But as part of a group? Not hard. But still sometimes they can run away.
- [x] eating
- [ ] building/terraforming
- [ ] talking in groups/cleverly
- [ ] waking up
- [ ] manufacturing (this can easily be split into many more parts)
- [ ] mining
- [ ] farming
- [ ] hunting
- [ ] aging
- [ ] child birth (automatically) (actually do I even want this? I have a pretty plausible excuse now)
- [ ] skills

### States
- [x] location
- [ ] biome descriptions
- [ ] weather
- [ ] day/night
- [x] hunger/health

### Moderation
- [ ] Deleting speech
- [ ] Deleting characters (comical drone explanations for this)
- [ ] Deleting users
- [ ] Blocking users

### Webhook Manager
- [ ] GameStateManager
	- [ ] wrapper around traditional db read/write methods that takes care of notifying user channels where necessary
	- [ ] write to db
	- [ ] notify necessary user channels
	- [ ] record to db all notifications (successful and failed), for retrieval later if necessary.
- [ ] User channel
	- [ ] decides what to form sentences about (and tersity)
	- [ ] sends sentences to user
- [x] Sentence former
	- [x] form readable sentences
	- [x] avoid reading from db, all necessary data should be passed in
	- [ ] uses classes to construct sentences about eg. character appearance, weather, events, speech, etc

### Cron Jobs
- [ ] CronJobManager adds events to the game state manager when necessary (?? - requires more thought)

# How I will get there
- [ ] Core functionality
	- [x] account creation
	- [x] Sentence former (basic) -> communicates with some kind of character class which contains needed descriptive words and so on. We need this to create descriptions of different characters.
	- [x] character creation - FE missing
	- [x] character 'speak' event (to start, this is the only event). start just pushing straight to relevent webhooks
	- [x] GameStateManager as intermediary between speech and user alerts
	- [ ] User channel priorities (basic)

- [x] Inventory management

- [ ] Increasing user's available actions
	- [ ] things characters can do to each other
	- [ ] things characters can do to their surroundings
	- [x] there being more than one town! (travel)

- [ ] Voice colours settable and saveable

# Before Launch Remember to:
- [ ] Look into what happens if I crash (I need to restart all the webhook stuff)
- [ ] Make new images and use them to create the world so people can't check git commits


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
>App\Location::find(1);
```

# If you Forget How to Do Database Migrations:
https://www.parthpatel.net/laravel-tutorial-for-beginner-5-4/
`php artisan migrate:rollback`
`php artisan migrate:rollback --step=5`

`php artisan migrate`

```
php artisan make:migration create_users_table --create=users

php artisan make:migration add_votes_to_users_table --table=users
```

```
Pivots:
https://laravel.com/docs/5.7/eloquent-relationships#many-to-many
```

# Database seeding:

`php artisan make:seeder MetalsTableSeeder`

`php artisan db:seed`

# If you Forget How to Generate Worlds
- https://worldengine.readthedocs.io
- /www/world-generator/bin -> edit the docker file, then run in docker by cd'ing to world-generator and running `bin/run_in_docker.sh` - note the world will be saved in a random folder -> `/var/folders/_v/nc4.../T`

# If you Forget How to Clear Redis Jobs:
`redis-cli flushall`

# If you Forget How to Create a Cron Job:
https://www.sitepoint.com/managing-cronjobs-with-laravel/
`php artisan make:console HappyBirthday --command=sms:birthday`