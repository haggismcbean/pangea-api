todo.md

BEFORE MAKING NEW FEATURES, LETS STOP TO FIX THINGS

Broken things audit:

 - Give item - only shown myself in the list of people to give it to...
 - Attack character didn't seem to do any damage? (possible bug) - looks like it does damage but the api call doesn't return updated value?!
 - Work on activity throws error
 - undefined has woken up (should be 'unknown')... Also notification is shown twice somehow :)
 - talk to group throws error Call to a member function characters() on null"


SOMEHOW RELATED TO INCOGNITO MODE??
 - 'Plus 0 people' - then click show and two people are there (also both are supposed to be online)
 - Presence web socket (hard)



SOLIDIFYING CURRENT OFFERING

- History
	- when you name someone, we should see the new name

- Dead people (showing, looting, burying)

- Inventory stuff (?)

- Click on character name to go to character's inventory panel.




BUGS:
- Fix timestamps (fe and be generated times need to match :P)
- Don't automatically try to sign up to chat in a wilderness (so i get rid of the error messages)
- Click on actions in people panel shouldn't open the user's description
- I keep dying? "You vision fades. You sit down where you stood and realise you don't feel cold any more. A shadow crosses. A veil lifts. All things die."
- Reload zones on sharer's account when location tab opened.




BIG DEALS:

Tech Tree (implement item uses)
		  (try making them just to make sure all is cool)

Attack a person
 - improve combat

Embarkation

Animals (farming)
		(pastoral)
		(horses)

AND THEN (AFTER LAUNCH?):

Boats

Roads

Money

Stealing off people

- Deleting unused empty zones with no child zones
	- cron job
	- feels like it can come later to be honest mate.
