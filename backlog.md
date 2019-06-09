Okay so in some kind of 'logical' order:

So I guess I really just need

Buildings
 - which are just fancy zones that take recipes
 - and then locks would be cool? but later, once metal is cool

Terraforming
 - ditches and walls.

1. Finish all the basic labours
    - food
    - building and terraforming
2. Implement some reasons for the things
    - death from exposure and animals
    - death from hunger
    - day/night cycle in action
    - seasons cycle in action (? - maybe already done, just need some kind of weather description/report)
3. Tidy some of the early concepts 
    - Travel
    - Fighting
4. Write the stories for everything :)
5. Clever talking (maybe this can come in later?)
6. Skills
7. Do something about just gathering one thing at a time?! I guess just increase everything by an arbitrary number to start with, and I can think further on it later. 

That's kind of it, other than pastoral animals and beasts of burden and some other minor details and fancy shit. I doubt anyone will even notice they can't smelt for a while, right??
 - glass making
 - jewellery
 - hiding shit
 - locking shit
 - embarkation 
 - settings
 - deletion
 - mod tools


/*
So Activities:

 - Crafting
    MadeItemRecipe concept here. DONE
 - Cooking
    MadeFoodRecipe
 - Building
    BuildingRecipe
    - Farm plot DONE
    - Irrigation ditch
    - Defensive ditch
    - Defensive wall
    - House
    - Barn
    - Hall
 - Fighting
    CombatRecipe (???)
    - To train
    - To subdue
    - To kill
 - Farming
    FarmingRecipe (???)
    - Plant DONE
    - Till DONE
    - Fertilize DONE
    - Harvest DONE
 - Hunting
    HuntingRecipe (???)
    - Trap
    - Hunt alone DONE
    - Hunt in group
 - Mining DONE
 - Gathering things like salt, peat, clay, etc... DONE
 - Things like smelting, pottery, food, and cloth making
 - Pastoral nomad life
 - Travelling
    TravellingRecipe (???)
    - Sail
    - Walk
    - Ride horse
    - Ride cart

CANCELATION
You can stop/start working on things whenever you like.
If you stop a 'chore' thing like tilling, its effects are calculated when you stop and the activity removed
If you stop a 'creative' thing like crafting, it is paused and you can come back to it later

STORY
With all things, as you're doing them you get randomized strings telling you how it's going or whatever.
These can come once every x seconds for everything to start with.
The strings can sometimes come as a 'story', can have multiple 'endings'

PROGRESS
Things take a certain length of time which is calculated depending on tools, skills, and base time.
Your progress goes up each cycle and once it reaches 100... something happens (ie call back to the activity's controller)

FAIL
Things can fail entirely. When they do you get the inputs back

DEATH
You can die whilst doing things. The likelihood of this happening depends on the activity in question. 
We want people to live a fairly long time

So to do:

Activity needs a type and a name.
 the type will be say farming to send you to the farming controller
 the name will be say tilling which will send you to the function (to calc the output when the activity is finished)

Messages in a table? Could do. Maybe later ;)

1. Create an ActivityController that does all the above things. Get it working with the current CraftingController stuffs.

*/


Next stepsicles:

 [x] hunting - BROKEN
 [x] farming
    - watering
    - slowly increasing yield
    - once a day weeding? maybe we can let people weed ad nauseum but it doesn't help? that still requires once a day-ish-ness
    - harvest time
 [x] mines/landmarks
 [ ] zone creation: 'Exploration', ditch, building, earthen wall
 [ ] tool uses (speed up gathering, create zones, storage, locks, travelling (?))
 [ ] chat group logic
 [ ] list which users are online
 [ ] time and weather feeds
 [ ] improved fighting
 [ ] dying
 [ ] improved place descriptions
 [ ] old age
 [ ] skills (maybe a user can pick one on character creation)
 [ ] ui improvements
 [ ] animal attacks
 [ ] (hunt by) trapping
 [ ] slavery
 [ ] death by exposure
 [ ] weather and seasons (used in farming, hunting)


 Okay so that was good! Now how about some farming?!

 