- [x] Travelling takes some amount of time
- [x] and generates some kind of a message.
'You begin travelling', 'You end travelling' - and on you end, your zone has changed. Your visibility to people in your zone will change though unless they are in your travel group, but that's just normal.
- [x] Okay so here's how we want to do travelling. And actually basically everything else. You send off your travel request. You get a response back that tells you the response AND the time lock. In the meantime, there's a lock on your character. A lock is basically a timestamp (server time) of when you can next make an action. It'll be a few hundred milliseconds for most things I guess. Then when the next request is made we check if we're in the lock time or not.
- [x] To do: ACTUALLY CHECK THE TIMELOCK LOL
- [ ] I think it'd be good to get talking right at an early stage. I think one of the reasons the internet is such a hateful place is because of mob mentality, so it'd be cool if the game really embraces more personal interactions and interacting at 'mob' level is much less common. It is important and needs to be possible (eg at the very first spawn), but it'd be good if it was also lost/difficult/uncommon in some way. I think people not hearing things if they aren't logged in is a good way. Also no speech bleeding - if you're speaking to one person, usually they're the only one to hear anything. People have to specifically gather together to hear each other.

-----

these come after i've created tools i spose

toolTasks:
taskName: gather.plant.grass.wheat
toolId: 12
labourCostChange: 12
outputChange: 1.3

-----

these come after i've created machines i spose

machineTasks:
taskName: operate.machine.thresher
machineId: 12
labourCostChange: 12
outputChange: 2.2

-----

these can easily be auto generated, but actually i guess i want them to start pretty level for everyone and just go up when people do things really. sometimes things have to be taught though so...? I guess first iteration, just return 1.

characterSkills:
characterId: 1
taskName: gather.plant.grass
labourCostChange: 0.8
outputChange: 1